<?php
/**
 * vérification donnée de l'id club
 */

$title = "Ajout d'un Club" ;
include 'includes/header.php' ;
 include 'connect.php' ;
 
	include 'includes/fonctions.php';

 $display = false;
if(!isset($_POST['organisator']) ){
	include 'includes/Formulaires/ajoutCompetition.php';
	
} else {
	//print_r($_POST);
	$erreur = verifier_arguments('name','date','place','type','organisator');
	$display = true;
	$vConnect = Connect();
	if ( !pg_insert( $vConnect, 'competition', $_POST) ) {
		$result =  pg_last_error();
		$insert = false;

	}else
	{$result =  'insertion competition ok !';$insert = true;}
	
	$vConnect = Connect();

	echo "ok !" ;
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
