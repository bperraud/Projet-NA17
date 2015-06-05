<form method="post" action="ajoutMaitrises.php">

	<?php
		$vConnect = Connect();
		$requestmaitrise = "SELECT NameJ, NameFR FROM kata;";
		if( !($resultmaitrise = pg_query($vConnect, $requestmaitrise)) ) {
			echo pg_last_error() ;
			exit();
		}
	?>
		
	<input type="number" name="karateka" value="<?php echo $resultkarateka['id']; ?>" style = "display:none" required>

	</input>
		
	<label for="kata">Maitrise :</label>
	<select name="kata" required>
	<?php while($maitrise = pg_fetch_array($resultmaitrise))
		echo "<option value='$maitrise[namej]'>$maitrise[namej] - $maitrise[namefr]</option>";
	?>
	</select>
		
	<input type="submit" value="Ajouter" />
		
</form>