<?php
/*
 * Plugin CVT Multi Etapes
 * Formulaire de demo
 * (c) 2010 Cedric Morin Yterium.net
 * Distribue sous licence GPL
 *
 * 
 *
 * Formulaires multi etapes :
 *
 * #FORMULAIRE_TRUC
 *
 * Squelette :
 * Chaque etape est representee par un squelette independant qui doit
 * implementer un formulaire autonome pour les saisies de l'etape n
 * formulaires/truc.html pour l'etape 1
 * formulaires/truc_2.html pour l'etape 2
 * formulaires/truc_n.html pour l'etape n
 *
 * Charger :
 * formulaires_truc_charger_dist() :
 *	passer '_etapes' => nombre total d'etapes de saisies (>1 !)
 *  indiquer toutes les valeurs a saisir sur toutes les pages
 *  comme si il s'agissait d'un formulaire unique
 *
 * Verifier :
 * le numero d'etape courante est disponible dans $x=_request('_etape'), si necessaire
 * _request() permet d'acceder aux saisies effectuees depuis l'etape 1,
 * comme si les etapes 1 a $x avaient ete saisies en une seule fois
 *
 * formulaires_truc_verifier_1_dist() : verifier les saisies de l'etape 1 uniquement
 * formulaires_truc_verifier_2_dist() : verifier les saisies de l'etape 2
 * formulaires_truc_verifier_n_dist() : verifier les saisies de l'etape n
 *
 * A chaque etape x, les etapes 1 a x sont appelees en verification
 * pour verifier l'absence de regression dans la validation (erreur, tentative de reinjection ...)
 * en cas d'erreur, la saisie retourne a la premiere etape en erreur.
 * en cas de succes, l'etape est incrementee, sauf si c'est la derniere.
 * Dans ce dernier cas on declenche traiter()
 *
 * Traiter
 * formulaires_truc_traiter_dist() : ne sera appele que lorsque *toutes*
 * les etapes auront ete saisies sans erreur.
 * Traite donc l'ensemble des saisies comme si il s'agissait d'un formulaire unique
 *
 *
 */


function formulaires_demo_charger_dist(){
	#var_dump("Charger");
	$valeurs = array(
		'nom'=>'',
		'prenom'=>'',
		'email'=>'',
		'_etapes'=>3
	);

	return $valeurs;
}

function formulaires_demo_verifier_1_dist(){
	#var_dump("Verifier 1");
	$erreurs = array();
	if (!_request('nom'))
		$erreurs['nom'] = _T('info_obligatoire');
	return $erreurs;
}

function formulaires_demo_verifier_2_dist(){
	#var_dump("Verifier 2");
	$erreurs = array();

	return $erreurs;
}

function formulaires_demo_verifier_3_dist(){
	#var_dump("Verifier 3");
	$erreurs = array();
	include_spip('inc/filtres');
	if (!$m = _request('email'))
		$erreurs['email'] = _T('info_obligatoire');
	elseif(!email_valide($m))
		$erreurs['email'] = _L('Cet email n\'est pas valide !');

	return $erreurs;
}


function formulaires_demo_traiter_dist(){
	#var_dump("Traiter");
	$r = array(_request('nom'),_request('prenom'),_request('email'));

	$res = array('message_ok'=>'BRAVO ! '.implode(';',$r));
	return $res;
}
?>