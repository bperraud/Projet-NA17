<?php

$title = "Inscription d'un karatéka à un club" ;
include 'includes/header.php' ;

if(empty($_POST))
	include 'includes/Formulaires/inscriptionClubForm.php';

else{
	if (empty($_POST['karateka'])){
		echo "karateka non fourni...";
		exit();
	}
	if (empty($_POST['club'])){
		echo "club non fourni...";
		exit();
	}
	$karateka = $_POST['karateka'];
	$club = $_POST['club'];
	echo "inscription d'un karatéka...";
	$vConnect = Connect();
	$request = "UPDATE karateka SET clubname = '$club' WHERE id = $karateka";
	if( !($result = pg_query($vConnect, $request)) ) {
		echo pg_last_error() ;
		exit();
	}
	echo "ok ! <br />";
	pg_close($vConnect);
}
