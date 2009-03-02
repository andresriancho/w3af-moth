<div align="center"><h2>Latest mod_security attacks</h2></div>

<?
  
  exec('tail -n 10 /etc/modsecurity/logs/modsec_debug.log', $output);

  $output = array_reverse( $output );

  $log = '';
  foreach ($output as &$line) {
      $log .= htmlentities($line) . '<br /><br />';
  }
  
  echo $log;

?>
