	 <section class="bg-default image" id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 ">

	<form enctype="multipart/form-data" method="POST" action="ajoutPersonne.php" class="form-inline">
		<fieldset>
		<div class="form-group">
			<legend>Information Générales</legend>
			<label for="nom">Nom *:</label>
			<input type="text" name="nom" id="nom" class="form-control" required/>

			<label for="prenom">Prenom *:</label>
			<input type="text" name="prenom" class="form-control"  id="prenom" required/></div>
		</fieldset>
		<fieldset>
		
		<div class="form-group">
			<legend>Karatéka :</legend>
			<label for="is_karateka">Karatéka ?</label>
			<input type="checkbox" class="form-control" name="is_karateka" id="is_karateka" />

			<label for="is_teacher">Professeur ?</label>
			<input type="checkbox" class="form-control" name="is_teacher" id="is_teacher">
			
			<label for="photo">Photo *:</label>
			<input type="file" class="form-control" name="photo" id="photo" />

		</div><div class="form-group">
			<label for="poids">Poids * (en kg):</label>
			<input type="number" class="form-control" name="poids" id="poids" />

			<label for="taille">Taille * (en cm):</label>
			<input type="number" class="form-control" name="taille" id="taille" />
</div><div class="form-group">
			<label for="ceinture">Ceinture *:</label>
			<select name="ceinture" class="form-control" id="ceinture">
				<option value="white">Blanche</option>
				<option value="yellow">Jaune</option>
				<option value="orange">Orange</option>
				<option value="green">Verte</option>
				<option value="blue">Bleue</option>
				<option value="brown">Marron</option>
				<option value="black">Noire</option>
			</select>

			<label for="dans">Dans (* si Ceinture Noire) :</label>
			<input type="number" class="form-control" name="dans" id="dans" /></div>
		</fieldset>
		<fieldset>
		<div class="form-group">
			<legend>Dirigeant</legend>
			<label for="is_dirigeant">Dirigeant ?</label>
			<input type="checkbox" class="form-control" name="is_dirigeant" id="id_dirigeant" />

			<label for="email">Email :</label>
			<input type="email" class="form-control" name="email" id="email">
			<label for="tel">Téléphone :</label>
			<input type="tel" class="form-control" name="tel" id="tel"></div>
		</fieldset>

		<input type="submit" class="btn bnt-default" value="Envoyer" />
	</form></div></div></div></div></section>
