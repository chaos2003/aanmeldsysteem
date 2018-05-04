<link rel="shortcut icon" type="image/png" href="/favicon.png">
 
<?php
	include('../common.php');
?>

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
	.noBorder {
		border: 0px solid yellow;
		border-collapse: separate;
	}
	</style>
</head>
	<body style="background-color:Black;">
	<link rel="stylesheet" type="text/css" href="/style.css">
	<h2><a href="http://chaos2003.nl">❰ Index</a></h2>
	




<?php

require_once('inloggen.php');
//Zet Chaoten in lijst
if ($chaoot_ingelogd) {
	echo '<h1>Maandoverzicht DIT IS NIET DE GOEDE SITE. GA NAAR <a href="http://www.chaos2003.nl">chaos2003.nl</a></h1>
	<p><a style="color:cyan;" href="maakActiviteitAan.php">Klik hier om een nieuwe activiteit toe te voegen.</a><br><br>
	Druk op een datum om naar die activiteit te springen.</p>';
	
	//Jaar en Maand kiezen om meldingen te zien van een andere periode
	$jaar =  (isset($_GET['jaar'] )) ? $_GET['jaar'] : date("Y");
	$maand = (isset($_GET['maand'])) ? $_GET['maand'] : date("n");
	echo '<form action="maandoverzicht" method="get">
		 <table class="noBorder">
		 <tr class="noBorder">
		   <td class="noBorder">Jaar</td>
		   <td class="noBorder"><input type="text" name="jaar" size="10" value="' . $jaar . '"></td>
		 </tr>
		 <tr class="noBorder">
		   <td class="noBorder">Maand&nbsp;&nbsp;&nbsp;</td>
		   <td class="noBorder">
			 <select name="maand" id="maand">';
			echo '<option value="1"  '; if ($maand == 1 ) echo "selected"; echo '>Januari</option>';
			echo '<option value="2"  '; if ($maand == 2 ) echo "selected"; echo '>Februari</option>';
			echo '<option value="3"  '; if ($maand == 3 ) echo "selected"; echo '>Maart</option>';
			echo '<option value="4"  '; if ($maand == 4 ) echo "selected"; echo '>April</option>';
			echo '<option value="5"  '; if ($maand == 5 ) echo "selected"; echo '>Mei</option>';
			echo '<option value="6"  '; if ($maand == 6 ) echo "selected"; echo '>Juni</option>';
			echo '<option value="7"  '; if ($maand == 7 ) echo "selected"; echo '>Juli</option>';
			echo '<option value="8"  '; if ($maand == 8 ) echo "selected"; echo '>Augustus</option>';
			echo '<option value="9"  '; if ($maand == 9 ) echo "selected"; echo '>September</option>';
			echo '<option value="10" '; if ($maand == 10) echo "selected"; echo '>Oktober</option>';
			echo '<option value="11" '; if ($maand == 11) echo "selected"; echo '>November</option>';
			echo '<option value="11" '; if ($maand == 12) echo "selected"; echo '>December</option>';
			echo '</select>
		   </td>
		 </tr>
		 </table>
		 <input type="submit" value="Bekijk maand">
	</form>';
	
	
	include('lijstMetChaoten.php');
	echo '<br><br>';
	require('lijstMetActiviteiten.php');
	echo '<br><br>';
	require('lijstMetMeldingen.php');
	
	echo '<p><b>Legenda:</b><br>
	<table class="noBorder">
	
	<tr class="noBorder"><td class="noBorder">							Zwart:		</td><td class="noBorder">Niks ingevoerd</td>
	<tr class="noBorder"><td class="noBorder"><a style="color:lime;">		Groen:	</a></td><td class="noBorder">Gaat borrelen</td>
	<tr class="noBorder"><td class="noBorder"><a style="color:yellow;">	Geel:	</a></td><td class="noBorder">Komt eten, maar gaat niet borrelen</td>
	<tr class="noBorder"><td class="noBorder"><a style="color:red;">		Rood:	</a></td><td class="noBorder">Is afwezig</td>
	<tr class="noBorder"><td class="noBorder"><a style="color:gray;">		Grijs:	</a></td><td class="noBorder">Turft niet op Chaos</td>
	</table>
	</p>
	';
} else {
	echo "<h2 style='color:red;'>Je bent niet (goed) ingelogd.</h2>";
}




?>
	



</body>
</html>