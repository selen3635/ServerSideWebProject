#!/usr/bin/nodejs
var express = require('express');
var app = express();
var bodyparser = require('body-parser');
var fs = require('fs');
app.use(bodyparser.urlencoded({extended:true}));

app.get('/action', function(req, res)
{
  var html ="<!DOCTYPE html>\n<html>\n<head>\n<title>Nodejs Version</title>";
  html += "\n<head>\n";
  html += "<body style=\"background-color:" +req.query["color"] +"\">"
  html += "<p>Hello: " + req.query['FirstName'] +  " " + 
    req.query['LastName'] + 
   " from a Web app written in Nodejs on data time</p></body>\n</html>";
  res.send(html);

});

app.post('/action', function(req, res)
{
  var html ="<!DOCTYPE html>\n<head>\n<title>ECHO</title>\n"+
            "</head>\n";
  html += "<body style=\"background-color:" +req.body.color +"\">"
  html += "<p>Hello: " + req.body.FirstName +  " " + 
    req.body.LastName + 
   " from a Web app written in Nodejs on data time</p></body>\n</html>";
  res.send(html);
});

app.listen(1337, function()
{
  console.log('server is running at 1337/action');
});
