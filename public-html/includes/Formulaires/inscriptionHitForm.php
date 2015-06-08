<form method="post" action="inscriptionHit.php">

	<?php
		$vConnect = Connect();
		$requestcat = "SELECT * FROM category;";
		$requesthit = "SELECT r.category FROM rule r  WHERE r.competition = $resultcompetition[id];";
		if( !($resultcat = pg_query($vConnect, $requestcat)) ) {
			echo pg_last_error() ;
			exit();
		}	
		if( !($resulthit = pg_query($vConnect, $requesthit)) ) {
			echo pg_last_error() ;
			exit();
		}
		
		$inscrits = array();
		while($hit = pg_fetch_array($resulthit))
		{
			array_push($inscrits,$hit['category']);
		}
	?>
		
	<label for="category">Inscription règles</label>
	<select name="category" required>
	<?php while($cat = pg_fetch_array($resultcat))
		if(!in_array($cat[id],$inscrits)){
		echo "<option value='$cat[id]'>$cat[name] $cat[subc]</option>";}
	?>
	</select>
	<input type="number" style="display:none" name="competition" value="<?php echo $resultcompetition['id'];?>"/>
	
	<label for="points">nbr points</label>
	<input type="number" name="points"/>
		
	<input type="submit" value="Envoyer" />
		
</form>