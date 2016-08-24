<?php   
    date_default_timezone_set("Europe/Paris");                                                //Sätter tidszonen
    $name = ($_POST['name']);
    $long = ($_POST['long']);
    $lat = ($_POST['lat']);
    $time = date('m/d/Y h:i:s');
    $db = null;
	                                                                                            //Förbereder databasen
    try {
        $db = new PDO("sqlite:data.db");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOEception $e) {                                                                   //Felhantering
        die("Something went wrong -> " .$e->getMessage());
    }
    $q = "INSERT INTO Data VALUES ( '$name', '$long', '$lat', '$time' )";
	
  
    if (preg_match("/^\w+( +\w+){0,50}$/", $_POST['name'], $matches)){                        //Regular expression för att skydda mot SQLInjection
    }
    else{
     echo "Please stay between 0 and 50 chars and refrain from using anything but alphabetic, numeric, or the space character. ";
     die();
    }
    try {
        if(!$db->query($q)) {                                                                 
            die("Fel vid insert");                                                            //Felhantering
        }
    }
    catch(PDOException $e) {
        die("Something went wrong -> " .$e->getMessage());
    }
    header("Location: https://wpprojekt.se/WhereAreYou/Map.html");                            //Redirect till kartan
    die();
    
    


?>