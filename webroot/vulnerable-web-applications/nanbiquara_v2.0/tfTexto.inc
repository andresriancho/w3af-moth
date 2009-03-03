<?php

class tfTexto
{
//------------------------------------------------------------------------------
	var
		$texto,
		$nro_frases,
		$frases;
//------------------------------------------------------------------------------
	function tfTexto($t)
	{
		$this->texto = $t;
		$this->frases = array();
		
		// separa o texto em frases
		$f = split("[.!?]", $t);
		for ($i = 0; $i < sizeof($f); $i++)
		{
			$indice = strlen($f[$i]);
			$f[$i] .= $t[$indice];
			$t = substr($t, ($indice + 1));
			if (strlen($f[$i]) != 0)
				array_push($this->frases, new tfFrase($f[$i]));
		}
		$this->nro_frases = count($this->frases);
	}
//------------------------------------------------------------------------------
	function mostra_frases()
	{
		//echo "Texto: $this->texto<br>";
		for($i = 0; $i < $this->nro_frases; $i++)
		{
			$this->frases[$i]->mostra_palavras();
		}
	}
//------------------------------------------------------------------------------
	function avalia_frases($freq, $temp)
	{
		for($i = 0; $i < $this->nro_frases; $i++)
		{
			$this->frases[$i]->avalia_palavras($freq, $temp);
		}
	}
//------------------------------------------------------------------------------
}

?>