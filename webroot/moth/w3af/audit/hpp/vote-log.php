<?
    include('header.php');

    $host = 'localhost';
    $dbname = 'hpp';
    $user = 'root';
    $pass = 'password';

    $db = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);

    # using the shortcut ->query() method here since there are no variable  
    # values in the select statement.  
    $stm = $db->query('SELECT id, votefor, ipaddress from votes ORDER BY id DESC LIMIT 100');
      
    # setting the fetch mode  
    $stm->setFetchMode(PDO::FETCH_ASSOC);  

?>
    <p>Last votes first</p>

    <table id='hor-minimalist-a'>
    <thead>
    	<tr>
        	<th scope="col">Vote ID</th>
            <th scope="col">Voted For</th>
            <th scope="col">IP Address</th>
        </tr>
    </thead>
    <tbody>

<?

    while($row = $stm->fetch()) {  
        echo '    ';
        echo '<tr>';
        echo '<td>' . $row['id'] . "</td>";
        echo '<td>' . $row['votefor'] . "</td>";
        echo '<td>' . $row['ipaddress'] . "</td>";
        echo "</tr>\n";
    }
    echo "</tbody></table>\n";

    include('footer.php');

?>
