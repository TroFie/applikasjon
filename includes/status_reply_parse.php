<?php
session_start();
require 'dbh.inc.php';

/*
$thisWipit = $_POST['thisWipit'];
$sessWipit = $_SESSION['wipit'];

 if session for wipit is not set or if session id is not set 

if(!isset($_SESSION['wipit']) || !isset($_SESSION['userUid'])){
	echo '<strong> Session expired   </strong>';
	exit();
}
else if($_SESSION['userUid']!=$_POST['senderID']){
	echo '<strong> Forged submission </strong>';
	exit();
}
else if($sessWipit != $thisWipit){
	echo '<strong> Forged submission2 </strong>';
	exit();
}
else if($thisWipit=="" || $sessWipit==""){
	echo '<strong> Missing Data </strong>';
	exit();
} 
require_once "../connect.php";
$checkuserid = $_POST['senderID'];
$prevent_dp = mysqli_query($conn, "SELECT id FROM private_messages WHERE from_id='$checkuserid' AND time_sent between subtime(now(),'0:0:20')and now()");
$nr = mysqli_num_rows($prevent_dp);
if($nr>0){
	echo '<strong> Wait 20 seconds </strong>';
	exit();
}

$sql = mysqli_query($conn, "SELECT id FROM private_messages WHERE from_id='$checkuserid' AND DATE(time_sent) = DATE(NOW()) LIMIT 40");
$numRows = mysqli_num_rows($sql);
if($numRows>30){
	echo '<strong> 30 MSG per day </strong>';
	exit();
}
*/
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
		

		$sql = "INSERT INTO melding_reply(tittel, melding_reply, uidUsers_melding, id_user, id_melding) VALUES ('we', '$melding', 'Andreas', '$idx', '$idmelding')";
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
