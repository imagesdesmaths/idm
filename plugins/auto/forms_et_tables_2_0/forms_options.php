<?php
/*
 * forms
 * Gestion de formulaires editables dynamiques
 *
 * Auteurs :
 * Antoine Pitrou
 * Cedric Morin
 * Renato Formato
 * (c) 2005,2006 - Distribue sous licence GNU/GPL
 *
 */
if (!defined('_DIR_PLUGIN_FORMS')){
	$p=explode(basename(_DIR_PLUGINS)."/",str_replace('\\','/',realpath(dirname(__FILE__))));
	define('_DIR_PLUGIN_FORMS',(_DIR_PLUGINS.end($p))."/");
}
if (defined('_DIR_PLUGIN_CRAYONS'))
	include_spip('forms_crayons');
include_spip('base/forms');
$GLOBALS['forms_actif_exec'][] = 'donnees_edit';
$GLOBALS['forms_saisie_km_exec'][] = 'donnees_edit';
// pipelines d'ajout et surcharge des champs
#edition du formulaire
if (!isset($GLOBALS['spip_pipeline']['forms_types_champs'])) $GLOBALS['spip_pipeline']['forms_types_champs'] = '';
if (!isset($GLOBALS['spip_pipeline']['forms_bloc_edition_champ'])) $GLOBALS['spip_pipeline']['forms_bloc_edition_champ'] = '';
if (!isset($GLOBALS['spip_pipeline']['forms_update_edition_champ'])) $GLOBALS['spip_pipeline']['forms_update_edition_champ'] = '';

#visualisation du formulaire
if (!isset($GLOBALS['spip_pipeline']['forms_label_details'])) $GLOBALS['spip_pipeline']['forms_label_details'] = '';
if (!isset($GLOBALS['spip_pipeline']['forms_input_champs'])) $GLOBALS['spip_pipeline']['forms_input_champs'] = '';
if (!isset($GLOBALS['spip_pipeline']['forms_ajoute_styles'])) $GLOBALS['spip_pipeline']['forms_ajoute_styles'] = '';

#pre remplissage du formulaire
if (!isset($GLOBALS['spip_pipeline']['forms_pre_remplit_formulaire'])) $GLOBALS['spip_pipeline']['forms_pre_remplit_formulaire'] = '';
#modification des donnees apres saisie du formulaire
if (!isset($GLOBALS['spip_pipeline']['forms_pre_edition_donnee'])) $GLOBALS['spip_pipeline']['forms_pre_edition_donnee'] = '';
if (!isset($GLOBALS['spip_pipeline']['forms_post_edition_donnee'])) $GLOBALS['spip_pipeline']['forms_post_edition_donnee'] = '';
if (!isset($GLOBALS['spip_pipeline']['forms_valide_conformite_champ'])) $GLOBALS['spip_pipeline']['forms_valide_conformite_champ'] = '';
if (!isset($GLOBALS['spip_pipeline']['forms_message_complement_post_saisie'])) $GLOBALS['spip_pipeline']['forms_message_complement_post_saisie'] = '';



#affichage des donnees
$GLOBALS['spip_pipeline']['forms_calcule_valeur_en_clair'] = '';
if (!defined("_ECRIRE_INC_VERSION")) return;
	
if (version_compare($GLOBALS['spip_version_code'],'1.9200','<')){
	function inc_safehtml($t) {
		include_spip('inc/forms_safehtml_191');
		if (function_exists('inc_safehtml_dist'))
			return inc_safehtml_dist($t);
		return $t;
	}
}
function autoriser_form_dist($faire, $type='', $id=0, $qui = NULL, $opt = NULL) {
	if ($type=='form' OR $type=='donnee'){
		if ($faire=='administrer'){
			return ($qui['statut'] == '0minirezo'); // tous les admin, restreint ou non
		}
	}
	return
		$qui['statut'] == '0minirezo'
		AND !$qui['restreint'];
}
// en cas d'appel avec le nom de la table (crayons)
function autoriser_forms_donnee_dist($faire,$type,$id_donnee,$qui,$opt){
	return autoriser_donnee_dist($faire,"donnee",$id_donnee,$qui,$opt);
}
function autoriser_donnee_dist($faire,$type,$id_donnee,$qui,$opt){
	static $types = array();
	static $opts = array();
	if (!isset($opt['id_form']) OR !isset($opt['statut'])){
		if (!isset($opts[$id_donnee])){
			$opts[$id_donnee] = array('id_form'=>0,'statut'=>'');
			$res = spip_query("SELECT id_form,statut FROM spip_forms_donnees WHERE id_donnee="._q($id_donnee));
			if ($row = spip_fetch_array($res))
				$opts[$id_donnee] = $row;
			$opts[$id_donnee] = is_array($opt)?array_merge($opts[$id_donnee],$opt):$opts[$id_donnee];
		}
		$opt = $opts[$id_donnee];
	}
	$id_form = $opt['id_form'];
	if (!isset($opt['type_form'])){
		if (!isset($types[$id_form])){
			$res = spip_query("SELECT type_form FROM spip_forms WHERE id_form="._q($id_form));
			if (!$row = spip_fetch_array($res)) return false;
			$types[$id_form] = $row['type_form'];
		}
		$opt['type_form'] = $types[$id_form];
	}
	$type_form = in_array($opt['type_form'],array('','sondage'))?'form':$opt['type_form'];
	// Chercher une fonction d'autorisation explicite
	if (
	// 1. Sous la forme "autoriser_type_form_donnee_faire"
		(
		$type_form
		AND $f = 'autoriser_'.$type_form.'_donnee_'.$faire
		AND (function_exists($f) OR function_exists($f.='_dist'))
		)

	// 2. Sous la forme "autoriser_type_form_donnee"
	OR (
		$type_form
		AND $f = 'autoriser_'.$type_form.'_donnee'
		AND (function_exists($f) OR function_exists($f.='_dist'))
		)
	// 3. Sous la forme "autoriser_table_donnee_faire"
	OR (
		$f = 'autoriser_table_donnee_'.$faire
		AND (function_exists($f) OR function_exists($f.='_dist'))
	)
	// 4. Sous la forme "autoriser_table_donnee_faire"
	OR (
		$f = 'autoriser_table_donnee'
		AND (function_exists($f) OR function_exists($f.='_dist'))
	)

	// 5. Sinon autorisation generique
	OR (
		$f = 'autoriser_form'
		AND (function_exists($f) OR function_exists($f.='_dist'))
	)

	)
		$a = $f($faire,$type,intval($id_donnee),$qui,$opt);
	if (_DEBUG_AUTORISER) spip_log("autoriser_form_donnee_dist delegue a $f($faire,$type,$id_donnee): ".($a?'OK':'niet'));
	return $a;
}
function autoriser_form_donnee_voir_dist($faire, $type, $id_donnee, $qui, $opt) {
	if (!isset($opt['id_form']) OR !$id_form = $opt['id_form']) return false;
	// un admin dans le back office a toujours le droit de modifier
	if (($qui['statut'] == '0minirezo')) return true;
	return false;
}
function autoriser_table_donnee_voir_dist($faire, $type, $id_donnee, $qui, $opt) {
	return autoriser_form_donnee_voir_dist($faire, $type, $id_donnee, $qui, $opt);
}

function autoriser_form_donnee_modifier_dist($faire, $type, $id_donnee, $qui, $opt) {
	if (!intval($id_donnee)) return false;
	if (!isset($opt['id_form']) OR !$id_form = $opt['id_form']) return false;
	// un admin dans le back office a toujours le droit de modifier
	if (($qui['statut'] == '0minirezo')) return true;
	$result = spip_query("SELECT * FROM spip_forms WHERE id_form="._q($id_form));
	if (!$row = spip_fetch_array($result)) return false;
	include_spip('inc/forms');
	$dejareponse=Forms_verif_cookie_sondage_utilise($id_form);
	global $auteur_session;
	$id_auteur = $auteur_session ? intval($auteur_session['id_auteur']) : 0;
	$cookie = $_COOKIE[Forms_nom_cookie_form($id_form)];
	if (($row['modifiable'] == 'oui') && $dejareponse) {
		$q = "SELECT id_donnee FROM spip_forms_donnees WHERE id_form="._q($id_form);
		$q .= "AND (";
		if ($cookie) { 
			$q.="cookie="._q($cookie). ($id_auteur?" OR id_auteur="._q($id_auteur):" AND id_auteur=0");
		}
		else if ($id_auteur)
				$q.="id_auteur="._q($id_auteur);
			else
				return false;
		$q .= ')';
		//si unique, ignorer id_donnee, si pas id_donnee, ne renverra rien
		if ($row['multiple']=='oui' || !_DIR_RESTREINT) $q.=" AND id_donnee="._q($id_donnee);
		$r=spip_query($q);
		if ($r=spip_fetch_array($r)) return true;
	}
	return false;
}
function autoriser_table_donnee_modifier_dist($faire, $type, $id_donnee, $qui, $opt) {
	return autoriser_form_donnee_modifier_dist($faire, $type, $id_donnee, $qui, $opt);
}
function autoriser_form_donnee_creer_dist($faire, $type, $id_donnee, $qui, $opt) {
	if (!isset($opt['id_form']) OR !$id_form = $opt['id_form']) return false;
	// un admin dans le back office a toujours le droit d'inserer
	if (($qui['statut'] == '0minirezo')) return true;
	$result = spip_query("SELECT * FROM spip_forms WHERE id_form="._q($id_form));
	if (!$row = spip_fetch_array($result)) return false;
	if ($row['multiple']=='oui') return true;
	$dejareponse=Forms_verif_cookie_sondage_utilise($id_form);
	if ($dejareponse) return false;
	return true;
}
function autoriser_table_donnee_creer_dist($faire, $type, $id_donnee, $qui, $opt) {
	return autoriser_form_donnee_creer_dist($faire, $type, $id_donnee, $qui, $opt);
}
function autoriser_form_donnee_instituer_dist($faire,$type,$id_donnee,$qui,$opt) {
	if (($qui['statut'] != '0minirezo')
	OR !isset($opt['nouveau_statut'])
	OR ($opt['nouveau_statut']=='prepa')) return false;
	return true;
}
function autoriser_table_donnee_instituer_dist($faire,$type,$id_donnee,$qui,$opt) {
	return autoriser_form_donnee_instituer_dist($faire,$type,$id_donnee,$qui,$opt);
}

// le reglage du cookie doit se faire avant l'envoi de tout HTML au client
function Forms_poser_cookie_sondage($id_form) {
	if ($id_form = intval($id_form)) {
		$nom_cookie = $GLOBALS['cookie_prefix'].'cookie_form_'.$id_form;
		// Ne generer un nouveau cookie que s'il n'existe pas deja
		if (!($cookie = $_COOKIE[$nom_cookie])) {
			include_spip("inc/acces");
			$cookie = creer_uniqid();
		}
		// pour utilisation dans inc_forms...
		// on utilise directement $_COOKIE
		//$GLOBALS['cookie_form'] = $cookie; 
		include_spip("inc/cookie");
		// Expiration dans 30 jours
		spip_setcookie($nom_cookie, $_COOKIE[$nom_cookie] = $cookie, time() + 30 * 24 * 3600);
	}
}

function Forms_generer_url_sondage($id_form) {
	return generer_url_public("sondage","id_form=$id_form",true);
}

if ((intval(_request('ajout_reponse'))) && (_request('ajout_cookie_form') == 'oui'))
	Forms_poser_cookie_sondage(_request('ajout_reponse'));

// le cache est gerer automatiquement par le core en 1.9.3 ou avec le plugin balise session
if (!defined('_DIR_PLUGIN_BALISESESSION') AND version_compare($GLOBALS['spip_version_code'],'1.93','<')) {
	// test si un cookie sondage a ete pose
	foreach($_COOKIE as $cookie=>$value){
		if (preg_match(",".$GLOBALS['cookie_prefix']."cookie_form_([0-9]+),",$cookie,$reg)){
			$idf = intval($reg[1]);
			$res = spip_query("SELECT id_article,id_rubrique FROM spip_forms_articles WHERE id_form=".intval($idf));
			while($row=spip_fetch_array($res)){
				$ida = $row['id_article'];
				$idr = $row['id_rubrique'];
				if (
							(isset($GLOBALS['article'])&&($GLOBALS['article']==$ida))
						||(isset($GLOBALS['id_article'])&&($GLOBALS['id_article']==$ida))
						||(isset($GLOBALS["article$ida"]))
						||(isset($GLOBALS['contexte_inclus']['id_article'])&&($GLOBALS['contexte_inclus']['id_article']==$idr))
						||(isset($GLOBALS['rubrique'])&&($GLOBALS['rubrique']==$idr))
						||(isset($GLOBALS['id_rubrique'])&&($GLOBALS['id_rubrique']==$idr))
						||(isset($GLOBALS["rubrique$idr"]))
						||(isset($GLOBALS['contexte_inclus']['rubrique'])&&($GLOBALS['contexte_inclus']['rubrique']==$idr))
						){
						// un article qui utilise le form va etre rendu
						// il faut utiliser le marquer cache pour ne pas polluer la page commune
						$GLOBALS['marqueur'].=":sondage $idf";
						break;
					}
			}
		}
	}
}
function Forms_definir_session($session){
	foreach($_COOKIE as $cookie=>$value){
		if (strpos($cookie,'cookie_form_')!==FALSE)
			$session .= "-$cookie:$value";
	}
	return $session;
}
?>