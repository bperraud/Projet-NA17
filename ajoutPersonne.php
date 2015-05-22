<?php
/**
 * Empêcher création de deux mec du même nom
 * protéger première requête
 */

$title = "Ajout d'une Personne" ;
include 'includes/header.php' ;

if(!isset($_POST['nom']) && !isset($_POST['prenom'])){
	include 'includes/Formulaires/ajoutKarateka.php';
} else {
	$erreur = verifier_arguments(['nom','prenom']);

	if( isset($_POST['is_karateka']) ){
		$erreur.= verifier_arguments(['poids','taille','ceinture']);
		if($_POST['ceinture'] == 'black'){
			$erreur.= verifier_arguments(['dans']);
		} else {
			$_POST['dans'] == 0;
		}
		if ( isset($_FILES['photo']) ) {
			//vérification de la photo
			$fichier = basename($_FILES['photo']['name']);
			$taille_maxi = 100000;
			$taille = filesize($_FILES['photo']['tmp_name']);
			$extensions = array('.png', '.gif', '.jpg', '.jpeg');
			$extension = strrchr($_FILES['photo']['name'], '.'); 
			//Début des vérifications de sécurité...
			if(!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
			{
			     $erreur .= 'Vous devez uploader un fichier de type png, gif, jpg.<br />';
			}
			if($taille>$taille_maxi)
			{
			     $erreur .= 'Le fichier est trop gros... <br />';
			}
		} else {
			$erreur .= 'Photo obligatoire <br />';
		}
	} elseif ( isset($_POST['is_dirigeant']) ) {
		$erreur .= verifier_arguments(['email','tel']) ;
	} else {
		$erreur .= 'Une Personne ne peut pas être ni dirigeante ni Karatéka';
	}

	if($erreur){
		echo $erreur;
		include 'includes/Formulaires/ajoutKarateka.php';
	} else {
		echo "insertion d'une personne...";
		$vConnect = Connect();
		$request = 'INSERT INTO person (firstname, lastname)
					VALUES (\''.$_POST['prenom'].'\', \''.$_POST['nom'].'\')
					RETURNING id;' ;
		if( !($result = pg_query($vConnect, $request)) ) {
			echo pg_last_error() ;
			exit();
		}
		$id_personne = pg_fetch_array($result, null, PGSQL_ASSOC);
		$id_personne = $id_personne['id'];

		echo "ok ! <br />" ;
		
		if ( isset($_POST['is_dirigeant']) ) {
			echo "insertion d'un dirigeant... ";
			$array = [
				'id' => $id_personne,
				'mail' => $_POST['email'],
				'phone' => $_POST['tel']
			] ;
			if ( !pg_insert( $vConnect, 'leader', $array) ) {
				echo pg_last_error();
				exit();
			}
			echo "ok ! <br />" ;
		}
		if ( isset($_POST['is_karateka']) ) {
			echo "insertion d'un karateka...";
			//On formate le nom du fichier ici...
		    $fichier = strtr($fichier, 
		          'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 
		          'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
		    $fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);
		    $emplacement = 'photo_karateka/'.time().$fichier;
		    if(move_uploaded_file($_FILES['photo']['tmp_name'], $emplacement))
		    {
		        echo 'Upload effectué avec succès !';
		    } else //Sinon (la fonction renvoie FALSE).
		    {
		        echo 'Echec de l\'upload !';
		        exit();
		    }
			$array = [
				'id' => $id_personne,
				'urlphoto' => $emplacement,
				'weight' => $_POST['poids'],
				'height' => $_POST['taille'],
				'belt' => $_POST['ceinture'],
				'dans' => $_POST['dans']
			] ;
			if ( !pg_insert( $vConnect, 'karateka', $array) ) {
				echo pg_last_error();
				exit();
			}
			echo "ok ! <br />" ;
		}
		pg_close($vConnect);
	}

}