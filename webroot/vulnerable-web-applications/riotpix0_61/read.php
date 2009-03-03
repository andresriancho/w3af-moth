<?php 
	require("conf.php");
	require("sessions.php");
	include("header.php");
	require("sessions_form.php");
	include("functions.php");
	
	$server = mysql_pconnect($host,$user,$pass);
	mysql_select_db($db,$server);
	
	$forumid = $_REQUEST['forumid'];
	$page = @$_REQUEST['page'];
	
	// if no forumid number is present, exit out of page
	if (empty($forumid)){
		echo "No id number";
		exit();
	}
?>

<table width="750" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr>
  		<td>
		<?php
			$sql = "SELECT * FROM forum LEFT JOIN users ON users.updateu = forum.name WHERE forum.forumid = $forumid ORDER BY sorter DESC";		
			$res = mysql_query($sql);
			$row = mysql_fetch_array($res);
			$namee = $row["name"];
			$rep = $row["belongstoid"];
			$ifexist = $row["sorter"];
			$replys = $row["replys"];
	
			// get the ceiling for replys. needed to go from one page to another
			$numberofpages = ($replys / $messages_per_page);
			$n = ceil($numberofpages);
		
			// prevents people from accessing replies as actual messages
			if($rep > 0) {
				echo "You have attempted to access a reply: query terminated.";
				exit("\n</td>\n</tr>\n</table>\n</table>\n</body>\n</html>");	
			}
			// prevents people from accessing non-existent posts (otherwise SQL error would appear)
			elseif (!$ifexist) {
				echo "You have attempted to access a non-existent post: query terminated.";
				exit("\n</td>\n</tr>\n</table>\n</table>\n</body>\n</html>");
			}
			elseif (empty($page)) {
			echo "
<table width=\"100%\" border=\"0\" align=\"center\" cellpadding=\"3\" cellspacing=\"1\">				
	<tr>
		<td class=\"subject\"><span class=\"bodymain\">
			The message:</span>
		</td>
	</tr>
	<tr class=\"messages\">
		<td valign=\"top\" align=\"left\" ><div align=\"right\"></div>
		<b>Subject:</b> <span class=\"bodyfont\">".htmlspecialchars($row["subject"])."</span><br />\n"; 
					if (!empty($row["updateu"])) {
						echo "<b>By:</b> <span class=\"bodyfont\">".htmlspecialchars($row["name"])."</span><br />\n";
					}
					elseif (empty($row["$updateu"])) {
						echo "<b>By:</b> <span class=\"bodyfont\">".htmlspecialchars($row["name"])." - user terminated</span><br />\n";
					}
					echo "<b>Written on:</b> <span class=\"bodyfont\">".$row["submitdate"]."</span><br />\n<b>Message:</b><br /><table width=\"750\"><tr><td width=\"110\" valign=\"top\"><img src=\"$url_path/users/".$row["name"]."/main.jpg\" width=\"100\" border=\"1\" alt=\"pic\" /><br />";
			
			if (!empty($row["updateu"])) {
			echo "<br /><div align=\"center\" class=\"bodyfont\">posts:".$row["posts"]."</div>";
			}
			
	echo"</td><td width=\"640\" class=\"bodyfont\" valign=\"top\">";
	if (@$username == $admin_name) {
	echo"<div align=\"right\"><a href=\"edit_posts.php?ident=".$row["forumid"]."\">
	<img src=\"$url_path/images/edit.gif\" border=\"0\"></a><a href=\"edit_posts.php?delete=delete&ident=".$row["forumid"]."\">
	<img src=\"$url_path/images/delete.gif\" border=\"0\" title=\"delete\" alt=\"delete\" /></a></div>";
	}
	echo"".nl2br(UBB($row["message"]))."</td></tr></table><br />\n";
	echo "</td>\n";
	echo "</tr>\n";
	}
?>
			</table>
		</td>
	</tr>
</table>
<?php

if (!isset($page))
	$page = 0;
	$aantal_per_page = $messages_per_page;
	$x = $page * $aantal_per_page;	
	
	$subject = $row["subject"];    
	$sql = "SELECT * FROM forum LEFT JOIN users ON users.updateu = forum.name WHERE belongstoid = $forumid ORDER BY sorter LIMIT $x, $aantal_per_page";
	$res = mysql_query($sql);
		
     echo "
	 <table width=\"750\" cellspacing=\"1\" cellpadding=\"3\" border=\"0\" align=\"center\">
<tr>	<td width=\"375\" class=\"bodyfont\"><div align=\"left\">";
	for ($b=1; $b <= $n; $b++)
          {
          $Res1=($b-1);
		   if ($page == $Res1){
		  echo"<b>";
		  }
		  echo "<a href=\"./read.php?forumid=$forumid&amp;page=$Res1\">";
		  echo"$b</a>&nbsp;&nbsp;";
		  if ($page == $Res1){
		  echo"</b>";
		  }
		  }

echo"</div>
		</td>
		<td class=\"bodyfont\">
			<div align=\"right\"><a href=\"$url_path\" class=\"bodyfont\">Message Board</a> | <a href=\"./message.php?page=$page&amp;subject=Re:".htmlspecialchars($row['subject'])."&amp;reply=$forumid\" class=\"bodyfont\">Reply to this 
        message</a>
			</div>
		</td>
	</tr>
</table> 
<table width=\"750\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
<tr><td>
<table width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"3\" align=\"center\">
  <tr>
    <td class=\"subject\"> <span class=\"bodymain\">Replies</span></td>
  </tr>";
	 


	if(mysql_num_rows($res) == 0){
		echo "<tr class=\"messages\">
				<td valign=\"top\" align=\"left\" class=\"bodymain\">
					No replies
				</td>
			</tr>";
	} else {
		while($row = mysql_fetch_object($res)){
		$namee = $row->name;
		
	
			echo "<tr class=\"messages\">\n";
			echo "<td valign=\"top\" align=\"left\"><div align=\"right\"></div>";
			echo "<a name=\"$row->forumid\"><b>Subject:</b> <span class=\"bodyfont\">".htmlspecialchars($row->subject)."</span></a><br />\n"; 
			if (!empty($row->updateu)) {
			echo "<b>By:</b> <span class=\"bodyfont\">".htmlspecialchars($row->name)."</span><br />\n";
			}
			elseif (empty($row->updateu)) {
			echo "<b>By:</b> <span class=\"bodyfont\">".htmlspecialchars($row->name)." - user terminated</span><br />\n";
			}
			echo "<b>Written on:</b> <span class=\"bodyfont\">$row->submitdate</span><br />\n";
			echo "<b>Message:</b><br /><table width=\"750\">
			<tr>
				<td width=\"110\" valign=\"top\">
					<img src=\"$url_path/users/".$row->name."/main.jpg\" width=\"100\" border=\"1\" alt=\"pic\" /><br />";

			if (!empty($row->updateu)) {
			echo "<br /><div align=\"center\" class=\"bodyfont\">posts:".$row->posts."</div>";
			}
			echo"</td><td width=\"640\" class=\"bodyfont\" valign=\"top\">";
				if (@$username == $admin_name) {
				echo"<div align=\"right\"><a href=\"edit_posts.php?ident=".$row->forumid."\">
				<img src=\"$url_path/images/edit.gif\" border=\"0\" /></a><a href=\"edit_posts.php?delete=delete&ident=".$row->forumid."\">
				<img src=\"$url_path/images/delete.gif\" border=\"0\" title=\"delete\" alt=\"delete\" /></a></div>";
				}
			echo"".nl2br(UBB($row->message))."</td></tr></table></td>\n";
			echo "</tr>\n";
		}
	}
?>
</table>
</td></tr>
</table>

<table width="750" border="0" align="center" cellpadding="0" cellspacing="0">
	<tr>
		<td width="375" class="bodyfont"><div align="left">
		<?php
		// code to paginate and bold page number that represents current page
		for ($b=1; $b <= $n; $b++){
        	$Res1=($b-1);
		  	if ($page == $Res1){
		  		echo"<b>";
			}
			echo "<a href=\"./read.php?forumid=$forumid&amp;page=$Res1\">$b</a>&nbsp;&nbsp;";
			if ($page == $Res1){
				echo"</b>";
		  	}
		}
		?>
</div></td>
	<td height="20" align="right" class="bodyfont"><div align="right"><a name="bottom"></a><a href="<?php echo $url_path?>">Message Board</a> | <a href="<?php echo $url_path?>/message.php?page=<?php echo $page?>&amp;subject=Re:<?php echo htmlspecialchars($subject)?>&amp;reply=<?php echo $forumid?>">Reply to this message</a> | &copy; <a href="http://www.riotpix.com/">RiotPix</a>

 </div></td>
</tr>
</table>
<?php include("footer.php"); ?>