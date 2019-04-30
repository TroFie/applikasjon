<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="stylesheet" type="text/css" href="stylephp.php">
	<link rel="stylesheet" href="style.css">
</head>
<body>
	 <header>
	 	<div class="container">
	 		<img src="bilder/yippee.png" alt="">
		</div>
	 <?php
	 		 	if (isset($_SESSION['userId'])) {
	  			echo '<form class="header" action="includes/logout.inc.php" method="post">
	 		 		<button type="submit" class="logout-submit" name="logout-submit">Logout</button>
	 		 	</form>';
	  }
	  		else {
	  			  header("Location: http://localhost/gruppe06/index.php", true, 301);
			exit();
	  		}
	 		 ?> 
	 	 <nav class="navbar">
          <ul> 
              <li><a href=feed.php>     Feed       </a></li> 
              <li><a href=minSide.php>  Min Side     </a></li> 
              <li><a href=includes/pm_inbox2.php>            Inbox        </a></li>
              <li><a href=campus.php>            Campus        </a></li>
          </ul>
	 	 	
	 		 	
	 		 </div>
	 	</nav>
		
	</header>
	
</body>
</html>
