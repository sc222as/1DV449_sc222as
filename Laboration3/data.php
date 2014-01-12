<?php 

header('Access-Control-Allow-Origin: *');
$url = "http://api.sr.se/api/v2/traffic/messages?format=json&pagination=false&indent=true";

$data = file_get_contents($url);

echo $data;
?>