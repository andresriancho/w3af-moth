<?
include('../rnd_lib.php');
echo 'Random string to make things harder: ' . rand_string(10);
echo '<br>';
?>

<form action="buy.php" method="post">
  <p>
    Symbol: <input type="text" name="symbol" /><br />
    Shares: <input type="text" name="shares" /><br />
  </p>
   <input type="submit" value="Buy" />
</form>
