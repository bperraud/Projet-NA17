<?php
/**
 * vérification donnée de l'id dirigeant
 * dirigeant club, 1..1 ou 1..N ?
 */
 include 'connect.php' ;
$title = "Ajout d'un Club" ;
include 'includes/header.php' ;
	$insert= false;
	$display = false;
if(!isset($_POST['name']) || !isset($_POST['website']) || !isset($_POST['leader']) ){
	include 'includes/Formulaires/ajoutClub.php';
} else {
$display = true;
	$vConnect = Connect();
	if ( !pg_insert( $vConnect, 'club', $_POST) ) {
		$result = pg_last_error();
	}else{
	$result = "insertion club ok !";
	$insert = true;
	}

}

if($display){
?>
	 <section class="bg-default" id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 text-center">	
				<?php if($insert){?>
				<div class="alert alert-success"><?php echo $result?></div>
				<?php }else{ ?>
				<div class="alert alert-danger"><?php echo $result?></div>
				<?php }  ?>	</div></div></div></section>
<?php } ?>
