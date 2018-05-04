<link rel="shortcut icon" type="image/png" href="/favicon.png">
<?php
if ($chaoot_ingelogd) {
	include('dezeActiviteit.php');
	if ($dezeActiviteitBestaat) {
		
		include('mijnMelding.php');
		// Get a connection for the database
		include('mysqli_connect.php');

		// Create a query for the database
		//Datum | type(borrel) | Chaoot | meldingtype | opmerking:
		//$query = "chaoot.naam as Chaoot, melding.meldingtype, opmerking
		//FROM melding WHERE datum = ?
		//INNER JOIN chaoot ON melding.FK_chaoot=chaoot.id
		//INNER JOIN activiteit ON melding.FK_activiteit=activiteit.id;";
		//$query = 'SELECT * FROM activiteit WHERE id = ?';
		if (empty($_COOKIE['sort'])) {
			$query = 'SELECT naam, eten, borrelen, eigenturf, opmerking FROM melding
			INNER JOIN chaoot ON melding.FK_chaoot=chaoot.id
			INNER JOIN activiteit ON melding.FK_activiteit=activiteit.id
			WHERE FK_activiteit = ?
			ORDER BY eten DESC,
			CASE WHEN eten=1 THEN borrelen END ASC,
			CASE WHEN eten=0 THEN borrelen END DESC';
		} else {
			if ($_COOKIE['sort'] == 'alfabet') {
				$query = 'SELECT naam, eten, borrelen, eigenturf, opmerking FROM melding
				INNER JOIN chaoot ON melding.FK_chaoot=chaoot.id
				INNER JOIN activiteit ON melding.FK_activiteit=activiteit.id
				WHERE FK_activiteit = ?
				ORDER BY chaoot.naam ASC';
			} else if ($_COOKIE['sort'] == 'ancienniteit') {
				$query = 'SELECT naam, eten, borrelen, eigenturf, opmerking FROM melding
				INNER JOIN chaoot ON melding.FK_chaoot=chaoot.id
				INNER JOIN activiteit ON melding.FK_activiteit=activiteit.id
				WHERE FK_activiteit = ?
				ORDER BY chaoot.id ASC';
			} else if ($_COOKIE['sort'] == 'tijd') {
				$query = 'SELECT naam, eten, borrelen, eigenturf, opmerking FROM melding
				INNER JOIN chaoot ON melding.FK_chaoot=chaoot.id
				INNER JOIN activiteit ON melding.FK_activiteit=activiteit.id
				WHERE FK_activiteit = ?
				ORDER BY eten DESC,
				CASE WHEN eten=1 THEN borrelen END ASC,
				CASE WHEN eten=0 THEN borrelen END DESC';
			}
		}
		


		$stmt = $dbc->prepare($query);
		$id = $_GET['id'];
		$stmt->bind_param('i', $id); // 's' specifies the variable type => 'string'
		$stmt->execute();

		// Get a response from the database by sending the connection
		// and the query
		$response = $stmt->get_result();

		// If the query executed properly proceed
		if($response){
			$sortAlfabet = "";
			$sortAncienniteit = "";
			$sortTijd = "";
			
			if (!empty($_COOKIE['sort'])) {
				switch ($_COOKIE['sort']) {
					 case 'alfabet': $sortAlfabet 			= 'selected="selected"';	break;
					 case 'ancienniteit': $sortAncienniteit = 'selected="selected"';	break;
					 case 'tijd': $sortTijd 				= 'selected="selected"';	break;
				}
			}
			
			
			echo '
			<p><a href="maandoverzicht" style="color:cyan;">Terug naar maandoverzicht</a></p>
			<table>
			<tr><td><b>Activiteit</b>:</td><td>' . $dezeActiviteitTitel . '</td></tr>
			<tr><td><b>Omschrijving</b>:&nbsp;&nbsp;&nbsp;</td><td>' . $dezeActiviteitOmschrijving . '</td></tr>
			<tr><td><b>Type</b>:</td><td>' . $dezeActiviteitType . '</td></tr><br>
			<tr><td><b>Datum</b>:</td><td>' . $dezeActiviteitDatum . '</td></tr><br>
			<tr><td><b>Naam</b>:</td><td>' . $chaoot . '</td></tr>
			</table>';

			echo '<form action="activiteit?id=' . $_GET['id'] . '" method="post">
				<p>
				<input type="checkbox" name="eten" size="30" ' . $MijnMeldingEten . '/> eten<br>
				<input type="checkbox" name="borrelen" size="30" ' . $MijnMeldingBorrelen . '/> borrelen<br>
				<input type="checkbox" name="eigenturf" size="30" ' . $MijnMeldingEigenturf . '/> Ik turf vandaag niet op Chaos<br><br>
				opmerking:<br>
				<input type="text" name="opmerking" size="30" value="' . $MijnMeldingOpmerking . '"/><br><br>
				
				<input type="hidden" name="activiteit" value="' . $_GET["id"] . '" />
				
				<input type="submit" name="submit" value="' . $MijnMeldingType . '" /><br>
				</p>
			</form>
			<form action="activiteit?id=' . $_GET['id'] . '" method="post">
				<p>
				Sorteren op:
				<select name="sort">
				  <option value="tijd" ' . $sortTijd . '>Tijd van aankomst</option>
				  <option value="alfabet" ' . $sortAlfabet . '>Alfabet</option>
				  <option value="ancienniteit" ' . $sortAncienniteit . '>Anciënniteit</option>
				</select>
				<input type="submit" name="sorteerorde" value="onthouden" /><br>
				</p>
			</form>
			';
//Anciënniteit
			echo '<hr><table align="left"
			cellspacing="0" cellpadding="0">

			<tr>
			<td align="left" style="padding: 0px 3px 0px 3px;">💰</td>
			<td align="left" style="padding: 0px 3px 0px 3px;">🍽</td>
			<td align="left style="padding: 0px 3px 0px 3px;">🍻</td>
			<td align="left" style="padding: 0px 20px 0px 5px;"><b>Chaoot</b></td>
			<td align="left" style="padding: 0px 20px 0px 5px;"><b>Opmerking</b></td>
			</tr>';
			}
		
		
			// mysqli_fetch_array will return a row of data from the query
			// until no further data is available

			while($row = mysqli_fetch_array($response)){
			
			$eten = "red";
			$borrelen = "red";
			$eigenturf = "black";

			if ($row['eten']) $eten = "green";
			if ($row['borrelen']) $borrelen = "green";
			if ($row['eigenturf']) $eigenturf = "orange";


			echo '<tr>' .
			'<td align="left" style="background-color: ' . $eigenturf . ';"></td>' . 
			'<td align="left" style="background-color: ' . $eten . ';"></td>' . 
			'<td align="left" style="background-color: ' . $borrelen . ';"></td>' . 
			'<td align="left" style="padding: 3px 20px 3px 5px;">'; 
			//Eigen naam heeft gele tekstkleur
			if ($row['naam'] == $chaoot) {
				echo '<a style="color:yellow;">' . $row['naam'] . '</a></td>';
			} else {
				echo $row['naam'] . '</td>';
			}
			echo '<td align="left" style="padding: 3px 20px 3px 5px;">' . $row['opmerking'] . '</td>';
			echo '</tr>';

			//echo $row['id'] . "     ";
			}

			echo '</table>';

		} else {

		echo "Couldn't issue database query<br />";

		echo mysqli_error($dbc);

	}

	// Close connection to the database
	mysqli_close($dbc);
} else {
	echo "<h2 style='color:red;'>Deze activiteit bestaat niet. Wil je een nieuwe activiteit toevoegen?</h2>";
}

?>