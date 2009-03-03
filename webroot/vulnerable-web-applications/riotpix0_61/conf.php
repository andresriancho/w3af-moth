<?php
//starts session 
session_start();

//site name
$site_name = "Your Site Name";
// admin email address
$admin_email = "your@email.com";
// admin name (use lower case) THIS IS THE USERNAME YOU WILL BE USING ON THE BOARDS
$admin_name = "moth";
//URL path of forum WITHOUT trailing slash ex. http://www.riotpix.com/board
$url_path = "/vulnerable-web-applications/riotpix0_61";
//path of directory WITHOUT trailing slash ex. /home/www.riotpix.com/board
$path = "/var/www/riotpix0_61";

// MySQL server location ex. (mysql.example.com)
$host = "localhost";
// The user name to access the database
$user = "root";
// The password to access the database
$pass = "moth";
// Name of the database
$db = "riotpix";

// max avatar size in bytes. ex. (21500 is roughly 21kb)
$avatar_size = 21500;

// Number of messages per page
// Effects both number of messages on index.php as well as number of replies on read.php
$messages_per_page = 20;

// Number of characters after the subject needs to be cut off in the index
$max_length = 53;

// This strips slashes to the messages and subject when inserting into the database.
// If you are getting slashes after quotes then change this to true.
$slashes = false;


// To change time displayed change $timechange number (can be negative number as well)
// This is in GMT time 
$timechange=7; 
// No changes need to be made to $zone or $submitdate
$zone=3600*-$timechange; 
$submitdate=(date("m-d-y g:i a", time() + $zone )); 

// Here you can add some 'bad' words (use lowercase)
$bad_words = array("fuck","cunt","motherfucker", "twat");

// Version Number
$version = "v0.61";

?>