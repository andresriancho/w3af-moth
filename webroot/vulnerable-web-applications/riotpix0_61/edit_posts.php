<?php
    require("conf.php");
	require("sessions.php");
	include("header.php");
	require("sessions_form.php");
	include ("connect.php");
$username = strtolower($username);

if ($username == "$admin_name") {
?>
<html>

<head>
<title>Forum</title>
<script language="JavaScript">
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
</head>

<body>
<?php 

	$ident = $_GET['ident'];
	$delete = @$_GET['delete'];	
	$sql2 = "SELECT subject, message, belongstoid, replys FROM forum WHERE forumid='$ident'";
	$res2 = mysql_query($sql2);
	$row = mysql_fetch_array($res2);
	$message = $row["message"];
	$subject = $row["subject"];
	$subject = htmlspecialchars($subject);
	$belongstoid = $row["belongstoid"];

if (!empty($delete)){
	echo"</table>
	<table width=\"750\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
	<tr><td class=\"bodymain\">
	<p>&nbsp;</p>
	Are you sure you want to delete? This cannot be undone
	<p>&nbsp;</p>
	<form name=\"postform\" method=\"POST\" action=\"edit_posts_script.php\">
	<input type=\"hidden\" name=\"ident\" value=\"$ident\">
	<input type=\"hidden\" name=\"belongstoid\" value=\"$belongstoid\">
	<input name=\"yes\" type=\"submit\" value=\"yes\" class=\"border\" />
	</form>
	</td></tr>
	</table>";
	exit();
}

else{

echo"
</table>
<table width=\"750\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
<tr><td>
<table width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"3\">
  <tr>
    <td class=\"border\"><span class=\"bodymain\">The message:</span></td>
  </tr>
  <tr>
   <td valign=\"top\" align=\"left\" class=\"messages\">
     <form name=\"postform\" method=\POST\" action=\"edit_posts_script.php\">
        <span class=\"bodymain\">Subject:</span><br>
       <input type=\"text\" name=\"subject\" value=\"$subject\" size=\"55\" class=\"border\"><br>
       <span class=\"bodymain\">Message:</span><br>
       <textarea name=\"message\" rows=\"14\" cols=\"60\" class=\"border\">$message</textarea><br>
       <input type=\"hidden\" name=\"ident\" value=\"$ident\">
       <input type=\"hidden\" name=\"submit\" value=\"true\">
	   <input name=\"check\" type=\"checkbox\" value=\"check\" class=\"border\" checked> <span class=\"bodyfont\"> Show \"edited by $username\" </span>
       <input type=\"submit\" value=\"Edit\" class=\"border\">
     </form>";
}
?>
   </td>
  </tr>
 </table>
</td></tr>
</table>
<?php
}
?>
</body>
</html>