<?php

http://api.vk.com/api.php?v=3.0&api_id=3142907&method=getProfiles&format=json&rnd=343&uids=100172&fields=photo%2Csex&sid=10180116c4fd93480439bca47d636d6dd75fac30b851d4312e82ec3523&sig=5be698cf7fa09d30f58b941a4aea0e9b; 
$curl = curl_init();

$params = $_GET;
$string = '';
foreach($params as $key => $value){
    $string .= $key . '=' . $value;
}

curl_setopt($curl,CURLOPT_URL, 'https://api.vk.com/method/users.get');
curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
curl_setopt($curl,CURLOPT_POST,true);
curl_setopt($curl,CURLOPT_POSTFIELDS, array_merge($params, array('sig' => md5($string))));
$resp = curl_exec($curl);
echo '<pre>';
print_r($resp);
echo '</pre>';
curl_close($curl);
