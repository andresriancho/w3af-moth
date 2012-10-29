<?
/*
Test script sending different "Access-Control-Allow-Origin" response 
header (based on "Origin" request header) value with HTTP 200 response code.
*/
$msg = "Origin header not specified";
$headers = apache_request_headers();
foreach($headers as $header => $value){
	if($header == 'Origin'){
		header("Access-Control-Allow-Origin: " . $value);
		$msg = "HTTP response header <b>Access-Control-Allow-Origin</b> set to " . $value;
	}
}
?>
<html>
	<body>
		HTTP Response code 200 returned.<br>
		<? echo($msg); ?> 
	</body>
</html>
