<form method="post" action="viewKarateka.php">

	<?php
		$vConnect = Connect();
		$requestkarateka = "SELECT id, firstname, lastname FROM person NATURAL JOIN karateka;";
		if( !($resultkarateka = pg_query($vConnect, $requestkarateka)) ) {
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
		
	<?php pg_close($vConnect); ?>
		
	<input type="submit" value="Envoyer" />
		
</form>