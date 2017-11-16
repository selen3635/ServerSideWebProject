#!/usr/bin/perl
use CGI::Session;

$session = CGI::Session->new();
print $session->header();

my $html = "
<!DOCTYPE html>
<html>
<head>
  <title>Form response: CGI version</title>
</head>
<body>";
if ($session->param("FirstName") && $session->param("LastName"))
{
  $html .= "Hi, " . $session->param("FirstName")." ".
  $session->param("LastName")." nice to meet you!<br>";
}
else
{
  $html .= "Howdy stranger...tell me your name on page1!<br>";
}

$html .= "<button type=\"button\" onclick=\"clearSession()\">Clear Session";
$html .= "</button>";
$html .= "<script>\n function clearSession(){\n";
$html .= "var xhttp = new XMLHttpRequest();\n";
$html .= "xhttp.open(\"GET\", \"http://138.197.198.28/logout.cgi\", true);\n";
$html .= "xhttp.send();}\n</script>";

$html .=" </body>\n</html>";
print $html;
