<?php
  session_start();
  
  if($_SERVER['REQUEST_METHOD'] === 'GET')
  {
    header('HTTP/1.1 400 Don\'t do this !!!!');
    die('Hello! Are you trying to heck our website???? aha');
  } 
  if(!$_REQUEST['firstName'])
  {
    header('HTTP/1.1 400 Please enter valid first name');
    die('Please enter valid first name'); 
  }

  $firstName = $_REQUEST['firstName'];
  if(!ctype_alpha($firstName))
  {
    header('HTTP/1.1 400 Please enter valid alphabetical first name');
    die();
  }

  if(strlen($firstName) > 25)
  {
    header('HTTP/1.1 400 First name can\'t be over 25 characters');
    die();
  }

  if(!$_REQUEST['lastName'])
  {
    header('HTTP/1.1 400 Please enter valid last name');
    die('Please enter valid last name'); 
  }

  $lastName = $_REQUEST['lastName'];
  if(!ctype_alpha($lastName))
  {
    header("HTTP/1.1 400 Please enter valid alphabetical last name");
    die();
  }

  if(strlen($lastName) > 35)
  {
    header('HTTP/1.1 400 Last name can\'t be over 35 characters');
    die();
  }

  if(!$_REQUEST['emailAddress'])
  {
    header('HTTP/1.1 400 Please enter valid email address');
    die('Please enter valid email address'); 
  }

  $emailAddress = $_REQUEST['emailAddress'];
  if(strlen($emailAddress) > 40)
  {
    header('HTTP/1.1 400 email address can\'t be over 40 characters');
    die();
  }

  preg_match('/[A-Za-z0-9@.]*/',$emailAddress,$output);
  if($output[0]!==$emailAddress)
  {
    header('HTTP/1.1 400 email address can only contain @, ., numbers and alphabets!');
    die();
  }
  if(!$_REQUEST['password'])
  {
    header('HTTP/1.1 400 Password can\'t be empty');
    die('Password can\'t be empty'); 
  }

  $password = $_REQUEST['password'];
  if(strlen($password) > 30)
  {
    header('HTTP/1.1 400 Password can\'t be over 30 characters');
    die();
  }

  require_once 'config.inc';  
  $password = md5($password.$salt);

  $temp = "SELECT * FROM users WHERE email='$emailAddress'";
  $checkEmail = mysqli_query($conn, $temp);
  if(mysqli_num_rows($checkEmail))
  {
    header("HTTP/1.1 400 This email address already exist");
    die();
  }

  $sql = "INSERT INTO users (first_name, last_name, email, password) VALUES
  ('$firstName', '$lastName', '$emailAddress', '$password')";
  $result = mysqli_query($conn, $sql);
  $dir=getcwd().'/files/'.$emailAddress;
  mkdir($dir);
  chmod($dir,0777);
  $_SESSION['firstName'] = $firstName;
  $_SESSION['lastName'] = $lastName;
  $_SESSION['emailAddress'] = $emailAddress;
  $_SESSION['allowed'] = true;
  if($emailAddress == "xiz266@ucsd.edu")
  {
    $_SESSION["admin"] = true;
  }
  include('private.php');
  mysqli_close($conn);
?>
