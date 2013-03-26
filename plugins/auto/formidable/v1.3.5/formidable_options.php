<?php

/**
 * Options globales chargées à chaque hit
 *
 * @package SPIP\Formidable\Options
**/

// Sécurité
if (!defined("_ECRIRE_INC_VERSION")) return;

// On déclare le formulaire pour éditer un formulaire
$GLOBALS['formulaires']['editer_formulaire'] = array(
	array(
		'saisie' => 'input',
		'options' => array(
			'nom' => 'titre',
			'label' => '<:formidable:editer_titre:>',
			'obligatoire' => 'oui',
			'class' => 'multilang'
		)
	),
	array(
		'saisie' => 'input',
		'options' => array(
			'nom' => 'identifiant',
			'label' => '<:formidable:editer_identifiant:>',
			'explication' => '<:formidable:editer_identifiant_explication:>',
			'obligatoire' => 'oui'
		),
		'verifier' => array(
			'type' => 'regex',
			'options' => array(
				'modele' => '/^[\w]+$/'
			)
		)
	),
	array(
		'saisie' => 'textarea',
		'options' => array(
			'nom' => 'message_retour',
			'label' => '<:formidable:editer_message_ok:>',
			'explication' => '<:formidable:editer_message_ok_explication:>',
			'rows' => 5,
			'li_class' => 'editer_texte',
			'class' => 'multilang'
		)
	),
	array(
		'saisie' => 'textarea',
		'options' => array(
			'nom' => 'descriptif',
			'label' => '<:formidable:editer_descriptif:>',
			'explication' => '<:formidable:editer_descriptif_explication:>',
			'rows' => 5,
			'class' => 'multilang'
		)
	),
	array(
		'saisie' => 'selection',
		'options' => array(
			'nom' => 'apres',
			'label' => '<:formidable:editer_apres_label:>',
			'explication' => '<:formidable:editer_apres_explication:>',
			'datas' => array(
				'formulaire' => _T('formidable:editer_apres_choix_formulaire'),
				'valeurs' => _T('formidable:editer_apres_choix_valeurs'),
				'stats' => _T('formidable:editer_apres_choix_stats'),
				'rien' => _T('formidable:editer_apres_choix_rien'),
				'redirige' => _T('formidable:editer_apres_choix_redirige'),
			),
			'defaut' => 'formulaire',
			'cacher_option_intro' => 'on'
		)
	),
	array(
		'saisie' => 'input',
		'options' => array(
			'nom' => 'url_redirect',
			'label' => '<:formidable:editer_redirige_url:>', 
			'explication' => '<:formidable:editer_redirige_url_explication:>',
			'obligatoire' => 'non'
		)
	)
);


if (!function_exists('array_fill_keys')) {
	/**
	 * Remplit un tableau avec des valeurs, en spécifiant les clés
	 *
	 * Fonction dans PHP 5.2+
	 * @see http://php.net/manual/fr/function.array-fill-keys.php
	 * 
	 * @param array $keys
	 *     Tableau de valeurs qui sera utilisé comme clés. 
	 * @param mixed $value
	 *     Valeur à utiliser pour remplir le tableau.
	 * @return array
	 *     Le tableau rempli. 
	**/
	function array_fill_keys($keys, $value){
		array_combine($keys,array_fill(0,count($keys),$value));
	}
}

?>
