<?php

class tfFonema
{
//------------------------------------------------------------------------------
	var
		$fonema,
		$tipo,
		$tempo,
		$frequencia;
//------------------------------------------------------------------------------
	function tfFonema($f)
	{
		$this->fonema = $f;
		$this->tempo = 0;
		$this->frequencia = 0;
	}
//------------------------------------------------------------------------------
	function mostra_fonema()
	{
		global $saida;
		$saida .= "$this->fonema $this->tempo 100 $this->frequencia\n";
	}
//------------------------------------------------------------------------------
	function avalia_fonema($freq, $temp)
	{
		$this->frequencia = $freq;
		$this->tempo = $temp;
	}
//------------------------------------------------------------------------------
}

?>