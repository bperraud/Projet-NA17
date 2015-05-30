<?php

$title = "Description détaillée d'un karatéka" ;
include 'includes/header.php' ;

if (empty($_POST))
	include 'includes/Formulaires/viewKaratekaForm.php';

else{
	if (empty($_POST['karateka'])){
		echo "karateka non fourni...";
		exit();
	}
	$karateka = $_POST['karateka'];
	
	$vConnect = Connect();
	
	$request = "SELECT * FROM person NATURAL JOIN karateka WHERE id = $karateka;";
	if ( !($result = pg_query($vConnect, $request)) ) {
		echo pg_last_error() ;
		exit();
	}
	$resultkarateka = pg_fetch_array($result);
		if ( !($resultkarateka) ) {
		echo pg_last_error() ;
		exit();
	}
	switch ($resultkarateka[belt]){
		case white:
			$belt = "Blanche"; break;
		case yellow:
			$belt = "Jaune"; break;
		case orange:
			$belt = "Orange"; break;
		case green:
			$belt = "Verte"; break;
		case blue:
			$belt = "Bleue"; break;
		case brown:
			$belt = "Marron"; break;
		case black:
			$belt = "Noire"; break;
		default:
			echo "couleur ceinture invalide !"; exit();
	}
	$teacher = $resultkarateka[teacher] ? "Oui" : "Non" ;
	
?>
	<h1>Identité :</h1>
	
	<img src="<?php echo $resultkarateka[urlphoto]; ?>" alt="photo karatéka" height="128" width="128">
	
	<table border=1>
		<tr><td>Nom :		</td><td><?php echo $resultkarateka[lastname]; 	?></td></tr>
		<tr><td>Prénom :	</td><td><?php echo $resultkarateka[firstname]; ?></td></tr>
		<tr><td>Poids :		</td><td><?php echo $resultkarateka[weight]; 	?></td></tr>
		<tr><td>Taille :	</td><td><?php echo $resultkarateka[height]; 	?></td></tr>
		<tr><td>Ceinture :	</td><td><?php echo $belt; 						?></td></tr>
		<?php if ($belt == "Noire"){ ?>
		<tr><td>Dans :		</td><td><?php echo $resultkarateka[dans];		?></td></tr>
		<?php } ?>
		<tr><td>Club :		</td><td><?php echo $resultkarateka[clubname]; 	?></td></tr>
		<tr><td>Professeur :</td><td><?php echo $teacher; 					?></td></tr>
	</table>
	
<?php

	$request = "SELECT * FROM competition c INNER JOIN participate p ON c.id = p.competition WHERE idk = $karateka;";
	if ( !($result = pg_query($vConnect, $request)) ) {
		echo pg_last_error() ;
		exit();
	}
?>

	<h1>Compétitions auxquelles <?php echo $resultkarateka[lastname]." ".$resultkarateka[firstname]; ?> a participé :</h1>

	<table border=1>
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
	</table>
	
<?php

	$request = "SELECT kata FROM masteries WHERE karateka = $karateka;";
	if ( !($result = pg_query($vConnect, $request)) ) {
		echo pg_last_error() ;
		exit();
	}
?>

	<h1>Katas maîtrisés :</h1>

	<table border=1>
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
	</table>
	
	
	
<?php
	pg_close($vConnect);
}
