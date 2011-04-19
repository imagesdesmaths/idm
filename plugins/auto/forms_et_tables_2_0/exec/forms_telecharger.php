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
include_spip("inc/presentation");
if (!include_spip('inc/autoriser'))
	include_spip('inc/autoriser_compat');

function acces_interdit() {
	/*debut_page(_T('avis_acces_interdit'), "documents", "forms");*/
	$commencer_page = charger_fonction("commencer_page", "inc") ; 
 	echo $commencer_page(_T('avis_acces_interdit'), "documents", "forms");
	/*debut_gauche();*/
	echo debut_gauche('', true);
	/*debut_droite();*/
	echo debut_droite('',true);
	echo "<strong>"._T('avis_acces_interdit')."</strong>";
	fin_page();
	exit;
}


//
// Telechargement d'un fichier particulier
//
function exec_forms_telecharger(){
	$id_donnee = _request('id_donnee');
	$id_form = _request('id_form');
	$champ = _request('champ');

	if ($id_donnee = intval($id_donnee) AND $champ) {
		$res = spip_query("SELECT id_form FROM spip_forms_donnees WHERE id_donnee="._q($id_donnee));
		if ($row = spip_fetch_array($res))
			$id_form = $row['id_form'];
		if (!$id_form || !autoriser('administrer','form',$id_form))
			acces_interdit();
		$res = spip_query("SELECT * FROM spip_forms_champs WHERE id_form="._q($id_form)." AND type='fichier' AND champ="._q($champ));
		if (!$row = spip_fetch_array($res))
			acces_interdit();
		$row = spip_fetch_array(spip_query("SELECT valeur FROM spip_forms_donnees_champs WHERE id_donnee="._q($id_donnee)." AND champ="._q($champ)));
		if (!$row)	acces_interdit();
		
		$fichier = $row['valeur'];
		if ((strpos($fichier, "..")!==FALSE) || !preg_match(',^'._DIR_IMG.',', _DIR_RACINE.$fichier))
			acces_interdit();

		$filename = basename($fichier);
		$mimetype = "";
		if (preg_match(',\.([^\.]+)$,', $fichier, $r)) {
			$ext = $r[1];
			$result = spip_query("SELECT * FROM spip_types_documents WHERE extension="._q($ext));
			if ($row = spip_fetch_array($result))
				$mimetype = $row['mime_type'];
		}
		if (!$mimetype) $mimetype = "application/octet-stream";
		$chemin = "../".$fichier;
		if (!is_file($chemin))
			acces_interdit();

		Header("Content-Type: $mimetype");
		Header("Content-Disposition: inline; filename=$filename");
		Header("Content-Length :".filesize($chemin));
		readfile($chemin);
		exit;
	}

	$retour = _request('retour');
	if ($retour!==NULL)
		$retour = urldecode($retour);
	else
		$retour = generer_url_ecrire('forms_tous');
	
	$res = spip_query("SELECT type_form FROM spip_forms WHERE id_form="._q($id_form));
	$row = spip_fetch_array($res);
	$prefix = forms_prefixi18n($row['type_form']);
	$titre = _T("$prefix:telecharger_reponses");

	$icone = _DIR_PLUGIN_FORMS."img_pack/donnees-24.png";
	
	/*debut_page($titre, "documents", "forms");*/
	$commencer_page = charger_fonction("commencer_page", "inc") ; 
 	echo $commencer_page($titre, "documents", "forms") ;
	/*debut_gauche();*/
	echo debut_gauche('', true);

	echo "<br /><br />\n";
	/*debut_droite();*/
	echo debut_droite('',true);

	debut_cadre_relief($icone);
	//gros_titre($titre);
	echo gros_titre($titre,'',false);
	echo "<br />\n";
	echo _T("forms:format_fichier");
	echo "<br />\n";
	// Extrait de la table en commencant par les dernieres maj
	$action = generer_action_auteur("forms_telecharger","$id_form",urlencode($retour));
	$action = parametre_url($action,'var_mode','download'); // hack pour desactiver la compression gzip par buffer qui corromp le zip
	echo "<form action='$action' method='POST'>";
	echo form_hidden($action);
	echo "<select name='delim'>\n";
	echo "<option value=','>"._T("forms:csv_classique")."</option>\n";
	echo "<option value=';'>"._T("forms:csv_excel")."</option>\n";
	echo "<option value='TAB'>"._T("forms:csv_tab")."</option>\n";
	echo "</select>";
	echo "<br /><br />\n";
	echo "<input type='submit' name='ok' value='"._T("forms:telecharger")."' />\n";

	fin_cadre_relief();
	
	//
	// Icones retour
	//
	if ($retour) {
		echo "<br />\n";
		echo "<div align='$spip_lang_right'>";
		echo icone(_T('icone_retour'), $retour, $icone, "rien.gif");
		echo "</div>\n";
	}
	if ($GLOBALS['spip_version_code']>=1.9203)
		echo fin_gauche();
	echo fin_page();

}
?>