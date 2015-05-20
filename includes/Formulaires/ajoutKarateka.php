	<form method="POST" action="ajout_Karateka.php">
		<fieldset>
			<legend>Information Générales</legend>
			<label for="nom">Nom *:</label>
			<input type="text" name="nom" id="nom" required/>

			<label for="prenom">Prenom *:</label>
			<input type="text" name="prenom" id="prenom" required/>
		</fieldset>
		<fieldset>
			<legend>Karatéka :</legend>
			<label for="is_karateka">Karatéka ?</label>
			<input type="checkbox" name="is_karateka" id="is_karateka" />

			<label for="photo">Photo *:</label>
			<input type="file" name="photo" id="photo" />

			<label for="poids">Poids * (en kg):</label>
			<input type="number" name="poids" id="poids" />

			<label for="taille">Taille * (en cm):</label>
			<input type="number" name="taille" id="taille" />

			<label for="ceinture">Ceinture *:</label>
			<select name="ceinture" id="ceinture">
				<option value="jaune">Jaune</option>
				<option value="orange">Orange</option>
				<option value="verte">Verte</option>
				<option value="bleue">Bleue</option>
				<option value="marron">Marron</option>
				<option value="noire">Noire</option>
			</select>

			<label for="dans">Dans (* si Ceinture Noire) :</label>
			<input type="number" name="dans" id="dans" />
		</fieldset>
		<fieldset>
			<legend>Dirigeant</legend>
			<label for="is_dirigeant">Dirigeant ?</label>
			<input type="checkbox" name="is_dirigeant" id="id_dirigeant" />

			<label for="email"></label>
			<input type="email" name="email" id="email">
			<label for="tel"></label>
			<input type="tel" name="tel" id="tel">
		</fieldset>

		<input type="submit" value="Envoyer" />
	</form>
