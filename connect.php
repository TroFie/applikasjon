<?php
$servername = "itfag.usn.no";
$dBUsername ="h18u47";
$dBPassword = "evon1010";
$dbName = "h18dbgr12";

$conn = mysqli_connect($servername, $dBUsername, $dBPassword, $dbName);

if (!$conn) {
	die("Connection failed: ".mysqli_connect_error());
}