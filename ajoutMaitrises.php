<?php

$title = "Ajout d'une Maitrise" ;
include 'includes/header.php' ;

if(empty($_POST)) {
	include 'includes/Formulaires/ajoutMaitrisesForm.php';
} else {
	if( ($erreur = verifier_arguments(['karateka', 'kata'])) == NULL) {
		echo "ajout d'une maitrise... ";
		$vConnect = Connect();

		// verification si le karateka ne maitrise pas déjà le kata
		if( pg_select($vConnect, 'masteries', $_POST) ) {
			echo "erreur, le karateka maitrise déjà le kata" ;
			exit();
		}

		if( !($result = pg_insert($vConnect, 'masteries', $_POST)) ) {
			echo pg_last_error() ;
			exit();
		}
		echo "ok ! <br />";
		pg_close($vConnect);
	} else {
		echo $erreur;
		exit();
	}
}
