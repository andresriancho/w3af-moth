Start --
<?

  if ( strlen($_GET['buf']) > 800 )
  {
     # Sorry, I had no time to setup a real buffer overflow
     echo "*** stack smashing detected ***:";
  }
  else
  {
    echo $_GET['buf'];
  }
                
?>
-- End
