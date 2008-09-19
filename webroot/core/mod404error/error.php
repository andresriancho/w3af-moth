<?php
header("HTTP/1.0 200 OK");
?>

<html>
<?

  if ( substr_count(getenv("REQUEST_URI"), '.php') > 0 )
  {
    echo 'foo! modified error response only shown if you wanted to visit a php page';
  }
  else
  {
    echo 'this is something completely different';
  }
?>
</html>