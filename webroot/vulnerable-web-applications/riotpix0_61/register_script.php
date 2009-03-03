<?php
include("conf.php");
include("functions.php");
include("header.php");

//connect to the database
$connect = mysql_connect($host,$user,$pass);
mysql_select_db($db);

// retrieve and store variables from post form
$username = mysql_real_escape_string($_POST['username']);
$fname = mysql_real_escape_string($_POST['fname']);
$lname = mysql_real_escape_string($_POST['lname']);
$sex = mysql_real_escape_string($_POST['sex']);
$email = mysql_real_escape_string($_POST['email']);
$country = mysql_real_escape_string($_POST['country']);
$day = mysql_real_escape_string($_POST['day']);
$month = mysql_real_escape_string($_POST['month']);
$year = mysql_real_escape_string($_POST['year']);
$password = mysql_real_escape_string($_POST['password']);
$password2 = mysql_real_escape_string($_POST['password2']);

// removes white space from both ends of variables
$password = trim($password);
$username = trim($username);

// checks to see if password was entered
if (empty($password) || empty($password2)){
	echo "<p align=\"center\" class=\"bodymain\">Your missing a password</p>";
	exit();
}

// encrypt passwords
$password = md5($password);
$password2 = md5($password2);

echo "<p align=\"center\" class=\"bodymain\">User Signup</p>";

$sql = "SELECT * FROM users WHERE username = '$username'";
$result = @mysql_query($sql) or die("Database died! R.I.P.");
$num = mysql_num_rows($result);

$yeardate = date("Y");
$today = date("m-d-Y", time() + $zone);

if (empty($_FILES["userfile"]["name"])){
echo"<p align=\"center\" class=\"bodymain\">No File Uploaded!</p>";
exit();
}

$userfile = $_FILES["userfile"]["tmp_name"];  // temp file storage on server
$type = $_FILES["userfile"]["type"]; // MIME type
$size = $_FILES["userfile"]["size"]; // the size of the uploaded file in bytes
$filename = $_FILES["userfile"]["name"]; //gets name of uploaded file

// check file size to make sure it's right size
if ($size > $avatar_size){
 	echo "<p align=\"center\" class=\"bodymain\">File cannot be larger than ".substr_replace($avatar_size, '', -3)."kb</p>";
 	unlink($userfile);
	exit();
}

// filecheck (from functions.php) to make sure file is an accepted format
if (filecheck($filename)==FALSE) {
	echo "<p align=\"center\" class=\"bodymain\">File is not correct image format JPG, PNG, BMP and GIFS ONLY!</p>";
    unlink($userfile);
	exit();
}

// get dimensions of file, convert and resize
$array = getimagesize($userfile);

//if width or length is less or greater than 100 resize image
if($array[0] <> 100 || $array[1] <> 100){
	echo "<p align=\"center\" class=\"bodymain\">File is not correct SIZE 100x100 images only! Image Size: $array[0]x$array[1]<br />
		<a href=\"http://www.daydreamgraphics.com/icons/\" target=\"_blank\">100x100 avatars available here</a></p>";
    unlink($userfile);
	exit();
}


// make sure passwords are the same
if ($password != $password2) {
	echo "<p align=\"center\" class=\"bodymain\">Your passwords do not match</p>";
	exit();
}

// check to see if email is valid format
if (!ereg("^.+@.+\\..+$", $email)) {
		echo "<p align=\"center\" class=\"bodymain\">Not a valid email address!</p>";
		exit();
}

// make sure there are no spaces in the username (currently riotpix does not accept spaces)
if (ereg(" ", $username)) {
		echo "<p align=\"center\" class=\"bodymain\">No Spaces in the Username Please!</p>";
		exit();
}

// make sure all fields have been filled out
if(empty($fname) || empty($lname) || empty($sex) || empty($country) || empty($email) || empty($username) || empty($year) || empty($month) || empty($day)) {
	echo "<p align=\"center\" class=\"bodymain\">All fields are REQUIRED!</p>";
	exit();
} 

// if user is in database with same username give error
if($num > 0) {
	echo "<p align=\"center\" class=\"bodymain\">The username is already registered, please try another.</p>";
	exit();
}

// make sure date of birth is realistic e.g. 1-100 years old 
// okay, so most people aren't 1 when they sign up, but come on...
if (($year < ($yeardate-100)) || ($year > $yeardate)) { 
	echo "<p align=\"center\" class=\"bodymain\">The year of your birthday is too big or small</p>";
	exit();
}

if (!empty($fname) && !empty($lname) && !empty($sex) && !empty($country) && !empty($email) && !empty($username) && !empty($year) && !empty($month) && !empty($day) && $num == "0") {

	$fname = strip_tags($fname);
	$lname = strip_tags($lname);
	$country = strip_tags($country);
	$email = strip_tags($email);
	$username = strip_tags($username);
	$username = strtolower($username);
	$password = strip_tags($password);

$insert = "INSERT INTO users VALUES ('', '$fname', '$lname', '$year$month$day', '$sex', '$country', '$email', '$username', '$password', '$username', '$today', '0')";
$insert_res = @mysql_query($insert) or die("Could not write to database!");


// create folder with users name inside the user directory
$old_umask = umask(0);
@mkdir ("$path/users/$username", 0777);
@chmod("$path/users/$username", 0777);

// copy avatar into directory and convert to main.jpg
// this code requires ImageMagick to be installed
exec("convert $userfile $path/users/$username/main.jpg");
unlink($userfile);
umask($old_umask);

$emailsubject="Welcome to $site_name!";
$from_who = $admin_email;
$comments = "Thank You For Joining $site_name! 
 
 Your Username: $username
 
At $site_name you will instantly be connected to all its members
and have unlimited access to all its functions.";

@$mailbody.="\n$comments\n\n";

mail("$email", "$emailsubject", "$mailbody", "From: $from_who");


echo "<p align=\"center\" class=\"bodyfont\">You successfully added the username $username.<br>
	<br>
	You'll now have to <a href=\"$url_path\">login</a> to update your information.</p>";
}

mysql_close($connect);
?>
</body>
</html>