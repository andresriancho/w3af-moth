<?php

define('FREQUENCIA_BASE', 90);
define('TEMPO_BASE', 105);

define('AFIRMATIVA', 1);
define('EXCLAMATIVA', 2);
define('INTERROGATIVA', 3);

define('TONICA', 1);
define('ATONA', 2);

$pontos = array('.', '!', '?');
$separadores = array(',', '-');

$vogais = array('a', 'á', 'à', 'ã', 'â', 'e', 'ê', 'é', 'i', 'í', 'o', 'õ', 'ó', 'ô', 'u', 'ú', 'ü');

$vogais_em_fonemas =
	array(
		'a' => array('a', 'á', 'à', 'â'),
		'@' => 'ã',
		'e' => array('e', 'ê'),
		'ee' => 'é',
		'i' => array('i', 'í'),
		'o' => array('o', 'õ', 'ô'),
		'oo' => 'ó',
		'u' => array('u', 'ú', 'ü')
	);

$vogais_em_basicas =
	array(
		'a' => array('a', 'á', 'à', 'ã', 'â',),
		'e' => array('e', 'ê', 'é'),
		'i' => array('i', 'í'),
		'o' => array('o', 'õ', 'ó', 'ô'),
		'u' => array('u', 'ú', 'ü')
	);

$consoantes = array('b', 'c', 'd', 'f', 'g', 'h', 'j', 'k', 'l', 'm', 'n', 'p', 'q', 'r', 's', 't', 'v', 'w', 'x', 'y', 'z');

$consoantes_regulares = array('b', 'd', 'f', 'j', 'k', 'm', 'p', 't', 'v', 'w', 'y');
$consoantes_irregulares = array('c', 'g', 'h', 'l', 'n', 'q', 'r', 's', 'x', 'z');

$alfabeto =
	array(
		'a' => 'a 120',
		'b' => 'b 120 <br> e 120',
		'c' => 's 120 <br> e 120',
		'd' => 'd 120 <br> e 120',
		'e' => 'e 120',
		'f' => 'ee 120 <br> f 120 <br> e 120',
		'g' => 'j 120 <br> e 120',
		'h' => 'a 120 <br> g 120 <br> a 120',
		'i' => 'i 120',
		'j' => 'j 120 <br> oo 120 <br> t 120 <br> a 120',
		'k' => 'k 120 <br> a 120',
		'l' => 'ee 120 <br> l 120 <br> e 120',
		'm' => 'e 120 <br> m 120 <br> e 120',
		'n' => 'e 120 <br> n 120 <br> e 120',
		'o' => 'oo 120',
		'p' => 'p 120 <br> e 120',
		'q' => 'k 120 <br> e 120',
		'r' => 'ee 120 <br> rr 120 <br> e 120',
		's' => 'ee 120 <br> s 120 <br> e 120',
		't' => 't 120 <br> e 120',
		'u' => 'u 120',
		'v' => 'v 120 <br> e 120',
		'w' => 'd 120 <br> a 120 <br> b 70 <br> l 120 <br> i 50 <br> o 120',
		'x' => 'x 120 <br> i 120 <br> s2 120',
		'y' => 'i 120 <br> p 80 <br> i 10 <br> s 120 <br> i 50 <br> l 120 <br> om 120',
		'z' => 'z 120 <br> e 120'
	);

$dirsaida = 'saida';

/*$arq = file("abreviaturas.csv");
$abreviaturas = array();

//$arq = split("\n", $arq);
while (list($i, $l) = each($arq))
{
	$aux = split(";", $l);
	$abreviaturas[trim($aux[0])] = trim($aux[1]);
}
//print_r(array_values($abreviaturas));
*/
?>
