<?php

$chunks = explode('&', $_SERVER['QUERY_STRING']);

$i = 0;
foreach ($chunks as $chunk) {
    $param = explode('=', $chunk);

    if (count($param) > 1) {
        if ( $i>0 ){
            echo($param[0].':'.urldecode($param[1]));
        }else{
            echo($param[0].':'.$param[1]);
        }
    }
    $i++;
}

?>
