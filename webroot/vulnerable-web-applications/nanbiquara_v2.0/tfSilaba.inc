<?php

class tfSilaba
{
//------------------------------------------------------------------------------
	var
		$silaba,
		$tonicidade,
		$nro_fonemas,
		$fonemas;
//------------------------------------------------------------------------------
	function tfSilaba ($s, $t)
	{
		$this->silaba = $s;
		$this->tonicidade = $t;
		$this->fonemas = array();

		$fonemas = $this->separa_fonemas($s);
		while (list($i, $f) = each($fonemas))
		{
			array_push($this->fonemas, new tfFonema($f));
		}
		$this->nro_fonemas = count($this->fonemas);
	}
//------------------------------------------------------------------------------
	function mostra_fonemas()
	{
		if ($this->tonicidade == TONICA)
			echo "<u>$this->silaba</u> ";
		else
			echo "$this->silaba ";
		
		for($i = 0; $i < $this->nro_fonemas; $i++)
		{
			$this->fonemas[$i]->mostra_fonema();
		}
	}
//------------------------------------------------------------------------------
	function avalia_fonemas($freq, $temp)
	{
		if ($this->tonicidade == TONICA)
		{
			for($i = 0; $i < $this->nro_fonemas; $i++)
				$this->fonemas[$i]->avalia_fonema($freq, $temp + 15);
		}
		else
		{
			for($i = 0; $i < $this->nro_fonemas; $i++)
				$this->fonemas[$i]->avalia_fonema($freq, $temp);
		}
	}
//------------------------------------------------------------------------------
	function separa_fonemas($silaba)
	{
		global
			$vogais_em_fonemas,
			$vogais_em_basicas,
			$consoantes,
			$consoantes_regulares,
			$consoantes_irregulares;

		$fonemas = array();
		$silaba = " $silaba  ";

		// for de letra em letra, por silaba
		for($i = 0; $i < strlen($silaba); $i++)
		{
			$letra = $silaba[$i];
			$som = '_';
			$proximo = '';
			$registra_fonema = true;
			$eh_vogal = false;
	
			if(eh_vogal($letra))
			{
				$eh_vogal = true;
				$som = converte($letra, $vogais_em_fonemas);
				if(in_array($silaba[$i+1], array('m','n')) && converte($silaba[$i+2], $vogais_em_basicas) == '_' && $silaba[$i+2] != 'h')
				{
					$i++;
					if(tem_acento($letra))
						$som = converte($letra, $vogais_em_basicas);
					$som .= 'm';
				}
/*
				elseif($silaba[$i+1] == 'n' && $silaba[$i+2] == 'h')
				{
					$i++;
					$som.='m';
					$proximo = 'im';
				}
*/
				elseif(eh_nasal($letra) && ($proxima_letra = converte($silaba[$i+1], $vogais_em_fonemas)) != '_')
				{
					$i++;
					$proximo = $proxima_letra.'m';
				}
			}
			elseif(in_array($letra, $consoantes_regulares))
				$som = $letra;
			elseif($letra == ' ' || $letra == '-')
				$registra_fonema = false;
			else
			{
				switch($letra)
				{
					case 'c':
						$som = 'k';
						if(in_array(converte($silaba[$i+1], $vogais_em_basicas), array('a', 'o', 'u')))
							$som = 'k';
						elseif(in_array(converte($silaba[$i+1], $vogais_em_basicas), array('e', 'i')))
							$som = 's';
						elseif($silaba[$i+1] == 'h')
						{
							$som = 'x';
							$i++;
						}
						elseif(in_array($silaba[$i+1], $consoantes))
							$som = 'k';
						break;
					case 'g':
						$som = 'g';
						if(in_array(converte($silaba[$i+1], $vogais_em_basicas), array('a', 'o')))
							$som = 'g';
						elseif(in_array(converte($silaba[$i+1], $vogais_em_basicas), array('e', 'i')))
							$som = 'j';
						elseif($silaba[$i+1] == 'u')
						{
							if(in_array(converte($silaba[$i+2], $vogais_em_basicas), array('e', 'i')))
							{
								$som = 'g';
								$i++;
							}
						}
						break;
					case 'ç':
						$som = 's';
						break;
					case 'h':
						$registra_fonema = false;
						break;
					case 'l':
						$som = 'l';
						if($silaba[$i+1] == 'h')
						{
							$silaba[$i+1] = 'i';
						}
						if(in_array($silaba[$i+1], $consoantes) || !eh_letra($silaba[$i+1]))
							$som = 'u';
						break;
					case 'n':
						$som = 'n';
						if($silaba[$i+1] == 'h')
						{
							$i++;
							$som = 'im';
							//$proximo = 'im';
						}
						break;
					case 'q':
						$som = 'k';
						if($silaba[$i+1] == 'u' && in_array(converte($silaba[$i+2], $vogais_em_basicas), array('e', 'i')))
							$i++;
						break;
					case 'r':
						$som = 'r2';
						if($silaba[$i+1] == 'r')
						{
							$som = 'rr';
							$i++;
						}
						//elseif($i == 1)
						//	$som = 'rr';
						elseif($silaba[$i-1] == ' ' && $i != 1)
							$som = 'rr';
						elseif(($silaba[$i+1] == ' ') || (in_array($silaba[$i+1], $consoantes)))
						{
							$som = 'r2';
						}
						elseif(converte($silaba[$i+1], $vogais_em_basicas) != '_')
							$som = 'r';
						break;
					case 's':
						$som = 's2';
						if($silaba[$i+1] == 's')
						{
							$som = 's';
							$i++;
						}
						elseif($silaba[$i+1] == 'c' && (eh_vogal($silaba[$i+2])))
						{
							if(in_array(converte($silaba[$i+2], $vogais_em_basicas), array('a', 'o', 'u')))
								$som = 's2';
							else
							{
								$som = 's';
								$i++;
							}
						}
						elseif($silaba[$i-1] == ' ')
							$som = 's';
						elseif(($silaba[$i+1] == ' ') || (in_array($silaba[$i+1], $consoantes)))
							$som = 's2';
						elseif(converte($silaba[$i+1], $vogais_em_basicas) != '_')
							$som = 'z';
						break;
					case 'x':
						$som = 'x';
						if($silaba[$i+1] == 'c')
						{
							$som = 's';
							$i++;
						}
						break;
					case 'z':
						$som = 'z';
						if(($silaba[$i+1] == ' ') || (in_array($silaba[$i+1], $consoantes)))
							$som = 's2';
						break;
				}
			}
			if($registra_fonema)
			{
				array_push($fonemas, $som);
			}
			if($proximo != '')
			{
				array_push($fonemas, $proximo);
			}
		}
		return $fonemas;
	}
//------------------------------------------------------------------------------
}

?>