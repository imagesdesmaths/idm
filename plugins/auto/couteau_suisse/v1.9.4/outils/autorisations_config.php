<?php

#-----------------------------------------------------#
#  Plugin  : Couteau Suisse - Licence : GPL           #
#  Auteur  : Patrice Vanneufville, 2013               #
#  Contact : patrice¡.!vanneufville¡@!laposte¡.!net   #
#  Infos : http://contrib.spip.net/?article2166       #
#-----------------------------------------------------#
if (!defined("_ECRIRE_INC_VERSION")) return;

# Fichier de configuration pris en compte par config_outils.php et specialement dedie a la configuration des autorisations SPIP
# -----------------------------------------------------------------------------------------------------------------------------

function outils_autorisations_config_dist() {

// Ajout de l'outil 'autorisations'
add_outil(array(
	'id' => 'autorisations',
	'autoriser' => "autoriser('webmestre')",
	'categorie' => 'securite',
	'version-min' => '1.9300',
	'code:spip_options' => '%%autorisations_debug%%',
	'code:options' => '%%autorisations_alias%%
function autoriser_redacteur($faire,$type,$id,$qui,$opt) {
	return in_array($qui["statut"], array("0minirezo", "1comite"));
}
function autoriser_administrateur($faire,$type,$id,$qui,$opt) {
	return $qui["statut"] == "0minirezo" && !$qui["restreint"];
}
@include_once "'.str_replace('\\','/',realpath(_DIR_CS_TMP.'mes_autorisations.php')).'";
',
	// TODO : Exploiter $GLOBALS['autoriser_exception']
	'pipelinecode:pre_description_outil' => 'if($id=="autorisations")
$texte=str_replace(array("@_CS_DIR_TMP@","@_CS_DIR_LOG@"), array(cs_root_canonicalize(_DIR_CS_TMP), cs_root_canonicalize(defined("_DIR_LOG")?_DIR_LOG:_DIR_TMP)), $texte);',
	
));

add_variables( array(
	'nom' => 'autorisations_debug',
	'check' => 'couteauprive:autorisations_debug',
	'defaut' => 0,
	'code:%s' => "define('_DEBUG_AUTORISER', true);",
	'label' => '',
	'commentaire' => '(!defined("_SPIP30000") || _LOG_FILTRE_GRAVITE>=_LOG_INFO)?""
			:_T("couteauprive:cs_comportement_ko", array("gr1"=>"{{"._LOG_FILTRE_GRAVITE."}}","gr2"=>"{{"._LOG_INFO." (INFO)}}"))',
) ,array(
	'nom' => 'autorisations_alias',
	'defaut' => "'// creer article = creer rubrique\n// 23 : modifier article 18 = ok\n// configurer cs = webmestre\n// auteur 7 = niet'",
	'format' => _format_CHAINE,
	'lignes' => 8,
	'code' => "function _autorisations_LISTE(){return %s;}",
	'commentaire' => 'couteauprive_T("autorisations_creees")." ".((include_spip(_DIR_CS_TMP."mes_autorisations") && function_exists("autorisations_liste") && $tmp=autorisations_liste())?join(", ",$tmp):couteauprive_T("variable_vide"))',
));

}

function autorisations_installe_dist() {
cs_log("autorisations_installe_dist()");
	if(!function_exists('_autorisations_LISTE')) return NULL;

	// on decode les alias entres dans la config
	$alias = preg_split("/[\r\n]+/", _autorisations_LISTE());
	$code = $fct = array(); $erreurs = '';
	foreach($alias as $_a) {
		list($a,) = explode('//', $_a, 2);
		if (preg_match('/^\s*(?:(\d+)\s*:)?(.*?)=\s*(?:(\d+)\s*:)?(.*?)$/', $a, $regs)) {
			$qui = intval($regs[1]); list($faire, $type, $id) = autorisations_parse($regs[2]);
			$qui2 = intval($regs[3]); list($faire2, $type2, $id2) = autorisations_parse($regs[4]);
			if($faire===-1 || $faire2===-1 || ($faire==$faire2 && $type==$type2 && $id==$id2 && $qui=$qui2)) { 
				$erreurs .= "// #ERREUR : .$_a\n"; continue;
			}
			$if = $qui?"\$qui['id_auteur']==$qui":'';
			if($id) $if .= ($if?' && ':'') . '$id=='.$id;
			if($qui2) $alias = "'$faire2','$type2',$id2,$qui2";
			elseif($id2) $alias = "'$faire2','$type2',$id2,\$qui";
			elseif($type2) $alias = "'$faire2','$type2',\$id,\$qui";
			else $alias = "'$faire2',\$type,\$id,\$qui";
			$f = ($faire && $type)?"autoriser_{$type}_{$faire}":($faire?"autoriser_{$faire}":"autoriser_{$type}");
			$code[$f][] = "// $_a\n\t".($if?"if($if) ":'')."return autoriser($alias,\$opt);";
		}
	}
	foreach($code as $k=>$v) {
		$fct[] = $k;
		$v = join("\n\t", $v);
		$code[$k] = "if(!function_exists('$k')) {\n\tfunction $k(\$faire,\$type,\$id,\$qui,\$opt) {
	".$v.(strpos($v,') return')!==false?"\n\treturn autorisations_return(\$faire,\$type,\$id,\$qui['id_auteur'],\$opt);":'').' } }';
	}
	// fonction generique de retour
	$code[] = 'function autorisations_return($faire,$type,$id,$qui,$opt) {
	if($faire && $type && $id && intval($qui)) return autoriser($faire,$type,$id,NULL,$opt);
	if($faire && $type && $id) return autoriser($faire,$type,0,NULL,$opt);
	if($faire && $type) return autoriser($type,"",0,NULL,$opt);
	return autoriser("defaut");
}';
	// liste de autorisations "maison"
	$code[] = 'function autorisations_liste() { return '.var_export($fct,1).'; }';
	// en retour : le code PHP
	$alias = array($erreurs.join("\n", $code));
	$code = array('code_autorisations'=>$alias);
	ecrire_fichier_en_tmp($code, 'autorisations');
	return $alias;
}

?>