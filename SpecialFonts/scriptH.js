document.getElementById('point1_h').onclick = function(){
	NextChapt('1');
}

function NextChapt(wh){
document.getElementById('bod').style.background = "url('H"+wh+".jpg')";
document.getElementById('bod').style.backgroundSize = "100% 100%";
}

var requete_ajax = new XMLHttpRequest();
requete_ajax.open('GET', 'http://localhost:8888/histoire/preamb.php', false);
requete_ajax.send(null);
document.getElementById('box_preamb').innerHTML = requete_ajax.responseText;

function appear(nb){
	larg_fen = document.body.clientWidth;
	if(larg_fen < 1025){
		new_larg1 = 16 - (3000 / larg_fen);
		document.getElementById('bodi').style.fontSize = new_larg1+"px";
	}else{document.getElementById('bodi').style.fontSize = "16px";}
	var doc = "plus_info2";
	var marg_l = 10 * nb;
	document.getElementById(doc).style.display = "block";
	document.getElementById(doc).style.marginLeft = marg_l+"%";
	document.getElementById(doc).style.height = "100%";
if(nb == 0){
	document.getElementById('head1').innerHTML = "820";
	document.getElementById('bodi').innerHTML = "Al-Khwarizmi";
}
if(nb == 1){
	document.getElementById('head1').innerHTML = "1840";
	document.getElementById('bodi').innerHTML = "Ada Lovelace";
}
if(nb == 2){
	document.getElementById('head1').innerHTML = "1854";
	document.getElementById('bodi').innerHTML = "Boole";
}
if(nb == 3){
	document.getElementById('head1').innerHTML = "1950";
	document.getElementById('bodi').innerHTML = "Assembleur";
}
if(nb == 4){
	document.getElementById('head1').innerHTML = "1951";
	document.getElementById('bodi').innerHTML = "Compilateur";
}
if(nb == 5){
	document.getElementById('head1').innerHTML = "1957";
	document.getElementById('bodi').innerHTML = "FORTRAN";
}
if(nb == 6){
	document.getElementById('head1').innerHTML = "1971-1973";
	document.getElementById('bodi').innerHTML = "Langage C";
}
if(nb == 7){
	document.getElementById('head1').innerHTML = "1972";
	document.getElementById('bodi').innerHTML = "POO";
}
if(nb == 8){
	document.getElementById('head1').innerHTML = "1983";
	document.getElementById('bodi').innerHTML = "Langage C++";
}
}

function disapear(){
	document.getElementById("plus_info2").style.display = "none";
	document.getElementById('head1').innerHTML = "";
	document.getElementById('bodi').innerHTML = "";
}

window.onload = function(){adapt("box_preamb", 18);}
window.onresize = function(){adapt("box_preamb", 18);}

function help(){
	document.getElementById('aide_text').style.display="block";
	document.getElementById('aide_text').style.width = "40%";
	setTimeout("document.getElementById('aide_text').style.color = 'white'", 200);
}

function helpOut(){
	document.getElementById('aide_text').style.display="none";
	document.getElementById('aide_text').style.width = "0%";
	setTimeout("document.getElementById('aide_text').style.color = 'transparent'", 0);
}