<ul>
<?php

define('ADD_RAND', true);
for ($i=0;$i < 250; $i++) {
    $part = '';
    if (rand(0,1) && ADD_RAND) {
        $part = '&foo=bar';
    }

?>
    <li><a href="article.php?id=<?php echo $i.$part?>">news for <?php echo $i ?></a></li>
<?php } ?>
</ul>
