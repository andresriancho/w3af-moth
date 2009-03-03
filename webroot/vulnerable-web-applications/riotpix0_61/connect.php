<?php
//=====================================
// Connect to the database
//=====================================
mysql_connect($host,$user,$pass) or die (mysql_error());
mysql_select_db($db) or die (mysql_error());

?>