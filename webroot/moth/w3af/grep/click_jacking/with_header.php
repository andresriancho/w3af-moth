<?php
header('X-Frame-Options: DENY');
session_start();
?>
<h1>Clickjacking test page with X-Frame-Options protection</h1>
<form method="POST">
    <input type="text" name="foo" value="bar">
    <input type="submit">
</form>
