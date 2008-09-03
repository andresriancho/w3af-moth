<html>
<meta http-equiv="content-type" content="application/xhtml+xml; charset=utf-8" />

	<?
		function errorHandler ($severity, $msg, $filename, $linenum)
		{

			echo "error found" . $msg;

		}
		set_error_handler ("errorHandler");
	?>

	<i>
		just some text
	</i>
	<br/>
	<br/>

	<?
		$link = mysql_connect("localhost", "root", "chauchas!");
		mysql_select_db("w3af_test", $link);

		$result = mysql_query("SELECT * FROM agenda where nombre ='" . $_POST['user'] ."'", $link);

		echo "<b>Nombre:</b> ".mysql_result($result, 0, "nombre")."<br>";
		echo "<b>Dirección:</b>  ".mysql_result($result, 0, "direccion")."<br>";
		echo "<b>Teléfono:</b> ".mysql_result($result, 0, "telefono")."<br>";
		echo "<b>E-Mail:</b> ".mysql_result($result, 0, "email")."<br>";

	?>

	<br/>
	<i>
		more text
	</i>

</html>
