<?

$link = mysql_connect("localhost", "root", "moth");

mysql_select_db("w3af_test", $link);

$sql_stm = "SELECT * FROM users where name='" . $_REQUEST["name"] . "'";
#echo $sql_stm;

$result = mysql_query( $sql_stm, $link);

if (!$result) {
  $exceptionstring = "Error performing query: $sql_stm: <br />";
  $exceptionstring .= mysql_errno() . ": " . mysql_error();
  throw new Exception($exceptionstring);
} else {
                                                            
  echo "<b>Name:</b> ".mysql_result($result, 0, "name")."<br>";    
  echo "<b>Address:</b>  ".mysql_result($result, 0, "address")."<br>";           
  echo "<b>Phone:</b> ".mysql_result($result, 0, "phone")."<br>";      
  echo "<b>Email:</b> ".mysql_result($result, 0, "email")."<br>"; 
}

?>
