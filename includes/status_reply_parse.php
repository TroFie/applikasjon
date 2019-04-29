<?php
session_start();
require 'dbh.inc.php';
$username = $_SESSION['userUid'];
$sessWipit = $_SESSION['wipit'];

 

if(!isset($_SESSION['wipit']) || !isset($_SESSION['userUid'])){
	echo '<strong> Session expired   </strong>';
	exit();
}

if(isset($_POST['melding'])){
	require_once "../connect.php";
	$from = ($_POST['senderID']);
	$idx = ($_POST['recid']);
	$idmelding = ($_POST['meldId']);
	$tittel = htmlspecialchars($_POST['tittel']);
	$melding = htmlspecialchars($_POST['melding']);
	$tittel = mysqli_real_escape_string($conn, $tittel);
	$melding = mysqli_real_escape_string($conn, $melding);

	if(empty($from)){
		echo '<strong> Missing data </strong>';
		header("location: pm_inbox2.php");
		exit();
	} else {
		

		$sql = "INSERT INTO melding_reply(melding_reply, uidUsers_melding, id_user, id_melding) VALUES ('$melding', '$username', '$idx', '$idmelding')";
		if(!mysqli_query($conn, $sql)){
			echo '<strong> Missing data </strong>';
			exit();
		} else {
			echo "Message sent";
			header("location: pm_inbox2.php");
			exit();
		}
	}
}
?>
