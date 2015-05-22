<?php
$title = "Ajout d'une Personne" ;
include 'includes/header.php' ;

if(!isset($_POST['nom']) && !isset($_POST['prenom'])){
	include 'includes/Formulaires/ajoutKarateka.php';
} else {
	$erreur = verifier_arguments(['nom','prenom']);

	if( isset($_POST['is_karateka']) ){
		$erreur.= verifier_arguments(['photo','poids','taille','ceinture']);
		if($_POST['ceinture'] == 'noire'){
			$erreur.= verifier_arguments(['dans']);
		}
	} elseif ( isset($_POST['is_dirigeant']) ) {
		$erreur .= verifier_arguments(['email','tel']) ;
	} else {
		$erreur .= 'Une Personne ne peut pas être ni dirigeante ni Karatéka';
	}

	if($erreur){
		echo $erreur;
		include 'includes/Formulaires/ajoutKarateka.php';
	} else {
		echo "JOUA ET ALLEGRESSE";
		$vconnect = Connect();
		$request = 'INSERT INTO person (firstname, lastname)
					VALUES (\''.$_POST['prenom'].'\', \''.$_POST['nom'].'\');' ;
		if( pg_query($vconnect, $request) == false ) {
			echo "erreur du con" ;
			exit();
		}

		if ( isset($POST['is_dirigeant']) ) {

		}
	}

}