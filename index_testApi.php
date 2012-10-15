<?
require 'vkapi.class.php';

$api_id = 3142907; // Insert here id of your application
$secret_key = '9b1FoGkG8u2Rtyi9mFC6'; // Insert here secret key of your application

$VK = new vkapi($api_id, $secret_key);

//$resp = $VK->api('getProfiles', array('uids'=>'7314718'));

//$resp = $VK->api('getUserSettings', array('uid'=>'7314718'));

$resp = $VK->api('wall.get', array('uids'=>'7314718'));


print_r($resp);
?>
