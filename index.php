<?PHP
require_once("db_config.php");
?>
<html>
	<head>
		<title>ExtraGeo - La géographie amusante</title>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"> 
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="description" content="ExtraGeo est un jeu multijoueur en ligne et gratuit. Défiez vos amis dans des duels dont seul vos connaissances du terrain vous aideront à vous surpasser !" />
		<link rel="stylesheet" type="text/css" href="./SpecialFonts/css/font-awesome.min.css" media="all"/>
		<link rel="stylesheet" type="text/css" href="./SpecialFonts/css/font-awesome.css" media="all"/>
		<link rel="stylesheet" type="text/css" href="style_index.css" media="all"/>
	</head>

	<body id="id_body">
		<div id="box_home">
		</div>
		<div id="scenar">
		<div id="perso_alien1"></div>
		<i id="arrow" class="fa fa-caret-left" aria-hidden="true"></i>
		<div id="dialogue"></div>
		</div>	
		<div class="error">
		<ul id="list" style="margin:0;"></ul>
		</div>
		<div class="portail" id="portail_gauche">
			<div class="ancrage" id="ancrage_gauche">
				<div id="pannel_connexion">
					<div class="main">
						<div class="box">
							<h3 class="box-header">Connexion</h3>
							<form class="form">
								<div class="ensemble">
									<label for="pseudo">Pseudo</label>
									<input class="form-elements" type="text" name="pseudo" id="pseudo">
								</div>
								<div class="ensemble">
									<label for="password">Mot de passe <b><a href="forgot.php">(Oublié ?)</a></b></label>
									<input class="form-elements" type="password" name="password" id="password">
								</div>
								<div class="ensemble">
								Rester connecté? <input type="checkbox" id="gyrus" name="remember_me" checked="checked" value="true" onclick="">
								</div>
								<div class="btn-submit" id="submit1" onclick="verif_con();">Connexion</div>
							    <div class="btn-submit" id="submit2" onclick="switch_inscr();">Toujours pas inscris ?</div>
							</form>
						</div>
					</div> 
				</div>
				<div id="pannel_inscription" style="display:none;">
					<div class="main">
						<div class="box">
							<h3 class="box-header">Inscription</h3>
							<form class="form" method="post">
								<div class="ensemble">
									<label for="pseudo">Pseudo</label>
									<input class="form-elements" type="text" name="pseudo" id="pseudo2">
								</div>
								<div class="ensemble">
									<label for="email">Email</label>
									<input class="form-elements" type="text" name="email" id="email">
								</div>
								<div class="ensemble">
									<label for="password">Mot de passe</label>
									<input class="form-elements" type="password" name="password" id="mdp">
								</div>
								<div class="ensemble">
									<label for="remdp">Confirmer Mot de passe</label>
									<input class="form-elements" type="password" name="remdp" id="mdp2">
								</div>
								<div class="ensemble">
								<div id="recaptcha"></div> 
								</div>
								<br/>
								<div class="btn-submit" id="submit" onclick="verif_inscr();">S'inscrire</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="portail" id="portail_droit">
			<div id="ancrage_porte"></div>
			<div class="ancrage" id="ancrage_droit">
				<div id="logo_terre" style="opacity:0;"></div>
			</div>
		</div>
	</body>

	<footer>
	<script type="text/javascript">	
	var sitekey = "6Ld9JyUTAAAAAAvJsAw3h4COcCwgLtR5ATHD_IVS"; // public key 
	var widgetId;
	var onloadCallback = function() {
	widgetId = grecaptcha.render('recaptcha', {
	'sitekey' : sitekey,
	'theme' : 'light'
	});
	};
	function set_pass()
	{
	var req_ajax = new XMLHttpRequest();
	var url = "/forgot.php";
	req_ajax.open("GET", url, true);
	req_ajax.send(null);
	req_ajax.onreadystatechange = function()
	{
	if(req_ajax.readyState === 4)
	{
	processAjaxData(req_ajax.responseText, url);
	}
	}
	}

	function processAjaxData(response, urlPath){
	document.open();
	document.write(response);
	document.close();
	document.title = "ExtraGeo - Mot de passe Oublié";
	window.history.pushState({"html":response,"pageTitle":"ExtraGeo - Mot de passe Oublié"},"", urlPath);
	}
    
    var link = document.querySelector('a');
    link.addEventListener("click", function(event) {
    event.preventDefault();
    set_pass();
    });
	</script>
			<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>
		<script type="text/javascript" src="script_index.js"></script>
	</footer>
</html>