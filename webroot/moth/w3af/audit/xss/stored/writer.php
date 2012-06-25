Start --

<?

$filename = "data.txt";
$fp = fopen($filename, "a") or die("Couldn’t open $filename");

fwrite($fp, $_GET[a] . "\n");

fclose($fp);

?>

-- End
