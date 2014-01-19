<?php

$db = new PDO("sqlite:db.db");
$query = $db->prepare("SELECT * FROM adresser");
$query->execute();
$data = array();


while($row = $query->fetchObject())
{
    
   // $data = array(
   //     array(
   //    'long' => "$row->long",
   //    'lat' => "$row->lat",
   //    'adresser' => "$row->adresser"
   //),
       
       
   //);
          $row_array['adresser'] = "$row->adresser";
          $row_array['long'] = "$row->long";
          $row_array['lat'] = "$row->lat"; 
    array_push($data,$row_array);
}
echo  json_encode($data);
       //$data[] = $row->long;
       //$data[] = $row->lat;
       //$data[] = $row->adresser;
       

       //$row_array['adresser'] = $row['adresser'];
?>