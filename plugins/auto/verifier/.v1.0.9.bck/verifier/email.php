<?php

// Sécurité
if (!defined("_ECRIRE_INC_VERSION")) return;

/**
 * Vérifie la validité d'une adresse de courriel.
 * 
 * Les contraintes du mail sont déterminées par le mode de validation
 * En option, on contrôle aussi la disponibilité du mail dans la table des auteurs
 *
 * @param string $valeur
 *   La valeur à vérifier.
 * @param array $options
 *   Un éventuel tableau d'options.
 * @return string
 *   Retourne une chaine vide si c'est valide, sinon une chaine expliquant l'erreur.
 */
function verifier_email_dist($valeur, $options=array()){
	include_spip('inc/filtres');
	if (!is_string($valeur)) {
		return $erreur;
	}

	// Disponibilite des courriels en base AUTEURS
	// Si l'adresse n'est pas disponible, on stoppe tout sinon on continue
	if (!empty($options['disponible']) and !verifier_disponibilite_email($valeur,isset($options['id_auteur'])?$options['id_auteur']:null)){
		return _T('verifier:erreur_email_nondispo', array('email' => echapper_tags($valeur)));
	}

	// Choix du mode de verification de la syntaxe des courriels
	if (empty($options['mode']) or !in_array($options['mode'], array('normal','rfc5322','strict'))){
		$mode = 'normal';
	} else{
		$mode = $options['mode'];
	}

	$fonctions_disponibles = array(
		'normal'  => 'email_valide',
		'rfc5322' => 'verifier_email_rfc5322',
		'strict'  => 'verifier_email_de_maniere_stricte'
	);
	$fonction_verif = $fonctions_disponibles[$mode];

	if (!$fonction_verif($valeur)) {
		return _T('verifier:erreur_email', array('email' => echapper_tags($valeur)));
	} else {
		return '';
	}
}

/**
 * Changement de la RegExp d'origine
 *
 * Respect de la RFC5322 
 *
 * @link (phraseur détaillé ici : http://www.dominicsayers.com/isemail/)
 * @param string $valeur La valeur à vérifier
 * @return boolean Retourne true uniquement lorsque le mail est valide
 */
function verifier_email_rfc5322($valeur){
	// Si c'est un spammeur autant arreter tout de suite
	if (preg_match(",[\n\r].*(MIME|multipart|Content-),i", $valeur)) {
		spip_log("Tentative d'injection de mail : $valeur");
		return false;
	}
	include_spip('inc/is_email');
	foreach (explode(',', $valeur) as $adresse) {
		if (!is_email(trim($adresse))) {
			return false;
		}
	}
	return true;
}

/**
 * Version basique du contrôle des mails
 *
 * Cette version impose des restrictions supplémentaires
 * qui sont souvent utilisées pour des raison de simplification des adresses
 * (ex. comptes utilisateurs lisibles, etc..)
 *
 * @param string $valeur La valeur à vérifier
 * @return boolean Retourne true uniquement lorsque le mail est valide
 */
function verifier_email_de_maniere_stricte($valeur){
	// Si c'est un spammeur autant arreter tout de suite
	if (preg_match(",[\n\r].*(MIME|multipart|Content-),i", $valeur)) {
		spip_log("Tentative d'injection de mail : $valeur");
		return false;
	}
	foreach (explode(',', $valeur) as $adresse) {
		// nettoyer certains formats
		// "Marie Toto <Marie@toto.com>"
		$adresse = trim(preg_replace(",^[^<>\"]*<([^<>\"]+)>$,i", "\\1", $adresse));
		if (!preg_match('/^([A-Za-z0-9]){1}([A-Za-z0-9]|-|_|\.)*@[A-Za-z0-9]([A-Za-z0-9]|-|\.){1,}\.[A-Za-z]{2,4}$/', $adresse)) {
			return false;
		}
	}
	return true; 
}

/**
 * Vérifier que le courriel à tester n'est pas
 * déjà utilisé dans la table spip_auteurs
 *
 * @param string $valeur La valeur à vérifier
 * @return boolean Retourne false lorsque le mail est déjà utilisé
 */
function verifier_disponibilite_email($valeur,$exclure_id_auteur=null){
	include_spip('base/abstract_sql');

	if (sql_getfetsel('id_auteur', 'spip_auteurs', 'email='.sql_quote($valeur).(!is_null($exclure_id_auteur)?"AND statut<>'5poubelle' AND id_auteur<>".intval($exclure_id_auteur):''))) {
		return false;
	} else {
		return true;
	}
}
