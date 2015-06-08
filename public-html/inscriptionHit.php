<?php

$title = "Inscription d'un karatéka à une compétition" ;
include 'connect.php' ;

if(empty($_POST))
include 'includes/header.php' ;
else{
echo $_POST['competition'];
?>
<meta HTTP-EQUIV="Refresh" content="0;URL=viewCompetition.php?id=<?php echo $_POST['competition']; ?>"/><?php
	if (empty($_POST['category'])){
		echo "karateka non fourni...";
		exit();
	}
	if (empty($_POST['points'])){
		echo "competition non fournie...";
		exit();
	}
	$category = $_POST['category'];
	$points = $_POST['points'];
	$competition = $_POST['competition'];
	
	$vConnect = Connect();
	
	
	echo "inscription d'un karatéka...";
	$request = "INSERT INTO rule (competition,category,points) VALUES ($competition, $category,$points);";
	if( !($result = pg_query($vConnect, $request)) ) {
		echo pg_last_error() ;
		exit();
	}
	echo "ok ! <br />";
	pg_close($vConnect);
}
