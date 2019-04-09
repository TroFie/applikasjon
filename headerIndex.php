<?php
	session_start();
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

	 <header>
	 	<div class="container">
    		<img src="bilder/yippee.png" alt="">
    	</div>
	</header>
		<body>
			 <?php
	 		 	if (isset($_SESSION['userId'])) {
	  			echo '<form class="formHeader" action="includes/logout.inc.php" method="post">
	 		 		<button class="logoutbutton" style="width: 200px; margin-top: 30px; margin-left: 825px;" type="submit" name="logout-submit">Logout</button>
	 		 	</form>';
	  		}
	  		else {
	  			echo '	<br/><br/><br/><br/><form class="login-card" action="includes/login.inc.php" method="post">
	  				<h1>Log-in</h1><br>
	 		 		<input type="text" name="mailuid" placeholder="Username/E-mail..">
	 		 		<input type="password" name="pwd" placeholder="Password..">
	 		 		<input type="submit" name="login-submit" class="login login-submit" value="Log in">
	 		 		<a href="signup.php">Signup</a> • <a href="#">Forgot Password</a>
	 		 	</form>';
	  		}
	 		 ?>
	 		 
	 		 	

</body>
</html>
