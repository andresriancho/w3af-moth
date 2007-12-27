<?

  if ( strcmp($_GET['i'], "^(#$!@#$)(()))******") == 0)
  {
    # Sorry, I had no time to setup a ldap server
     echo "javax.naming.NameNotFoundException";
  }
  else
  {
    echo $_GET['i'];
  }
                
?>
