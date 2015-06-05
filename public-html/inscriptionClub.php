<?php
$title = "Inscription d'un karatéka à un club" ;

include 'connect.php' ;
if(empty($_POST)){
include 'includes/header.php' ;
	include 'includes/Formulaires/inscriptionClubForm.php';}

else{
?><meta HTTP-EQUIV="Refresh" content="0;URL=viewKarateka.php?id=<?php echo $_POST['karateka']; ?>"/><?php
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
	header('Location : index.php');
}
