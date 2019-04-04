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
	 	<h1>Forum Placeholder</h1>
	 	
	 	 <nav>
	 		 <ul>
	 		 </ul>
	 		 <?php
	 		 	if (isset($_SESSION['userId'])) {
	  			echo '<form class="formHeader" action="includes/logout.inc.php" method="post">
	 		 		<button type="submit" name="logout-submit">Logout</button>
	 		 	</form>';
	  		}
	  		else {
	  			echo '	<form class="formHeader" action="includes/login.inc.php" method="post">
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