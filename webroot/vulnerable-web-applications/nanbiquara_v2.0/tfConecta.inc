<?php
	function conecta()
	{
		$bd = mysql_connect('mysql-f.sourceforge.net', 'fttss', 'subauru');
		mysql_select_db('fttss', $bd);
		return ($bd);
	}
?>
