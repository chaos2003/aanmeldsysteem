<link rel="shortcut icon" type="image/png" href="/favicon.png">
<?php
include('mysqli_connect.php');
//$query = "SELECT id, datum, type FROM activiteit ORDER BY datum ASC";
$jaar =  (isset($_GET['jaar'] )) ? $_GET['jaar'] : date("Y");
$maand = (isset($_GET['maand'])) ? $_GET['maand'] : date("n");

if(isset($_GET['alle-meldingen'])) {
	$query = "SELECT id, DATE_FORMAT(datum, '%d %M'), type, titel FROM activiteit ORDER BY datum ASC";
	$stmt = $dbc->prepare($query);
} else  {
	//$query = "SELECT id, DATE_FORMAT(datum, '%d %M'), type, titel FROM activiteit ORDER BY datum ASC WHERE MONTH(happened_at) = 5 AND YEAR(happened_at) = ?";
	$query = "SELECT id, datum, DATE_FORMAT(datum, '%d %M'), type, titel FROM activiteit WHERE MONTH(datum)=? AND YEAR(datum)=? ORDER BY datum ASC";
	$stmt = $dbc->prepare($query);
	$stmt->bind_param("ss", $maand, $jaar);
			
}

 
$stmt->execute();
$response = $stmt->get_result();
if($response){
	$activiteit = [];
  $minstensEenActiviteit = false;
  $aantalActiviteiten = 0;
	//Zet Activiteiten in een list.
	while($row = mysqli_fetch_array($response)){
		$minstensEenActiviteit = true;
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