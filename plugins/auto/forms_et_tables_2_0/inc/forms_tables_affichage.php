<?php
/*
 * forms
 * Gestion de formulaires editables dynamiques
 *
 * Auteurs :
 * Antoine Pitrou
 * Cedric Morin
 * Renato
 * © 2005,2006 - Distribue sous licence GNU/GPL
 *
 */

include_spip('inc/forms');


if (version_compare($GLOBALS['spip_version_code'],'1.9300','>=')) {
// fonction de SPIP 1.9.2 présente dans inc/presentation, ayant disparue en 1.9.3
	function afficher_rubriques($titre_table, $requete) {
		global $options;
		$tmp_var = 't_' . substr(md5(join('', $requete)), 0, 4);
		$largeurs = array('12','', '');
		$styles = array('', 'arial2', 'arial11');
		return affiche_tranche_bandeau($requete, "rubrique-24.gif", "#999999", "white", $tmp_var, $titre_table, false, $largeurs, $styles, 'afficher_rubriques_boucle');
	}
}

function forms_inserer_crayons($out){
	$out = pipeline('affichage_final', "</head>".$out);
	$out = str_replace("</head>","",$out);
	return $out;
}

// l'argument align n'est plus jamais fourni
// http://doc.spip.org/@icone
function icone_etendue($texte, $lien, $fond, $fonction="", $align="", $afficher='oui', $expose=false){
	global $spip_display;

	if ($fonction == "supprimer.gif") {
		$style = '-danger';
	} else {
		$style = '';
		if ($expose) $style='-on';
		if (strlen($fonction) < 3) $fonction = "rien.gif";
	}

	if ($spip_display == 1){
		$hauteur = 20;
		$largeur = 100;
		$title = $alt = "";
	}
	else if ($spip_display == 3){
		$hauteur = 30;
		$largeur = 30;
		$title = "\ntitle=\"$texte\"";
		$alt = $texte;
	}
	else {
		$hauteur = 70;
		$largeur = 100;
		$title = '';
		$alt = $texte;
	}

	$size = 24;
	if (preg_match("/-([0-9]{1,3})[.](gif|png)$/i",$fond,$match))
		$size = $match[1];
	if ($spip_display != 1 AND $spip_display != 4){
		if ($fonction != "rien.gif"){
		  $icone = http_img_pack($fonction, $alt, "$title width='$size' height='$size'\n" .
					  http_style_background($fond, "no-repeat center center"));
		}
		else {
			$icone = http_img_pack($fond, $alt, "$title width='$size' height='$size'");
		}
	} else $icone = '';

	if ($spip_display != 3){
		$icone .= "<span>$texte</span>";
	}

	// cas d'ajax_action_auteur: faut defaire le boulot
	// (il faudrait fusionner avec le cas $javascript)
	if (preg_match(",^<a\shref='([^']*)'([^>]*)>(.*)</a>$,i",$lien,$r))
	  list($x,$lien,$atts,$texte)= $r;
	else $atts = '';
	$lien = "\nhref='$lien'$atts";

	$icone = "\n<table cellpadding='0' class='pointeur' cellspacing='0' border='0' width='$largeur'"
	. ">\n<tr><td class='icone36$style'>"
	. ($expose?"":"<a"
	. $lien
	. '>')
	. $icone
	. ($expose?"":"</a>")
	. "</td></tr></table>\n";

	if ($afficher == 'oui')	echo $icone; else return $icone;
}

function forms_barre_nav_gauche($page_actuelle,$liste_items){
	$out = "<style>
	.icone36-on{text-align:center;text-decoration:none;}
	.icone36-on img {-moz-border-radius-bottomleft:5px;-moz-border-radius-bottomright:5px;-moz-border-radius-topleft:5px;-moz-border-radius-topright:5px;
background-color:#FFFFFF;border:2px solid #666666;display:inline;margin:0pt;padding:4px;}
.icone36-on span {color:#000000;display:block;font-family:Verdana,Arial,Sans,sans-serif;font-size:10px;font-weight:bold;margin:2px;width:100%;}
.barre_nav .pointeur {margin-bottom:0.5em;}
</style><div class='barre_nav'>";
	foreach($liste_items as $item){
		$out .= icone_etendue($item['titre'], isset($item['url'])?$item['url']:generer_url_ecrire($item['page']), $item['icone'], isset($item['action'])?$item['action']:"rien.gif","", false, $page_actuelle==$item['page']);
	}
	return $out."</div>";
}

function afficher_tables_tous_corps($type_form, $link=NULL, $fond='fonds/tables_tous'){
	global $spip_lang_right;
	include_spip('public/assembler');
	if (!include_spip('inc/autoriser'))
		include_spip('inc/autoriser_compat');
	$out = "";
	$prefix = forms_prefixi18n($type_form);
	$contexte = array('type_form'=>$type_form,'prefix'=>$prefix,'titre_liste'=>_T("$prefix:toutes_tables"),'couleur_claire'=>$GLOBALS['couleur_claire'],'couleur_foncee'=>$GLOBALS['couleur_foncee']);
	$out .= recuperer_fond($fond,$contexte);

	if (autoriser('creer','form') && ($link!==false)) {
	  $icone = find_in_path("img_pack/".($type_form?$type_form:'form')."-24.png");
	  if (!$icone)
	  	$icone = _DIR_PLUGIN_FORMS."img_pack/table-24.png";
		$out .=  "<div align='$spip_lang_right'>";
		if ($link===NULL)
			$link=generer_url_ecrire('forms_edit', "new=oui&type_form=$type_form");
		$link=parametre_url($link,'retour',str_replace('&amp;', '&', self()));
		$out .=  icone(_T("$prefix:icone_creer_table"), $link, $icone, "creer.gif","",false);
		$out .=  "</div>";
	}
	return $out;
}

function afficher_tables_tous($type_form, $titre_page, $titre_type){
	global $spip_lang_right;
	include_spip("inc/presentation");
	if (!include_spip('inc/autoriser'))
		include_spip('inc/autoriser_compat');

	_Forms_install();

	/*debut_page($titre_page, "documents", "forms");*/
	$commencer_page = charger_fonction("commencer_page", "inc") ;
 	echo $commencer_page($titre_page, "documents", "forms") ;
	/*debut_gauche();*/
	echo debut_gauche('', true);
	/*debut_boite_info();*/
	echo debut_boite_info(true);
	echo _T("forms:boite_info");
	/*fin_boite_info();*/
	echo fin_boite_info(true);

	/*creer_colonne_droite();*/
	echo creer_colonne_droite('',true);
	if (include_spip('inc/snippets'))
		echo boite_snippets($titre_type,_DIR_PLUGIN_FORMS."img_pack/$type_form-24.gif",'forms','forms');

	/*debut_droite();*/
	echo debut_droite('',true);
	$out = "";

	$bouton_defaut = true;
	if ( _request('exec')=='tables_tous'
		&& (_request('var_mode')=='dev' OR (defined('_OUTILS_DEVELOPPEURS') && _OUTILS_DEVELOPPEURS))) {
		$res = spip_query("SELECT type_form FROM spip_forms GROUP BY type_form ORDER BY type_form");
		while ($row = spip_fetch_array($res)){
			$out .= afficher_tables_tous_corps($row['type_form']);
			if ($row['type_form']==$type_form) $bouton_defaut = false;
		}
	}
	if ($bouton_defaut) {
		$out .= afficher_tables_tous_corps($type_form);
	}
	echo forms_inserer_crayons($out);

	if ($GLOBALS['spip_version_code']>=1.9203)
		echo fin_gauche();
	echo fin_page();
}


function affichage_donnees_tous_corps($type_form,$id_form,$retour=false, $titre_page=false, $contexte = array()){
	global $spip_lang_right,$spip_lang_left;
	if (!include_spip('inc/autoriser'))
		include_spip('inc/autoriser_compat');
	include_spip('public/assembler');
	$out = "";
	if (!$id_form = intval($id_form)) return $out;
	$res = spip_query("SELECT arborescent,titre FROM spip_forms WHERE id_form="._q($id_form));
	$row=spip_fetch_array($res);
	if ($titre_page===false){
		$titre_page = $row['titre'];
	}
	$fond = "fonds/donnees_tous" . ($row['arborescent']=='oui'?'_arbo':'');

	$prefix = forms_prefixi18n($type_form);
	$defaut_cont = 		array('id_form'=>$id_form,
		'titre_liste'=>$titre_page,
		'aucune_reponse'=>_T("$prefix:aucune_reponse"),
		'couleur_claire'=>$GLOBALS['couleur_claire'],'couleur_foncee'=>$GLOBALS['couleur_foncee'],
		'statuts' => array('prepa','prop','propose','publie','refuse'),
		'recherche'=>_request('recherche'),
		'affiche_rang'=>$prefix=='form'?0:1,
		'affiche_de'=>$prefix=='form'?1:0,
		'affiche_date'=>$prefix=='form'?1:0,
		'tri'=>$prefix=='form'?'date':'rang',
		'senstri'=>$prefix=='form'?'1':'0',
		);
	if (_request('tri')) {
		$defaut_cont['tri'] = _request('tri');
		$defaut_cont['senstri'] = _request('senstri');
	}
	if (_request('champ')) $defaut_cont['champ'] = _request('champ');
	$contexte = array_merge($contexte,$defaut_cont);

  $icone = find_in_path("img_pack/$type_form-24.png");
  if (!$icone)
  	$icone = _DIR_PLUGIN_FORMS."img_pack/donnees-24.png";
	$out .=  "<table style='margin:0 auto;'><tr><td>";
	if ($retour){
		$out .=  "<div style='float:$spip_lang_left;'>";
		$out .=  icone(_T('icone_retour'), urldecode($retour), $icone, "rien.gif","",false);
		$out .=  "</div>";
	}

	if (autoriser('administrer','form',$id_form)) {
		$retour = urlencode(self());

		$url_edit = generer_url_ecrire('donnees_edit',"id_form=$id_form&retour=$retour");
		$out .=  "<div style='float:$spip_lang_left;'>";
		$out .=  icone(_T("$prefix:icone_ajouter_donnees"), $url_edit, $icone, "creer.gif","",false);
		$out .=  "</div>";

		//$url_suivi = icone_horizontale(_T("forms:suivi_reponses")."<br />".(($nb_reponses==0)?_T("forms:aucune_reponse"):(($nb_reponses==1)?_T("forms:une_reponse"):_T("forms:nombre_reponses",array('nombre'=>$nb_reponses)))),
		//, _DIR_PLUGIN_FORMS."img_pack/donnees-24.png", "rien.gif",false);
		$url_suivi = generer_url_ecrire(in_array($row['type_form'],array('','sondage'))?'forms_reponses':'donnees_tous',"id_form=$id_form");
		$out .=  "<div style='float:$spip_lang_left;'>";
		$out .=  icone(_T("$prefix:suivi_reponses"), $url_suivi, _DIR_PLUGIN_FORMS."img_pack/donnees-24.png", "rien.gif","",false);
		$out .=  "</div>";

		// verifier si il y a des donnees
		$in = "statut IN (".implode(',',array_map('_q',$contexte['statuts'])).")";
		$res2 = spip_query("SELECT id_donnee FROM spip_forms_donnees WHERE $in AND id_form="._q($id_form));
		if ($row2 = spip_fetch_array($res2)){
			$out .=  "<div style='float:$spip_lang_left;'>";
			$out .=  icone(_T("$prefix:telecharger_reponses"),
				generer_url_ecrire("forms_telecharger","id_form=$id_form&retour=$retour"), _DIR_PLUGIN_FORMS. "img_pack/donnees-exporter-24.png", "rien.gif","",false);
			$out .=  "</div>";
		}
		if (defined('_DIR_PLUGIN_CSVIMPORT')){
			$out .=  "<div style='float:$spip_lang_left;'>";
			$out .=  icone(_T("$prefix:importer_donnees_csv"),
				generer_url_ecrire("csvimport_import","id_form=$id_form&retour=$retour"), _DIR_PLUGIN_FORMS. "img_pack/donnees-importer-24.png", "rien.gif","",false);
			$out .=  "</div>";
		}
	}
	// formulaire recherche
	if ($recherche=_request('recherche')) {
	  $recherche_aff = $recherche;
	  $onfocus = "";
	} else {
	  $recherche_aff = _T('info_rechercher');
	  $onfocus = "this.value='';";
	}
	$out .= "<div style='float:$spip_lang_left'><form method='get' style='margin: 20px 0px;' action='" . self() . "' class='verdana2' ><div>";
	$out .= form_hidden(self());
	$out .= '<input type="text" size="10" value="'.$recherche_aff.'" name="recherche" class="spip_recherche" accesskey="r" onfocus="'.$onfocus . '" style="width:10em;" />';
	if ($recherche)
		$out .= "<br /><a href='".parametre_url(self(),'recherche','')."'>"._T('info_tout_afficher')."</a>";
	$out .= "</div></form></div>";


	$out .=  '<div style="clear:left;text-align:center">';
	$out .=  gros_titre($titre_page,'',false);
	$out .=  '</div>';

	$out .=  recuperer_fond($fond,$contexte);
	$out = forms_inserer_crayons($out);

	$out .=  "</td></tr></table><br />\n";
	return $out;
}

function affichage_donnees_tous($type_form,$c=NULL){
  include_spip("inc/presentation");
  $id_form = _request('id_form', $c);
	if (!include_spip('inc/autoriser'))
		include_spip('inc/autoriser_compat');
	if (!autoriser('voir','donnee',0,null,array('id_form'=>$id_form,'type_form'=>$type_form))) {
		/*echo debut_page("&laquo; $titre &raquo;", "documents", "forms","");*/
		$commencer_page = charger_fonction("commencer_page", "inc") ;
 		echo $commencer_page("&laquo; $titre &raquo;", "documents", "forms") ;
		echo _T('acces_interdit');
		echo fin_page();
		exit();
	}

  _Forms_install();
	$row=spip_fetch_array(spip_query("SELECT titre FROM spip_forms WHERE id_form="._q(_request('id_form'))));
	$titre_page = $row['titre'];
	/*echo debut_page($titre_page, "documents", "forms");*/
	$commencer_page = charger_fonction("commencer_page", "inc") ;
 	echo $commencer_page($titre_page, "documents", "forms") ;
	if (!$retour = _request('retour')){
		if (find_in_path("exec/{$type_form}s_tous"))
			$retour = generer_url_ecrire($type_form.'s_tous');
		else
			$retour = generer_url_ecrire('tables_tous');
	}
	echo affichage_donnees_tous_corps($type_form,$id_form,$retour, $titre_page);
	if ($GLOBALS['spip_version_code']>=1.9203)
		echo fin_gauche();
	echo fin_page();
}

function affichage_donnee_edit($type_form){
	global $spip_lang_right;
  include_spip("inc/presentation");
	include_spip('public/assembler');
	if (!include_spip('inc/autoriser'))
		include_spip('inc/autoriser_compat');

  _Forms_install();
	$prefix = forms_prefixi18n($type_form);
  $icone = find_in_path("img_pack/$type_form-24.png");
  if (!$icone)
  	$icone = _DIR_PLUGIN_FORMS."img_pack/donnees-24.png";
  $titre_page = _T("$prefix:type_des_tables");

  $id_form = intval(_request('id_form'));
  $id_donnee = intval(_request('id_donnee'));
  $res = spip_query("SELECT id_form,statut FROM spip_forms_donnees WHERE id_donnee="._q($id_donnee));
  if ($row = spip_fetch_array($res))
  if (!$id_form && $id_donnee){
		$id_form = $row['id_form'];
  }
  $statut = $row['statut'];

	$contexte = array('id_form'=>$id_form,'id_donnee'=>$id_donnee,'type_form'=>$type_form,'titre_liste'=>$titre_page,'couleur_claire'=>$GLOBALS['couleur_claire'],'couleur_foncee'=>$GLOBALS['couleur_foncee']);
	$formulaire = recuperer_fond("modeles/form",$contexte);
	$row = spip_fetch_array(spip_query("SELECT COUNT(id_donnee) AS n FROM spip_forms_donnees WHERE id_form="._q($id_form)." AND statut!='poubelle'"));
	$nb_reponses = intval($row['n']);

	/*debut_page($titre_page, "documents", "forms");*/
	$commencer_page = charger_fonction("commencer_page", "inc") ;
 	echo $commencer_page($titre_page, "documents", "forms") ;
	/*debut_gauche();*/
	echo debut_gauche('', true);
	/*debut_boite_info();*/
	echo debut_boite_info(true);
	if ($retour = _request('retour')) {
		echo icone_horizontale(_T('icone_retour'), urldecode($retour), $icone, "rien.gif",false);
	}
	if (autoriser('administrer','form',$id_form)) {
		$prefix = forms_prefixi18n($type_form);
		echo icone_horizontale(_T("$prefix:suivi_reponses")."<br />".(($nb_reponses==0)?_T("$prefix:aucune_reponse"):(($nb_reponses==1)?_T("$prefix:une_reponse"):_T("$prefix:nombre_reponses",array('nombre'=>$nb_reponses)))),
			generer_url_ecrire('donnees_tous',"id_form=$id_form".(strpos($retour,"exec=donnees_tous")===FALSE?"&retour=$retour":"")), _DIR_PLUGIN_FORMS."img_pack/donnees-24.png", "rien.gif",false);

		$retour = urlencode(self());
		echo icone_horizontale(_T("$prefix:telecharger_reponses"),
			generer_url_ecrire("forms_telecharger","id_form=$id_form&retour=$retour"), _DIR_PLUGIN_FORMS. "img_pack/donnees-exporter-24.png", "rien.gif",false);
		if (defined('_DIR_PLUGIN_CSVIMPORT')){
			echo icone_horizontale(_T("$prefix:importer_donnees_csv"),
				generer_url_ecrire("csvimport_import","id_form=$id_form&retour=$retour"), _DIR_PLUGIN_FORMS. "img_pack/donnees-importer-24.png", "rien.gif",false);
		}
	}
	/*fin_boite_info();*/
	echo fin_boite_info(true);

 	$res = spip_query("SELECT documents FROM spip_forms WHERE id_form="._q($id_form));
 	$row = spip_fetch_array($res);
 	if ($row['documents']=='oui'){
		if ($id_donnee){
			# affichage sur le cote des pieces jointes, en reperant les inserees
			# note : traiter_modeles($texte, true) repere les doublons
			# aussi efficacement que propre(), mais beaucoup plus rapidement
			echo afficher_documents_colonne($id_donnee, "donnee", _request('exec'));
		} else {
			# ICI GROS HACK
			# -------------
			# on est en new ; si on veut ajouter un document, on ne pourra
			# pas l'accrocher a l'article (puisqu'il n'a pas d'id_article)...
			# on indique donc un id_article farfelu (0-id_auteur) qu'on ramassera
			# le moment venu, c'est-ˆ-dire lors de la creation de l'article
			# dans editer_article.
			echo afficher_documents_colonne(0-$GLOBALS['auteur_session']['id_auteur'], "donnee", _request('exec'));
		}
 	}

	/*creer_colonne_droite();*/
	echo creer_colonne_droite('',true);
	if ($id_donnee){
		$table_donnee_deplace = charger_fonction('table_donnee_deplace','inc');
		echo ajax_action_auteur('table_donnee_deplace',"$id_form-$id_donnee",'donnees_edit', "id_form=$id_form&id_donnee=$id_donnee",
			$table_donnee_deplace($id_donnee,$id_form));
	}

	/*if (include_spip('inc/snippets'))
		echo boite_snippets($titre_type,_DIR_PLUGIN_FORMS."img_pack/$type_form-24.gif",'forms','forms');*/

	/*debut_droite();*/
	echo debut_droite('',true);
	if ($id_donnee){
		echo debut_cadre_relief();
		$instituer_forms_donnee = charger_fonction('instituer_forms_donnee','inc');
		echo $instituer_forms_donnee($id_form,$id_donnee,$statut);
		echo fin_cadre_relief();
	}

	echo "<div class='verdana2'>$formulaire</div>";

	if ($id_donnee) {

		if ($GLOBALS['spip_version_code']<1.92)		ob_start(); // des echo direct en 1.9.1
		//adapatation SPIP2
		/*$liste = afficher_articles(_T("forms:info_articles_lies_donnee"),
			array('FROM' => 'spip_articles AS articles, spip_forms_donnees_articles AS lien',
			'WHERE' => "lien.id_article=articles.id_article AND lien.id_donnee="._q($id_donnee)." AND articles.statut!='poubelle'",
			'ORDER BY' => "titre"));*/
		$liste = afficher_objets('article',_T("forms:info_articles_lies_donnee"),
			array('FROM' => 'spip_articles AS articles, spip_forms_donnees_articles AS lien',
			'WHERE' => "lien.id_article=articles.id_article AND lien.id_donnee="._q($id_donnee)." AND articles.statut!='poubelle'",
			'ORDER BY' => "titre"));
		/*$liste .= afficher_rubriques(_T("forms:info_rubriques_liees_donnee"),
			array('FROM' => 'spip_rubriques AS rubriques, spip_forms_donnees_rubriques AS lien',
			'WHERE' => "lien.id_rubrique=rubriques.id_rubrique AND lien.id_donnee="._q($id_donnee)." AND rubriques.statut!='poubelle'",
			'ORDER BY' => "titre"));*/
		$liste .= afficher_objets('rubrique',_T("forms:info_rubriques_liees_donnee"),
			array('FROM' => 'spip_rubriques AS rubriques, spip_forms_donnees_rubriques AS lien',
			'WHERE' => "lien.id_rubrique=rubriques.id_rubrique AND lien.id_donnee="._q($id_donnee)." AND rubriques.statut!='poubelle'",
			'ORDER BY' => "titre"));
		/*include_spip('exec/recherche'); // pfff
		$liste .= afficher_auteurs(_T("forms:info_auteurs_lies_donnee"),
			array('FROM' => 'spip_auteurs AS auteurs, spip_forms_donnees_auteurs AS lien',
			'WHERE' => "lien.id_auteur=auteurs.id_auteur AND lien.id_donnee="._q($id_donnee)." AND auteurs.statut!='poubelle'",
			'ORDER BY' => "titre"));*/
		if ($GLOBALS['spip_version_code']<1.92) {
			$liste = ob_get_contents();
			ob_end_clean();
		}
		echo $liste;
	}

	// donnees liantes
	list($out,$les_donnees,$nombre_donnees) = Forms_afficher_liste_donnees_liees(
		"donnee_liee",
		$id_donnee,
		"donnee",
		"",
		"forms_donnees_liantes",
		"forms_donnees_liantes",
		"id_donnee=$id_donnee",
		self());
	echo "<div id='forms_donnees_liantes'>$out</div>";

	if ($GLOBALS['spip_version_code']>=1.9203)
		echo fin_gauche();
	echo fin_page();
}
?>
