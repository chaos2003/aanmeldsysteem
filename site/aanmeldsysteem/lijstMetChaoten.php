<link rel="shortcut icon" type="image/png" href="/favicon.png">
<?php
include('mysqli_connect.php');
$query = "SELECT id, naam FROM chaoot ORDER BY id ASC";
$stmt = $dbc->prepare($query);
$stmt->execute();
$response = $stmt->get_result();
if($response){
	//Zet Chaoten in een list.
	$aantalChaoten = 1;
	while($row = mysqli_fetch_array($response)){
		$chaootlijst[$aantalChaoten] = $row['naam'];
		$aantalChaoten++;
	}
	reset($chaootlijst);
	/*foreach ($chaootlijst as &$naam) {
		echo "$naam<br>";
	}*/
} else {
	echo "Couldn't issue database query<br />";
	echo mysqli_error($dbc);
}
mysqli_close($dbc);
?>