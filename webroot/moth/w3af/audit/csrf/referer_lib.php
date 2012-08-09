<?

function referer_check() {
    if (strpos($_SERVER['HTTP_REFERER'], 'http://'.$_SERVER['SERVER_NAME']) === 0) {
        return true;
    } else {
        return false;
    }
}
?>