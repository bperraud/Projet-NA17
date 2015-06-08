<?php

$title = "Ajout d'une Règle" ;
include 'includes/header.php' ;

if(!isset($_POST['category']) || !isset($_POST['competition']) || !isset($_POST['points']) ){
	include 'includes/Formulaires/ajoutRegleForm.php';
} else {
	echo "insertion règle... ";
	$vConnect = Connect();
	if ( !pg_insert( $vConnect, 'club', $_POST) ) {
		echo pg_last_error();
		exit();
	}
	echo "ok !" ;
}