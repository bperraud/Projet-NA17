<?php

$title = "Changement status" ;
include 'connect.php' ;

if(empty($_POST)) {

include 'includes/header.php' ;
} else {?>

<meta HTTP-EQUIV="Refresh" content="0;URL=viewCompetition.php?id=<?php echo $_POST['competition']; ?>"/><?php
		$vConnect = Connect();
	$request = "SELECT k.id FROM vkarateka k, participate p WHERE k.id = p.idk AND p.competition = $_POST[competition];";
	if ( !($resultkata = pg_query($vConnect, $request)) ) {
		echo pg_last_error() ;
		exit();
	}
		$request = "SELECT c.* FROM competition c WHERE c.id = $_POST[competition];";
	if ( !($resultcompet = pg_query($vConnect, $request)) ) {
		echo pg_last_error() ;
		exit();
	}
			
		$karas = array();
		while($kara = pg_fetch_array($resultkata))
		{
			array_push($karas,$kara['id']);
		}
		
		$compet = pg_fetch_array($resultcompet);
	
		$confrontations_quart=array('competition' => $_POST['competition'],'round' => "quart",'statut' => 'en cours');
		$confrontations_demi=array('competition' => $_POST['competition'],'round' => "demi",'statut' => 'en cours');
		$confrontations_final=array('competition' => $_POST['competition'],'round' => "final",'statut' => 'en cours');
		for($j=0;$j<4;$j++){
			pg_insert($vConnect, 'confrontation', $confrontations_quart);
		}		
		for($j=0;$j<2;$j++){
			pg_insert($vConnect, 'confrontation', $confrontations_demi);
		}		
		pg_insert($vConnect, 'confrontation', $confrontations_final);
		$request = "SELECT c.id FROM confrontation c WHERE c.competition = $_POST[competition]";
		if ( !($result = pg_query($vConnect, $request)) ) {
		echo pg_last_error() ;
		exit();
	}
		$i=0;
		
	
			switch($compet['type'])
			{
				case 'kumite':
				while($conf = pg_fetch_array($result)){
				pg_insert($vConnect,'confrontationkumite',array('confrontation' =>$conf['id']));
				}
				break;
				case 'tamashi wari' :
				while($conf = pg_fetch_array($result)){
				pg_insert($vConnect,'confrontationtw',array('confrontation' =>$conf['id']));}
				break;
				case 'kata' :
				while($conf = pg_fetch_array($result)){
				pg_insert($vConnect,'confrontationkata',array('confrontation' =>$conf['id']));}
				break;
				case 'kata' :
				while($conf = pg_fetch_array($result)){
				$type = rand(0,2);
				switch($type)
				{
					case 0 :
					pg_insert($vConnect,'confrontationkata',array('confrontation' =>$conf['id']));
					break;					
					case 1 :
					pg_insert($vConnect,'confrontationtw',array('confrontation' =>$conf['id']));
					break;					
					case 2 :
					pg_insert($vConnect,'confrontationkumite',array('confrontation' =>$conf['id']));
					break;
				}
				}
				break;
			}
		
		$request = "SELECT c.id FROM confrontation c WHERE c.competition = $_POST[competition] AND c.round = 'quart';";
		if ( !($resultquart = pg_query($vConnect, $request)) ) {
		echo pg_last_error() ;
		exit();
		}
		while($quart = pg_fetch_array($resultquart))
		{
			$data1 = array('confrontation' => $quart['id'],'karateka' => $karas[$i],'points'=>0);
			$i += 1;
			$data2 = array('confrontation' => $quart['id'],'karateka' => $karas[$i],'points'=>0);
			$i += 1;
			pg_insert($vConnect,'participation',$data1);
			pg_insert($vConnect,'participation',$data2);
		}
		
		$request = "UPDATE competition SET statut='en cours/quart' WHERE competition.id = $_POST[competition];";
		if ( !($resultup = pg_query($vConnect, $request)) ) {
		echo pg_last_error() ;
		exit();
		}
		
		pg_close($vConnect);

}
