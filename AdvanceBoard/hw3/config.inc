<?php
  define('DB_USER', 'root');
  define('DB_PASSWORD', 'xlmxck135');
  define('DB_NAME', 'soundboard');
  define('DB_HOST', '127.0.0.1');

  $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
  $salt = 'welcome';
  if(!$conn)
  {
    die("Connection failed: ". mysqli_connect_error());  
  }
?>
