<?
include("funcs.php");

echo 'HEADER>>> ', generateRandStr(50), '<br><br>';

if (array_key_exists('input', $_REQUEST)) {
	$input = $_REQUEST["input"];
	printQueryResult("/articles/article/tags[tag='php' or tag='". $input ."']/../title");
}

echo '<br><br>'; echo 'FOOTER>>> ', generateRandStr(60);
?>
