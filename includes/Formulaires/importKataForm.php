<form enctype="multipart/form-data" method="post" action="import.php">

	<label for="katafamily">Importer la liste des familles de kata depuis un fichier csv :</label><br />
	<input type="file" name="katafamily" required /><br />
	
	<label for="kata">Importer la liste des katas depuis un fichier csv :</label><br />
	<input type="file" name="kata" required /><br />

	<label for="karatemov">Importer la liste mouvements de karaté depuis un fichier csv :</label><br />
	<input type="file" name="karatemov" required /><br />

	<label for="katamov">Importer la liste des mouvements de kata depuis un fichier csv :</label><br />
	<input type="file" name="katamov" required /><br />

		
	<!-- <?php pg_close($vConnect); ?> -->
		
	<input type="submit" value="Envoyer" />
		
</form>