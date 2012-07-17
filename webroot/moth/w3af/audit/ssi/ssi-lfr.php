<html>
<?
	$filename = "messages.shtml";
	$fp = fopen($filename, "a") or die("Couldn’t open $filename");

	fwrite($fp, '<li>' . $_GET['message'] . "</li>\n");

	fclose($fp);
?>
Thanks for leaving your message! Please <a href="view-messages.shtml">click here</a> to view all messages.
</html>
