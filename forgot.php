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
    <style>
    .ancrage
    {
    height : 340px;
    }
    </style>
  </head>

    <body id="id_body">
    <div id="scenar">
    <div id="perso_alien1"></div>
    <i id="arrow" class="fa fa-caret-left" aria-hidden="true"></i>
    <div id="dialogue"></div>
    </div>  
    <div class="error">
    <ul id="list" style="margin:0;"></ul>
    </div>
    <div class="success">
    <ul id="info" style="margin:0;"></ul>
    </div>
    <div class="portail" id="portail_gauche">
    <div class="ancrage" id="ancrage_gauche">
    <div id="pannel_inscription">
    <div class="main">
    <div class="box">
    <div class="return" style="position: absolute;"><a href="/index.php">Retourner</a></div>
    <h3 class="box-header">Mot de passe oublié?</h3>
    <form class="form" method="post">
    <div class="ensemble">
    <label for="email">Email</label>
    <input class="form-elements" type="text" name="email" id="email">
    </div>
    <div class="ensemble">
    <div id="recaptcha"></div> 
    </div>
    <div class="btn-submit" id="submit">Valider</div>
    <div class="load">Chargement...</div>
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
<script type="text/javascript">
var sitekey = "6Ld9JyUTAAAAAAvJsAw3h4COcCwgLtR5ATHD_IVS"; // public key 
var widgetId;
var onloadCallback = function() {
widgetId = grecaptcha.render('recaptcha', {
'sitekey' : sitekey,
'theme' : 'light'
});
};
</script>
<footer>
<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>
<script type="text/javascript" src="script_index.js"></script>
<script>
switch_perso();
speak_initialisation("Un bon soldat, est un soldat qui a une bonne mémoire ! Je te pardonne cette fois-ci mais fait attention la prochaine fois !", "dialogue");

function getParameterByName(name, url) {
if (!url) url = window.location.href;
name = name.replace(/[\[\]]/g, "\\$&");
var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
results = regex.exec(url);
if (!results) return null;
if (!results[2]) return '';
return decodeURIComponent(results[2].replace(/\+/g, " "));
}
var key = getParameterByName('key');
if(key)
{
console.log(key);
var getxhr = new XMLHttpRequest();
getxhr.open('GET', '/forgot_check.php?key='+key, true);
getxhr.send(null);
getxhr.onreadystatechange = function()
{
if(getxhr.readyState === 4)
{
var results = JSON.parse(getxhr.responseText);
if(results.change)
alert('Magnifique');
if(results.errors)
alert(results.errors);
}
}
}

var submit = document.querySelector("#submit");
submit.addEventListener("click", function(event){
event.preventDefault();
var xhr = new XMLHttpRequest();
var data = new FormData();
var email = $('email').value;
xhr.open('POST', '/forgot_check.php', true);
data.append('email', email);
data.append('submit', true);
data.append('g-recaptcha-response', grecaptcha.getResponse(widgetId));
xhr.send(data);
submit.style.display = "none";
var load = document.querySelector('.load');
load.style.display = "block";
xhr.onreadystatechange = function()
{
if(xhr.readyState === 4)
{
submit.style.display = "block";
load.style.display = "none";
var results = JSON.parse(xhr.responseText);
var error = document.querySelector('.error');
var success = document.querySelector('.success');
var list = document.querySelector('#list');
var list_success = document.querySelector('#info');

list.innerHTML = '';
list_success.innerHTML = '';
if(results.success)
{
error.style.display = "none";
var node = document.createElement("LI");
var textnode = document.createTextNode(results.success); 
node.appendChild(textnode);
list.appendChild(node);  
error.style.display = 'block';
}
if(results.errors)
{
success.style.display = 'none';
var node = document.createElement("LI");
var textnode = document.createTextNode(results.errors); 
node.appendChild(textnode);
list.appendChild(node);  
error.style.display = 'block';
}

grecaptcha.reset(widgetId);
}
}
});
</script>

</footer>
</html>