<link rel="shortcut icon" type="image/png" href="/favicon.png">
<?php
echo '
	<html>
	<head>
	<title>Aanmeldmail</title>
	<style>
	body {
			color: white;
	}
	</style>
	</head>
	<body style="background-color:Black;">
	<h1>Activiteit aanmaken</h1>
	<form action="stuurMail.php" method="post">
		<p><b>
		Datum:<br><input type="date" name="datum"><br><br>
		Type:<br><select name="type" size="6">
		  <option value="Borrel">Borrel</option>
		  <option value="Feest">Feest</option>
		  <option value="BoVe">BoVé</option>
		  <option value="Chaosvergadering">Chaosvergadering</option>
		  <option value="Federatie uitje">Federatie uitje</option>
		  <option value="Overig">Overig</option>
		</select><br><br>
		
		Titel (max 50 characters):<br><input type="text" name="titel" size="50" value=""/><br><br>
		
		Omschrijving:<br><input type="text" name="omschrijving" size="255" value=""/><br><br>
		
		<input type="submit" name="submit" value="aanmaken" /><br>
		</b></p>
	</form>
	</body>
    </html>
	';

?>