<?php
/**
 * retourne NULL si tous les arguments sont remplis.
 */
function verifier_arguments($array){
	foreach($array as $param){
		if($_POST[$param] == NULL){
			$erreur += 'Erreur : le champ '.$param.' n\est pas renseigné est obligatoire.<br />';
		}
	}
	return $erreur;
}
