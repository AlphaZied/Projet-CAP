<?php
require_once("pdo.php");
if(isset($pseudo))
{
header('Location: '.$url.'/panel');
exit;
}

if(isset($_POST['login']))
{
$pseudo = $_POST['pseudo'];
$mdp = $_POST['mdp']; 

$sql = $pdo->prepare("SELECT * FROM users WHERE pseudo = :pseudo AND mdp = :mdp LIMIT 1");
$sql->execute(array('pseudo' => $pseudo, 'mdp' => $mdp));
$row = $sql->fetch();
$user = $row['pseudo'];
if(!$row)
{
$row = 0;
}
else
{
$row = 1;
}

if($row == 0)
{
$erreur['compte'] = 'Pseudo ou mot de passe incorrect.';
}

if($row == 1) //Ne jamais confondre affectaction '=' et test de condition '=='
{
if($user != $pseudo)
{
$erreur['compte'] = 'Pseudo incorrect.';
}
}

if (empty($erreur))
{
if (isset($_POST['remember_me'])) 
{ 
setcookie("remembername", $pseudo, time()+(60*60*24*30)); 
setcookie("rememberpass", $mdp, time()+(60*60*24*30)); 
}
$temps = time();
$sql = $pdo->prepare("UPDATE users SET last_connect = :temps WHERE pseudo = :pseudo");
$sql->execute(array('pseudo' => $pseudo, 'temps' => $temps)); 
$_SESSION['pseudo'] = $pseudo;
$_SESSION['mdp'] = $mdp;
header('Location: '.$url.'/panel');
}
}
?>
<html>
<head>
<title>ExtraGeo - Connexion</title>
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
<h3 class="box-header">Connexion</h3>
<form class="form" method="post">
<?php 
if(isset($erreur['compte'])) {
echo'<div class="erreur"> '.$erreur['compte'].' </div>'; 
}
?>
<div class="ensemble">
<label for="pseudo">Pseudo</label>
<input class="form-elements" type="text" name="pseudo" id="pseudo">
</div>
<div class="ensemble">
<label for="mdp">Mot de passe <b><a href="forgot.php">(Oublié ?)</a></b></label>
<input class="form-elements" type="password" name="mdp" id="mdp">
</div>
<div class="ensemble">
Rester connecté? <input type="checkbox" name="remember_me" checked="checked" value="true">
</div>
<input type="submit" name="login" value="Valider" class="btn-submit" id="submit">
</form>
</div>
<footer class="site-footer">
<span class="site-footer-owner">
<a href="http://topjeu.fr">ExtraGeo</a> est maintenu par <a href="https://github.com/AlphaZied" target="_blank">AlphaZied</a> &amp; <a href="https://github.com/OfficialAnti" target="_blank">OfficialAnti</a>.</span>
</footer>
</div>
</body>					
</html>