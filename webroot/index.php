<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
 <head>
  <link rel="stylesheet" type="text/css" href="/w3af/default.css" title="default" />
  <title>:: moth homepage ::</title>
 </head>

<body>

<? require_once('header.php'); ?>

<div id="body">

<br />
<div align="center"><h3>Welcome to the moth homepage! </h3></div>
<br />
<br />
<p>Moth is a VMware image with a set of vulnerable Web Applications, that you may use for testing Web 
Application Security Scanners and Static Code Analysis tools (SCA).
</p>

<p>The motivation for creating this image came after reading "anantasec-report.pdf" which is included
in this release ("anantasec/anantasec-report.pdf"). The main objective of this vmware image is to
be able to test the w3af - Web Application Attack and Audit Framework and compare it with the
commercial tools included in the report.</p>

<p>Other tools like this are available (securibench to name one) but they lack
one very important feature: a list of vulnerabilities that are included in the Web
Applications! In our case, we use the results gathered in the anantasec
report as our list of Web Application Vulnerabilities
included in the release.</p>

 <h1 id="w3af">
     w3af test scripts (PHP)
 </h1>
    <p>This section has all the scripts that are run using the "./w3af_console -t"
 command. The objective of these vulnerable scripts is to test w3af, there
    is no intention to have a complete Web Application. There are three
 different ways to access THE SAME vulnerable PHP scripts: </p>
 <ul>
 	<li><a href="/w3af/">Directly, without any protection</a></li>
 	<li><a href="/mod_security/w3af/">Using mod_security</a></li>
 	<li><a href="/php-ids/w3af/">Using PHP-IDS</a></li>
 </ul>

    <p>For both the mod_security and php-ids versions of the test scripts, a
    clear indication is shown when you are detected by the corresponding IDS
    system: 
    <a href="/php-ids/w3af/audit/xss/simple_xss.php?text=1&test=><script>eval(window.name)</script>">PHP-IDS</a>
     , <a href="/mod_security/w3af/audit/xss/simple_xss_no_js.php?text=1' union select * from table where 1=1">mod_security</a> .</p>

 <h1 id="wivet">
     wivet (PHP)
 </h1>
    <p>WIVET is a benchmarking project that aims to statistically analyze web link extractors. In general,
    web application vulnerability scanners fall into this category. These VAs, given a URL(s), try to extract as many input vectors as possibly they
    can to increase the coverage of the attack surface. There are three
     different ways to access Wivet:</p>
    <ul>
        <li><a href="/wivet/">Directly, without any protection</a></li>
        <li><a href="/mod_security/wivet/">Using mod_security</a></li>
        <li><a href="/php-ids/wivet/">Using PHP-IDS</a></li>
    </ul>

 <h1 id="SiteGenerator">
     SiteGenerator (JSP)
 </h1>
    OWASP SiteGenerator - Application Security Tool Benchmarking Environment. <a
 href="/sitegenerator/">Click here</a> to
 access one of the simplest websites that can be generated using SiteGenerator. The output language was JSP.<br/>

 <h1 id="vulnerable-web-applications">
     Vulnerable Web Applications (PHP, Java, Ruby)
 </h1>
    This section contains most of the applications included in <a href="/vulnerable-web-applications/">anantasec's</a> Web Application Scanner comparison.

 <h1 id="misc">
     Other files and resources
 </h1>
    Inside this directory you'll also find a collection of files that are also used by w3af to perform self-tests:<br/>

    <ol>
        <li><a href="phpinfo.php">phpinfo.php</a></li>
        <li><a href="crossdomain.xml">crossdomain.xml</a></li>
        <li><a href="sitemap.xml">sitemap.xml</a></li>
        <li><a href="robots.txt">robots.txt</a></li>
        <li><a href="intranet/">intranet/</a></li>
        <li><a href="icons/">icons/</a></li>
        <li><a href="python_test/">python_test/</a></li>
        <li><a href="http://<? echo $_SERVER['SERVER_ADDR']; ?>:8080/manager/html">Tomcat manager</a> (moth/moth)</li>
    </ol>
<br />
<br />
<br />

</div id="body">
</body>
</html>
