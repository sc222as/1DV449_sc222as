<?php

$db = new PDO("sqlite:db.db");
$query = $db->prepare("SELECT * FROM adresser");
$query->execute();
$data = array();


while($row = $query->fetchObject())
{

          $row_array['adresser'] = "$row->adresser";
          $row_array['long'] = "$row->long";
          $row_array['lat'] = "$row->lat"; 
    array_push($data,$row_array);
}
//$db = new PDO("sqlite:db2.db");
//$query = $db->prepare("SELECT * FROM elpris");
//$query->execute();
//while($row = $query->fetchObject())                                               //Nog ingen bra lösning
//{
//    $row_array['leverantor'] = "$row->leverantor";
//    $row_array['pris'] = "$row->pris";
    
//    array_push($data,$row_array);
//}




echo  json_encode($data);

?>