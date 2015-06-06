<?php

$title = "Affichage des photos d'une compétition" ;
include 'includes/header.php' ;

if (empty($_POST))
	include 'includes/Formulaires/viewPhotoCompetForm.php';

else{
	if (empty($_POST['competition'])){
		echo "Compétition non fournie...";
		exit();
	}
	$competition = $_POST['competition'];
	
	$vConnect = Connect();
	
	$request = "SELECT name FROM competition WHERE id = $competition;";
	if ( !($result = pg_query($vConnect, $request)) ) {
		echo pg_last_error() ;
		exit();
	}
	
	$nomCompet = pg_fetch_array($result);
	if ( !($nomCompet) ) {
		echo pg_last_error() ;
		exit();
	}
?>

	<h1>Photos de la compétition &laquo; <?php echo $nomCompet[name]; ?> &raquo; :</h1>
	
	
<?php
	$request = "SELECT url FROM competitionphoto WHERE competition = $competition;";
	if ( !($result = pg_query($vConnect, $request)) ) {
		echo pg_last_error() ;
		exit();
	}
	while($listphotos = pg_fetch_array($result)){ ?>
	<img alt="photocompet" src="<?php echo $listphotos[url]; ?>" />
	
<?php }
	pg_close($vConnect);
}
