<?
    include('header.php');
    include('self_url.php');

    $url = self_URL();
    $url = str_replace('election.php', 'vote.php', $url);

    $id = intval($_GET['poll']);

    if ( $id != 1234 ){
        echo 'Invalid poll ID!';
    }else{
?>

<a href="<?= htmlspecialchars($url) . '&vote=Green' ?>">Vote for Mr. Green</a><br>
<a href="<?= htmlspecialchars($url) . '&vote=White' ?>">Vote for Mr. White</a><br>

<?
    }
    include('footer.php');
?>
