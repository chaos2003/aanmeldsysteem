<link rel="shortcut icon" type="image/png" href="/favicon.png">
<?php
//Variablen worden verzameld, hier wordt nog niets gedisplayed. Met deze variablen wordt de vorige melding
//van de huidige activiteit (indien aanwezig) automatisch ingevuld om aan te kunnen passen.

$dezeActiviteitBestaat = false;
$dezeActiviteitDatum = "datum";
$dezeActiviteitType = "type";

include('mysqli_connect.php');
$query = "SELECT datum, type, titel, omschrijving FROM activiteit WHERE id = ?;";
$stmt = $dbc->prepare($query);
$stmt->bind_param('i', $_GET['id']); // 's' specifies the variable type => 'string'
$stmt->execute();
$response = $stmt->get_result();

if($response){
	if ($row = mysqli_fetch_array($response)){
		$dezeActiviteitBestaat = true;
		$dezeActiviteitDatum = $row['datum'];
		$dezeActiviteitType = $row['type'];
		$dezeActiviteitTitel = $row['titel'];
		$dezeActiviteitOmschrijving = $row['omschrijving'];
	}
} else {
	echo "Couldn't issue database query<br />";
	echo mysqli_error($dbc);
}
mysqli_close($dbc);
?>