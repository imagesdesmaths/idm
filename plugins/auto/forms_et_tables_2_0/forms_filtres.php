<?php
/*
 * forms
 * Gestion de formulaires editables dynamiques
 *
 * Auteurs :
 * Antoine Pitrou
 * Cedric Morin
 * Renato
 * (c) 2005,2006 - Distribue sous licence GNU/GPL
 *
 */

	include_spip("inc/forms");

	function Forms_insert_head($flux){
		$config = unserialize(isset($GLOBALS['meta']['forms_et_tables'])?$GLOBALS['meta']['forms_et_tables']:"");
		if (!isset($config['inserer_head']) OR $config['inserer_head']) {
			if ($GLOBALS['spip_version_code']<1.9207) {
				$flux .= 	"<link rel='stylesheet' href='".find_in_path('spip_forms.css')."' type='text/css' media='all' />\n";
				$flux .= 	"<link rel='stylesheet' href='".find_in_path('donnee_voir.css')."' type='text/css' media='all' />\n";
				$flux .= 	"<link rel='stylesheet' href='".find_in_path('donnees_tous.css')."' type='text/css' media='all' />\n";
				$flux .= 	"<link rel='stylesheet' href='"._DIR_PLUGIN_FORMS."img_pack/date_picker.css' type='text/css' media='all' />\n";
				$flux .= 	"<link rel='stylesheet' href='"._DIR_PLUGIN_FORMS."img_pack/jtip.css' type='text/css' media='all' />\n";
			}
			else 
				$flux .= "<link rel='stylesheet' href='".generer_url_public('forms_styles.css')."' type='text/css' media='all' />\n";
		}
		return $flux;
	}
	
	define('_RACCOURCI_MODELE_FORM', 
		 '(<(form)' # <modele
		.'\s*([0-9]*)\s*' # id
		.'([|](?:<[^<>]*>|[^>])*)?' # |arguments (y compris des tags <...>)
		.'>)' # fin du modele >
		.'\s*(<\/a>)?' # eventuel </a>
	       );
	
	function Forms_trouve_liens($texte){
		$forms = array();
		if (preg_match_all(','._RACCOURCI_MODELE_FORM.',is', $texte, $regs, PREG_SET_ORDER)){
			foreach ($regs as $r) {
				$id_form = $r[3];
				$forms[$id_form] = $id_form;
			}
		}
		return $forms;
	}

	function Forms_post_edition($flux){
		if ($flux['args']['table']!='spip_articles') return $flux;
		$id_article = intval($flux['args']['id_objet']);
		$res = spip_query("SELECT * FROM spip_articles WHERE id_article="._q($id_article));
		spip_query("DELETE FROM spip_forms_articles WHERE id_article=$id_article");
		if (($row = spip_fetch_array($res))
		 && (count($forms = Forms_trouve_liens(implode(' ',$row)))))
			spip_query("INSERT INTO spip_forms_articles (id_article, id_form) ".
				"VALUES ($id_article, ".join("), ($id_article, ", $forms).")");
		return $flux;
	}
	
	function Forms_forms_avant_propre($texte) {
		static $reset;
		if (_DIR_RESTREINT || $GLOBALS['spip_version_code']>=1.92) return $texte;
		// Mecanisme de mise a jour des liens en <=1.9.1
		if ((isset($_GET['exec']) 
		  AND $_GET['exec']=='articles' 
		  AND $id_article = intval($_GET['id_article']))){
			if (!$reset) {
				spip_query("DELETE FROM spip_forms_articles WHERE id_article=$id_article");
				$reset = true;
			}
			if (count($forms = Forms_trouve_liens($texte)))
				spip_query("INSERT INTO spip_forms_articles (id_article, id_form) ".
					"VALUES ($id_article, ".join("), ($id_article, ", $forms).")");
		}
	
		return $texte;
	}
	// compatibilite 1.9.1
	function Forms_forms_apres_propre($texte){
		// Reinserer le javascript de confiance (venant des modeles)
		$a = isset($GLOBALS['auteur_session']['alea_actuel'])?$GLOBALS['auteur_session']['alea_actuel']:'forms';
		$texte = echappe_retour($texte,"javascript".$a);
		return $texte;
	}

	// Hack crade a cause des limitations du compilateur
	function _Forms_afficher_reponses_sondage($id_form) {
		return Forms_afficher_reponses_sondage($id_form);
	}

	function wrap_split($wrap){
		$wrap_start="";
		$wrap_end="";
		if (preg_match(",<([^>]*)>,Ui",$wrap,$regs)){
			array_shift($regs);
			foreach($regs as $w){
				if ($w{0}=='/'){
				 //$wrap_end .= "<$w>";
				}
				else {
					if ($w{strlen($w)-1}=='/')
						$w = strlen($w)-1;
					$wrap_start .= "<$w>";
					$w = explode(" ",$w);
					if (is_array($w)) $w = $w[0];
					$wrap_end = "</$w>" . $wrap_end;
				}
			}
		}
		return array($wrap_start,$wrap_end);
	}
	
	function wrap_champ($texte,$wrap){
		if (!strlen(trim($wrap)) || !strlen(trim($texte))) return $texte;
		if (strpos($wrap,'$1')===FALSE){
			$wrap = wrap_split($wrap);
			$texte = array_shift($wrap).$texte.array_shift($wrap);
		}
		else 
			$texte = str_replace('$1',trim($texte),$wrap);
		return $texte;
	}
	
	function forms_valeur($tableserialisee,$cle,$defaut=''){
		$t = unserialize($tableserialisee);
		return isset($t[$cle])?$t[$cle]:$defaut;
	}
	
	// http://doc.spip.org/@puce_statut_article
	function forms_puce_statut_donnee($id, $statut, $id_form, $ajax = false) {
		include_spip('inc/instituer_forms_donnee');
		return puce_statut_donnee($id,$statut,$id_form,$ajax);
	}
	
?>