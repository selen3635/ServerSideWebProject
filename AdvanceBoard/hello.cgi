#!/usr/bin/perl
use strict;
use warnings;
use CGI qw();
use POSIX qw/strftime/;
print CGI::header();

  my $html = "<!doctype html>\n";
  $html .= "<html>\n<head>\n<title>Hello CGI</title>\n</head>\n";
  my $myRand = rand();
  if($myRand < 0.33)
  {
    $html .= "<body style=\"background-color:blue\">";
  }
  elsif($myRand < 0.66)
  {
    $html .= "<body style=\"background-color:red\">";
  }
  else
  {
    $html .= "<body style=\"background-color:white\">";
  }
  $html .= "\n<h1>Hello World</h1>\n";
  print $html;
  print "<p>";
  print strftime('%Y-%m-%d %H:%M:%S', localtime);
  print "<br><br><br>\n";
  foreach my $key (sort keys(%ENV))
  {
    print "$key = $ENV{$key}<br>\n";
  }
  print "</p>";
  print "</body></html>";  
 
