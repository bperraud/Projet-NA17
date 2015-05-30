<?php

$title = "Inscription d'un karatéka à une compétition" ;
include 'includes/header.php' ;

if(empty($_POST))
	include 'includes/Formulaires/inscriptionCompetitionForm.php';

else{
	if (empty($_POST['karateka'])){
		echo "karateka non fourni...";
		exit();
	}
	if (empty($_POST['competition'])){
		echo "competition non fournie...";
		exit();
	}
	$karateka = $_POST['karateka'];
	$competition = $_POST['competition'];
	
	$vConnect = Connect();
	
	$request = "SELECT * FROM participate WHERE idk = $karateka AND competition = $competition;";
	if( !($result = pg_query($vConnect, $request)) ) {
		echo pg_last_error() ;
		exit();
	}
	if(pg_fetch_array($result)){
		echo "Erreur, karatéka déjà inscrit à cette compétition !";
		exit();
	}
	
	echo "inscription d'un karatéka...";
	$request = "INSERT INTO participate (idk, competition) VALUES ($karateka, $competition);";
	if( !($result = pg_query($vConnect, $request)) ) {
		echo pg_last_error() ;
		exit();
	}
	echo "ok ! <br />";
	pg_close($vConnect);
}
