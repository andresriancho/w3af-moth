<meta http-equiv="content-type" content="application/xhtml+xml; charset=utf-8" />

<?


function errorHandler( $severity, $msg, $filename, $linenum){

#echo "error found" . $msg;

}

set_error_handler("errorHandler");

$link = mysql_connect("localhost", "root" , "chauchas!");

mysql_select_db("w3af_test", $link);

$result = mysql_query("SELECT * FROM users where id =" . $_GET['id'] , $link);

echo "<i>don't get fooled by the 'static' response, the id parameter <b>is</b> injectable</i>";

?>
