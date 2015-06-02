
<?php

$title = "Description détaillée d'un karatéka" ;
include 'includes/header.php' ;
include 'connect.php' ;

if(isset($_GET['id'])){
	
	$vConnect = Connect();
	$id = $_GET['id'];
	$request = "SELECT * FROM vkarateka WHERE id =$id ;";
	if ( !($result = pg_query($vConnect, $request)) ) {
		echo pg_last_error() ;
		exit();
	}
	$resultkarateka = pg_fetch_array($result);
		if ( !($resultkarateka) ) {
		echo pg_last_error() ;
		exit();
	}
	switch ($resultkarateka['belt']){
		case 'white':
			$belt = "Blanche"; break;
		case 'yellow':
			$belt = "Jaune"; break;
		case 'orange':
			$belt = "Orange"; break;
		case 'green':
			$belt = "Verte"; break;
		case 'blue':
			$belt = "Bleue"; break;
		case 'brown':
			$belt = "Marron"; break;
		case 'black':
			$belt = "Noire"; break;
		default:
			echo "couleur ceinture invalide !"; exit();
	}
	 if($resultkarateka['teacher'] ==true)
{$teacher=true;}else{$teacher=false;}	 
	
?>
	 <section class="bg-default image" id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 text-center">	
	<h1>Identité :</h1>
	
	<img src="<?php echo $resultkarateka['urlphoto']; ?>" alt="photo karatéka" height="128" width="128">
	<div class="table-responsive">
	<table  class="table-bordered"><tr><td>Nom :		</td><td>Prénom :	</td><td>Poids :		</td><td>Taille :	</td><td>Ceinture :	</td><td>Dans :		</td><td>Club :		</td><td>Professeur :</td></tr>
		<tr><td><?php echo $resultkarateka['lastname']; 	?></td>
		<td><?php echo $resultkarateka['firstname']; ?></td>
		<td><?php echo $resultkarateka['weight']; 	?></td>
		<td><?php echo $resultkarateka['height']; 	?></td>
		<td><?php echo $belt; 						?></td>
		
		<td><?php if($belt == "Noire"){ echo $resultkarateka['dans']; } ?></td>
		
		<td><?php echo $resultkarateka['clubname']; 	?></td>
		<td><?php if($teacher)echo "oui"; 					?></td></tr>
	</table></div>
	
<?php

	$request = "SELECT * FROM competition c INNER JOIN participate p ON c.id = p.competition WHERE idk = $id;";
	if ( !($result = pg_query($vConnect, $request)) ) {
		echo pg_last_error() ;
		exit();
	}
?>

	<h1>Compétitions auxquelles <?php echo $resultkarateka['lastname']." ".$resultkarateka['firstname']; ?> a participé :</h1>

	<div class="table-responsive">
	<table  class="table-bordered">
		<tr><th>Nom : </th><th>Date : </th><th>Lieu : </th><th>Type : </th><th>Club organisateur : </th></tr>
	<?php
		$exists = false;
		while($resultcompet = pg_fetch_array($result)){
			$date = strtotime($resultcompet[date]);
			$date = date('d/m/Y', $date);
			echo "<tr><td>$resultcompet[name]</td><td>$date</td><td>$resultcompet[place]</td><td>$resultcompet[type]</td><td>$resultcompet[organisator]</td></tr>";
			$exists = true;
		}
		if (!$exists)
			echo "<tr><td colspan='5'>Aucune compétition à afficher.</td></tr>";
	?>
	</table></div>
	
<?php

	$request = "SELECT kata FROM masteries WHERE karateka = $id;";
	if ( !($result = pg_query($vConnect, $request)) ) {
		echo pg_last_error() ;
		exit();
	}
?>

	<h1>Katas maîtrisés :</h1>

		<div class="table-responsive">
	<table  class="table-bordered">
		<tr><th>Nom : </th></tr>
	<?php
		$exists = false;
		while($resultkata = pg_fetch_array($result)){
			echo "<tr><td>$resultkata[kata]</td></tr>";
			$exists = true;
		}
		if (!$exists)
			echo "<tr><td>Aucun kata maîtrisé.</td></tr>";
	?>
	</table></div>
	</div></div></div></section>
	
	
<?php
	pg_close($vConnect);
}
