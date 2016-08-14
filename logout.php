<?PHP
require_once('db_config.php');
if(isset($_COOKIE['remembername']) && isset($_COOKIE['rememberpass'])) 
{
setcookie("remembername", '', time()-(60*60*24*30)); 
setcookie("rememberpass", '', time()-(60*60*24*30)); 
}
session_destroy();
header('Location: '.$url.'');
exit;
?>