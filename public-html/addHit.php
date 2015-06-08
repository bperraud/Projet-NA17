<?php

$title = "Ajout d'une Maitrise" ;
include 'connect.php' ;

if(empty($_POST)) {

include 'includes/header.php' ;
} else {?>

<meta HTTP-EQUIV="Refresh" content="0;URL=viewCompetition.php?id=<?php echo $_POST['competition']; ?>"/><?php
		$vConnect = Connect();
		$request = "SELECT p.points FROM participation p,vkarateka k,confrontation c WHERE p.confrontation = $_POST[confrontation] AND k.id = $_POST[karateka]";
		if ( !($resultpoints = pg_query($vConnect, $request)) ) {
		echo pg_last_error() ;
		exit();
	}
	$pointsJ = pg_fetch_array($resultpoints);
			$request = "SELECT r.points FROM rule r WHERE r.category = $_POST[hit] AND r.competition = $_POST[competition]";
		if ( !($resultpoints = pg_query($vConnect, $request)) ) {
		echo pg_last_error() ;
		exit();
	}
	$pointsWin = pg_fetch_array($resultpoints);
	$pointsJ['points'] += $pointsWin['points'];
	$request = "UPDATE participation SET points=$pointsJ[points] WHERE karateka = $_POST[karateka] AND confrontation = $_POST[confrontation]";
			if ( !(pg_query($vConnect, $request)) ) {
		echo pg_last_error() ;
		exit();
	}
		$data=array('confrontation' => $_POST['confrontation'],'karateka'=>$_POST['karateka'],'hit'=>$_POST['hit']);
		pg_insert($vConnect, 'hitdone', $data);
		pg_close($vConnect);

}
