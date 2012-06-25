<?

mail( $_POST['mail'], 'Welcome to my site', 'Welcome ' . $_POST['firstname'] );

// I don't want to depend on exim for doing my tests, so I'll do the delivery myself.
/*   
// set some variables
$host = "192.168.2.111";
$port = 25;

echo 'Connecting...';
$socket = socket_create(AF_INET, SOCK_STREAM, 0) or die("Could not create socket\n");
$result = socket_connect($socket, $host, $port);
if ($result === false) {
    echo "socket_connect() failed.\nReason: ($result) " . socket_strerror(socket_last_error($socket)) . "\n";
} else {
    echo "OK.<br/>";
}

echo 'Sending email<br/>';

$mail = <<<THEEMAIL
a
b
c
THEEMAIL;

socket_write($socket, $mail, strlen($mail));

echo "Closing socket...";
socket_close($socket);
echo "OK.<br/>"
*/

echo 'Thanks for leaving your mail.';

?>