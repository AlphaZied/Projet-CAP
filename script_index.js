var i = 0; // compteur
var inter; // contient l'interval de temps (setInterval)
var caract; // contient les caractères du message qui se veut d'avoir l'effet parole
var req_ajax_con = new XMLHttpRequest();

// Module permettant l'effet parole de l'alien
function speak_initialisation(mess, content){
	caract = mess.split("");
	inter = setInterval(speak, 20, mess, content);
}
function speak(mess, content){
	$(content).innerHTML += caract[i];
	i++;
	if(i == caract.length){clearInterval(inter);i=0;}
}

// Raccourci
function $(doc){
	return document.getElementById(doc);
}

// Ouverture du portail en 4 étapes
function open_portail(){
	clearInterval(inter);
	i=0;
	$("dialogue").innerHTML = "<br/>";
	speak_initialisation("Bienvenue *pseudo* !", "dialogue");
	$('pannel_connexion').style.opacity = "0";
	$('pannel_inscription').style.opacity = "0";
	setTimeout("$('ancrage_droit').style.zIndex = '9999';", 500);
	setTimeout(open_p2, 300);
}
function open_p2(){
	$('ancrage_droit').style.height = "395px";
	$('ancrage_gauche').style.height = "395px";
	$('ancrage_droit').style.borderBottomRightRadius = "200px";
	$('ancrage_gauche').style.borderBottomLeftRadius = "200px";
	$('ancrage_droit').style.borderTopRightRadius = "200px";
	$('ancrage_gauche').style.borderTopLeftRadius = "200px";
	$('logo_terre').style.opacity = "1";
	setTimeout(open_p3, 1000);
}
function open_p3(){
	$('logo_terre').style.transform = "rotate(500deg)";
	setTimeout(open_p4, 500);
}
function open_p4(){
	$('portail_droit').style.marginRight = "-100%";
	$('portail_gauche').style.marginLeft = "-100%";
	setTimeout(open_p5, 3000);
}

function open_p5(){
	$('portail_droit').style.display = "none";
	$('portail_gauche').style.display = "none";
}

function switch_inscr(){
	$('ancrage_droit').style.height = "455px";
	$('ancrage_gauche').style.height = "455px";
	$('ancrage_droit').style.top = "-200%";
	$('ancrage_gauche').style.top = "-200%";
	setTimeout("$('pannel_connexion').style.display = 'none';", 500);
	setTimeout("$('pannel_inscription').style.display = 'block';", 500);
	$('scenar').style.marginLeft = "-100%";
	$('perso_alien1').style.background = "url('alien2.png')";
	$('perso_alien1').style.backgroundSize = "100% 100%";
	$('perso_alien1').style.height = "200px";
	$("dialogue").style.marginTop = "-200px";
	$("arrow").style.marginTop = "-180px";
	setTimeout("$('scenar').style.marginLeft = '0%';", 1000);
	setTimeout("$('ancrage_droit').style.opacity = '0';", 0);
	setTimeout("$('ancrage_gauche').style.opacity = '0';", 0);
	setTimeout("$('ancrage_droit').style.top = '500%';", 1500);
	setTimeout("$('ancrage_gauche').style.top = '500%';", 1500);
	setTimeout("$('ancrage_droit').style.opacity = '1';", 2000);
	setTimeout("$('ancrage_gauche').style.opacity = '1';", 2000);
	setTimeout("$('ancrage_droit').style.top = '50%';", 2000);
	setTimeout("$('ancrage_gauche').style.top = '50%';", 2000);
	clearInterval(inter);
	i=0;
	$("dialogue").innerHTML = "";
	speak_initialisation("Ah! Une nouvelle recrue! Dépêche-toi de remplir ce petit formulaire, l'invasion n'attend pas !", "dialogue");
}

//Instance d'une parole de l'alien
speak_initialisation("Veuillez soummettre votre identité afin que je puisse vous laisser entrer dans le portail du projet Invasion.", "dialogue");
var req_ajax = new XMLHttpRequest();

function verif_con(){
	var pseudo = $('pseudo').value;
	var mdp = $('password').value;
	var url = "controle_connexion.php?pseudo="+pseudo+"&mdp="+mdp;
	req_ajax.open("GET", url, false);
	req_ajax.send(null);
	if(req_ajax.responseText != ''){
		clearInterval(inter);
		i=0;
		$("dialogue").innerHTML = "<br/>";
		speak_initialisation(req_ajax.responseText, "dialogue");
		$('ancrage_gauche').style.boxShadow = '0px 0px 50px 5px red';
		$('ancrage_droit').style.boxShadow = '0px 0px 50px 5px red';
		setTimeout("$('ancrage_droit').style.boxShadow = '0 0 0 0';", 400);
		setTimeout("$('ancrage_gauche').style.boxShadow = '0 0 0 0';", 400);
	}else{
		open_portail();
	}
}

function verif_inscr(){
	var pseudo = $('pseudo2').value;
	var mail = $('email2').value;
	var mdp = $('mdp').value;
	var mdp2 = $('mdp2').value;
	var url = "controle_inscription.php?pseudo="+pseudo+"&mdp="+mdp+"&mdp2="+mdp2+"&mail="+mail;
	req_ajax.open("GET", url, false);
	req_ajax.send(null);
	if(req_ajax.responseText != ''){
		clearInterval(inter);
		i=0;
		$("dialogue").innerHTML = "<br/>";
		speak_initialisation(req_ajax.responseText, "dialogue");
		$('ancrage_gauche').style.boxShadow = '0px 0px 50px 5px red';
		$('ancrage_droit').style.boxShadow = '0px 0px 50px 5px red';
		setTimeout("$('ancrage_droit').style.boxShadow = '0 0 0 0';", 400);
		setTimeout("$('ancrage_gauche').style.boxShadow = '0 0 0 0';", 400);
	}else{
		open_portail();
	}
}