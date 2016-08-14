<?PHP
session_start();
include "db_config.php";
$pseudo = $_GET['pseudo'];
$mdp = $_GET['mdp']; 
$erreur = "";

if(!empty($pseudo) && !empty($mdp)){
	$sql = $pdo->prepare("SELECT * FROM users WHERE pseudo = :pseudo AND mdp = :mdp LIMIT 1");
	$sql->execute(array('pseudo' => $pseudo, 'mdp' => $mdp));
	$row = $sql->fetch();
	if(!$row){
		$erreur = 'Pseudo ou mot de passe incorrect.';
	}else{
		$_SESSION['titre'] = $row['grade'];
		$_SESSION['lvl'] = $row['lvl'];
	}
}
else{
	$erreur = 'Veuillez remplir tous les champs!';
}

echo $erreur;

if(empty($erreur)){
$temps = time();
$sql = $pdo->prepare("UPDATE users SET last_connect = :temps WHERE pseudo = :pseudo");
$sql->execute(array('pseudo' => $pseudo, 'temps' => $temps)); 
$_SESSION['pseudo'] = $pseudo;
$_SESSION['mdp'] = $mdp;
}
?>