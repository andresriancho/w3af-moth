<?php
	require("conf.php");
	require("sessions.php");
	include("header.php");
	require("sessions_form.php");
	include("functions.php");
?>
<script language="javascript" type="text/javascript">
<!--
function SubmitOnce(theform) {
	// if IE 4+ or NS 6+
	if (document.all || document.getElementById) {
		// hunt down "submit" and "reset"
		for (i=0;i<theform.length;i++) {
			var tempobj=theform.elements[i];
			if(tempobj.type.toLowerCase()=="submit"||tempobj.type.toLowerCase()=="reset") {
				//disable it
				tempobj.disabled=true;
			}
		}
	}
}
//-->
</script>
<?php

// checks to see if form was submitted
if(@$_POST['post']) {
	$message = mysql_real_escape_string($_POST['message']);
	$subject = mysql_real_escape_string($_REQUEST['subject']);
	$reply =  (int) @$_REQUEST['reply'];
	$preview = @$_POST['preview'];
	

	if (!empty($preview)) {
		include("preview.php");
		exit();
	}
	
	// remove white space from front and back of subject and message
	// just in case any user wants to put a bunch of blank space at the end or beginning of a message
	$subject = trim($subject);
	$message = trim($message);
	
	if(empty($username))
		$err[] = "<h2>You are not logged in!</h2>";
	
	if(empty($subject))
		$err[] = "<h3>You've forgotten your subject!</h3>";

	if(empty($message))
		$err[] = "<h3>You've forgotten your message!</h3>";
	
	// checks to see if bad words (defined in conf.php) are present
	// this filter is not all inclusive and a better version is being worked on
	for($i=0;$i<sizeof($bad_words);$i++) {
		if(ereg($bad_words[$i], strtolower($subject)) || ereg($bad_words[$i], strtolower($message)))
			$err[] = "<h4>We like to keep our forum decent. Please don't be too vulgar!</h4>";
	}
	
// if bad words are found 
if(@sizeof($err) > 0) {
		?>

<table width="750" border=0 cellspacing=0 cellpadding=0 align="center">
	<tr>
		<td>
			<table width="100%" border=0 align="center" cellpadding=3 cellspacing=1>
				<tr>
					<td valign="top" align="left" class="messages">

					<form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
						<input type="hidden" name="name" value="<?php echo $username?>" />
						<input type="hidden" name="subject" value="<?php echo stripcslashes(htmlspecialchars($subject))?>" />
						<input type="hidden" name="message" value="<?php echo stripcslashes(htmlspecialchars($message))?>" />
						<input type="hidden" name="reply" value="<?php $reply;?>" />
							<br />
							<span class="bodymain"><i>Please fix the following issues before re-posting:</i></span>
							<br />
							<?php
							for($i=0;$i<=sizeof($err);$i++)
								echo "\n\t<font class=\"bodyfont\">".$err[$i]."</font><br />";
							?>
						 <input type="submit" class="textareagr" value="Back" />
					</form>
   					</td>
  				</tr>
			</table>
		</td>	
	</tr>
</table>
</body>
</html>

<?php
}  

// else-no-bad-words are found	
else {
	// gets ip from user using gethostname() from functions.php
	$hostaddress = gethostname();
	
	
	// connect to mysql database.
	$con = mysql_connect($host,$user,$pass);
	mysql_select_db($db, $con);

	// $time2 is what is used to list the messages in order from the database
	$time2 = date("YmdHis"); 
	
	// convert a few special characters to their &... equivalent
	$message = ereg_replace( "<3", "&lt;3", $message );
	$message = strip_tags($message, '<a><b><i><u><blockquote>');
		
	$sql2 = "SELECT sorter, replys FROM forum WHERE forumid='$reply' AND belongstoid=0";
	$res2 = mysql_query($sql2);
	$row = mysql_fetch_array($res2);
	$ifexist = $row["sorter"];
	$replys = $row["replys"];
	
	$numberofpages = (($replys / 20) - 1);
	$n = ceil($numberofpages);
	if ($n == -1){
		$n=0;
	}
	else{
		$n = abs($n);
	}
	$none = "-- -- ----";

	if(($reply <> 0) && !$ifexist) {
		exit("<br />
		<center><span class=\"bodymain\"><b>Sorry, you can't do that. Redirecting...</b></span></center>
		<meta http-equiv=\"refresh\" content=\"1; url=$url_path/\">");
	}
	//strip slashes. Edit in conf.php
	if($slashes == true){
			$message=stripcslashes($message);
			$subject=stripcslashes($subject);
	}
	$sql = "INSERT INTO forum (forumid, subject, name, message, sorter, submitdate, belongstoid, host, time, lastreply, lastposter) VALUES ('', '$subject', '$username', '$message', '".time()."', '$submitdate', '$reply', '$hostaddress', '$time2', '$none', 'n-a')";
	mysql_query($sql) or die("<h1>Something went wrong</h1><hr>".mysql_error());

	$updateposts = "UPDATE users SET posts = posts+1 WHERE updateu = '$username'";
	mysql_query($updateposts) or die("<h1>Post addition screwed up</h1><hr>".mysql_error());
		
	if($reply <> 0) {
		$sql = "UPDATE forum SET time='$time2', replys = replys+1, lastreply = '$submitdate', lastposter = '$username' WHERE forumid = '$reply'";
			mysql_query($sql) or die("<h1>Something went wrong</h1><hr>".mysql_error());
		}

		if($reply == 0)
			echo "<meta http-equiv=\"refresh\" content=\"0; url=$url_path/index.php\">";
			
		else
			echo "<meta http-equiv=\"refresh\" content=\"0; url=$url_path/read.php?forumid=$reply&page=$n#bottom\">";
			
	}
} 
// If form has not been submitted display the following
else {
	$reply = @$_GET['reply'];
	if(!isset($reply))
		$reply = 0;
	
	$message = mysql_real_escape_string(@$_POST['message']);
	$subject = mysql_real_escape_string(@$_REQUEST['subject']);
	//strip slashes. Edit in conf.php
	if($slashes == true){
		$message=stripcslashes($message);
		$subject=stripcslashes($subject);
	}
	?>
<table width="750" border="0" cellspacing="1" cellpadding="3" align="center">
	<tr>
    	<td class="border"><span class="bodymain">LEAVE MESSAGE:</span></td>
  	</tr>
  	<tr>
   		<td valign="top" align="left" class="messages">
<form name="postform" onsubmit="SubmitOnce(this);" method="post" action="<?php echo $_SERVER['PHP_SELF']?>"><br />
    <span class="bodymain">Subject:</span><br />
    <input type="text"  size="55" name="subject" value="<?php echo htmlspecialchars(stripcslashes($subject))?>" maxlength="100" class="border" /><br />
    <span class="bodymain">Message:</span><br />
    <textarea name="message" rows="14" cols="60" class="border"><?php echo stripcslashes($message)?></textarea><br />
    <input type="hidden" name="reply" value="<?php echo $reply?>" />
	<input type="hidden" name="name" value="<?php echo $username?>" />
    <input type="hidden" name="post" value="true" />
	<input type="submit" value="Submit" class="border" />
    <input type="checkbox" name="preview"  value="preview" class="border" /><span class="bodyfont">Preview</span>
</form>
<?php
}
?>
   		</td>
  	</tr>
</table>

</body>
</html>