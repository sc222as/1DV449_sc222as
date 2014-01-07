<!DOCTYPE html>
<html lang="sv">
  <head>
  
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> </head>
<?php
$db = new PDO("sqlite:db.db");
$query = $db->prepare("SELECT * FROM scraped");
$query->execute();

while($row = $query->fetchObject())
{

    
    echo "Namn: ".$row->namn ." <br /> ". "Producent ID: ".$row->id ." <br /> ". "Hemsida: ".$row->hemsida ." <br /> ". "Ort: ".$row->stad ." <br /> "."===========================================" ." <br /> ";
}


?>
</html>
