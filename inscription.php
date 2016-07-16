<?PHP
require_once("pdo.php");
if(isset($pseudo))
{
header('Location: '.$url.'/panel');
exit;
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

if(isset($_POST['inscription']))
{
$pseudo = $_POST['pseudo'];
$mdp = $_POST['mdp'];
$remdp = $_POST['remdp'];
$email = $_POST['email'];
$ip = get_ip();
$filter = preg_replace("#[^a-z\d\-=]#i", "", $pseudo);
$email_check = preg_match("/^[a-z0-9_\.-]+@([a-z0-9]+([\-]+[a-z0-9]+)*\.)+[a-z]{2,7}$/i", $email);
$tmp = $pdo->prepare("SELECT id FROM users WHERE pseudo = :pseudo LIMIT 1");
$tmp->execute(array('pseudo' => $pseudo));
$row = $tmp->fetch();
$sql = $pdo->prepare("SELECT id FROM users WHERE email = :email LIMIT 1");
$sql->bindParam("email", $email);
$sql->execute();
$row2 = $sql->fetch();

if(strlen($pseudo) > 15)
$errors['pseudo'] = "Votre Pseudo est trop long.";

if(strlen($pseudo) <= 2)
$errors['pseudo'] = "Merci d'entrer un Pseudo.";

if($row)
$errors['pseudo'] = 'Votre pseudo est déjà utilisé.';

if($filter !== $pseudo)
$errors['pseudo'] = 'Votre Pseudo contient des caractères non autorisés.';

if($mdp !== $remdp)
$errors['mdp'] = "Les mots de passe ne correspondent pas.";

if(strlen($mdp) < 6)
$errors['mdp'] = "Votre mot de passe est trop court.";

if(strlen($mdp) > 20)
$errors['mdp'] = "Votre mot de passe est trop long.";

if(strlen($email) < 6)
$errors['email'] = "Merci d'entrer une adresse email valide.";

if($email_check !== 1)
$errors['email'] = "Merci d'entrer une adresse email valide.";

if($row2)
$errors['email'] = "L'adresse mail est déjà utilisée.";

if(isset($_POST['g-recaptcha-response'])) 
{
if(!isValid($_POST['g-recaptcha-response'], $ip))
$errors['captcha'] = 'Captcha incorrect.';
}
else
{
$errors['captcha'] = 'Veuillez valider le captcha.';
}

if (empty($errors))
{
$rank = 1;
$now = time();
$sql = $pdo->prepare("INSERT INTO users (pseudo, mdp, email, ip, inscription, last_connect, rank) VALUES (:pseudo, :mdp, :email, :ip, :inscription, :last_connect, :rank) ");
$sql->bindParam('pseudo', $pseudo);
$sql->bindParam('mdp', $mdp);
$sql->bindParam('email', $email);
$sql->bindParam('ip', $ip);
$sql->bindParam('inscription', $now);
$sql->bindParam('last_connect', $now);
$sql->bindParam('rank', $rank);
$sql->execute();

$_SESSION['pseudo'] = $pseudo;
$_SESSION['mdp'] = $mdp;
header('Location: '.$url.'/panel');
}

}
?>
<html>
<head>
<title>ExtraGeo - Inscription</title>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="ExtraGeo est un jeu multijoueur en ligne et gratuit. Défiez vos amis dans des duels dont seul vos connaissances du terrain vous aideront à vous surpasser !" />
<link rel="shortcut icon" href="/favicons.ico" />
<link rel="stylesheet" href="style2.css" type="text/css">
</head>
<body>
<div class="page-header">
<h1 class="site-name">ExtraGeo</h1>

<div class="liens">
<a href="index.php" class="btn-header">Accueil</a>
<a href="login.php" class="btn-header">Se connecter</a>
<a href="inscription.php" class="btn-header">S'inscrire</a>
 </div>
</div>
<div class="main">
<div class="box">
<h3 class="box-header">Inscription</h3>
<form class="form" method="post">
<div class="ensemble">
<?php if(isset($errors['pseudo'])) { echo'<div class="erreur"> '.$errors['pseudo'].' </div>'; } ?>
<label for="pseudo">Pseudo</label>
<input class="form-elements" type="text" name="pseudo" id="pseudo" value="<?php if(isset($pseudo)) echo $pseudo ?>">
</div>
<div class="ensemble">
<?php if(isset($errors['email'])) { echo'<div class="erreur"> '.$errors['email'].' </div>'; } ?>
<label for="email">Email</label>
<input class="form-elements" type="email" name="email" id="email" value="<?php if(isset($email)) echo $email ?>">
</div>
<div class="ensemble">
<?php if(isset($errors['mdp'])) { echo'<div class="erreur"> '.$errors['mdp'].' </div>'; } ?>
<label for="mdp">Mot de passe</label>
<input class="form-elements" type="password" name="mdp" id="mdp">
</div>
<div class="ensemble">
<label for="remdp">Confirmer Mot de passe</label>
<input class="form-elements" type="password" name="remdp" id="mdp">
</div>
<div class="ensemble">
<?php if(isset($errors['captcha'])) { echo'<div class="erreur"> '.$errors['captcha'].' </div>'; } ?>
<div class="g-recaptcha" data-sitekey="6Ld9JyUTAAAAAAvJsAw3h4COcCwgLtR5ATHD_IVS"></div>
</div>
<input type="submit" name="inscription" value="S’inscrire" class="btn-submit" id="submit">
<hr>
<a href="login.php">Tu es déjà inscris ? Connecte toi !</a>
</form>
</div>
<footer class="site-footer">
<span class="site-footer-owner">
<a href="http://topjeu.fr">ExtraGeo</a> est maintenu par <a href="https://github.com/AlphaZied" target="_blank">AlphaZied</a> &amp; <a href="https://github.com/OfficialAnti" target="_blank">OfficialAnti</a>.</span>
</footer>
</div>
<script src='https://www.google.com/recaptcha/api.js'></script>
</body>					
</html>