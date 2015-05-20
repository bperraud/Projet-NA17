<!-- En attendant les bases SQL, un formulaire qu'on aura forcément à réutiliser après ^^ -->

<form action="BLABLA.php">
	<label for="nom">Nom * :</label>
	<input type="text" name="nom" id="nom" required>

	<label for="site_web">Site Web *:</label>
	<input type="url" name="site_web" id="site_web" required>

	<label for="dirigeant">Dirigeant</label><select name="dirigeant" id="dirigeant">
		<?php
			//requête SQL pour choper la liste des dirigeants
			//while truc
			//<option value="ID_dirigeant"> NOM Dirigeant </option>
		?>
		<option value="ID_dirigeant"> NOM Dirigeant </option>
		<option value="ID_dirigeant"> NOM Dirigeant </option>
		<option value="ID_dirigeant"> NOM Dirigeant </option>
	</select>

	<input type="submit" value="Envoyer" />
</form>