<html>

<body>
<?
    /*$pairs = explode('&', $_SERVER['QUERY_STRING']);

    foreach($pairs as $pair) {
        list($name, $value) = explode('=', $pair, 2);
        echo $name . " = " . $value . "<br>";
    }*/
    echo $_SERVER['QUERY_STRING'] . "<br>";
    echo '::::: ' . $_GET['added'] . "<br>";
    echo '::::: ' . $_GET['a'];
    echo '::::: ' . $_GET['x'];
?>
</body>
</html>
