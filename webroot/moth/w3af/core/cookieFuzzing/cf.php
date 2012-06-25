<?php

$value = 'something from somewhere';
setcookie("TestCookie", $value);

echo 'Hola mundo!';
echo $_COOKIE['TestCookie'];

?> 
