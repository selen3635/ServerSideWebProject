<?php
  @session_start();
  $title;
  require_once("config.inc");
  $public;
  if(isset($_POST["title"]))
  {
    global $title;
    global $public;
    $title=$_POST["title"];
    $title=urlencode($title);
    $public=$_POST["public"];
    $_SESSION["title"] = $title;
    $_SESSION["public"]=$public;
  }
  else
  {
    global $title;
    global $public;
    $title=$_SESSION["title"];
    $public=$_SESSION["public"];
  }
  echo "<h3>".urldecode($title)."</h3>";
  echo "<div class='content'>";
  if($public == "1")
  {
    $temp="select * from soundboards where title='".$title.
    "' and public = '1'";
    $log="update soundboards set total_access=total_access+1 where title='".
    $title."' and public='1'";
  }
  else
  {
    if(!isset($_SESSION["allowed"]))
    {
      header("HTTP/1.1 400 please login first");
      die("please login first");
    }
    $temp="select * from soundboards where title='".$title.
     "' and user_email = '".$_SESSION["emailAddress"]."'";
    $log="update soundboards set total_access=total_access+1 where title='".$title.
     "' and user_email = '".$_SESSION["emailAddress"]."'";
  }
  if(isset($_POST["title"]))
  {
    $info=mysqli_query($conn,$log);
  }
  $result=mysqli_query($conn,$temp);
  if(mysqli_num_rows($result)==0)
  {
    header("HTTP/1.1 400 You don't have this soundboard!");
    die();
  }
  $row=mysqli_fetch_row($result);
  $_SESSION['boardid']=$row[0];
  $getsounds = "select * from sounds where soundboard_id='".
  $row[0]."'";
  $result=mysqli_query($conn,$getsounds);
  if(mysqli_num_rows($result)==0)
  {
    if(isset($_SESSION['emailAddress']))
    {
      echo "<p class='empty'>Please add some sounds!</p>";
    }
    else
    {
      echo '<p class="empty">No sound in this soundboard!</p>';
    }
  }
  while($row=mysqli_fetch_row($result))
  {
    include("soundTable.php");
  }
?>
</div>
<?php 
if(isset($_SESSION["allowed"]))
 { ?>
<?php 
if($_SESSION["public"]!=1||(isset($_SESSION["admin"]))){?>
<div class="myBtn" onClick="showUploadForm()">
</div>
<?php } ?>
<form class="return" action="private.php" method="POST">
  <input class="submit" type="submit" value="return" name="return">
</form>
<?php } else
{?>
<form class="return" action="publicboard.php" method="POST">
  <input class="submit"type="submit" value="return" name="return">
</form>
<?php }?>
<div class="abc">
  <div class="popupContact">
    <form action="soundAction.php" method="POST" name="form"
      enctype="multipart/form-data">
      <h2>Upload your image and sound </h2>
      <hr>
      <label><h5>Upload an image</h5>
      <input id="myImage" name="myImage"
        placeholder="Upload a image" type="file" required></label>
      <label><h5>Upload an audio</h5>
      <input id="mySound" name="mySound"
        placeholder="Upload an audio" type="file" required></label>
      <button type="submit" class="submit">Upload Image/Audio</button>
      <button class="submit" type="button"
        onClick="hideUploadForm()">Cancel</button>
    </form>
  </div>
</div>

  <div class="abc">
    <div class="popupContact">
      <form action="#" method="POST" name="form">
        <h2>Are you sure to delete it??? </h2>
        <hr>
        <button class="submit" type="button" onClick="delS()" name="action"
          value="addSoundBoard">Delete</button>
        <button class="submit" type="button"
        onClick="hidedelS()">Cancel</button>
      </form>
    </div>
  </div>
