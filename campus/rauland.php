<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
      <link rel="stylesheet" type="text/css" href="../style.css" />  
      <title>Feed</title>
</head>

<body>  

<header>
  <div class="container">
    <img src="../bilder/yippee.png" alt="">
    </div>
     <form class="header" action="includes/logout.inc.php" method="post">
     <button type="submit" class="logout-submit" name="logout-submit">Logout</button>
        </form>
      <nav class="navbar">
          <ul> 
              <li><a href=../feed.php>     Feed       </a></li> 
              <li><a href=../minSide.php>  Min Side     </a></li> 
              <li><a href=../includes/pm_inbox2.php>            Inbox        </a></li>
              <li><a href=../campus.php>            Campus        </a></li>
          </ul>
      </nav>
      
  </header>

<div id="main">
  <?php
      require '../connect.php';
      $sql = mysqli_query($conn, "SELECT DISTINCT uidUsers FROM users WHERE campusUsers='rauland'");

      while($rows=mysqli_fetch_array($sql)) {
        $userUid = $rows['uidUsers'];
        ?>
        <table width="920" style="background-color:#F2F2F2;"; border="0" align="center" cellpadding="0" cellspacing="0">
        <h2 style="margin-left:24px;"><strong style="margin-left:5px"></strong> <?php echo "<a style=\"text-decoration:none; color: black;\"href=../bruker.php?uid=$userUid> $userUid </a>";?> </h2>
 </div>
      <?php
      }
      ?>
</div>

</body>
</html>
