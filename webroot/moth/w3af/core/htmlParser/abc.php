<pre>
<?php
$sex = $_GET['sex'];
$age = $_GET['age'];
$firstname = $_GET['firstname'];
$lastname = $_GET['lastname'];
$email = $_GET['email'];

$hitted_xss = 0;

# Now we apply the form logic:
function isValidEmail($email){
	return eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $email);
}

// Validate that all parameters are valid
if ( strcmp('',$firstname) == 0 || strcmp('', $lastname) == 0 || !isValidEmail($email) ){
	echo 'Please fill the form properly.';
}
else
{
	if ($sex == 'female' && $age == '21-25') {
		echo $firstname . ' you have been randomly selected for manual inspection.';
		$hitted_xss = 1;
	}
	else
	{
		echo 'Please go on.';
	}
}

# First we record what we got from the scanner:
$my_file = "test-output.txt";
$fh = fopen($my_file, 'a') or die("can't open file");

if ( $hitted_xss == 1 ){
	$string_data .= '[XSS+] ' . $_SERVER["REQUEST_URI"] . "\n";
}
else
{
	$string_data .= '[None] ' . $_SERVER["REQUEST_URI"] . "\n";

}
fwrite($fh, $string_data);
fclose($fh);

?>
</pre>
