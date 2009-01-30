<html>

<b>
Start--
</b>
<br/>

<?

$link = mysql_connect("localhost", "root", "chauchas!");

mysql_select_db("w3af_test", $link);

$result = mysql_query("SELECT * FROM users WHERE nombre ='" . $_POST['firstname'] ."'", $link);

if ($result){

	if ($row = mysql_fetch_array($result)){ 

	    echo "<b>Name:</b> ".mysql_result($result, 0, "name")."<br>";    
	    echo "<b>Address:</b>  ".mysql_result($result, 0, "address")."<br>";           
	    echo "<b>Phone:</b> ".mysql_result($result, 0, "phone")."<br>";      
	    echo "<b>Email:</b> ".mysql_result($result, 0, "email")."<br>"; 
	}
	
else
{	
	echo "No value!";
}

?>
<br/>
<i>
--End
</i>

</html>
