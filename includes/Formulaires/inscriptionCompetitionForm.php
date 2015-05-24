<form method="post" action="inscriptionCompetition.php">

	<?php
		$vConnect = Connect();
		$requestkarateka = "SELECT id, firstname, lastname FROM person NATURAL JOIN karateka;";
		$requestcompetition = "SELECT id, name FROM competition;";
		if( !($resultkarateka = pg_query($vConnect, $requestkarateka)) ) {
			echo pg_last_error() ;
			exit();
		}
		if( !($resultcompetition = pg_query($vConnect, $requestcompetition)) ) {
			echo pg_last_error() ;
			exit();
		}
	?>
		
	<label for="karateka">Karateka :</label>
	<select name="karateka" required>
	<?php while($karateka = pg_fetch_array($resultkarateka))
		echo "<option value='$karateka[id]'>$karateka[firstname] $karateka[lastname]</option>";
	?>
	</select>
		
	<label for="competition">Compétition :</label>
	<select name="competition" required>
	<?php while($competition = pg_fetch_array($resultcompetition))
		echo "<option value='$competition[id]'>$competition[name]</option>";
	?>
	</select>
		
	<?php pg_close($vConnect); ?>
		
	<input type="submit" value="Envoyer" />
		
</form>