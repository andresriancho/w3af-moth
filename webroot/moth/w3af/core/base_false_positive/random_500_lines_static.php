<?

include('random.php');
include('lorem.php');
include('header.php');

for ($i=1; $i<=500; $i++)
{
    lorem();
    echo rand_string(10); echo "<br>\n";
}
include('footer.php');

?>
