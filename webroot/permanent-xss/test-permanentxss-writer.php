<html>

<?

echo 'aslfknasf09ansf;aosnf';

$filename = "test-permanentxss.txt";
$fp = fopen($filename, "a") or die("Couldn’t open $filename");

fwrite($fp, $_GET[a] . "\n");

fclose($fp);

echo 'alsifnasf09aspfn;kl'
?>

<a href="test3456.html"> </a>

</html>
