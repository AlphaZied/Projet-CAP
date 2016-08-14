<?PHP
require_once("db_config.php");
if(!isset($_SESSION['pseudo']))
{
header('Location: '.$url.'');
exit;
}
$id = $_GET['id'];
$reponse = $pdo->prepare('SELECT * FROM articles WHERE id = :id');
$reponse->execute(array('id' => $id));
$donnees = $reponse->fetch();
?>
<div id="retour_art" onclick="switch_page('news');"> < Retour </div>
<div id="titre2_art"><?PHP echo $donnees['titre']; ?></div>
<div id="descr2_art"><?PHP echo $donnees['description']; ?></div>
<div id="text_art"><?PHP echo $donnees['texte']; ?></div>
<div id="date2_art">Publié le <?PHP echo $donnees['date']; ?></div>
<div id="auteur2_art">par <?PHP echo $donnees['auteur']; ?></div>