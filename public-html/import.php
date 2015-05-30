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

		$request = "COPY katafamily FROM stdin HEADER DELIMITER ';' CSV;";
		if(!($result = pg_query($vConnect, $request))){
			echo pg_last_error();
			exit();
		}
		foreach (file($fullpath) as $line) {
			pg_put_line($vConnect, $line);
		}
		pg_end_copy($vConnect);
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
			echo 'Upload du fichier des katas effectué avec succès ! <br />';
		else{ //Sinon (la fonction renvoie FALSE)
			echo 'Echec de l\'upload du fichier des katas !';
			exit();
		}
		
		//Ajout dans la BDD
		$vConnect = Connect();
		$fullpath = str_replace('\\', '/', getcwd()).'/'.$emplacement;
		$request = "COPY kata FROM stdin HEADER DELIMITER ';' CSV;";
		if(!($result = pg_query($vConnect, $request))){
			echo pg_last_error();
			exit();
		}
		foreach (file($fullpath) as $line) {
			pg_put_line($vConnect, $line);
		}
		pg_end_copy($vConnect);
		pg_close($vConnect);
	}
	else{
		echo "erreur : fichier des katas obligatoire";
		exit();
	}

	if (isset($_FILES['karatemov'])){
		//vérification du fichier
		$fichier = basename($_FILES['karatemov']['name']);
		$taille_maxi = 100000;
		$taille = filesize($_FILES['karatemov']['tmp_name']);
		$extensions = array('.csv');
		$extension = strrchr($_FILES['karatemov']['name'], '.'); 
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
		if(move_uploaded_file($_FILES['karatemov']['tmp_name'], $emplacement))
			echo 'Upload du fichier des mouvements de karaté effectué avec succès !<br />';
		else{ //Sinon (la fonction renvoie FALSE)
			echo 'Echec de l\'upload du fichier des mouvements de karaté !';
			exit();
		}
		
		//Ajout dans la BDD
		$vConnect = Connect();
		$fullpath = str_replace('\\', '/', getcwd()).'/'.$emplacement;

		if (($handle = fopen($fullpath, "r")) !== FALSE) {
			$category = '';
			$subcategory = '';
			$idcategorie = NULL;

			//on traite ligne par ligne le fichier CSV
		    while (($karatemov = fgetcsv($handle, 1000, ";")) != FALSE) { // $karatemov[ 0=>namej, 1=>descfr,2=>categorie,3=>subcat, 4=>url ]
		    	if ($karatemov[2] != $category || $karatemov[3] != $subcategory) { //si on doit changer de catégorie d'insertion
		    		
		    		//mise à jour des variables tampon
		    		$category = $karatemov[2];
		    		$subcategory = $karatemov[3];

		    		//on récupère l'ID correspondant à la catégorie
		    		$request = "SELECT id FROM category WHERE name = '$category' AND subc = '$subcategory'";
		    		$result = pg_query($vConnect, $request);
		    		if( $cat = pg_fetch_assoc($result) ) {
						$idcategorie = $cat['id'];
					} else { // sinon, on crée cette catégorie
						$request = "INSERT INTO category (name, subc)
									VALUES ('$category', '$subcategory')
									RETURNING id;" ;
						if( !($result = pg_query($vConnect, $request)) ) {
							echo pg_last_error() ;
							exit();
						}
						$idcategorie = pg_fetch_array($result, null, PGSQL_ASSOC);
						$idcategorie = $idcategorie['id'];
					}
		    	}
		    	//var_dump($kata);
		    	$array = array(
		    		'namej'=>$karatemov[0],
		    		'namefr'=>$karatemov[1],
		    		'category'=>$idcategorie,
		    		'url'=>$karatemov[4]
		    	);

		    	if( !pg_insert($vConnect, 'karatemov', $array)) {
		    		echo pg_last_error();
		    		exit();
		    	}
		    }
		    fclose($handle);
		}

		pg_close($vConnect);
	}
	else{
		echo "erreur : fichier de mouvements de karaté";
		exit();
	}

	if (isset($_FILES['katamov'])){
		//vérification du fichier
		$fichier = basename($_FILES['katamov']['name']);
		$taille_maxi = 100000;
		$taille = filesize($_FILES['katamov']['tmp_name']);
		$extensions = array('.csv');
		$extension = strrchr($_FILES['katamov']['name'], '.'); 
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
		if(move_uploaded_file($_FILES['katamov']['tmp_name'], $emplacement))
			echo 'Upload du fichier des mouvements de kata effectué avec succès !<br />';
		else{ //Sinon (la fonction renvoie FALSE)
			echo 'Echec de l\'upload du fichier des mouvements de kata !';
			exit();
		}
		
		//Ajout dans la BDD
		$vConnect = Connect();
		$fullpath = str_replace('\\', '/', getcwd()).'/'.$emplacement;

		$vConnect = Connect();
		$fullpath = str_replace('\\', '/', getcwd()).'/'.$emplacement;

		$request = "COPY katamov FROM stdin HEADER DELIMITER ';' CSV;";
		if(!($result = pg_query($vConnect, $request))){
			echo pg_last_error();
			exit();
		}
		foreach (file($fullpath) as $line) {
			pg_put_line($vConnect, $line);
		}
		pg_end_copy($vConnect);
		pg_close($vConnect);
	}
	else{
		echo "erreur : fichier de mouvements de kata obligatoire";
		exit();
	}
}