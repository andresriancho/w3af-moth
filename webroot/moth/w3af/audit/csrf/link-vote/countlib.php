<?

function vote( $id ){
  $BACKEND = 'backend.json';
  $id = intval($id);
  $votes = json_decode( file_get_contents($BACKEND), true );
  $votes[$id]++;
  file_put_contents($BACKEND, json_encode($votes));
  return 0;
}

function current_votes( $id ){
  $BACKEND = 'backend.json';
  $id = intval($id);
  $votes = json_decode( file_get_contents($BACKEND), true );
  return $votes[$id];
}

?>