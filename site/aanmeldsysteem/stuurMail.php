<link rel="shortcut icon" type="image/png" href="/favicon.png">
<?php
echo '
<html>
<head>
  <style>
	body {
			color: white;
	}
  </style>
</head>
<body style="background-color:Black;">';
	
require_once('inloggen.php');

if(isset($_POST['submit']) && isset($_POST['datum']) && isset($_POST['type']) && isset($_POST['omschrijving'])){
	if ($chaoot_ingelogd) {
		$datum = htmlspecialchars($_POST['datum'], ENT_QUOTES, 'UTF-8');
		$type = htmlspecialchars($_POST['type'], ENT_QUOTES, 'UTF-8');
		$omschrijving= htmlspecialchars($_POST['omschrijving'], ENT_QUOTES, 'UTF-8');
		$titel= htmlspecialchars($_POST['titel'], ENT_QUOTES, 'UTF-8');
		
		include('mysqli_connect.php');
			
		if ($_POST['submit'] == 'aanmaken') {
			$query = "INSERT INTO activiteit (datum, type, omschrijving, titel)
			VALUES (?, ?, ?, ?)";
		
		
			
			$mysqli_stmt_execute = $dbc->prepare($query);
			$mysqli_stmt_execute->bind_param("ssss", $datum, $_POST['type'], $omschrijving, $titel);
			
			
			if ($mysqli_stmt_execute->execute() === TRUE) {
				
				include('idVanActiviteit.php');
				
				if ($IdActiviteit > 0) {
					$from = "aanmeldsysteem2@wiemoeterbierhalen.xyz";
					$subject = $datum . " " . $type . " aanmeldmail";
					//$to = "chaos@ai0867.net";
					$to = "jordyubink@hotmail.nl";

					$msg = "
						<html>
						<head>
						<title>Aanmeldmail</title>
						<style>
							table, th, td {
								text-align: left;
							}
						</style>
						</head>
						<body>
						<p><a hrefactiviteit.php?id=" . $IdActiviteit . "'>Klik hier om je aan- of af te melden</a></p>
						<table>
						<tr>
						<th>Datum</th>
						<td>" . $datum . "</td>
						</tr>
						<tr>
						<th>Type</th>
						<td>" . $type . "</td>
						</tr>
						<tr>
						<th>Aangemaakt door</th>
						<td>" . $chaoot . "</td>
						</tr>
						<tr>
						<th>Titel</th>
						<td>" . $titel . "</td>
						</tr>
						<th>ID</th>
						<td>" . $IdActiviteit . "</td>
						</tr>
						</table>
						<p><b>Omschrijving:</b><br>" . $omschrijving . "</p>
						</body>
						</html>
					";

					// Always set content-type when sending HTML email
					$headers = "MIME-Version: 1.0" . "\r\n";
					$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

					// More headers
					$headers .= 'From: <' . $from . '>' . "\r\n";

					//mail($to, $subject, $msg, $headers);
					
					echo '<p style="color:lime;">Activiteit succesvol aangemaakt!</p><br>
					<p><a style="color:cyan;" href="activiteit.php?id=' . $IdActiviteit . '">Klik hier om je aan- of af te melden</a></p>';
				} else {
					echo "<h2 style='color:red;'>Holy Fuck. Wat is er misgegaan? Controleer of de activiteit is aangemaakt.</h2>";
					
				}
				
			} else {
				echo "<h2 style='color:red;'>Er is iets mis gegaan.</h2>";
			}
		
		} else {
			
			echo "<h2 style='color:red;'>Parameters kloppen niet</h2>";
		}
		


		
	}
}

echo '
</body>
</html>';
?> 