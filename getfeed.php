<?php
  
      $q = ($_GET['q']);

       require 'connect.php';
       $sql="SELECT * FROM melding, users WHERE users.uidUsers=melding.uidUsers AND users.campusUsers = '".$q."' ORDER BY id DESC";
       $getQuery = mysqli_query($conn, $sql);
      
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

