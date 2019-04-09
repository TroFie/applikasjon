<?php
session_start();
require 'dbh.inc.php';
$messageid = $_POST['messageid'];
$ownerid = $_POST['ownerid'];

$decryptedID = $_SESSION['userUid'];
$id_array = explode("p3h9xfn8sq03hs2234", $decryptedID);
$my_id = $id_array[0];
if($ownerid != $my_id){
	exit();
}else{
	mysqli_query($conn, "UPDATE private_messages SET opened='1' WHERE id='$messageid' LIMIT 1");
	
}
?>
