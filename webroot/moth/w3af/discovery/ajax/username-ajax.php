<?php
// Include the Sajax library
include "Sajax2.php";

// Open conection to the database
mysql_connect('localhost', 'username', 'password');
mysql_select_db('database');

/*
CREATE TABLE `users` (
`user_id` INT( 9 ) NOT NULL AUTO_INCREMENT ,
`username` VARCHAR( 50 ) NOT NULL ,
`password` VARCHAR( 32 ) NOT NULL ,
PRIMARY KEY ( `user_id` ) ,
UNIQUE (`username`)
);

INSERT INTO `users` ( `username` , `password` ) VALUES ('username', 'password');
INSERT INTO `users` ( `username` , `password` ) VALUES ('tom', 'password');
INSERT INTO `users` ( `username` , `password` ) VALUES ('bill', 'password');
INSERT INTO `users` ( `username` , `password` ) VALUES ('bob', 'password');
*/

// Function to check if a username exists inside the database
function check_user_exist($username) {
	$username = mysql_escape_string($username);
	// Make a list of words to postfix on username for suggest
	$suggest = array('007', '1', 'theman', 'rocks');
	//$suggest = array();
	$sql = "SELECT `username` FROM `users` WHERE `username` = '$username'";
	$result = mysql_query($sql);
	if(mysql_num_rows($result) > 0) {
		// Username not available
		$avail[0] = 'no';
		$i = 2;
		// Loop through suggested ones checking them
		foreach($suggest AS $postfix) {
			$sql = "SELECT `username` FROM `users` WHERE `username` = '".$username.$postfix."'";
			$result = mysql_query($sql);
			if(mysql_num_rows($result) < 1) {
				$avail[$i] = $username.$postfix;
				$i ++;
			}
		}
		$avail[1] = $i - 1;
		return $avail;
	}
	// Username is available
	return array('yes');
}

sajax_init(); // Intialize Sajax
//$sajax_debug_mode = 1; //Uncomment to put Sajax in debug mode
sajax_export("check_user_exist"); // Register the function
sajax_handle_client_request(); // Serve client instances
?>

<html>
<head>
	<title>Gmail Style Check Username AJAX</title>
	<script type="text/javascript">
	<?php
	sajax_show_javascript();
	?>
	function check_handle(result) {
		if(result[0] == 'yes') {
			document.getElementById('not_available').style.display = 'none';
			document.getElementById('available').style.display = 'block';
		}
		else {
			document.getElementById('available').style.display = 'none';
			document.getElementById('not_available').style.display = 'block';
			var str = 'Sorry that username is not available try these <br />';
			for(i = 1; i < result[1]; i++) {
				str += "<input type=\"radio\" name=\"try\" onclick=\"switch_username('"+result[i+1]+"')\"/>" + result[i+1] + "<br />";
			}
			document.getElementById('not_available').innerHTML = str;
		}
	}

	function check_user_exist() {
		var username = document.getElementById('username').value;
		x_check_user_exist(username, check_handle);
	}

	function switch_username(username) {
		document.getElementById('username').value = username;
	}
	</script>

	<style type="text/css">
        @import url( test.css );
	#available {
		display: none;
		color: green;
	}
	#not_available {
		display: none;
		color: red;
	}
	</style>
</head>
<body>
	<h2>AJAX Check Username</h2>
	<p>The following does a gmail style check on the username supplied to see if it is a unqiue username, using the AJAX method.
	<br />If not, it makes some suggestions to ones which are available. It uses a development version of Sajax.
	<br /><a href="username-ajax.phps">View Source</a> (<a href="Sajax2.phps">Sajax2.php</a>) | <a href="">Comments</a></p> 
	<h2>Example</h2>
	Some examples of taken usernames are: <strong>tom</strong> , <strong>bill</strong>, <strong>bob</strong>, <strong>username</strong><br />
	<input type="text" name="username" id="username" size="20" value="tom">
	<input type="button" name="check" value="Check Username"
		onclick="check_user_exist(); return false;">

	<div id="available">
		Username is available!
	</div>

	<div id="not_available">
		Sorry that username is not available.
	</div>


</body>
</html>
