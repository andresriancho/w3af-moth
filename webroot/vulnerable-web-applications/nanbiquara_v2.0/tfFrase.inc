<?php

class tfFrase
{
//------------------------------------------------------------------------------
	var
		$frase,
		$tipo,
		$nro_palavras,
		$palavras;
//------------------------------------------------------------------------------
	function tfFrase($f)
	{
		$f = trim($f);
		$this->frase = $f;
		$this->palavras = array();
		
		switch ($f[(strlen($f) - 1)])
		{
			case '.' : $this->tipo = AFIRMATIVA; break;
			case '!' : $this->tipo = EXCLAMATIVA; break;
			case '?' : $this->tipo = INTERROGATIVA; break;
			default : $this->tipo = AFIRMATIVA; break;
		}
		
		// separa a frase em palavras
		$f = trim($f, ".!?");
		$p = explode(" ", $f);
		
		while (list($i, $k) = each($p))
			if (strlen($k) != 0)
				array_push($this->palavras, new tfPalavra($k));
		
		$this->nro_palavras = count($this->palavras);
	}
//------------------------------------------------------------------------------
	function mostra_palavras()
	{
		global $saida;
		//echo "Frase: $this->frase<br>";
		for($i = 0; $i < $this->nro_palavras; $i++)
		{
			$this->palavras[$i]->mostra_silabas();
		}
		$saida .= "_ 300\n";
	}
//------------------------------------------------------------------------------
	function avalia_palavras($freq, $temp)
	{
		$l = 0;
		switch ($this->tipo)
		{
			case INTERROGATIVA:
			{
				$total = 0;
				$m = 0;
				for($i = 0; $i < $this->nro_palavras; $i++)
					for($j = 0; $j < $this->palavras[$i]->nro_silabas; $j++)
						for($k = 0; $k < $this->palavras[$i]->silabas[$j]->nro_fonemas; $k++)
							$total++;
				
				echo $total.'<br>';
				
				for($i = 0; $i < $this->nro_palavras; $i++)
				{
					$tempo = $temp;
					$frequencia = 0;
					$this->palavras[$i]->avalia_silabas($frequencia, $tempo);

					for($j = 0; $j < $this->palavras[$i]->nro_silabas; $j++)
						for($k = 0; $k < $this->palavras[$i]->silabas[$j]->nro_fonemas; $k++)
						{
							$freq1 = 2 * sin($l) + 15;
							$freq2 = 20 * sin(2*pi()*$m/$total) + 90;
							$freq = $freq1 + $freq2;
							$this->palavras[$i]->silabas[$j]->fonemas[$k]->frequencia = $freq;
							// echo $freq.' ';
							$l+= 0.25;
							$m++;
						}
				}
				break;
			}
			case EXCLAMATIVA:
			{
				$sinal = 1;
				for($i = 0; $i < $this->nro_palavras; $i++)
				{
					$tempo = $temp;
					$frequencia = $freq;
					$this->palavras[$i]->avalia_silabas($frequencia, $tempo);

					for($j = 0; $j < $this->palavras[$i]->nro_silabas; $j++)
						for($k = 0; $k < $this->palavras[$i]->silabas[$j]->nro_fonemas; $k++)
						{
							$freq = 2 * sin($l) + 100;
							$this->palavras[$i]->silabas[$j]->fonemas[$k]->frequencia = $freq;
							// echo $freq.' ';
							$l+= 0.25;
						}
				}
				break;
			}
			default:
			{
				$sinal = 1;
				for($i = 0; $i < $this->nro_palavras; $i++)
				{
					$tempo = $temp;
					$frequencia = $freq;
					$this->palavras[$i]->avalia_silabas($frequencia, $tempo);

					for($j = 0; $j < $this->palavras[$i]->nro_silabas; $j++)
						for($k = 0; $k < $this->palavras[$i]->silabas[$j]->nro_fonemas; $k++)
						{
							$freq = 2 * sin($l) + 100;
							$this->palavras[$i]->silabas[$j]->fonemas[$k]->frequencia = $freq;
							// echo $freq.' ';
							$l+= 0.25;
						}

				}
				break;
			}
		}
	}
}

?>