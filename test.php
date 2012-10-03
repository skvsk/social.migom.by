<?php

$currentCookieParams = session_get_cookie_params(); 

$rootDomain = '.migom.by'; 

session_set_cookie_params( 
    $currentCookieParams["lifetime"], 
    $currentCookieParams["path"], 
    $rootDomain, 
    $currentCookieParams["secure"], 
    $currentCookieParams["httponly"] 
); 

session_name('mysessionname'); 
session_start(); 

setcookie($cookieName, $cookieValue, time() + 3600, '/', $rootDomain); 

$_SESSION['fff'] = 'test';
?>
