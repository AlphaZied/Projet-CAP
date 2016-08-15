var i = 0; // compteur
var inter; // contient l'interval de temps (setInterval)
var caract; // contient les caractères du message qui se veut d'avoir l'effet parole
var req_ajax = new XMLHttpRequest();
var dida = false;
var count_scenar = 0;

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

parole_alien();

// Ouverture du portail en 4 étapes
function open_portail(pseudo){
	clearInterval(inter);
	i=0;
	$("dialogue").innerHTML = "<br/>";
	speak_initialisation("Mes respects "+pseudo+" !", "dialogue");
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
	setTimeout(open_p5, 1500);
}

function open_p5(){
	set_home();
	$('portail_droit').style.display = "none";
	$('portail_gauche').style.display = "none";
	$('id_body').style.overflow = "visible";
	$('id_body').style.display = "flex";
}

function switch_inscr(){
	$('ancrage_droit').style.height = "550px";
	$('ancrage_gauche').style.height = "550px";
	$('ancrage_droit').style.top = "-200%";
	$('ancrage_gauche').style.top = "-200%";
	setTimeout("$('pannel_connexion').style.display = 'none';", 500);
	setTimeout("$('pannel_inscription').style.display = 'block';", 500);
	switch_perso();
	setTimeout("$('ancrage_droit').style.opacity = '0';", 0);
	setTimeout("$('ancrage_gauche').style.opacity = '0';", 0);
	setTimeout("$('ancrage_droit').style.top = '500%';", 1500);
	setTimeout("$('ancrage_gauche').style.top = '500%';", 1500);
	setTimeout("$('ancrage_droit').style.opacity = '1';", 2000);
	setTimeout("$('ancrage_gauche').style.opacity = '1';", 2000);
	setTimeout("$('ancrage_droit').style.top = '57%';", 2000);
	setTimeout("$('ancrage_gauche').style.top = '57%';", 2000);
	speak_initialisation("Ah! Une nouvelle recrue! Dépêche-toi de remplir ce petit formulaire, l'invasion n'attend pas !", "dialogue");
}

function switch_perso(){
	$('scenar').style.marginLeft = "-100%";
	$('perso_alien1').style.background = "url('alien2.png')";
	$('perso_alien1').style.backgroundSize = "100% 100%";
	$('perso_alien1').style.height = "200px";
	$("dialogue").style.marginTop = "-200px";
	$("arrow").style.marginTop = "-180px";
	setTimeout("$('scenar').style.marginLeft = '0%';", 500);
	clearInterval(inter);
	i=0;
	$("dialogue").innerHTML = "";
}

function disap_perso(){
	$('scenar').style.marginLeft = "-100%";
	$('scenar').display = "none";
}

//Instance d'une parole de l'alien
function parole_alien(){
speak_initialisation("Veuillez soummettre votre identité afin que je puisse vous laisser entrer dans le portail du projet Invasion.", "dialogue");
}

function verif_con()
{
	var ajax_con = new XMLHttpRequest();
	var pseudo = $('pseudo').value;
	var mdp = $('password').value;
	
	var data = new FormData();
	ajax_con.open('POST', '/controle_connexion.php', true);
	data.append('pseudo', pseudo);
	data.append('mdp', mdp);
	ajax_con.send(data);
	ajax_con.onreadystatechange = function()
	{
	if(ajax_con.readyState === 4)
	{
	var results = JSON.parse(ajax_con.responseText);
	if(!results.success)
	{
	clearInterval(inter);
	i=0;
	$("dialogue").innerHTML = "<br/>";
	speak_initialisation(results.error, "dialogue");
	$('ancrage_gauche').style.boxShadow = '0px 0px 50px 5px red';
	$('ancrage_droit').style.boxShadow = '0px 0px 50px 5px red';
	setTimeout("$('ancrage_droit').style.boxShadow = '0 0 0 0';", 400);
	setTimeout("$('ancrage_gauche').style.boxShadow = '0 0 0 0';", 400);
	}
	else
	{
	open_portail(pseudo);
	switch_perso();
	speak_initialisation("Vous voilà de retour agent "+pseudo+". Quel sera votre objectif aujourd'hui ? Une série de 100 victoires peut-être ?", "dialogue");
	setTimeout(disap_perso, 5000);
	}
	}
	}
}

function verif_inscr(){
	var pseudo = $('pseudo2').value;
	var mail = $('email').value;
	var mdp = $('mdp').value;
	var mdp2 = $('mdp2').value;
	var data = new FormData();
	req_ajax.open('POST', '/controle_inscription.php', true);
	data.append('pseudo', pseudo);
	data.append('mail', mail);
	data.append('mdp', mdp);
	data.append('mdp2', mdp2);
	data.append('g-recaptcha-response', grecaptcha.getResponse(widgetId));
	req_ajax.send(data);
	req_ajax.onreadystatechange = function()
	{
	if(req_ajax.readyState === 4)
	{
	var results = JSON.parse(req_ajax.responseText);
	if(!results.success)
	{
		var error = document.querySelector('.error');
		var list = document.querySelector('#list');
		list.innerHTML = '';
		grecaptcha.reset(widgetId);
		if(results.pseudo)
		{
		var node = document.createElement("LI");
		var textnode = document.createTextNode(results.pseudo); 
		node.appendChild(textnode);
		list.appendChild(node);  
		error.style.display = 'block';
		}

		if(results.email)
		{
		var node = document.createElement("LI"); 
		var textnode = document.createTextNode(results.email); 
		node.appendChild(textnode);
		list.appendChild(node); 
		error.style.display = 'block';
		}

		if(results.mdp)
		{
		var node = document.createElement("LI"); 
		var textnode = document.createTextNode(results.mdp); 
		node.appendChild(textnode);
		list.appendChild(node);  
		error.style.display = 'block';
		}

		if(results.captcha)
		{
		var node = document.createElement("LI"); 
		var textnode = document.createTextNode(results.captcha); 
		node.appendChild(textnode);
		list.appendChild(node);  
		error.style.display = 'block';
		}

		clearInterval(inter);
		i=0;
		$("dialogue").innerHTML = "<br/>";
		
		if(results.champ)
		speak_initialisation("N'oublie pas de remplir tous les champs vides !", "dialogue");
		else
		speak_initialisation("Soldat ! Fais un peu attention le formulaire contient des erreurs !", "dialogue");

		$('ancrage_gauche').style.boxShadow = '0px 0px 50px 5px red';
		$('ancrage_droit').style.boxShadow = '0px 0px 50px 5px red';
		setTimeout("$('ancrage_droit').style.boxShadow = '0 0 0 0';", 400);
		setTimeout("$('ancrage_gauche').style.boxShadow = '0 0 0 0';", 400);
	}
	else
	{
		var error = document.querySelector('.error');
		error.style.display = "none";
		open_portail(pseudo);
		setTimeout(didactiel, 4000);
	}
	}
	}
}

function set_home()
{
var url = "/home.php";
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
document.title = "ExtraGeo - Home";
window.history.pushState({"html":response,"pageTitle":"ExtraGeo - Home"},"", urlPath);
}

function didactiel(){
	$('scenar').innerHTML += "<div id='next_scenar' onclick='pass_scenar();'><i class='fa fa-angle-double-right' aria-hidden='true'></i></div>";
	dida = true;
	switch_perso();
	clearInterval(inter);
	i=0;
	speak_initialisation("Bienvenue petit! La situation est simple. Afin d'envahir la planète B8-RT65, plus communément appelée la Terre,", "dialogue");
}

function pass_scenar(){
	if(dida == true){
	$("dialogue").innerHTML = "";
	clearInterval(inter);
	i=0;
	if(count_scenar == 0){
	speak_initialisation("Nous devons connaitre le fonctionnement géographique des humains, en apprendre le plus possible sur leur histoire et leur organisation.", "dialogue");
	}
	if(count_scenar == 1){
	speak_initialisation("Nous sommes ici dans le quartier où toutes sortes d'informations vous ai données afin de vous permettre d'évoluer le plus rapidement possible.", "dialogue");
	}
	if(count_scenar == 2){
	speak_initialisation("Mais plus important encore, dans ce quartier général vous trouverez le portail vers le simulateur inter-neuronal qui testera vos connaissances sur la géographie terrestre.", "dialogue");
	}
	if(count_scenar == 3){
	speak_initialisation("Tout est claire ? Ne perdons pas de temps, commencez par tester le simulateur. En éspérant que vous n'êtes pas trop nul.", "dialogue");
	}
	if(count_scenar == 4){
		disap_perso();
	}
	count_scenar++;
	}
}

function switch_page(page){
	if(page == "news"){
		$('case_news').style.borderBottomColor = "green";
		$('case_class').style.borderBottomColor = "white";
		$('case_infos').style.borderBottomColor = "white";
		var url = "news.php";
		req_ajax.open("GET", url, true);
		req_ajax.send(null);
		req_ajax.onreadystatechange = function()
		{
		if(req_ajax.readyState === 4)
		$('box4_home').innerHTML = req_ajax.responseText;
		}
	}
	if(page == "infos"){
		$('case_news').style.borderBottomColor = "white";
		$('case_class').style.borderBottomColor = "white";
		$('case_infos').style.borderBottomColor = "green";
		$('box4_home').innerHTML = "<div id='copyrights'>Copyright © 2016 ExtraGeo Inc. Tous droits réservés. Vos droits sur ce site sont régis par les conditions d'utilisations qui l'accompagnent, il est interdit de reproduire le site, même partiellement à des fins commerciales ou non. Le jeu est actuellement en version 0.1.8. Une production signée ZM & RS.</div>";
	}
}

function news(article){
	var url = "news_more.php?id="+article;
	req_ajax.open("GET", url, true);
	req_ajax.send(null);
	req_ajax.onreadystatechange = function()
	{
	if(req_ajax.readyState === 4)
	$('box4_home').innerHTML = req_ajax.responseText;
	}
}