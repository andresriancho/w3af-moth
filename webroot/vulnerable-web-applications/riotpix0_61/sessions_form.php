<?php
######################################################
# 
# Form that lets users log in. It checks itself against
# sessions.php. sessions.php must go above the header.php
# include file to prevent header errors.
# This is why sessions_form.php
# and sessions.php are separated files. 
# sessions_form.php ALWAYS gets included BELOW sessions.php
# and below header.php
#
######################################################
	@$forumid = $_REQUEST['forumid'];
	@$page = $_REQUEST['page'];

if(!isset($_SESSION['username'])) {
		// if neither cookie nor a session with a username has been created show login screen
		echo"
		<table width=\"750\" border=\"0\" align=\"center\" cellpadding=\"1\" cellspacing=\"0\">
  			<tr>
    			<td class=\"bodyfont\" align=\"right\" nowrap=\"nowrap\">
					<form method=\"post\" action=\"$_SERVER[PHP_SELF]\"><a href=\"$url_path/register.php\" class=\"bodymain\">REGISTER HERE!</a><br />&nbsp;<b>LOGIN</b> |	Username:&nbsp;<input type=\"text\" name=\"username\" size=\"20\" class=\"border\" />&nbsp;&nbsp;
					Password:&nbsp;<input type=\"password\" name=\"password\" size=\"20\" class=\"border\" />&nbsp;&nbsp;
					<input name=\"cookie\" type=\"checkbox\" value=\"yes\" align=\"middle\" /> Remember Me
					<input type=\"submit\" value=\"Submit\" name=\"submit\" class=\"border\" />
					<input name=\"page\" type=\"hidden\" value=\"$page\" />
					<input name=\"forumid\" type=\"hidden\" value=\"$forumid\" /></form>
					</td>
  			</tr>
		</table>";
	} // end !isset($_SESSION['username']) if statement
	
// if session is set, show logout link
if(isset($_SESSION['username'])){
	$username = $_SESSION['username'];
	echo"<table width=\"750\" border=\"0\" align=\"center\" cellpadding=\"1\" cellspacing=\"0\">
  			<tr>
    			<td class=\"bodyfont\">
					<div align=\"right\" class=\"bodymain\">Hello $username &nbsp;&nbsp;<a href=\"$url_path/logout.php\">Logout</a></div>
				</td>
			</tr>
		</table>";
} // end logout if statement
?>