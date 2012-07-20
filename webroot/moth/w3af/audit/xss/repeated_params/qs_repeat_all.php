<?php

$chunks = explode('&', $_SERVER['QUERY_STRING']);

foreach ($chunks as $chunk) {
    $param = explode('=', $chunk);
    echo($param[0].':'.urldecode($param[1]));
}

?>
