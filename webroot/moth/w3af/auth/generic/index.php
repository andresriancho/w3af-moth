<?php

include_once 'config.php';

if (check_auth(false)) {
    redirect('home.php');
}

?>
<!DOCTYPE html>
<html>
  <head>
    <title>Target</title>
  </head>
  <body>
    <h1>Target</h1>
    <p>Hello, guest! You need to <a href="auth.php">login</a></p> 
  </body>
</html>
