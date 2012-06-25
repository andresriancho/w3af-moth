<html>

Start--
<?

$input = $_GET['text'];
$tmp = str_ireplace('"','',$input);
echo str_ireplace("'",'',$tmp);

?>
--End
</html>
