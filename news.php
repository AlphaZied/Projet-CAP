<?PHP
session_start();
require_once("db_config.php");
$reponse = $pdo->query('SELECT * FROM articles');
while ($donnees = $reponse->fetch()){
	$z = $donnees['id']%2;
	if($z == 0){
		$z = "rgba(0,0,0,0.3);";
	}else{
		$z = "rgba(0,0,0,0.2);";
	}
	$id = $donnees['id'];
	?>
	<div id="box_article" style="background:<?PHP echo $z; ?>" onclick="news('<?PHP echo $id;?>');">
		<div id="titre_article"><?PHP echo $donnees['titre']; ?></div>
		<div id="auteur_article">De <?PHP echo $donnees['auteur']; ?></div>
		<div id="description_article"><?PHP echo $donnees['description']; ?></div>
		<div id="date_article">Publié le <?PHP echo $donnees['date']; ?></div>
	</div>
	<?PHP
		}
$reponse->closeCursor();
?>