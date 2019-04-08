<?php
session_start();
require 'dbh.inc.php';

if(isset($_POST['thisWipit'])) {
$thisWipit = $_POST['thisWipit'];
}
if(isset($_SESSION['wipit'])) {
$sessWipit = $_SESSION['wipit'];
} 

/* if session for wipit is not set or if session id is not set */

if(!isset($_SESSION['wipit']) || !isset($_SESSION['userUid'])){
	echo '<strong> Session expired   </strong>';
	exit();
}
else if($_SESSION['userUid']!=$_POST['senderID']){
	echo '<strong> Forged submission </strong>';
	exit();
}
else if($sessWipit != $thisWipit){
	echo '<strong> Forged submission </strong>';
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

if(isset($_POST['message'])){
	$to = ($_POST['rcpntID']);
	$from = ($_POST['senderID']);
	$sub = htmlspecialchars($_POST['subject']);
	$msg = htmlspecialchars($_POST['message']);
	$sub = mysqli_real_escape_string($conn, $sub);
	$msg = mysqli_real_escape_string($conn, $msg);

	if(empty($to) || empty($from)  || empty($sub) || empty($msg)){
		echo '<strong> Missing data </strong>';
		exit();
	} else {
		$sqldeleteTail = mysqli_query($conn, "SELECT * FROM private_messages WHERE to_id='$to' ORDER BY time_sent DESC LIMIT 0,100");
		$dci = 1;
		while ($row = mysqli_fetch_array($sqldeleteTail)) {
			$pm_id = $row['id'];
			if($dci > 99){
				$deleteTail = mysqli_query("DELETE FROM private_messages WHERE id='$pm_id'");
			}
			$dci++;
		}

		$sql = "INSERT INTO private_messages(to_id, from_id, time_sent, subject, message) VALUES ('$to', '$from', now(), '$sub', '$msg')";
		if(!mysqli_query($conn, $sql)){
			echo '<strong> Error </strong>';
			exit();
		} else {
			echo "Message sent";
			exit();
		}
	}
}
?>