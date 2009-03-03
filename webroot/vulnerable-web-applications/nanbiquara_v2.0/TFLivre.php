<?php
/*
NANBIQUARA - Um Sistema Texto-Fala Inteligente
Copyright (C) 2005, Felipe Castro da Silva, Rodrigo Mendes Costa e Thales
Sehn Korting

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301,
USA.
*/
include("tfTexto.inc");
include("tfFrase.inc");
include("tfPalavra.inc");
include("tfSilaba.inc");
include("tfFonema.inc");
include("tfConstantes.inc");
include("tfFuncoes.inc");
?>
<script>
	function pop(caminho, widthPOP, heightPOP, nome)
	{
		if(nome==undefined)
			nome='pop';
		window.open(caminho, nome, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes,resizable=no,copyhistory=no, width='+widthPOP+ ', height=' + heightPOP);
	}
</script>

<form method="post">
	<table border='0' align='center' width='500'><tr><td>
	<table border='0' width='100%'>
		<tr>
			<td width='70%'>
				<img src="imgs/nanbiquara.gif" border="0"></img>
			</td>
			<td width='30%' valign='center' align='center'>
				<a href="http://sourceforge.net/donate/index.php?group_id=140221"><img src="http://images.sourceforge.net/images/project-support.jpg" width="88" height="32" border="0" alt="Support This Project"></a><br><br>
			</td>
		</tr>
		<tr height='10'>
			<td colspan='2'>
				<hr>
			</td>
		</tr>
		<tr>
			<td colspan='2'>
				<b>Texto</b><br>
				&nbsp;&nbsp;&nbsp;<textarea name="texto_original" cols=50 rows=5><?=$_POST[texto_original]?></textarea><br><br>
			</td>
		</tr>
		<tr>
			<td width='70%'>
				<b>Tipos de Voz:</b><br>
				&nbsp;&nbsp;&nbsp;<input type="radio" name="voz" value="br1/br1" checked> Voz 1
				<input type="radio" name="voz" value="br2/br2"> Voz 2
				<!--<input type="radio" name="voz" value="br3/br3"> Voz 3-->
			</td>
			<td width='30%' valign='center' align='center'>
				<input type="submit" value=" Falar ">
			</td>
		</tr>
</form>
<?

if (empty($_POST[texto_original]))
{
	print "</table></td></tr></table>";
	die();
	exit();
}

print "<tr><td colspan='2'><hr>";
$npid = date("is");
echo "A ser lido: $_POST[texto_original] &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"javascript:pop('$dirsaida/saida$npid.wav', 400, 200)\"><img src='imgs/som.gif' border='0'></img></a><hr>";
echo "<a href=\"javascript:pop('dewplayer.swf?son=$dirsaida/saida$npid.mp3', 250, 15)\"><img src='imgs/som.gif' border='0'></img></a><br><br>";
 
$texto = new tfTexto(strtolower($_POST[texto_original]));

$texto->avalia_frases(FREQUENCIA_BASE, TEMPO_BASE);

$saida = '';

$arquivo = fopen("$dirsaida/saida.txt", 'w+');

for ($k = 0; $k < 1; $k++)
	$saida .= "_ 300\n";

$texto->mostra_frases();

for ($k = 0; $k < 2; $k++)
	$saida .= "_ 300\n";

fwrite($arquivo, $saida);
//echo "<hr>".str_replace("\n", "<br>", $saida);

fclose($arquivo);

//exec("rm -rf saida*.wav");
$nome_som = $dirsaida.'/saida'.$npid;  
exec("./mbrola-linux-i386 -e ".$_POST[voz]." $dirsaida/saida.txt ".$nome_som.".wav"); //$dirsaida/saida".$npid.".wav");
exec("chmod 777 $dirsaida/*.wav");
exec("wav2mp3 ".$nome_som.".wav");
print "</td></tr></table></td></tr></table>";
?>
