<!-- En attendant les bases SQL, un formulaire qu'on aura forcément à réutiliser après ^^ -->

<form action="BLAHBLAH.php" method="post">
	<fieldset>
		<legend>Informations Générales</legend>
		<label for="nom"></label>
		<input type="text" name="nom" id="nom" required />
		<label for="date"></label>
		<input type="date" name="date" id="date" required />
		<label for="lieu"></label>
		<input type="text" name="lieu" id="lieu" required />
		<label for="type">Type</label>
		<select name="type" id="type">
			<option value="kumite">Kumite</option>
			<option value="tw">Tamashi Wari</option>
			<option value="kata">Kata</option>
			<option value="mixte">Mixte</option>
		</select>
	</fieldset>
	<fieldset>
		<label for="organisateur">Club Organisateur :</label>
		<select name="organisateur" id="organisateur">
			<?php
			//requête SQL pour choper la liste des clubs
			//while truc
			//<option value="ID_dirigeant"> NOM Dirigeant </option>
			?>
			<option value="ID CLUB">NOM CLUB</option>
			<option value="ID CLUB">NOM CLUB</option>
		</select></fieldset>
	<fieldset>
		<legend>Contacts (si vides, les contacts du club organisateur sera utilisé)</legend>
		<label for="site_web"></label>
		<input type="url" name="site_web" id="site_web" />
		<label for="mail"></label>
		<input type="email" name="mail" id="mail" />
	</fieldset>

	<input type="submit" value="Envoyer" />
</form>