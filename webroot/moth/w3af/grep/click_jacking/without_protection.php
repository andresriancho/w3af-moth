<?php
session_start();

if (!empty($_POST['foo'])) {
    echo '<pre>'; 
    var_dump($_POST['foo']);
    echo '</pre>';
}
?>
<h1>Clickjacking test page without protection</h1>
<form method="POST">
    <input type="text" name="foo" value="bar">
    <input type="submit">
</form>
