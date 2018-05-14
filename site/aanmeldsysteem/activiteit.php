<?php
	if(isset($_POST['sorteerorde']) && isset($_POST['sort'])){
		setcookie('sort', $_POST['sort']);
		header("Refresh:0");
	}
?>
<link rel="shortcut icon" type="image/png" href="/favicon.png">
<html>
<head>
	<link rel="stylesheet" type="text/css" href="/style.css">
	<style>
	body {
			color: white;
	}
	
	input.meldknop {
			width: 12em;  height: 3em;
			color: black;
	}
	</style>
</head>
	<body style="background-color:Black;">
<?php
require_once('inloggen.php');
?>
	<h1>Aan- en afmeldingen </h1>
<?php
if(isset($_POST['submit'])){
	if ($chaoot_ingelogd) {
		$p_eten = "0";
		$p_borrelen = "0";
		
		if(isset($_POST['eten']) || isset($_POST['eten-en-borrelen'])) {
			$p_eten = "1";
		}
		if(isset($_POST['borrelen']) || isset($_POST['eten-en-borrelen'])) {
			$p_borrelen = "1";
		}
		
		if(isset($_POST['afwezig'])) {
			//$p_eten = "0";
			//$p_borrelen = "0";
		}
		
		$p_eigenturf = (empty($_POST['eigenturf'])) ? "0" : "1";
		$opmerking = htmlspecialchars($_POST['opmerking'], ENT_QUOTES, 'UTF-8');
		
		if(!$chaoot_ingelogd){
			echo "<h1 style='color:red;'>Er is iets mis gegaan. Je bent niet ingelogd.</h1>";
		} else {
			include('mysqli_connect.php');
			
			if ($_POST['submit'] == 'melden') {
				$query = "INSERT INTO melding (eten, borrelen, eigenturf, opmerking, FK_activiteit, FK_chaoot)
				VALUES (?, ?, ?, ?, ?, ?)";
			} else {
				$query = "UPDATE melding
				SET eten=?, borrelen=?, eigenturf=?, opmerking=?
				WHERE FK_activiteit = ? AND FK_chaoot = ?;";
			}
			
			
			$mysqli_stmt_execute = $dbc->prepare($query);
			$mysqli_stmt_execute->bind_param("ssssss", $p_eten, $p_borrelen, $p_eigenturf, $opmerking, $_GET['id'], $_COOKIE['chaootID']);
			
			
			if ($mysqli_stmt_execute->execute() === TRUE) {
				echo '<p style="color:lime;">Melding succesvol verwerkt</p>';
			} else {
				echo "<h2 style='color:red;'>Er is iets mis gegaan.</h2>";
			}
			
			
		}
	} else {
		echo "<h2 style='color:red;'>Er is iets mis gegaan.</h2>";
	}
}
?>

<?php
//Tabel maken met alle aanmeldingen voor deze activiteit
require_once('aanmeldingenVoorActiviteit.php');
?>
</body>
</html>