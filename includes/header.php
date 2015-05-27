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
				<li><a href="import.php">Importer un fichier CSV</a> </li>
				<li><a href="ajoutPersonne.php">Ajouter une Personne</a></li>
				<li><a href="ajoutMaitrises.php">Ajouter une Maitrise à un Karatéka</a></li>
				<li><a href="inscriptionClub.php">Inscrire un karatéka à un club</a></li>
				<li><a href="inscriptionCompetition.php">Inscrire un karatéka à une compétition</a></li>
				<li><a href="ajoutClub.php">Ajouter un club</a></li>
				<li><a href="ajoutCompetition.php">Ajouter une compétition</a></li>
				<li>etc.</li>
			</ul>
		</nav>
	</header>