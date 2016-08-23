<?php    
    $name = ($_POST['name']);
    $long = ($_POST['long']);
    $lat = ($_POST['lat']);
    $time = date('m/d/Y h:i:s');
    $db = null;
	
    try {
        $db = new PDO("sqlite:data.db");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOEception $e) {
        die("Something went wrong -> " .$e->getMessage());
    }
    $q = "INSERT INTO Data VALUES ( '$name', '$long', '$lat', '$time' )";
	
    try {
        if(!$db->query($q)) {
            die("Fel vid insert");
        }
    }
    catch(PDOException $e) {
        die("Something went wrong -> " .$e->getMessage());
    }
    header("Location: http://127.0.0.1:8080/WhereAreYou/");
    die();
    
    


?>