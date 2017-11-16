<?php
  @session_start();

  if(!$_REQUEST['emailAddress'])
  {
    header('HTTP/1.1 400 Please enter your email address');
    die();
  }
  if(!$_REQUEST['password'])
  {
    header('HTTP/1.1 400 Please enter your password');
    die();
  }
  if($_SERVER['REQUEST_METHOD'] == 'GET')
  {
    header('HTTP/1.1 400 bad request');
    die();
  }
  $emailAddress = $_POST['emailAddress'];
  $password = $_POST['password'];
  require_once 'config.inc';
  $temp = "SELECT * FROM users where email='$emailAddress'";
  $result = mysqli_query($conn, $temp);
  if(mysqli_num_rows($result)==0)
  {
    header("HTTP/1.1 400 Please enter correct email address and password");
    die();
  }
  $row = mysqli_fetch_array($result,MYSQLI_NUM);
  $code = md5($password.$salt);
  if($code != $row[4])
  {
    $info="insert into logInfo (email,login,date) VALUES 
    ('$emailAddress','0','" . date("l jS \of F Y h:i:s A")."')";
    $res = mysqli_query($conn,$info);
    header("HTTP/1.1 400 Please enter correct email address and password");
    die();
  }
  $info="insert into logInfo (email,login,date) VALUES 
  ('$emailAddress','1','" . date("l jS \of F Y h:i:s A")."')";
  $res = mysqli_query($conn,$info);
  $_SESSION["firstName"] = $row[1];
  $_SESSION["lastName"] = $row[2];
  $_SESSION["emailAddress"] = $row[3];
  $_SESSION['allowed'] = true;
  if($emailAddress=="xiz266@ucsd.edu")
  {
    $_SESSION["admin"] = true;
  }
  include('private.php');
  mysqli_close($conn);
?>
