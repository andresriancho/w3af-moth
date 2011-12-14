<?php

$users = array(
     array('username' => 'admin', 'password' => 'admin'),
);


function redirect($loc) {
    header('Location: http://'.$_SERVER['SERVER_NAME'].$loc);
    exit();
}

function check_auth($redirect=True) {
    if (!empty($_SESSION) && $_SESSION['auth']) {
        return true;
    } else {
        if ($redirect)
            redirect('/auth.php');
        else
            return false;
    }
}

function html($str) {
    return htmlspecialchars($str);
}

function print_news($id) {
    $dbh = new PDO("sqlite:news.db");
    $sql = 'SELECT * FROM news WHERE id = '.$id;
    foreach ($dbh->query($sql) as $row) {
        echo '<h2>'.$row['title'] . "</h1>\n";
        echo '<p>'.$row['article']."</p>\n";
    }
}
//session_start();
?>
