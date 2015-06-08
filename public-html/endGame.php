<?php

include 'connect.php' ;

if(empty($_POST)) {

include 'includes/header.php' ;
} else {?>

<meta HTTP-EQUIV="Refresh" content="0;URL=viewCompetition.php?id=<?php echo $_POST['competition']; ?>"/><?php
		$vConnect = Connect();
		$request = "UPDATE confrontation SET statut='fin' WHERE id=$_POST[confrontation]";
		if ( !($resultpoints = pg_query($vConnect, $request)) ) {
		echo pg_last_error() ;
		exit();
	}
		pg_close($vConnect);

}
