#!/usr/bin/perl
use CGI::Session;
$session = CGI::Session->new();
print CGI::header();

$session->delete(); 
