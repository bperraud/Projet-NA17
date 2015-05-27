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

function inserer_header($title) {
	include '/includes/header.php';
}