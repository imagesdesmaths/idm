<?php

#-----------------------------------------------------#
#  Plugin  : Couteau Suisse - Licence : GPL           #
#  Auteur  : Patrice Vanneufville, 2006               #
#  Contact : patrice¡.!vanneufville¡@!laposte¡.!net   #
#  Infos : http://www.spip-contrib.net/?article2166   #
#-----------------------------------------------------#
if(!defined("_ECRIRE_INC_VERSION")) return;

// Noter :
// outils/mon_outil.php : inclus par les pipelines de l'outil
// outils/mon_outil_options.php : inclus par couteau_suisse_options.php
// outils/mon_outil_fonctions.php : inclus par couteau_suisse_fonctions.php

cs_log("inclusion de config_outils.php");
//-----------------------------------------------------------------------------//
//                               options                                       //
//-----------------------------------------------------------------------------//

// typographie sur les #TITRE et #NOM d'objets
// cet outil est place en tete car il modifie le pivot de #TITRE et #NOM
add_outil( array(
	'id' => 'titres_typographies',
	'categorie'   => 'typo-corr',
	// constante generique pour SPIP 3.0 :
	'code:spip_options' => 'define(\'_TRAITEMENT_TYPO_SANS_NUMERO\', \'PtoBR(propre(supprimer_numero(%s), $connect, $Pile[0]))\');',
	// pour etre compatible avec les autres outils, on provoque un changement de pivot (propre a la place de typo) :
	/* inserer :
		$table_des_traitements['TITRE'][]= 'PtoBR(propre(%s))';
		$table_des_traitements['TITRE']['mots']= 'PtoBR(propre(%s))';
		etc...
		note : $table_des_traitements['TITRE']['forums'] est protege plus tard */
	'traitement:TITRE:post_propre,
	 traitement:TITRE/mots:post_propre,
	 traitement:TITRE/forums:post_propre,
	 traitement:NOM:post_propre' => 'PtoBR',
	'auteur' => 'Ma&iuml;eul Rouquette',
));

add_variables( array(
	'nom' => 'alinea',
	'check' => 'couteauprive:autobr_oui',
	'defaut' => 1,
	'code:%s' => "define('_CS_AUTOBR_TRAIT', 1);",
) ,array(
	'nom' => 'alinea2',
	'check' => 'couteauprive:autobr_non',
	'defaut' => 0,
	'code:%s' => "define('_CS_AUTOBR_RACC', 1);",
) ,array(
	'nom' => 'alinea3',
	'radio' => array(1 => 'item_oui', 0 => 'item_non'), //'couteauprive:par_defaut'),
	'defaut' => 0,
	'code:%s' => "define('_AUTOBR', '');",
	'code:!%s' => "// (desactive alinea2) ",
));
add_outil( array(
	'id' => 'autobr',
	'code:options' => defined('_SPIP30000')?"%%alinea3%%%%alinea2%%\n":'%%alinea%%%%alinea2%%',
	'categorie' => 'typo-corr',
	'description' => defined('_SPIP30000')?'<:autobr:1:>[[%alinea3%]]<alinea3 valeur="1">[[%alinea2%<br /><q3><:autobr:2:></q3>]]</alinea3>'
		:'<:autobr::>[[%alinea%]][[->%alinea2%<br /><q3><:autobr:2:></q3>]]',
	// traitement automatique des TEXTE/articles, et TEXTE/forums (standard pour SPIP>=2.1)
	'traitement:TEXTE/articles:pre_propre'
	 .(!defined('_SPIP20100')?',traitement:TEXTE/forums:pre_propre':'') => 'autobr_pre_propre',
	'pipelinecode:pre_typo' => 'if(%%alinea2%%) { include_spip(\'outils/autobr\'); $flux = autobr_alinea($flux); }',
	'pipeline:nettoyer_raccourcis_typo' => 'autobr_nettoyer_raccourcis',
	'pipeline:porte_plume_cs_pre_charger' => 'autobr_CS_pre_charger',
	'pipeline:porte_plume_lien_classe_vers_icone' => 'autobr_PP_icones',
	'code:fonctions' => "// pour le traitement TEXTE/articles et la balise #INTRODUCTION
include_spip('outils/autobr');
\$GLOBALS['cs_introduire'][] = 'autobr_nettoyer_raccourcis';",
	'pipelinecode:pre_description_outil' => 'if($id=="autobr") {
		if(defined("_SPIP30000")) $texte=str_replace("@BALISES@",cs_balises_traitees("autobr"),$texte);
		$texte=str_replace(array("@ARTICLES@","@RUBRIQUES@","@FORUMS@"),
			array(cs_raccourcis_presents(array("article/texte", "article/descriptif", "article/chapo"),"%<alinea>%"), cs_raccourcis_presents(array("rubrique/texte"),"%<alinea>%"), cs_raccourcis_presents(array("forum/texte"),"%<alinea>%")), $texte);
}',
)); 

// ici on a besoin d'une case input. La variable est : dossier_squelettes
// a la toute premiere activation de l'outil, la valeur sera : $GLOBALS['dossier_squelettes']
add_variable( array(
	'nom' => 'dossier_squelettes',
	'format' => _format_CHAINE,
	'defaut' => "\$GLOBALS['dossier_squelettes']",
	'code' => "\$GLOBALS['dossier_squelettes']=%s;",
));
add_outil( array(
	'id' => 'dossier_squelettes',
	'code:spip_options' => '%%dossier_squelettes%%',
	'categorie' => 'admin',
));

add_outil( array(
	'id' => 'supprimer_numero',
	/* inserer :
		$table_des_traitements['TITRE'][]= 'typo(supprimer_numero(%s))';
		$table_des_traitements['TITRE']['mots']= 'typo(supprimer_numero(%s))';
		etc... */
	'traitement:TITRE:pre_typo,
	 traitement:TITRE/mots:pre_typo,
	 traitement:TITRE/forums:pre_typo,
	 traitement:NOM:pre_typo,
	 traitement:TYPE/mots:pre_typo' => 'supprimer_numero',
	'categorie' => 'public',
	'version-max' => '17743', // SPIP 3.0 : plus la peine
));

add_variable( array(
	'nom' => 'paragrapher',
	'format' => _format_NOMBRE,
	'radio' => array(1 => 'item_oui', 0 => 'item_non', -1 => 'couteauprive:par_defaut'),
	'defaut' => "-1",
	'code:%s>=0' => "\$GLOBALS['toujours_paragrapher']=%s;",
));
add_outil( array(
	'id' => 'paragrapher2',
	'code:spip_options' => '%%paragrapher%%',
	'categorie' => 'admin',
));

add_outil( array(
	'id' => 'forcer_langue',
	'code:spip_options' => "\$GLOBALS['forcer_lang']=true;",
	'categorie' => 'public',
));

add_variable( array(
	'nom' => 'webmestres',
	'format' => _format_CHAINE,
	'defaut' => '"1"',
	'code:strlen(%s)' => "define('_ID_WEBMESTRES', %s);",
	'code:!strlen(%s)' => "define('_ID_WEBMESTRES', 1);",
));
add_outil( array(
	'id' => 'webmestres',
	'code:spip_options' => '%%webmestres%%',
	'categorie' => 'admin',
	// non supporte avant la version 1.92
	'version-min' => '1.9200',
	'autoriser' => "autoriser('webmestre')",
	'pipelinecode:pre_description_outil' => 'if($id=="webmestres")
		$texte=str_replace(array("@_CS_LISTE_WEBMESTRES@","@_CS_LISTE_ADMINS@"),get_liste_administrateurs(),$texte);',
));

add_outil( array(
	'id' => 'insert_head',
	'code:options' => "\$GLOBALS['spip_pipeline']['affichage_final'] .= '|f_insert_head';",
	'categorie' => 'spip',
));

// ici on a besoin d'une case input. La variable est : suite_introduction
// a la toute premiere activation de l'outil, la valeur sera : '&nbsp;(...)'
add_variables( array(
	'nom' => 'suite_introduction',
	'format' => _format_CHAINE,
	'defaut' => '"&nbsp;(...)"',
	'code' => "define('_INTRODUCTION_SUITE', %s);\n",
), array(
	'nom' => 'lgr_introduction',
	'format' => _format_NOMBRE,
	'defaut' => 100,
	'code:%s && %s!=100' => "define('_INTRODUCTION_LGR', %s);\n",
), array(
	'nom' => 'lien_introduction',
	'format' => _format_NOMBRE,
	'radio' => array(1 => 'item_oui', 0 => 'item_non'),
	'defaut' => 0,
	'code' => "define('_INTRODUCTION_LIEN', %s);",
));
add_outil( array(
	'id' => 'introduction',
	'code:options' => "%%lgr_introduction%%%%suite_introduction%%%%lien_introduction%%",
	'categorie' => 'spip',
));

// ici on a besoin de deux boutons radio : _T('icone_interface_simple') et _T('icone_interface_complet')
add_variable( array(
	'nom' => 'radio_set_options4',
	'format' => _format_CHAINE,
	'radio' => array('basiques' => 'icone_interface_simple', 'avancees' => 'icone_interface_complet'),
	'defaut' => '"avancees"',
	'label' => '@_CS_CHOIX@',
	'code' => "\$_GET['set_options']=\$GLOBALS['set_options']=%s;",
));
add_outil( array(
	'id' => 'set_options',
	'auteur' 	 => 'Vincent Ramos',
	'code:options' => "%%radio_set_options4%%",
	'categorie' => 'interface',
	// pipeline pour retirer en JavaScript le bouton de controle de l'interface
	'pipeline:header_prive' => 'set_options_header_prive',
	// non supporte a partir de la version 1.93
	'version-max' => '1.9299',
));

// ici on a besoin de trois boutons radio : _T('couteauprive:js_jamais'), _T('couteauprive:js_defaut') et _T('couteauprive:js_toujours')
add_variable( array(
	'nom' => 'radio_filtrer_javascript3',
	'format' => _format_NOMBRE,
	'radio' => array(-1 => 'couteauprive:js_jamais', 0 => 'couteauprive:js_defaut', 1 => 'couteauprive:js_toujours'),
	'defaut' => 0,
	'label' => '@_CS_CHOIX@',
	// si la variable est non nulle, on code...
	'code:%s' => "\$GLOBALS['filtrer_javascript']=%s;",
));
add_outil( array(
	'id' => 'filtrer_javascript',
	'code:options' => "%%radio_filtrer_javascript3%%",
	'categorie' => 'securite',
	'version-min' => '1.9200',
));

// ici on a besoin d'une case input. La variable est : forum_lgrmaxi
// a la toute premiere activation de l'outil, la valeur sera : 0 (aucune limite)
add_variable( array(
	'nom' => 'forum_lgrmaxi',
	'format' => _format_NOMBRE,
	'defaut' => 0,
	'code:%s' => "define('_FORUM_LONGUEUR_MAXI', %s);",
));
add_outil( array(
	'id' => 'forum_lgrmaxi',
	'code:spip_options' => "%%forum_lgrmaxi%%",
	'categorie' => 'securite',
	'version-min' => '1.9200',
));


add_variables( array(
	'nom' => 'logo_Hmax',
	'format' => _format_NOMBRE,
	'defaut' => 0,
	'code:%s' => "@define('_LOGO_MAX_HEIGHT', %s);\n",
), array(
	'nom' => 'logo_Wmax',
	'format' => _format_NOMBRE,
	'defaut' => 0,
	'code:%s' => "@define('_LOGO_MAX_WIDTH', %s);\n",
), array(
	'nom' => 'logo_Smax',
	'format' => _format_NOMBRE,
	'defaut' => 0,
	'code:%s' => "@define('_LOGO_MAX_SIZE', %s);\n",
), array(
	'nom' => 'img_Hmax',
	'format' => _format_NOMBRE,
	'defaut' => 0,
	'code:%s' => "@define('_IMG_MAX_HEIGHT', %s);\n",
), array(
	'nom' => 'img_Wmax',
	'format' => _format_NOMBRE,
	'defaut' => 0,
	'code:%s' => "@define('_IMG_MAX_WIDTH', %s);\n",
), array(
	'nom' => 'img_Smax',
	'format' => _format_NOMBRE,
	'defaut' => 0,
	'code:%s' => "@define('_IMG_MAX_SIZE', %s);\n",
), array(
	'nom' => 'doc_Smax',
	'format' => _format_NOMBRE,
	'defaut' => 0,
	'code:%s' => "@define('_DOC_MAX_SIZE', %s);\n",
), array(
	'nom' => 'img_GDmax',
	'format' => _format_NOMBRE,
	'defaut' => 0,
	'code:%s' => "@define('_IMG_GD_MAX_PIXELS', %s);\n",
), array(
	'nom' => 'img_GDqual',
	'format' => _format_NOMBRE,
	'defaut' => 85,
	'code:%s' => "@define('_IMG_GD_QUALITE', %s);\n",
	'label' => '@_CS_CHOIX@',
), array(
	'nom' => 'copie_Smax',
	'format' => _format_NOMBRE,
	'defaut' => 16,
	'code' => "@define('_COPIE_LOCALE_MAX_SIZE', %s*1048576);",
));
add_outil( array(
	'id' => 'SPIP_tailles',
	'code:spip_options' => "%%logo_Hmax%%%%logo_Wmax%%%%logo_Smax%%%%img_Hmax%%%%img_Wmax%%%%img_Smax%%%%doc_Smax%%%%img_GDmax%%%%img_GDqual%%%%copie_Smax%%",
	'categorie' => 'securite',
));

add_outil( array(
	'id' => 'previsualisation',
	'categorie' => 'interface',
	'auteur' => '[C&eacute;dric Morin->http://www.yterium.net]',
	'pipeline:pre_boucle' => 'previsu_redac_pre_boucle',
	'pipeline:boite_infos' => 'previsu_redac_boite_infos',
	// fichier distant pour les pipelines
	'distant_pipelines' => 'http://zone.spip.org/trac/spip-zone/export/53447/_plugins_/previsu_redaction/previsu_redac_pipelines.php',
	'version-min' => '1.9300', // SPIP 2.0 : oui
	'version-max' => '17743', // SPIP 3.0 : non
));

add_variable( array(
	'nom' => 'mot_masquer',
	'format' => _format_CHAINE,
	'defaut' => "'masquer'",
	'code' => "define('_MOT_MASQUER', %s);",
	'commentaire' => '!sql_countsel("spip_mots", "titre="._q(%s))?"<spanred>"._T("couteauprive:erreur_mot", array("mot"=>%s))."</span>":""',
));
add_outil( array(
	'id' => 'masquer',
	'categorie' => 'spip',
	'auteur' => 'Nicolas Hoizey, St&eacute;phanie Caron',
	'pipeline:pre_boucle' => 'masquer_pre_boucle',
	// fichier distant pour le pipeline
	'distant_pipelines' => 'http://zone.spip.org/trac/spip-zone/export/70583/_plugins_/masquer/masquer_pipelines.php',
	'code:options' => "%%mot_masquer%%",
	'code:fonctions' => 'if (!function_exists("critere_tout_voir_dist")){
  function critere_tout_voir_dist($idb, &$boucles, $crit) {
    $boucle = &$boucles[$idb];
    $boucle->modificateur["tout_voir"] = true;
  }
}',
	'version-min' => '1.9300',
	'pipelinecode:pre_description_outil' => 'if($id=="masquer") {
	include_spip("lib/masquer/distant_pipelines_masquer_pipelines");
	$texte=str_replace(array("@_RUB@","@_ART@"),
		array((function_exists("masquer_liste_rubriques") && $x=masquer_liste_rubriques(true))?"[->rub".join("], [->rub", $x)."]":couteauprive_T("variable_vide"),
			(function_exists("masquer_liste_articles") && $x=masquer_liste_articles(true))?"[->art".join("], [->art", $x)."]":couteauprive_T("variable_vide"))
	,$texte); }',
));

add_variables( array(
	'nom' => 'auteur_forum_nom',
	'check' => 'couteauprive:auteur_forum_nom',
	'defaut' => 1,
), array(
	'nom' => 'auteur_forum_email',
	'check' => 'couteauprive:auteur_forum_email',
	'defaut' => 0,
), array(
	'nom' => 'auteur_forum_deux',
	'check' => 'couteauprive:auteur_forum_deux',
	'defaut' => 0,
));
// chaine de langue en extension sous SPIP>=3.0
$cs_temp = defined('_SPIP30000')?'forum:':'';
add_outil( array(
	'id' => 'auteur_forum',
	'categorie'	 => 'securite',
	'code:jq_init_public' => 'cs_auteur_forum.apply(this);',
	'code:js_public' => "var cs_verif_email = %%auteur_forum_email%%;\nvar cs_verif_nom = %%auteur_forum_nom%%;\nvar cs_verif_deux = %%auteur_forum_deux%%;",
	'pipelinecode:pre_description_outil' => 'if($id=="auteur_forum") $texte=str_replace(array("@_CS_FORUM_NOM@","@_CS_FORUM_EMAIL@"),
	array(preg_replace(\',:$,\',"",_T("'.$cs_temp.'forum_votre_nom")),preg_replace(\',:$,\',"",_T("'.$cs_temp.'forum_votre_email"))),$texte);',
));
/* Astuce de b_b en php (a tester !)
	'pipeline:formulaire_verifier' => 'nom_obligatoire',
function nom_obligatoire($flux){
	$form = $flux['args']['form'];
	if ($form=='forum'){
		if (!sinon($GLOBALS['visiteur_session']['nom'],$GLOBALS['visiteur_session']['session_nom'])){
			$flux['data']['message_erreur'] .= _T('nom_obligatoire');
			$flux['data']['session_nom'] = _T('nom_obligatoire');
			unset($flux['data']['previsu']);
		}
	}
	return $flux;
}*/

// ici on a besoin de trois boutons radio : _T('couteauprive:par_defaut'), _T('couteauprive:sf_amont') et _T('couteauprive:sf_tous')
add_variable( array(
	'nom' => 'radio_suivi_forums3',
	'format' => _format_CHAINE,
	'radio' => array('defaut' => 'couteauprive:par_defaut', '_SUIVI_FORUMS_REPONSES' => 'couteauprive:sf_amont', '_SUIVI_FORUM_THREAD' => 'couteauprive:sf_tous'),
	'defaut' => '"defaut"',
	'label' => '@_CS_CHOIX@',
	// si la variable est differente de 'defaut' alors on codera le define
	'code:%s!=="defaut"' => "define(%s, true);",
));
add_outil( array(
	'id' => 'suivi_forums',
	'code:options' => "%%radio_suivi_forums3%%",
	'categorie' => 'admin',
	// effectif que dans la version 1.92 (cf : plugin notifications)
	'version-min' => '1.9200',
	'version-max' => '1.9299',
));

add_variables( array(
	'nom' => 'spam_mots',
	'format' => _format_CHAINE,
	'lignes' => 8,
	'defaut' => '"sucking blowjob superbabe ejakulation fucking (asses)"',
	'code' => "define('_spam_MOTS', %s);",
), array(
	'nom' => 'spam_ips',
	'format' => _format_CHAINE,
	'lignes' => 6,
	'defaut' => '""',
	'code' => "define('_spam_IPS', %s);",
));
add_outil( array(
	'id' => 'spam',
	'code:options' => "%%spam_mots%%\n%%spam_ips%%",
	// sauvegarde de l'IP pour tests
	'code:spip_options' => '$ip_=$ip;',
	'categorie' => 'securite',
));

// a placer apres l'outil 'spam' pour compatibilite IP
add_outil( array(
	'id' => 'no_IP',
	'code:spip_options' => '$ip = substr(md5($ip),0,16);',
	'categorie' => 'securite',
));

add_outil( array(
	'id' => 'flock',
	'code:spip_options' => "define('_SPIP_FLOCK',false);",
	'categorie' => 'admin',
	'version-min' => '1.9300',
));

add_variables( array(
	'nom' => 'ecran_actif',
	'label' => '@_CS_CHOIX@',
	'check' => 'couteauprive:ecran_activer',
	'defaut' => 1,
	// code d'appel en realpath() pour config/mes_options.php (SPIP < 2.1)
	'code:%s' => "// bug SPIP 1.92, 2.0 et 2.1
if(isset(\$_REQUEST['exec']) && strncmp('admin_couteau_suisse',\$_REQUEST['exec'],20)==0) \$_REQUEST['exec']='admin_couteau_suisse';
".((!defined('_SPIP20100'))?"if(!defined('_ECRAN_SECURITE') && @file_exists(\$f=\"".str_replace('\\','/',realpath(dirname(__FILE__)))."/lib/ecran_securite/distant_ecran_securite.php\")) include \$f;":''),
), array(
	'nom' => 'ecran_load',
	'format' => _format_NOMBRE,
	'defaut' => 4,
	'code:%s' => "define('_ECRAN_SECURITE_LOAD',%s);\n",
));
add_outil( array(
	'id' => 'ecran_securite',
	'code:spip_options' => '%%ecran_load%%%%ecran_actif%%',
	'categorie' => 'securite',
	'distant' => 'http://zone.spip.org/trac/spip-zone/browser/_core_/securite/ecran_securite.php?format=txt',
	'pipeline:fichier_distant' => defined('_SPIP20100')?'ecran_securite_fichier_distant':'', 
	'pipelinecode:pre_description_outil' => 'if($id=="ecran_securite") $flux["non"] = !%%ecran_actif%% || !$flux["actif"];',
	'pipeline:pre_description_outil' => 'ecran_securite_pre_description_outil',
	'description' => "<:ecran_securite::>{{@_ECRAN_SECURITE@}}@_ECRAN_SUITE@",
));

add_variables( array(
	'nom' => 'log_couteau_suisse',
	'check' => 'couteauprive:cs_log_couteau_suisse',
	'defaut' => 0,
	'commentaire' => '(!defined("_SPIP30000") || _LOG_FILTRE_GRAVITE>=_LOG_INFO)?""
			:_T("couteauprive:cs_comportement_ko", array("gr1"=>"{{"._LOG_FILTRE_GRAVITE."}}","gr2"=>"{{"._LOG_INFO." (INFO)}}"))',
), array(
	'nom' => 'spip_options_on',
	'check' => 'couteauprive:cs_spip_options_on',
	'defaut' => 0,
	'commentaire' => 'cs_outils_concernes("code:spip_options");',
), array(
	'nom' => 'distant_off',
	'check' => 'couteauprive:cs_distant_off',
	'defaut' => 0,
	'code:%s' => "define('_CS_PAS_DE_DISTANT','oui');",
), array(
	'nom' => 'distant_outils_off',
	'check' => 'couteauprive:cs_distant_outils_off',
	'defaut' => 0,
	'code:%s' => "define('_CS_PAS_D_OUTIL_DISTANT','oui');",
	'commentaire' => 'cs_outils_concernes("fichiers_distants",%s);',
));
add_outil( array(
	'id' => 'cs_comportement',
	'code:spip_options' => "%%distant_off%% %%distant_outils_off%%",
	'pipelinecode:pre_description_outil' => 'if($id=="cs_comportement") {
$tmp=(!%%spip_options_on%%||!$flux["actif"]||defined("_CS_SPIP_OPTIONS_OK"))?"":"<spanred>"._T("couteauprive:cs_spip_options_erreur")."</span>";
$texte=str_replace(
	array("@_CS_FILE_OPTIONS_ERR@","@_CS_DIR_TMP@","@_CS_DIR_LOG@","@_CS_FILE_OPTIONS@"),
	array($tmp,cs_root_canonicalize(_DIR_TMP),cs_root_canonicalize(defined("_DIR_LOG")?_DIR_LOG:_DIR_TMP),show_file_options()),
	$texte);
}',
));

add_variables( array(
	'nom' => 'filtre_gravite',
	'format' => _format_NOMBRE,
	'radio' => array(0 => '_EMERGENCY (0)', 1 => '_ALERT (1)', 2 => '_CRITICAL (2)', 3 => '_ERROR (3)', 4 => '_WARNING (4)', 5 => '_NOTICE (5)', 6 => '_INFO (6)', 7 => '_DEBUG (7)', 8 => '_TRACE :'),
	'radio/ligne' => 3,
	'defaut' => 5,
	'code:%s<8' => "defined('_LOG_FILTRE_GRAVITE') || define('_LOG_FILTRE_GRAVITE',%s);",
	'code:%s==8' => "defined('_LOG_FILTRE_GRAVITE') || define('_LOG_FILTRE_GRAVITE',_LOG_FILTRE_GRAVITE_TRACE);",
), array(
	'nom' => 'filtre_gravite_trace',
	'format' => _format_NOMBRE,
	'defaut' => 8,
	'code:%s>=0' => "define('_LOG_FILTRE_GRAVITE_TRACE',%s);",
), array(
	'nom' => 'log_brut',
	'check' => 'couteauprive:log_brut',
	'defaut' => 0,
	'code:%s' => "defined('_LOG_BRUT') || define('_LOG_BRUT',%s);",
), array(
	'nom' => 'dir_log',
	'format' => _format_CHAINE,
	'defaut' => '',
	'code:strlen(%s)' => "defined('_DIR_LOG') || define('_DIR_LOG', _ROOT_RACINE.%s);",
	'action' => '%s = strlen(%s=trim(%s))?cs_root_canonicalize(%s."/", _DIR_RACINE):"";',
), array(
	'nom' => 'file_log',
	'format' => _format_CHAINE,
	'taille' => 10,
	'defaut' => "'spip'",
	'code:%s' => "defined('_FILE_LOG') || define('_FILE_LOG',%s);",
), array(
	'nom' => 'file_log_suffix',
	'format' => _format_CHAINE,
	'taille' => 10,
	'defaut' => "'.log'",
	'code:%s' => "defined('_FILE_LOG_SUFFIX') || define('_FILE_LOG_SUFFIX',%s);",
), array(
	'nom' => 'max_log',
	'format' => _format_NOMBRE,
	'defaut' => 100, // lignes
	'code:%s>0 && %s<>100' => "defined('_MAX_LOG') || define('_MAX_LOG',%s);",
), array(
	'nom' => 'log_fileline',
	'check' => 'couteauprive:log_fileline',
	'defaut' => 0,
	'code:%s>0 && %s<>100' => "defined('_LOG_FILELINE') || define('_LOG_FILELINE',%s);",
), array(
	'nom' => 'taille_des_logs',
	'format' => _format_NOMBRE,
	'defaut' => 100, // Ko (0 : pas de log)
	'code:%s>=0 && %s<>100' => "\$GLOBALS['taille_des_logs']=%s;",
), array(
	'nom' => 'nombre_de_logs',
	'format' => _format_NOMBRE,
	'defaut' => 4, // (0 : pas de log)
	'code:%s>=0 && %s<>4' => "\$GLOBALS['nombre_de_logs']=%s;",
));
add_outil( array(
	'id' => 'spip_log',
	'description' => '<:spip_log::>' . (defined('_SPIP30000')?'[[->@puce@ %log_fileline%]][[->@puce@ %log_brut%]]<:spip_log:2:>[[%filtre_gravite%]][[radio->%filtre_gravite_trace%]]':'') . '<:spip_log:3:>',
	'code:spip_options' => (defined('_SPIP30000')?'%%filtre_gravite_trace%%%%filtre_gravite%%%%log_brut%%%%log_fileline%%':'')
		. '%%dir_log%%%%file_log%%%%file_log_suffix%%%%max_log%%%%taille_des_logs%%%%nombre_de_logs%%',
	'categorie' =>'devel',
	'pipelinecode:pre_description_outil' => 'if($id=="spip_log")
	$texte=str_replace(array("@DIR_LOG@","@SPIP_OPTIONS@"),
	array("<code>".cs_root_canonicalize(_DIR_LOG)."</code>",!defined("_CS_SPIP_OPTIONS_OK")?"<br/>"._T("couteauprive:detail_spip_options2"):""),$texte);',
));

add_outil( array(
	'id' => 'test_i18n',
	'code:spip_options' => '$GLOBALS["test_i18n"] = true ;',
	'categorie' => 'devel',
	'pipelinecode:pre_description_outil' => 'if($id=="test_i18n") $texte.=_T("Lorem_ipsum_dolor");',
));

add_outil( array(
	'id' => 'xml',
	'code:options' => "\$GLOBALS['xhtml']='sax';",
	'auteur' => 'Ma&iuml;eul Rouquette',
	'categorie' =>'devel',
	'version-min' => '1.9200',
));

add_outil( array(
	'id' => 'f_jQuery',
	'code:spip_options' => "\$GLOBALS['spip_pipeline']['insert_head'] = str_replace('|f_jQuery', '', \$GLOBALS['spip_pipeline']['insert_head']);",
	'auteur' => 'Fil',
	'categorie' =>'public',
	'version-min' => '1.9200',
));

add_variables( array(
	'nom' => 'prive_travaux',
	'format' => _format_NOMBRE,
	'radio' => array(0 => 'couteauprive:tous', 1 => 'couteauprive:admins_seuls'),
	'defaut' => 0,
	'code:%s' => "define('_en_travaux_PRIVE', %s);\n",
), array(
	'nom' => 'admin_travaux',
	'format' => _format_NOMBRE,
	'radio' => array(0 => 'couteauprive:tous', 1 => 'couteauprive:sauf_admin', 2 => 'couteauprive:sauf_admin_redac', 3 => 'couteauprive:sauf_identifies'),
	'radio/ligne' => 1,
	'defaut' => 0,
	'code' => "define('_en_travaux_PUBLIC', %s);\n",
), array(
	'nom' => 'avertir_travaux',
	'check' => 'couteauprive:travaux_masquer_avert',
	'defaut' => 0,
	'code:%s' => "define('_en_travaux_SANSMSG', %s);\n",
), array(
	'nom' => 'message_travaux',
	'format' => _format_CHAINE,
	'defaut' => "_T('couteauprive:travaux_prochainement')",
	'lignes' => 3,
	'code' => "\$tr_message=%s;\n",
), array(
	'nom' => 'titre_travaux',
	'format' => _format_NOMBRE,
	'radio' => array(1 => 'couteauprive:travaux_titre', 0 => 'couteauprive:travaux_nom_site'),
	'defaut' => 1,
	'code:%s' => "define('_en_travaux_TITRE', %s);",
), array(
	'nom' => 'cache_travaux',
	'format' => _format_NOMBRE,
	'check' => 'couteauprive:travaux_nocache',
	'defaut' => 1,
	'code:%s' => "define('_NO_CACHE',1);", // SPIP >=2.0
));
add_outil( array(
	'id' => 'en_travaux',
	'code:options' => "%%message_travaux%%%%prive_travaux%%%%admin_travaux%%%%avertir_travaux%%%%titre_travaux%%",
	'categorie' => 'devel',
	'auteur' => "Arnaud Ventre pour l'id&eacute;e originale",
	'pipeline:affichage_final' => 'en_travaux_affichage_final',
	'pipelinecode:pre_description_outil' => 'if($id=="en_travaux") $texte=str_replace(array("@_CS_TRAVAUX_TITRE@","@_CS_NOM_SITE@"),
	array("["._T("info_travaux_titre")."]","[".$GLOBALS["meta"]["nom_site"]."]"),$texte);',
	'description' => '<:en_travaux::>[[%message_travaux%]][[%titre_travaux%]][[%admin_travaux%]][[-><admin_travaux valeur="1/2/3">%avertir_travaux%</admin_travaux>]][[->%cache_travaux%]][[%prive_travaux%]]',
));

add_variables( array(
	'nom' => 'bp_tri_auteurs',
	'check' => 'couteauprive:bp_tri_auteurs',
	'defaut' => 1,
	'code:%s' => "define('boites_privees_TRI_AUTEURS', %s);\n",
), array(
	'nom' => 'bp_urls_propres',
	'check' => 'couteauprive:bp_urls_propres',
	'defaut' => 1,
	'code:%s' => "define('boites_privees_URLS_PROPRES', %s);\n",
), array(
	'nom' => 'cs_rss',
	'check' => 'couteauprive:rss_var',
	'defaut' => 1,
	'code:%s' => "define('boites_privees_CS', %s);\n",
), array(
	'nom' => 'format_spip',
	'check' => 'couteauprive:format_spip',
	'defaut' => 1,
	'code:%s' => "define('boites_privees_ARTICLES', %s);\n",
), array(
	'nom' => 'stat_auteurs',
	'check' => 'couteauprive:stat_auteurs',
	'defaut' => 1,
	'code:%s' => "define('boites_privees_AUTEURS', %s);\n",
), array(
	'nom' => 'qui_webmasters',
	'check' => 'couteauprive:qui_webmestres',
	'defaut' => 1,
	'code:%s' => "define('boites_privees_WEBMASTERS', %s);\n",
));
add_outil( array(
	'id' => 'boites_privees',
	'auteur'=>'Pat, Joseph LARMARANGE (format SPIP)',
	'contrib' => 2564,
	'code:options' => "%%cs_rss%%%%format_spip%%%%stat_auteurs%%%%qui_webmasters%%%%bp_urls_propres%%%%bp_tri_auteurs%%",
	'categorie' => 'interface',
	'pipeline:affiche_milieu' => 'boites_privees_affiche_milieu',
	'pipeline:affiche_droite' => 'boites_privees_affiche_droite',
	'pipeline:affiche_gauche' => 'boites_privees_affiche_gauche',
	// controle de la boucle AUTEURS afin de respecter l'ordre des auteurs stockes en base
	'pipeline:pre_boucle' => defined('_SPIP20100')?'boites_privees_pre_boucle':'',
	'code:fonctions' => 'include_spip("outils/boites_privees");',
	// Pour la constante _CS_RSS_SOURCE
#	'pipelinecode:pre_description_outil' => 'if($id=="boites_privees") include_spip("cout_define");',
));

// TODO : compat SPIP 3.0 ?
add_variables( array(
	'nom' => 'max_auteurs_page',
	'format' => _format_NOMBRE,
	'defaut' => 30,
	'code:%s' => "@define('MAX_AUTEURS_PAR_PAGE', %s);\n",
), array(
	'nom' => 'auteurs_0',	'check' => 'info_administrateurs',	'defaut' => 1,	'code:%s' => "'0minirezo',",
), array(
	'nom' => 'auteurs_1',	'check' => 'info_redacteurs',	'defaut' => 1,	'code:%s' => "'1comite',",
), array(
	'nom' => 'auteurs_5',	'check' => defined('_SPIP30000')?'texte_statut_poubelle':'info_statut_site_4',	'defaut' => 1,	'code:%s' => "'5poubelle',",
), array(
	'nom' => 'auteurs_6',	'check' => 'info_visiteurs',	'defaut' => 0,	'code:%s' => "'6forum',",
), array(
	'nom' => 'auteurs_n',	'check' => 'couteauprive:nouveaux',	'defaut' => 0,	'code:%s' => "'nouveau',",
), array(
	'nom' => 'auteurs_tout_voir',
	'format' => _format_NOMBRE,
	'radio' => array(1 => 'couteauprive:statuts_tous', 0 => 'couteauprive:statuts_spip'),
	'radio/ligne' => 1,
	'defaut' => 0,
	'label' => '@_CS_CHOIX@',
//	'code:!%s' => "@define('AUTEURS_DEFAUT', join(\$temp_auteurs,','));",
	'code:!%s' => "if(_request('exec')=='auteurs' && !_request('statut')) \$_GET['statut'] = join(\$temp_auteurs,',');",
	'code:%s' => "if(_request('exec')=='auteurs' && !_request('statut')) \$_GET['statut'] = '!foo';",
));
add_outil( array(
	'id' => 'auteurs',
	'code:options' => "%%max_auteurs_page%%\$temp_auteurs=array(%%auteurs_0%%%%auteurs_1%%%%auteurs_5%%%%auteurs_6%%%%auteurs_n%%); %%auteurs_tout_voir%% unset(\$temp_auteurs);",
	'categorie' => 'interface',
	'version-min' => '1.9300',
//	'pipeline:affiche_milieu' => 'auteurs_affiche_milieu',
));

//-----------------------------------------------------------------------------//
//                               fonctions                                     //
//-----------------------------------------------------------------------------//

add_outil( array(
	'id' => 'verstexte',
	'auteur' => 'C&eacute;dric MORIN',
	'categorie' => 'spip',
));

add_outil( array(
	'id' => 'orientation',
	'auteur' 	 => 'Pierre Andrews (Mortimer) &amp; IZO',
	'categorie' => 'spip',
));

add_variable( array(
	'nom' => 'balise_decoupe',
	'format' => _format_NOMBRE,
	'radio' => array(1 => 'item_oui', 0 => 'item_non'),
	'defaut' => 0,
	'code:%s' => "define('_decoupe_BALISE', %s);\n",
));
add_outil( array(
	'id' => 'decoupe',
	'contrib'	=> 2135,
	// Le separateur <span class="csfoo xxxx"></span> est supprime en fin de calcul de page
	'code:options' => "%%balise_decoupe%%define('_onglets_FIN', '<span class=\"csfoo ongl\"></span>');\n@define('_decoupe_SEPARATEUR', '++++');
if(!defined('_SPIP19300') && isset(\$_GET['var_recherche'])) {
	include_spip('inc/headers');
	redirige_par_entete(str_replace('var_recherche=', 'decoupe_recherche=', \$GLOBALS['REQUEST_URI']));
}",
	// construction des onglets
	'code:jq_init' => "onglets_init.apply(this);",
	// pour les balises #TEXTE : $table_des_traitements['TEXTE'] = 'cs_decoupe(propre(%s))';
	// pour les articles, breves et rubriques : $table_des_traitements['TEXTE']['articles'] = 'cs_decoupe(propre(%s))';
	'traitement:TEXTE:post_propre,
	 traitement:TEXTE/articles:post_propre,
	 traitement:TEXTE/forums:post_propre,
	 traitement:TEXTE/breves:post_propre,
	 traitement:TEXTE/rubriques:post_propre' => 'cs_decoupe',
	// pour les balises #TEXTE : $table_des_traitements['TEXTE'] = 'propre(cs_onglets(%s))';
	// pour les articles, breves et rubriques : $table_des_traitements['TEXTE']['articles'] = 'propre(cs_onglets(%s))';
	'traitement:TEXTE:pre_propre,
	 traitement:TEXTE/articles:pre_propre,
	 traitement:TEXTE/forums:pre_propre,
	 traitement:TEXTE/breves:pre_propre,
	 traitement:TEXTE/rubriques:pre_propre' => 'cs_onglets',
	'categorie' => 'typo-racc',
	'pipeline:nettoyer_raccourcis_typo' => 'decoupe_nettoyer_raccourcis',
	'pipeline:porte_plume_cs_pre_charger' => 'decoupe_CS_pre_charger',
	'pipeline:porte_plume_lien_classe_vers_icone' => 'decoupe_PP_icones',
));

// couplage avec l'outil 'decoupe', donc 'sommaire' doit etre place juste apres :
// il faut inserer le sommaire dans l'article et ensuite seulement choisir la page
add_variables( array(
	'nom' => 'prof_sommaire',
	'format' => _format_NOMBRE,
	'defaut' => 1,
	'code:%s>=2 && %s<=4' => "define('_sommaire_PROFONDEUR', %s);\n",
), array(
	'nom' => 'lgr_sommaire',
	'format' => _format_NOMBRE,
	'defaut' => 30,
	'code:%s>=9 && %s<=99' => "define('_sommaire_NB_CARACTERES', %s);\n",
), array(
	'nom' => 'auto_sommaire',
	'format' => _format_NOMBRE,
	'radio' => array(1 => 'item_oui', 0 => 'item_non'),
	'defaut' => 1,
	'code:%s' => "define('_sommaire_AUTOMATIQUE', %s);\n",
), array(
	'nom' => 'jolies_ancres',
	'format' => _format_NOMBRE,
	'radio' => array(1 => 'item_oui', 0 => 'item_non'),
	'defaut' => 0,
	'code:%s' => "define('_sommaire_JOLIES_ANCRES', %s);\n",
), array(
	'nom' => 'balise_sommaire',
	'format' => _format_NOMBRE,
	'radio' => array(1 => 'item_oui', 0 => 'item_non'),
	'defaut' => 0,
	'code:%s' => "define('_sommaire_BALISE', %s);",
));
include_spip('inc/filtres');
add_outil( array(
	'id' => 'sommaire',
	'contrib'	=> 2378,
	// Le separateur <span class="csfoo xxxx"></span> est supprime en fin de calcul de page
	'code:options' => "define('_sommaire_REM', '<span class=\"csfoo somm\"></span>');\ndefine('_CS_SANS_SOMMAIRE', '[!sommaire]');\ndefine('_CS_AVEC_SOMMAIRE', '[sommaire]');\n%%prof_sommaire%%%%lgr_sommaire%%%%auto_sommaire%%%%jolies_ancres%%%%balise_sommaire%%",
	'code:jq' => 'if(jQuery("div.cs_sommaire").length) {
		// s\'il y a un sommaire, on cache la navigation haute sur les pages
		jQuery("div.decoupe_haut").css("display", "none");
		// utilisation des cookies pour conserver l\'etat du sommaire si on quitte la page
		if(cs_CookiePlugin) jQuery.getScript(cs_CookiePlugin, cs_sommaire_cookie);
	}',
	'code:jq_init' => 'cs_sommaire_init.apply(this);',
	// inserer : $table_des_traitements['TEXTE']['articles']= 'sommaire_d_article(propre(%s))';
	// idem pour les breves et les rubriques
	'traitement:TEXTE/articles:post_propre,
	 traitement:TEXTE/breves:post_propre,
	 traitement:TEXTE/rubriques:post_propre' => 'sommaire_d_article',
	'traitement:CS_SOMMAIRE:post_propre' => 'sommaire_d_article_balise',
	'categorie' => 'typo-corr',
	'pipeline:nettoyer_raccourcis_typo' => 'sommaire_nettoyer_raccourcis',
	'pipeline:pre_description_outil' => 'sommaire_description_outil',
	'pipeline:pre_propre' => 'sommaire_intertitres',
));

// intertitres typo, outil compatible avec 'sommaire' :
add_variables( array(
	'nom' => 'i_align',
	'radio' => array('left' => '_left', 'right' => '_right', 'center' => '_center'),
	'defaut' => "'left'",
), array(
	'nom' => 'i_padding',
	'format' => _format_NOMBRE,
	'defaut' => 0,
), array(
	'nom' => 'i_hauteur',
	'format' => _format_NOMBRE,
	'defaut' => 0,
), array(
	'nom' => 'i_largeur',
	'format' => _format_NOMBRE,
	'defaut' => 600,
), array(
	'nom' => 'i_taille',
	'format' => _format_NOMBRE,
	'defaut' => 16,
), array(
	'nom' => 'i_couleur',
	'format' => _format_CHAINE,
	'defaut' => "'black'",
), array(
	'nom' => 'i_police',
	'format' => _format_CHAINE,
	'defaut' => "'dustismo.ttf'",
));
add_outil( array(
	'id' => 'titres_typo',
	'categorie'   => 'typo-corr',
	'code:options' => 'define("_titres_typo_ARG", "couleur=%%i_couleur%%,taille=%%i_taille%%,police=%%i_police%%,largeur=%%i_largeur%%,hauteur_ligne=%%i_hauteur%%,padding=%%i_padding%%,align=%%i_align%%");',
	defined('_SPIP19300')?'pipeline:pre_propre':'pipeline:pre_typo'   => 'titres_typo_pre_typo',
	'pipelinecode:pre_description_outil' => 'if($id=="titres_typo")
		$texte=str_replace("@_CS_FONTS@",join(" - ",get_liste_fonts()),$texte);',	
));

//-----------------------------------------------------------------------------//
//                               PUBLIC                                        //
//-----------------------------------------------------------------------------//

// TODO : gestion du jQuery dans la fonction a revoir ?
add_outil( array(
	'id' => 'desactiver_flash',
	'auteur' 	 => 'C&eacute;dric MORIN',
	'categorie'	 => 'public',
	// fonction InhibeFlash_init() codee dans desactiver_flash.js : executee lors du chargement de la page et a chaque hit ajax
	'code:jq_init_public' => 'InhibeFlash_init.apply(this);',
));

add_variables( array(
	'nom' => 'radio_target_blank3',
	'format' => _format_NOMBRE,
	'radio' => array(1 => 'item_oui', 0 => 'item_non'),
	'defaut' => 0,
	'code' => '$GLOBALS["tweak_target_blank"]=%s;',
), array(
	'nom' => 'url_glossaire_externe2',
	'format' => _format_CHAINE,
	'defaut' => '""',
	'code:strlen(%s)' => '$GLOBALS["url_glossaire_externe"]=%s;',
), array(
	'nom' => 'enveloppe_mails',
	'format' => _format_NOMBRE,
	'radio' => array(1 => 'item_oui', 0 => 'item_non', -1 => 'couteauprive:par_defaut'),
	'defaut' => -1,
	// Code pour le CSS
	'code:%s>0' => 'a.spip_mail:before{content:"\002709" !important;}',
	'code:%s===0' => 'a.spip_mail:before{content:"" !important;}',
));
add_outil( array(
	'id' => 'SPIP_liens',
	'categorie' => 'public',
	'contrib'	=> 2443,
	'description' => '<:SPIP_liens::>'.(defined('_SPIP19300')?'<:SPIP_liens:1:>':''),
	'code:options' => "%%radio_target_blank3%%\n%%url_glossaire_externe2%%",
	'code:jq_init' => 'if(%%radio_target_blank3%%) { if(!cs_prive) jQuery("a.spip_out,a.spip_url,a.spip_glossaire",this).attr("target", "_blank"); }',
	'code:css' => defined('_SPIP19300')?'[[%enveloppe_mails%]]':NULL,
));

add_variables( array(
	'nom' => 'tout_rub',
	'check' => 'icone_rubriques',
	'defaut' => 0,
), array(
	'nom' => 'tout_aut',
	'check' => 'icone_auteurs',
	'defaut' => 0,
));
add_outil( array(
	'id' => 'aff_tout',
	'categorie' => 'public',
	'auteur' => 'b_b',
	'description' => '<:aff_tout::>[[%tout_rub%]][[->%tout_aut%]]',
	'pipelinecode:pre_boucle' =>
'if(%%tout_rub%%) {if($flux->type_requete == \'rubriques\' && !isset($flux->modificateur[\'criteres\'][\'statut\']))
	$flux->modificateur[\'criteres\'][\'statut\'] = true;}
if(%%tout_aut%%) {if($flux->type_requete == \'auteurs\' && !isset($flux->modificateur[\'criteres\'][\'statut\']))
	$flux->modificateur[\'criteres\'][\'statut\'] = true;}',
));

//-----------------------------------------------------------------------------//
//                               NOISETTES                                     //
//-----------------------------------------------------------------------------//

add_outil( array(
	'id' => 'visiteurs_connectes',
	'auteur' => "Phil d'apr&egrave;s spip-contrib",
	'categorie' => 'public',
	'contrib'	=> 3412,
	'code:options' => "
function cs_compter_visiteurs(){ return count(preg_files(_DIR_TMP.'visites/','.')); }
function action_visiteurs_connectes(){ echo cs_compter_visiteurs(); return true; }",
	'version-min' => '1.9200', // pour la balise #ARRAY
	'pipelinecode:pre_description_outil' => 'if($id=="visiteurs_connectes") if($GLOBALS["meta"]["activer_statistiques"]!="oui")
		$texte.="\n\n<spanred>"._T("couteauprive:visiteurs_connectes:inactif")."</span>";',

	//	une mise a jour toutes les 120 sec ?
/*	'code:js' => 'function Timer_visiteurs_connectes(){
		jQuery("span.cs_nb_visiteurs").load("spip.php?action=visiteurs_connectes");
		setTimeout("Timer_visiteurs_connectes()",120000);					
}',
	'code:jq' => ' if(jQuery("span.cs_nb_visiteurs").length) Timer_visiteurs_connectes(); ',
*/
));

//-----------------------------------------------------------------------------//
//                               TYPO                                          //
//-----------------------------------------------------------------------------//

add_outil( array(
	'id' => 'toutmulti',
	'categorie'	 => 'typo-racc',
	'pipeline:pre_typo' => 'ToutMulti_pre_typo',
));

add_variable( array(	// variable utilisee par 'pipelinecode:insert_head'
	'nom' => 'puceSPIP',
	'check' => 'couteauprive:puceSPIP',
	'defaut' => 0,
	'label' => '@_CS_CHOIX@',
));
add_outil( array(
	'id' => 'pucesli',
	'auteur' 	 => "J&eacute;r&ocirc;me Combaz pour l'id&eacute;e originale",
	'categorie'	 => 'typo-corr',
	'pipelinecode:pre_typo' => 'if(strpos($flux, "-")!==false OR strpos($flux, "*")!==false) $flux = cs_echappe_balises("", "pucesli_remplace", $flux);',
	'code:options' => 'function pucesli_remplace($texte) {
	if(%%puceSPIP%%) {$texte = preg_replace(\'/^[*]\s*/m\', \'- \', $texte);}
	return preg_replace(\'/^-\s*(?![-*#])/m\', \'-* \', $texte);
}
if(%%puceSPIP%%) {function pucesli_raccourcis() {return _T(\'couteauprive:puceSPIP_aide\');}}',
));

add_outil( array(
    'id' => 'citations_bb',
    'auteur'	=> 'Bertrand Marne, Romy T&ecirc;tue',
    'categorie'	=> 'typo-corr',
	'code:css'	=> '/* Specifie des paires de guillemets sur plusieurs niveaux pour chaque langue */
/* Cf.: http://www.yoyodesign.org/doc/w3c/css2/generate.html#quotes-specify */
q { quotes: \'"\' \'"\' "\'" "\'" }
/* Guillemets selon la langue du texte */
:lang(fr) q { quotes: "\00AB\A0" "\A0\00BB" "\201C" "\201D" "\2018" "\2019"; }
:lang(en) q { quotes: "\201C" "\201D" "\2018" "\2019" }
:lang(es) q { quotes: "\00AB" "\00BB" "\201C" "\201D"; }
:lang(it) q { quotes: "\00AB\A0" "\A0\00BB" "\201C" "\201D"; }
:lang(de) q { quotes: "\00BB" "\00AB" ">" "<" }
:lang(no) q { quotes: "\00AB\A0" "\A0\00BB" "<" ">" }
/* Insere des guillemets avant et apres le contenu d\'un element Q */
q:before { content: open-quote; } 
q:after { content: close-quote; }
/* IE */
* html q { font-style: italic; }
*+html q { font-style: italic; }', 
    'pipelinecode:pre_propre' => 'if(strpos($flux, "<qu")!==false) $flux=cs_echappe_balises("", "citations_bb_rempl", $flux);',
	// Remplacer <quote> par <q> quand il n'y a pas de retour a la ligne (3 niveaux, preg sans l'option s) 
    'code:options' => 'function citations_bb_rempl($texte){
	$texte = preg_replace($a="/<quote>(.*?)<\/quote>/", $b="<q>\$1</q>", $texte);
	if(strpos($texte, "<qu")!==false) {
		$texte = preg_replace($a, $b, $texte);
		if(strpos($texte, "<qu")!==false) $texte = preg_replace($a, $b, $texte);
	}
	return $texte;
}',
)); 

add_variable( array(
	'nom' => 'decoration_styles',
	'format' => _format_CHAINE,
	'lignes' => 8,
	'defaut' => '"span.sc = font-variant:small-caps;
span.souligne = text-decoration:underline;
span.barre = text-decoration:line-through;
span.dessus = text-decoration:overline;
span.clignote = text-decoration:blink;
span.surfluo = background-color:#ffff00; padding:0px 2px;
span.surgris = background-color:#EAEAEC; padding:0px 2px;
fluo = surfluo"',
	'code:trim(%s)' => 'function _decoration_BALISES() { return trim(%s); }',
));
add_outil( array(
	'id' => 'decoration',
	'auteur' 	 => 'izo@aucuneid.net, Pat',
	'contrib'	=> 2427,
	'categorie'	 => 'typo-racc',
	'code:options' => "%%decoration_styles%%",
	'pipeline:pre_typo' => 'decoration_pre_typo',
	'pipeline:bt_toolbox' => 'decoration_BarreTypo',
	'pipeline:porte_plume_barre_pre_charger' => 'decoration_PP_pre_charger',
	'pipeline:porte_plume_lien_classe_vers_icone' => 'decoration_PP_icones',
));

add_variables( array(
	'nom' => 'couleurs_fonds',
	'format' => _format_NOMBRE,
	'radio' => array(1 => 'item_oui', 0 => 'item_non' ),
	'defaut' => 1,
	'code' => "define('_COULEURS_FONDS', %s);\n",
), array(
	'nom' => 'set_couleurs',
	'format' => _format_NOMBRE,
	'radio' => array(0 => 'couteauprive:toutes_couleurs', 1 => 'couteauprive:certaines_couleurs'),
	'radio/ligne' => 1,
	'defaut' => 0,
	'code' => "define('_COULEURS_SET', %s);\n",
), array(
	'nom' => 'couleurs_perso',
	'format' => _format_CHAINE,
	'lignes' => 3,
	'defaut' => '"gris, rouge"',
	'code' => "define('_COULEURS_PERSO', %s);",
));
add_outil( array(
	'id' => 'couleurs',
	'auteur' 	 => 'Aur&eacute;lien PIERARD (id&eacute;e originale), Pat',
	'categorie'	 => 'typo-racc',
	'contrib'	=> 2427,
	'pipeline:pre_typo' => 'couleurs_pre_typo',
	'pipeline:nettoyer_raccourcis_typo' => 'couleurs_nettoyer_raccourcis',
	'pipeline:bt_toolbox' => 'couleurs_BarreTypo',
	'pipeline:porte_plume_barre_pre_charger' => 'couleurs_PP_pre_charger',
	'pipeline:porte_plume_lien_classe_vers_icone' => 'couleurs_PP_icones',
	'pipeline:pre_description_outil' => 'couleurs_pre_description_outil',
	'code:options' => "%%couleurs_fonds%%%%set_couleurs%%%%couleurs_perso%%",
	'code:fonctions' => "// aide le Couteau Suisse a calculer la balise #INTRODUCTION
include_spip('outils/couleurs');
\$GLOBALS['cs_introduire'][] = 'couleurs_nettoyer_raccourcis';
",
));

// outil essentiellement français. D'autres langues peuvent etre ajoutees dans outils/typo_exposants.php
add_variable( array(
	'nom' => 'expo_bofbof',
	'format' => _format_NOMBRE,
	'radio' => array(1 => 'item_oui', 0 => 'item_non' ),
	'defaut' => 0,
	'code:%s' => "define('_CS_EXPO_BOFBOF', %s);",
));
add_outil( array(
	'id' => 'typo_exposants',
	'auteur' 	 => 'Vincent Ramos, Pat',
	'categorie'	 => 'typo-corr',
	'contrib'	=> 1564,
	'code:options' => '%%expo_bofbof%%',
	'pipeline:post_typo' => 'typo_exposants',
	'code:css' => 'sup, sup.typo_exposants { font-size:78%; font-variant:inherit; line-height:inherit; vertical-align:23%; }',
));

add_outil( array(
	'id' => 'guillemets',
	'auteur' 	 => 'Vincent Ramos',
	'categorie'	 => 'typo-corr',
	'pipeline:post_typo' => 'typo_guillemets',
));

add_variables( array(
	'nom' => 'liens_interrogation',
	'format' => _format_NOMBRE,
	'radio' => array(1 => 'item_oui', 0 => 'item_non'),
	'defaut' => 1,
	'code:%s' => "\$GLOBALS['liens_interrogation']=true;\n",
), array(
	'nom' => 'liens_orphelins',
	'format' => _format_NOMBRE,
	'radio' => array(-1 => 'item_non', 0 => 'couteauprive:basique', 1 => 'couteauprive:etendu', -2 => 'couteauprive:par_defaut'),
	'defaut' => 0,
	'code' => '$GLOBALS["liens_orphelins"]=%s;',
		// empeche SPIP de convertir les URLs orphelines (URLs brutes)
	'code:%s<>-2' => defined('_SPIP19300')?"\n// Pas de traitement automatique des liens orphelins :\n\$GLOBALS['spip_pipeline']['pre_liens']=str_replace('|traiter_raccourci_liens','',\$GLOBALS['spip_pipeline']['pre_liens']);
@define('_EXTRAIRE_LIENS',',^\$,');":'',
), array(
	'nom' => 'long_url',
	'format' => _format_NOMBRE,
	'defaut' => 40,
	'code:%s' => "define('_MAX_LONG_URL', %s);",
), array(
	'nom' => 'coupe_url',
	'format' => _format_NOMBRE,
	'defaut' => 35,
	'code:%s' => "define('_MAX_COUPE_URL', %s);",
));
// attention : liens_orphelins doit etre place avant mailcrypt ou liens_en_clair
add_outil( array(
	'id' => 'liens_orphelins',
	'categorie'	 => 'typo-corr',
	'contrib'	=> 2443,
	'code:options' => '%%liens_interrogation%%',
	'code:spip_options' => '%%liens_orphelins%%%%long_url%%%%coupe_url%%',
	'pipeline:pre_propre' => 'liens_orphelins_pipeline',
	'traitement:EMAIL' => 'liens_orphelins_email',
	'pipeline:recuperer_fond' => 'liens_orphelins_recuperer_fond',
 	'pipeline:pre_typo'   => 'interro_pre_typo',
 	'pipeline:post_propre'   => 'interro_post_propre',
	'description' => defined('_SPIP19300')?'<:liens_orphelins::><liens_orphelins valeur="0/1/-2"><:liens_orphelins:1:></liens_orphelins>':'<:liens_orphelins::>',
));

add_outil( array(
	'id' => 'filets_sep',
	'auteur' 	 => 'FredoMkb',
	'categorie'	 => 'typo-racc',
	'contrib'	=> 1563,
	'pipeline:pre_typo' => 'filets_sep',
	'pipeline:bt_toolbox' => 'filets_sep_BarreTypo',
	'pipeline:porte_plume_barre_pre_charger' => 'filets_PP_pre_charger',
	'pipeline:porte_plume_lien_classe_vers_icone' => 'filets_PP_icones',
));

add_outil( array(
	'id' => 'smileys',
	'auteur' 	 => "Sylvain, Pat",
	'categorie'	 => 'typo-corr',
	'contrib'	=> 1561,
	'code:css' => "table.cs_smileys td {text-align:center; font-size:90%; font-weight:bold;}",
	'pipeline:pre_typo' => 'cs_smileys_pre_typo',
	'pipeline:bt_toolbox' => 'cs_smileys_BarreTypo',
	'pipeline:porte_plume_barre_pre_charger' => 'cs_smileys_PP_pre_charger',
	'pipeline:porte_plume_lien_classe_vers_icone' => 'cs_smileys_PP_icones',
));

add_outil( array(
	'id' => 'chatons',
	'auteur' 	 => "BoOz, Pat",
	'categorie'	 => 'typo-racc',
	'pipeline:pre_typo' => 'chatons_pre_typo',
	'pipeline:bt_toolbox' => 'chatons_BarreTypo',
	'pipeline:porte_plume_barre_pre_charger' => 'chatons_PP_pre_charger',
	'pipeline:porte_plume_lien_classe_vers_icone' => 'chatons_PP_icones',
));

add_variables( array(
	'nom' => 'glossaire_groupes',
	'format' => _format_CHAINE,
	'defaut' => "'Glossaire'",
	'code' => "\$GLOBALS['glossaire_groupes']=%s;\n",
	'commentaire' => defined('_SPIP19300')?'fct_glossaire_groupes(%s);
function fct_glossaire_groupes($gr){
	$s=""; 
	foreach(explode(":",$gr) as $g)
		if(!sql_countsel("spip_groupes_mots", "titre="._q($g)))	$s.=($s?"<br />":"")._T("couteauprive:erreur_groupe", array("groupe"=>$g));
	return $s?"<p style=\"color:red\">$s</p>":"";
}':NULL,
), array(
	'nom' => 'glossaire_limite',
	'format' => _format_NOMBRE,
	'defaut' => 0,
	'code:%s>0' => "define('_GLOSSAIRE_LIMITE', %s);\n",
), array(
	'nom' => 'glossaire_js',
	'radio' => array(0 => 'couteauprive:glossaire_css', 1 => 'couteauprive:glossaire_js'),
	'format' => _format_NOMBRE,
	'defaut' => 1,
	'code:%s' => "define('_GLOSSAIRE_JS', %s);",
), array(
	'nom' => 'glossaire_abbr',
	'check' => 'couteauprive:glossaire_abbr',
	'defaut' => 1,
	'format' => _format_NOMBRE,
	'code:!%s' => "@define('_GLOSSAIRE_ECHAPPER', 'html|code|cadre|frame|script|cite|a');",
));
add_outil( array(
	'id' => 'glossaire',
	'categorie'	=> 'typo-corr',
	'contrib'	=> 2206,
	'code:options' => "@define('_CS_SANS_GLOSSAIRE', '[!glossaire]');\n%%glossaire_limite%%%%glossaire_groupes%%%%glossaire_js%%%%glossaire_abbr%%",
//	'traitement:LIEU:post_propre' => 'cs_glossaire',
	// sans oublier les articles, les breves, les forums et les rubriques !
	// SPIP ne considere pas que la premiere definition est un tronc commun...
	// meme traitement au chapo des articles...
	'traitement:TEXTE:post_propre,
	 traitement:TEXTE/articles:post_propre,
	 traitement:TEXTE/breves:post_propre,
	 traitement:TEXTE/forums:post_propre,
	 traitement:TEXTE/rubriques:post_propre,
	 traitement:CHAPO:post_propre' => 'cs_glossaire',
	// Precaution pour les articles virtuels (SPIP < 3.0)
	defined('_SPIP30000')?'foo':'traitement:CHAPO:pre_propre' => 'nettoyer_chapo',
	// Mise en forme des titres
	'traitement:TITRE/mots:post_typo' => 'cs_glossaire_titres',
	'code:css' =>  'a.cs_glossaire:after {display:none;}',
	// fonction glossaire_init() codee dans glossaire.js : executee lors du chargement de la page et a chaque hit ajax
	'code:jq_init' => 'glossaire_init.apply(this);',
	'pipelinecode:nettoyer_raccourcis_typo' => '$flux=str_replace(_CS_SANS_GLOSSAIRE, "", $flux);',
));

// attention : mailcrypt doit etre place apres liens_orphelins
add_variables( array(
	'nom' => 'balise_email',
	'check' => 'couteauprive:mailcrypt_balise_email',
	'defaut' => 1,
	'label' => '@_CS_CHOIX@',
	'code:%s' => "define('_MAILCRYPT_TRAITE_EMAIL', '1');\n",
), array(
	'nom' => 'fonds_demailcrypt',
	'check' => 'couteauprive:mailcrypt_fonds',
	'defaut' => 0,
	'label' => '@_CS_CHOIX@',
), array(
	'nom' => 'fonds_demailcrypt2',
	'format' => _format_CHAINE,
	'lignes' => 4,
	'defaut' => '"saisies-vues/_base:\nnotifications/formulaire_email:\nnotifications/formulaire_accuse"',
	'code' => "if(%%fonds_demailcrypt%%) define('_MAILCRYPT_FONDS_DEMAILCRYPT', %s);",
));
add_outil( array(
	'id' => 'mailcrypt',
	'categorie'	=> 'securite',
	'auteur' 	=> "Alexis Roussel, Paolo, Pat",
	'contrib'	=> 2443,
	'code:options' => '%%balise_email%%%%fonds_demailcrypt2%%',
	'description' => '<:mailcrypt::>[[%balise_email%]][[->%fonds_demailcrypt%]][[->%fonds_demailcrypt2%]]',
	'pipelinecode:post_propre' => "if(strpos(\$flux, '@')!==false) \$flux=cs_echappe_balises('', 'mailcrypt', \$flux);",
	'code:js' => "function lancerlien(a,b){ x='ma'+'ilto'+':'+a+'@'+b; return x; }",
	// jQuery pour remplacer l'arobase image par l'arobase texte
	// ... puis arranger un peu le title qui a ete protege
	'code:jq_init' => "jQuery('span.spancrypt', this).attr('class','cryptOK').html('&#6'+'4;');
	jQuery(\"a[\"+cs_sel_jQuery+\"title*='..']\", this).each(function () {
		this.title = this.title.replace(/\.\..t\.\./,'[@]');
	});",
	'code:css' => 'span.spancrypt {background:transparent url(' . url_absolue(find_in_path('img/mailcrypt/leure.gif'))
		. ') no-repeat scroll 0.1em center; padding-left:12px; text-decoration:none;}',
	'traitement:EMAIL' => 'mailcrypt_email_dist',
	 	'pipeline:recuperer_fond'   => 'mailcrypt_recuperer_fond',
	// compatibilite avec le plugin facteur
 	'pipelinecode:facteur_pre_envoi'   => 'include_spip("public/parametrer"); // charger mes_fonctions
$flux->Body = maildecrypt($flux->Body);
$flux->AltBody = maildecrypt($flux->AltBody);',
)); 


// attention : liens_en_clair doit etre place apres tous les outils traitant des liens
add_outil( array(
	'id' => 'liens_en_clair',
	'categorie'	 => 'spip',
	'contrib'	=> 2443,
	'pipeline:post_propre' => 'liens_en_clair_post_propre',
	'code:css' => 'a.spip_out:after {display:none;}',
)); 

add_variables( array(	// variable utilisee par 'pipelinecode:insert_head'
	'nom' => 'scrollTo',
	'check' => 'couteauprive:jq_scrollTo',
	'defaut' => 1,
	'format' => _format_NOMBRE,
), array(	// variable utilisee par 'pipelinecode:insert_head'
	'nom' => 'LocalScroll',
	'check' => 'couteauprive:jq_localScroll',
	'defaut' => 1,
	'format' => _format_NOMBRE,
));
add_outil( array(
	'id' => 'soft_scroller',
	'categorie'	=> 'public',
	'pipelinecode:insert_head' => 'if(%%scrollTo%%) {$flux.=\'<script src="\'.find_in_path("outils/jquery.scrollto.js").\'" type="text/javascript"></script>\'."\n";}
if(%%LocalScroll%%) {$flux.=\'<script src="\'.find_in_path("outils/jquery.localscroll.js").\'" type="text/javascript"></script>\'."\n";}',
	'code:js_public' => 'function soft_scroller_init() { if(typeof jQuery.localScroll=="function")
	jQuery.localScroll({hash: true, onAfter:function(anchor,settings){jQuery(anchor).focus();}});
}',
	'code:jq_init_public' => 'soft_scroller_init.apply(this);',
));

// http://www.malsup.com/jquery/corner/
add_variables( array(
	'nom' => 'jcorner_classes',
	'format' => _format_CHAINE,
	'lignes' => 10,
	'defaut' => defined('_SPIP19300')?'"// coins ronds aux formulaires
.formulaire_inscription, .formulaire_forum, .formulaire_ecrire_auteur

// colorisation de la dist de SPIP 2.0 en ajoutant un parent
\".chapo, .texte\" = wrap(\'<div class=\"jc_parent\" style=\"padding:4px; background-color:#ffe0c0; margin:4px 0;\"><\/div>\')
\".menu\" = wrap(\'<div class=\"jc_parent\" style=\"padding:4px; background-color:lightBlue; margin:4px 0;\"><\/div>\')

// coins ronds aux parents !
.jc_parent"'
		:'" // coins ronds pour les menus de navigation
.rubriques, .breves, .syndic, .forums, .divers

 // en couleurs sur l\'accueil
.liste-articles li .texte = css(\'background-color\', \'#E0F0F0\') .corner()

// colorisation de la dist de SPIP 1.92 en ajoutant un parent
\"#contenu .texte\" = wrap(\'<div class=\"jc_parent\" style=\"padding:4px; background-color:#E0F0F0; margin:4px 0;\"><\/div>\')

// coins ronds aux parents !
.jc_parent"',
	'code:trim(%s)' => 'function _jcorner_CLASSES() { return trim(%s); }',
), array(	// variable utilisee par 'pipelinecode:insert_head'
	'nom' => 'jcorner_plugin',
	'check' => 'couteauprive:jcorner_plugin',
	'defaut' => 1,
	'format' => _format_NOMBRE,
));
add_outil( array(
	'id' => 'jcorner',
	'categorie'	=> 'public',
	'contrib'	=> 2987,
	'code:options' => "%%jcorner_classes%%",
	// fichier distant pour le plugin jQuery : http://github.com/malsup/corner/commits/
	'distant' => defined('_SPIP20100')
		// version 2.13 (19-FEB-2013), jQuery v1.3.2 mini 
		?'http://raw.github.com/malsup/corner/82114d5699feea4c66bf093a9a615387857eca02/jquery.corner.js'
		// version 2.03 (05-DEC-2009) 
		:'http://github.com/malsup/corner/raw/46bbbc8706853c879c9224b7ebf5f284f726314d/jquery.corner.js',
	'pipelinecode:insert_head' => 'if(%%jcorner_plugin%%) {$flux.=\'<script src="\'.find_in_path("lib/jcorner/distant_jquery.corner.js").\'" type="text/javascript"></script>\'."\n";}',
	'pipeline:insert_head' => 'jcorner_insert_head',
	// jcorner_init() n'est disponible qu'en partie publique
	'code:jq_init_public' => 'if(typeof jcorner_init=="function") jcorner_init.apply(this);',
));

add_variables( array(
	'nom' => 'insertions',
	'format' => _format_CHAINE,
	'lignes' => 10,
	'defaut' => '"oeuf = &oelig;uf
cceuil = ccueil
(a priori) = {a priori}
(([hH])uits) = $1uit
/([cC]h?)oeur/ = $1&oelig;ur
/oeuvre/ = &oelig;uvre
(O[Ee]uvre([rs]?)) = &OElig;uvre$1
/\b([cC]|[mM].c|[rR]ec)on+ais+a((?:n(?:ce|te?)|ble)s?)\b/ = $1onnaissa$2
"',
	'code' => 'function _insertions_LISTE() { return trim(%s); }',
));
add_outil( array(
	'id' => 'insertions',
	'categorie'	 => 'typo-corr',
	'code:options' => "%%insertions%%",
	// sans oublier les articles, les breves, les forums et les rubriques !
	// SPIP ne considere pas que la premiere definition est un tronc commun :
	'traitement:CHAPO:pre_propre,
	 traitement:PS:pre_propre,
	 traitement:TEXTE:pre_propre,
	 traitement:TEXTE/articles:pre_propre,
	 traitement:TEXTE/breves:pre_propre,
	 traitement:TEXTE/forums:post_propre,
	 traitement:TEXTE/rubriques:pre_propre' => 'insertions_pre_propre',
));

// le plugin moderation moderee dans le couteau suisse
include_spip('inc/charsets');
add_outil( array(
	'id' => 'moderation_moderee',
	'auteur' => 'Yohann(potter64)',
	'categorie' => 'admin',
	'version-min' => '1.9300',
	'code:options' => '%%moderation_admin%%%%moderation_redac%%%%moderation_visit%%',
	'code:jq_init_public' => 'if(window.location.search.match(/page=forum/)!=null) jQuery("legend:contains(\''
		.addslashes(unicode2charset(html2unicode(_T((defined('_SPIP30000')?'forum:':'').'bouton_radio_modere_priori')))).'\')", this).next().html(\''
		.addslashes(_T('couteauprive:moderation_message')).'\');',
	'pipeline:pre_edition' => 'moderation_vip',
));
add_variables( array(
	'nom' => 'moderation_admin',
	'check' => 'couteauprive:moderation_admins',
	'defaut' => 1,
	'code:%s' => "define('_MOD_MOD_0minirezo',%s);",
), array(
	'nom' => 'moderation_redac',
	'check' => 'couteauprive:moderation_redacs',
	'defaut' => 0,
	'code:%s' => "define('_MOD_MOD_1comite',%s);",
), array(
	'nom' => 'moderation_visit',
	'check' => 'couteauprive:moderation_visits',
	'defaut' => 0,
	'code:%s' => "define('_MOD_MOD_6forum',%s);",
));

add_outil( array(
	'id' => 'titre_parent',
	'categorie' => 'spip',
	'contrib' => 2900,
	'code:options' => '%%titres_etendus%%',
));
add_variable( array(
	'nom' => 'titres_etendus',
	'check' => 'couteauprive:titres_etendus',
	'format' => _format_NOMBRE,
	'radio' => array(1 => 'item_oui', 0 => 'item_non'),
	'defaut' => 0,
	'code:%s' => "define('_PARENTS_ETENDUS',%s);",
));

add_outil( array(
	'id' => 'balise_set',
	'categorie' => 'spip',
	'contrib' => 4336,	
));

add_outil( array(
	'id' => 'corbeille',
	'categorie' => 'admin',
	'version-min' => '1.9300',
	'code:options' => "%%arret_optimisation%%",
));
add_variable( array(
	'nom' => 'arret_optimisation',
	'format' => _format_NOMBRE,
	'radio' => array(1 => 'item_oui', 0 => 'item_non'),
	'defaut' => 0,
	'code:%s' => "define('_CORBEILLE_SANS_OPTIM', 1);
if(!function_exists('genie_optimiser')) { 
	// surcharge de la fonction d'optimisation de SPIP (inc/optimiser.php)
	function genie_optimiser(\$t='foo'){ if(include_spip('optimiser','genie')) optimiser_base_une_table(); return -(mktime(2,0,0) + rand(0, 3600*4)); }\n}",
));

add_outil( array(
	'id' => 'trousse_balises',
	'categorie' => 'spip',
	'contrib' => 3005,
));

add_outil( array(
	'id' => 'horloge',
	'categorie' => 'spip',
	'contrib' => 2998,
	'pipelinecode:insert_head,
	 pipelinecode:header_prive' => '$flux.=\'<script type="text/javascript" src="\'.generer_url_public(\'cout_dates.js\',\'lang=\'.$GLOBALS[\'spip_lang\']).\'"></script>
<script type="text/javascript" src="\'.find_in_path("outils/jquery.jclock.js").\'"></script>\'."\n";',
	'code:jq_init' => 'jclock_init.apply(this);',
));

add_variable( array(
	'nom' => 'timezone',
	'format' => _format_CHAINE,
	'defaut' => "function_exists('date_default_timezone_get') && date_default_timezone_get()?date_default_timezone_get():'Europe/Paris'",
	'code:%s' => "if(function_exists('date_default_timezone_set')) date_default_timezone_set(%s);",
	'label' => '@_CS_CHOIX@',
));
add_outil( array(
	'id' => 'timezone',
	'categorie' => 'devel',
	'code:spip_options' => '%%timezone%%',
#	'autoriser' => "function_exists('date_default_timezone_get')", // Outil pour php 5.1 mini
	'pipelinecode:pre_description_outil' => 'if($id=="timezone")
		$texte=str_replace("@_CS_TZ@","<b>".(!(function_exists("date_default_timezone_get") && date_default_timezone_get())?"<span style=\\"color: red;\\">??</span>":@date_default_timezone_get())."</b> (PHP ".phpversion().")",$texte);',
));

$cs_temp = defined('_SPIP30000')?array(
	'distant_action' => 'http://core.spip.org/projects/spip/repository/raw/branches/spip-2.1/ecrire/action/charger_plugin.php',
	'distant_inc' => 'http://core.spip.org/projects/spip/repository/raw/branches/spip-2.1/ecrire/inc/charger_plugin.php',
):(defined('_SPIP20100')?array():array(
	'version-min' => '1.9300',
	'distant' => 'http://core.spip.org/projects/spip/repository/raw/branches/spip-2.1/ecrire/genie/mise_a_jour.php',
));
add_outil(array_merge(array(
	'id' => 'maj_auto',
	'categorie' => 'securite',
	'contrib' => 3223,
	'pipelinecode:fichier_distant' => defined('_SPIP30000')
		?'// rajeunissement pour SPIP3 (2e appel du pipeline)
if($flux["outil"]=="maj_auto" && isset($flux["texte"]) && strpos($flux["fichier_distant"],"action/charger_plugin.php")!==false)
	$flux["texte"] = str_replace(array("\'icon\'","include_spip(\'inc/install\');"), array("\'logo\'", "if(_request(\'cs_retour\')) return array(\'nom\'=>\$retour, \'suite\'=>\$suite, \'fichier\'=>\$fichier, \'tmp\'=>\$status[\'tmpname\']);\n\tinclude_spip(\'inc/install\');"), $flux["texte"]);':'',
), $cs_temp));

// reglage des differents selecteurs en partie privee
add_outil( array(
	'id' => 'brouteur',
	'categorie' => 'interface',
	'code:spip_options' => "%%rubrique_brouteur%%%%select_mots_clefs%%%%select_min_auteurs%%%%select_max_auteurs%%"
));
add_variable( array(
	'nom' => 'rubrique_brouteur',
	'format' => _format_NOMBRE,
	'defaut' => 20,
	'code:%s' => "define('_SPIP_SELECT_RUBRIQUES', %s);"
));
add_variable( array(
	'nom' => 'select_mots_clefs',
	'format' => _format_NOMBRE,
	'defaut' => 50,
	'code:%s<>50' => "define('_MAX_MOTS_LISTE', %s);"
));
add_variable( array(
	'nom' => 'select_min_auteurs',
	'format' => _format_NOMBRE,
	'defaut' => 30,
	'code:%s<>30' => "define('_SPIP_SELECT_MIN_AUTEURS', %s);"
));
add_variable( array(
	'nom' => 'select_max_auteurs',
	'format' => _format_NOMBRE,
	'defaut' => 30,
	'code:%s<>30' => "define('_SPIP_SELECT_MAX_AUTEURS', %s);"
));

// largeur d'ecran de la partie privee
add_variable( array(
	'nom' => 'spip_ecran',
	'format' => _format_CHAINE,
	'radio' => array('defaut' => 'couteauprive:par_defaut', 'large' => 'spip:info_grand_ecran', 'etroit' => 'spip:info_petit_ecran'),
	'defaut' => 'defaut',
	'label' => '@_CS_CHOIX@',
	"code:%s!='defaut'" => "\$GLOBALS['spip_ecran']=\$_COOKIE['spip_ecran']=%s;",
));
add_outil( array(
	'id' => 'spip_ecran',
	'categorie' => 'interface',
	'code:spip_options' => '%%spip_ecran%%',
	'pipelinecode:header_prive' => '$e = _request(\'exec\');
if(( $e==\'configurer_preferences\' ||  $e==\'config_preferences\' /* SPIP < 3 */) && "%%spip_ecran%%"!="defaut") {
	$flux.=\'<script type="text/javascript"><!--
function disable_spip_ecran(){ jQuery("[name=\\"spip_ecran\\"]").attr("disabled", "disabled"); }
if(typeof onAjaxLoad=="function") onAjaxLoad(disable_spip_ecran);
if(window.jQuery) jQuery(document).ready(disable_spip_ecran);
//--></script>\'; }',
));

add_variables( array(
	'nom' => 'alerte_message',
	'format' => _format_CHAINE,
	'lignes' => 6,
	'defaut' => '',
	'label' => _T('info_texte_message'),
	'code' => "define('_alerte_MESSAGE', %s);"
));
add_outil( array(
	'id' => 'alerte_urgence',
	'categorie' => 'public',
	'auteur' => 'Cerdic',
	'code:options' => '%%alerte_message%%',
	'pipelinecode:affichage_final' => 'if($GLOBALS[\'html\'] AND ($p=strpos($flux,\'</body>\'))!==false) {
		include_spip(\'public/assembler\');
		$flux = substr_replace($flux, recuperer_fond(\'fonds/alerte_urgence\'), $p, 0);
}',
));

add_outil( array(
	'id' => 'sessions_anonymes',
	'categorie' => 'securite',
	'pipelinecode:taches_generales_cron' => '$flux[\'nettoyer_sessions_anonymes\'] = 7*24*3600;',
	'pipeline:pre_description_outil' => 'sessions_anonymes_pre_description_outil',
	'code:options' => 'function cron_nettoyer_sessions_anonymes() { genie_nettoyer_sessions_anonymes(); } // Pour SPIP 1.92
function genie_nettoyer_sessions_anonymes() { include_spip(\'outils/sessions_anonymes\'); cs_nettoyer_sessions_anonymes(); }',
	'version-max' => '17743', // SPIP 3.0 : c'est dans le core !
));

// Recuperer tous les outils (et leurs variables) de la forme outils/toto_config.xml
foreach (find_all_in_path('outils/', '\w+_config\.xml$') as $f) {
	add_outils_xml($f);
}

// Recuperer tous les outils de la forme outils/monoutil_config.php
// y compris les lames perso dont on met le nom en italiques
global $outils;
foreach (find_all_in_path('outils/', '\w+_config\.php$') as $f) 
if(preg_match(',^([^.]*)_config$,', basename($f, '.php'),$regs)){
	if($outil = charger_fonction($regs[0], 'outils')) $outil();
	/*else {
		// compatibilite ...	
		include $f;
		if(function_exists($cs_temp=$regs[1].'_add_outil')) {
			$cs_temp = $cs_temp();
			$cs_temp['id'] = $regs[1];
			add_outil($cs_temp);
		}
	}*/
	if(isset($outils[$regs[1]]) && strncmp($f, _DIR_PLUGIN_COUTEAU_SUISSE, strlen(_DIR_PLUGIN_COUTEAU_SUISSE))!=0)
		$outils[$regs[1]]['perso'] = 1;
}

// Nettoyage
unset($cs_temp);

// Ajout des outils personnalises sous forme globale
if(isset($GLOBALS['mes_outils'])) {
	foreach($GLOBALS['mes_outils'] as $id=>$outil) {
		$outil['id'] = $id;
		$outil['perso'] = 1;
		add_outil($outil);
	}
	unset($GLOBALS['mes_outils']);
}

// Idees d'ajouts :
// http://archives.rezo.net/spip-core.mbox/
// http://www.spip-contrib.net/Citations
// http://www.spip-contrib.net/la-balise-LESMOTS et d'autres balises #MAINTENANT #LESADMINISTRATEURS #LESREDACTEURS #LESVISITEURS
// http://www.spip-contrib.net/Ajouter-une-lettrine-aux-articles
// http://www.spip-contrib.net/Generation-automatique-de
// http://www.spip-contrib.net/Balise-LOGO-ARTICLE-ORITRAD
// boutonstexte

//global $cs_variables; cs_log($cs_variables, 'cs_variables :');
?>