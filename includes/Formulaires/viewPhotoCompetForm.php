<form method="post" action="viewPhotoCompet.php">

	<?php
		$vConnect = Connect();
		$requestcompetition = "SELECT id, name FROM competition;";
		if( !($resultcompetition = pg_query($vConnect, $requestcompetition)) ) {
			echo pg_last_error() ;
			exit();
		}
	?>
		
	<label for="competition">Compétition :</label>
	<select name="competition" required>
	<?php while($competition = pg_fetch_array($resultcompetition))
		echo "<option value='$competition[id]'>$competition[name]</option>";
	?>
	</select>
		
	<?php pg_close($vConnect); ?>
		
	<input type="submit" value="Envoyer" />
		
</form>