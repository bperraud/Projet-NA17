<?php

$title = "Ajout d'une Maitrise" ;
include 'connect.php' ;

if(empty($_POST)) {

include 'includes/header.php' ;
} else {?>
<meta HTTP-EQUIV="Refresh" content="0;URL=viewKarateka.php?id=<?php echo $_POST['karateka']; ?>"/><?php
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

}
