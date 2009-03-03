<?php

// file check to see if upload is actually image
function filecheck($filename){
  	$ext = strrpos($filename,'.');
	$ext = substr($filename, $ext);
	$FileType = array (".jpg", ".jpeg", ".bmp", ".gif", ".png", ".JPG", ".JPEG", ".BMP", ".GIF", ".PNG");
	if (in_array ($ext, $FileType) )
    	return TRUE;
   		
	else
    	 return FALSE;
}

// auto-convert website that starts with http... to a link
function UBB($htmlconvert){
	$htmlconvert = preg_replace( "/(?<!<a href=\")((http|ftp)+(s)?:\/\/[^<>\s]+)/i", "<a href=\"\\0\">\\0</a>", $htmlconvert );
	return $htmlconvert;
}

//get the IP address of the user
function gethostname() {
	$hostaddress = getenv('REMOTE_ADDR');
	if (!$hostaddress) { $hostaddress = getenv('REMOTE_HOST'); }
	$hostaddress = @GetHostByAddr($hostaddress);
	return $hostaddress;
}

?>