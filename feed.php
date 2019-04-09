<?php
session_start();

  if(isset($_POST['publiser'])) {

    require 'connect.php';

    $tittel = $_POST['tittel'];
    $melding = $_POST['melding'];
    $username = $_SESSION['userUid'];
    
    if($tittel && $melding ) {
      $sql = "INSERT INTO melding (tittel, melding, uidUsers) VALUES ('$tittel', '$melding', '$username')";
      $stmt = mysqli_stmt_init($conn);
      if (!mysqli_stmt_prepare($stmt, $sql)) {
        exit();
      } else {
        mysqli_stmt_execute($stmt);
        header("Location: /applikasjon/feed.php");
				exit();
      }
    }
  } 
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
      <link rel="stylesheet" type="text/css" href="style.css" />  
      <title>Feed</title>
</head>

<body>  

<header>
  <div class="container">
    <img src="bilder/yippee.png" alt="">
    </div>
     
      <nav class="navbar">
          <ul> 
              <li><a href=feed.php>     Feed       </a></li> 
              <li><a href=#>            Kontakt    </a></li> 
              <li><a href=minSide.php>  Min Side     </a></li> 
              <li><a href=#>            FAQ        </a></li>
          </ul>
      </nav>
  </header>
  
  <!-- Ny status -->
    <button class="statusbutton" onclick="document.getElementById('modal-wrapper').style.display='block'" style="width: 200px;  margin-top: 40px; margin-left: 10.1%;">Lag Ny Status</button>
  
      <div id="modal-wrapper" class="modal">

        <form class="modal-content animate" action="" method="POST">

          <div class="imgcontainer">
            <h1 style="text-align:center">Ny Status</h1>
          </div>

          <div class="container">
            <td>Tittel: </td><td><input class="feedText" type="text" placeholder="Tittel" name="tittel"></td>
          </div>

          <div class="container">
            <td>Statusmelding: </td>
            <textarea class="feedTextArea" style="resize: none; font-family:arial;" placeholder="Skriv en ny status" name="melding"></textarea>      
            <input class="statusbutton" type="submit" name="publiser" value="Publiser" style="width:200px;">    
          </div>
        
        </form>
      </div>

      <!-- Svar funksjon -->
        <div id="svar-wrapper" class="svar">

        <form class="svar-content animate" action="" method="POST">

          <div class="svarcontainer">
            <h1 style="text-align:center">Svar</h1>
          </div>

          <div class="container">
            <td>Ditt svar: </td>
            <textarea class="feedTextArea" style="resize: none;" placeholder="Svar på statusen" name="melding"></textarea>      
            <input class="statusbutton" type="submit" name="publiser" value="Svar" style="width:200px;">    
          </div>
        
        </form>
        <script>
        var svar = document.getElementById('svar-wrapper');
        var modal = document.getElementById('modal-wrapper');
        window.onclick = closeWindow;
        
        function closeWindow(event) {
            if (event.target == svar) {
                svar.style.display = "none";
            } 
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
      </script>
      </div>

<div id="main">
  <?php
      require 'connect.php';
      $getQuery = mysqli_query($conn, "SELECT * FROM melding ORDER BY id DESC");

      while($rows=mysqli_fetch_array($getQuery)) {
        $id = $rows['id'];
        $tittel = $rows['tittel'];
        $melding = $rows['melding'];
        $username = $rows['uidUsers'];
        $post_time = $rows['post_time'];
        ?>
        <div class="shadowbox">
        <div class="post-date"><strong style="margin-left:5px">Postet av:</strong> <?php echo "<a style=\"text-decoration:none; color: white;\" href=bruker.php?uid=$username> $username </a>";?> 
                               <span> <p style="font-style:italic; margin-left:5px"><?php echo date("j-M-Y g:ia", strtotime($post_time)) ?> </p></span></div>
        <div class="post">
        <h3 style="color: rgb(223, 223, 223); text-align: left; margin-left:10px;"><?php echo $tittel; ?><br/></h3>
        
        <p style="color: rgb(223, 223, 223); font-size: 18px; text-align:left; margin-left:10px; margin-top:5px;"><?php echo $melding; ?></p>
        <br/> 
        <br/>
        <!-- <button class="statussvar" onclick="document.getElementById('svar-wrapper').style.display='block'" style="width: 100px; margin-top: 50px;">Svar</button> -->
      </div>
    </div>
      <?php
      }
      ?>
</div>

</body>
</html>
