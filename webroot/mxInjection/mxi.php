<?

  if ( strcmp($_GET['i'], "iDontExist") == 0)
  {
    # Sorry, I had no time to setup a mx for this test
     echo "Could not access the following folders";
  }
  else
  {
    echo $_GET['i'];
  }
                
?>
