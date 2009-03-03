<?php
// connect to database
mysql_connect($host,$user,$pass);
mysql_select_db($db);

// gets cookie if there is one
@$login_cookie = $_COOKIE['logincookie'];

// if submit button is pushed get username and password 
// and gets variable for cookie if "Remember Me" was checked
if(@$_POST['submit']){
	$username = $_POST['username'];
	// due to current security concerns, we force the username to lowercase.
	$username = strtolower($username);
	$username = trim($username);
	$password = md5($_POST['password']);
	@$cookie = $_POST['cookie'];
}

if(!isset($login_cookie)) { 
	// if username IS set
	if(isset($username)){

		$sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
		$result = @mysql_query($sql) or die("No username found or password does not match");
			// if username is submitted but not found, unset session variables
			if(mysql_num_rows($result) == "0") {

				unset($_SESSION['username']);
				unset($username);

				unset($_SESSION['password']);
				unset($password);

				echo "<br /><p align=\"center\" style=\"font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold;\">Wrong username and/or password, try again</p>
					<p align=\"center\" style=\"font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold;\">If you recently changed your password 
					<a href=\"$url_path/logout.php\">click here</a> and try again</p>";
				exit;

			} //end mysql_num_rows($result) if statement
			
			// if username was submitted and WAS found register session variables
			elseif(mysql_num_rows($result) > "0") {
				
				// if "remember me" was checked, cookie is set
         		if($cookie == "yes") {
            		setcookie("logincookie", "$username:$password", time()+3600*24*30);
        		} //end if statement to set cookie

				// If found in database, log user in
				$_SESSION['username'] = $username;
				$_SESSION['password'] = $password;

    		} //end elseif statement
	} // end isset($username) if statement
} // end if statement for login_cookie not being set

// elseif login cookie is set
elseif(isset($login_cookie)) {

		$data = explode(":", $login_cookie);
		$username = $data[0];
		$password = $data[1];
		$sql2 = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
		$result2 = @mysql_query($sql2) or die("No.");
 	
		// if a user is not found with coookies unset Session variables
		if(mysql_num_rows($result2) == "0") {
			unset($_SESSION['username']);
			unset($username);

			unset($_SESSION['password']);
			unset($password);
	
			include("header.php");

			exit ("<p class=\"bodymain\" align=\"center\">Please <a href=\"$url_path/logout.php\">logout</a>.
			<br />You will then be asked to sign back in
			<br /><br />IF LOGGING OUT DOES NOT WORK: 
			<br>Close your browser and try to log back in</p>");
		} // end if statement if 
	
		// elseif user IS found, set Session variables
		elseif(mysql_num_rows($result2) > "0") {
			$_SESSION['username'] = $username;
			$_SESSION['password'] = $password;
		}
	} // end cookie login elseif statement
?>