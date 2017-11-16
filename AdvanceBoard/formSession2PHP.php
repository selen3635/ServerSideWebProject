<?php
  session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Form response: PHP version</title>
</head>
<body>
  <?php
  if(!empty($_SESSION['FirstName'])&&
     !empty($_SESSION['LastName']))
  {
    echo "Hi ".$_SESSION['FirstName'].' '.
    $_SESSION['LastName'].' nice to meet you!<br>';
  }
  else
  {
    echo 'Howdy stranger...tell me your name on page1!<br>';
  } 
 
  ?>
  <button type="button" onclick="clearSession()">Clear Session</button>
  <script>
  function clearSession()
  {
    var xhttp = new XMLHttpRequest();
    xhttp.open("GET", "http://138.197.198.28/logout.php", true);
    xhttp.send();
  }
  </script>
</body>
</html>
