<?php
$string = 'April 15, 2003';
#$pattern = '/(\w+) (\d+), (\d+)/i';
$pattern = $_GET['regex'];
$replacement = '${1}1,$3';
echo preg_replace($pattern, $replacement, $string);
?> 
