<?php
$value = 'something from somewhere';
setcookie("TestCookie", $value, time()+3600, "/~rasmus/", ".example.com", 1);

echo 'Hola mundo!';
echo $_COOKIE['TestCookie'];

?> 
