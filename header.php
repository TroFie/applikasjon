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
<body>

	 <header>
	 	<div class="container">
	 	
	 	
	 	 <nav>
	 		 <ul>
	 		 	<li><a href="feed.php">Home</a></li>
	 		 	<li><a href="#">Portfolio</a></li>
	 		 	<li><a href="#">About us</a></li>
	 		 	<li><a href="#">Contact</a></li>
	 		 </ul>
	 		 <?php
	 		 	if (isset($_SESSION['userId'])) {
	  			echo '<form action="includes/logout.inc.php" method="post">
	 		 		<button type="submit" name="logout-submit">Logout</button>
	 		 	</form>';
	  		}
	  		else {
	  			echo '	<form action="includes/login.inc.php" method="post">
	 		 		<input type="text" name="mailuid" placeholder="Username/E-mail..">
	 		 		<input type="password" name="pwd" placeholder="Password..">
	 		 		<button type="submit" name="login-submit">Login</button>
	 		 	</form>';
	  		}
	 		 ?>
	 		 
	 		 	
	 		 	
	 		 	<a href="signup.php">Signup</a>
	 		 </div>
	 	</nav>
		
	</header>
	
</body>
</html>