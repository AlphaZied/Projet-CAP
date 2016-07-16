var i = 0; // compteur
var inter; // contient l'interval de temps (setInterval)
var caract; // contient les caractères du message qui se veut d'avoir l'effet parole

// Module permettant l'effet parole de l'alien
function speak_initialisation(mess, content){
	caract = mess.split("");
	inter = setInterval(speak, 50, mess, content);
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
}

function switch_inscr(){
	$('ancrage_droit').style.top = "-200%";
	$('ancrage_gauche').style.top = "-200%";
	$('pannel_connexion').style.display = "none";
	$('pannel_inscription').style.display = "block";
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