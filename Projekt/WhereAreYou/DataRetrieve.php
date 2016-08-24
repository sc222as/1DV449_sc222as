<?php
    try {
        $db = new PDO("sqlite:data.db");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOEception $e) {
        die("Something went wrong -> " .$e->getMessage());
    }

$query = $db->prepare("SELECT * FROM Data");                                        //I denna klassen så hämtar vi samtlig data och sparar den i en Array som vi därefter
$query->execute();                                                                  //skickar vidare i JSON-Format
$data = array();
while($row = $query->fetchObject())
{
          $row_array['Name'] = "$row->Name";
          $row_array['Long'] = "$row->Long";
          $row_array['Lat'] = "$row->Lat";
          $row_array['Time'] = "$row->Time";
    array_push($data,$row_array);
}
echo  json_encode($data);

?>