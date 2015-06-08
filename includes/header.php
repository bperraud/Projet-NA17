<?php 
	include_once 'connect.php';
	include_once 'fonctions.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo $title; ?></title>
</head>
<body>

	<header>
		<nav>
			<ul>
				<li><a href="import.php">Importer les fichiers CSV</a> </li>
				<br/>
				<li><a href="ajoutPersonne.php">Ajouter une Personne</a></li>
				<li><a href="ajoutMaitrises.php">Ajouter une Maitrise à un Karatéka</a></li>
				<br />
				<li><a href="ajoutClub.php">Ajouter un club</a></li>
				<li><a href="ajoutCompetition.php">Ajouter une compétition</a></li>
				<br />
				<li><a href="ajoutPhotoCompet.php">Ajouter des photos à une compétition</a></li>
				<li><a href="viewPhotoCompet.php">Voir les photos d'une compétition</a></li>
				<br />
				<li><a href="viewKarateka.php">Accéder à la description d'un karatéka</a></li>
				<br />
				<li><a href="inscriptionClub.php">Inscrire un karatéka à un club</a></li>
				<li><a href="inscriptionCompetition.php">Inscrire un karatéka à une compétition</a></li>
				<li><a href="ajoutRegle.php">Ajout d'une règle à une compétition</a></li>
				<br />
				<li><a href="creerConfrontation.php">Créer une confrontation</a></li>
				<li>etc.</li>
			</ul>
		</nav>
	</header>