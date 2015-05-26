<form enctype="multipart/form-data" method="post" action="import.php">

	<label for="katafamily">Importer la liste des familles de kata depuis un fichier csv :</label><br />
	<input type="file" name="katafamily" required /><br />
	
	<label for="kata">Importer la liste des katas depuis un fichier csv :</label><br />
	<input type="file" name="kata" required /><br />
		
	<!-- <?php pg_close($vConnect); ?> -->
		
	<input type="submit" value="Envoyer" />
		
</form>