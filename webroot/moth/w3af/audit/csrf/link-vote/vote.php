<?php
    include("header.php");
    include("countlib.php");
    vote(intval($_GET['act']));
    echo "Thanks for voting for user with id ". intval($_GET['act']) ."!<br><br>";
    include("footer.php");    
?>