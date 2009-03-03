<?php
    require("conf.php");
	require("sessions.php");
	include("header.php");
	require("sessions_form.php");
	include ("connect.php");
$username = strtolower($username);

if ($username == "$admin_name") {

		$message = mysql_real_escape_string($_REQUEST['message']);
		$subject = mysql_real_escape_string($_REQUEST['subject']);
		$belongstoid = @$_REQUEST['belongstoid'];
		$ident = (int) $_REQUEST['ident'];
		$check = @$_REQUEST['check'];
		$yes = @$_REQUEST['yes'];
		
		if(!empty($yes)){
			mysql_query("DELETE FROM forum WHERE forumid = '$ident'");
			mysql_query("DELETE FROM forum WHERE belongstoid = '$ident'");
			
			// updates the number of replies of the message
			if($belongstoid != 0){
				$update_replies = "UPDATE forum SET replys = replys-1 WHERE forumid = '$belongstoid'";
				mysql_query($update_replies) or die("<h1>Update replies screwed up</h1><hr> ".mysql_error());
			}
			echo"<meta http-equiv=\"refresh\" content=\"0; url=$url_path\">";
			exit();
		}
		
		else {
		$message = ereg_replace( "<3", "&lt;3", $message );
		$message = strip_tags($message, '<a><b><i><u><blockquote>');
		$subject = strip_tags($subject);
		
		if (!empty($check)) {
			$message = "$message <br /><br /><i>edited by $username on $submitdate</i>"; 
		}
		//strip slashes. edit in conf.php
		if($slashes == true){
			$message=stripcslashes($message);
			$subject=stripcslashes($subject);
		}
		$editposts = "UPDATE forum SET message = '$message', subject = '$subject' WHERE forumid = '$ident'";
		mysql_query($editposts) or die("<h1>Edit function screwed up</h1><hr> ".mysql_error());
		echo"<meta http-equiv=\"refresh\" content=\"0; url=$url_path\">";
		}
}

	?>