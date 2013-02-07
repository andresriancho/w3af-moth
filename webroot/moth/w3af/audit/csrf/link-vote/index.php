<? include("header.php"); ?>
<? include("countlib.php"); ?>    
    <a href="vote.php?act=123">
	<img src="images/avatar1.png" alt="andres" width="280">
	<br>
	<img src="images/green.png" alt="" height="14" width="14">
	&nbsp;Vote for @w3af
    </a>(Current votes: <?= current_votes(123); ?>)<br><br>
    
    <a href="vote.php?act=456">
    	<img src="images/avatar2.png" alt="hernan" width="280">
	<br>
	<img src="images/green.png" alt="" height="14" width="14">
	&nbsp;Vote for @my4ng3l 
    </a>(Current votes: <?= current_votes(456); ?>)<br><br>

<? include("footer.php"); ?>    
