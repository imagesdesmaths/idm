<?php

/**
 * Gestion des puces d'action rapide de formulaires
 *
 * @package SPIP\Formidable\Puce_statut
**/

/**
 * Gestion des puces statuts des formulaires
 * 
 * Retourne le contenu d'une puce avec changement de statut possible
 * si on en a l'autorisation, sinon simplement l'image de la puce
 *
 * @param int $id
 *     Identifiant de l'objet
 * @param string $statut
 *     Statut actuel de l'objet
 * @param int $id_parent
 *     Identifiant du parent, un formulaire
 * @param string $type
 *     Type d'objet
 * @param bool $ajax
 *     Indique s'il ne faut renvoyer que le coeur du menu car on est
 *     dans une requete ajax suite à un post de changement rapide
 * @param bool $menu_rapide
 *     Indique si l'on peut changer le statut, ou si on l'affiche simplement
 * @return string
 *     Code HTML de l'image de puce de statut à insérer (et du menu de changement si présent)
**/
function puce_statut_formulaires_reponse_dist($id, $statut, $id_parent, $type='article', $ajax = false, $menu_rapide=_ACTIVER_PUCE_RAPIDE) {

	$src = statut_image($type, $statut);
	if (!$src)
		return $src;

	if (!$id
	  OR !_SPIP_AJAX
	  OR !$menu_rapide
	  OR !autoriser('instituer', $type, $id)) {
	  $ajax_node ='';
	}
	else
		$ajax_node = " class='imgstatut$type$id'";

	$inser_puce = http_img_pack($src,statut_titre($type, $statut),$ajax_node);

	if (!$ajax_node)
		return $inser_puce;

	$table = table_objet_sql($type);
	$desc = lister_tables_objets_sql($table);
	if (!isset($desc['statut_textes_instituer']))
		return $inser_puce;

	$coord = array_flip(array_keys($desc['statut_textes_instituer']));
	if (!isset($coord[$statut]))
		return $inser_puce;

	$unit = 8/*widh de img*/+4/*padding*/;
	$margin = 4; /* marge a gauche + droite */
	$zero = 1 /*border*/ + $margin/2 + 2 /*padding*/;
	$clip = $zero+ ($unit*$coord[$statut]);
	if ($ajax){

		$width = $unit*count($desc['statut_textes_instituer'])+$margin;
		$out = "<span class='puce_objet_fixe $type'>"
		. $inser_puce
		. "</span>"
		. "<span class='puce_objet_popup $type statutdecal$type$id' style='width:{$width}px;margin-left:-{$clip}px;'>";
		$i=0;
		foreach($desc['statut_textes_instituer'] as $s=>$t){
			$out .= afficher_script_statut($id, $type, -$zero-$i++*$unit, statut_image($type,$s), $s, _T($t));
		}
		$out .= "</span>";
		return $out;
	}
	else {

		$nom = "puce_statut_";
	  $action = generer_url_ecrire('puce_statut_formulaires',"",true);
	  $action = "if (!this.puce_loaded) { this.puce_loaded = true; prepare_selec_statut(this, '$nom', '$type', '$id', '$action'); }";
	  $over = " onmouseover=\"$action\"";

		$lang_dir = lang_dir(isset($GLOBALS['lang_objet']) ? $GLOBALS['lang_objet'] : "");
		return 	"<span class='puce_objet $type' id='$nom$type$id' dir='$lang_dir'$over>"
		. $inser_puce
		. '</span>';
	}
}


