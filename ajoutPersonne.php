<?php
$titre = "Ajout d'une Personne" ;
include 'includes/header.php' ;

if(!isset($_POST['nom']) && !isset($_POST['prenom'])){
	include 'includes/Formulaires/ajoutKarateka.php';
} else {
	$erreur = verifier_arguments(['nom','prenom']);

	if(!isset($_POST['is_karateka'])){
		$erreur.= verifier_arguments(['photo','poids','taille','ceinture']);
		if($_POST['ceinture'] == 'noire'){
			$erreur.= verifier_arguments(['dans']);
		}
	} elseif ($_POST['is_dirigeant'] != NULL) {
		$erreur .= verifier_arguments(['email','tel']) ;
	} else {
		$erreur .= 'Une Personne ne peut pas être ni dirigeante ni Karatéka';
	}

	if($erreur){
		echo $erreur;
		include 'includes/Formulaires/ajoutKarateka.php';
	} else {
		echo "JOUA ET ALLEGRESSE";
		// Requêtes SQL à faire
	}

}