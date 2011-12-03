<?php

include_once 'config.php';
check_auth();
$section = empty($_GET['section']) ? 'profile' : $_GET['section'];
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Home page</title>
  </head>
  <body>
    <div><a href="auth.php?logout=1">Logout</a></div>
    <h1>Home page</h1>
    <p>Hello, <b><?php echo html($_SESSION['user']['username']) ?></b>! <a href="?section=news">News?</a></p> 
    <p>Current section is <?php echo $section ?></p>
  </body>
</html>
