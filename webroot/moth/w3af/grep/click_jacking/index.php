<?php 
header('X-Frame-Options: DENY');
session_start();
?>
<h1>Clickjacking test page</h1>
<ul>
    <li><a href="without_protection.php">Page without any protection</a></li>
    <li><a href="with_header.php">X-Frame-Options protection</a></li>
</ul>
