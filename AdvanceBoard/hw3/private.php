<?php
  @session_start();
  if(!isset($_SESSION["allowed"]))
  {
      header("Location: http://138.197.198.28/hw3/index.php");
      die();
  }
  if(isset($_POST["return"]))
  {
    unset($_SESSION["title"]);
    unset($_SESSION["boardid"]);
    unset($_SESSION["public"]);
  }
?>
<!DOCTYPE html>
<html>
  <head>
    
    <?php
      if(isset($_SESSION["firstName"]))
      { 
      echo "<title> welcome back ".$_SESSION['firstName'].
      " ".$_SESSION["lastName"]."</title>";} ?>
    <link href="main.css" rel="stylesheet">
    <script src="myScript.js"></script>
  </head>
  <body>
    <div class="head">
      <p>sound board</p>
    <?php if(isset($_SESSION["allowed"]))
    {?>
    <button type="button" class="btn" onClick="signOut()">Logout</button>
     <?php }?>
    </div>
    <?php
      if(!isset($_SESSION["boardid"])&&!isset($_POST["title"]))
      {
      require_once("config.inc");
      if(isset($_SESSION["allowed"])&&!isset($_SESSION["admin"]))
      {
        echo "<h3>private soundboards</h3><br>";
        echo "<div class='content'>";
        $temp = "select title,public from soundboards where user_email ='".
          $_SESSION['emailAddress']."'";
        $result = mysqli_query($conn, $temp);
        while ($row=mysqli_fetch_row($result))
        {
          include('soundboard.php');
        }
        include('button.html');
        echo "</div>";
        echo "<hr>";
      }
      echo "<h3>public soundboards</h3><br>"; 
      echo "<div class='content'>";
      
      $temp = "select title,public from soundboards where public ='1'";
      $result = mysqli_query($conn, $temp);
      while ($row=mysqli_fetch_row($result))
      {
        include('soundboard.php');
      }
      if(isset($_SESSION["admin"]))
      {
        include('button.html');
      }
      echo "</div>";
     ?>
  <?php 
  if(!isset($_SESSION["title"])) 
  {?>
  <div class="abc">
    <div class="popupContact">
      <form action="#" method="POST" name="form">
        <h2>type in the name of your soundboard </h2>
        <hr>
        <input id="newtitle" name="newtitle"
          placeholder="A new name for sound board" type="text" required>
        <button class="submit" type="button" onClick="editSB()" name="action"
          value="addSoundBoard">Update</button>
        <button class="submit" type="button" onClick="hideSBedit()">Cancel</button>
      </form>
    </div>
  </div>

  <div class="abc">
    <div class="popupContact">
      <form action="#" method="POST" name="form">
        <h2>Are you sure to delete it??? </h2>
        <hr>
        <button class="submit" type="button" onClick="delSB()" name="action"
          value="addSoundBoard">Delete</button>
        <button class="submit" type="button" onClick="cancelDel()">Cancel</button>
      </form>
    </div>
 <?php
  }
  }
  else
  {
    include("sounds.php");
  }
 ?>
  </body>
</html>
