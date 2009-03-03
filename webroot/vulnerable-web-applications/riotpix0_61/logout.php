<?php
include("conf.php");
// gets cookie if there is one
$login_cookie = @$_COOKIE["logincookie"];

// if cookie is found, reset cookie and destroy session
if(isset($login_cookie)) {
	setcookie ("logincookie", "", time()-60000*24*30); 
	@session_start();
	session_destroy();

include("header.php");
echo "<br /><p align=\"center\" class=\"bodymain\">Successfully Logged Out</p>";
echo "<meta http-equiv=\"Refresh\" content=\"0;url=$url_path\">";
exit();
}

// if no cookie is found, simply destroy session
else { 
	@session_start();
	session_destroy(); 
include("header.php");
echo "<br /><p align=\"center\" class=\"bodymain\">Successfully Logged Out</p>";
echo "<meta http-equiv=\"Refresh\" content=\"0;url=$url_path\">";
}
?>
</body>
</html>