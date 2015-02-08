<?php

/**
 * Utilisation de pipelines
 * 
 * @package SPIP\Formidable\Pipelines
**/

// Sécurité
if (!defined("_ECRIRE_INC_VERSION")) return;



define('_RACCOURCI_MODELE_FORMIDABLE',
	 '(<(formulaire\|formidable|formidable|form)' # <modele
	.'([0-9]*)\s*' # id
	.'([|](?:<[^<>]*>|[^>])*)?' # |arguments (y compris des tags <...>)
	.'>)' # fin du modele >
	.'\s*(<\/a>)?' # eventuel </a>
       );

/**
 * Trouver les liens <form
 * @param $texte
 * @return array
 */
function formidable_trouve_liens($texte){
	$formulaires = array();
	if (preg_match_all(','._RACCOURCI_MODELE_FORMIDABLE.',ims', $texte, $regs, PREG_SET_ORDER)){
		foreach ($regs as $r) {
			$id_formulaire = 0;
			if ($r[2]=="formidable")
				$id_formulaire = $r[3];
			elseif ($r[2]=="form")
				$id_formulaire = sql_getfetsel("id_formulaire","spip_formulaires","identifiant=".sql_quote("form".$r[3]));
			elseif ($r[2]=="formulaire|formidable"){
				$args = ltrim($r[4],"|");
				$args = explode("=",$args);
				$args = $args[1];
				$args = explode("|",$args);
				$args = trim(reset($args));
				if (is_numeric($args))
					$id_formulaire = intval($args);
				else
					$id_formulaire = sql_getfetsel("id_formulaire","spip_formulaires","identifiant=".sql_quote($args));
			}
			if ($id_formulaire = intval($id_formulaire))
				$formulaires[$id_formulaire] = $id_formulaire;
		}
	}
	return $formulaires;
}

/**
 * Associer/dissocier les formulaires a un objet qui les utilise (ou ne les utilise plus)
 * @param $flux
 * @return mixed
 */
function formidable_post_edition($flux){
	if ($table = $flux['args']['table']
	  AND $id_objet = intval($flux['args']['id_objet'])
		AND $primary = id_table_objet($table)
	  AND $row = sql_fetsel("*",$table,"$primary=".intval($id_objet))){

		$objet = objet_type($table);
		$contenu = implode(' ',$row);
		$formulaires = formidable_trouve_liens($contenu);
		include_spip("action/editer_liens");
		$deja = objet_trouver_liens(array("formulaire"=>"*"),array($objet=>$id_objet));
		$del = array();
		if (count($deja)){
			foreach($deja as $l){
				if (isset($formulaires[$l['id_formulaire']]))
					unset($formulaires[$l['id_formulaire']]);
				else
					$del[] = $l['id_formulaire'];
			}
		}
		if (count($formulaires)){
			objet_associer(array("formulaire"=>$formulaires),array($objet=>$id_objet));
		}
		if (count($del)){
			objet_dissocier(array("formulaire"=>$del),array($objet=>$id_objet));
		}
	}
	return $flux;
}

/**
 * Afficher les formulaires utilises par un objet
 * @param $flux
 * @return mixed
 */
function formidable_affiche_droite($flux){
	if ($e = trouver_objet_exec($flux['args']['exec'])
		AND isset($e['type'])
		AND $objet = $e['type']
		AND isset($flux['args'][$e['id_table_objet']])
	  AND $id = $flux['args'][$e['id_table_objet']]
	  AND sql_countsel("spip_formulaires_liens","objet=".sql_quote($objet)." AND id_objet=".intval($id))){

		$flux['data'] .= recuperer_fond('prive/squelettes/inclure/formulaires_lies',array('objet'=>$objet,'id_objet'=>$id));
	}
	return $flux;
}

/**
 * Optimiser la base de donnée en enlevant les liens de formulaires supprimés
 * 
 * @pipeline optimiser_base_disparus
 * @param array $flux
 *     Données du pipeline
 * @return array
 *     Données du pipeline
 */
function formidable_optimiser_base_disparus($flux){
	// Les formulaires qui sont à la poubelle
	$res = sql_select(
		'id_formulaire AS id',
		'spip_formulaires',
		'statut='.sql_quote('poubelle')
	);

	// On génère la suppression
	$flux['data'] += optimiser_sansref('spip_formulaires', 'id_formulaire', $res);


	# les reponses qui sont associees a un formulaire inexistant
	$res = sql_select("R.id_formulaire AS id",
		        "spip_formulaires_reponses AS R
		        LEFT JOIN spip_formulaires AS F
		          ON R.id_formulaire=F.id_formulaire",
			 "R.id_formulaire > 0
			 AND F.id_formulaire IS NULL");

	$flux['data'] += optimiser_sansref('spip_formulaires_reponses', 'id_formulaire', $res);


	// Les réponses qui sont à la poubelle
	$res = sql_select(
		'id_formulaires_reponse AS id',
		'spip_formulaires_reponses',
		sql_in('statut',array('refuse','poubelle'))
	);
	
	// On génère la suppression
	$flux['data'] += optimiser_sansref('spip_formulaires_reponses', 'id_formulaires_reponse', $res);


	// les champs des reponses associes a une reponse inexistante
	$res = sql_select("C.id_formulaires_reponse AS id",
		        "spip_formulaires_reponses_champs AS C
		        LEFT JOIN spip_formulaires_reponses AS R
		          ON C.id_formulaires_reponse=R.id_formulaires_reponse",
			 "C.id_formulaires_reponse > 0
			 AND R.id_formulaires_reponse IS NULL");

	$flux['data'] += optimiser_sansref('spip_formulaires_reponses_champs', 'id_formulaires_reponse', $res);

	//
	// CNIL -- Informatique et libertes
	//
	// masquer le numero IP des vieilles réponses
	//
	## date de reference = 4 mois
	## definir a 0 pour desactiver
	## même constante que pour les forums
	if (!defined('_CNIL_PERIODE')) {
		define('_CNIL_PERIODE', 3600*24*31*4);
	}
	
	if (_CNIL_PERIODE) {
		$critere_cnil = 'date<"'.date('Y-m-d', time()-_CNIL_PERIODE).'"'
			. ' AND statut != "spam"'
			. ' AND (ip LIKE "%.%" OR ip LIKE "%:%")'; # ipv4 ou ipv6
		$c = sql_countsel('spip_formulaires_reponses', $critere_cnil);
		if ($c>0) {
			spip_log("CNIL: masquer IP de $c réponses anciennes à formidable");
			sql_update('spip_formulaires_reponses', array('ip' => 'MD5(ip)'), $critere_cnil);
		}
	}
	
	return $flux;
}

?>