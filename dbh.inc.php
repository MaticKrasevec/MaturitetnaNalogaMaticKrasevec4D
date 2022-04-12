<?php

$serverName = "localhost";
$dBUsername = "KrasevecM";
$dbPassword = "km6800";
$dBName = "KrasevecM";

$conn = mysqli_connect($serverName, $dBUsername, $dbPassword, $dBName);

if (!$conn) {
	die("Connection fail: " . mysqli_connect_error());
}
	