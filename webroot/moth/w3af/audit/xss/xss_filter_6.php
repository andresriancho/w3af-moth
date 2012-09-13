<!--
Bypass:  <button/a=">" autofocus onfocus=alert(1)></button>
         http://blog.kotowicz.net/2012/07/codeigniter-210-xssclean-cross-site.html
-->
<?

include('security-4ad0fd86e8.php');
$cisecurity = new CI_Security();
echo $cisecurity->xss_clean($_GET['text']);

?>