<?php
	session_start();
?>



<!DOCTYPE html>
<html>
<head></head>

<header>
	<b>Ticma Online</b>
	
	<?php
		if (isset($_SESSION["useruid"])) {
			echo "<p>Pozdravljeni " . $_SESSION["useruid"] . " |ID= " . $_SESSION["userid"] . "|" . "</p>";
		}
	?>
</header>

<nav>
	<button><a href="index.php">Domov</a></button>
	
	<?php
		if (isset($_SESSION["useruid"])) {
			echo "<button><a href= logout.inc.php>Odjava</a></button>";	
		}
	
		else {
			echo "<button><a href= login.php>Prijava</a></button>";
			echo "<button><a href= signup.php>Registracija</a></button>";
		}
	?>
</nav>
</html>