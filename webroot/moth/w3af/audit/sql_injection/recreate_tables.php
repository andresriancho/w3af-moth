Droping database...<br/>
<?
$link = mysql_connect("localhost", "root", "moth");
mysql_select_db("w3af_test", $link);
mysql_query("DROP database w3af_test;");
?>

Done...<br/>
<br/>

Creating tables...<br/>
<?

$fp = fopen('/var/www/moth/setup/w3af_test.sql', "r");

if ($fp){
  $line = fgets($fp);
  while( !feof($fp) ){
      echo $line . '<br/>';
      mysql_query($line);
      $line = fgets($fp);
  }
}

?>
Done...<br/>

