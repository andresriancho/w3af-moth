<?php

  /* In this case the index.php generates a token but buy.php doesn't verify it*/
  echo 'Thank you for the purchase of ' . intval($_REQUEST['shares']) . " shares.\n";

?>