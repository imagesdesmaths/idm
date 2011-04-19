<?php
/*
 * forms
 * Gestion de formulaires editables dynamiques
 *
 * Auteurs :
 * Antoine Pitrou
 * Cedric Morin
 * Renato Formato
 * � 2005,2006 - Distribue sous licence GNU/GPL
 *
 */

	if (!defined('_DIR_PLUGIN_FORMS')){
		$p=explode(basename(_DIR_PLUGINS)."/",str_replace('\\','/',realpath(dirname(__FILE__))));
		define('_DIR_PLUGIN_FORMS',(_DIR_PLUGINS.end($p))."/");
	}

	function Forms_ajouter_boutons($boutons_admin) {
		if ($GLOBALS['spip_version_code']<1.92){
			include_spip('inc/autoriser_compat');
        }
        
       
		if (autoriser('administrer','form',0)) {
		   $liste_plugin = unserialize($GLOBALS['meta']['plugin']);
        if (array_key_exists('BANDO',$liste_plugin)==true){
	       // on voit le bouton dans la barre "naviguer"
			$boutons_admin['bando_edition']->sousmenu["forms_tous"]= new Bouton(
			_DIR_PLUGIN_FORMS."img_pack/form-24.gif",  // icone
			_T("forms:formulaires_sondages") //titre
			);
			
		  // on voit le bouton dans la barre "naviguer"
			$boutons_admin['bando_edition']->sousmenu["tables_tous"]= new Bouton(
			_DIR_PLUGIN_FORMS."img_pack/table-24.gif",  // icone
			_T("forms:tables") //titre
			);
	       }
	   else{	
		  // on voit le bouton dans la barre "naviguer"
			$boutons_admin['naviguer']->sousmenu["forms_tous"]= new Bouton(
			_DIR_PLUGIN_FORMS."img_pack/form-24.gif",  // icone
			_T("forms:formulaires_sondages") //titre
			);
			
		  // on voit le bouton dans la barre "naviguer"
			$boutons_admin['naviguer']->sousmenu["tables_tous"]= new Bouton(
			_DIR_PLUGIN_FORMS."img_pack/table-24.gif",  // icone
			_T("forms:tables") //titre
			);
		}
		}
		return $boutons_admin;
	}
	
	function Forms_affiche_milieu($flux) {
		$exec =  $flux['args']['exec'];
		$config = unserialize(isset($GLOBALS['meta']['forms_et_tables'])?$GLOBALS['meta']['forms_et_tables']:"");
		switch ($exec){
			case 'articles' :
				$liste_type = (isset($GLOBALS['forms_type_associer']['article'])?$GLOBALS['forms_type_associer']['article']:array());
				if (isset($config['associer_donnees_articles']) AND $config['associer_donnees_articles'])
					$liste_type = array_merge($liste_type,array('table'));
				if (count($liste_type)){
					include_spip('base/forms_base_api');
					foreach($liste_type as $type)
						if (count(Forms_liste_tables($type))){
							$id_article = $flux['args']['id_article'];
							$forms_lier_donnees = charger_fonction('forms_lier_donnees','inc');
							$flux['data'] .= "<div id='forms_lier_donnees'>";
							$flux['data'] .= $forms_lier_donnees('article',$id_article, $exec, false, $type);
							$flux['data'] .= "</div>";
						}
				}
				break;
			case 'naviguer':
				$liste_type = (isset($GLOBALS['forms_type_associer']['rubrique'])?$GLOBALS['forms_type_associer']['rubrique']:array());
				if (isset($config['associer_donnees_rubriques']) AND $config['associer_donnees_rubriques'])
					$liste_type = array_merge($liste_type,array('table'));
				$id_rubrique = $flux['args']['id_rubrique'];
				if (count($liste_type) && $id_rubrique){
					include_spip('base/forms_base_api');
					foreach($liste_type as $type)
						if (count(Forms_liste_tables($type))){
							$forms_lier_donnees = charger_fonction('forms_lier_donnees','inc');
							$flux['data'] .= "<div id='forms_lier_donnees'>";
							$flux['data'] .= $forms_lier_donnees('rubrique',$id_rubrique, $exec, false, $type);
							$flux['data'] .= "</div>";
						}
				}
				break;
			case 'auteur_infos':
				$liste_type = (isset($GLOBALS['forms_type_associer']['auteur'])?$GLOBALS['forms_type_associer']['auteur']:array());
				if (isset($config['associer_donnees_auteurs']) AND $config['associer_donnees_auteurs'])
					$liste_type = array_merge($liste_type,array('table'));
				if (count($liste_type)){
					include_spip('base/forms_base_api');
					foreach($liste_type as $type)
						if (count(Forms_liste_tables($type))){
							$id_auteur = $flux['args']['id_auteur'];
							$forms_lier_donnees = charger_fonction('forms_lier_donnees','inc');
							$flux['data'] .= "<div id='forms_lier_donnees'>";
							$flux['data'] .= $forms_lier_donnees('auteur',$id_auteur, $exec, false, $type);
							$flux['data'] .= "</div>";
						}
				}
				break;
		}
		return $flux;
	}
	
	function Forms_affiche_droite($flux){
		if (_request('exec')=='articles_edit'){
			include_spip('inc/forms');
			$flux['data'] .= Forms_afficher_insertion_formulaire($flux['args']['id_article']);
		}
		return $flux;
	}
	function Forms_header_prive($flux){
		if ($f=find_in_path('spip_forms_prive.css'))
			$flux .= "<link rel='stylesheet' href='$f' type='text/css' media='all' />\n";
		else
			$flux .= "<link rel='stylesheet' href='"._DIR_PLUGIN_FORMS."spip_forms.css' type='text/css' media='all' />\n";
		$flux .= "<link rel='stylesheet' href='"._DIR_PLUGIN_FORMS."donnee_voir.css' type='text/css' media='all' />\n";
		$flux .= "<link rel='stylesheet' href='"._DIR_PLUGIN_FORMS."donnees_tous.css' type='text/css' media='all' />\n";
		$flux .= "<link rel='stylesheet' href='"._DIR_PLUGIN_FORMS."img_pack/date_picker.css' type='text/css' media='all' />\n";
		$flux .= "<link rel='stylesheet' href='"._DIR_PLUGIN_FORMS."img_pack/jtip.css' type='text/css' media='all' />\n";
		$flux .= "<script type='text/javascript'><!--\n var ajaxcharset='utf-8';\n//--></script>";
		
		if (in_array(_request('exec'),array('articles','donnees_edit'))){
			$flux .= "<script src='".find_in_path('javascript/iautocompleter.js')."' type='text/javascript'></script>\n"; 
			$flux .= "<script src='".find_in_path('javascript/interface.js')."' type='text/javascript'></script>\n"; 
			if (!_request('var_noajax'))
				$flux .= "<script src='"._DIR_PLUGIN_FORMS."javascript/forms_lier_donnees.js' type='text/javascript'></script>\n";
		}

		if (_request('exec')=='forms_edit'){
			$flux .= "<script src='"._DIR_PLUGIN_FORMS."javascript/interface.js' type='text/javascript'></script>";
			if (!_request('var_noajax'))
				$flux .= "<script src='"._DIR_PLUGIN_FORMS."javascript/forms_edit.js' type='text/javascript'></script>";
			$flux .= 	"<link rel='stylesheet' href='"._DIR_PLUGIN_FORMS."spip_forms_edit.css' type='text/css' media='all' />\n";
		
			if($GLOBALS['meta']['multi_rubriques']=="oui" || $GLOBALS['meta']['multi_articles']=="oui")
				$active_langs = "'".str_replace(",","','",$GLOBALS['meta']['langues_multilingue'])."'";
			else
				$active_langs = "";
			$flux .= "<script src='".find_in_path('forms_lang.js')."' type='text/javascript'></script>\n". 
			"<script type='text/javascript'>\n".
			"var forms_def_lang='".$GLOBALS["spip_lang"]."';var forms_avail_langs=[$active_langs];\n".
			"$(forms_init_lang);\n".
			"</script>\n";
		}
		if (_request('exec')=='donnees_edit'){
			$flux .= "<link rel='stylesheet' href='"._DIR_PLUGIN_FORMS."img_pack/donnees_edit.css' type='text/css' media='all' />\n";
			$flux .= "<script src='"._DIR_PLUGIN_FORMS."javascript/interface.js' type='text/javascript'></script>";
			if (!_request('var_noajax'))
				$flux .= "<script src='"._DIR_PLUGIN_FORMS."javascript/donnees_edit.js' type='text/javascript'></script>";
		}
		return $flux;
	}
?>
