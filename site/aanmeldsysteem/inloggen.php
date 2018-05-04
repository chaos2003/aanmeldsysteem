<link rel="shortcut icon" type="image/png" href="/favicon.png">
<?php
$cookie_error = true;
$chaoot_ingelogd = false;
$chaoot = "";

if(!(isset($_COOKIE['chaootID']) && isset($_COOKIE['chaootKey']))) {
    echo "Cookie error. Er ontbreken cookies (chaootID of chaootKey). <a style='color:aqua;' href='login.php'>Log eerst in</a>";
} else {
	$cookie_error = false;
	include('mysqli_connect.php');


	$query = 'SELECT * FROM chaoot WHERE id = ?;';


	$stmt = $dbc->prepare($query);
	$id = $_COOKIE['chaootID'];
	$stmt->bind_param('s', $_COOKIE['chaootID']); // 'i' specifies the variable type => 'integer'
	$stmt->execute();

	// Get a response from the database by sending the connection
	// and the query
	$response = $stmt->get_result();

	// If the query executed properly proceed
	if($response){
		if ($row = mysqli_fetch_array($response)){
			if ($_COOKIE['chaootKey'] == $row['key']) {
				$chaoot = $row['naam'];
				$chaoot_ingelogd = true;
			} else {
				echo '<p>Inlog error. Je ID+key combinatie klopt niet. <a style="color:aqua;" href="login.php">Log opnieuw in</a>.</p>';
			}
		}
	} else {
		echo "Couldn't issue database query<br />";
		echo mysqli_error($dbc);
	}

	// Close connection to the database
	mysqli_close($dbc);
	
}


?>