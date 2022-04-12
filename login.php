<?php
	include_once '/var/www/inf4/KrasevecM/header.php';

?>


<section>
		<h2>Prijava</h2>
		<form action="login.inc.php" method="post">
			<div>
				<input type="text" name="name" placeholder="Uporabniško ime">
			</div>
			<div>
				<input type="password" name="pwd" placeholder="Geslo">
			</div>
			<button type="submit" name="submit">Prijavi se</button>
		</form>
		
		<?php
			if (isset($_GET["error"])) {
				if($_GET["error"] == "emptyinput") {
					echo"<p><b>|Prazna polja|</b><p>";
				}
				if($_GET["error"] == "wronglogin") {
					echo"<p><b>|Napačni podatki|</b><p>";
				}
				if($_GET["error"] == "nouser") {
					echo"<p><b>|Uporabnik ne obstaja|</b><p>";
				}
			}
		?>
		
</section>
