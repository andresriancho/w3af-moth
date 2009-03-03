<?php
	include 'tfConecta.inc';
	include 'tfDesconecta.inc';

	conecta();

	$abreviaturas = file('csv/abreviaturas.csv');
	while(list($linha_num, $linha) = each($abreviaturas))
	{
		$pedacos = explode(';', $linha);
		$pedacos[0] = substr($pedacos[0], 0, strlen($pedacos[0])-1);
		$pedacos[1] = substr($pedacos[1], 0, strlen($pedacos[1])-2);
		echo "sigla - $pedacos[0] | extenso - $pedacos[1]<br>";
		$query = 'insert into abreviaturas values (\''.$pedacos[0].'\', \''.$pedacos[1].'\');';
		mysql_query($query, $bd);
	}

	desconecta();
?>
