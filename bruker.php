<?php
require 'connect.php';
?>
<html>

<head>
     <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="style.css" />

</head>

<header>
    <div class="container">
        <div id="branding">
          <h1>Forum Placeholder</h1>
        </div></div>
     
      <nav class="container">
          <ul> 
              <li><a href=feed.php>     Feed       </a></li> 
              <li><a href=#>            Kontakt    </a></li> 
              <li><a href=minSide.php>   Min Side     </a></li> 
              <li><a href=#>            FAQ        </a></li>
          </ul>
      </nav>
  </header>

<body>  

<?php
require 'connect.php';
session_start();
$uid = (isset($_GET['uid'])) ? $_GET['uid'] : $_SESSION['uid'];
$result = mysqli_query($conn, "SELECT * FROM users WHERE uidUsers='$uid'");
while($row = mysqli_fetch_array($result)) {
$uid=$row['uidUsers'];
$email=$row['emailUsers'];
$gender=$row['genderUsers'];
$campus=$row['campusUsers'];

}
?>

<table width="398" border="0" align="center" cellpadding="0">
  <tr>
    <td height="26" colspan="2"><?php echo $uid ?>'s Profile information </td>
  </tr>
  <tr>
    <td width="129" rowspan="5"><img src="bilder/1.png" width="129" height="129" alt="no image found"/></td>
    <td width="82" valign="top"><div align="left">Username:</div></td>
    <td width="165" valign="top"><?php echo $uid ?></td>
  </tr>
  <tr>
    <td valign="top"><div align="left">Email:</div></td>
    <td valign="top"><?php echo $email ?></td>
  </tr>
   <tr>
    <td valign="top"><div align="left">Gender:</div></td>
    <td valign="top"><?php echo $gender ?></td>
  </tr>
   <tr>
    <td valign="top"><div align="left">Campus:</div></td>
    <td valign="top"><?php echo $campus ?></td>
  </tr>

</table>
<p align="center"><a href="index.php"></a></p>

</body>
</html>
