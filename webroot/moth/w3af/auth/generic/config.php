<?php

$users = array(
     array('username' => 'admin', 'password' => 'admin'),
);

function redirect($loc) {
    header('Location: http://'.$_SERVER['SERVER_NAME'].'/w3af/auth/generic/'.$loc);
    exit();
}

function check_auth($redirect=True) {
    if (!empty($_SESSION) && $_SESSION['auth']) {
        return true;
    } else {
        if ($redirect)
            redirect('auth.php');
        else
            return false;
    }
}

function html($str) {
    return htmlspecialchars($str);
}

session_start();
?>
