<?

$link = mysql_connect("localhost", "root", "chauchas!");

mysql_select_db("w3af_test", $link);

$result = mysql_query("SELECT * FROM users where nombre='" . $_GET["nombre"] . "'", $link);


$num_rows = mysql_num_rows($result);
           
//if query result is empty, returns NULL, otherwise, returns an array containing the selected fields and their values
if($num_rows == NULL)
{
    die('No results.');
}
   
echo "<b>Name:</b> ".mysql_result($result, 0, "name")."<br>";    
echo "<b>Address:</b>  ".mysql_result($result, 0, "address")."<br>";           
echo "<b>Phone:</b> ".mysql_result($result, 0, "phone")."<br>";      
echo "<b>Email:</b> ".mysql_result($result, 0, "email")."<br>"; 

?>
