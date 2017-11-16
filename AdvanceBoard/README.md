# team31-homework1
Member: 
Xiaolong Zhou, xiz266@ucsd.edu
Chenlin Ye, c7ye@ucsd.edu

server ip: 138.197.198.28

Comparison of three languges:
1.
In term of speed, take hello world as example. The php takes about 35ms to
load, the nodejs one takes about 80ms, and the cgi one takes 90ms on 
average. So php have the best performance on this page. We guess it's 
because we are not importing any libraries in hello.php while we 
do some import in hello.js and hello.cgi.

2.
In terms of writability and readability, php is easy to write and 
understand. For example, when doing sessions, we just need to add 
session_start() at the beginning of each file. But for nodejs, we need to
set cookie parameters by ourselves. And we need to print headers in CGI by
ourselves. So php is more convenient while node and cgi are more 
writable when doing sessions. However, it's really easy to handle 
different requests with nodejs. We don't need a separate file for each
different request--instead we can handle all requests in one file. 

How to run:
look at our homepage at 138.197.198.28. press the link 'homework2' 
on the top and there are links to all pages.
