<?

$user = $_REQUEST['user'];
$pwd = $_REQUEST['pass'];

if ($user){

    if (strcmp($pwd, "") == 0){
        echo "fill the blanks <br>";
    }

    else if (strcmp($user, "admin") == 0 && strcmp($pwd, "1234") == 0){ 
        setcookie("magicValue", "0000-1111-2222-3333-4444", time()+3600);
        setcookie("magicValue2", "0000-1111-2222-3333-4444", time()+3600);
        
        echo "Login OK! <br>";
        echo $user;
	echo "<table>
		<tr>
			<th>
			Welcome to our admin panel. Next you may see our menu option where you'll be able to manage the whole website. Isn't it cool???
			</th>
		</tr>
		<tr>
			<td>
			<div>OPTION-1|OPTION-2|OPTION-3|OPTION-4|OPTION-5|OPTION-6|OPTION-7</div>
			</td>
		</tr>
	      </table>";

    }
    else{
        echo "Bad login, stop bruteforcing me!<br>";
        echo "Bad u/p combination for user: " .  $user;
    }
}

echo "<br><br>";
if ( isset( $_COOKIE["magicValue"] ) ){
    if ( strcmp( $_COOKIE["magicValue"] , '0000-1111-2222-3333-4444') == 0 ){
        echo '<a href="only-users.php">only-users.php</a>';
    }
}

echo "<br>";

?>
<br/>
<i>
more text
</i>

</html>
