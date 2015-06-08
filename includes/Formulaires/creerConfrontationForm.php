<form method="post" action="creerConfrontation.php">

	<?php
		$vConnect = Connect();

		$requestkarateka = "SELECT id, firstname, lastname FROM vkarateka k
							JOIN participate p ON k.id = p.idk
							WHERE p.competition = '$competition' ;";
		if( !($resultkarateka = pg_query($vConnect, $requestkarateka)) ) {
			echo pg_last_error() ;
			exit();
		}
		$size = pg_num_rows($resultkarateka);

		//pour garder en mémoire nbr_karateka & le type
		echo '<input type="hidden" value="'.$competition.'" name="competition">';		
		echo '<input type="hidden" value="'.$nbr_karateka.'" name="nbr_karateka">';
		echo '<input type="hidden" value="'.$type.'" name="type">';
		//affiche le nombre 
		for ($i=0; $i < $nbr_karateka; $i++) { 
			echo '<label for="karateka'.$i.'">Karateka n°'.($i+1).':</label>
				  <select name="karateka'.$i.'" required>';
			for ($j=0; $j < $size; $j++) { 
				$karateka = pg_fetch_assoc($resultkarateka, $j);
				echo "<option value='$karateka[id]'>$karateka[firstname] $karateka[lastname]</option>";
			}
			echo '</select> 
				<label for="points'.$i.'">Points du Karateka n°'.($i+1).':</label>
				<input type="number" name="points'.$i.'" required><br />';
		}
		pg_close($vConnect);
	?>
		
	<input type="submit" value="Envoyer" />
		
</form>