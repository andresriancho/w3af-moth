<?php


//$input = $_SERVER['HTTP_RAW_POST_DATA'];
$input = file_get_contents('php://input');
$value = json_decode($input . '<a href="2.php">ole!</a>');
echo $value;

?> 
