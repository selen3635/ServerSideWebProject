#!/user/bin/env nodejs
var http = require('http');
var querystring = require('querystring');
http.createServer(function (req, res)
{
  res.writeHead(200, {'Conten-type': 'text/plain'});
  var time = new Date();
  var html = "<!doctype html>\n";
  html += "<html>\n<head>\n<title>Hello Node</title>\n</head>\n";
  var rand = Math.random();
  if(rand<0.33)
  {
    html += "<body style=\"background-color:blue\">";
  }
  else if(rand<0.66)
  {
    html += "<body style=\"background-color:red\">";
  }
  else
  {
    html += "<body style=\"background-color:white\">";
  }
  html += "\n<h1>Hello World</h1>\n";
  html += "<h2>"+time.toLocaleTimeString()+"</h2>";
  html += "<br>";
  for(var envibl in process.env){
    html += "<p><b>" + envibl + "</b>"+"  " +
    process.env[envibl]+ "<p><br>";
  }
  html += "\n</body>\n</html>" ;
  res.write(html);
  res.end();
}).listen(1337);

console.log('Server running at http://138.197.198.28:1337/');


  
