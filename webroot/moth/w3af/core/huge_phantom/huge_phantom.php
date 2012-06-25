<?

# This script creates A LOT of links that point to random urls
# that are really this same script.

# This script NEEDS a special mod_rewrite configuration!

function random_letters ($numofletters) {
    $res = '';
    $literki = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'W');
    $ilosc_literek = count($literki);
    for ($licz = 0; $licz < $numofletters; $licz++) {
	    $rand = rand(0, $ilosc_literek-1);
	    $vercode = $vercode.$literki[$rand];
	    $res .= $vercode;
    }
    return $res;
}

echo 'First, some links:';
echo '<a href="' . random_letters( 6 ) . '">' . random_letters( 6 ) . '</a><br/>';
echo '<a href="' . random_letters( 6 ) . '">' . random_letters( 6 ) . '</a><br/>';
echo '<a href="' . random_letters( 6 ) . '">' . random_letters( 6 ) . '</a><br/>';
echo '<br/><br/><br/>';

echo 'And now some random stuff to use up some memory:<br/>';

for ($i = 0; $i < 400; $i++) {
    echo random_letters( 20 ) . '<br/>';
}

?>
