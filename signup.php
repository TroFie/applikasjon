<?php
  require "headerIndex.php";
?>

	<main>
	 <div class="wrapper-main">
	  <section class="section-default">
		
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
				else if ($_GET['error'] == "emailexist") {
					echo "<p>Email exist..</p>";
				}
			}
			if(isset($_GET['signup'])){
			 if ($_GET['signup'] == "success") {
				echo '<p class="signupsuccess"> Signup successful..</p>';
			}
		}
			
		?>

		<form class="login-card" action="includes/signup.inc.php" method="post">
		<h1>Registering</h1>
		 <input type="text" name="uid" placeholder="Username"> <br><br>
		 <input type="mail" name="mail" placeholder="E-mail"> <br><br>
		 <input type="password" name="pwd" placeholder="Password"> <br><br>
		 <input type="password" name="pwd-repeat" placeholder="Repeat password"> <br><br>
		 <input type="radio" name="gender" value="Male" checked> Male<br>
  		 <input type="radio" name="gender" value="Female"> Female<br><br>
  		 <input type="radio" name="campus" value="Bø" checked> Bø<br>
  		 <input type="radio" name="campus" value="Drammen" > Drammen<br>
  		 <input type="radio" name="campus" value="Kongsberg" > Kongsberg<br>
  		 <input type="radio" name="campus" value="Porsgrunn" > Porsgrunn<br>
  		 <input type="radio" name="campus" value="Rauland" > Rauland<br>
  		 <input type="radio" name="campus" value="Ringerike" > Ringerike<br>
  		 <input type="radio" name="campus" value="Vestfold" > Vestfold<br>
  		 <input type="radio" name="campus" value="Notodden"> Notodden<br><br>
 		 
		 <button type="submit" class="login-submit" name="signup-submit">Sign up</button>
		</form>
	  </section>
	 </div>
	</main>

 <?php
   require "footer.php";
  ?>
