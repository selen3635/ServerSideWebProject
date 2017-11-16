<?php  
  $html = "<!doctype html>\n";
  $html .= "<html>\n<head>\n<title>Hello PHP</title>\n</head>\n";
  $rand = rand(1, 3);
  if($rand == 1)
  {
    $html .= "<body style=\"background-color:blue\">";
  }
  else if($rand == 2)
  {
    $html .= "<body style=\"background-color:red\">";
  }
  else
  {
    $html .= "<body style=\"background-color:white\">";
  }
  $html .= "\n<h1>Hello World</h1>\n";
  $html .= "<h2>". date("h:i:sa")."</h2>";
  $html .= "<br>";
  print $html;
  var_dump($_ENV);

  print "\n</body>\n</html>" ;
?>
