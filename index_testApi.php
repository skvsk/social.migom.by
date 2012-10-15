<?
require 'vkapi.class.php';

$api_id = 3142907; // Insert here id of your application
$secret_key = '9b1FoGkG8u2Rtyi9mFC6'; // Insert here secret key of your application

$VK = new vkapi($api_id, $secret_key);

//$resp = $VK->api('getProfiles', array('uids'=>'7314718'));

$resp = $VK->api('wall.post', array('owner_id'=>'7314718', 'message' => 'Тестовый пост с сайта social.migom.by'));


print_r($resp);
?>
