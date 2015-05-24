<?php

$title = "Importer un fichier csv" ;
include 'includes/header.php' ;

if (strtolower($_SERVER['REQUEST_METHOD']) != 'post'){
	include 'includes/Formulaires/importKataForm.php';
	//include 'includes/Formulaires/importMovForm.php';
}

else{
	if (isset($_FILES['katafamily'])){
	//vérification du fichier
		$fichier = basename($_FILES['katafamily']['name']);
		$taille_maxi = 100000;
		$taille = filesize($_FILES['katafamily']['tmp_name']);
		$extensions = array('.csv');
		$extension = strrchr($_FILES['katafamily']['name'], '.'); 
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
		$emplacement = 'fichier_csv/'.time().$fichier;
		if(move_uploaded_file($_FILES['katafamily']['tmp_name'], $emplacement))
			echo 'Upload du fichier des familles de kata effectué avec succès !<br />';
		else{ //Sinon (la fonction renvoie FALSE)
			echo 'Echec de l\'upload du fichier des familles de kata !';
			exit();
		}
		
		//Ajout dans la BDD
		$vConnect = Connect();
		$fullpath = str_replace('\\', '/', getcwd()).'/'.$emplacement;
		$request = "COPY katafamily FROM '$fullpath' HEADER DELIMITER ';' CSV;";
		if(!($result = pg_query($vConnect, $request))){
			echo pg_last_error();
			exit();
		}
		pg_close($vConnect);
	}
	else{
		echo "erreur : fichier de familles de kata obligatoire";
		exit();
	}
	
	if (isset($_FILES['kata'])){
	//vérification du fichier
		$fichier = basename($_FILES['kata']['name']);
		$taille_maxi = 100000;
		$taille = filesize($_FILES['kata']['tmp_name']);
		$extensions = array('.csv');
		$extension = strrchr($_FILES['kata']['name'], '.'); 
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
		$emplacement = 'fichier_csv/'.time().$fichier;
		if(move_uploaded_file($_FILES['kata']['tmp_name'], $emplacement))
			echo 'Upload du fichier des katas effectué avec succès !';
		else{ //Sinon (la fonction renvoie FALSE)
			echo 'Echec de l\'upload du fichier des katas !';
			exit();
		}
		
		//Ajout dans la BDD
		$vConnect = Connect();
		$fullpath = str_replace('\\', '/', getcwd()).'/'.$emplacement;
		$request = "COPY kata FROM '$fullpath' HEADER DELIMITER ';' CSV;";
		if(!($result = pg_query($vConnect, $request))){
			echo pg_last_error();
			exit();
		}
		pg_close($vConnect);
	}
	else{
		echo "erreur : fichier des katas obligatoire";
		exit();
	}
}