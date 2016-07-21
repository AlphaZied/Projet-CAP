<?PHP
require_once("db_config.php");
$error = "";
$pseudo = $_GET['pseudo'];
$mdp = $_GET['mdp'];
$remdp = $_GET['mdp2'];
$email = $_GET['mail'];
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

if(!empty($pseudo) && !empty($email) && !empty($mdp) && !empty($remdp)){
if(strlen($pseudo) > 15)
$error = "Votre Pseudo est trop long.";

if(strlen($pseudo) <= 2)
$error = "Merci d'entrer un Pseudo.";

if($row)
$error = 'Votre pseudo est déjà utilisé.';

if($filter !== $pseudo)
$error = 'Votre Pseudo contient des caractères non autorisés.';

if($mdp !== $remdp)
$error = "Les mots de passe ne correspondent pas.";

if(strlen($mdp) < 6)
$error = "Votre mot de passe est trop court.";

if(strlen($mdp) > 20)
$error = "Votre mot de passe est trop long.";

if(strlen($email) < 6)
$error = "Merci d'entrer une adresse email valide.";

if($email_check !== 1)
$error = "Merci d'entrer une adresse email valide.";

if($row2)
$error = "L'adresse mail est déjà utilisée.";
}else{
	$error = "Veuillez remplir tous les champs!";
}

echo $error;
if(empty($error)){
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
}
?>