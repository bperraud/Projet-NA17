<form method="post" action="ajoutMaitrises.php">

	<?php
		$vConnect = Connect();
		$requestkarateka = "SELECT id, firstname, lastname FROM vkarateka;";
		$requestmaitrise = "SELECT NameJ, NameFR FROM kata;";
		if( !($resultkarateka = pg_query($vConnect, $requestkarateka)) ) {
			echo pg_last_error() ;
			exit();
		}
		if( !($resultmaitrise = pg_query($vConnect, $requestmaitrise)) ) {
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
		
	<label for="kata">Maitrise :</label>
	<select name="kata" required>
	<?php while($maitrise = pg_fetch_array($resultmaitrise))
		echo "<option value='$maitrise[namej]'>$maitrise[namej] - $maitrise[namefr]</option>";
	?>
	</select>
		
	<?php pg_close($vConnect); ?>
		
	<input type="submit" value="Envoyer" />
		
</form>