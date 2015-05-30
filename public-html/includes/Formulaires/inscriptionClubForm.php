<form method="post" action="inscriptionClub.php">

	<?php
		$vConnect = Connect();
		$requestkarateka = "SELECT id, firstname, lastname FROM person NATURAL JOIN karateka WHERE clubname IS NULL;";
		$requestclub = "SELECT name FROM club;";
		if( !($resultkarateka = pg_query($vConnect, $requestkarateka)) ) {
			echo pg_last_error() ;
			exit();
		}
		if( !($resultclub = pg_query($vConnect, $requestclub)) ) {
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
		
	<label for="club">Club :</label>
	<select name="club" required>
	<?php while($club = pg_fetch_array($resultclub))
		echo "<option value='$club[name]'>$club[name]</option>";
	?>
	</select>
		
	<?php pg_close($vConnect); ?>
		
	<input type="submit" value="Envoyer" />
		
</form>