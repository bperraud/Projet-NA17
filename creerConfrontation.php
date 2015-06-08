<?php
//vérification intégrité du type de confrontation

include	'includes/fonctions.php';

inserer_header("Créer une confrontation");

if ( !isset($_GET['type']) && empty($_POST)) {

	include 'includes/Formulaires/creerConfrontationForm_nbrKarateka.php';

} elseif ( empty($_POST) ) {

	$type = $_GET['type'];
	if($type == "kumite"){
		$nbr_karateka = 2;
	} else {
		$nbr_karateka = $_GET['nbr_karateka'];
	}
	include 'includes/Formulaires/creerConfrontationForm_selection_competition.php';

} elseif ( isset($_POST['competition_selection']) ) {
	$nbr_karateka = $_POST['nbr_karateka'];
	switch ($_POST['type'] ) {
	case 'kumite' :
		$type = 'kumite';
	break;
	case 'tamashi wari' :
		$type = 'tw';
	break;
	case 'kata' :
		$type = 'kata' ;
	break;
	default :
		echo "erreur : type incorrect";
		exit();
	break;
	}
	$competition = $_POST['competition_selection'];
	include 'includes/Formulaires/creerConfrontationForm.php' ;
} else {
	//var_dump($_POST);

	$nbr_karateka = $_POST['nbr_karateka'];

	for ($i=0; $i < $nbr_karateka; $i++) {
		if (!isset($_POST['karateka'.$i]) || !isset($_POST['points'.$i])) {
			echo "erreur dans la saisie des karatekas ou des points";
			exit();
		}
		$points[$i] = $_POST['points'.$i];
		$karatekas[$i] = $_POST['karateka'.$i];
	}
	if( verifier_doublons($karatekas) ) {
		echo "erreur : il existe des doublons dans les karatekas selectionnés";
		exit();
	}

	echo "insertion competition...";
	$request = "INSERT INTO confrontation (competition)
				VALUES ($_POST[competition])
					RETURNING id;";
	$vConnect = Connect();
	if( !($result = pg_query($vConnect, $request)) ) {
			echo pg_last_error() ;
			exit();
		}
	$id_confrontation = pg_fetch_array($result, null, PGSQL_ASSOC);
	$id_confrontation = $id_confrontation['id'];

	/*if ($_POST['type'] = 'tamashi wari') {
		$type = 'tw';
	} else {
		$type = $_POST['type'];
	}*/

	switch ($_POST['type'] ) {
	case 'kumite' :
		$type = 'kumite';
	break;
	case 'tamashi wari' :
		$type = 'tw';
	break;
	case 'kata' :
		$type = 'kata' ;
	break;
	default :
		echo "erreur : type incorrect";
		exit();
	break;
	}

	$request = 'INSERT into confrontation'.$type.' (confrontation)
				VALUES ('.$id_confrontation.');';
	if ( !pg_query($vConnect, $request) ){
		echo pg_last_error();
		exit;
	}


	for ($i=0; $i < $nbr_karateka; $i++) {
		$array = ["confrontation" => $id_confrontation,
				  "karateka" => $karatekas[$i],
				  "points" => $points[$i]
				 ] ;
		//echo "karateka $i : <br/>";
		//var_dump($array);
		pg_insert($vConnect, 'participation', $array);
	}

	echo "ok ! ($nbr_karateka participations enregistrées <br />";
}