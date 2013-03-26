<?php
#-----------------------------------------------------#
#  Plugin  : Couteau Suisse - Licence : GPL           #
#  Auteur  : Patrice Vanneufville, 2006               #
#  Contact : patrice¡.!vanneufville¡@!laposte¡.!net   #
#  Infos : http://www.spip-contrib.net/?article2166   #
#-----------------------------------------------------#
#  Fichier contenant les fonctions utilisees pendant  #
#  la configuration du plugin                         #
#-----------------------------------------------------#
if(!defined("_ECRIRE_INC_VERSION")) return;

cs_log("chargement de cout_utils.php");
$GLOBALS['cs_utils']++;

// $outils : tableau ultra complet avec tout ce qu'il faut savoir sur chaque outil
// $cs_variables : tableau de toutes les variables que les outils peuvent utiliser et manipuler
//  - ces deux tableaux ne sont remplis qu'une seule fois, lors d'une initialisation totale
//    les hits ordinaires ne se servent que des metas, non des fichiers.
//  - l'initialisation totale insere en premier lieu config_outils.php
global $outils, $cs_variables;
$cs_variables = $outils = array();
// liste des types de variable
$cs_variables['_chaines'] = $cs_variables['_nombres'] = array();
define('_format_CHAINE', 10);
define('_format_NOMBRE', 20);

/*************/
/* FONCTIONS */
/*************/

// ajoute un outil a $outils;
function add_outil($tableau) {
	global $outils;
	// sert encore a qqchose ?
	static $index; $index = isset($index)?$index + 10:0;
	$tableau['index'] = $index;
	// grave erreur si pas d'id
	if(!isset($tableau['id'])) { $tableau['id']='erreur'.count($outils); $tableau['nom'] = couteauprive_T('erreur_id'); }
	// surcharges perso. Ex : $GLOBALS['mes_outils']['supprimer_numero_perso']
	// (methode par variable globale depreciee)
	if(isset($GLOBALS['mes_outils'][$perso = $tableau['id'].'_perso']) && is_array($GLOBALS['mes_outils'][$perso])) {
		// ici pour compatibilite anterieure
		$tableau = array_merge($tableau, $GLOBALS['mes_outils'][$perso]);
		unset($GLOBALS['mes_outils'][$perso]);
		$tableau['surcharge'] = 1;
	// surcharges perso. Ex : function supprimer_numero_surcharger_outil($tab) { return $tab; }
	} elseif(function_exists($perso = $tableau['id'].'_surcharger_outil')) {
		if(is_array($perso = $perso($tableau))) $tableau = $perso;
		$tableau['surcharge'] = 1;
	}
	// desactiver l'outil si les fichiers distants ne sont pas permis
	if(defined('_CS_PAS_D_OUTIL_DISTANT') && isset($tableau['fichiers_distants']))
		$tableau['version-max'] = '0';
	foreach($tableau as $i=>$v) {		
		// parametres multiples separes par des virgules
		if(strpos($i,',')!==false) {
			$a = explode(',', $i);
			foreach($a as $b) $tableau[trim($b)] = $v;
			unset($tableau[$i]);
		}
		// liste des fichiers distants eventuels
		if(strncmp('distant', $i, 7)==0) $tableau['fichiers_distants'][] = $i;
	}
	$outils[$tableau['id']] = $tableau;
}

// ajoute une variable a $cs_variables et fabrique une liste des chaines et des nombres
function add_variable($tableau) {
	global $cs_variables;
	if(isset($tableau['nom'])) $nom = $tableau['nom']; else return;
	if(isset($cs_variables[$nom])) {
		cs_log("Variable $nom dupliquee ??");
		return;
	}
	if(isset($tableau['check'])) $tableau['format'] = _format_NOMBRE;
	// code '%s' par defaut si aucun code n'est defini
	$test=isset($tableau['code']); 
	if(!$test) foreach(array_keys($tableau) as $key)
		if($test=(strncmp('code:', $key, 5)==0)) break;
	if(!$test) $tableau['code'] = '%s';
	// enregistrement
	$cs_variables[$nom] = $tableau;
	// on fabrique ici une liste des chaines et une liste des nombres
	if(@$tableau['format']==_format_NOMBRE) $cs_variables['_nombres'][] = $nom;
		elseif(@$tableau['format']==_format_CHAINE) $cs_variables['_chaines'][] = $nom;
}
// idem, arguments variables
function add_variables() { foreach(func_get_args() as $t) add_variable($t); }

// les 3 fonction suivantes decodent les fichiers de configuration xml
// et les convertissent (pour l'instant car experimental) dans l'ancien format
function add_outils_xml($f) {
	include_spip('inc/xml');
	$arbre = spip_xml_load($f);
	if(isset($arbre['variable'])) foreach($arbre['variable'] as $a) 
		add_variable(parse_variable_xml($a));
	if(isset($arbre['outil'])) foreach($arbre['outil'] as $a) {
		$out = parse_outil_xml($a);
		if(isset($out['nom']) && is_string($out['nom']) && strlen($out['nom']) && strpos($f, ',couteau_suisse/,')!==false)
			$outil['nom'] = "<i>$out[nom]</i>";
		add_outil($out);
	}
}
// Attention : conversion incomplete. ajouter les tests au fur et a mesure
function parse_variable_xml(&$arbre) {
	$var = array();
	if(isset($arbre['id'])) $var['nom'] = $arbre['id'][0];
	if(isset($arbre['format'])) $var['format'] = $arbre['format'][0]=='string'?_format_CHAINE:_format_NOMBRE;
	if(isset($arbre['radio'])) {	
		$temp = &$arbre['radio'][0];
		if(isset($temp['par_ligne'])) $var['radio/ligne'] = $temp['par_ligne'][0];
		foreach($temp['item'] as $a) $var['radio'][$a['valeur'][0]] = $a['label'][0];
	}
	if(isset($arbre['label'])) $var['label'] = $arbre['label'][0];
	if(isset($arbre['defaut_php'])) $var['defaut'] = $arbre['defaut_php'][0];
	if(isset($arbre['code'])) foreach($arbre['code'] as $a) {
		$temp = isset($a['condition_php'])?'code:'.$a['condition_php'][0]:'code';
		if(isset($a['script_php'])) $var[$temp] = str_replace('\n', "\n", $a['script_php'][0]);
	}
	return $var;
}
// Attention : conversion incomplete. ajouter les tests au fur et a mesure
function parse_outil_xml(&$arbre) {
	$out = array();
	foreach(array('id','nom','description','categorie','auteur') as $n) 
		if(isset($arbre[$n])) $out[$n] = $arbre[$n][0];
	if(isset($arbre['code'])) foreach($arbre['code'] as $a) {
		$temp = isset($a['type'])?'code:'.$a['type'][0]:'code';
		if(isset($a['script_php'])) $out[$temp] = str_replace('\n', "\n", $a['script_php'][0]);
	}
	if(isset($arbre['pipeline'])) foreach($arbre['pipeline'] as $a) {
		if(isset($a['fonction'])) {
			$temp = isset($a['nom'])?'pipeline:'.$a['nom'][0]:'pipeline';
			$out[$temp] = $a['fonction'][0];
		} elseif(isset($a['script_php'])) {
			$temp = isset($a['nom'])?'pipelinecode:'.$a['nom'][0]:'pipelinecode';
			$out[$temp] = $a['script_php'][0];
		}
	}
	if(isset($arbre['version'])) {	
		$temp = &$arbre['version'][0];
		if(isset($temp['spip_min'])) $out['version-min'] = $temp['spip_min'][0];
		if(isset($temp['spip_max'])) $out['version-max'] = $temp['spip_max'][0];
	}
	return $out;
}

// retourne la valeur 'defaut' (format php) de la variable apres compilation du code
// le resultat comporte des guillemets si c'est une chaine
function cs_get_defaut($variable) {
	global $cs_variables;
	// si la variable n'est pas declaree, serieux pb dans config_outils !
	if(!isset($cs_variables[$variable])) {
		spip_log("Erreur - variable '$variable' non declaree dans config_outils.php !");
		return false;
	}
	$variable = &$cs_variables[$variable];
	if(isset($variable['externe'])) $variable['defaut'] = $variable['externe'];
	$defaut = !isset($variable['defaut'])?'':$variable['defaut'];
	if(function_exists($f='initialiser_variable_'.$variable['nom']))
		$defaut = $f($defaut);
	if(!strlen($defaut)) $defaut = "''";
	if(@$variable['format']==_format_NOMBRE) $defaut = "intval($defaut)";
		elseif(@$variable['format']==_format_CHAINE) $defaut = "strval($defaut)";
//cs_log("cs_get_defaut() - \$defaut[{$variable['nom']}] = $defaut");
	eval("\$defaut=$defaut;");
	$defaut2 = cs_php_format($defaut, @$variable['format']!=_format_NOMBRE, true);
//cs_log(" -- cs_get_defaut() - \$defaut[{$variable['nom']}] est devenu : $defaut2");
	return $defaut2;
}

// $type ici est egal a 'spip_options', 'options' ou 'fonctions'
function ecrire_fichier_en_tmp(&$infos_fichiers, $type) {
	$code = '';
	if(isset($infos_fichiers['inc_'.$type]))
		foreach ($infos_fichiers['inc_'.$type] as $inc) $code .= "include_spip('outils/$inc');\n";
	if(isset($infos_fichiers['code_'.$type]))
		foreach ($infos_fichiers['code_'.$type] as $inline) $code .= $inline."\n";
	// on optimise avant...
	$code = str_replace(array('intval("")',"intval('')"), '0', $code);
	$code = str_replace("\n".'if(strlen($foo="")) ',"\n\$foo=''; //", $code);
	// ... en avant le code !
	$fichier_dest = _DIR_CS_TMP . "mes_$type.php";
if(defined('_LOG_CS')) cs_log("ecrire_fichier_en_tmp($type) : lgr=".strlen($code))." pour $fichier_dest";
	if(!ecrire_fichier($fichier_dest, '<'."?php\n// Code d'inclusion pour le plugin 'Couteau Suisse'\n++\$GLOBALS['cs_$type'];\n$code?".'>', true))
		cs_log("ERREUR ECRITURE : $fichier_dest");
}

function set_cs_metas_pipelines(&$infos_pipelines) {
	global $cs_metas_pipelines;
	$controle='';
	foreach($infos_pipelines as $pipe=>$infos) {
		$code = "\n# Copie du code utilise en eval() pour le pipeline '$pipe(\$flux)'\n";
		// compilation des differentes facon d'utiliser un pipeline
		if(is_array(@$infos['inclure'])) foreach ($infos['inclure'] as $inc) {
			$code .= "include_spip('$inc');\n";
		}
		if(is_array(@$infos['inline'])) foreach ($infos['inline'] as $inc) $code .= "$inc\n";
		if(is_array(@$infos['fonction'])) foreach ($infos['fonction'] as $fonc)
			$code .= "function_exists('$fonc')?\$flux=$fonc(\$flux):cs_deferr('$fonc');\n";
		$controle .= $cs_metas_pipelines[$pipe] = $code;
	}
	$nb = count($infos_pipelines);
if(defined('_LOG_CS')) cs_log("$nb pipeline(s) actif(s) : strlen=".strlen($controle));
	ecrire_fichier(_DIR_CS_TMP . "pipelines.php", 
		'<'."?php\n// Code de controle pour le plugin 'Couteau Suisse' : $nb pipeline(s) actif(s)\n{$controle}?".'>');
}

// basename sans argument
function cs_basename($file, $suffix=null) {
	preg_match('/[^?]*/', $file, $reg); 
	return basename($reg[0], $suffix);
}

// fonction ecrire_fichier() tres prudente
function cs_ecrire_fichier($file, $contenu) {
	$inf = pathinfo($file);
	if(!ecrire_fichier($test = $inf['dirname'].'/test_'.$inf['basename'], $contenu)) 
		return false;
	$old = $inf['dirname'].'/'.$inf['basename'].'.old';
	// le fichier actuel, s'il existe, remplace la sauvegarde eventuelle
	if(@is_readable($file)) { @spip_unlink($old); @rename($file, $old); }
	return @rename($test, $file); // le fichier test est promu
}

// est-ce que $pipe est un pipeline ?
function is_pipeline_outil($pipe, &$set_pipe) {
	if($ok=(strncmp('pipeline:', $pipe, 9)==0)) $set_pipe = trim(substr($pipe, 9));
	return $ok;
}
// est-ce que $pipe est un pipeline inline?
function is_pipeline_outil_inline($pipe, &$set_pipe) {
	if($ok=(strncmp('pipelinecode:', $pipe, 13)==0)) $set_pipe = trim(substr($pipe, 13));
	return $ok;
}

// est-ce que $traitement est un traitement ?
function is_traitements_outil($traitement, $fonction, &$set_traitements_utilises) {
	if(strncmp('traitement', $traitement, 10)!=0) return false;
	if($ok = preg_match(',^traitement:([A-Z_]+)/?([a-z]+)?:(pre|post)_([a-zA-Z0-9_-]+)$,', $traitement, $t)) {
		if(!strlen($t[2])) $t[2] = 0;
		// 'typo' et 'propre' ne cohabitent pas : le premier l'emporte !
		if($t[4]=='typo') { if(isset($set_traitements_utilises[$t[1]][$t[2]]['propre'])) $t[4]='propre'; }
		elseif($t[4]=='propre') { if(isset($set_traitements_utilises[$t[1]][$t[2]]['typo'])) $t[4]='typo'; }
		$set_traitements_utilises[$t[1]][$t[2]][$t[4]][$t[3]][] = $fonction;
	} elseif($ok = preg_match(',^traitement:([A-Z]+)$,', $traitement, $t))
		$set_traitements_utilises[$t[1]][0][0][] = $fonction;
	return $ok;
}

// lire un fichier php et retirer si possible les balises ?php
function cs_lire_fichier_php($file) {
	$file=find_in_path($file);
	if($file && lire_fichier($file, $php)) {
		if(preg_match(',^<\?php(.*)?\?>$,msi', trim($php), $regs)) return trim($regs[1]);
		return "\n"."?>\n".trim($php)."\n<"."?php\n";
	}
	return false;
}

// retourne les raccourcis ajoutes par l'outil, s'il est actif
function cs_aide_raccourci($id) {
	global $outils;
	// stockage de la liste des fonctions par pipeline, si l'outil est actif...
	if($outils[$id]['actif']) {
		include_spip('outils/'.$id);	
		if(function_exists($f = $id.'_raccourcis')) return $f();
		if(!preg_match(',:aide(?:<|$),', $x = _T("couteauprive:$id:aide") )) return $x;
	}
	return '';
}
	
// retourne la liste des raccourcis disponibles
function cs_aide_raccourcis() {
	global $outils;
	$aide = array();
	foreach ($outils as $outil) 
		if($a = cs_aide_raccourci($outil['id'])) $aide[] = '<li style="margin: 0.7em 0 0 0;">&bull; ' . $a . '</li>';
	if(!count($aide)) return '';
	// remplacement des constantes de forme @_CS_XXXX@
	$aide = preg_replace_callback(',@(_CS_[a-zA-Z0-9_]+)@,', 
		create_function('$matches','return defined($matches[1])?constant($matches[1]):"";'), join("\n", $aide));
	return '<p><b>' . couteauprive_T('raccourcis') . '</b></p><ul class="cs_raccourcis">' . $aide . '</ul>';
}

// retourne une aide concernant les pipelines utilises par l'outil
function cs_aide_pipelines($outils_affiches_actifs) {
	global $cs_metas_pipelines, $outils, $metas_outils;
	$aide = array();
	$keys = array_keys($cs_metas_pipelines); sort($keys);
	foreach ($keys as $pipe) {
		// stockage de la liste des pipelines et du nombre d'outils actifs concernes
		$nb=0; foreach($outils as $outil) if($outil['actif'] && (isset($outil['pipeline:'.$pipe]) || isset($outil['pipelinecode:'.$pipe]))) $nb++;
		if(($len=strlen($pipe))>25) $pipe = substr($pipe, 0, 8).'...'.substr($pipe, $len - 14);
		if($nb) $aide[] = couteauprive_T('outil_nb'.($nb>1?'s':''), array('pipe'=>$pipe, 'nb'=>$nb));
	}
	// nombre d'outils actifs / interdits par les autorisations (hors versionnage SPIP)
	$nb = $ca2 = 0; 
	foreach($metas_outils as $o) if(isset($o['actif']) && $o['actif']) $nb++;
	foreach($outils as $o) if(isset($o['interdit']) && $o['interdit'] && !cs_version_erreur($o)) $ca2++;
	// nombre d'outils caches de la configuration par l'utilisateur
	$ca1 = isset($GLOBALS['meta']['tweaks_caches'])?count(unserialize($GLOBALS['meta']['tweaks_caches'])):0;
	return '<p><b>' . couteauprive_T('outils_actifs') . "</b> $nb"
		. '<br /><b>' . couteauprive_T('outils_caches') . "</b> $ca1"
		. (!$ca2?'':('<br /><b>' . couteauprive_T('outils_non_parametrables') . "</b> $ca2"))
		.'<br /><b>' . couteauprive_T('pipelines') . '</b> '.count($aide)
		. '</p><p style="font-size:80%; line-height: 1.4em;">' . join("<br />", $aide) . '</p>';
}

// sauve la configuration dans un fichier tmp/couteau-suisse/config.php
function cs_sauve_configuration() {
	global $outils, $metas_vars;
	$metas = $metas_actifs = $variables = $lesoutils = $actifs = array();
	foreach($outils as $t) {
		$lesoutils[] = "\t// ".$t['nom']."\n\t'".$t['id']."' => '".join('|', $t['variables']) . "'";
		if($t['actif']) {
			$actifs[] = $t['id'];
			$variables = array_merge($variables, $t['variables']);
		}
	}
	foreach($metas_vars as $i => $v) if($i!='_chaines' && $i!='_nombres') {
		$metas[] = $temp = "\t'$i' => " . cs_php_format($v, in_array($i, $metas_vars['_chaines']));
		if(in_array($i, $variables)) $metas_actifs[] = $temp;
	}
	$sauve = "// Tous les outils et leurs variables\n\$liste_outils = array(\n" . join(",\n", $lesoutils) . "\n);\n"
		. "\n// Outils actifs\n\$outils_actifs =\n\t'" . join('|', $actifs) . "';\n"
		. "\n// Variables actives\n\$variables_actives =\n\t'" . join('|', $variables) . "';\n"
		. "\n// Valeurs validees en metas\n\$valeurs_validees = array(\n" . join(",\n", $metas) . "\n);\n";

	include_spip('inc/charset');
	$nom_pack = couteauprive_T('pack_actuel', array('date'=>cs_date()));
	$fct_pack = md5($nom_pack.time());
	$sauve .= $temp = "\n######## ".couteauprive_T('pack_actuel_titre')." #########\n\n// "
		. filtrer_entites(couteauprive_T('pack_actuel_avert')."\n\n"
			. "\$GLOBALS['cs_installer']['$nom_pack'] =\t'cs_$fct_pack';\nfunction cs_$fct_pack() { return array(\n\t// "
			. couteauprive_T('pack_outils_defaut')."\n"
			. "\t'outils' =>\n\t\t'".join(",\n\t\t", $actifs)."',\n"
			. "\n\t// ".couteauprive_T('pack_variables_defaut')."\n")
		. "\t'variables' => array(\n\t" . join(",\n\t", $metas_actifs) . "\n\t)\n);} # $nom_pack #\n";

	ecrire_fichier(_DIR_CS_TMP.'config.php', '<'."?php\n// Configuration de controle pour le plugin 'Couteau Suisse'\n\n$sauve?".'>');
	if(_request('cmd')=='pack' || (_request('cmd')=='descrip' && _request('outil')=='pack')) $GLOBALS['cs_pack_actuel'] = $temp;
}

function cs_autorisation_alias(&$tab, $autoriser) {
	static $ok = array();
	if(isset($ok[$autoriser])) return;
	if(function_exists($f='autoriser_'.$autoriser.'_configurer') || function_exists($f.='_dist')) {
		$g = str_replace('_','',objet_type($autoriser));
		if($g != $autoriser) {
			$tab[] = "function autoriser_{$g}_configurer(\$faire,\$type,\$id,\$qui,\$opt) {\n\treturn function_exists('$f')\n\t?$f(\$faire, \$type, \$id, \$qui, \$opt):true; }";
			$ok[$autoriser] = 1;
		}
	}
}

// cree les tableaux $infos_pipelines et $infos_fichiers, puis initialise $cs_metas_pipelines
function cs_initialise_includes($count_metas_outils) {
	global $outils, $cs_metas_pipelines;
	// toutes les infos sur les fichiers mes_options/mes_fonctions et sur les pipelines;
	$infos_pipelines = $infos_fichiers =
	// liste des traitements utilises
	$traitements_utilises =
	// variables temporaires
	$temp_js_html = $temp_css_html = $temp_css = $temp_js = $temp_jq = $temp_jq_init = $temp_filtre_imprimer = array();
	@define('_CS_HIT_EXTERNE', 1500);
	// inclure d'office outils/couteau_suisse_fonctions.php
	if($temp = cs_lire_fichier_php("outils/cout_fonctions.php"))
		$infos_fichiers['code_fonctions'][] = $temp;
	// variable de verification
	$infos_fichiers['code_options'][] = "\$GLOBALS['cs_verif']=$count_metas_outils;";
	// horrible hack sur les autorisations SPIP 3.0 (en attendant la correction !!)
	if(defined('_SPIP30000')) {
		cs_autorisation_alias($infos_fichiers['code_spip_options'], 'plugins');
		cs_autorisation_alias($infos_fichiers['code_spip_options'], 'cs');
		global $cs_variables;
		for($i=2; $i<count($tmp=array_keys($cs_variables)); $i++)
			cs_autorisation_alias($infos_fichiers['code_spip_options'], 'variable_'.$tmp[$i]);
		foreach ($outils as $i=>$outil) {
			cs_autorisation_alias($infos_fichiers['code_spip_options'], 'outil_'.$outil['id']);
			if(isset($outil['categorie']))
				cs_autorisation_alias($infos_fichiers['code_spip_options'], 'categorie_'.$outil['categorie']);
		}
		cs_autorisation_alias($infos_fichiers['code_spip_options'], 'categorie_divers');
	}
	// parcours de tous les outils
	foreach ($outils as $i=>$outil) {
		$inc = $outil['id'];
		// stockage de la liste des fonctions par pipeline
		if($outil['actif']) {
			$pipe2 = '';
			foreach ($outil as $pipe=>$fonc) {
				if(is_pipeline_outil($pipe, $pipe2)) {
					// module a inclure
					if(find_in_path("outils/$inc.php"))
						$infos_pipelines[$pipe2]['inclure'][] = "outils/$inc";
					// inclusion du fichier des pipelines distants. TODO : inclusion mieux ciblee
					if(isset($outil['distant_pipelines']))
						$infos_pipelines[$pipe2]['inclure'][] = "lib/$inc/distant_pipelines_".cs_basename($outil['distant_pipelines'], '.php');
					// fonction a appeler
					if(strlen($fonc)) $infos_pipelines[$pipe2]['fonction'][] = $fonc;
				} elseif(is_pipeline_outil_inline($pipe, $pipe2)) {
					// code inline
					if(strlen($fonc)) $infos_pipelines[$pipe2]['inline'][] = cs_optimise_if(cs_parse_code_js($fonc));
				} elseif(is_traitements_outil($pipe, $fonc, $traitements_utilises)) {
					// rien a faire : $traitements_utilises est rempli par is_traitements_outil()
				}
			}
			// recherche des fichiers .css, .css.html, .js et .js.html eventuellement present dans outils/
			foreach(array('css', 'js') as $f) {
				if($file=find_in_path("outils/$inc.$f")) { lire_fichier($file, $ff); ${'temp_'.$f}[] = $ff; }
				// en fait on ne peut pas compiler ici car les balises vont devoir etre traitees et les traitements ne sont pas encore dispo !
				// le code est mis de cote. il sera compile plus tard au moment du pipeline grace a cs_compile_header()
				if($file=find_in_path("outils/$inc.$f.html")) { lire_fichier($file, $ff); ${'temp_'.$f.'_html'}[] = $ff; }
				// TODO : librairies distantes placees dans lib/
/*				if(isset($outil['distant_'.$f]) && ($file=find_in_path("lib/$inc/distant_{$f}_".cs_basename($outil["distant_$f"])))) etc. */
			}
			// recherche d'un code inline css/js/jq
			foreach(array('css', 'js', 'jq_init', 'jq') as $k) {
				if(isset($outil[$k2='code:'.$k.'_prive'])) ${'temp_'.$k}[] = cs_html_partie_privee($outil[$k2]);
				if(isset($outil[$k2='code:'.$k.'_public'])) ${'temp_'.$k}[] = cs_html_partie_privee($outil[$k2], false);
				if(isset($outil[$k2='code:'.$k])) ${'temp_'.$k}[] = cs_optimise_if(cs_parse_code_js($outil[$k2]));
			}
			foreach(array('options', 'fonctions', 'spip_options') as $f) {
				// recherche d'un code inline
				if(isset($outil['code:'.$f])) $infos_fichiers['code_'.$f][] = $outil['code:'.$f];
				// recherche d'un fichier monoutil_options.php ou monoutil_fonctions.php pour l'inserer dans le code
				// TODO : librairies distantes placees dans lib/
				if($temp=cs_lire_fichier_php("outils/{$inc}_{$f}.php")) $infos_fichiers['code_'.$f][] = $temp;
/*				if(isset($outil['distant_'.$f]) && find_in_path("lib/$inc/distant_{$f}_".cs_basename($outil["distant_$f"])))
					if($temp=cs_lire_fichier_php("lib/$inc/distant_{$f}_$outil[distant_$f].php")) 
						$infos_fichiers['code_'.$f][] = $temp;
*/			}
		} else foreach(array('pre_description_outil', 'fichier_distant') as $p) {
			// exceptions pour les outils inactifs
			if(isset($outil[$t='pipelinecode:'.$p])) 	
				$infos_pipelines[$p]['inline'][] = cs_optimise_if(cs_parse_code_js($outil[$t]));
			if(isset($outil[$t='pipeline:'.$p])) {
				$infos_pipelines[$p]['inclure'][] = "outils/$inc";
				$infos_pipelines[$p]['fonction'][] = $outil[$t];
			}
		}
	}
	// insertion du css pour la BarreTypo
	if(isset($infos_pipelines['bt_toolbox']) && defined('_DIR_PLUGIN_BARRETYPOENRICHIE'))
		$temp_css[] = 'span.cs_BT {background-color:#FFDDAA; font-weight:bold; border:1px outset #CCCC99; padding:0.2em 0.3em;}
span.cs_BTg {font-size:140%; padding:0 0.3em;}';
	// prise en compte des css.html et js.html qu'il faudra compiler plus tard
	if(count($temp_css_html)){
		$temp_css[] = '<cs_html>'.join("\n", $temp_css_html).'</cs_html>';
		unset($temp_css_html);
	}
	if(count($temp_js_html)){
		$temp_js[] = '<cs_html>'.join("\n", $temp_js_html).'</cs_html>';
		unset($temp_js_html);
	}
	// concatenation des css inline, js inline et filtres trouves
	if(strlen(trim($temp_css = join("\n", $temp_css)))) {
		if(function_exists('compacte_css')) $temp_css = compacte_css($temp_css);
		if(strlen($temp_css)>_CS_HIT_EXTERNE) {
			// hit externe
			$cs_metas_pipelines['header_css_ext'] = $temp_css;
		} else {
			// css inline
			$temp = array("<style type=\"text/css\">\n<!--/*--><![CDATA[/*><!--*/\n$temp_css\n/*]]>*/-->\n</style>");
			if(is_array($cs_metas_pipelines['header_css'])) $temp = array_merge($temp, $cs_metas_pipelines['header_css']);
			$cs_metas_pipelines['header_css'] = $cs_metas_pipelines['header_css_prive'] = join("\n", $temp);
		}
		unset($temp_css);
	}
	if(count($temp_jq_init)) {
		$temp_js[] = "var cs_init = function() {\n\t".join("\n\t", $temp_jq_init)."\n}\nif(typeof onAjaxLoad=='function') onAjaxLoad(cs_init);";
		$temp_jq[] = "cs_init.apply(document);";
		unset($temp_jq_init);
	}
	$temp_jq = count($temp_jq)?"\njQuery(document).ready(function(){\n\t".join("\n\t", $temp_jq)."\n});":'';
	$temp_js[] = "if(window.jQuery) {\nvar cs_sel_jQuery=typeof jQuery(document).selector=='undefined'?'@':'';\nvar cs_CookiePlugin=\"<cs_html>#CHEMIN{javascript/jquery.cookie.js}</cs_html>\";$temp_jq\n}";
	unset($temp_jq);
	if(count($temp_js)) {
		$temp_js = "var cs_prive=window.location.pathname.match(/\\/ecrire\\/\$/)!=null;
jQuery.fn.cs_todo=function(){return this.not('.cs_done').addClass('cs_done');};\n" . join("\n", $temp_js);
		if(function_exists('compacte_js')) $temp_js = compacte_js($temp_js);
		if(strlen($temp_js)>_CS_HIT_EXTERNE) {
			// hit externe
			$cs_metas_pipelines['header_js_ext'] = $temp_js;
		} else {
			// js inline
			$temp = array("<script type=\"text/javascript\"><!--\n$temp_js\n// --></script>\n");
			if(is_array($cs_metas_pipelines['header_js'])) $temp = array_merge($temp, $cs_metas_pipelines['header_js']);
			$cs_metas_pipelines['header_js'] = $cs_metas_pipelines['header_js_prive'] = join("\n", $temp);
		}
		unset($temp_js);
	}
	// effacement du repertoire temporaire de controle
	if(@file_exists(_DIR_CS_TMP) && ($handle = @opendir(_DIR_CS_TMP))) {
		while (($fichier = @readdir($handle)) !== false)
			if($fichier[0] != '.')	supprimer_fichier(_DIR_CS_TMP.$fichier);
		closedir($handle);
	} else spip_log('Erreur - cs_initialise_includes() : '._DIR_CS_TMP.' introuvable !');
	// join final...
	foreach(array('css', 'js') as $type) {
		$f = 'header_'.$type;
		if(isset($cs_metas_pipelines[$temp = $f.'_ext'])) {
			$fichier_dest = _DIR_CS_TMP . "header.$type.html";
			if(!ecrire_fichier($fichier_dest, $cs_metas_pipelines[$temp], true)) cs_log("ERREUR ECRITURE : $fichier_dest");
			unset($cs_metas_pipelines[$temp]);
			$infos_pipelines['header_prive']['inline'][] = "cs_header_hit(\$flux, '$type', '_prive');";
			$infos_pipelines['insert_head'.($type=='css'?'_css':'')]['inline'][] = "cs_header_hit(\$flux, '$type');";
		}
	}
	// liste des pivots pour les traitements que l'on peut decliner sous la forme pre_{pivot} ou post_{pivot}
	// SPIP 2.0 ajoute les parametres "TYPO" et $connect aux fonctions typo() et propre()
	// SPIP 3.0 ajoute le parametre $Pile[0]
	$pp = defined('_SPIP30000')?',$Pile[0])':')';
	$liste_pivots = defined('_SPIP19300')
		?array(
			// Fonctions pivots : on peut en avoir plusieurs pour un meme traitement
			// Exception : 'typo' et 'propre' ne cohabitent pas ensemble
			'typo' => defined('_TRAITEMENT_TYPO')?_TRAITEMENT_TYPO:('typo(%s,"TYPO",$connect'.$pp), // guillemets doubles requises pour le compilo
			'propre' => defined('_TRAITEMENT_RACCOURCIS')?_TRAITEMENT_RACCOURCIS:('propre(%s,$connect'.$pp),
		):array(
			'typo' => 'typo(%s)',
			'propre' => 'propre(%s)',
		);
	// mise en code des traitements trouves
	$traitements_post_propre = 0;
	foreach($traitements_utilises as $bal=>$balise) {
		foreach($balise as $obj=>$type_objet) {
			/* code mort : is_traitements_outil() verifie deja la non compatibilite de propre et typo...
			// ici, on fait attention de ne pas melanger propre et typo
			if(array_key_exists('typo', $type_objet) && array_key_exists('propre', $type_objet)) 
				die(var_dump($type_objet) . "<br/>>> <b>#$bal/$obj</b><br/>" . couteauprive_T('erreur:traitements')); */
			$traitements_type_objet = &$traitements_utilises[$bal][$obj];
			foreach($type_objet as $f=>$fonction)  {
				// pas d'objet precis
				if($f===0)	$traitements_type_objet[$f] = cs_fermer_parentheses(join("(", array_reverse($fonction)).'(%s');
				// un objet precis
				else {
					if(!isset($liste_pivots[$f])) $liste_pivots[$f] = $f . '(%s)';
					$traitements_type_objet[$f] = !isset($fonction['pre'])?$liste_pivots[$f]
						:str_replace('%s',
						 	cs_fermer_parentheses(join('(', $fonction['pre']) . '(%s'), 
							$liste_pivots[$f]
						);
					if(isset($fonction['post']))
						$traitements_type_objet[$f] = cs_fermer_parentheses(join('(', $fonction['post']) . '(' . $traitements_type_objet[$f]);
				}
			}
			// nombre de fonctions pivot ?
			if(count($traitements_type_objet)===1) $temp = join('', $traitements_type_objet);
			else {
				// compilation de plusieurs pivots
				$temp = '%s';
				foreach($traitements_type_objet as $t) $temp = str_replace('%s', $t, $temp);
			}
			// detection d'un traitement post_propre
			if(strpos($temp, '(propre(')) {
				$traitements_post_propre = 1;
				$temp = "cs_nettoie($temp)";
			}
			// traitement particulier des forums (SPIP>=2.1)
			if($obj==='forums') {
				if(defined('_SPIP20100')) $temp = "safehtml($temp)";
				if(defined('_SPIP30000')) {
					if(in_array($bal, array('TEXTE','TITRE','NOTES','NOM_SITE'))) $temp = str_replace('%s', 'interdit_html(%s)', $temp);
					elseif(in_array($bal, array('URL_SITE','AUTEUR','EMAIL_AUTEUR'))) $temp = str_replace('%s', 'vider_url(%s)', $temp);
				}
				
			}
			$traitements_type_objet = "\t\$traitements['$bal'][" . ($obj=='0'?'0':"'$obj'") . "]='$temp';";
		}
		$traitements_utilises[$bal] = join("\n", $traitements_utilises[$bal]);
		// specificite SPIP 3.0 : supprimer_numeros sur les TITRE et les NOM
		if(defined('_SPIP30000') && ($bal=='TITRE' || $bal=='NOM')) 
			$traitements_utilises[$bal] = str_replace('%s', 'supprimer_numero(%s)', $traitements_utilises[$bal]);
	}
	// mes_options.php : ajout des traitements (peut-etre les passer en pipeline 'table_des_traitements' inline directement ?)
	if(count($traitements_utilises))
		$infos_fichiers['code_options'][] = "\n// Table des traitements sur les balises\nfunction cs_table_des_traitements(&\$traitements) {\n"
			. join("\n", $traitements_utilises)	. "\n}" 
			. (defined('_SPIP19300')?'':"\ncs_table_des_traitements(\$GLOBALS['table_des_traitements']);");
	$infos_fichiers['code_options'][] = "\$GLOBALS['cs_post_propre']=$traitements_post_propre;";
	// ecriture des fichiers mes_options et mes_fonctions
	ecrire_fichier_en_tmp($infos_fichiers, 'spip_options');
	ecrire_fichier_en_tmp($infos_fichiers, 'options');
	ecrire_fichier_en_tmp($infos_fichiers, 'fonctions');
	// installation de cs_metas_pipelines[]
	set_cs_metas_pipelines($infos_pipelines);
}

function cs_fermer_parentheses($expr) {
	return $expr . str_repeat(')', substr_count($expr, '(') - substr_count($expr, ')'));
}

function cs_html_partie_privee($texte, $prive=true) {
	return '<cs_html>[(#EVAL{test_espace_prive()}|'.($prive?'oui':'non').')'
		. str_replace(array(']','[','@CHR93@'), array('@CHR93@','[(#CHR{91})]', '[(#CHR{93})]'),
			cs_optimise_if(cs_parse_code_js($texte)))
		. ']</cs_html>';
}

define('_CS_SPIP_OPTIONS_A', "// Partie reservee au Couteau Suisse. Ne pas modifier, merci");
define('_CS_SPIP_OPTIONS_B', "// Fin du code. Ne pas modifier ces lignes, merci");

// verifier le fichier d'options _FILE_OPTIONS (ecrire/mes_options.php ou config/mes_options.php)
function cs_verif_FILE_OPTIONS($activer=false, $ecriture = false) {
	$include = str_replace('\\','/',realpath(_DIR_CS_TMP.'mes_spip_options.php'));
	$include = "@include_once \"$include\";\nif(\$GLOBALS['cs_spip_options']) define('_CS_SPIP_OPTIONS_OK',1);";
	$inclusion = _CS_SPIP_OPTIONS_A."\n// Please don't modify; this code is auto-generated\n$include\n"._CS_SPIP_OPTIONS_B;
cs_log("cs_verif_FILE_OPTIONS($activer, $ecriture) : le code d'appel est $include");
	if($fo = cs_spip_file_options(1)) {
		if(lire_fichier($fo, $t)) {
			// verification du contenu inclu
			$ok = preg_match('`\s*('.preg_quote(_CS_SPIP_OPTIONS_A,'`').'.*'.preg_quote(_CS_SPIP_OPTIONS_B,'`').')\s*`ms', $t, $regs);
			// s'il faut une inclusion
			if($activer) {
				// pas besoin de reecrire si le contenu est identique a l'inclusion
				if(($regs[1]==$inclusion)) $ecriture = false;
				$t2 = $ok?str_replace($regs[0], "\n$inclusion\n\n", $t):preg_replace(',<\?(?:php)?\s*,', '<?'."php\n$inclusion\n\n", $t);
			} else {
				$t2 = $ok?str_replace($regs[0], "\n", $t):$t;
			}
cs_log(" -- fichier $fo present. Inclusion " . ($ok?" trouvee".($ecriture?" et remplacee":""):"absente".(($ecriture && $activer)?" mais ajoutee":"")));
			if($ecriture) if($t2<>$t) {
				$ok = ecrire_fichier($fo, $t2);
				if(!$ok) cs_log("ERREUR : l'ecriture du fichier $fo a echoue !");
			}
			return;
		} else cs_log(" -- fichier $fo illisible. Inclusion non permise");
	} else 
		$fo = cs_spip_file_options(2);
	// creation
	if($activer) {
		if($ecriture) $ok=ecrire_fichier($fo, '<?'."php\n".$inclusion."\n\n?".'>');
cs_log(" -- fichier $fo absent. Fichier '$fo' et inclusion ".((!$ecriture || !$ok)?"non ":"")."crees");
	}
}

function cs_retire_guillemets($valeur) {
	$valeur = trim($valeur);
	return (strncmp($valeur,$g="'",1)===0 /*|| strncmp($valeur,$g='"',1)===0*/)
			&& preg_match(",^$g(.*)$g$,s", $valeur, $matches)
		?stripslashes($matches[1])
		:$valeur;
}

// met en forme une valeur dans le style php
function cs_php_format($valeur, $is_chaine = true, $dblguill=false) {
	$valeur = trim($valeur);
	if( (strncmp($valeur,$g="'",1)===0 || ($dblguill && strncmp($valeur,$g='"',1)===0))
			&& preg_match(",^$g(.*)$g$,s", $valeur, $matches)) {
		if($is_chaine) return $valeur;
		$valeur = stripslashes($matches[1]);		
	}
	if(!strlen($valeur)) return $is_chaine?"''":0;
	return $is_chaine?var_export($valeur, true):$valeur;
}

// retourne le code compile d'une variable en fonction de sa valeur
function cs_get_code_php_variable($variable, $valeur) {
	global $cs_variables;
	// si la variable n'a pas ete declaree
	if(!isset($cs_variables[$variable])) return _L("/* Variable '$variable' inconnue ! */");
	$cs_variable = &$cs_variables[$variable];
	// mise en forme php de $valeur
	if(!strlen($valeur)) {
		if($cs_variable['format']==_format_NOMBRE) $valeur='0'; else $valeur='""';
	} else
		$valeur = cs_php_format($valeur, @$cs_variable['format']!=_format_NOMBRE);
	$code = '';
	foreach($cs_variable as $type=>$param) if(preg_match(',^code(:(.*))?$,', $type, $regs)) {
		$eval = '$test = ' . (isset($regs[2])?str_replace('%s', $valeur, $regs[2]):'true') . ';';
		$test = false;
		eval($eval);
		$code .= $test?str_replace('%s', $valeur, $param):'';
	}
	return $code;
}


// remplace les valeurs marquees comme %%toto%% par le code reel prevu par $cs_variables['toto']['code:condition']
// attention de bien declarer les variables a l'aide de add_variable()
function cs_parse_code_php($code, $debut='%%', $fin='%%') {
	global $metas_vars, $cs_variables;
	while(preg_match(",([']?)$debut([a-zA-Z_][a-zA-Z0-9_]*?)$fin([']?),", $code, $matches)) {
		$cotes = $matches[1]=="'" && $matches[3]=="'";
		$nom = $matches[2];
		// la valeur de la variable n'est stockee dans les metas qu'au premier post
		if(isset($metas_vars[$nom])) {
			$rempl = cs_get_code_php_variable($nom, $metas_vars[$nom]);
			if(!strlen($rempl)) $code = "/* Pour info : $nom = $metas_vars[$nom] */\n" . $code;
		} else {
			// tant que le webmestre n'a pas poste, on prend la valeur (dynamique) par defaut
			$defaut = cs_get_defaut($nom);
			$rempl = cs_get_code_php_variable($nom, $defaut);
			$code = "/* Par defaut : {$nom} = $defaut */\n" . $code;
		}
//echo '<br>',$nom, ':',isset($metas_vars[$nom]), " - $code";
		if($cotes) $rempl = str_replace("'", "\'", $rempl);
		$code = str_replace($matches[0], $matches[1].$rempl.$matches[3], $code);
	}
	return $code;
}

// remplace les valeurs marquees comme %%toto%% par la valeur reelle de $metas_vars['toto']
// si cette valeur n'existe pas encore, la valeur utilisee sera $cs_variables['toto']['defaut']
// attention de bien declarer les variables a l'aide de add_variable()
function cs_parse_code_js($code) {
	global $metas_vars, $cs_variables;
	// parse d'abord [[%toto%]] pour le code reel de la variable
	$code = cs_parse_code_php($code, '\[\[%', '%\]\]');
	// parse ensuite %%toto%% pour la valeur reelle de la variable
	while(preg_match(',%%([a-zA-Z_][a-zA-Z0-9_]*)%%,U', $code, $matches)) {
		// la valeur de la variable n'est stockee dans les metas qu'au premier post
		if(isset($metas_vars[$matches[1]])) {
			// la valeur de la variable est directement inseree dans le code js
			$rempl = $metas_vars[$matches[1]];
		} else {
			// tant que le webmestre n'a pas poste, on prend la valeur (dynamique) par defaut
			$rempl = cs_retire_guillemets(cs_get_defaut($matches[1]));
		}
		$code = str_replace($matches[0], $rempl, $code);
	} 
	return $code;
}

// attention : optimisation tres sommaire, pour codes simples !
// -> optimise les if(0), if(1), if(false), if(true)
function cs_optimise_if($code, $root=true) {
	if($root) {
		$code = preg_replace(',if\s*\(\s*([^)]*\s*)\)\s*{\s*,imsS', 'if(\\1){', $code);
		$code = str_replace(array('if(false){', 'if(!1){', 'if()'), 'if(0){', $code);
		$code = str_replace(array('if(true){', 'if(!0){'), 'if(1){', $code);
	}
	if(preg_match_all(',if\(([0-9])+\){(.*)$,msS', $code, $regs, PREG_SET_ORDER))
	foreach($regs as $r) {
		$temp = $r[2]; $ouvre = $ferme = -1; $nbouvre = 1;
		do {
			if($ouvre===false) $min = $ferme + 1; else $min = min($ouvre, $ferme) + 1;
			$ouvre=strpos($temp, '{', $min);
			$ferme=strpos($temp, '}', $min);
			if($ferme!==false) { if($ouvre!==false && $ouvre<$ferme) $nbouvre++; else $nbouvre--; }
		} while($ferme!==false && $nbouvre>0);
		if($ferme===false) return "/* Erreur sur les accolades : \{$r[2] */";
		$temp2 = cs_optimise_if($temp3=substr($temp, $ferme+1), false);
		$temp = substr($temp, 0, $ferme);
		$rempl = "if($r[1]){".$temp."}$temp3";
		if(intval($r[1])) $code = str_replace($rempl, "/* optimisation : 'IF($r[1])' */ {$temp}{$temp2}", $code);
			else $code = str_replace($rempl, "/* optimisation : 'IF($r[1]) \{$temp\}' */{$temp2}", $code);
	}
	return $code;
}

// lance la fonction d'installation de chaque outil actif, si elle existe.
// la fonction doit etre ecrite sous la forme monoutil_installe_dist() et placee
// dans le fichier outils/monoutil.php
// une surcharge de la fnction native est possible en ecrivant une fonction monoutil_installe() 
function cs_installe_outils() {
	global $metas_outils;
	$datas = array();
	foreach($metas_outils as $nom=>$o) if(isset($o['actif']) && $o['actif']) {
		include_spip('outils/'.$nom);
		if(function_exists($f = $nom.'_installe') || function_exists($f = $f.'_dist')) {
			if(is_array($tmp=$f())) foreach($tmp as $i=>$v) {
				$j=($i && $i!==$nom)?$nom.'_'.$i:$nom;
				$datas[$j] = "function cs_data_$j() { return " . var_export($v, true) . ';}';
			}
if(defined('_LOG_CS')) cs_log(" -- $f() : OK !");
		}
	}
	$datas = array('code_outils' => $datas);
	ecrire_fichier_en_tmp($datas, 'outils');
	ecrire_metas();
}

function cs_outils_concernes($key, $off=false){
	global $outils, $metas_outils; $s='';
	foreach($outils as $o) if(autoriser('configurer', 'outil', 0, NULL, $o) && isset($o[$key])) 
		$s .= ($s?' - ':'')."[.->$o[id]]".(isset($metas_outils[$o[id]]['actif']) && $metas_outils[$o[id]]['actif']?' ('.couteauprive_T('outil_actif_court').')':'');
	if(!$s) return '';
	$s = couteauprive_T('outils_'.($off?'desactives':'concernes')).$s;
	return "<q4>$s</q4>";
}
?>