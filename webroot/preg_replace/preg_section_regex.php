<?php
$string = 'This is a simple text where I can search something and the result if bolded.';
$pattern = '/(' . $_GET['search'] . ')/i';
$replacement = '<b>$1</b>';
echo preg_replace($pattern, $replacement, $string);
?> 
