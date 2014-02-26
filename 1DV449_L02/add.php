<?php

/**
* Called from AJAX to add stuff to DB
*/
function addToDB($name, $message, $pid) {
	$db = null;
	
	try {
		$db = new PDO("sqlite:db.db");
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch(PDOEception $e) {
		die("Something went wrong -> " .$e->getMessage());
	}
    //$safe_messages = mysql_real_escape_string($messages);
    //$safe_name = mysql_real_escape_string($name);                             Fungerar inte =/
    //$safe_pid = mysql_real_escape_string($pid);
    
	$q = "INSERT INTO messages (message, name, pid) VALUES(?,?,?)";                                     // Kompletering
	try {
		$sth = $db->prepare($q);
		$sth->bindParam(1, $message, PDO::PARAM_STR);
		$sth->bindParam(2, $name, PDO::PARAM_STR);
		$sth->bindParam(3, $pid, PDO::PARAM_INT);
		if (!$sth->execute()) {
			die("Fel vid insert");
		}
	}
	catch(PDOException $e) {
		die("Something went wrong -> " .$e->getMessage());
	}
}
