<link rel="shortcut icon" type="image/png" href="/favicon.png">
<?php
//Variablen worden verzameld, hier wordt nog niets gedisplayed. Met deze variablen wordt de vorige melding
//van de huidige activiteit (indien aanwezig) automatisch ingevuld om aan te kunnen passen.

$IdActiviteit = 0;

include('mysqli_connect.php');
$query = "SELECT id FROM activiteit WHERE datum = ?;";
$stmt = $dbc->prepare($query);
$stmt->bind_param('s', $_POST['datum']); // 's' specifies the variable type => 'string'
$stmt->execute();
$response = $stmt->get_result();

if($response){
	if ($row = mysqli_fetch_array($response)){
		$IdActiviteit = $row['id'];
	}
} else {
	echo "Couldn't issue database query<br />";
	echo mysqli_error($dbc);
}
mysqli_close($dbc);
?>