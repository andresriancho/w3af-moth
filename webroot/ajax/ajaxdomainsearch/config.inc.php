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
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
---------------------------------------------------------*/

//Add your whois server here Or do notihing
$whois_servers = Array(
'com' => array('whois.internic.net','No match for'),
'net' => array('whois.internic.net','No match for'),
'org' => array('whois.pir.org','NOT FOUND'),
'info' => array('whois.afilias.net','NOT FOUND'),
'biz' => array('whois.nic.biz','Not found'),
'us' => array('whois.nic.us','Not found')
);

$whois_error = Array('Can\'t get information');

//status message
$statusmsg[0] = "is available!";
$statusmsg[1] = "Domain name length < 3 letter.";
$statusmsg[2] = "Domain name can not start or end with -.";
$statusmsg[3] = "Please use letters , numbers and - only.";
$statusmsg[4] = "Can\'t lookup. Please try later";
$statusmsg[5] = "This server exceeded whois server quota. Please try again later.";
$statusmsg[6] = "is taken";
?>
