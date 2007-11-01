<? 

function generateRnd($length = 8){

  // start with a blank password
  $password = "";

  // define possible characters
  $possible = "0123456789bcdfghjkmnpqrstvwxyz";

  // set up a counter
  $i = 0;

  // add random characters to $password until $length is reached
  while ($i < $length){

      // pick a random character from the possible ones
      $char = substr ($possible, mt_rand (0, strlen ($possible) - 1), 1);

      // we don't want this character if it's already in the password
      if (!strstr ($password, $char))
	{
	  $password .= $char;
	  $i++;
	}

    }

  // done!
  return $password;

}

function errorHandler ($severity, $msg, $filename, $linenum)
{

  echo "error found :";

  if ($_GET['debug'])
    {
      echo $msg."<br/>";
    }

}

set_error_handler ("errorHandler");

$link = mysql_connect ("localhost", "root", "chauchas!");

mysql_select_db ("w3af_test", $link);

if ($_GET['debug'])
  {
    echo "SELECT * FROM agenda where email ='".$_GET['email']."'";
    echo "<br>";
  }

$result = mysql_query ("SELECT * FROM agenda where email ='".$_GET['email']."'", $link);

echo generateRnd() . "<br>";

echo "Nombre: ".mysql_result ($result, 0, "nombre")."<br>";
echo "Dirección: ".mysql_result ($result, 0, "direccion")."<br>";
echo "Teléfono :".mysql_result ($result, 0, "telefono")."<br>";
echo "E-Mail :".mysql_result ($result, 0, "email")."<br>";

echo generateRnd() . "<br>";

?>
