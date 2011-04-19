<?php

/***************************************************************************\
 *  SPIP, Systeme de publication pour l'internet                           *
 *                                                                         *
 *  Copyright (c) 2001-2011                                                *
 *  Arnaud Martin, Antoine Pitrou, Philippe Riviere, Emmanuel Saint-James  *
 *                                                                         *
 *  Ce programme est un logiciel libre distribue sous licence GNU/GPL.     *
 *  Pour plus de details voir le fichier COPYING.txt ou l'aide en ligne.   *
\***************************************************************************/

if (!defined('_ECRIRE_INC_VERSION')) return;

// http://doc.spip.org/@inc_instituer_site_dist
function inc_instituer_site_dist($id_syndic, $statut=-1)
{
	if ($statut == -1) return "";

	$liste_statuts = array(
	  // statut => array(titre,image)
		'prop' => array(_T('info_statut_site_3'),''),	
		'publie' => array(_T('info_statut_site_2'),''),	
		'refuse' => array(_T('info_statut_site_4'),'')	
	);
	if (!in_array($statut, array_keys($liste_statuts)))
		$liste_statuts[$statut] =  array($statut,'');

	$res =
	  "<ul id='instituer_site-$id_syndic' class='instituer_site instituer'>" 
	  . "<li>" . _T('info_statut_site_1') 
	  ."<ul>";
	
	$href = redirige_action_auteur('editer_site',$id_syndic,'sites', "id_syndic=$id_syndic" /*"&id_parent=$id_rubrique"*/);
	foreach($liste_statuts as $s=>$affiche){
		$href = parametre_url($href,'statut',$s);
		if ($s==$statut)
			$res .= "<li class='$s selected'>" . puce_statut($s) . $affiche[0] . '</li>';
		else
			$res .= "<li class='$s'><a href='$href' onclick='return confirm(confirm_changer_statut);'>" . puce_statut($s) . $affiche[0] . '</a></li>';
	}

	$res .= "</ul></li></ul>";
  
	return $res;
}

?>
