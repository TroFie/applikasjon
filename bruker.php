
<?php
require 'connect.php';
?>
<html>

<head>
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
  <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
     <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="style.css" />

<script language="javascript" type="text/javascript">
$('#pmForm').submit(function(){$('input[type=submit]',this).attr('disabled','disabled');});
function sendPM(){
  var pmSubject = $("#pmSubject");
  var pmTextArea = $("#pmTextArea");
  var senderid = $("#pm_sender_id");
  var recID = $("#pm_rec_id");
  var pm_wipit = $("#pmWipit");
  var url = "includes/private_msg_parse.php";
  if(pmSubject.val()==""){
  $("#interactionResults").html('Please type a subject').show();
} else if(pmTextArea.val()==""){
  $("#interactionResults").html('Please type a message').show(); 
}else {
  $.post(url,{subject: pmSubject.val(), message: pmTextArea.val(), senderID: senderid.val(), rcpntID: recID.val(), thisWipit: pm_wipit.val()}, function(data){
    $('#interactionResults').html(data).show();
    document.pmForm.pmTextArea.value="";
    document.pmForm.pmSubject.value=""; 
  });
}
}
</script>

</head>


 <header>
    <div class="container">
      <img src="bilder/yippee.png" alt="">
    </div>
<form class="header" action="includes/logout.inc.php" method="post">
          <button type="submit" class="logout-submit" name="logout-submit">Logout</button>
        </form>
    <div class="container">
     <nav class="navbar">
          <ul> 
              <li><a href=feed.php>     Feed       </a></li> 
              <li><a href=#>            Kontakt    </a></li> 
              <li><a href=minSide.php>  Min Side     </a></li> 
              <li><a href=#>            FAQ        </a></li>
              <li><a href=includes/pm_inbox2.php>            Inbox        </a></li>
          </ul>
          

  </header>
<?php
require 'connect.php';
session_start();
$wipit = rand(0,999999999);
$_SESSION['wipit'] = $wipit;
$uid = (isset($_GET['uid'])) ? $_GET['uid'] : $_SESSION['uid'];
$result = mysqli_query($conn, "SELECT * FROM users WHERE uidUsers='$uid'");
while($row = mysqli_fetch_array($result)) {
$uid=$row['uidUsers'];
$email=$row['emailUsers'];
$gender=$row['genderUsers'];
$campus=$row['campusUsers'];
}
?>

<body>  
<div class="main">

  <div class="content">
      <h1><?php echo $uid ?> sin profil</h1>
      

        <div class="profile-content">
           <h3>Brukernavn</h3>  
            <?php echo $uid ?>
                          
                 <h3>Email</h3>
                     <div class="email-group">
                              <div class="email-form">
                                <?php echo $email ?>  
                             </div>
                          </div>

                          <h3>Campus</h3> 
                          <div class="campus-group">     
                              <div class="campus-form">
                                <?php echo $campus ?>
                              </div>     
                          </div>

                          <h3>Kjønn</h3> 
                           <div class="gender-group">     
                              <div class="gender-form">
                              <?php echo $gender ?>
                              </div>

    <div id="interactionResults" style="'font-size:15px; padding: 10px;"></div>
    <div class="interactContainers" id="private_message">
      <form action="javascript:sendPM();" name="pmForm" id="pmForm" method="post">
        <font size="+1"> <br> <h3>Sending Private Message to <?php echo $uid ?><h3></font><br/>
        Subject: <br>
        <input name="pmSubject" id="pmSubject" type="text" maxlength="64" style="width:100%;"/>
       <br> Message:<br>
        <textarea name="pmTextArea" id="pmTextArea" rows="8" style="width:100%;"></textarea>
        <input type="hidden" name="pm_sender_id" id="pm_sender_id"  value="<?php echo $_SESSION['userUid'] ?>"/>
        <input type="hidden" name="pm_rec_id" id="pm_rec_id"  value="<?php echo $uid ?>"/>
        <input type="hidden" name="pmWipit" id="pmWipit"  value="<?php echo $wipit ?>"/>
        <span id="PMStatus" style="color:#F00;"></span>
        <br/><input type="submit" name="pmSubmit" class="update-profile" value="Submit"/> or <a href="feed.php" onmousedown="javascript:toggleInteractContainers('private_message');">Close</a>
     </form>
    </div>
    </php?>
    </div>
    <div class="tab-1 resp-tab-content">
         </div>
    
     </div>            
        </div>

</body>
</html>
