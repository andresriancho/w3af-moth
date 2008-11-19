<html>

<?

echo 'aslfknasf09ansf;aosnf';

$filename = "test-permanentxss.txt";
$fp = fopen($filename, "r") or die("Couldn’t open $filename");
while(!feof($fp))
{
	$line = fgets($fp);
	print "$line<br>";
}

fclose($fp);

echo 'alsifnasf09aspfn;kl'
?>

<a href="test123.html"> </a>

</html>
