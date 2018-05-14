<link rel="shortcut icon" type="image/png" href="/favicon.png">
<?php
//Variablen worden verzameld, hier wordt nog niets gedisplayed. Met deze variablen wordt de vorige melding
//van de huidige activiteit (indien aanwezig) automatisch ingevuld om aan te kunnen passen.

$MijnMeldingError = true;
$MijnMeldingType = "melden";
$MijnMeldingBorrelen = "";
$MijnMeldingEten = "";
$MijnMeldingKnopEten = "style='background-color: rgb(255, 100, 100);'";
$MijnMeldingKnopEtenEnBorrelen = "style='background-color: rgb(255, 100, 100);'";
$MijnMeldingKnopBorrelen = "style='background-color: rgb(255, 100, 100);'";
$MijnMeldingKnopAfwezig = "style='background-color: rgb(255, 100, 100);'";
$MijnMeldingEigenturf = "";
$MijnMeldingOpmerking = "";

include('mysqli_connect.php');
$query = "SELECT borrelen, eten, eigenturf, opmerking FROM melding WHERE FK_chaoot = ? AND FK_activiteit = ?;";
$stmt = $dbc->prepare($query);
$stmt->bind_param('ii', $_COOKIE['chaootID'], $_GET['id']); // 's' specifies the variable type => 'string'
$stmt->execute();
$response = $stmt->get_result();

if($response){
	
	$MijnMeldingError = false;
	if ($row = mysqli_fetch_array($response)){
		$MijnMeldingType = "update";
		if ($row['borrelen']) { $MijnMeldingBorrelen = "checked"; }
		if ($row['eten']) { $MijnMeldingEten = "checked"; }
		if ($row['eigenturf']) { $MijnMeldingEigenturf = "checked"; }
		$MijnMeldingOpmerking = $row['opmerking'];
		
		if ( ($row['eten']) && !($row['borrelen'])) { $MijnMeldingKnopEten = "style='background-color: rgb(100, 255, 100);'"; }
		if ( ($row['eten']) &&  ($row['borrelen'])) { $MijnMeldingKnopEtenEnBorrelen = "style='background-color: rgb(100, 255, 100);'"; }
		if (!($row['eten']) &&  ($row['borrelen'])) { $MijnMeldingKnopBorrelen = "style='background-color: rgb(100, 255, 100);'"; }
		if (!($row['eten']) && !($row['borrelen'])) { $MijnMeldingKnopAfwezig = "style='background-color: rgb(100, 255, 100);'"; }
		
	}
} else {
	echo "Couldn't issue database query<br />";
	echo mysqli_error($dbc);
}
mysqli_close($dbc);
?>