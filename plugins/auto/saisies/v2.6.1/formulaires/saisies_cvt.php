<?php

// Sécurité
if (!defined('_ECRIRE_INC_VERSION')) return;

function formulaires_saisies_cvt_saisies_dist(){
	return array(
		array(
			'saisie' => 'input',
			'options' => array(
				'nom' => 'nom',
				'label' => 'Nom'
			)
		),
		array(
			'saisie' => 'input',
			'options' => array(
				'nom' => 'email',
				'obligatoire' => 'oui',
				'label' => 'E-mail'
			),
			'verifier' => array(
				'type' => 'email'
			)
		),
		array(
			'saisie' => 'textarea',
			'options' => array(
				'nom' => 'message',
				'obligatoire' => 'oui',
				'label' => 'Un message'
			),
			'verifier' => array(
				'type' => 'taille',
				'options' => array('min' => 10)
			)
		)
	);
}

