<?php
  session_start();
  if(!$_POST["action"]=="listenToSound")
  {
    if(!isset($_SESSION["allowed"]) || !$_SESSION["allowed"] || 
      $_SERVER["REQUEST_METHOD"] == "GET")
    {
       header("Location: http://138.197.198.28/hw3/index.php");
       die();
    }
  }

  require_once("config.inc");
  if($_POST["action"]=="addSoundBoard")
  {
    $title=$_POST["myBoardName"];
    if($title=="")
    {
        header("HTTP/1.1 400 enter your board name!");
        die();
    }
    $title=urlencode($title);
    if(isset($_SESSION["admin"]))
    {
      $temp="select * from soundboards where title = '".$title.
      "' AND public ='1'";
      $value = mysqli_query($conn, $temp);
      if(mysqli_num_rows($value)!=0)
      {
        header("HTTP/1.1 400 soundboard name already exist!");
        die();
      }
      $tempo="insert into soundboards (title,public) values ('".
      $title."', '1')";
      $result = mysqli_query($conn, $tempo);
      if(!$result)
      {
         header("HTTP/1.1 500 insertion fails");
      } 
    }
    else
    {
      $temp="select * from soundboards where title = '".$title.
      "' AND user_email ='".$_SESSION['emailAddress']."'";
      $value = mysqli_query($conn, $temp);
      if(mysqli_num_rows($value)!=0)
      {
        header("HTTP/1.1 400 soundboard name already exist!");
        die();
      }
      $tempo="insert into soundboards (title,user_email) values ('".
      $title."', '".$_SESSION['emailAddress']."')";
      $result = mysqli_query($conn, $tempo);
      if(!$result)
      {
         header("HTTP/1.1 500 insertion fails");
      } 
    }

    $dir=getcwd()."/files/".$_SESSION["emailAddress"]."/".$title;
    mkdir($dir);
    chmod($dir,0755);
    mkdir($dir."/imgs");
    mkdir($dir."/sounds");
    chmod($dir."/imgs",0755);
    chmod($dir."/sounds",0755);
  }

        
  if($_POST["action"]=="deleteSoundBoard")
  {
    $title=$_POST["title"];
    $title=urlencode($title);
    if(isset($_SESSION["admin"]))
    {
      $board="select * from soundboards where title='".$title.
      "' AND public='1'";
      $res=mysqli_query($conn, $board);
      $row=mysqli_fetch_row($res);
      $soun="delete from sounds where soundboard_id='".$row[0]."'";
      $res=mysqli_query($conn,$soun);
      if(!$res)
      {
         header("HTTP/1.1 500 deletion fails");
      } 
      $tempo="delete from soundboards where title='".$title.
      "' AND public='1'";
      $result = mysqli_query($conn, $tempo);
      if(!$result)
      {
         header("HTTP/1.1 500 deletion fails");
      } 
    }
    else
    {
      $board="select * from soundboards where title='".$title.
      "' AND user_email ='".$_SESSION['emailAddress']."'";
      $res=mysqli_query($conn, $board);
      $row=mysqli_fetch_row($res);
      $soun="delete from sounds where soundboard_id='".$row[0]."'";
      $res=mysqli_query($conn,$soun);
      if(!$res)
      {
         header("HTTP/1.1 500 deletion fails");
      } 
      $temp="delete from soundboards where title = '".$title.
      "' AND user_email ='".$_SESSION['emailAddress']."'";
      $value = mysqli_query($conn, $temp);
      if(!$value)
      {
         header("HTTP/1.1 500 deletion fails");
         die();
      } 
    }
    $dir=getcwd()."/files/".$_SESSION["emailAddress"]."/".$title;
    exec("rm -r $dir"); 
  }

  if($_POST['action'] == "editSoundBoard")
  {
    $newTitle = $_POST['newTitle'];
    $newTitle=urlencode($newTitle);
    $oldTitle = $_POST['oldTitle'];
    $oldTitle=urlencode($oldTitle);
    if($newTitle=="")
    {
        header("HTTP/1.1 400 enter your board name!");
        die();
    }
    if(isset($_SESSION['admin']))
    {
      $temp = "select soundboard_id from soundboards".
      " WHERE title='".$newTitle."' AND public='1'";
      $result=mysqli_query($conn, $temp);
      if(mysqli_num_rows($result) != 0)
      {
          header("HTTP/1.1 400 new Title exists!");
          die();
      }
      $temp = "UPDATE soundboards SET title ='".$newTitle.
      "' WHERE title='".$oldTitle."' AND public='1'";
      $result = mysqli_query($conn, $temp);
      if(!$result)
      {
        header("HTTP/1.1 500 update failed");
        die();
      }
      $temp = "select soundboard_id from soundboards".
      " WHERE title='".$newTitle."' AND public='1'";
      $result=mysqli_query($conn,$temp);
      $row=mysqli_fetch_row($result);
      $dir=getcwd()."/files/".$_SESSION["emailAddress"]."/".$newTitle."/";
      $temp = "select * from sounds where soundboard_id='".$row[0]."'";
      $id=$row[0];
      $result=mysqli_query($conn,$temp);
      while($row=mysqli_fetch_row($result))
      {
        $temp = "update sounds set image_path='".$dir."imgs/".
                basename($row[2])."',sound_path='".$dir."sounds/".
                basename($row[1])."' where soundboard_id='$id'";
        $resulttwo=mysqli_query($conn,$temp);
      }
      exec("mv files/".$_SESSION["emailAddress"]."/".$oldTitle." files/".$_SESSION["emailAddress"]."/".$newTitle);
    }
    else
    {
      $temp = "select soundboard_id from soundboards".
      " WHERE title='".$newTitle."' AND user_email='".
      $_SESSION['emailAddress']."'";
      $result=mysqli_query($conn, $temp);
      if(mysqli_num_rows($result) != 0)
      {
          header("HTTP/1.1 400 new Title exists!");
          die();
      }
      $temp = "UPDATE soundboards SET title='".$newTitle.
      "' WHERE title='".$oldTitle."' AND user_email ='".
      $_SESSION['emailAddress']."'";
      $value = mysqli_query($conn, $temp);
      if(!$value)
      {
        header("HTTP/1.1 500 update failed");
        die();
      }
      $temp = "select soundboard_id from soundboards".
      " WHERE title='".$newTitle."' AND user_email ='".
      $_SESSION['emailAddress']."'";
      $result=mysqli_query($conn,$temp);
      $row=mysqli_fetch_row($result);
      $dir=getcwd()."/files/".$_SESSION["emailAddress"]."/".$newTitle."/";
      $temp = "select * from sounds where soundboard_id='".$row[0]."'";
      $id=$row[0];
      $result=mysqli_query($conn,$temp);
      while($row=mysqli_fetch_row($result))
      {
        $temp = "update sounds set image_path='".$dir."imgs/".
                basename($row[2])."',sound_path='".$dir."sounds/".
                basename($row[1])."' where soundboard_id='$id'";
        $resulttwo=mysqli_query($conn,$temp);
      }
      exec("mv files/".$_SESSION["emailAddress"]."/".$oldTitle." files/".$_SESSION["emailAddress"]."/".$newTitle);
    }
    
  }
  if($_POST["action"]=="deleteSound")
  {
    if(!isset($_SESSION["allowed"]))
    {
      header("Location: http://138.197.198.28/hw3/index.php");
      die();
    }
    if($_SESSION["public"]=="1" && !isset($_SESSION["admin"]))
    {
      header("Location: http://138.197.198.28/hw3/index.php");
      die();
    }
    $soundname = basename($_POST["path"]);
    $boardid=$_POST["boardid"];
    $imgname = basename($_POST["image_path"]);
    $temp = "delete from sounds where sound_name='$soundname' and soundboard_id='$boardid'";
    $result=mysqli_query($conn, $temp);
    if(!$result)
    {
      header("HTTP/1.1 500 delete failed");
      die();
    }
    
    unlink("files/".$_SESSION["emailAddress"]."/".$_SESSION["title"]."/sounds/".
    $soundname);
    unlink("files/".$_SESSION["emailAddress"]."/".$_SESSION["title"]."/imgs/".
    $imgname);
    
  }
  if($_POST["action"] =="listenToSound")
  {
    $name = basename($_POST["soundName"]);
    $id = $_SESSION['boardid'];
    $temp = "update sounds set total_access = total_access +1 where
sound_name='$name' and soundboard_id='$id'";
    $result = mysqli_query($conn, $temp);
  }
  mysqli_close($conn);
?>
