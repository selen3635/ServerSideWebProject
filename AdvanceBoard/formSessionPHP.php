<?php
  session_start();
?>

<!DOCTYPE html>
<html>
<head>
  <title>Form Session: PHP version</title>
</head>
<body>
  <form action="#" method = "#">
    <fieldset>
      <legend>Personal Information</legend>
            <label class="fName">First Name:
            <input type="text" name="FirstName" id="FirstName"></label><br>
            <label class="lName">Last Name:
            <input type="text" name="LastName" id="LastName"></label><br>
            <button type="button" onclick="saveData()">Submit</button>
    </fieldset>
  </form>
  <a href='formSession2PHP.php'>Go to second page</a>
  <script>
    function saveData()
    {
      var firstName = document.getElementsByName('FirstName')[0].value;
      var lastName = document.getElementsByName('LastName')[0].value;
      var xhttp = new XMLHttpRequest();
      xhttp.open("POST", "http://138.197.198.28/action.php", true);
      xhttp.setRequestHeader("Content-type",
"application/x-www-form-urlencoded");
      xhttp.send("FirstName="+firstName + "&LastName="+lastName);
    }
  </script>
</body>
</html>
