<?
if ( strstr( $_GET['id'] , '%n%n%n%n' ) !== FALSE  || strstr( $_GET['id'] , '%25n%25n%25n%25n' ) !== FALSE ){
  echo "<title>500 Internal Server Error</title>\n";
} 

else
{
?>
Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.    
<?
}
?>
    