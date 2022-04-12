<?php


if(isset($_POST["submit"])) {
	
	$username = $_POST["uid"];
	$pwd = $_POST["pwd"];
	$pwdRepeat = $_POST["pwdrepeat"];
	
	require_once '/var/www/inf4/KrasevecM/dbh.inc.php';
	require_once '/var/www/inf4/KrasevecM/functions.inc.php'; 
	
	
	if (emptyInputSignup($username, $pwd, $pwdRepeat) !== false) {
		header("location: signup.php?error=emptyinput");
		exit();
	}
	if (pwdMatch($pwd, $pwdRepeat) !== false) {
		header("location: signup.php?error=pwdunmatch");
		exit();
	}
	if (uidExists($conn, $username) !== false) { ##
		header("location: signup.php?error=usertaken");
		exit();
	}
	
	createUser($conn, $username, $pwd);
}

else {
	header("location: signup.php");
	exit();
}