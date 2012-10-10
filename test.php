<?php
//phpinfo();
//die;
$currentCookieParams = session_get_cookie_params(); 

$rootDomain = '.migom.by'; 

session_set_cookie_params( 
    $currentCookieParams["lifetime"], 
    $currentCookieParams["path"], 
    $rootDomain, 
    $currentCookieParams["secure"], 
    $currentCookieParams["httponly"] 
); 

session_start(); 
echo "<pre>";
var_dump($_SESSION);
//$_SESSION['test3'] = 'test32';
var_dump($_SESSION);
echo "</pre>";
?>