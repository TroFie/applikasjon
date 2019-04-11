<?php
session_start();
  if(isset($_POST['publiser'])) {
    require 'connect.php';
    $tittel = $_POST['tittel'];
    $melding = $_POST['melding'];
    $username = $_SESSION['userUid'];
    
    if($tittel && $melding) {
      $sql = "INSERT INTO melding (tittel, melding, uidUsers) VALUES ('$tittel', '$melding', '$username')";
      $stmt = mysqli_stmt_init($conn);
      if (!mysqli_stmt_prepare($stmt, $sql)) {
        exit();
      } else {
        mysqli_stmt_execute($stmt);
        header("location: feed.php");
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
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
      <title>Feed</title>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script language="javascript" type="text/javascript">
    $(document).ready(function(){
    $(".toggle").click(function(){
      if($(this).next().is(":hidden")){
        $(".replies").hide();
        $(this).next().slideDown("fast");
      }else{
        $(this).next().hide();
        }
      });
    });
    
    function toggleReplyBox(tittel,senderid,recID,idmelding){
    $("#subjectShow").text(tittel);
    document.replyForm.pmSubject.value = tittel;
    document.replyForm.pm_sender_id.value = senderid;
    document.replyForm.pm_rec_id.value = recID;
    document.replyForm.pm_meld_id.value = idmelding;
    document.replyForm.replyBtn.value = "Send reply to " + senderid;
    if($('#replyBox').is(":hidden")){
      $('#replyBox').fadeIn(1000);
    }else{
      $('#replyBox').hide();
    }
  }
  function processReply(){
  var pmSubject = $("#pmSubject");
  var pmTextArea = $("#pmTextArea");
  var senderid = $("#pm_sender_id");
  var idMeld = $("#pm_meld_id");
  var recID = $("#pm_rec_id");
  var url = "includes/status_reply_parse.php";
  if(pmTextArea.val()==""){
  $("#PMStatus").text('Please type a message').show();
} else {
  $.post(url,{tittel: pmSubject.val(), melding: pmTextArea.val(), senderID: senderid.val(), recid: recID.val(), meldId: idMeld.val()}, function(data){
    document.replyForm.pmTextArea.value="";
    $('#replyBox').slideUp("fast");
    $("#PMFinal").html("&nbsp; &nbsp;"+data).show().fadeOut(8000);
  });
}
}
</script>
<style type="text/css">
.hiddenDiv{display:none}
.replyBoxes{display:none;border:#999 1px solid;background-color:#CCC;margin-left:100px;margin-right:100px;padding:12px;}
.msgDefault{font-weight:bold;}
.msgRead{font-weight:100;color:#666;}
</style>
</head>

<body>  

<header>
  <div class="container">
    <img src="bilder/yippee.png" alt="">
    </div>
     <form class="header" action="includes/logout.inc.php" method="post">
     <button type="submit" class="logout-submit" name="logout-submit">Logout</button>
        </form>
      <nav class="navbar">
          <ul> 
              <li><a href=feed.php>     Feed       </a></li> 
              <li><a href=minSide.php>  Min Side     </a></li> 
              <li><a href=includes/pm_inbox2.php>            Inbox        </a></li>
              <li><a href=campus.php>            Campus        </a></li>
          </ul>
      </nav>
  </header>

<form action="#" method="post"  >
<input type="submit" name="campus" class="logoutbutton" value="Velg campus-feed" style= "margin-left: 10%; margin-bottom: 5px; margin-top: 7px;"/>
<select name="Campus">
<?php
$options = array("Velg","Alle","Drammen","Kongsberg","Porsgrunn","Bø","Notodden","Vestfold");
$selected_val = "Velg";
foreach($options as $option){
    if($selected_val==$option){
        echo '<option value="'.$option.'" selected="selected">'.ucfirst($option).'</option>';
    }else{
        echo '<option value="'.$option.'">'.ucfirst($option).'</option>';
    }
}
?>
</select>

</form>
<?php
if(isset($_POST['campus'])){
$selected_val = $_POST['Campus'];  // Storing Selected Value In Variable
}
?>



  <!-- Ny status -->
    <button class="statusbutton" onclick="document.getElementById('modal-wrapper').style.display='block'" style="width: 200px; margin-left: 10%; ">Lag Ny Status</button>
  
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
      $getQuery = mysqli_query($conn, "SELECT * FROM melding, users WHERE users.uidUsers=melding.uidUsers ORDER BY id DESC");
      if($selected_val!="Velg"){
      $getQuery = mysqli_query($conn, "SELECT * FROM melding, users WHERE users.uidUsers=melding.uidUsers AND users.campusUsers='$selected_val' ORDER BY id DESC");
      }if($selected_val=="Alle"){
        $getQuery = mysqli_query($conn, "SELECT * FROM melding, users WHERE users.uidUsers=melding.uidUsers ORDER BY id DESC");
      }
      while($rows=mysqli_fetch_array($getQuery)) {
        $id = $rows['idUsers'];
        $idmelding = $rows['id'];
        $tittel = $rows['tittel'];
        $melding = $rows['melding'];
        $username = $rows['uidUsers'];
        $post_time = $rows['post_time'];
        $campus = $rows['campusUsers'];
        $sql = mysqli_query($conn, "SELECT * FROM melding_reply INNER JOIN melding INNER JOIN users ON melding_reply.id_melding=melding.id AND melding_reply.id_user=users.idUsers");
        
        ?>
        <div class="shadowbox">
                    <!-- Like button -->

          <div class="post-info">
          <i class="fa fa-thumbs-o-up like-btn" data-id="<?php echo $melding['id'] ?>"> </i>

          <i class="fa fa-thumbs-o-down dislike-btn" data-id="<?php echo $melding['id'] ?>"> </i>
          </div>


        <div class="post-date">

          <strong style="margin-left:5px">Postet av:</strong> <?php echo "<a style=\"text-decoration:none; color: white;\" href=bruker.php?uid=$username> $username </a>";?>

          <strong style="margin-left:5px">Campus:</strong> <?php echo "<a style=\"text-decoration:none; color: white;\" href=campus/$campus.php> $campus </a>";?>
          <span> <p style="font-style:italic; margin-left:5px"><?php echo date("j-M-Y g:ia", strtotime($post_time)) ?> </p></span>  
          </div>
        <div class="post">

        <h3 style="color: rgb(223, 223, 223); text-align: left; margin-left:10px;"><?php echo $tittel; ?><br/></h3>
        
        <p style="color: rgb(223, 223, 223); font-size: 18px; text-align:left; margin-left:10px; margin-top:5px;"><?php echo $melding; ?></p>
        <button class="toggle statusbutton" style="width:100px; margin-left:10px; padding: 3px 10px; font-size:15px;">Vis</button>

      <div class="replies">
       <?php while($row=mysqli_fetch_array($sql)) {
        $id2 = $row['melding_reply'];
        $idbruker = $row['id_user'];
        $id_melding = $row['id_melding'];
        $bruker_reply = $row['uidUsers_melding'];
        ?>
       <?php if($idbruker==$id AND $idmelding==$id_melding ){ ?>
       <p style="color: rgb(223, 223, 223); font-size: 18px; text-align:left;"><?php echo $bruker_reply; ?> svarte: <?php echo $id2; ?><p style="border-bottom: rgb(68, 99, 73) 2px solid;"></p>
        <?php }} ?> 
        <div style="text-align:center; margin-bottom:10px;">
        <a class="statussvar" style="text-decoration:none;"href="javascript:toggleReplyBox('<?php echo stripslashes($rows['tittel']);?>','<?php echo $username;?>','<?php echo $id;?>','<?php echo $idmelding;?>')">Svar</a><br/>
       </div>
        </div>
      </div>
    </div>
      <?php
        }
      ?>
</div>

<div id="replyBox" style="display:none; width:680px; height:264px; background-color:#005900; background-repeat:repeat; border:#333 1px solid; top:451px; left:600px; position:fixed; margin:auto; z-index:50; padding:20px; color:#FFF;">
<div align="right"><a href="javascript:toggleReplyBox('close')"><font color="#00CCFF"><strong>CLOSE</strong></font></a></div>
<h2>Replying to <span style="color:#ABE3FE;" id="recipientShow"></span></h2>  
Subject: <strong><span style="color:#ABE3FE;" id="subjectShow"></span></strong><br>
<form action="javascript:processReply();" name="replyForm" id="replyForm" method="post">
    <textarea id="pmTextArea"  rows="8" style="width:98%;"></textarea>
    <input type="hidden" id="pmSubject">
    <input type="hidden" id="pm_rec_id">
    <input type="hidden" id="pm_sender_id">
    <input type="hidden" id="pm_meld_id">
    <span id="PMStatus" style="color:#F00;"></span>
    <br/>
    <input name="replyBtn" type="button" onclick="javascript:processReply()"/> &nbsp;&nbsp;&nbsp;
    <div id="PMStatus" style="color:F00; font-size:14px; font-weight:700;">&nbsp;</div>
 </form>
</div>

  <!-- Jquery Scripts -->
  <script src="scripts.js"></script>

</body>
</html>