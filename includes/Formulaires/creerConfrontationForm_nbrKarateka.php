	<form method="get" action="creerConfrontation.php">
		<label for="nbr_karateka">Entrez le nombre de karatéka que vous voulez ajouter (optionnel si Confrontation de Kumite):</label>
		<input type="number" name="nbr_karateka" id="nbr_karateka" />

		<label for="type">Type de Confrontation :</label>
		<select name="type" id="type">
			<option value="kumite">Kumite</option>
			<option value="tamashi wari">Tamashi Wari</option>
			<option value="kata">Kata</option>
		</select>

	<input type="submit" value="Envoyer" />
	
	</form>
