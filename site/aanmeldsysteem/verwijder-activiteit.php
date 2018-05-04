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
	<h1>Een activiteit verwijderen</h1>
<?php
if(isset($_POST['verwijder_meldingen'])){
	if ($chaoot_ingelogd) {
		$p_id_ingevuld = (empty($_POST['id'])) ? "0" : "1";
		
		if(!$chaoot_ingelogd){
			echo "<h1 style='color:red;'>Er is iets mis gegaan. Je bent niet ingelogd.</h1>";
		} else {
			
			if ($chaoot == 'Jordy Ubink' || $chaoot == 'Bas Liesker') {
				include('mysqli_connect.php');
				$query = 'DELETE FROM melding WHERE FK_activiteit=?;';
				$mysqli_stmt_execute = $dbc->prepare($query);
				$mysqli_stmt_execute->bind_param("s", $_POST['id']);
			
			
				if ($mysqli_stmt_execute->execute() === TRUE) {
					echo '<p style="color:lime;">Succesvol verwijderd</p>';
				} else {
					echo "<h2 style='color:red;'>Er is iets mis gegaan.</h2><br>ID: " . $_POST['id'] . "<br>";
					echo $mysqli_stmt_execute->error;
					echo '<br><br>';
				}
			} else {
				echo "<h2 style='color:red;'>Er is iets mis gegaan, je bent geen admin.</h2>";
			}
			
		}
	} else {
		echo "<h2 style='color:red;'>Er is iets mis gegaan...</h2>";
	}
}
?>
<?php
if(isset($_POST['verwijder_activiteit'])){
	if ($chaoot_ingelogd) {
		$p_id_ingevuld = (empty($_POST['id'])) ? "0" : "1";
		
		if(!$chaoot_ingelogd){
			echo "<h1 style='color:red;'>Er is iets mis gegaan. Je bent niet ingelogd.</h1>";
		} else {
			
			if ($chaoot == 'Jordy Ubink' || $chaoot == 'Bas Liesker') {
				include('mysqli_connect.php');
				$query = 'DELETE FROM activiteit WHERE id=?;';
				$mysqli_stmt_execute = $dbc->prepare($query);
				$mysqli_stmt_execute->bind_param("s", $_POST['id']);
			
			
				if ($mysqli_stmt_execute->execute() === TRUE) {
					echo '<p style="color:lime;">Succesvol verwijderd</p>';
				} else {
					echo "<h2 style='color:red;'>Er is iets mis gegaan.</h2><br>ID: " . $_POST['id'] . "<br>";
					echo $mysqli_stmt_execute->error;
					echo '<br><br>';
				}
			} else {
				echo "<h2 style='color:red;'>Er is iets mis gegaan, je bent geen admin.</h2>";
			}
			
		}
	} else {
		echo "<h2 style='color:red;'>Er is iets mis gegaan...</h2>";
	}
}
?>
<?php
	echo 'Chaoot: ' . $chaoot;

?>

<form action="verwijder-activiteit.php" method="post">
		<p><b>
		ID:<br><input type="text" name="id"><br><br>
		<input type="submit" name="verwijder_meldingen" value="Verwijder meldingen" /><br>
		<input type="submit" name="verwijder_activiteit" value="Verwijder activiteit" /><br>
		</b></p>
	</form>
</body>
</html>