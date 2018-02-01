<?php   
ini_set('display_startup_errors',1);
ini_set('display_errors',1);
error_reporting(E_ALL);

session_start(); //to ensure you are using same session
session_destroy(); //destroy the session
$_SESSION = array();
header ("Location: index.php");
exit();
?>