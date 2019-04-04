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

</head>

<body>  


<header>
    <div class="container">
        <div id="branding">
          <h1>Forum Placeholder</h1>
        </div></div>
     
      <nav class="container">
          <ul> 
              <li><a href=feed.php>     Feed       </a></li> 
              <li><a href=#>            Kontakt    </a></li> 
              <li><a href=minSide.php>  Min Side     </a></li> 
              <li><a href=#>            FAQ        </a></li>
          </ul>
      </nav>
  </header>

            

      
      <button class="statusbutton" onclick="document.getElementById('modal-wrapper').style.display='block'" style="width: 200px; margin-top: 200px; margin-left: 190px;">Lag Ny Status</button>
      
      <div id="modal-wrapper" class="modal">

        <form class="modal-content animate" action="" method="POST">

          <div class="imgcontainer">
            <span onclick="document.getElementById(modal-wrapper).style.display='none'" class="close" title="Lukk vindu">&times;</span>
            <h1 style="text-align:center">Ny Status</h1>
          </div>

          <div class="container">
          
            <td>Tittel: </td><td><input class="feedText" type="text" placeholder="Tittel" name="tittel"></td>
          </div>

          <div class="container">
            <td>Statusmelding: </td>
            <textarea class="feedTextArea" style="resize: none;" placeholder="Skriv en ny status" name="melding"></textarea>      
            <input class="statusbutton" type="submit" name="publiser" value="Publiser" style="width:200px;">    
          </div>
        
        </form>

      </div>

      <script>
        
        var modal = document.getElementById('modal-wrapper');
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
        </script>


<div id="main">
<div id="content">
  <?php
      require 'connect.php';
      $getQuery = mysqli_query($conn, "SELECT * FROM melding ORDER BY id DESC");

      while($rows=mysqli_fetch_array($getQuery)) {
        $id = $rows['id'];
        $tittel = $rows['tittel'];
        $melding = $rows['melding'];
        $username = $rows['uidUsers'];
<<<<<<< HEAD
        
        echo '<br/>' . $tittel . '<br/>';
        echo '<br/>';
        echo '<a href=bruker.php?uid='.$username.'>  '.$username.' </a>';
        
        
=======

        echo "<div class=\"post-date\">$username    |   31/03-2019</div>";
        echo "<div class=\"post\">";
        echo "<div class=\"post-user\">"; 

        echo $tittel . '<br/>';
>>>>>>> master
      
        echo "</div>";

        echo $melding . '<br />';
      }
  ?>
      
    </div>

</div>
</div>


</body>
</html>
