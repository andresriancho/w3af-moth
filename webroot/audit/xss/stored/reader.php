Start --

<?

$filename = "data.txt";
$fp = fopen($filename, "r") or die("Couldn’t open $filename");
while(!feof($fp))
{
	$line = fgets($fp);
	print "$line<br>";
}

fclose($fp);

?>

-- End
