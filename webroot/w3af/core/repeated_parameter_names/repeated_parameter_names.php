Start--
<?

#
#	Parse the repeated parameter names
#
$qs = $_SERVER["QUERY_STRING"];
$ids = array();
$i = 0;
foreach ( split('&', $qs) as $one_id){
  $tmp_array = split('=',$one_id);
  $ids[$i] = $tmp_array[1];
  $i++;
}

#
#	Use the repeated parameter names
#

$link = mysql_connect("localhost", "root", "moth");

mysql_select_db("w3af_test", $link);

# In "id"[0] we have a SQL injection
$result = mysql_query("SELECT * FROM users where id=" . $ids[0], $link);

echo "<b>Name:</b> ".mysql_result($result, 0, "name")."<br>";
echo "<b>Address:</b>  ".mysql_result($result, 0, "address")."<br>";
echo "<b>Phone:</b> ".mysql_result($result, 0, "phone")."<br>";
echo "<b>Email:</b> ".mysql_result($result, 0, "email")."<br>";

# in "id"[1] we have a XSS
if ( $ids[0] == 1 ) { echo $ids[1]; }

?>
--End
