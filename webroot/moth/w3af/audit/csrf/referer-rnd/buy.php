<?
include('../rnd_lib.php');
echo 'Random string to make things harder: ' . rand_string(10);
echo '<br>';
?>
<?php
include('../referer_lib.php');

if (referer_check() ){
    echo 'Thank you for the purchase of ' . intval($_REQUEST['shares']) . " shares.\n";
}else{
    echo 'Protected against basic CSRF attacks.';
}
?>