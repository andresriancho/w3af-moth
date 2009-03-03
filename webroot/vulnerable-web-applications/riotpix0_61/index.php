<?php
######################################################
#
# RiotPix 
# Javod Khalaj - riotpix@gmail.com
# http://www.riotpix.com
# Licensed under the CC-GNU-GPL
#
######################################################

//=====================================
// First, lets setup all the includes.
//=====================================
    require("conf.php");
	require("sessions.php");
	include("header.php");
	require("sessions_form.php");
	include("functions.php");
	include ("connect.php");

//=====================================
// Now we start the page numbering
//=====================================
@$page = $_GET['page'];

//======================================
// if page not set, or below 0, set to 0
//======================================
if (!isset($page) || $page < 0)
$page = 0;
	

//=======================================================
// Gets starting point for messages to place in sql query
//=======================================================
$message_start_point = $page * $messages_per_page;

//=================================================
// Select all messages (Not replies) from the forum
//=================================================
$res = mysql_query ("SELECT * FROM forum WHERE belongstoid = 0 ORDER BY time DESC LIMIT $message_start_point, $messages_per_page") or die (mysql_error());

//=======================================
// Now lets get the total number of rows.
//=======================================
$out1 = mysql_query ("SELECT * FROM forum WHERE belongstoid = 0") or die (mysql_error());
$num = mysql_num_rows($out1);

//=============================================
// Now lets start including the template
//=============================================
?>
<table width="750" border="0" align="center" cellpadding="1" cellspacing="0">
 	<tr> 
    	<td width="400" align="right" class="bodyfont">&nbsp;</td>
    	<td width="350" align="right" class="bodyfont" valign="bottom">
	<a href="<?php echo "$url_path"?>/message.php?reply=0">Add a message</a> | 
<?php

//==============================================================
// Here we shall see the links for the previous and next messages
//==============================================================
	if ($page > 0) echo "<a href=\"./index.php?page=" . ($page - 1) . "\">Next $messages_per_page messages</a> | "; else echo "Next $messages_per_page messages | ";
	
	$bla = $messages_per_page + $messages_per_page * $page;
	
	if ($num > $bla) echo "<a href=\"./index.php?page=" . ($page + 1) . "\">Past $messages_per_page messages</a>"; else echo "Past $messages_per_page messages";

//=============================================
// Now lets start including the forum header
//=============================================	
?>
		</td>
	</tr>
</table>

<table width="750" border="0" cellspacing="0" cellpadding="0" align="center">
<tr><td>
<table width="100%" border="0" cellspacing="1" cellpadding="2">
	<tr class="border">
		<td height="20" class="bodymain">Subject:</td>
		<td height="20" class="bodymain">By:</td>
		<td height="20" class="bodymain">Replies:</td>
		<td height="20" class="bodymain">Posted:</td>
		<td class="bodymain">Last Reply: </td>
	</tr>
<?php
		
//===================================
// We need to loop the messages here.
//===================================
while($row = mysql_fetch_object($res)){

//=========================================
// Now we need to finish the page numbering
//=========================================	
$numberofpages = (($row->replys / $messages_per_page) - 1);
	$n = ceil($numberofpages);
	if ($n == -1){
		$n=0;
	}
	else {
		$n = abs($n);
	}
	
	$forumid = $row->forumid;

//=========================================
// now for the actual message 
//=========================================			
?>
<tr>
	<td nowrap="nowrap" class="subject"><span class="smallfont"><a href="<?php echo "$url_path"?>/read.php?forumid=<?php echo $row->forumid?>"> <?php echo (strlen($row->subject) > $max_length) ? substr(htmlspecialchars($row->subject),0,$max_length)."..." : htmlspecialchars($row->subject)?></a></span></td>
	      <td  nowrap="nowrap" class="light"> 
            <?php echo (strlen($row->name) > $max_length) ? substr(htmlspecialchars($row->name),0,$max_length)."..." : htmlspecialchars($row->name)?>
          </td>
	<td  nowrap="nowrap" class="dark">&nbsp;&nbsp;<?php echo $row->replys?>	
	</td>
	<td nowrap="nowrap" class="light"><?php echo $row->submitdate?></td>
    	<td nowrap="nowrap" class="dark">
			<?php 
			echo"<a href=\"$url_path/read.php?forumid=$forumid&amp;page=$n#bottom\" onmouseover=\"this.T_WIDTH=110;return escape('Last Reply:&lt;br />&lt;img src=\'$url_path/users/$row->lastposter/main.jpg\' width=\'100\'>&lt;br />$row->lastposter')\">$row->lastreply</a>";
			?>
		</td>
	</tr>
<?php
}

//=========================================
// The footer.
//=========================================	
?>
			</table>
		</td>
	</tr>
</table>
<table width="750" border="0" cellspacing="0" cellpadding="5" align="center">
  <tr>
    <td align="right" class="bodyfont"><a href="<?php echo "$url_path"?>/message.php?reply=0">Add a message</a> | &copy; <a href="http://www.riotpix.com" target="_blank">RiotPix.com</a> <?php echo $version?></td>
  </tr>
</table>
<?php
include("footer.php");
?>