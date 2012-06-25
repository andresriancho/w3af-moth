<?
include("funcs.php");

echo 'HEADER>>> ', generateRandStr(50), '<br><br>';

if (array_key_exists('input', $_POST)) {
	$input = $_POST["input"];
	printQueryResult('/articles/article[@id="'. $input .'"]/title');
}

echo '<br><br>'; echo 'FOOTER>>> ', generateRandStr(60);
?>
