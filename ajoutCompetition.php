<?php
/**
 * vérification donnée de l'id club
 */

$title = "Ajout d'un Club" ;
include 'includes/header.php' ;

if(!isset($_POST['organisator']) ){
	include 'includes/Formulaires/ajoutCompetition.php';
} else {
	//print_r($_POST);
	$erreur = verifier_arguments(['name','date','place','type','organisator']);
	echo "insertion competition... ";
	
	$vConnect = Connect();
	if ( !pg_insert( $vConnect, 'competition', $_POST) ) {
		echo pg_last_error();
		exit();
	}
	
	$vConnect = Connect();

	echo "ok !" ;
}

