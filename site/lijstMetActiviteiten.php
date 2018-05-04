<link rel="shortcut icon" type="image/png" href="/favicon.png">
<?php
include('mysqli_connect.php');
//$query = "SELECT id, datum, type FROM activiteit ORDER BY datum ASC";
$query = "SELECT id, DATE_FORMAT(datum, '%d %M'), type, titel FROM activiteit ORDER BY datum ASC";
$stmt = $dbc->prepare($query);
$stmt->execute();
$response = $stmt->get_result();
if($response){
	
  
  $aantalActiviteiten = 0;
	//Zet Activiteiten in een list.
	while($row = mysqli_fetch_array($response)){
		$activiteit[$aantalActiviteiten][0] = $row['id'];
		$activiteit[$aantalActiviteiten][1] = $row["DATE_FORMAT(datum, '%d %M')"];
		$activiteit[$aantalActiviteiten][2] = $row['type'];
		$activiteit[$aantalActiviteiten][3] = $row['titel'];
		$aantalActiviteiten++;
	}
	/*
	foreach ($activiteit as &$eenActiviteit) {
		echo "$eenActiviteit[0]     ";
		echo "$eenActiviteit[1]";
		echo "$eenActiviteit[2]<br>";
	}*/
} else {
	echo "Couldn't issue database query<br />";
	echo mysqli_error($dbc);
}
mysqli_close($dbc);
?>