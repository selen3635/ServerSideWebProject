
<?php
  @session_start();
  if(isset($_REQUEST["return"]))
  {
    header("Location: http://138.197.198.28/hw3/index.php");
    unset($_SESSION["title"]);
    unset($_SESSION["boardid"]);
    unset($_SESSION["public"]);
    die();
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <?php 
      echo "<title> Sample boards</title>";?>
    <link href="main.css" rel="stylesheet">
    <script src="myScript.js"></script>
  </head>
  <body>
    <div class="head">
        <p>sound board</p>
     </div> 
 <?php
    include("sounds.php");
 ?>
  </body>
</html>
