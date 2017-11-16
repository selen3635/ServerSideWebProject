#!/usr/bin/perl
use strict;
use warnings;
use CGI qw();
print CGI::header();

my $c = CGI->new;

my $html = "<!DOCTYPE html>\n<html>\n<head>\n<title>CGI version</title>\n";
 $html .= "</head>\n<body style=\"background-color:" . $c->param('color');
 $html .= "\">";
 $html .= "<p>Hello: " . $c->param('FirstName') . " " . $c->param('LastName');
 $html .= " from a Web app written in CGI on data time</P>\n</body>\n</html>";
 
print $html;
