<?php

$db = new PDO("sqlite:db2.db");
$query = $db->prepare("SELECT * FROM elpris");
$query->execute();
$data = array();


while($row = $query->fetchObject())
{
          $row_array['leverantor'] = "$row->leverantor";
          $row_array['pris'] = "$row->pris";
          
    array_push($data,$row_array);
}
echo  json_encode($data);

?>