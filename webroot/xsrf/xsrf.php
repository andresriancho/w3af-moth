<?php
$value = 'something from somewhere';

setcookie("TestCookie", $value, time()+60*60*24*30, "/~rasmus/", ".example.com", 1);
?> 
