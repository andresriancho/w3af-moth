<?

echo 'The content of the news article you uploaded is:';

$fh = fopen( $_FILES['uploadedfile']['tmp_name'], 'r');
$theData = fread($fh, filesize($_FILES['uploadedfile']['tmp_name']));
echo $theData;

            
?>


