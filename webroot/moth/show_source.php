<?
if (isset($_GET['showphp'])) {
    print "<hr><a name='source'> </a><h3>PHP Source:</h3>";
        show_source($_SERVER['SCRIPT_FILENAME']);
}
?>