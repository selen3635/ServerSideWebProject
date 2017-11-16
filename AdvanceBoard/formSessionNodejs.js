#!/usr/bin/nodejs
var session = require('express-session');
var bodyparser = require('body-parser');
var express = require('express');
var app = express();
var fs = require('fs');
app.use(bodyparser.urlencoded({extended:true}));
app.use(session(
  {
    secret: 'xiaolong zhou',
    name: 'maoxian',
    resave: 'true',
    saveUninitialized: 'true'
  }));
app.get('/logout.js', function(req,res)
{
  req.session.destroy();
});
app.get('/formSession2Nodejs', function(req,res)
{
  var html ="<!DOCTYPE html>\n<html>\n<head>\n<title>Nodejs Version</title>";
  html += "\n<head>\n";
  html += "<body>"
  if(req.session.FirstName == undefined || 
    req.session.LastName == undefined)
  {
    html+='<p>Howdy stranger...tell me your name on page1!</p>';
  }
  else
  {
    html += "<p>Hi: " + req.session.FirstName +  " " + 
     req.session.LastName + 
    " nice to meet you. </p>";
  }
  html += "<button type=\"button\" onclick=\"clearSession()\">Clear Session";
  html += "</button>\n<script>function clearSession(){\n";
  html += "var xhttp = new XMLHttpRequest()\;\n";
  html += "xhttp.open(\"GET\", \"logout.js\", true)\;\n";
  html += "xhttp.send()\;\n}\n</script>\n</body>\n</html>"; 
  res.send(html);
});
app.get('/', function(req, res)
{
  var file = fs.readFileSync('./formSession.html', 'utf8');
  res.send(file);
});
app.post('/action', function(req, res)
{
  req.session.FirstName = req.body.FirstName;
  req.session.LastName = req.body.LastName;
  res.send();
});
app.listen(1337, function()
{
  console.log("Server is running at 1337");
});


