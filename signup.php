<?php
	include_once '/var/www/inf4/KrasevecM/header.php';
?>

	
	
	
	<section>
	
		<h2>Registracija</h2>
		<div>
			<form action="signup.inc.php" method="post">
				<div><input type="text" name="uid" placeholder="Uporabniško ime"></div>
				<div><input type="password" name="pwd" placeholder="Geslo"></div>
				<div><input type="password" name="pwdrepeat" placeholder="Ponovi geslo"></div>
				<button type="submit" name="submit">Registriraj se</button>
			</form>
		</div>
		
		<?php
			if (isset($_GET["error"])) {
				if($_GET["error"] == "emptyinput") {
					echo"<p><b>|Prazna polja|</b><p>";
				}
				else if ($_GET["error"] == "pwdunmatch") {
					echo"<p><b>|Neujemanje gesel|</b><p>";
				}
				else if ($_GET["error"] == "usertaken") {
					echo"<p><b>|Obstoječe ime|</b><p>";
				}
				else if ($_GET["error"] == "none") {
					echo"<p><b>|Registracija uspešna|</b><p>";
				}
			}
		?>
		
	</section>

