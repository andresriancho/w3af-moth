<?php

header("Location: " . $_GET['url'] ); /* Redirect browser */

/* Make sure that code below does not get executed when we redirect. */
exit;
?>
