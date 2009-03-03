<?php 
$message=stripcslashes($message);
$subject=stripcslashes(htmlspecialchars($subject));

if($slashes == true){
	$message=stripcslashes($message);
	$subject=stripcslashes($subject);
}
?>


<table width="750" border="0" cellspacing="0" cellpadding="0" align="center">
<tr><td>
<table width="100%" border="0" cellspacing="1" cellpadding="3">
  <tr>
    <td class="border"><span class="bodymain">LEAVE MESSAGE:</span></td>
  </tr>
  <tr>
   <td valign="top" align="left" class="messages">
<form name="postform" onsubmit="SubmitOnce(this);" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>"><br />
    <span class="bodymain">Subject:</span><br />
    <input type="text"  size="55" name="subject" value="<?php echo $subject?>" maxlength="100" class="border" /><br />
    <span class="bodymain">Message:</span><br />
    <textarea name="message" rows="14" cols="60" class="border"><?php echo $message?></textarea><br />
    <input type="hidden" name="reply" value="<?php echo $reply?>" />
	<input type="hidden" name="name" value="<?php echo $username?>" />
    <input type="hidden" name="post" value="true" />
	<input type="submit" value="Submit" class="border" />
    <input type="checkbox" name="preview"  value="preview" class="border" /><span class="bodyfont">Preview</span>
</form>
   </td>
  </tr>
 </table>
</td></tr>
</table>
<table width="750" border="0" cellspacing="5" cellpadding="10" align="center" class="border">
	<tr>
		<td>
		<span class="bodymain">PREVIEW:<br /></span>
		<?php		
		// convert a few special characters to their &... equivelant
		$message = ereg_replace( "<3", "&lt;3", $message );
		$message = strip_tags($message, '<a><b><i><u><blockquote>');
		echo"<span class=\"smallfont\">".nl2br(UBB($message))."</span>";
		?>
		</td>
	</tr>
</table>