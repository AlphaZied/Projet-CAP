<?PHP
require_once("db_config.php");

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

$data = array();
$pseudo = $_POST['pseudo'];
$mdp = $_POST['mdp'];
$remdp = $_POST['mdp2'];
$email = $_POST['mail'];
$ip = get_ip();
$filter = preg_replace("#[^a-z\d\-=]#i", "", $pseudo);
$email_check = preg_match("/^[a-z0-9_\.-]+@([a-z0-9]+([\-]+[a-z0-9]+)*\.)+[a-z]{2,7}$/i", $email);

$sql = $pdo->prepare("SELECT id FROM users WHERE pseudo = :pseudo LIMIT 1");
$sql->bindParam('pseudo', $pseudo);
$sql->execute();
$row = $sql->fetch();

$sql2 = $pdo->prepare("SELECT id FROM users WHERE email = :email LIMIT 1");
$sql2->bindParam("email", $email);
$sql2->execute();
$row2 = $sql2->fetch();

if(!empty($pseudo) && !empty($email) && !empty($mdp) && !empty($remdp)){
if(strlen($pseudo) > 15)
$data['pseudo'] = "Votre Pseudo est trop long.";

if(strlen($pseudo) <= 2)
$data['pseudo'] = "Merci d'entrer un Pseudo.";

if($row)
$data['pseudo'] = 'Votre pseudo est déjà utilisé.';

if($filter !== $pseudo)
$data['pseudo'] = 'Votre Pseudo contient des caractères non autorisés.';

if($mdp !== $remdp)
$data['mdp'] = "Les mots de passe ne correspondent pas.";

if(strlen($mdp) < 6)
$data['mdp'] = "Votre mot de passe est trop court.";

if(strlen($mdp) > 20)
$data['mdp'] = "Votre mot de passe est trop long.";

if(strlen($email) < 6)
$data['email'] = "Merci d'entrer une adresse email valide.";

if($email_check !== 1)
$data['email'] = "Merci d'entrer une adresse email valide.";

if($row2)
$data['email'] = "L'adresse mail est déjà utilisée.";

if(isset($_POST['g-recaptcha-response'])) 
{
if(!isValid($_POST['g-recaptcha-response'], $ip))
$data['captcha'] = 'Captcha incorrect.';
}
else
{
$data['captcha'] = 'Veuillez valider le captcha.';
}

}
else
{
$data['champ'] = true;
}

if(empty($data))
{
$data['success'] = true;
$rank = 1;
$now = time();
$titre = "Soldat Première classe";
$sql = $pdo->prepare("INSERT INTO users (pseudo, mdp, email, ip, inscription, last_connect, grade, rank) VALUES (:pseudo, :mdp, :email, :ip, :inscription, :last_connect, :grade, :rank) ");
$sql->bindParam('pseudo', $pseudo);
$sql->bindParam('mdp', $mdp);
$sql->bindParam('email', $email);
$sql->bindParam('ip', $ip);
$sql->bindParam('inscription', $now);
$sql->bindParam('last_connect', $now);
$sql->bindParam('grade', $titre);
$sql->bindParam('rank', $rank);
$sql->execute();

$_SESSION['pseudo'] = $pseudo;
$_SESSION['mdp'] = $mdp;
$_SESSION['lvl'] = 1;
$_SESSION['titre'] = $titre;
}
echo json_encode($data);
?>