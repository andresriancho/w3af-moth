<?

include('random.php');
include('header.php');
include('lorem.php');

for ($i=1; $i<=5; $i++)
{
    lorem();
}


for ($i=1; $i<=50; $i++)
{
    echo rand_string(10); echo "<br>\n";
}
include('footer.php');
?>
