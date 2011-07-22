<?
    // The expected qs is the urlencoded version of the string "באתר" (previously encoded to utf8)
    if (substr($_SERVER["QUERY_STRING"], 0, 12) == '%E1%E0%FA%F8'){
        echo "NOT a 404";
    }
    else{
        header("HTTP/1.0 404 Not Found");
    }
?>
