<?php
require "header.php"; 
 ?>
<?php

require 'connect.php';

$uid = (isset($_GET['uid'])) ? $_GET['uid'] : $_SESSION['uid'];


$getQuery = mysqli_query($conn, "SELECT * FROM users WHERE uidUsers='$uid'");
while($rows=mysqli_fetch_array($getQuery))
{
$username=$rows['uidUsers'];
$email=$rows['emailUsers'];
$gender=$rows['genderUsers'];
$campus=$rows['campusUsers'];
}
?>
<table width="398" border="0" align="center" cellpadding="0">
  <tr>
    <td height="26" colspan="2"><?php echo $username ?>'s Profile Information </td>
  </tr>
  <tr>
    <td valign="top"><div align="left">Username:</div></td>
    <td valign="top"><?php echo $username ?></td>
  </tr>
  <tr>
    <td valign="top"><div align="left">Campus:</div></td>
    <td valign="top"><?php echo $campus ?></td>
  </tr>
  <tr>
    <td valign="top"><div align="left">Gender:</div></td>
    <td valign="top"><?php echo $gender ?></td>
  </tr>
  <tr>
    <td valign="top"><div align="left">E-mail:</div></td>
    <td valign="top"><?php echo $email ?></td>
  </tr>
</table>
<p align="center"><a href="index.php"></a></p>	