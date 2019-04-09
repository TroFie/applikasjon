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
<body>
	 <header>
	 	<div class="container">
	 		<img src="bilder/yippee.png" alt="">
		</div>

		<div class="container">
	 	 <nav class="navbar">
	 		 <ul>
	 		 	<li><a href="feed.php">FEED</a></li>
	 		 	<li><a href="#">KONTAKT</a></li>
	 		 	<li><a href="minSide.php">MIN SIDE</a></li>
	 		 	<li><a href="#">FAQ</a></li>
	 		 </ul>
	 		 <?php
	 		 	if (isset($_SESSION['userId'])) {
	  			echo '<form class="header" action="includes/logout.inc.php" method="post">
	 		 		<button type="submit" class="logout-submit" name="logout-submit">Logout</button>
	 		 	</form>';
	  }
	  		else {
	  			  header("Location: http://localhost/applikasjon/index.php", true, 301);
			exit();
	  		}
	 		 ?> 	
	 		 	
	 		 </div>
	 	</nav>
		
	</header>
	
</body>
</html>
