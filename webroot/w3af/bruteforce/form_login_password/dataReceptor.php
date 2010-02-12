<?

if ( strcmp( $_COOKIE["magicValue"] , '0000-1111-2222-3333-4444') == 0 ){
  echo '<a href="onlyUsers.php">onlyUsers.php</a>';
}
  

if ( strcmp($_POST['pass'],"") == 0 ){
        echo "Please fill the empty password field <br>";
        die();
}   
                                    

if ( strcmp($_POST['pass'],"1234") == 0 ){ 
	setcookie("magicValue", "0000-1111-2222-3333-4444", time()+3600);
	setcookie("magicValue2", "0000-1111-2222-3333-4444", time()+3600);
	
	echo "Login OK! Congrats! Now you can access the users section <a href='onlyUsers.php'>onlyUsers.php</a><br>";
	die();

}
else
{
	echo "Bad login, stop bruteforcing me!";
	echo "Bad password!";

}

?>
<br/>
<i>
more text
</i>

</html>
