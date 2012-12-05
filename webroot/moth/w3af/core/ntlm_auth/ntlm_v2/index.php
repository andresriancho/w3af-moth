<?
include('ntlm.php');
 
function get_ntlm_user_hash($user) {
  $userdb = array('admin'=>'admin',
                  'test'=>'test',
                  'administrator'=> '123456');
      
  if (!isset($userdb[strtolower($user)])) return false;
  
  return mhash(MHASH_MD4, ntlm_utf8_to_utf16le($userdb[strtolower($user)]));
}
                       
session_start();
$auth = ntlm_prompt("moth", "moth", "computer", "moth.local", "computer.local", "get_ntlm_user_hash");
                        
if ($auth['authenticated']) {
  print "You are authenticated as $auth[username] from $auth[domain]/$auth[workstation]";
}
?>