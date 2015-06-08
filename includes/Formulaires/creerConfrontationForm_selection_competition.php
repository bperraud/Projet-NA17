<?php
	$vConnect = Connect();

	$requestcompetition = "SELECT id, name FROM competition
						   WHERE type = '$type' OR type = 'mixte';";
	if( !($resultcompetition = pg_query($vConnect, $requestcompetition)) ) {
		echo pg_last_error() ;
		exit();
	}
?>
<form method="post" action="creerConfrontation.php">

	<label for="competition_selection">Compétition :</label>
	<select name="competition_selection" required>
	<?php while($competition = pg_fetch_array($resultcompetition))
		echo "<option value='$competition[id]'>$competition[name] </option>";
	?>
	</select> <br />

<?php
		echo '<input type="hidden" value="'.$nbr_karateka.'" name="nbr_karateka">';
		echo '<input type="hidden" value="'.$type.'" name="type">';
		//affiche le nombre 

		pg_close($vConnect);
	?>
		
	<input type="submit" value="Envoyer" />
		
</form>