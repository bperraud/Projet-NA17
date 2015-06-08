<form method="post" action="ajoutRegle.php">

	<?php
		$vConnect = Connect();
		$requestcategory = "SELECT id, name, subc FROM category ;";

		$requestcompetition = "SELECT id, name FROM competition;";
		if( !($resultcategory = pg_query($vConnect, $requestcategory)) ) {
			echo pg_last_error() ;
			exit();
		}
		if( !($resultcompetition = pg_query($vConnect, $requestcompetition)) ) {
			echo pg_last_error() ;
			exit();
		}
	?>
		
	<label for="category">Categorie :</label>
	<select name="category" required>
	<?php while($category = pg_fetch_array($resultcategory))
		echo "<option value='$category[id]'>$category[name] - $category[subc]</option>";
	?>
	</select>
		
	<label for="competition">Compétition :</label>
	<select name="competition" required>
	<?php while($competition = pg_fetch_array($resultcompetition))
		echo "<option value='$competition[id]'>$competition[name]</option>";
	?>
	</select>

	<label for="points">Points :</label>
	<input type="number" name="points" id="points" />

		
	<?php pg_close($vConnect); ?>
		
	<input type="submit" value="Envoyer" />
		
</form>