<?
    include('header.php');

    $query  = explode('&', $_SERVER['QUERY_STRING']);
    $params = array();

    foreach( $query as $param )
    {
      list($name, $value) = explode('=', $param);
      $params[urldecode($name)][] = urldecode($value);
    }

    $id = intval($_GET['poll']);
    if ( $id != 1234 ){
        echo 'Invalid poll ID!';
    }else{
    
        if ( strcmp( strtolower($params['vote'][0]), 'green') == 0 ){
            $votefor = 'Green';
        }else{
            $votefor = 'White';
        }

        $ipaddress = $_SERVER['REMOTE_ADDR'];

        // Process the vote, store in MySQL, etc.
        // CREATE TABLE votes (id INT NOT NULL AUTO_INCREMENT, votefor VARCHAR(20), ipaddress VARCHAR(20), PRIMARY KEY (id));

        $host = 'localhost';
        $dbname = 'hpp';
        $user = 'root';
        $pass = 'password';

        $db = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);

        $preparedStatement = $db->prepare('INSERT INTO votes (votefor, ipaddress) VALUES (:votefor, :ipaddress)');
        $preparedStatement->execute( array(':votefor' => $votefor, ':ipaddress' => $ipaddress) );

        echo "Thanks for your vote for Mr. $votefor! Please visit the vote log <a href='vote-log.php'>here</a>.";
    }

    include('footer.php');
?>

