<?php
	if(isset($_POST['submit'])){
		setcookie('chaootID', $_POST['naam'], time() + 315360000);
		setcookie('chaootKey', $_POST['key'], time() + 315360000);
		setcookie('sort', 'tijd', time() + 315360000);
		setcookie('wanbetaler', '0', time() + 315360000);
		header("Refresh:0");
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
<?php
	require_once('inloggen.php');
	if ($chaoot_ingelogd) {
		echo '<h1 style="color:green";>Ingelogd</h1><br>';
		echo 'Hallo, ' . $chaoot . '!';
		echo '<br><br>Je kan uitloggen door je cookies te verwijderen.';
		echo '<br><br><a href="maandoverzicht" style="color:cyan;">Klik hier om naar het maandoverzicht te gaan.</a>';
	} else {
		echo '<h1>Inloggen</h1>';
		echo '
			<form action="login" method="post">
				<p>
				ID:&nbsp;&nbsp; <input type="text" name="naam" size="5"/><br>
				Key: <input type="text" name="key" size="35"/><br>
				<input type="submit" name="submit" value="Inloggen" /><br>
				</p>
			</form><br><br>Door in te loggen, geef je toestemming om je ziel te verkopen aan College Chaos. Alles wat je op deze site invult, wordt opgeslagen in combinatie met gegevens die jou indentificeren. Deze gegevens worden bewaard zolang wij dat nodig vinden.';
	}
?>
</body>
</html>