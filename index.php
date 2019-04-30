<main>
	 <div class="wrapper-main">
	  <section class="section-default">
	  	<?php
	  		if (isset($_SESSION['userId'])) {
	  			require "header.php";
	  		}
	  		else {
	  			require "headerIndex.php";
	  		}
	  	?>
	  </section>
	 </div>
	</main>
