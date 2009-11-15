<?php
    
    //database information
    $sDBServer = "localhost";
    $sDBName = "w3af_test";
    $sDBUsername = "root";
    $sDBPassword = "moth";

    $json = file_get_contents('php://input');
    $cols = json_decode($json);
    $joined_list_of_cols = join(",", $cols);

    //create the SQL query string
    $sQuery = "Select " . $joined_list_of_cols . " from customers";
             
    //make the database connection
    $oLink = mysql_connect($sDBServer,$sDBUsername,$sDBPassword);
    @mysql_select_db($sDBName) or $sInfo = "Unable to open database";

    $oResult = mysql_query($sQuery);
        
    if($sInfo == '') {
          
      $arr = array();
      while($obj = mysql_fetch_object($oResult))
      {
        $arr[] = $obj;
      }
      print json_encode($arr);
            
    }
    
    mysql_close($oLink);

?>
