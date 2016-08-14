<?PHP
require_once("db_config.php");
$pseudo = $_POST['pseudo'];
$mdp = $_POST['mdp']; 
$data = array();

if(!empty($pseudo) && !empty($mdp))
{
$sql = $pdo->prepare("SELECT * FROM users WHERE pseudo = :pseudo AND mdp = :mdp LIMIT 1");
$sql->execute(array('pseudo' => $pseudo, 'mdp' => $mdp));
$row = $sql->fetch();
if(!$row)
{
$data['error'] = 'Pseudo ou mot de passe incorrect.';
}
else
{
$_SESSION['titre'] = $row['grade'];
$_SESSION['lvl'] = $row['lvl'];
}
}
else
{
$data['error'] = 'Veuillez remplir tous les champs!';
}

if(empty($data))
{
$data['success'] = true;
$temps = time();
$sql = $pdo->prepare("UPDATE users SET last_connect = :temps WHERE pseudo = :pseudo");
$sql->execute(array('pseudo' => $pseudo, 'temps' => $temps)); 
$_SESSION['pseudo'] = $pseudo;
$_SESSION['mdp'] = $mdp;
}
echo json_encode($data);
?>