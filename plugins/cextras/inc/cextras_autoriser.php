<?php
if (!defined("_ECRIRE_INC_VERSION")) return;

// fonction pour le pipeline autoriser
function cextras_autoriser(){}


/**
  * Autorisation de voir un champ extra
  * autoriser('voirextra','auteur_prenom', $id_auteur);
  * -> autoriser_auteur_prenom_voirextra_dist() ...
  */
function autoriser_voirextra_dist($faire, $type, $id, $qui, $opt){
	return true;
}

/**
  * Autorisation de modifier un champ extra
  * autoriser('modifierextra','auteur_prenom', $id_auteur);
  * -> autoriser_auteur_prenom_modifierextra_dist() ...
  */
function autoriser_modifierextra_dist($faire, $type, $id, $qui, $opt){
	return true;
}

?>
