Start--
<?

$link = mysql_connect("localhost", "root", "moth");

mysql_select_db("w3af_test", $link);

$result = mysql_query("SELECT * FROM " . $_GET['table'] , $link);

echo "<b>Name:</b> ".mysql_result($result, 0, "name")."<br>";    
echo "<b>Address:</b>  ".mysql_result($result, 0, "address")."<br>";           
echo "<b>Phone:</b> ".mysql_result($result, 0, "phone")."<br>";      
echo "<b>Email:</b> ".mysql_result($result, 0, "email")."<br>"; 

?>
--End
