<?
 session_start();
 $token = md5(uniqid(rand(), TRUE));
 $_SESSION['token'] = $token;
 $_SESSION['token_time'] = time();
?>

<form action="buy.php" method="post">
  <input type="hidden" name="token" value="<?php echo $token; ?>" />
  <p>
    Symbol: <input type="text" name="symbol" /><br />
    Shares: <input type="text" name="shares" /><br />
  </p>
   <input type="submit" value="Buy" />
</form>
