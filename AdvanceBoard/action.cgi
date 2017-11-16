#!/usr/bin/perl
use CGI::Session;
use CGI qw();
$session = CGI::Session->new();
print $session->header();
my $c = CGI->new;
my $FirstName = $c->param("FirstName");
my $LastName = $c->param("LastName");
$session->param('FirstName', $FirstName);
$session->param('LastName', $LastName);
