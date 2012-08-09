<?
include('../rnd_lib.php');
echo 'Random string to make things harder: ' . rand_string(10);
echo '<br>';
?>
<?php

  session_start();
 
  $token_age = time() - $_SESSION['token_time'];

  if ($_POST['token'] == $_SESSION['token']){
    if ($token_age <= 300){
      /* Less than five minutes has passed. */
      echo 'Thank you for the purchase of ' . intval($_REQUEST['shares']) . " shares.\n";
    }
    else
    {
      echo 'Token timeout';
    }
  }
  else
  {
    echo 'Invalid token';
  }
?>
