<?

if ( strcmp($_GET['id'],'1')==0){
  echo 'ok!';
}else{
  header("HTTP/1.0 500 Fuck off!");
  echo 'error!';
}

?>