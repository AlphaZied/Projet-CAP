<html>
	<head>
		<link rel="stylesheet" type="text/css" href="./SpecialFonts/css/font-awesome.min.css" media="all"/>
		<link rel="stylesheet" type="text/css" href="./SpecialFonts/css/font-awesome.css" media="all"/>
		<link rel="stylesheet" type="text/css" href="style_index.css" media="all"/>
	</head>

	<body>
		<div id="scenar"><div id="perso_alien1"></div><i id="arrow" class="fa fa-caret-left" aria-hidden="true"></i><div id="dialogue"></div></div>	
		<div id="erreur_sql" onclick="disp_erreur();">
		<i class="fa fa-exclamation-circle" aria-hidden="true" style="float:left;font-size:20px;"></i>
		<span id="erreur_sql2"></span>
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
								<div class="btn-submit" id="submit" onclick="verif_con();">Connexion</div>
							    <div class="btn-submit" id="submit" style="margin-top:10px;background-color: #19668a;border-color: #09354d;" onclick="switch_inscr();">Toujours pas inscris ?</div>
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
									<input class="form-elements" type="text" name="email" id="email2">
								</div>
								<div class="ensemble">
									<label for="password">Mot de passe</label>
									<input class="form-elements" type="password" name="password" id="mdp">
								</div>
								<div class="ensemble">
									<label for="remdp">Confirmer Mot de passe</label>
									<input class="form-elements" type="password" name="remdp" id="mdp2">
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
		<script type="text/javascript" src="script_index.js"></script>
	</footer>
</html>