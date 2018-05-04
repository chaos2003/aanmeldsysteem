list Chaoot[n=chaootID] = { n=chaootNaam, lijst met chaoten }
list borrels[n=borrelID] = { n=borrelDatum, lijst met borrels in deze maand }

list<int> aanwezigheid[chaoot][borrel_ID];

//eerst alles zwart maken.
foreach (chaoot : aanwezigheid) {
	foreach (borrel_ID : chaoot) {
		aanwezigheid[chaoot][borrel_ID] = 0;
	}
}

$antwoord[] = { 0=zwart/undefined, 1=groen/borrelen, 2=zwart/x(geen turf), 3=geel/eten, 4=rood/afwezig, }

foreach (row) {
	if (borrelen && !eigen_turf) {
		$antwoord[chaoot][borrel_ID]=1
	} else if (borellen && eigen_turf) {
		$antwoord[chaoot][borrel_ID]=2
	} else if (eten) {
		$antwoord[chaoot][borrel_ID]=3
	} else {
		$antwoord[chaoot][borrel_ID]=4 //afwezig
	}
}

echo '<tabel><tr>';
foreach (borrel_ID : borrels) {
	echo '<th><p class="datum-schuin">Datum</p></th>'
}
echo '</tr>';

foreach (chaoot : aanwezigheid) {
	echo '<tr><td>naam</td>';
	foreach (borrel_ID : chaoot) {
		echo $antwoord[chaoot][borrel_ID];
	}
	echo '</tr>';
}
echo '</tabel>';