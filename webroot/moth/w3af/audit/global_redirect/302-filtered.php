<?php

if ( strpos($_GET['url'], 'http://') === 0 || strpos($_GET['url'], 'https://') === 0 ){
  echo 'Redirect not allowed';
}else{
  header("Location: " . $_GET['url'] ); /* Redirect browser to "safe" location */
}
?>
