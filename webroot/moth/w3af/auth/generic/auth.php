<?php
include_once 'config.php';

$msg = '';

// logout
if (!empty($_GET) && !empty($_GET['logout'])) {
    $_SESSION['auth'] = false;
    $_SESSION['user'] = array();
}
// login
if (!empty($_POST) && !empty($_POST['username'])) {
    foreach ($users as $user => $info) {
        if ($info['username']  == $_POST['username'] 
            && $info['password'] == $_POST['password']) {
                $_SESSION['auth'] = true;
                $_SESSION['user'] = $info; 
                redirect('home.php');
        }
    }
    $msg = 'Auth errror';
} elseif (check_auth(false)) {
    redirect('home.php');
}

?>
<!DOCTYPE html>
<html>
  <head>
    <title>Auth page</title>
  </head>
  <body>
    <h1>Auth page</h1>
    <b><?php echo $msg ?></b>
    <form action="auth.php" method="post">
    <table>
        <tr>
            <td>Username</td>
            <td><input type="text" name="username"></td>
        </tr>
        <tr>
            <td>Password</td>
            <td><input type="password" name="password"></td>
        </tr>
        <tr>
            <td collspan="2"><input type="submit"></td>
        </tr>
    </table>
    </form>
  </body>
</html>
