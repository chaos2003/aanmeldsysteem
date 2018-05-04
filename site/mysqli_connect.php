<link rel="shortcut icon" type="image/png" href="/favicon.png">
<?php
//echo "mysqli_connect.php is gebruikt";
// Opens a connection to the database
// Since it is a php file it won't open in a browser 
// It should be saved outside of the main web documents folder
// and imported when needed

/*
Command that gives the database user the least amount of power
as is needed.
GRANT INSERT, SELECT, DELETE, UPDATE ON test3.* 
TO 'studentweb'@'localhost' 
IDENTIFIED BY 'turtledove';
SELECT : Select rows in tables
INSERT : Insert new rows into tables
UPDATE : Change data in rows
DELETE : Delete existing rows (Remove privilege if not required)
*/

// Defined as constants so that they can't be changed
if (!defined('DB_USER')) {
    DEFINE ('DB_USER', 'root');
	DEFINE ('DB_PASSWORD', 'CH405_I5_5uperm00i6enNUrand0M198asdflm');
	DEFINE ('DB_HOST', 'localhost');
	DEFINE ('DB_NAME', 'aanmeldsysteem');
}

// $dbc will contain a resource link to the database
// @ keeps the error from showing in the browser

$dbc = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
OR die('Could not connect to MySQL: ' .
mysqli_connect_error());
?>