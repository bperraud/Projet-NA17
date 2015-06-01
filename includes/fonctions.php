<?php
/**
 * retourne NULL si tous les arguments sont remplis.
 */
function verifier_arguments($array){
	$erreur = '';
	foreach($array as $param){
		if($_POST[$param] == NULL){
			$erreur .= 'Erreur : le champ '.$param.' n\'est pas renseigné et est obligatoire.<br />';
		}
	}
	return $erreur;
}

/**
 * retourne NULL s'il n'y a aucun doublons, 1 sinon
 */
function verifier_doublons($array){
	$taille = count($array);
	$i = 0;
	$j = 0;

	for ($i=0; $i < $taille - 1 ; $i++) { 
		for ($j=$i + 1 ; $j < $taille ; $j++) { 
			if ($array[$i] == $array[$j]) {
				return 1;
			}
		}
	}

	return NULL;
}


function inserer_header($title) {
	include 'header.php';
}