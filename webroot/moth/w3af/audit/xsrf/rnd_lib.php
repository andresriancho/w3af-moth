<?
function rand_string(
        $length, 
        $skip_charset = '', 
        $base_charset='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789'){
  $skip_len = strlen($skip_charset);
  for ($i = 0; $i<$skip_len; $i++){
    $base_charset = str_replace($skip_charset[$i], '', $base_charset);
  }
  $str = '';
  $count = strlen($base_charset);
  while ($length--) {
    $str .= $base_charset[mt_rand(0, $count - 1)];
  }
  return $str;
}
?>

