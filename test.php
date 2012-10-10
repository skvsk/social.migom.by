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
echo 'session_id - ' . session_id();
echo "<pre>";
var_dump($_SESSION);
//$_SESSION['test3'] = 'test32';
var_dump($_SESSION);
echo "</pre>";
echo "memcache test <br/>";
$memcache = new Memcache;
$memcache->connect('178.172.181.139', 11211) or die ("Could not connect");
//memcache_set($memcache, 'test', 'It is work', 0, 60*5);

var_dump($memcache->get('test'));
?>