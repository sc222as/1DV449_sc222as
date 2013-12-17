<?php
require_once("sec.php");

// check tha POST parameters
$u = $_POST['username'];
$p = $_POST['password'];
$hash1 = md5($u);
$hash2 = md5($p);
$hash3 = ($hash1 . $hash2);
$newpassword = md5($hash3);

// Check if user is OK
if(isUser($u, $newpassword)) {
	// set the session
	sec_session_start();
	$_SESSION['login_string'] = hash('sha512', "Come_On_You_Spurs" +$u); 
	$_SESSION['user'] = $u;
	header("Location: mess.php");
}
else {
	// To bad
	header('HTTP/1.1 401 Unauthorized');
}
