<link rel="shortcut icon" type="image/png" href="/favicon.png">
<?php
	if(isset($_POST['sorteerorde']) && isset($_POST['sort'])){
		setcookie('sort', $_POST['sort']);
		header("Refresh:0");
	}
?>
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
?>
	<h1>Aan- en afmeldingen </h1>
<?php
if(isset($_POST['submit'])){
	if ($chaoot_ingelogd) {
		$p_eten = (empty($_POST['eten'])) ? "0" : "1";
		$p_borrelen = (empty($_POST['borrelen'])) ? "0" : "1";
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