<meta http-equiv="content-type" content="application/xhtml+xml; charset=utf-8" />

<?

function errorHandler( $severity, $msg, $filename, $linenum){

#echo "error found" . $msg;

}

set_error_handler("errorHandler");

$link = mysql_connect("localhost", "root", "chauchas!");

mysql_select_db("w3af_test", $link);

if ( $_GET['debug'] ) {
echo "SELECT * FROM users where email ='" . $_GET['email'] ."'";
echo "<br>";
}

$result = mysql_query("SELECT * FROM users where email ='" . $_GET['email'] ."'", $link);

echo "<b>Name:</b> ".mysql_result($result, 0, "name")."<br>";    
echo "<b>Address:</b>  ".mysql_result($result, 0, "address")."<br>";           
echo "<b>Phone:</b> ".mysql_result($result, 0, "phone")."<br>";      
echo "<b>Email:</b> ".mysql_result($result, 0, "email")."<br>"; 

?>
