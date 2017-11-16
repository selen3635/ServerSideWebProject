<?php
  @session_start();
  $error;
  if(!isset($_SESSION['allowed']) || !$_SESSION["allowed"])
  {
    header('Location: http://138.197.198.28/hw3/index.php');
    die();
  }
  if(!isset($_SESSION['admin']) && $_SESSION['public'] == 1)
  {
    header('Location: http://138.197.198.28/hw3/index.php');
    die();
  }
  $user_dir=getcwd().'/files/xiz266@ucsd.edu/';
  if(!isset($_SESSION['admin']))
  {       
    $user_dir=getcwd().'/files/'.$_SESSION['emailAddress'].'/';
  }
  $board_dir=$user_dir.$_SESSION['title'].'/';
  $img_dir= $board_dir.'imgs/';
  $sound_dir=$board_dir.'sounds/';
  $img_file_path= $img_dir.$_FILES['myImage']['name'];
  $sound_file_path= $sound_dir.$_FILES['mySound']['name'];
  $ext = pathinfo($img_file_path, PATHINFO_EXTENSION);
  if($ext != 'jpg' && $ext != 'png' && $ext != 'jpeg')
  {
    header('HTTP/1.1 400 wrong image type!');
    $error='wrong image type';
  }
  $ext = pathinfo($sound_file_path, PATHINFO_EXTENSION);
  if($ext != 'mp3' && $ext != 'ogg'&& $ext != 'wav')
  {
    header('HTTP/1.1 400 wrong sound type!');
    $error='wrong sound type';
  }
  if(mime_content_type($_FILES['myImage']['tmp_name'])!='image/jpeg'&&
  (mime_content_type($_FILES['myImage']['tmp_name']))!='image/png')
  {
    header('HTTP/1.1 400 wrong image type!');
    $error='wrong image type';
  }
  if(mime_content_type($_FILES['mySound']['tmp_name'])!='audio/mpeg'&&
    mime_content_type($_FILES['mySound']['tmp_name'])!='audio/x-mpeg-3'&&
    mime_content_type($_FILES['mySound']['tmp_name'])!='audio/x-wav'&&
    mime_content_type($_FILES['mySound']['tmp_name'])!='audio/wav')
  {
    header('HTTP/1.1 400 wrong sound type!');
    $error='wrong sound type';
  }
  $img_file_path= $img_dir.urlencode($_FILES['myImage']['name']);
  $sound_file_path= $sound_dir.urlencode($_FILES['mySound']['name']);
  if(!($_FILES['mySound']['name'])||
  !($_FILES['mySound']['name']))
  {
    header('HTTP/1.1 400 file upload fails!');
    $error='file upload fails. Maybe it is too big';
  }
  else if(file_exists($sound_file_path))
  {
    header('HTTP/1.1 400 sound file name already exists!');
    $error='file already exist';
  }
  else if(file_exists($img_file_path))
  {
    header('HTTP/1.1 400 image file name already exists!');
    $error='file already exist';
  }
  if(isset($error))
  {
    echo $error;
    echo '<br><a href="private.php">return</a>';
    die();
  }
  else if(!move_uploaded_file($_FILES['myImage']['tmp_name'],$img_file_path))
  {
    header('HTTP/1.1 400 image file upload fails!');
    $error='image upload fails!';
  }
  else if(!move_uploaded_file($_FILES['mySound']['tmp_name'],$sound_file_path))
  {
    header('HTTP/1.1 400 sound file upload fails!');
    $error='sound upload fails!';
  }
  else if((filesize($img_file_path)/1024)/1024>2)
  {
    header('HTTP/1.1 400 image file toooooooo large!');
    $error='image file too large!!';
    exec("rm $img_file_path");
    exec("rm $sound_file_path");
  }
  else if((filesize($sound_file_path)/1024)/1024>5)
  {
    header('HTTP/1.1 400 sound file toooooooo large!');
    $error='sound file too large!';
    exec("rm $sound_file_path");
    exec("rm $img_file_path");
  }
  if(isset($error))
  {
    echo $error;
    echo '<br><a href="private.php">return</a>';
    die();
  }
  else
  {
    require_once('config.inc');
    $temp="insert into sounds (sound_name,sound_path,image_path,".
       "soundboard_id) values ('".urlencode($_FILES['mySound']['name'])."','".
      $sound_file_path."','".$img_file_path."','".$_SESSION['boardid']."')";
$result = mysqli_query($conn, $temp);
  if(!$result)
  {
    header('HTTP/1.1 400 fail to insert into database!');
    die();
  }
  else
  {
     header("Location: http://138.197.198.28/hw3/private.php");
  }
  $info = getimagesize($img_file_path);
  if($info["mime"]=="image/jpeg")
  {
    $image=imagecreatefromjpeg($img_file_path);
  }
  else if($info["mime"]=="image/png")
  {
    $image=imagecreatefrompng($img_file_path);
  }
  $size = filesize($img_file_path);
  $size = $size / 1024;
  if($size > 100)
  {
    $rate=10;
  }
  else if(100>$size&&$size>25)
  {
    $rate=50;
  }
  else
  {
    $rate=75;
  }
  imagejpeg($image, $img_file_path, $rate);

  $info = pathinfo($_FILES["mySound"]["name"]);
  $soundNewPath= $sound_dir.urlencode($info["filename"]."1.mp3");
  exec("ffmpeg -i $sound_file_path -b:a 32k $soundNewPath");
  exec("rm $sound_file_path");
  exec("mv $soundNewPath $sound_file_path");
  
?>
<!--<!DOCTYPE html>
<html>
  <head>-->
    <?php //echo "<title> welcome back ".$_SESSION['firstName'].
  //    " ".$_SESSION["lastName"]."</title>" ?>
   <!-- <link href="main.css" rel="stylesheet">
    <script src="myScript.js"></script>
  </head>
  <body>
    <div class="head">
        <p>sound board</p>
    <button type="button" class="btn" onClick="signOut()">Logout</button>
    </div>-->
  <?php
    //include("sounds.php");
    }
  ?>
  <!--</body>
</html>--> 
