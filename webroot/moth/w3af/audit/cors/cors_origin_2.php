<?
/*
Test script sending always the same "Access-Control-Allow-Origin" response 
header value with HTTP 403 response code.
*/
header("HTTP/1.1 403 Forbidden");
header("Access-Control-Allow-Origin: http://www.google.lu");
?>
