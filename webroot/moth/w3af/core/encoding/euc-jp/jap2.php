<?
    // The expected qs is the string "頴英衛詠鋭液疫益" urlencoded
    if (substr($_SERVER["QUERY_STRING"], 0, 48) == '%B1%D0%B1%D1%B1%D2%B1%D3%B1%D4%B1%D5%B1%D6%B1%D7'){
        echo "Not a 404";
    }
    else{
        header("HTTP/1.0 404 Not Found");
    }
?>
