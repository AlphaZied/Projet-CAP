<?PHP
require_once("db_config.php");
?>
<div id="deco"><i class="fa fa-power-off" aria-hidden="true"></i></div>
<div id="box2_home">
	<div id="menu">
		<div class="case_profil" id="profil_j">
		<div id="pseudo_j"><?PHP echo $_SESSION['pseudo']; ?></div>
		<div id="titre_j"><?PHP echo $_SESSION['titre']; ?></div>
		<div id="xp_barre"><div id="xp_barre_in"></div></div></div>
		<div id="case_news" class="case_menu" onclick="switch_page('news');"><i class="fa fa-newspaper-o" aria-hidden="true"></i> Actualités</div>
		<div id="case_class" class="case_menu"><i class="fa fa-trophy" aria-hidden="true"></i> Classements</div>
		<div id="case_infos" class="case_menu" onclick="switch_page('infos');"><i class="fa fa-info-circle" aria-hidden="true"></i> Plus d'infos</div>
	</div>
	<div id="box3_home">
		<div id="profil_details">
			<div id="pdp"><img src="alien3.png" id="pdp2"></div>
			<div id="stats_j">
				Niveau: <?PHP echo $_SESSION['lvl']; ?><br/>
				Nombre de parties jouées: <br/>
				Score total: </br/>
				Temps de jeu total:
			</div>
		</div>
		<div id="box4_home"></div>
	</div>
</div>
<div id="terre"><div id="jouer">Jouer <i class="fa fa-angle-double-right" aria-hidden="true"></i></div></div>