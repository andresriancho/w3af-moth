<?
/*
Test script sending different "Access-Control-Allow-Origin" response 
header (based on "Origin" request header) value with HTTP 403 response code.
*/
header("HTTP/1.1 403 Forbidden");
$headers = apache_request_headers();
foreach($headers as $header => $value){
	if($header == 'Origin'){
		header("Access-Control-Allow-Origin: " . $value);
	}
}
?>
