<link rel="shortcut icon" type="image/png" href="/favicon.png">
<html>
<head>
	<style>
	body {
		color: white;
	}
	p.activiteitTitel {
		margin: 5px;
		width: 100px;
		font-size: 12px;
		color: gray;
	}
	p.activiteitDatum {
		margin: 5px;
		width: 100px;
	}
	table, th, td {
		border: 1px solid gray;
		border-collapse: collapse;
	}
	.legenda {
		border: 0px solid yellow;
		border-collapse: separate;
	}
	</style>
</head>
	<body style="background-color:Black;">



<?php
require_once('inloggen.php');
//Zet Chaoten in lijst
if ($chaoot_ingelogd) {
	echo '<h1>Maandoverzicht*</h1>
	<p><a style="color:cyan;" href="maakActiviteitAan.php">Klik hier om een nieuwe activiteit toe te voegen.</a><br><br>
	Druk op een datum om naar die activiteit te springen.</p>';
	include('lijstMetChaoten.php');
	echo '<br><br>';
	require('lijstMetActiviteiten.php');
	echo '<br><br>';
	require('lijstMetMeldingen-wanbetaler.php');
	
	echo '<p><b>Legenda:</b><br>
	<table class="legenda">
	
	<tr class="legenda"><td class="legenda">							Zwart:		</td><td class="legenda">Niks ingevoerd</td>
	<tr class="legenda"><td class="legenda"><a style="color:lime;">		Groen:	</a></td><td class="legenda">Gaat borrelen</td>
	<tr class="legenda"><td class="legenda"><a style="color:yellow;">	Geel:	</a></td><td class="legenda">Komt eten, maar gaat niet borrelen</td>
	<tr class="legenda"><td class="legenda"><a style="color:red;">		Rood:	</a></td><td class="legenda">Is afwezig</td>
	<tr class="legenda"><td class="legenda"><a style="color:gray;">		Grijs:	</a></td><td class="legenda">Turft niet op Chaos</td>
	</table>
	</p>
	';
} else {
	echo "<h2 style='color:red;'>Je bent niet (goed) ingelogd.</h2>";
}




?>
	



</body>
</html>