<?php 
header('X-Frame-Options: DENY');
session_start();
?>
<h1>Content Security Policy (CSP) test pages</h1>
<ul>
    <li><a href="csp_without_error.php">Page without any error</a></li>
    <li><a href="csp_with_error_1.php">Page with error relation part 1</a></li>
    <li><a href="csp_with_error_2.php">Page with error relation part 2</a></li>
    <li><a href="csp_with_error_3.php">Page with error relation part 3</a></li>
</ul>
