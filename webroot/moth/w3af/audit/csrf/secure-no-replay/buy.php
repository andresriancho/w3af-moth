<?php

  session_start();
 
  $token_age = time() - $_SESSION['token_time'];

  if ($_REQUEST['token'] == $_SESSION['token']){
    if ($token_age <= 300){
      /* Less than five minutes has passed. */
      echo 'Thank you for the purchase of ' . intval($_REQUEST['shares']) . " shares.\n";
      $_SESSION['token'] = md5(uniqid(rand(), TRUE));
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