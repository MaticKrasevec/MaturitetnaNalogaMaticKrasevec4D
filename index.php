
<?php
	require_once '/var/www/inf4/KrasevecM/dbh.inc.php';
	include_once '/var/www/inf4/KrasevecM/header.php';
	require_once '/var/www/inf4/KrasevecM/functions.inc.php'; 
	
?>


<section>
<body>
<p></p>
<form action="index.php" method="post">
<button type="submit" name="add">Klikni me</button>
</form>
</body>



<?php

if(isset($_POST["add"])) {
	
	if(isset($_SESSION["useruid"])) {
	$cpoints = pointsquery($conn);
	$npoints = increase($conn, $cpoints);
	echo"<p>Tvoje točke: <b>" . $npoints . "</b></p>";
	}
	
	else {
		echo"<p><b>Prijavi se!</b></p>";
	}
}


$cleader = top($conn);
echo "<p>Trenutno vodi: <b>" . $cleader . "</b></p>";


if (isset($_GET["error"])) {
				if($_GET["error"] == "sessnotset") {
					echo"<p><b>session not set</b><p>";
				}
	}
	if (isset($_GET["error"])) {
				if($_GET["error"] == "stmtfailed") {
					echo"<p><b>|stmt fail|</b><p>";
				}
	}
?>

</section>
