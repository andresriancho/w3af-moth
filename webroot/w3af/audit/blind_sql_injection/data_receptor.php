<html>
<meta http-equiv="content-type" content="application/xhtml+xml; charset=utf-8" />

	<?
		function errorHandler ($severity, $msg, $filename, $linenum)
		{

			#echo "error found" . $msg;

		}
		set_error_handler ("errorHandler");
	?>

	<i>
		Start--
	</i>
	<br/>
	<br/>

	<?
		$link = mysql_connect("localhost", "root", "moth");
		mysql_select_db("w3af_test", $link);

		$result = mysql_query("SELECT * FROM users where name ='" . $_POST['user'] ."'", $link);

		echo "<b>Name:</b> ".mysql_result($result, 0, "name")."<br>";    
		echo "<b>Address:</b>  ".mysql_result($result, 0, "address")."<br>";           
		echo "<b>Phone:</b> ".mysql_result($result, 0, "phone")."<br>";      
		echo "<b>Email:</b> ".mysql_result($result, 0, "email")."<br>"; 

	?>

	<br/>
	<i>
		--End
	</i>

</html>
