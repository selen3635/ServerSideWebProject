<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ECHO</title>
</head>
    <?php
        $FirstName;
        $LastName;
        $myColor;
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            global $FirstName,$LastName,$myColors;
            $FirstName = $_POST['FirstName'];
            $LastName = $_POST['LastName'];
            $myColor = $_POST['color'];
        }
        else
        {
            global $FirstName,$LastName,$myColors;
            $FirstName = $_GET['FirstName'];
            $LastName = $_GET['LastName'];
            $myColor = $_GET['color'];
        }
         echo "<body style='background-color:$myColor'>";
         echo "Hello ".$FirstName. " ".$LastName." from a Web app written in php
on data time."
    ?>
</body>
</html>
