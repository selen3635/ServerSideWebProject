<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Amazing SoundBoard</title>
    <link href="main.css" rel="stylesheet">

    <script src="myScript.js"></script>
</head>
<body>
  <noscript>
    Your browers doesn't support JavaScript. 
  </noscript>
    <div class="head">
        <p>Sound Board</p>
        <button type="button" class="btn" onClick="showLogin()">Login</button>
        <div class="abc">
            <!-- Popup Div Starts Here -->
            <div class="popupContact">
                <!-- Contact Us Form -->
                <form action="signIn.php" method="post" name="form">
                    <h2>Log In</h2>
                    <hr>
                    <input id="loginEmail" name="emailAddress" placeholder="Email" type="text">
                    <input id="loginPassword" name="password"
                      placeholder="Password" type="password">
                    <button type="button" onClick="check_empty()" class="submit">Login</button>
                    <button type="button" class="submit" onClick="hideLogin()">Cancel</button>
                </form>
            </div>
            <!-- Popup Div Ends Here -->
        </div>
        <button type="button" class="btn" onClick="showSignup()">Sign Up</button>
        <div class="abc">
            <!-- Popup Div Starts Here -->
            <div class="popupContact">
                <!-- Contact Us Form -->
                <form action="signUp.php" method="post" name="form">
                    <h2>Sign Up</h2>
                    <hr>
                    <input id="firstName" name="firstName" placeholder="First Name" type="text">
                    <input id="lastName" name="lastName" placeholder="Last Name" type="text">
                    <input id="signupEmail" name="emailAddress" placeholder="Email" type="text">
                    <input id="signupPassword" name="password"
placeholder="Password" type="password">
                    <input id="checkPassword" placeholder="PasswordAgain"
type="password">
                    <button type="button" onClick="checkSignup()" class="submit">Sign Up</button>
                    <button type="button" class="submit" onClick="hideSignup()">Cancel</button>
                </form>
            </div>
            <!-- Popup Div Ends Here -->
        </div>
    </div>
    <h3>public soundboards:</h3><br>
    <div class="content">
      <?php
          @session_start();
          if(isset($_REQUEST["return"]))
          {
            unset($_SESSION["title"]);
            unset($_SESSION["boardid"]);
            unset($_SESSION["public"]);
          }
          if(isset($_SESSION["allowed"]) && $_SESSION["allowed"])
          {
              header("Location: http://138.197.198.28/hw3/private.php");
              die();
          }
          require_once("config.inc");
          $temp = "select title from soundboards where public ='1'";
          $result = mysqli_query($conn, $temp);
          while($row = mysqli_fetch_row($result))
          {
            include("soundboard.php");
          } 
      ?>
    </div>
</body>
</html>
