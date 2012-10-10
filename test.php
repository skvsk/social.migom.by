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
$sess_save_path = 'tcp://178.172.181.139:11211';
$sess_session_name = 'PHPSESSID';

$memcache = new Memcache;
$memcache->connect('178.172.181.139', 11211) or die("Could not connect");

function open($save_path, $session_name)
{
    global $sess_save_path, $sess_session_name, $memcache;

    $sess_save_path = $save_path;
    $sess_session_name = $session_name;
    return(true);
}

function close()
{
    return(true);
}

function read($id)
{
    global $sess_save_path, $sess_session_name, $memcache;
    if(!$memcache){
        $memcache = new Memcache;
        $memcache->connect('178.172.181.139', 11211) or die("Could not connect");
    }
    if ($fp = $memcache->get($id)) {
        return($fp);
    } else {
        return(""); // Здесь обязана возвращать "".
    }
//    $sess_file = "$sess_save_path/sess_$id";
//    if ($fp = @fopen($sess_file, "r")) {
//        $sess_data = fread($fp, filesize($sess_file));
//        return($sess_data);
//    } else {
//        return(""); // Здесь обязана возвращать "".
//    }
}

function write($id, $sess_data)
{
    global $sess_save_path, $sess_session_name, $memcache;
    if(!$memcache){
        $memcache = new Memcache;
        $memcache->connect('178.172.181.139', 11211) or die("Could not connect");
    }
    return memcache_set($memcache, $id, $sess_data, 0, 30);
    
//    $sess_file = "$sess_save_path/sess_$id";
//    if ($fp = @fopen($sess_file, "w")) {
//        return(fwrite($fp, $sess_data));
//    } else {
//        return(false);
//    }
}

function destroy($id)
{
    global $sess_save_path, $sess_session_name, $memcache;

//    $sess_file = "$sess_save_path/sess_$id";
    return(memcache_delete($memcache, $id));
}

/* * *****************************************************************
 * ПРЕДУПРЕЖДЕНИЕ - Вам понадобится реализовать здесь какой-нибудь *
 * вариант утилиты уборки мусора.*
 * ***************************************************************** */

function gc($maxlifetime)
{
    return true;
}

session_set_save_handler("open", "close", "read", "write", "destroy", "gc");





session_start();
echo '<br/>session_id - ' . session_id();
echo "<br/>session body - " . $memcache->get(session_id());
echo "<pre>";
//var_dump($_SESSION);
//$_SESSION['test3'] = 'test32';
var_dump($_SESSION);
echo "</pre>";

//echo "memcache test <br/>";
//memcache_set($memcache, 'test', 'It is work - update', 0, 60 * 5);
//
//var_dump($memcache->get('test'));


?>
