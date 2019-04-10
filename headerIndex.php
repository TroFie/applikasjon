<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="stylesheet" type="text/css" href="">
	<link rel="stylesheet" href="style.css">
</head>

	 <header>
	 	<div class="container">
    		<img src="bilder/yippee.png" alt="">
    	</div>
	</header>
		<body>

		</div>
			 <?php
	 		 	if (isset($_SESSION['userId'])) {
	  			echo '<form class="header" action="includes/logout.inc.php" method="post">
	 		 		<button type="submit" class="logout-submit" name="logout-submit">Logout</button>
	 		 	</form>';

	  		}
	  		else {
	  			echo '	<br/><br/><br/><br/><form class="login-card" action="includes/login.inc.php" method="post">
	  				<h1>Log-in</h1><br>
	 		 		<input type="text" name="mailuid" placeholder="Username/E-mail..">
	 		 		<input type="password" name="pwd" placeholder="Password..">
	 		 		<input type="submit" name="login-submit" class="login login-submit" value="Logg in">
	 				 <a href="signup.php" class="login login-submit">Register deg</a>			 	</form>';
	  		}
	 		 ?>
	 		 
	 		 	 


</body>
</html>
