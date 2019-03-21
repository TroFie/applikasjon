<?php
  require "header.php";
?>

	<main>
	 <div class="wrapper-main">
	  <section class="section-default">
		<h1>Signup</h1>
		<?php
			if (isset($_GET['error'])) {
				if ($_GET['error'] == "emptyfields") {
					echo "<p>Fill in all fields..</p>";
				}
				else if ($_GET['error'] == "invaliduidmail") {
					echo "<p>Invalid username and email..</p>";
				}
				else if ($_GET['error'] == "invaliduid") {
					echo "<p>Invalid username..</p>";
				}
				else if ($_GET['error'] == "invalidmail") {
					echo "<p>Invalid e-mail..</p>";
				}
				else if ($_GET['error'] == "passwordcheck") {
					echo "<p>Passwords not matching..</p>";
				}
				else if ($_GET['error'] == "usertaken") {
					echo "<p>Username already taken..</p>";
				}
			}
			else if ($_GET['signup'] == "success") {
				echo "<p>Signup successfull..</p>";
			}
		?>
		<form action="includes/signup.inc.php" method="post">
		 <input type="text" name="uid" value="Username">
		 <input type="mail" name="mail" value="E-mail">
		 <input type="password" name="pwd" value="Password">
		 <input type="password" name="pwd-repeat" value="Repeat password">
		 <button type="submit" name="signup-submit">Signup</button>
		</form>
	  </section>
	 </div>
	</main>

 <?php
   require "footer.php";
  ?>