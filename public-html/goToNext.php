<?php

$title = "Changement status" ;
include 'connect.php' ;

if(empty($_POST)) {

include 'includes/header.php' ;
} else {?>

<meta HTTP-EQUIV="Refresh" content="0;URL=viewCompetition.php?id=<?php echo $_POST['competition']; ?>"/><?php
		$vConnect = Connect();
		if($_POST['statut'] != "en cours/final"){
		$i=0;
		if($_POST['statut'] == "en cours/quart"){
			$request = "SELECT c.* FROM confrontation c WHERE c.competition = $_POST[competition] AND c.round = 'quart';";
		}
		elseif($_POST['statut'] == "en cours/demi")
		{
			$request = "SELECT c.* FROM confrontation c WHERE c.competition = $_POST[competition] AND c.round = 'demi';";
		}
				
		if ( !($resultquart = pg_query($vConnect, $request)) ) {
		echo pg_last_error() ;
		exit();
		}
		$semifinalist = array();
		while($quart = pg_fetch_array($resultquart)){
				$request = "SELECT MAX(p.points),p.karateka FROM participation p WHERE p.confrontation = $quart[id] GROUP BY p.karateka,p.points ORDER BY p.points DESC";
				if ( !($resultmax = pg_query($vConnect, $request)) ) {
					echo pg_last_error() ;
					exit();
				}
				$winner = pg_fetch_array($resultmax);
				array_push($semifinalist,$winner['karateka']);
		}
		echo $semifinalist[0];
		if($_POST['statut'] == "en cours/quart"){
		$request = "SELECT c.id FROM confrontation c WHERE c.competition = $_POST[competition] AND c.round = 'demi';";
		}
		elseif($_POST['statut'] == "en cours/demi")
		{
		$request = "SELECT c.id FROM confrontation c WHERE c.competition = $_POST[competition] AND c.round = 'final';";
		}
		if ( !($resultdemi = pg_query($vConnect, $request)) ) {
		echo pg_last_error() ;
		exit();
		}
		while($demi = pg_fetch_array($resultdemi))
		{
			$data1 = array('confrontation' => $demi['id'],'karateka' => $semifinalist[$i],'points'=>0);
			$i += 1;
			$data2 = array('confrontation' => $demi['id'],'karateka' => $semifinalist[$i],'points'=>0);
			$i += 1;
			pg_insert($vConnect,'participation',$data1);
			pg_insert($vConnect,'participation',$data2);
		}
		}
		if($_POST['statut'] == "en cours/quart"){
		$request = "UPDATE competition SET statut='en cours/demi' WHERE competition.id = $_POST[competition];";
		}
		elseif($_POST['statut'] == "en cours/demi")
		{
		$request = "UPDATE competition SET statut='en cours/final' WHERE competition.id = $_POST[competition];";
		}
		elseif($_POST['statut'] == "en cours/final")
		{
		$request = "UPDATE competition SET statut='terminé' WHERE competition.id = $_POST[competition];";
		}
		if ( !($resultup = pg_query($vConnect, $request)) ) {
		echo pg_last_error() ;
		exit();
		}
		
		pg_close($vConnect);

}
