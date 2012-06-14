<?

include('random.php');
include('header.php');

for ($i=1; $i<=50; $i++)
{
    echo rand_string(10); echo "<br>\n";
}
include('footer.php');
?>
