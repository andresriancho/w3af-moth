<?
$link = mysql_connect("localhost", "root", "moth");

if (mysql_query("CREATE DATABASE IF NOT EXISTS w3af_test", $link))
{
   echo "Database created<br/>";
}else{
   echo "Error creating database: " . mysql_error();
}
            
mysql_select_db("w3af_test", $link);
?>

Creating tables...<br/>
<?

// Temporary variable, used to store current query
$templine = '';

// Read in entire file
$filename = '/var/www/moth/setup/w3af_test.sql';
$lines = file($filename);

// Loop through each line
foreach ($lines as $line)
{
    // Skip it if it's a comment
    if (substr($line, 0, 2) == '--' || $line == '')
        continue;
                 
    // Add this line to the current segment
    $templine .= $line;
    // If it has a semicolon at the end, it's the end of the query
    if (substr(trim($line), -1, 1) == ';')
    {
       // Perform the query
       mysql_query($templine) or print('Error performing query \'<strong>' . $templine . '\': ' . mysql_error() . '<br /><br />');
       // Reset temp variable to empty
       $templine = '';
    }
}
?>
                                                                    

Done...<br/>

