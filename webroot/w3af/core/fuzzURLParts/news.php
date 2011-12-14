<?php

include_once 'config.php';
$id = empty($_GET['id']) ? 1 : $_GET['id'];

//var_dump($_SERVER['QUERY_STRING']);
?>

<!DOCTYPE html>
<html>
  <head>
  <title>News</title>
  </head>
  <body>
    <h1>News for <?php echo $id ?></h1>
    <p>
    <?php print_news($id) ?>
    </p>
  </body>
</html>
