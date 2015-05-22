<?php
/**
 * vérification donnée de l'id dirigeant
 * dirigeant club, 1..1 ou 1..N ?
 */

$title = "Ajout d'un Club" ;
include 'includes/header.php' ;

if(!isset($_POST['name']) || !isset($_POST['website']) || !isset($_POST['leader']) ){
	include 'includes/Formulaires/ajoutClub.php';
} else {
	
	echo "insertion club... ";
	$vConnect = Connect();
	if ( !pg_insert( $vConnect, 'club', $_POST) ) {
		echo pg_last_error();
		exit();
	}
	echo "ok !" ;
}