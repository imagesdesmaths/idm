<?php

/**
 * Plugin générique de configuration pour SPIP
 *
 * @license    GNU/GPL
 * @package    plugins
 * @subpackage cfg
 * @category   outils
 * @copyright  (c) toggg, marcimat 2007-2008
 * @link       http://www.spip-contrib.net/
 * @version    $Id: cfg_pipeline.php 42730 2010-12-07 21:25:45Z cedric@yterium.com $
 */

if (!defined("_ECRIRE_INC_VERSION")) return;
if (!defined("_INSERT_HEAD_CFG")) define('_INSERT_HEAD_CFG',false);

/**
 * Ajoute le bouton d'amin aux webmestres
 *
 * @param  Array $flux
 * @return Array 
 */
function cfg_ajouter_boutons($flux) {
	// si on est admin
	if (autoriser('configurer','cfg')) {
		$menu = "configuration";
		$icone = "cfg-22.png";
		if (isset($flux['bando_configuration'])){
			$menu = "bando_configuration";
			$icone = "cfg-16.png";
		}
		// on voit le bouton dans la barre "configuration"
		$flux[$menu]->sousmenu['cfg']= new Bouton(
		_DIR_PLUGIN_CFG.$icone,  // icone
		_T('cfg:CFG'));
	}
	return $flux;
}

/**
 * Rajoute à gauche de la page d'admin des plugins un lien vers 
 * la page de CFG
 * 
 * @param  Array $flux
 * @return Array 
 */
function cfg_affiche_gauche($flux){
	if ($flux['args']['exec']=='admin_plugin'){
		$flux['data'] =
			debut_cadre_enfonce('',true)
			. icone_horizontale('CFG &ndash; '._T('configuration'), generer_url_ecrire('cfg'), _DIR_PLUGIN_CFG.'cfg-22.png', '', false)
			. fin_cadre_enfonce(true)
			. $flux['data'];
	}
	return $flux;
}

/**
 * Gerer l'option <!-- head= xxx --> des fonds CFG
 * uniquement dans le prive
 *
 * @param  Array $flux
 * @return Array 
 */
function cfg_header_prive($flux){

	if (!_request('cfg') || (!_request('exec') == 'cfg')) {
		return $flux;
	}

	// Ajout des css de cfg
	$flux .= '<link rel="stylesheet" href="' . generer_url_public('cfg.css'). '" type="text/css" media="all" />';

	include_spip('inc/filtres');
	include_spip('inc/cfg_formulaire');
	$config = new cfg_formulaire(
				sinon(_request('cfg'), ''),
				sinon(_request('cfg_id'),''));

	if ($config->param['head'])
		$flux .= "\n".$config->param['head'];

	return $flux;
}

/**
 * CSS à ajouter lors du #INSERT_HEAD
 * 
 * @param  Array $flux
 * @return Array 
 */
function cfg_insert_head_css($flux){
	// Ajout des css de cfg
	static $done = false;
	if (!$done) {
		$done = true;
		if (_INSERT_HEAD_CFG)
			$flux .= '<link rel="stylesheet" href="' . generer_url_public('cfg.css'). '" type="text/css" media="all" />';
	}
	return $flux;
}

/**
 * CSS à ajouter lors du #INSERT_HEAD_CSS
 * 
 * @param  Array $flux
 * @return Array 
 */
function cfg_insert_head($flux){
	$flux = cfg_insert_head_css($flux); // au cas ou il n'est pas implemente
	return $flux;
}

/**
 * teste si $form n'est pas un formulaire CVT deja existant
 * (et non un formulaire CFG nomme $form en CVT)
 * 
 * #FORMULAIRE_TOTO <> #FORMULAIRE_CFG{toto}
 *
 * @param  string $form  Nom du formulaire
 * @return boolean       TRUE si formulaire_$form est un CVT deja existant 
 */
function est_cvt($form){
	$f = 'formulaires_' . $form;
	return (function_exists($f . '_stat')
		OR function_exists($f . '_charger_dist')
		OR function_exists($f . '_charger')
		OR function_exists($f . '_verifier_dist')
		OR function_exists($f . '_verifier')
		OR function_exists($f . '_traiter_dist')
		OR function_exists($f . '_traiter')
		);
}

/**
 * Formulaires CFG CVT : Charger
 *
 * @param  Array $flux
 * @return Array
 */
function cfg_formulaire_charger($flux){
	// s'il n'y a pas de fonction charger, on utilise le parseur de CFG
	$form = $flux['args']['form'];
	if (!est_cvt($form) AND !count($flux['data'])){
		// ici, on a le nom du fond cfg...
		// on recupere donc les parametres du formulaire.
		include_spip('inc/cfg_formulaire');
		#$config = &new cfg_formulaire($cfg, $cfg_id);
		$cfg_id = isset($flux['args']['args'][0]) ? $flux['args']['args'][0] : '';
		$config = new cfg_formulaire($form, $cfg_id);

		$valeurs = array(
			'_cfg_fond' => 'formulaires/'.$form,
			'_cfg_nom' => $form,
			'id' => $cfg_id,
			'_param' => $config->param,
			// passer aussi les arguments spécifiques a cfg
			'_cfg_' => $config->creer_hash_cfg(), // passer action=cfg pour avoir un hash formulaire correct
			'_hidden' => "<input type='hidden' name='_cfg_is_cfg' value='oui' />"
		);

		// il faut passer les noms des champs (input et consoeurs) de CFG dans l'environnement
		// pour pouvoir faire #ENV{nom_du_champ}
		if (is_array($config->val)){
			foreach($config->val as $nom=>$val){
				$valeurs[$nom] = $val;
			}
		}

		if (!$config->autoriser()) {
			$valeurs['editable'] = false;
		} else {
			$valeurs['editable'] = true;
		}

		$valeurs['_pipeline'] = array('editer_contenu_formulaire_cfg',
			'args'=>array(
				'nom'=>$form,
				'contexte'=>$valeurs,
				'ajouter'=>$config->param['inline'])
			);
		$flux['data'] = $valeurs;
		// return $valeurs; // retourner simplement les valeurs
		#return array(true,$valeurs); // forcer l'etat editable du formulaire et retourner les valeurs

	}
	return $flux;
}

/**
 *  Formulaires CFG CVT : Vérifier
 *
 * @param  Array $flux
 * @return Array
 */
function cfg_formulaire_verifier($flux){

	$form = $flux['args']['form'];
	if (_request('_cfg_is_cfg') AND !est_cvt($form)){
		include_spip('inc/cfg_formulaire');
		#$config = &new cfg_formulaire($cfg, $cfg_id);
		$cfg_id = isset($flux['args']['args'][0]) ? $flux['args']['args'][0] : '';
		$config = new cfg_formulaire($form, $cfg_id);

		$err = array();

		if (!$config->verifier() && $e = $config->messages){
			if (isset($e['message_refus'])) {
				$err['message_erreur'] = $e['message_refus'];
			} else {
				if (count($e['erreurs']))  $err = $e['erreurs'];
				if (count($e['message_erreur']))  $err['message_erreur'] = join('<br />',$e['message_erreur']);
				if (count($e['message_ok']))  $err['message_ok'] = join('<br />',$e['message_ok']);
			}
		}

		$flux['data'] = $err;

		// si c'est vide, modifier sera appele, sinon le formulaire sera resoumis
		// a ce moment la, on transmet $config pour eviter de le recreer
		// juste ensuite (et de refaire les analyse et la validation)
		if (!$err) cfg_instancier($config);
	}
	return $flux;
}

/**
 * sauve ou redonne une instance de la classe cfg.
 * sert a transmettre $config entre verifier() et traiter()
 * car $flux le perd en cours de route si on lui donne...
 *
 * @staticvar boolean|Object $cfg
 * @param     boolean|Object $config   $config est de type cfg_formulaire
 * @return    boolean|Object
 */
function cfg_instancier($config=false){
	static $cfg=false;
	if (!$config) return $cfg;
	return $cfg = $config;
}

/**
 * Formulaires CFG CVT : Traiter
 *
 * @param <type> $flux
 * @return <type>
 */
function cfg_formulaire_traiter($flux){
	$form = $flux['args']['form'];
	if (_request('_cfg_is_cfg') AND !est_cvt($form)){
		$config = cfg_instancier();

		$config->traiter();
		$message = join('<br />',$config->messages['message_ok']);
		$redirect = $config->messages['redirect'];
		$flux['data'] = array('editable'=>true,'message_ok' => $message,'redirect' => $redirect); // forcer l'etat editable du formulaire et retourner le message
	}
	return $flux;
}

/**
 * pipeline sur l'affichage du contenu
 * pour supprimer les parametres CFG du formulaire
 *
 * @param  Array $flux
 * @return Array
 */
function cfg_editer_contenu_formulaire_cfg($flux){
	$flux['data'] = preg_replace('/(<!-- ([a-z0-9_]\w+)(\*)?=)(.*?)-->/sim', '', $flux['data']);
	$flux['data'] .= $flux['args']['ajouter'];
	return $flux;
}

?>
