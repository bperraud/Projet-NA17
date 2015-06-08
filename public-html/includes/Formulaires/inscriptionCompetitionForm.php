<form method="post" action="inscriptionCompetition.php">

	<?php
		$vConnect = Connect();
		$requestkarateka = "SELECT id, firstname, lastname FROM person NATURAL JOIN karateka;";
		$requestInscrit = "SELECT k.id FROM vkarateka k, participate p  WHERE p.idk = k.id AND p.competition = $resultcompetition[id];";
		if( !($resultkarateka = pg_query($vConnect, $requestkarateka)) ) {
			echo pg_last_error() ;
			exit();
		}	
		if( !($resultinscrit = pg_query($vConnect, $requestInscrit)) ) {
			echo pg_last_error() ;
			exit();
		}
		
		$inscrits = array();
		while($inscrit = pg_fetch_array($resultinscrit))
		{
			array_push($inscrits,$inscrit['id']);
		}
	?>
		
	<label for="karateka">Inscription Karateka</label>
	<select name="karateka" required>
	<?php while($karateka = pg_fetch_array($resultkarateka))
		if(!in_array($karateka[id],$inscrits)){
		echo "<option value='$karateka[id]'>$karateka[firstname] $karateka[lastname]</option>";}
	?>
	</select>
	<input type="number" style="display:none" name="competition" value="<?php echo $resultcompetition['id'];?>"></select>
		
	<input type="submit" value="Envoyer" />
		
</form>