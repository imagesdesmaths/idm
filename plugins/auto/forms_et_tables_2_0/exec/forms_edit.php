<?php
/*
 * forms
 * Gestion de formulaires editables dynamiques
 *
 * Auteurs :
 * Antoine Pitrou
 * Cedric Morin
 * Renato
 * ??? 2005,2006 - Distribue sous licence GNU/GPL
 *
 */

include_spip('inc/forms');
include_spip('inc/forms_edit');
include_spip('inc/forms_type_champs'); // gestion des types de champs

function Forms_formulaire_confirme_suppression($id_form,$nb_reponses,$redirect,$retour,$prefixei18n='form'){
	global $spip_lang_right;
	$out = "<div class='verdana3'>";
	if ($nb_reponses){
			$out .= "<p><strong>"._T("forms:attention")."</strong> ";
			$out .= _T("$prefixei18n:info_supprimer_formulaire_reponses")."</p>\n";
	}
	else{
		$out .= "<br />";
		$out .= _T("$prefixei18n:info_supprimer_formulaire")."</p>\n";
	}
	// ADAPTATION SPIP 2
	if ($GLOBALS['spip_version_code']<2)
		$link = generer_action_auteur('forms_supprime',"$id_form",_DIR_RESTREINT_ABS.($retour?(str_replace('&amp;','&',$retour)):generer_url_ecrire('forms_tous',"",false,true)));
	else
		$link = generer_action_auteur('forms_supprime',"$id_form",($retour?(str_replace('&amp;','&',$retour)):generer_url_ecrire('forms_tous',"",false,true)));
	$out .= "<form method='post' action='$link' style='float:$spip_lang_right'>";
	$out .= form_hidden($link);
	$out .= "<div style='text-align:$spip_lang_right'>";
	$out .= "&nbsp;<input type='submit' name='supp_confirme' value=\""._T('item_oui')."\" class='fondo' />";
	$out .= "</div>";
	$out .= "</form>\n";

	$out .= "<form method='post' action='$redirect' style='float:$spip_lang_right'>\n";
	$out .= form_hidden($redirect);
	$out .= "<div style='text-align:$spip_lang_right'>";
	$out .= "&nbsp;<input type='submit' name='supp_rejet' value=\""._T('item_non')."\" class='fondo' />";
	$out .= "</div>";
	$out .= "</form><br />\n";
	$out .= "</div>";

	return $out;
}

function contenu_boite_resume($id_form, $row, &$apercu){
	$prefixei18n = forms_prefixi18n($row['type_form']);
	$is_form = 	$prefixei18n=='form';

	$out = "";

	// centre resume ---------------------------------------------------------------
	$out .= debut_cadre_relief(_DIR_PLUGIN_FORMS."img_pack/form-24.png",true);

	//$out .= gros_titre($row['titre'],'',false);

	if ($row['descriptif']) {
		$out .= "<div class='descriptif'><strong>"._T('info_descriptif')."</strong>";
		$out .= propre($row['descriptif']);
		$out .= "</div>\n";
	}

	if ($email = unserialize($row['email'])) {
		$out .= "<div class='email'><strong>"._T('email_2')."</strong>";
		$out .= $email['defaut'];
		$out .= "</div>\n";
	}
	if ($champconfirm = $row['champconfirm']){
		$champconfirm_known = false;
		$out .= "<div class='champconfirm'><strong>"._T('forms:confirmer_reponse')."</strong>";
		$res2 = spip_query("SELECT titre FROM spip_forms_champs WHERE type='email' AND id_form="._q($id_form)." AND champ="._q($champconfirm));
		if ($row2 = spip_fetch_array($res2)){
			$out .= $row2['titre'] . " ";
			$champconfirm_known = true;
		}
		$out .= "</div>\n";
		if (($champconfirm_known == true) && ($row['texte'])) {
			$out .= "<div class='texte'><strong>"._T('info_texte')."</strong>";
			$out .= nl2br(entites_html($row['texte']));
			$out .= "</div>\n";
		}
	}

	$out .= "<br />";
	if (version_compare($GLOBALS['spip_version_code'],'1.9250','>')){
		$out .= bouton_block_depliable(_T("forms:apparence_formulaire"),true,"preview_form");
		$out .= debut_block_depliable(true,"preview_form");
	}
	else {
		$out .= "<div style='padding: 2px; background-color: $couleur_claire; color: black;'>&nbsp;";
		$out .= bouton_block_invisible("preview_form");
		$out .= "<strong class='verdana3' style='text-transform: uppercase;'>"
			._T("forms:apparence_formulaire")."</strong>";
		$out .= "</div>\n";
		$out .= debut_block_visible("preview_form");
	}
	$out .= "<p>" . _T("forms:info_apparence") . "</p>\n";
	$out .= "<div id='apercu'>$apercu</div>";
	$out .= fin_block();

	if ($GLOBALS['spip_version_code']<1.92)		ob_start(); // des echo direct en 1.9.1
	//adapatation SPIP2
	/*$liste = afficher_articles(_T("$prefixei18n:articles_utilisant"),
		array('FROM' => 'spip_articles AS articles, spip_forms_articles AS lien',
		'WHERE' => "lien.id_article=articles.id_article AND id_form="._q($id_form)." AND statut!='poubelle'",
		'ORDER BY' => "titre"));*/
	$liste = afficher_objets('article',_T("$prefixei18n:articles_utilisant"),
		array('FROM' => 'spip_articles AS articles, spip_forms_articles AS lien',
		'WHERE' => "lien.id_article=articles.id_article AND id_form="._q($id_form)." AND statut!='poubelle'",
		'ORDER BY' => "titre"));
	if ($GLOBALS['spip_version_code']<1.92) {
		$liste = ob_get_contents();
		ob_end_clean();
	}

	$out .= $liste;

	$out .= fin_cadre_relief(true);
	return $out;
}

function exec_forms_edit(){
	global $spip_lang_right;
	$retour = _request('retour');

	$id_form = intval(_request('id_form'));

	if (!include_spip('inc/autoriser'))
		include_spip('inc/autoriser_compat');
	if (!autoriser('structurer','form',$id_form)) {
		/*echo debut_page("&laquo; $titre &raquo;", "documents", "forms","");*/
		$commencer_page = charger_fonction("commencer_page", "inc") ; 
 		echo $commencer_page("&laquo; $titre &raquo;", "documents", "forms","") ;
		echo _T('acces_interdit');
		echo fin_page();
		exit();
	}

	$new = _request('new');
	$supp_form = intval(_request('supp_form'));
	$supp_rejet = _request('supp_rejet');
	$titre = _request('titre');

	_Forms_install();
	if ($supp_form)
		$id_form = $supp_form;

	if ($retour)
		$retour = urldecode($retour);
	else
		$retour = generer_url_ecrire('forms_tous',"","",true);
  include_spip("inc/presentation");
	include_spip("inc/config");

	$nb_reponses = 0;
	if ($id_form)
		if ($row = spip_fetch_array(spip_query("SELECT COUNT(*) AS num FROM spip_forms_donnees WHERE id_form="._q($id_form)." AND confirmation='valide' and statut!='poubelle'")))
			$nb_reponses = $row['num'];

	$redirect = generer_url_ecrire('forms_edit',(intval($id_form)?"id_form=$id_form":""));
	if ($retour)
		$redirect = parametre_url($redirect,"retour",urlencode($retour));

	//
	// Affichage de la page
	//
	if ($id_form){
		$champ_visible = _request('champ_visible');
		$nouveau_champ = _request('nouveau_champ');
		$result = spip_query("SELECT * FROM spip_forms WHERE id_form="._q($id_form));
		if ($row = spip_fetch_array($result)) {
			$id_form = $row['id_form'];
			$titre = $row['titre'];
		}
		$focus = "";
		$action_link = generer_action_auteur("forms_edit","$id_form",urlencode($redirect));
	}

	$ajax_charset = _request('var_ajaxcharset');
	$bloc = _request('bloc');
	if ($ajax_charset && $bloc=='dummy') {
		ajax_retour("");
		exit;
	}
	if ($ajax_charset && $bloc=='apercu') {
		include_spip('public/assembler');
		$GLOBALS['var_mode']='calcul';
		$apercu = recuperer_fond('modeles/form',array('id_form'=>$id_form,'var_mode'=>'calcul'));
		ajax_retour($apercu);
		exit;
	}
	if ($ajax_charset && $bloc=='resume') {
		include_spip('public/assembler');
		$GLOBALS['var_mode']='calcul';
		$apercu = recuperer_fond('modeles/form',array('id_form'=>$id_form,'var_mode'=>'calcul'));
		ajax_retour(contenu_boite_resume($id_form, $row, $apercu));
		exit;
	}
	if ($ajax_charset && $bloc=='proprietes') {
		ajax_retour(boite_proprietes($id_form, $row, $focus, $action_link, $redirect));
		exit;
	}
	$bloc = explode("-",$bloc);
	if ($ajax_charset && $bloc[0]=='champs') {
		ajax_retour(Forms_zone_edition_champs($id_form, $champ_visible, $nouveau_champ,$redirect,isset($bloc[2])?$bloc[2]:false));
		exit;
	}


	/*debut_page("&laquo; $titre &raquo;", "documents", "forms","");*/
	$commencer_page = charger_fonction("commencer_page", "inc") ; 
 	echo $commencer_page("&laquo; $titre &raquo;", "documents", "forms","") ;

	// Recupere les donnees ---------------------------------------------------------------
	if ($new == 'oui' && !$titre) {
		$row['type_form'] = _request('type_form')?_request('type_form'):""; // possibilite de passer un type par defaut dans l'url de creation
		$prefixei18n = forms_prefixi18n($row['type_form']);
		$is_form = 	$prefixei18n=='form';

		$titre = _T("$prefixei18n:nouveau_formulaire");
		include_spip('inc/charset');
		$row['titre'] = $titre = unicode2charset(html2unicode($titre));
		$row['descriptif'] = "";
		if ($is_form){
			$row['modifiable'] = 'non';
			$row['multiple'] = 'oui';
			$row['moderation'] = "posteriori";
		}
		else {
			$row['modifiable'] = 'non';
			$row['multiple'] = 'non';
			$row['moderation'] = "priori";
		}
		$row['forms_obligatoires'] = "";
		$row['email'] = serialize(array());
		$row['champconfirm'] = "";
		$row['texte'] = "";
		$row['public'] = "non";
		$row['linkable'] = "non";
		$row['documents'] = "non";
		$row['documents_mail'] = "non";
		$focus = "antifocus";

		$action_link = generer_action_auteur("forms_edit","new",urlencode($redirect));
	}
	$prefixei18n = forms_prefixi18n($row['type_form']);
	$is_form = 	$prefixei18n=='form';

	// gauche raccourcis ---------------------------------------------------------------
	/*debut_gauche();*/
	echo debut_gauche('', true);

	echo "<br /><br />\n";
	/*debut_boite_info();*/
	echo debut_boite_info(true);
	if ($id_form>0)
		echo "<div style='font-size:3em;font-weight:bold;text-align:center;'>$id_form</div>\n";
	if ($retour) {
		echo icone_horizontale(_T('icone_retour'), $retour, _DIR_PLUGIN_FORMS."img_pack/form-24.png", "rien.gif",false);
	}
	if (autoriser('administrer','form',$id_form)) {
		$nretour = urlencode(self());
		echo icone_horizontale(_T("forms:suivi_reponses")."<br />".(($nb_reponses==0)?_T("forms:aucune_reponse"):(($nb_reponses==1)?_T("forms:une_reponse"):_T("forms:nombre_reponses",array('nombre'=>$nb_reponses)))),
		generer_url_ecrire('forms_reponses',"id_form=$id_form"), _DIR_PLUGIN_FORMS."img_pack/donnees-24.png", "rien.gif",false);
			
		echo icone_horizontale(_T("forms:Tableau_des_reponses"),
		generer_url_ecrire('donnees_tous',"id_form=$id_form&retour=$nretour"), _DIR_PLUGIN_FORMS."img_pack/donnees-24.png", "rien.gif",false);
		
		if ($nb_reponses){
			echo icone_horizontale(_T("forms:telecharger_reponses"),
				generer_url_ecrire('forms_telecharger',"id_form=$id_form&retour=$nretour"), _DIR_PLUGIN_FORMS."img_pack/donnees-exporter-24.png", "rien.gif",false);
		}

		if (include_spip('inc/snippets'))
			echo boite_snippets(_T("$prefixei18n:formulaire"),_DIR_PLUGIN_FORMS."img_pack/form-24.gif",'forms',$id_form);

		$link = parametre_url(self(),'new','');
		$link = parametre_url($link,'supp_form', $id_form);
		if (!$retour) {
			$link=parametre_url($link,'retour', urlencode(generer_url_ecrire('form_tous')));
		}
		/*echo "<p>";*/
		echo icone_horizontale(_T("$prefixei18n:supprimer_formulaire"), $link, _DIR_PLUGIN_FORMS."img_pack/supprimer-24.png", "rien.gif",false);
		/*echo "</p>";*/
	}
	/*fin_boite_info();*/
	echo fin_boite_info(true);

	// gauche apercu ---------------------------------------------------------------
	echo "<div id='apercu_gauche'>";
	include_spip('public/assembler');
	$GLOBALS['var_mode']='calcul';
	echo $apercu = recuperer_fond('modeles/form',array('id_form'=>$id_form,'var_mode'=>'calcul'));
	echo "</div>";
	echo '<a class="verdana2" href="#" onclick="$(\'#apercu_gauche\').remove();$(this).remove();return false;">'._T('forms:desactiver')."</a>";



	// droite ---------------------------------------------------------------
	echo creer_colonne_droite('',true);
	/*debut_droite();*/
	echo debut_droite('',true);

	if (!$new){
		echo gros_titre($row['titre'],'',false);

		if ($supp_form && $supp_rejet==NULL)
			echo Forms_formulaire_confirme_suppression($id_form,$nb_reponses,$redirect,$retour,$prefixei18n);
		echo "<div id='barre_onglets'>";
		echo debut_onglet();
		echo onglet(_T('forms:lien_apercu'),ancre_url(self(),"resume"),'','resume');
		echo onglet(_T('forms:lien_propriete'),ancre_url(self(),"proprietes"),'','proprietes');
		echo onglet(_T('forms:lien_champ'),ancre_url(self(),"champs"),'','champs');
		echo fin_onglet();
		echo "</div>";
	}

	$out = "";
	if ($id_form){
		$out .= "<div id='resume'>";
		$out .= contenu_boite_resume($id_form, $row, $apercu);
		$out .= "</div>";
	}

	// centre proprietes ---------------------------------------------------------------
	$out .= "<div id='proprietes'>";
	$out .= boite_proprietes($id_form, $row, $focus, $action_link, $redirect);
	$out .= "</div>";

	// edition des champs ---------------------------------------------------------------
	$out .= "<div id='champs'>";
	$out .= Forms_zone_edition_champs($id_form, $champ_visible, $nouveau_champ,$redirect);
	$out .= "</div>\n";

	echo $out;

	if ($GLOBALS['spip_version_code']>=1.9203)
		echo fin_gauche();
	echo fin_page();
}

?>
