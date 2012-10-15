<?php

$curl = curl_init();

$params = $_GET;
$string = '';
asort($params);
foreach($params as $key => $value){
    $string .= $key . '=' . $value;
}

curl_setopt($curl,CURLOPT_URL, 'http://api.vk.com/api.php');
curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
curl_setopt($curl,CURLOPT_POST,true);
curl_setopt($curl,CURLOPT_POSTFIELDS, array_merge($params, array('sig' => md5($string))));
$resp = curl_exec($curl);
echo '<pre>';
print_r($resp);
echo '</pre>';
curl_close($curl);
