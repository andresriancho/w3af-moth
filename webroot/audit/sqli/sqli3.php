<?

$link = mysql_connect("localhost", "root", "chauchas!");

mysql_select_db("w3af_test", $link);

$result = mysql_query("SELECT * FROM agenda where nombre='" . $_GET["nombre"] . "'", $link);


$num_rows = mysql_num_rows($result);
           
//if query result is empty, returns NULL, otherwise, returns an array containing the selected fields and their values
if($num_rows == NULL)
{
    die('No results.');
}
   
echo "Nombre: ".mysql_result($result, 0, "nombre")."<br>";

echo "Dirección: ".mysql_result($result, 0, "direccion")."<br>";

echo "Teléfono :".mysql_result($result, 0, "telefono")."<br>";

echo "E-Mail :".mysql_result($result, 0, "email")."<br>";


?>
