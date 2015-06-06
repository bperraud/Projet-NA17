<?php

$title = "Ajouter des photos à une compétition" ;
include 'includes/header.php' ;

if (strtolower($_SERVER['REQUEST_METHOD']) != 'post'){
	include 'includes/Formulaires/ajoutPhotoCompetForm.php';
}

else{
	if (empty($_POST['competition'])){
	echo "compétition non fournie...";
	exit();
	}
	$competition = $_POST['competition'];
	
	if (isset($_FILES['photo'])){
		//vérification du fichier
		$fichier = basename($_FILES['photo']['name']);
		$taille_maxi = 100000;
		$taille = filesize($_FILES['photo']['tmp_name']);
		$extensions = array('.png', '.gif', '.jpg', '.jpeg');
		$extension = strrchr($_FILES['photo']['name'], '.'); 
		
		//Début des vérifications de sécurité...
		if(!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
		{
			echo "extension non reconnue";
			exit();
		}
		if($taille>$taille_maxi)
		{
			echo "fichier trop volumineux...";
			exit();
		}
		
		//On formate le nom du fichier ici...
		$fichier = strtr($fichier, 
			  'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 
			  'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
		$fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);
		$emplacement = 'photo_compet/'.time().$fichier;
		if(move_uploaded_file($_FILES['photo']['tmp_name'], $emplacement))
			echo 'Upload de la photo effectué avec succès !<br />';
		else{ //Sinon (la fonction renvoie FALSE)
			echo 'Echec de l\'upload de la photo !';
			exit();
		}
		
		//Ajout dans la BDD
		$vConnect = Connect();
		$fullpath = str_replace('\\', '/', getcwd()).'/'.$emplacement;

		$request = "INSERT INTO competitionphoto VALUES ($competition, '$emplacement');";
		if(!($result = pg_query($vConnect, $request))){
			echo pg_last_error();
			exit();
		}

		pg_close($vConnect);
		
		//Ajout de plusieurs photos ou non
		$addmore = false;
		foreach($_POST['addmore'] as $valeur){ $addmore = $valeur; }
		
		if ($addmore) include 'includes/Formulaires/ajoutPhotoCompetForm.php';
		
	}
	else{
		echo "erreur : photo non fournie !";
		exit();
	}



}