<?php

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

	function emptyInputSignup($username, $pwd, $pwdRepeat) {
		$result;
		if(empty($username) || empty($pwd) || empty($pwdRepeat)) {
			$result = true;
		}
		else{
			$result = false;
		}
		return $result;
	}
	
	function pwdMatch($pwd, $pwdRepeat) {
		$result;
		if ($pwd !== $pwdRepeat){
			$result = true;
		}
		else{
			$result = false;
		}
		return $result;
	}
	
	function uidExists($conn, $username) {
		$sql = "SELECT * FROM users WHERE username = ?;";
		$stmt = mysqli_stmt_init($conn);
		 
		if (!mysqli_stmt_prepare($stmt, $sql)) {
			header("location: signup.php?error=stmtfailed");
			exit();
		}
		
		mysqli_stmt_bind_param($stmt, "s", $username);
		mysqli_stmt_execute($stmt);
		
		$resultData = mysqli_stmt_get_result($stmt);
		
		if($row = mysqli_fetch_assoc($resultData)) {
			return $row;
		}
		else {
			$result = false;
			return $result;
		}
		mysqli_stmt_close($stmt);
	}
	
	function createUser($conn, $username, $pwd) {
		$zero = 0;
		$sql = "INSERT INTO users(username, password, points) VALUES (?, ?, ?);";
		$stmt = mysqli_stmt_init($conn);
		if (!mysqli_stmt_prepare($stmt, $sql)) {
			header("location: signup.php?error=stmtfailedU");
			exit();
		}
		
		$hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
		
		mysqli_stmt_bind_param($stmt, "sss", $username, $hashedPwd, $zero);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
		header("location: signup.php?error=none");
		exit();
	}
	
	function emptyInputLogin($username, $pwd) {
		$result;
		if(empty($username) || empty($pwd)) {
			$result = true;
		}
		else {
			$result = false;
		}
		return $result;
	}
	
	function loginUser($conn, $username, $pwd) {
		$uidExists = uidExists($conn, $username);
		
		if ($uidExists === false) {
			header("location: login.php?error=nouser");
			exit();
		}
		
		$pwdH = $uidExists["password"];
		$checkPwd = password_verify($pwd, $pwdH);
		
		if($checkPwd === false) {
			header("location: login.php?error=wronglogin");
			exit();
		}
		
		else if ($checkPwd === true) {
			session_start();
			$_SESSION["userid"] = $uidExists["id"];
			$_SESSION["useruid"] = $uidExists["username"];
			header("location: index.php");
			exit();
		}
	}
	
	function pointsquery($conn) {
		$sql = 'SELECT points FROM users WHERE id ="' . $_SESSION["userid"] . '"';
		$query = mysqli_query($conn, $sql);
		$row = mysqli_fetch_row($query);
		$points = $row[0];
		$num = mysqli_num_rows($query); //tole bi moglo bit 1
		return $points;
	}
	
	function increase($conn, $cpoints) {
		$cusername = $_SESSION["userid"];
		$fpoints = $cpoints + 1;
		$sql = "update users set points = ? WHERE id = ?;";
		$stmt = mysqli_stmt_init($conn);
		if (!mysqli_stmt_prepare($stmt, $sql)) {
			header("location: index.php?error=stmtfailedI");
			exit();
		}
		
		
		mysqli_stmt_bind_param($stmt, "ii", $fpoints, $cusername);
		mysqli_stmt_execute($stmt);
		
		$result = pointsquery($conn);
		return $result;
		mysqli_stmt_close($stmt);
		
		
	}
	
	function top($conn) {
		$sqlmax = 'SELECT MAX(points) FROM users';
		$qmax = mysqli_query($conn, $sqlmax);
		$res = mysqli_fetch_array($qmax);
		$max = $res['0'];
		
		$sql = 'SELECT username FROM users WHERE points ="' . $max . '"';
		$query = mysqli_query($conn, $sql);
		$row = mysqli_fetch_row($query);
		$leader = $row[0];
		$num = mysqli_num_rows($query); //tole bi moglo bit 1
		return $leader;
	}
?>	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
