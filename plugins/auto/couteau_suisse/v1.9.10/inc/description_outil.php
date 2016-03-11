<?php
#-----------------------------------------------------#
#  Plugin  : Couteau Suisse - Licence : GPL           #
#  Auteur  : Patrice Vanneufville, 2006               #
#  Contact : patrice¡.!vanneufville¡@!laposte¡.!net   #
#  Infos : http://contrib.spip.net/?article2166       #
#-----------------------------------------------------#
if(!defined("_ECRIRE_INC_VERSION")) return;

//include_spip('inc/actions');
include_spip('inc/actions_compat');

include_spip('inc/texte');
include_spip('inc/layer');
include_spip('inc/presentation');
include_spip('inc/message_select');

define('_VAR_OUTIL', '@@CS_VAR_OUTIL@@');

// initialise une variable et ne retourne rien si !$modif
// sinon, cette fonction retourne le code html qu'il faut pour fabriquer le formulaire de l'outil proprietaire
function description_outil_une_variable($index, &$outil, &$variable, &$label, &$modif) {
	global $cs_variables, $metas_vars;
	$actif = $outil['actif'];
	// la valeur de la variable n'est stockee dans les metas qu'au premier post
	$valeur = isset($metas_vars[$variable])?$metas_vars[$variable]:cs_get_defaut($variable);
	$valeur = cs_retire_guillemets($valeur);
//cs_log(" -- description_outil_une_variable($index) - Traite %$variable% = $valeur");
	$cs_variable = &$cs_variables[$variable];
	// autorisations de variables
	include_spip('inc/autoriser');
	$cs_variable['disabled'] = $disab 
		= autoriser('configurer', 'variable', 0, NULL, array('nom'=>$cs_variable['nom'], 'outil'=>$outil))?'':' disabled="disabled"';
	// si ce n'est qu'une simple initialisation, on sort
	if(!$modif) return '';
	$nombre = @$cs_variable['format']==_format_NOMBRE;
	// calcul du commentaire
	if($actif && isset($cs_variable['commentaire']) && strlen($cs_variable['commentaire'])) {
		eval('$comment = '.str_replace('%s',cs_php_format($valeur, !$nombre),$cs_variable['commentaire']).';');
		if($comment) $comment = "<p>$comment</p>";
	} else $comment = '';
	// si la variable necessite des boutons radio
	if(is_array($radios = &$cs_variable['radio'])) {
		if(!$actif) {
			$code = strncmp($code=$radios[$valeur], '_', 1)===0?substr($code, 1):_T($code);
			return "<input type=\"hidden\" name=\"$variable\" class=\"cs_hidden_checkbox\" value=\"$code\" />"
				. $label . (strlen($valeur)?ucfirst($code):'&nbsp;-').' ';
		}
		$res = "$label <ul>";
		$i = 0; $nb = isset($cs_variable['radio/ligne'])?intval($cs_variable['radio/ligne']):0;
		foreach($radios as $code=>$traduc) {
			$br = (($nb>0) && ( ++$i % $nb == 0))?'</ul><ul>':''; 
			$traduc = strncmp($traduc, '_', 1)===0?substr($traduc, 1):_T($traduc);
			$res .=
				"<li><label><input id=\"label_{$variable}_$code\" class=\"cs_input_checkbox\" type=\"radio\""
				.($valeur==$code?' checked="checked"':'')." value=\"$code\" name=\"$variable\"$disab />"
				.($valeur==$code?'<b>':'').$traduc.($valeur==$code?'</b>':'')
				."</label></li>$br";
		}
		return $res.'</ul>'.$comment._VAR_OUTIL;
	}
	// si la variable necessite un select
	elseif(is_array($select = &$cs_variable['select'])) {
		if(!$actif) {
			$code = _T($select[$valeur]);
			return "<input type=\"hidden\" name=\"$variable\" class=\"cs_hidden_checkbox\" value=\"$code\" />"
				. $label . (strlen($valeur)?ucfirst($code):'&nbsp;-');
		}
		$res = "$label <select name=\"$variable\"$disab>";
		foreach($select as $code=>$traduc) {
			$res .=	"<option"
				.($valeur==$code?' selected="selected"':'')." value=\"$code\">"
				._T($traduc)."</option>";
		}
		return $res.'</select>'.$comment._VAR_OUTIL;
	}
	// ... ou une case a cocher
	elseif(isset($cs_variable['check'])) {
		if(!$actif)
			return $label._T($cs_variable['check']).couteauprive_T($valeur?'2pts_oui':'2pts_non');
		return $label.'<label><input type="checkbox" '.($valeur?' checked="checked"':'')." value=\"1\" name=\"$variable\" $disab/>"
			.($valeur?'<b>':'')._T($cs_variable['check']).($valeur?'</b>':'').'</label>'
			. $comment._VAR_OUTIL;
	}
	// ... ou un textarea ... ou une case input
	if(!$actif)
		return $label.'<html>'.(strlen($valeur)?nl2br(echapper_tags($valeur)):'&nbsp;'.couteauprive_T('variable_vide')).'</html>';
	$len = $nombre?6:(isset($cs_variable['taille'])?$cs_variable['taille']:0);
	$width = $len?'':'style="width:98.8%;" ';
	$lignes = !isset($cs_variable['lignes']) || $nombre?0:strval($cs_variable['lignes']);
	return $label .
		( $lignes < 2
			// <html></html> empechera SPIP de modifier le contenu des <input> ou <textarea>
			?"<html><input name='$variable' value=\""
				. htmlspecialchars($valeur) . "\" type='text' size='$len' $width $disab/></html>"
			:"<html><textarea rows='$lignes' name='$variable' $width$disab>"
				. htmlspecialchars($valeur) . '</textarea></html>'
		) . $comment._VAR_OUTIL;
}

// callback sur les labels de zones input ; format : [[label->qq chose]]
// regexpr : ,\[\[([^][]*)->([^]]*)\]\],msS
function description_outil_input1_callback($matches) {
	// pas de label : [[->qq chose]]
	if(!strlen($matches[1])) return "<fieldset><div>$matches[2]</div></fieldset>";
	// retour a la ligne : [[-->qq chose]]
	if($matches[1]=='-') return "<fieldset> <div>$matches[2]</div></fieldset>";
	// fusion dans un <li> de boutons radio : [[radio->qq chose]]
	elseif($matches[1]=='radio') return "<fusionradio>$matches[2]</li></ul></div></fieldset>";
	// format complet : [[label->qq chose]]
	return "<fieldset><legend>$matches[1]</legend><div>$matches[2]</div></fieldset>";
}

// callback sur les labels de zones input en utilisant couteauprive_T('label:variable') ; format [[qq chose %variable% qq chose]]
// regexpr : ,\[\[((.*?)%([a-zA-Z_][a-zA-Z0-9_]*)%(.*?))\]\],msS
// ici, renseignement de la globale $cs_input_variable
function description_outil_input2_callback($matches) {
	global $cs_input_variable;
	$cs_input_variable[] = $matches[3];
	return "<fieldset><legend><:label:$matches[3]:></legend><div>$matches[1]</div></fieldset>";
}

function description_outil_liens_callback($matches) {
	global $outils;
	$nom = isset($outils[$matches[1]]['nom'])?$outils[$matches[1]]['nom']:couteauprive_T($matches[1].':nom');
	if(strpos($nom, '<:')!==false) $nom = preg_replace(',<:([:a-z0-9_-]+):>,ie', '_T("$1")', $nom);
	return '<a href="'.generer_url_ecrire('admin_couteau_suisse', 'cmd=descrip&outil='.$matches[1])
		."\" id=\"href_$matches[1]\" onclick=\"javascript:return cs_href_click(this);\">$nom</a>";
}

function description_outil_label_callback($matches) { 
	global $cs_variables; 
	return isset($cs_variables[$matches[1]]['label'])?$cs_variables[$matches[1]]['label']:couteauprive_T('label:'.$matches[1]);
}

function cs_input_variable_callback($matches) {
	$a = ' valeur_'.$matches[1].'_';
	$tmp = str_replace('/',$a, $matches[3]);
	return "<div class='groupe_{$matches[1]} $a$tmp'>";
}

// remplacement des liens vers un autre outil
function description_outil_liens($res) {
	return strpos($res,'[.->')===false?$res
		:preg_replace_callback(',\[\.->([a-zA-Z_][a-zA-Z0-9_-]*)\],', 'description_outil_liens_callback', $res);
}

// renvoie la description de $outil_ : toutes les %variables% ont ete remplacees par le code adequat
function inc_description_outil_dist($outil_, $url_self, $modif=false) {
	global $outils, $cs_variables, $metas_vars;
	$outil = &$outils[$outil_];
	$actif = $outil['actif'];
	$index = $outil['index'];
//cs_log("inc_description_outil_dist() - Parse la description de '$outil_'");
	// la description de base est a priori dans le fichier de langue
	$descrip = isset($outil['description'])?$outil['description']:couteauprive_T($outil['id'].':description');
	// ajout des variables liees a la barre typo
	if(defined('_DIR_PLUGIN_PORTE_PLUME') 
	 && ( isset($outil['pipeline:porte_plume_barre_pre_charger']) || isset($outil['pipeline:porte_plume_cs_pre_charger'])
	 	|| isset($outil['pipelinecode:porte_plume_barre_pre_charger']) || isset($outil['pipelinecode:porte_plume_cs_pre_charger']))
	 && count($barres = cs_pp_liste_barres())) {
		$descrip .= "\n\n@puce@ " . couteauprive_T('barres_typo_intro');
		$i=0;
		foreach($barres as $f=>$b) {
			$nom = "pp_{$b}_$outil[id]";
			$descrip .= ($i?'[[->':'[[')."%$nom%]]";
			add_variable( array(
				'nom' => $nom,
				'check' => ($b=='edition' || $b=='forum')?'couteauprive:barres_typo_'.$b:$f,
				'defaut' => 1, // par defaut les boutons seront toujours inseres
				'label' => $i++?NULL:'@_CS_CHOIX@',
			));
		}
	}
	if (strpos($descrip, '<:')!==false) {
		if(!isset($outil['perso']))
			// lames natives : reconstitution d'une description eventuellement morcelee
			// exemple : <:mon_outil:3:> est remplace par couteauprive_T('mon_outil:description3')
			$descrip = preg_replace_callback(',<:([a-z_][a-z0-9_-]*):([0-9]*):>,i', 
				create_function('$m','return couteauprive_T($m[1].":description".$m[2]);'), $descrip);
		// chaines de langue personnalisees
		$descrip = preg_replace_callback(',<:([:a-z0-9_-]+):>,i', create_function('$m','return _T($m[1]);'), $descrip);
	}
	// envoi de la description en pipeline
#	list(,$descrip) = pipeline('init_description_outil', array($outil_, $descrip));
	// globale pour la callback description_outil_input2_callback
	global $cs_input_variable;	$cs_input_variable = array();
	// remplacement des zones input de format [[label->qq chose]]
	$descrip = preg_replace_callback(',\[\[([^][]*)->([^]]*)\]\],msS', 'description_outil_input1_callback' , $descrip);
	// remplacement des zones input de format [[qq chose %variable% qq chose]] en utilisant couteauprive_T('label:variable') comme label
	// la fonction description_outil_input2_callback renseigne la globale $cs_input_variable
	$descrip = preg_replace_callback(',\[\[((.*?)%([a-zA-Z_][a-zA-Z0-9_]*)%(.*?))\]\],msS', 'description_outil_input2_callback', $descrip);

	// initialisation et remplacement des variables de format : %variable%
	$t = preg_split(',%([a-zA-Z_][a-zA-Z0-9_]*)%,', $descrip, -1, PREG_SPLIT_DELIM_CAPTURE);
	$res = '';
	$nb_disabled = $nb_variables = 0; $variables = array();
	for($i=0;$i<count($t);$i+=2) if(isset($t[$i+1]) && strlen($var=trim($t[$i+1]))) {
		// si la variable est presente on fabrique le input
		if(isset($cs_variables[$var])) {
			$res .= description_outil_une_variable(
				$index + (++$nb_variables),
				$outil, $var,
				$t[$i], $modif);
			$variables[] = $var;
			if($cs_variables[$var]['disabled']) ++$nb_disabled;
		} else {
			// probleme a regler dans config_outils.php !
			$temp = $t[$i]."[$var?]"; $res .= $temp;
		}
	} else 
		$res .= $t[$i];
	$outil['variables'] = $variables;
	$outil['nb_variables'] = $nb_variables;
	$outil['nb_disabled'] = $nb_disabled;

	// si ce n'est qu'une simple initialisation, on sort
	if(!$modif) {unset($cs_input_variable); return;}

	// information sur les raccourcis disponibles
	if($a=cs_aide_raccourci($outil_)) $res .= '<p>@puce@ '.couteauprive_T('detail_raccourcis').'<br /><html>'.$a.'.</html></p>';
	// envoi de la description courante en pipeline
	include_spip("cout_define");
	$res = pipeline('pre_description_outil', array('outil'=>$outil_, 'texte'=>$res, 'actif'=>$actif));
	$res = $res['texte'];
	// recherche des blocs <variable></variable> eventuels associes pour du masquage/demasquage
	foreach($cs_input_variable as $v) {
		$res = preg_replace_callback(",<($v)\s+valeur=(['\"])(.*?)\\2\s*>,", 'cs_input_variable_callback', $res);
		$res = str_replace("</$v>", '</div>', $res);
	}
	unset($cs_input_variable);
	// bouton 'Modifier' : en dessous du texte s'il y a plusieurs variables, a la place de _VAR_OUTIL s'il n'y en a qu'une.
	// attention : on ne peut pas modifier les variables si l'outil est inactif
	if($actif) {
		// 'exec' remis par precaution en cas d'appel de $_REQUEST (ecran de securite) 
		$bouton = "<input name='exec' type='hidden' value='"._request('exec')."'/><input type='submit' class='fondo' style='margin-left:1em;' value=\"".($nb_variables>1?couteauprive_T('modifier_vars_0'):_T('bouton_modifier'))."\" />";
		if($nb_variables>1) $res .= "<div class=\"cs_bouton\">$bouton</div>";
			else $res = str_replace(_VAR_OUTIL, $bouton, $res);
	}
	$res = "\n<div id='cs_inner_outil-$index' >" . str_replace(array('<ul></ul>',_VAR_OUTIL),'',$res) . '</div>';
	// si des variables sont trouvees ?
	if($nb_variables) {
		$variables = urlencode(serialize($variables));
		// syntaxe : ajax_action_auteur($action, $id, $script, $args='', $corps=false, $args_ajax='', $fct_ajax='')
		$res = ajax_action_auteur('description_outil', $index, $url_self, "modif=oui&cmd=descrip&outil={$outil['id']}", 
			"\n<input type='hidden' value='$variables' name='variables' /><input type='hidden' value='$outil_' name='outil' />"	. $res);
	}
//cs_log(" FIN : inc_description_outil_dist({$outil['id']}) - {$outil['nb_variables']} variables(s) trouvee(s)");
	// remplacement en deux passes des labels en doublon
	for($i=0;$i<2;$i++) if(strpos($res,'<:label:')!==false) 
		$res = preg_replace_callback(',<:label:([a-zA-Z_][a-zA-Z0-9_-]*):>,', 'description_outil_label_callback', $res);
	// remplacement des blocs avec style. ex : <q2>bla bla</q2>
	if(strpos($res, '<q')!==false)
		$res = preg_replace(',</q(\d)>,','</div>', preg_replace(',<q(\d)>,','<div class="q$1">', $res));
	// remplacement des inputs successifs sans label : [[%var1%]][[radio->%var2%]] ou [[%var1%]][[-->%var2%]]
	$res = preg_replace(',<(br />)?/fieldset><fieldset>( ?<div>),', '$2', $res);
	// fusion dans <li> : [[%var1%]][[radio->%var2%]] (var1 doit etre de type radio !)
	if(strpos($res, '<fusion')!==false)
		$res = str_replace(array('</li></ul></div></fieldset><fusionradio>','</div></fieldset><fusionradio>'), '', $res);
	// remplacement de diverses constantes
	$res = str_replace(array('@puce@','<spanred>','@_CS_CHOIX@','@_CS_ASTER@','@_DIR_CS_ROOT@', '@_CS_PLUGIN_JQUERY192@'),
		array(definir_puce(),'<span style="color:red">',couteauprive_T('votre_choix'), '<sup>(*)</sup>',
			cs_root_canonicalize(_DIR_PLUGIN_COUTEAU_SUISSE), defined('_SPIP19300')?'':couteauprive_T('detail_jquery3')
		), $res);
	// remplacement des constantes qui restent de forme @_CS_XXXX@
	if(strpos($res,'@_CS')!==false) 
		$res = preg_replace_callback(',@(_CS_[a-zA-Z0-9_]+)@,', 
			create_function('$matches','return defined($matches[1])?constant($matches[1]):(\' (\'.couteauprive_T(\'outil_inactif\').\')\');'), $res);
	// remplacement des liens vers un autre outil
	$res = description_outil_liens($res);

	// envoi de la description finale en pipeline
#	list(,$res) = pipeline('post_description_outil', array($outil_, $res));
	return cs_ajax_outil_greffe("description_outil-$index", $res);
}
?>