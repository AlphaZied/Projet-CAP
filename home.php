<?PHP
require_once("db_config.php");
if(!isset($_SESSION['pseudo']))
{
header('Location: '.$url.'');
exit;
}
?>
<html>
<head>
		<title>ExtraGeo - Home</title>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"> 
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="description" content="ExtraGeo est un jeu multijoueur en ligne et gratuit. Défiez vos amis dans des duels dont seul vos connaissances du terrain vous aideront à vous surpasser !">
		<link rel="stylesheet" type="text/css" href="./SpecialFonts/css/font-awesome.min.css" media="all">
		<link rel="stylesheet" type="text/css" href="./SpecialFonts/css/font-awesome.css" media="all">
		<link rel="stylesheet" type="text/css" href="style_index.css" media="all">
</head>

<body id="id_body" style="overflow: visible; display: flex;">
<div id="box_home" style="display: block;">
<div id="deco">
<a class="logout" href="/logout.php">
<i class="fa fa-power-off" aria-hidden="true"></i></a>
</div>
<div id="box2_home">
<div id="menu">
<div class="case_profil" id="profil_j">
<div id="pseudo_j"><?PHP echo $_SESSION['pseudo']; ?></div>
<div id="titre_j"><?PHP echo $_SESSION['titre']; ?></div>
<div id="xp_barre">
<div id="xp_barre_in"></div>
</div>
</div>
<div id="case_news" class="case_menu" onclick="switch_page('news');" style="border-bottom-color: green;"><i class="fa fa-newspaper-o" aria-hidden="true"></i> Actualités</div>
<div id="case_class" class="case_menu" style="border-bottom-color: white;">
<i class="fa fa-trophy" aria-hidden="true"></i> Classements</div>
<div id="case_infos" class="case_menu" onclick="switch_page('infos');" style="border-bottom-color: white;">
<i class="fa fa-info-circle" aria-hidden="true"></i> Plus d'infos</div>
</div>
<div id="box3_home">
<div id="profil_details">
<div id="pdp"><img src="alien3.png" id="pdp2"></div>
<div id="stats_j">
Niveau: <?PHP echo $_SESSION['lvl']; ?><br>
Nombre de parties jouées: <br>
Score total: <br>
Temps de jeu total:
</div>
</div>
<div id="box4_home">
</div>
</div>
</div>
<div id="terre">
<div id="jouer">Jouer <i class="fa fa-angle-double-right" aria-hidden="true"></i>
</div>
</div>
</div>
<div id="scenar" style="margin-left: -100%;">
<div id="perso_alien1" style="height: 200px; background: url(&quot;alien2.png&quot;) 0% 0% / 100% 100%;"></div>
<i id="arrow" class="fa fa-caret-left" aria-hidden="true" style="margin-top: -180px;"></i>
<div id="dialogue" style="margin-top: -200px;">Vous voilà de retour agent Shamane. Quel sera votre objectif aujourd'hui ? Une série de 100 victoires peut-être ?</div>
</div>	

<footer>
<script type="text/javascript" src="script_index.js"></script>
<script type="text/javascript">
switch_page("news");
</script>
</footer>
</body>
</html>