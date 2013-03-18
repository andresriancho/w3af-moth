<?php
/* Script send CSP headers with explicit error */
$csp_headers = "default-src *";

header("Content-Security-Policy: $csp_headers");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<body>See HTTP header "Content-Security-Policy" values.</body>
</html>
