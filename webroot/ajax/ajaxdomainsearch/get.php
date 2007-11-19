<?
/*---------------------------------------------------------
AjaxDomainSearch v1.1
Copyright (C) 2006-2007 Nattawat Palakawong

Website: http://www.ajaxdomainsearch.com
Contact: contact@ajaxdomainsearch.com
First Created: 2006-11-28.
Last Updated: 2007-11-04.

What's New:
Version 1.1 add .info .biz .us / rewrite code
Version 1.0 first version only .com .net .org


This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
---------------------------------------------------------*/

include("config.inc.php");

function check_valid_address($domainname) {

//Check domain length > 2 || < 63 characters
    if (strlen($domainname) < 3){
        return 1;
//Check domain can not start with -
    } elseif (ereg("^-|-$", $domainname)){
       return 2;
//Letters , numbers and - _ only
    } elseif (!ereg("([a-z]|[A-Z]|[0-9]|-){".strlen($domainname)."}", $domainname)){
        return 3;
    }
  return 0;
}

function whois ($tld, $getdomainname)
{
global $whois_servers,$whois_available,$whois_error,$statusmsg;

//Strip html
$getdomainname = strip_tags($getdomainname);

//Strip www. and http://
$getdomainname = str_replace("www.", "", $getdomainname);
$getdomainname = str_replace("http://", "", $getdomainname);

//Replace Space
$getdomainname = str_replace(" ", "", $getdomainname);

//Split .com .net .org or .* (Split text after .)
$getdomainname = explode(".", $getdomainname);

//Join domain with tld (.com,.net,.org, .*)
$domainname = $getdomainname[0] . "." . $tld;

//Select Whois Server in config.inc.php
$select_server = $whois_servers[$tld][0];

//Connect to selected whois server
$sock = @fsockopen($select_server,43);

//Initial value for display status message in config.inc.php
$domainstatus = 0;

	if(!$sock) {
	//Can't connect to Server
	$domainstatus = 4;
	}else{
	$send_request = @fputs($sock,"$domainname\r\n");
		if(!$send_request) {
		//Unable to send request
		$domainstatus = 4;
		}else{
		while(!feof($sock)) {
		$result .= fgets($sock,128);
		}

$result = str_replace("\n", "<br>", $result);


//Check error or Available
for($i=0;$i<count($whois_error);$i++){

if(@eregi($whois_error[$i],$result)) {
//error?
$domainstatus = 4;
}

}

//Check excedded quota from whois server (.org limited 4 query per minute/server ip) :(
if(@eregi("EXCEEDED",$result)) {
//Exceeded server quota?
$domainstatus = 5;
}

//No error
if($domainstatus == 0){
		//Check Available

				if(@eregi($whois_servers[$tld][1],$result)) {
				//Available
				$domainstatus = 0;
				}else{
				$domainstatus = 6; //taken
				}


}



		}
@fclose($sock);

		}
return $domainstatus;

}

//-------------------------Start main program-------------------------

if ($_GET['domainname'] != '') {
$domainname = $_GET['domainname'];

//check valid or not
$isvalid = check_valid_address($domainname);

//Check tld
if($isvalid ==0){
 $domainstatus[0] = whois('com',$domainname );
 $domainstatus[1] = whois('net',$domainname );
 $domainstatus[2]= whois('org',$domainname );
 $domainstatus[3] = whois('info',$domainname );
 $domainstatus[4] = whois('biz',$domainname );
 $domainstatus[5] = whois('us',$domainname );


$tld[0] = ".com";
$tld[1] = ".net";
$tld[2] = ".org";
$tld[3] = ".info";
$tld[4] = ".biz";
$tld[5] = ".us";


//-----------------------Prepare Results ----------------------------

for($i=0;$i<count($tld);$i++){
if($domainstatus[$i] > 0){


//Domain Taken or Error

$status[$i] = "<table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">
        <tr>
          <td bgcolor=\"#Fe0000\" class=\"normaltext\"><div align=\"center\"><strong><font color=\"#FFFFFF\">";
		$status[$i] .= $tld[$i]." ";
		$status[$i] .= $statusmsg[$domainstatus[$i]];
		$status[$i] .= "</font> </strong></div></td></tr><tr> 
          <td class=\"result\"><center><a href=\"http://www.$domainname$tld[$i]\">Website</a></center></td>
        </tr>
      </table>";

}else{

//Domain Available
$status[$i] = "<table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">
                <tr> 
                  <td bgcolor=\"#A3C401\" class=\"normaltext\">
<div align=\"center\"><strong><font color=\"#FFFFFF\">$tld[$i] is available!</font></strong></div></td>
                </tr>
                <tr> 
                  <td class=\"result\"><center>Register using<br>
                    <a href=\"http://www.anrdoezrs.net/email-2221685-10401319\" target=\"_top\">iPower.com $6.50</a>
<img src=\"http://www.tqlkg.com/image-2221685-10401319\" width=\"1\" height=\"1\" border=\"0\"/><br>
                    <a href=\"http://www.anrdoezrs.net/email-2221685-10445282\" target=\"_top\">MyDomain.com $8.75</a>
<img src=\"http://www.awltovhc.com/image-2221685-10445282\" width=\"1\" height=\"1\" border=\"0\"/><br>
					<a href=\"http://www.dpbolvw.net/email-2221685-10384568\" target=\"_top\">GoDaddy.com $1.99 (w/ any product.)</a>
<img src=\"http://www.tqlkg.com/image-2221685-10384568\" width=\"1\" height=\"1\" border=\"0\"/><br>
                    <a href=\"http://www.dpbolvw.net/email-2221685-10374954\" target=\"_top\"> 1&1 .Com Domains - Free for One year!</a>
<img src=\"http://www.tqlkg.com/image-2221685-10374954\" width=\"1\" height=\"1\" border=\"0\"/></center></td>
                </tr>
              </table>";

}
}

//---------------------------------Print Results-------------------------------------------
echo "<?xml version='1.0' encoding='UTF-8'?>";
echo "<table width=\"600\" border=\"0\" cellpadding=\"5\" cellspacing=\"0\">
  <tr valign=\"top\"> 
    <td colspan=\"3\" class=\"bookmarktext\"><center>Search Result for <b>$domainname</b></center></td>
  </tr>
	  <tr valign=\"top\"> 
    <td width=\"150\">$status[0]</td>
    <td width=\"150\">$status[1]</td>
    <td width=\"150\">$status[2]</td>
  </tr>
	  	<tr valign=\"top\"> 
    <td width=\"150\">$status[3]</td>
    <td width=\"150\">$status[4]</td>
    <td width=\"150\">$status[5]</td>
  </tr>

</table>";

}else{

//not valid domain

echo "<?xml version='1.0' encoding='UTF-8'?>";
echo "<table width=\"600\" border=\"0\" cellpadding=\"5\" cellspacing=\"0\">
  <tr valign=\"top\"> 
    <td colspan=\"3\" class=\"bookmarktext\"><center><b>$statusmsg[$isvalid]</b></center></td>
    </tr>
</table>";
}

}
die();
?>