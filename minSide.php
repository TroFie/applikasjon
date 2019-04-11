<?php
require "header.php"; 
 ?>
<?php
 $username = $_SESSION['userUid'];
 
 
require 'connect.php';

$getQuery = mysqli_query($conn, "SELECT * FROM users WHERE uidUsers='$username'");
  while($rows=mysqli_fetch_array($getQuery))
    {
    $username=$rows['uidUsers'];
    $email=$rows['emailUsers'];
    $gender=$rows['genderUsers'];
    $campus=$rows['campusUsers'];
    }
?>

<?php
 $_SESSION["idUsers"] = "38";
  $idUsers = $_SESSION['idUsers'];
require 'connect.php';

if (count($_POST) > 0) {
    $result = mysqli_query($conn, "SELECT *from users WHERE idUsers='" . $_SESSION["idUsers"] . "'");
    $row = mysqli_fetch_array($result);
    if ($_POST["newPassword"] == $_POST["confirmPassword"]) {
      mysqli_query($conn, "UPDATE users set pwdUsers='" . password_hash($_POST["newPassword"], PASSWORD_DEFAULT) . "' WHERE idUsers='" . $_SESSION["idUsers"] . "'");
        $message = "Passord byttet";
    } else
        $message = "Noe gikk falt";
}

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $username ?> sin profil</title>
  <link rel="stylesheet" type="text/css" href="">
  <link rel="stylesheet" href="style.css">


    <script>
    function validatePassword() {
    var newPassword,confirmPassword,output = true;

  
    newPassword = document.frmChange.newPassword;
    confirmPassword = document.frmChange.confirmPassword;

   
    else if(!newPassword.value) {
    newPassword.focus();
    document.getElementById("newPassword").innerHTML = "Må fylles";
    output = false;
    }
    else if(!confirmPassword.value) {
    confirmPassword.focus();
    document.getElementById("confirmPassword").innerHTML = "Må fylles";
    output = false;
    }
    if(newPassword.value != confirmPassword.value) {
    newPassword.value="";
    confirmPassword.value="";
    newPassword.focus();
    document.getElementById("confirmPassword").innerHTML = "Ikke like";
    output = false;
    }   
    return output;
    }
    </script>

</head>

<body>
<form name="frmChange" method="post" action="" onSubmit="return validatePassword()">
<div class="main">
<div class="message"><?php if(isset($message)) { echo $message; } ?></div>
  <div class="content">
      <h1><?php echo $username ?> sin profil</h1>
      <img class="profile-pic" src="bilder/1.png" width="129" height="129" alt="" />

        <div class="profile-content">
           <h3>Brukernavn</h3>  
             <input type="text" class="input-text" value="<?php echo $username ?>" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = '<?php echo $username ?>';}">  
                          
                 <h3>Email</h3>
                     <div class="email-group">
                              <div class="email-form">
                                <form>
                                  <input type="text" class="input-text" value="<?php echo $email ?>" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = '<?php echo $email ?>';}">  
                                </form>
                              </div>
                          </div>

                          <h3>Campus</h3> 
                          <div class="campus-group">     
                           
                              <div class="campus-form">
                                <form>
                                  <input type="text" class="input-text" value="<?php echo $campus ?>" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = '<?php echo $campus ?>';}"> 
                                </form>
                              </div>     
                          </div>

                          <h3>Kjønn</h3> 
                           <div class="gender-group">     
                    
                              <div class="gender-form">
                                <form>
                                  <input type="text" class="input-text" value="<?php echo $gender ?>" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = '<?php echo $gender ?>';}"> 
                                </form>
                              </div>
                                     
                          </div>
                            <div class="tab-1 resp-tab-content">


                          <h3>Nytt passord</h3>
                          <input type="password" name="newPassword" class="input-text"/><span id="newPassword" class="required"></span>

                          <h3>Confirm passord</h3>
                         <input type="password" name="confirmPassword" class="input-text"/><span id="confirmPassword" class="required"></span>
                        </div>  
                       
                            <td colspan="2"><input type="submit" name="submit" value="Submit" class="update-profile"></td>
                        </div>
                      
                      </div>            
                      </div>

                        </body>
                        </html>


