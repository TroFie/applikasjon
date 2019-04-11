<?php
require 'dbh.inc.php';
session_start();
?>
<?php
if(!isset($_SESSION['userUid'])){
	echo "Session timed out";
	exit();
}
$decryptedID = $_SESSION['userUid'];
$id_array = explode("p3h9xfn8sq03hs2234", $decryptedID);
$my_id = $id_array[0];


$thisRandNum = rand(99999999, 999999999);
$_SESSION['wipit'] = $thisRandNum;
?>
<?php
if(isset($_POST['deleteBtn'])){
	require 'dbh.inc.php';
	foreach ($_POST as $key => $value) {
		$value = urlencode(stripslashes($value));
		if ($key != "deleteBtn") {
			$sql = mysqli_query($conn, "UPDATE private_messages SET opened='1', recipientDelete='1' WHERE id='$value' LIMIT 1");
			
		}
	}
	header("location: pm_inbox2.php");
}
?>
<html>

<head>
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
  <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
     <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="../style.css" />

<script language="javascript" type="text/javascript">

    function toggleChecks(field){
    if (document.myform.toggleAll.checked==true){
      for (i = 0; i<10000; i++) {
        field[i].checked = true;
      }
    }else
     {
      for(i = 0; i<10000; i++){
        field[i].checked = false;
      }
    }
    }
    $(document).ready(function(){
  	$(".toggle").click(function(){
  		if($(this).next().is(":hidden")){
  			$(".hiddenDiv").hide();
  			$(this).next().slideDown("fast");
  		}else{
  			$(this).next().hide();
  		}
  		});
  		});
    function toggleReplyBox(subject,senderid,recID,replyWipit){
  	$("#subjectShow").text(subject);
  	$("#recipientShow").text(recID);
  	document.replyForm.pmSubject.value = subject;
  	document.replyForm.pm_sender_id.value = senderid;
    document.replyForm.pm_rec_id.value = recID;
  	document.replyForm.replyBtn.value = "Send reply to " + recID;
  	document.replyForm.pmWipit.value = replyWipit;
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
  var recID = $("#pm_rec_id");
  var pm_wipit = $("#pmWipit");
  var url = "private_msg_parse.php";
  if(pmTextArea.val()==""){
  $("#PMStatus").text('Please type a message').show();
} else {
  $.post(url,{subject: pmSubject.val(), message: pmTextArea.val(), senderID: senderid.val(), rcpntID: recID.val(), thisWipit: pm_wipit.val()}, function(data){
  	document.replyForm.pmTextArea.value="";
    $('#replyBox').slideUp("fast");
    $("#PMFinal").html("&nbsp; &nbsp;"+data).show().fadeOut(8000);
  });
}
}
  function markAsRead(msgID, ownerID){
  	$.post("markAsRead.php",{messageid:msgID, ownerid:ownerID}, function(data){
  		$('#subj_line_'+msgID).addClass('msgRead');
  	});
  }

</script>
<style type="text/css">
.hiddenDiv{display:none}
.replyBoxes{display:none;border:#999 1px solid;background-color:#CCC;margin-left:100px;margin-right:100px;padding:12px;}
.msgDefault{font-weight:bold;}
.msgRead{font-weight:100;color:#666;}
</style>
</head>

<header>
    <div class="container">
    <img src="../bilder/yippee.png" alt="">
    </div>
      <nav class="navbar">
          <ul> 
              <li><a href=../feed.php>     Feed       </a></li> 
              <li><a href=#>            Kontakt    </a></li> 
              <li><a href=../minSide.php>  Min Side     </a></li> 
              <li><a href=#>            FAQ        </a></li>
              <li><a href=pm_inbox2.php>            Inbox        </a></li>
              <li><a href=../campus.php>            Campus        </a></li>
          </ul>
      </nav>
  </header>

<body>
<table width="920" style="background-color:#F2F2F2; margin-left:500px; margin-top:100px"; border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="732" valign="top">
    <h2 style="margin-left: 24px;">Your Private Messages</h2>

    <form name="myform" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">
      <table width="94%" border="0" align="center" cellpadding="4">
        <tr>
          <td width="3%" align="right" valign="bottom"></td>
          <td width="97%" valign="top"><input type="submit" name="deleteBtn" id="deleteBtn" value="Delete"/>
          <span id=jsbox style="display:none;"></span>
          </td>
          </tr>
          </table>  
      <table width="96%" border="0" align="center" cellpadding="4" style="border: #999 1px solid;">
        <tr>
          <td width="4%" valign="top">
            <input name="toggleAll" id="toggleAll" type="checkbox" onclick="toggleChecks(document.myform.cb)"/>
          </td>
          <td width="20%" valign="top">From</td>
          <td width="58%" valign="top"><span class="style2">Subject</span></td>
          <td width="18%" valign="top">Date</td>
        </tr>
      </table>
      <?php
      $sql = mysqli_query($conn, "SELECT * FROM private_messages WHERE to_id='$my_id' AND recipientDelete='0' ORDER BY id DESC LIMIT 100");
      while ($row = mysqli_fetch_array($sql)) {
        $date = strftime("%b%d, %Y", strtotime($row['time_sent']));
        if($row['opened']=="0"){
          $textWeight = 'msgDefault';
        }else{
          $textWeight = 'msgRead';
        }
        $fr_id = $row['from_id'];
        $ret = mysqli_query($conn, "SELECT idUsers, uidUsers FROM users WHERE uidUsers='$fr_id' LIMIT 1");
        while($raw = mysqli_fetch_array($ret)){$Sid = $raw['uidUsers']; $Sname = $raw['uidUsers'];}
        ?>
        <table width="96%" border="0" align="center" cellpadding="4">
          <tr>
            <td width="4%" valign="top">
              <input type="checkbox" name="cb<?php echo $row['id']?>" id="cb" value="<?php echo $row['id']?>">
            </td>
            <td width="20%" valign="top"><a href="../bruker.php?uid=<?php echo $Sid;?>"><?php echo $Sname;?></a></td>
            <td width="58%" valign="top">
              <span class="toggle" style="padding:3px;">
                <a class="<?php echo $textWeight;?>" id="subj_line_<?php echo $row['id'];?>" style="cursor:pointer;" onclick="markAsRead('<?php echo $row['id'];?>','<?php echo $my_id;?>')">
            <?php echo stripslashes($row['subject']);?></a>
          </span>
          <div class="hiddenDiv"><br/>
            <?php echo stripslashes(wordwrap(nl2br($row['message']),54,"\n",true));?>
            <br/><br/><a href="javascript:toggleReplyBox('<?php echo stripslashes($row['subject']);?>','<?php echo $my_id;?>','<?php echo $Sname;?>','<?php echo $thisRandNum;?>','<?php echo $fr_id;?>',)">REPLY</a><br/>
          </div>
        </td>
        <td width="18%" valign="top"><span style="font-size:10px;"><?php echo $date;?></span></td>
      </tr>
    </table>
<hr style="margin-left:20px; margin-right:20px;"/>
  <?php
}
?> 
</form>
<div id="replyBox" style="display:none; width:680px; height:264px; background-color:rgb(62, 136, 73); background-repeat:repeat; border-radius:5px; top:451px; left:600px; position:fixed; margin:auto; z-index:50; padding:20px; color:#FFF;">
<div align="right"><a href="javascript:toggleReplyBox('close')"><font color="white"><strong>CLOSE</strong></font></a></div>
<h2>Replying to <span style="color:white;" id="recipientShow"></span></h2>  
Subject: <strong><span style="color:#ABE3FE;" id="subjectShow"></span></strong><br>
<form action="javascript:processReply();" name="replyForm" id="replyForm" method="post">
    <textarea id="pmTextArea"  rows="8" style="width:98%;"></textarea>
    <input type="hidden" id="pmSubject">
    <input type="hidden" id="pm_rec_id">
    <input type="hidden" id="pm_sender_id">
    <input type="hidden" id="pmWipit">
    <span id="PMStatus" style="color:#F00;"></span>
    <br/>
    <input name="replyBtn" type="button" onclick="javascript:processReply()"/> &nbsp;&nbsp;&nbsp;
    <div id="PMStatus" style="color:F00; font-size:14px; font-weight:700;">&nbsp;</div>
 </form>
</div>
<div id="PMFinal" style="display:none;width:652px;background-color:#005900;border:#666 1px solid;top:51px;position:fixed;margin:auto;z-index:50;padding:40px;color:#FFF; font-size:16px;"></div>

</body>
</html>
