<?php 

header(""); 
$url = "http://api.sr.se/api/v2/traffic/messages?format=json&pagination=false&indent=true&size=100";

$data = file_get_contents($url);

echo $data;
?>