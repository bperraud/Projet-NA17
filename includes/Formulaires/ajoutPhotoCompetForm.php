<form enctype="multipart/form-data" method="post" action="ajoutPhotoCompet.php">

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
	</select><br />
		
	<?php pg_close($vConnect); ?>

	
	<label for="photo">Ajouter une photo :</label>
	<input type="file" name="photo" required /><br />
	
	<label for="addmore">Ajouter plus de photos :</label>
	<input type="checkbox" name="addmore[]" value=true />Oui<br>
		
	<input type="submit" value="Envoyer" />
		
</form>