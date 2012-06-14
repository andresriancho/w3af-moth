<?

include('random.php');
include('header.php');
include('lorem.php');
for ($i=1; $i<=5; $i++)
{
    lorem();
    echo rand_string(10); echo "<br>\n";
}
include('footer.php');
?>
