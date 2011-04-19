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

function exec_recherche_donnees(){
	$type = _request('type');
	if (!preg_match(',[\w]+,',$type))
		$type = 'article';
	if (_request('field')=='cherche_donnee')
		$recherche = _request('value');
	include_spip("inc/forms_lier_donnees");
	
	$id = _request("id_$type");
	$type_table = forms_type_table_lier($type,$id);
	$id = intval($id);
	// recuperer les donnees deja liees
	list($s,$les_donnees,$nombre_donnees) = Forms_formulaire_objet_afficher_donnees($type,$id,"",$type_table);
	
	if ($type == 'donnee')
		$les_donnees .= (strlen($les_donnees)?",":"").$id;
	// recuperer les donnees que l'on peut lier
	$liste = Forms_liste_recherche_donnees($recherche,$les_donnees,$type,$type_table,30);
	
	$out = "<ajaxresponse>";
	foreach($liste as $titre=>$donnees){
		$out .= "<item>
 <text><![CDATA[$titre -----------]]></text>
 <value><![CDATA[]]></value>
</item>
";
		foreach ($donnees as $id_donnee=>$champ) {
		$texte = implode (" ",$champ);
		$out .= "<item>
 <text><![CDATA[$texte]]></text>
 <value><![CDATA[$texte]]></value>
 <id_donnee><![CDATA[$id_donnee]]></id_donnee>
</item>
";
		}
	}
	$out .= "</ajaxresponse>";
	$c = $GLOBALS['meta']["charset"];
	header('Content-Type: text/xml; charset='. $c);
	$c = '<' . "?xml version='1.0' encoding='" . $c . "'?" . ">\n";
	echo $c, $out;
	exit;
}

?>