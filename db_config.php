<?php
session_start();
$url = "http://localhost";
date_default_timezone_set('Europe/Paris');
try{
$config = 'mysql:host=localhost;dbname=extrageo';
$utilisateur = 'root';
$pass = '';
$pdo = new PDO($config, $utilisateur, $pass, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
}
catch(Exception $e)
{
	exit('<b>Erreur trouvée à la ligne '. $e->getLine() .' :</b> '. $e->getMessage());
}
$pdo->query("SET NAMES 'utf8'");
$pdo->query("SET CHARACTER SET utf8");
$pdo->query("SET COLLATION_CONNECTION = 'utf8_unicode_ci'");

function get_ip() {
$ipaddress = '';
if (getenv('HTTP_CLIENT_IP'))
$ipaddress = getenv('HTTP_CLIENT_IP');
else if(getenv('HTTP_X_FORWARDED_FOR'))
$ipaddress = getenv('HTTP_X_FORWARDED_FOR');
else if(getenv('HTTP_X_FORWARDED'))
$ipaddress = getenv('HTTP_X_FORWARDED');
else if(getenv('HTTP_FORWARDED_FOR'))
$ipaddress = getenv('HTTP_FORWARDED_FOR');
else if(getenv('HTTP_FORWARDED'))
$ipaddress = getenv('HTTP_FORWARDED');
else if(getenv('REMOTE_ADDR'))
$ipaddress = getenv('REMOTE_ADDR');
else
$ipaddress = 'UNKNOWN';
return $ipaddress;
}

?>