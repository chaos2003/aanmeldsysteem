<link rel="shortcut icon" type="image/png" href="/favicon.png">
<?php
/*
$meldingCell[0] = '<td style="background-color:black;text-align: center;">?</td>';
$meldingCell[1] = '<td style="background-color:green;text-align: center;">B</td>';
$meldingCell[2] = '<td style="background-color:gray;text-align: center;">X</td>';
$meldingCell[3] = '<td style="background-color:yellow;color:black;text-align: center;">E</td>';
$meldingCell[4] = '<td style="background-color:red;text-align: center;">A</td>';
*/
$meldingCell[0] = '<td style="background-color:black;text-align: center;"></td>';
$meldingCell[1] = '<td style="background-color:green;text-align: center;"></td>';
$meldingCell[2] = '<td style="background-color:gray;text-align: center;"></td>';
$meldingCell[3] = '<td style="background-color:yellow;color:black;text-align: center;"></td>';
$meldingCell[4] = '<td style="background-color:red;text-align: center;"></td>';
//$antwoord[] = { 0=zwart/undefined, 1=groen/borrelen, 2=zwart/x(geen turf), 3=geel/eten, 4=rood/afwezig, }


for ($i=1; $i<$aantalChaoten; $i++) {
	foreach ($activiteit as &$eenActiviteit) {
		//echo 'activiteit=' . $eenActiviteit[0] . ' | chaoot=' . $i . '<br>';
		$melding[$i][$eenActiviteit[0]] = 0;	
	}
}

include('mysqli_connect.php');
$query = "SELECT FK_activiteit, FK_chaoot, eten, borrelen, eigenturf FROM melding";
$stmt = $dbc->prepare($query);
$stmt->execute();
$response = $stmt->get_result();
if($response){
	
  
  $aantalActiviteiten = 0;
	//Zet Activiteiten in een list.
	while($row = mysqli_fetch_array($response)){
		if ($row['eigenturf']) {
			$melding[$row['FK_chaoot']][$row['FK_activiteit']]=2;
		} else if ($row['borrelen']) {
			$melding[$row['FK_chaoot']][$row['FK_activiteit']]=1;
		} else if ($row['eten']) {
			$melding[$row['FK_chaoot']][$row['FK_activiteit']]=3;
		} else {
			$melding[$row['FK_chaoot']][$row['FK_activiteit']]=4; //afwezig
		}
	}
	
	
	$format = "%b";
	echo '<table class="maand"><tr height="100"><th>Chaoot/Activiteit</th>';
	foreach ($activiteit as &$eenActiviteit) {
			echo '
			<th>
				<a style="color:white;text-decoration:none;" href="activiteit.php?id=' . $eenActiviteit[0] . '">
					<p class="activiteitTitel">'
						. $eenActiviteit[3] .
					'</p>
					<p class="activiteitDatum">
						' . $eenActiviteit[1] . '
					</p>
				</a>
			</th>';
	}
	echo '</tr>';

	for ($i=1; $i<$aantalChaoten; $i++) {
		if ($chaootlijst[$i] == $chaoot) {
			echo '<tr><td><a style="color:yellow;">'. $chaootlijst[$i] . '</a></td>';
		} else {
			echo '<tr><td>'. $chaootlijst[$i] . '</td>';
		}
		foreach ($activiteit as &$eenActiviteit) {
			$m = $melding[$i][$eenActiviteit[0]];
			echo $meldingCell[$m];
		}
		echo '</tr>';
	}

	echo '</table>';
} else {
	echo "Couldn't issue database query<br />";
	echo mysqli_error($dbc);
}
mysqli_close($dbc);






?>