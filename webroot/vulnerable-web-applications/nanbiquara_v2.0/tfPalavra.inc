<?php

class tfPalavra
{
//------------------------------------------------------------------------------
	var
		$palavra,
		$nro_silabas,
		$silabas;
//------------------------------------------------------------------------------
	function tfPalavra($p)
	{
		$p = trim($p);
		$this->palavra = $p;
		$this->silabas = array();
		
		// separa a palavra em sílabas
		list($silabas,$tonica) = $this->separa_silabas($p);
		while (list($i, $s) = each($silabas))
		{
			if ($i == $tonica)
				array_push($this->silabas, new tfSilaba($s, TONICA));
			else
				array_push($this->silabas, new tfSilaba($s, ATONA));
		}
		$this->nro_silabas = count($this->silabas);
	}
//------------------------------------------------------------------------------
	function mostra_silabas()
	{
		//echo "Palavra: $this->palavra<br>";
		global $saida;
		for($i = 0; $i < $this->nro_silabas; $i++)
		{
			$this->silabas[$i]->mostra_fonemas();
		}
		//echo "<br>";
	}
//------------------------------------------------------------------------------
	function avalia_silabas($freq, $temp)
	{
		for($i = 0; $i < $this->nro_silabas; $i++)
		{
			$this->silabas[$i]->avalia_fonemas($freq, $temp);
		}
	}
//------------------------------------------------------------------------------
	function separa_silabas($palavra)
	{
		$silabas = array();
		$tamanho_palavra = strlen($palavra);
		
		$silaba = "";
		$letra = '';
		$anterior = '';
		$posterior = '';
		
		for ($i = 0; $i < $tamanho_palavra; $i++)
		{
			$letra = $palavra[$i];
			$posterior = (($i+1) >= $tamanho_palavra)?'':$palavra[$i+1];
			
			if ($silaba == "")
			{
				$silaba = $silaba.$letra;
			}
			elseif ($letra == $anterior)
			{
				array_push($silabas, $silaba);
				$silaba = $letra;
			}
			elseif (eh_consoante($letra))
			{
				if (eh_consoante($anterior))
				{
					if (eh_consoante($posterior) && !in_array(strtoupper($posterior), array('L','R','H')))
					{
						$silaba = $silaba.$letra;
					}
					elseif (strtoupper($anterior) == 'D' && strtoupper($letra) != 'R')
					{
						array_push($silabas, $silaba);
						$silaba = $letra;
					}
					elseif (strtoupper($anterior) == 'N' && strtoupper($letra) == 'R')
					{
						array_push($silabas, $silaba);
						$silaba = $letra;
					}
					elseif (in_array(strtoupper($letra), array('L','R','H')))
					{
						$silaba = $silaba.$letra;
					}
					elseif ($i == 1)
					{
						$silaba = $silaba.$letra;
					}
					else
					{
						array_push($silabas, $silaba);
						$silaba = $letra;
					}
				}
				elseif (eh_vogal($anterior))
				{
					if (eh_consoante($posterior) && (!in_array(strtoupper($posterior), array('L','R','H')) || (strtoupper($letra) == strtoupper($posterior)) || (strtoupper($letra) == 'N')))
					{
						if (in_array(strtoupper($letra), array('N')) && in_array(strtoupper($posterior), array('H')))
						{
							array_push($silabas, $silaba);
							$silaba = $letra;
						}
						else
						{
							$silaba = $silaba.$letra;
						}
					}
					elseif (eh_consoante($posterior) && strtoupper($letra) == 'D' && strtoupper($posterior) != 'R')
					{
						$silaba = $silaba.$letra;
					}
					elseif (eh_vogal($posterior))
					{
						array_push($silabas, $silaba);
						$silaba = $letra;
					}
					else
					{
						array_push($silabas, $silaba);
						$silaba = $letra;
					}
				}
			}
			elseif (eh_vogal($letra))
			{
				if (eh_consoante($anterior))
				{
					$silaba = $silaba.$letra;
				}
				elseif (eh_vogal($anterior))
				{
					if ((vogal($anterior) == 'U') && ($i > 1) && (in_array(strtoupper($palavra[$i-2]), array('Q','G'))))
					{
						$silaba = $silaba.$letra;
					}
					elseif ((vogal($anterior) == 'U') && (vogal($letra) == 'I') && (eh_consoante($posterior)))
					{
						$silaba = $silaba.$letra;
					}
					elseif (tem_acento($letra) || (in_array(strtoupper($posterior), array('M','N')) && !eh_vogal($palavra[$i+2])))
					{
						array_push($silabas, $silaba);
						$silaba = $letra;
					}
					elseif (eh_maior($letra, $posterior))
					{
						array_push($silabas, $silaba);
						$silaba = $letra;
					}
					elseif (eh_maior($anterior,$letra))
					{
						$silaba = $silaba.$letra;
					}
					else
					{
						array_push($silabas, $silaba);
						$silaba = $letra;
					}
				}
			}
			$anterior = $letra;
		}
		array_push($silabas, $silaba);
	
		$nro_silabas = count($silabas);
	
		$tonica = 0;
		if ($nro_silabas != 1)
		{
			$proparoxitona = $nro_silabas-3;
			$paroxitona = $nro_silabas-2;
			$oxitona = $nro_silabas-1; 
		
			$tonica = $paroxitona;
			if (tem_acento($silabas[$oxitona]))
				$tonica = $oxitona;
			elseif (tem_acento($silabas[$paroxitona]))
				$tonica = $paroxitona;
			elseif (tem_acento($silabas[$proparoxitona]))
				$tonica = $proparoxitona;
			elseif (eh_oxitona($silabas[$oxitona]))
				$tonica = $oxitona;
		}
		return array($silabas, $tonica);
	}
//------------------------------------------------------------------------------
}

?>
