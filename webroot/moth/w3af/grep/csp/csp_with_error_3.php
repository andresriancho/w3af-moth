<?php
/* Script send CSP headers with explicit error (here is the directive name that is invalid) */
$csp_headers = "def-src * ; sript-src toto.com ; default-src *";

header("Content-Security-Policy: $csp_headers");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<body>See HTTP header "Content-Security-Policy" values.</body>
</html>
