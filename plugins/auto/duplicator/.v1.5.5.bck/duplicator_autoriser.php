<?php

/***************************************************************************\
 * Plugin Duplicator pour Spip 3.0
 * Licence GPL (c) 2010-2014 - Apsulis
 * Duplication de rubriques et d'articles
 *
\***************************************************************************/


function duplicator_autoriser(){}

/*function autoriser_dupliquer($faire, $type='', $id=0, $qui = NULL, $opt = NULL){
	return true;
}*/

function autoriser_rubrique_dupliquer($faire, $type='', $id=0, $qui = NULL, $opt = NULL){

	// Si la config permet de dupliquer les rubriques
	if (strcmp(lire_config('duplicator/config/duplic_rubrique'),'oui') == 0){
		
		// Le webmestre peut dupliquer les rubriques
		if(autoriser("webmestre"))
			return true;
			
		// Administrateur
		if ( (strcmp($qui['statut'], '0minirezo') == 0) AND 
				((strcmp(lire_config('duplicator/config/duplic_rubrique_autorisation'),"0minirezo") == 0) OR
				 (strcmp(lire_config('duplicator/config/duplic_rubrique_autorisation'),"1comite")   == 0)) )
			return true;
			
		// Rédacteur
		if (( strcmp($qui['statut'], '1comite') == 0) AND (strcmp(lire_config('duplicator/config/duplic_rubrique_autorisation'),'1comite') == 0 ))
			return true;

	}
	return false;

}

function autoriser_article_dupliquer($faire, $type='', $id=0, $qui = NULL, $opt = NULL){

	// Si la config permet de dupliquer les articles
	if (strcmp(lire_config('duplicator/config/duplic_article'),'oui') == 0){
		
		// Le webmestre peut dupliquer les articles
		if(autoriser("webmestre"))
			return true;
			
		// Administrateur
		if ( (strcmp($qui['statut'], '0minirezo') == 0) AND 
				((strcmp(lire_config('duplicator/config/duplic_article_autorisation'),"0minirezo") == 0) OR
				 (strcmp(lire_config('duplicator/config/duplic_article_autorisation'),"1comite")   == 0)) )
			return true;
			
		// Rédacteur
		if (( strcmp($qui['statut'], '1comite') == 0) AND (strcmp(lire_config('duplicator/config/duplic_article_autorisation'),'1comite') == 0 ))
			return true;

	}
	return false;

}