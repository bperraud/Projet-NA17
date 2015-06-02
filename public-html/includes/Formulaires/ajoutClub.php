
	 
	 <section class="bg-default" id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 text-center">	

<form method = "POST" action="ajoutClub.php">
	<label for="name">Nom * :</label>
	<input type="text" name="name" id="name" required>

	<label for="website">Site Web *:</label>
	<input type="url" name="website" id="website" required>

	<label for="leader">Dirigeant</label><select name="leader" id="leader">
		<?php
		$vConnect = Connect();
		/*$dirigeants = pg_select ( $vConnect, 'vleader', ['id'=>'', 'firstname'=>'', 'lastname'=>'']);
		echo "result sql : " . $dirigeants ;
		echo "<pre>";
		print_r($dirigeants);
		echo "</pre>";
		foreach ($dirigeants as $dirigeant ) {
			// <option value="ID_dirigeant"> NOM Dirigeant </option>
			echo '<option value="'.$dirigeant['id'].'">'.$dirigeant['firstname'].' '.$dirigeant['lastname'].'</option>';
		}*/
		
		$request = pg_query('SELECT id, firstname, lastname
							FROM vleader ');
		if(!$request){
			echo "Erreur select" . pg_last_error() ;
			exit();
		}
		while( $dirigeant = pg_fetch_array($request,null,PGSQL_ASSOC) ){
			// <option value="ID_dirigeant"> NOM Dirigeant </option>
			echo '<option value="'.$dirigeant['id'].'">'.$dirigeant['firstname'].' '.$dirigeant['lastname'].'</option>';
		}

		pg_close($vConnect);
		?>
		</select>

	<input type="submit" class="btn btn-lg btn-primary" value="Envoyer" />
</form>	</div></div></div></section>