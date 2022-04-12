<?php


if(isset($_POST["submit"])) {
	
	$username = $_POST["name"];
	$pwd = $_POST["pwd"];
	
	
	require_once '/var/www/inf4/KrasevecM/dbh.inc.php';
	require_once '/var/www/inf4/KrasevecM/functions.inc.php'; 
	
	
	if (emptyInputLogin($username, $pwd) !== false) {
		header("location: login.php?error=emptyinput");
		exit();
	}
	
	loginUser($conn, $username, $pwd);
}

else {
	header("location: index.php");
	exit();
}