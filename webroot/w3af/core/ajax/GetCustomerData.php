<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
    <title>Get Customer Data</title>
<?php
    
    //customer ID
    $sID = $_GET["id"];
    
    //variable to hold customer info
    $sInfo = "";
    
    //database information
    $sDBServer = "localhost";
    $sDBName = "w3af_test";
    $sDBUsername = "root";
    $sDBPassword = "moth";

    //create the SQL query string
    $sQuery = "Select * from customers where CustomerId=".$sID;
//    echo $sQuery;
              
    //make the database connection
    $oLink = mysql_connect($sDBServer,$sDBUsername,$sDBPassword);
    @mysql_select_db($sDBName) or $sInfo = "Unable to open database";
        
    if($sInfo == '') {
        if($oResult = mysql_query($sQuery) and mysql_num_rows($oResult) > 0) {
            $aValues = mysql_fetch_array($oResult,MYSQL_ASSOC);
            $sInfo = $aValues['Name']."<br />".$aValues['Address']."<br />".
                     $aValues['City']."<br />".$aValues['State']."<br />".
                     $aValues['Zip']."<br /><br />Phone: ".$aValues['Phone']."<br />".
                     "<a href=\"mailto:".$aValues['E-mail']."\">".$aValues['E-mail']."</a>";
        } else {
            $sInfo = "Customer with ID $sID doesn't exist.";
        }
    }
    
    mysql_close($oLink);

?>
    
   

</head>
<body>
    <div id="divInfoToReturn"> <?php echo $sInfo ?> </div>
</body>
</html>
