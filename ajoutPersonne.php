<?php
$titre = "Ajout d'une Personne"
include 'includes/header.php' ;

if($_POST['is_karateka'] == NULL && $_POST['is_dirigeant'] == NULL){
	include 'includes/formulaires/ajoutKarateka.php';
} else {
	$erreur += verifier_arguments(['nom','prenom']);
	if($_POST['is_karateka'] != NULL){
		$erreur+= verifier_arguments(['photo','poids','taille','ceinture']);
		if($_POST['ceinture'] == 'noire'){
			$erreur+= verifier_arguments(['dans']);
		}
	} elseif ($_POST['is_dirigeant'] != NULL) {
		$erreur += verifier_arguments['email','tel'] ;
	} else {
		$erreur += 'Une Personne ne peut pas être ni dirigeante ni Karatéka';
	}

	if($erreur){
		echo $erreur;
		include 'includes/formulaires/ajoutKarateka.php';
	} else {
		//traitement du formulaire etc.
	}

}