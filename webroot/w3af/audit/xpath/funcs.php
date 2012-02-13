<?
function printQueryResult($querystr){
    // Build XPATH object
    $xpath = new DOMXPath(DOMDocument::load('xpath.xml'));
    $arts = $xpath->query($querystr);
    if (empty($arts->length)){
        echo "Empty Path Expression: '" . $querystr . "'";
    }else{
        foreach ($arts as $art)
	    echo $art->nodeValue;
    }
}

function generateRandStr($length){
    $randstr = "";
    for($i=0; $i<$length; $i++){
        $randnum = mt_rand(0,61);
        if($randnum < 10){
            $randstr .= chr($randnum+48);
        }
        else if($randnum < 36){
            $randstr .= chr($randnum+55);
        }
        else{
            $randstr .= chr($randnum+61);
        }
    }
    return $randstr;
} 


?>
