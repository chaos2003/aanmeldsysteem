<?php
	$wanbetaler = "";
	$uitgelogd = false;
	//UITLOGGEN
	//Er is geen functie om cookies te verwijderen. Een al verstreken tijd meegeven is de juiste manier.
	if(!empty($_POST['uitloggen'])){
		setcookie('chaootID', "", time() - 3600);
		setcookie('chaootKey', "", time() - 3600);
		$uitgelogd = true;
	}
	if(isset($_POST['wijzig-instellingen'])){
		if (!empty($_POST['wanbetaler'])){
			setcookie('wanbetaler', '1', time() + 315360000);
			$wanbetaler = "checked=''";
		} else {
			setcookie('wanbetaler', '0', time() + 315360000);
		}
	} else {
		if(isset($_COOKIE['wanbetaler'])){
			if ($_COOKIE['wanbetaler'] == "1") {
				$wanbetaler = "checked=''";
			}
		}
	}
?>
<link rel="shortcut icon" type="image/png" href="/favicon.png">
<html>
<head>
	<style>
	body {
		color: white;
	}
	
	</style>
</head>
<body style="background-color:Black;">
	<link rel="stylesheet" type="text/css" href="/style.css">
	<?php
		if ($uitgelogd) {
			echo "<p>Je bent nu uitgelogd</p>";
			exit();
		}
		require_once('inloggen.php');
		if ($chaoot_ingelogd == false) exit();
	?>
	<p><a href="maandoverzicht" style="color:cyan;">Terug naar maandoverzicht</a></p>
	<h1>Persoonlijke instellingen</h1>

	<p>
		<form action="instellingen" method="post">
			<input type="submit" name="uitloggen" value="uitloggen">
		</form>
		<br><hr><br>
		<form action="instellingen" method="post">
			<input type="checkbox" name="wanbetaler" <?php echo $wanbetaler;?> >&nbsp;<b>Wanbetaler</b>:&nbsp; De cellen in het maandoverzicht worden gevuld met schalen in de toekomst. Nu wordt de tabel met tekst ingevuld.<br><br>
			<input type="submit" name="wijzig-instellingen" value="wijzig instellingen">
		</form>
	</p>
	
</body>
</html>

<?php

?>