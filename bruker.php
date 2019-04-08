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
        <div id="branding">
          <h1>Forum Placeholder</h1>
        </div></div>
     
      <nav class="container">
          <ul> 
              <li><a href=feed.php>     Feed       </a></li> 
              <li><a href=#>            Kontakt    </a></li> 
              <li><a href=minSide.php>   Min Side     </a></li> 
              <li><a href=#>            FAQ        </a></li>
          </ul>
      </nav>
  </header>

<body>  

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

<table width="398" border="0" align="center" cellpadding="0">
  <tr>
    <td height="26" colspan="2"><?php echo $uid ?>'s Profile information </td>
  </tr>
  <tr>
    <td width="129" rowspan="5"><img src="bilder/1.png" width="129" height="129" alt="no image found"/></td>
    <td width="82" valign="top"><div align="left">Username:</div></td>
    <td width="165" valign="top"><?php echo $uid ?></td>
  </tr>
  <tr>
    <td valign="top"><div align="left">Email:</div></td>
    <td valign="top"><?php echo $email ?></td>
  </tr>
   <tr>
    <td valign="top"><div align="left">Gender:</div></td>
    <td valign="top"><?php echo $gender ?></td>
  </tr>
   <tr>
    <td valign="top"><div align="left">Campus:</div></td>
    <td valign="top"><?php echo $campus ?></td>
  </tr>

</table>

<div id="interactionResults" style="'font-size:15px; padding: 10px;"></div>
<div class="interactContainers" id="private_message">
  <form action="javascript:sendPM();" name="pmForm" id="pmForm" method="post">
    <font size="+1">Sending Private Message to <strong><em><?php echo $uid ?></em></strong></font><br/><br/>
    Subject:
    <input name="pmSubject" id="pmSubject" type="text" maxlength="64" style="width:98%;"/>
    Message:
    <textarea name="pmTextArea" id="pmTextArea" rows="8" style="width:98%;"></textarea>
    <input name="pm_sender_id" id="pm_sender_id"  value="<?php echo $_SESSION['userUid'] ?>"/>
    <input name="pm_rec_id" id="pm_rec_id"  value="<?php echo $uid ?>"/>
    <input name="pmWipit" id="pmWipit"  value="<?php echo $wipit ?>"/>
    <span id="PMStatus" style="color:#F00;"></span>
    <br/><input name="pmSubmit" type="submit" value="Submit"/>or<a href="feed.php" onmousedown="javascript:toggleInteractContainers('private_message');">Close</a>
 </form>
</div>
</php?>

</body>
</html>
