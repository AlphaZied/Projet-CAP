<?php
require_once("db_config.php");
require_once("phpmailer/PHPMailerAutoload.php");
$data = array();
$data['change'] = false;
if(!$data['change'])
{
function RandomString($length = 30) {
$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
$charactersLength = strlen($characters);
$randomString = '';
for ($i = 0; $i < $length; $i++) {
$randomString .= $characters[rand(0, $charactersLength - 1)];
}
return $randomString;
}

function isValid($code, $ip = null)
{
if (empty($code)) {
return false; 
}
$params = array ('secret'    => '6Ld9JyUTAAAAAK7g7Zm58Dj0lzCvwN8Fkw5gEVRc', 'response'  => $code);
if( $ip ){
$params['remoteip'] = $ip;
}
$url = "https://www.google.com/recaptcha/api/siteverify?" . http_build_query($params);
if (function_exists('curl_version')) {
$curl = curl_init($url);
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_TIMEOUT, 10);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); 
$response = curl_exec($curl);
} else {
$response = file_get_contents($url);
}

if (empty($response) || is_null($response)) {
return false;
}

$json = json_decode($response);
return $json->success;
}

if(isset($_POST['submit']))
{
if(isset($_POST['g-recaptcha-response'])) 
{
$ip = get_ip();
if(isValid($_POST['g-recaptcha-response']))
{
$email = $_POST['email'];
$sql = $pdo->prepare("SELECT * FROM users WHERE email = :email");
$sql->bindParam("email", $email);
$sql->execute();
$fetch = $sql->fetch();
if(!$fetch)
{
$data['errors'] = "L'adresse mail ne correspond à aucun compte existant.";
}
else
{
$email = $fetch['email'];
$pseudo = $fetch['pseudo'];
$userid = $fetch['id'];
$cle = RandomString();
$mail = new PHPMailer;
$mail->CharSet = 'UTF-8';
$mail->isSMTP();
$mail->SMTPSecure = "tls";
$mail->Port = 587;
$mail->SMTPDebug = 0;
$mail->Debugoutput = 'html';
$mail->Host = 'smtp.live.com';
$mail->SMTPAuth = true;
$mail->Username = "extrageo@outlook.fr";
$mail->Password = "unpetitmdp76";
$mail->setFrom('extrageo@gmail.com', 'ExtraGeo');
$mail->addReplyTo('extrageo@gmail.com');
$mail->AddAddress($email);
$mail->Subject = 'Nouveau Mot de Passe';
$mail->Body =  'Salut <b>'.$pseudo.'</b> ! <br><br>
Pour modifier ton mot de passe rend toi ici : <a href=\'http://extrageo.cf/forget.php?key='.$cle.'\'> Changer de Mot de Passe </a> <br><br>
A bientôt !';
$mail->AltBody = 'Modification de ton mot de passe !';

$expire = date('d-m-Y H:i:s', strtotime('+24 hours'));
$expire = strtotime($expire);
$sql = $pdo->prepare("INSERT INTO passrecover (email, timestamp, cle, userid) VALUES (:email, :time, :cle, :userid)");
$sql->bindParam("email", $email);
$sql->bindParam("time", $expire);
$sql->bindParam("cle", $cle);
$sql->bindParam("userid", $userid, PDO::PARAM_INT);
$sql->execute();
if ($mail->send())
{
$data['success'] = "Un email a été envoyé !";
}
else
{
$data['errors'] = "Une erreur s'est produite veuillez réessayer.";
}
}
}
else
{
$data['errors'] = 'Le captcha est incorrect, veuillez réessayer.';	
}
}
else
{
$data['errors'] = 'Veuillez valider le captcha';
}
}
}

if(isset($_GET['key']))
{
$cle = $_GET['key'];
$sql = $pdo->prepare("SELECT * FROM passrecover WHERE cle = :cle");
$sql->bindParam("cle", $cle);
$sql->execute();
$fetch = $sql->fetch();
if($fetch)
{

$time = $fetch['timestamp'];
$userid = $fetch['userid'];
$now = date('d-m-Y H:i:s');

if($time >= strtotime($now))
{
$data['change'] = true;
}
else
{
$data['errors'] = "Demande de modification expirée.";
}

}
else
{
$data['errors'] = "Une erreur est survenue.";
}
}

if($data['change'])
{
if(isset($_POST['submit']))
{
$mdp = $_POST['mdp'];
$mdpre = $_POST['mdpre'];

if($mdp != $mdpre)
$data['errors'] = "Les mots de passes ne correspondent pas";

if(strlen($mdp) < 6)
$data['errors'] = "Le mot de passe est trop court";

if(strlen($mdp) > 30)
$data['errors'] = "Le mot de passe est trop long";

if(empty($data))
{
$sql = $pdo->prepare("UPDATE users SET mdp = :mdp WHERE id = :userid");
$sql->bindParam("mdp", $mdp);
$sql->bindParam("userid", $userid);
$sql->execute();
$sql = $pdo->prepare("UPDATE `passrecover` SET `timestamp` = '0' WHERE `userid` = :userid");
$sql->bindParam("userid", $userid);
$sql->execute();
$data['success'] = "Le mot de passe a été modifié avec succès !";
header('Location: '.$url.'/index.php?success');
exit;
}
}
}
echo json_encode($data);