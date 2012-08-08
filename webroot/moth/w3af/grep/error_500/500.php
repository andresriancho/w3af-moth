<?

if ( strcmp($_GET['id'],'1')==0){
  echo 'Ok! HTTP response code is 200.';
}else{
  header("HTTP/1.0 500 Fuck off!");
  echo 'Error! HTTP response code is 500.';
}

?>