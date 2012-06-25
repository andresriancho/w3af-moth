<?
    // The expected qs is the string "באתר" urlencoded
    if (substr($_SERVER["QUERY_STRING"], 0, 12) == '%E1%E0%FA%F8'){
        echo "Not a 404";
    }
    else{
        header("HTTP/1.0 404 Not Found");
    }
?>
