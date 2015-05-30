<?php
/**
 * contact competition ?
 */
?>
<form action="ajoutCompetition.php" method="post">
	<fieldset>
		<legend>Informations Générales</legend>
		<label for="name">Nom : </label>
		<input type="text" name="name" id="name" required />
		<label for="date">Date (YYYY/MM/DD):</label>
		<input type="date" name="date" id="date" required />
		<label for="place">Lieu :</label>
		<input type="text" name="place" id="place" required />
		<label for="type">Type</label>
		<select name="type" id="type">
			<option value="kumite">Kumite</option>
			<option value="tamashi wari">Tamashi Wari</option>
			<option value="kata">Kata</option>
			<option value="mixte">Mixte</option>
		</select>
	</fieldset>
	<fieldset>
		<label for="organisator">Club Organisateur :</label>
		<select name="organisator" id="organisator">
		<?php
		$vConnect = Connect();
		
		$request = pg_query('SELECT name
							FROM club ');
		if(!$request){
			echo "Erreur select" . pg_last_error() ;
			exit();
		}
		while( $club = pg_fetch_array($request,null,PGSQL_ASSOC) ){
			// <option value="name"> name </option>
			echo '<option value="'.$club['name'].'">'.$club['name'].'</option>';
		}

		pg_close($vConnect);
		?>
		</select>
	</fieldset>
	<!--
	Braou ?
	<fieldset>
		<legend>Contacts (si vides, les contacts du club organisateur sera utilisé)</legend>
		<label for="site_web">Site web :</label>
		<input type="url" name="site_web" id="site_web" />
		<label for="mail">Mail :</label>
		<input type="email" name="mail" id="mail" />
	</fieldset> -->

	<input type="submit" value="Envoyer" />
</form>