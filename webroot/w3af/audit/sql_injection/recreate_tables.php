Droping database...<br/>
<?
$link = mysql_connect("localhost", "root", "chauchas!");
mysql_select_db("w3af_test", $link);
mysql_query("DROP database w3af_test;");
?>

Done...<br/>
<br/>

Creating tables...<br/>
<?

$fp = fopen('../create_tables.sql', "r");

$line = fgets($fp);
while( !feof($fp) ){
    echo $line . '<br/>';
    mysql_query($line);
    $line = fgets($fp);
}

?>
Done...<br/>

