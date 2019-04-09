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


<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Log In</title>
  <link rel="stylesheet" type="text/css" href="">
  <link rel="stylesheet" href="style.css">
</head>

<body>
<div class="main">

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
                          <form>
                            <input type="password" class="input-text" value="" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = '';}"> 
                          </form>

                          <h3>Confirm passord</h3>
                          <form>
                            <input type="password" class="input-text" value="" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = '';}"> 
                          </form>
                        </div>  
                            <input type="submit" name="update-profile" class="update-profile" value="Oppdater">
                        </div>
                      
                      </div>            
                      </div>

                        </body>
                        </html>
