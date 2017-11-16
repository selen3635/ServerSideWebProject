Summary for gzip::
After a while searching, we found that "Content_Encoding: gzip" is inside
http headers. Then, we use third party of website to test whether our 
 website is compressed. It says yes. The origional web size is 1529 byte 
while the compressed one is 479 byte with a compression rate of 68.7. So we
know that the gzip compression is by default on by the apache server.
