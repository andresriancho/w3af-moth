<?


function errorHandler( $severity, $msg, $filename, $linenum){

echo "error found";

}

set_error_handler("errorHandler");

$link = mysql_connect("localhost", "root" , "chauchas!");

mysql_select_db("w3af_test", $link);

#echo "SELECT * FROM agenda where id =" . $_GET['id'];
#echo '<br/>';

$result = mysql_query("SELECT * FROM agenda where id =" . $_GET['id'] , $link);

echo "Nombre: ".mysql_result($result, 0, "nombre")."<br>";
echo "Dirección: ".mysql_result($result, 0, "direccion")."<br>";
echo "Teléfono :".mysql_result($result, 0, "telefono")."<br>";
echo "E-Mail :".mysql_result($result, 0, "email")."<br>";


?>
