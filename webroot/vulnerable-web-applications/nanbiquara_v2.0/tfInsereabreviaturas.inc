<?php
	function abreviaturas($sigla)
	{
		$query = "select extenso from abreviaturas where silga = $sigla";
		$resultado = mysql_query($query);
		while($registro = mysql_fetch_assoc($resultado))
			return $registro[extenso];
		return '0';
	}
?>
