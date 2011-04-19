<?php
/**
 * Plugin Spip-Bonux
 * Le plugin qui lave plus SPIP que SPIP
 * (c) 2008 Mathieu Marcillaud, Cedric Morin, Romy Tetue
 * Licence GPL
 *
 * Fonctions integrees au core en branche 2.1 que l'on rend disponible en branche 2.0.x
 *
 */

// s'assurer que les filtres du core sont deja charges
// pour eviter tout risque de conflit
include_spip('inc/filtres');

if (!function_exists('lien_ou_expose')){
/**
 * une fonction pour generer des menus avec liens
 * ou un <strong class='on'> non clicable lorsque l'item est selectionne
 *
 * @param string $url
 * @param string $libelle
 * @param bool $on
 * @param string $class
 * @param string $title
 * @return string
 */
function lien_ou_expose($url,$libelle,$on=false,$class="",$title="",$rel=""){
	return
	($on ?"<strong class='on'>":
		"<a href='$url'"
	  	.($title?" title='".attribut_html($title)."'":'')
	  	.($class?" class='".attribut_html($class)."'":'')
	  	.($rel?" rel='".attribut_html($rel)."'":'')
	  	.">"
	)
	. $libelle
	. ($on ? "</strong>":"</a>");
}
}

if (!function_exists('filtre_balise_img_dist')){
/**
 * une fonction pour generer une balise img a partir d'un nom de fichier
 *
 * @param string $img
 * @param string $alt
 * @param string $class
 * @return string
 */
function filtre_balise_img_dist($img,$alt="",$class=""){
	$taille = taille_image($img);
	list($hauteur,$largeur) = $taille;
	if (!$hauteur OR !$largeur)
		return "";
	return
	"<img src='$img' width='$largeur' height='$hauteur'"
	  ." alt='".attribut_html($alt)."'"
	  .($class?" class='".attribut_html($class)."'":'')
	  .' />';
}
}

if (!function_exists('singulier_ou_pluriel')){
/**
 * Afficher un message "un truc"/"N trucs"
 *
 * @param int $nb
 * @return string
 */
function singulier_ou_pluriel($nb,$chaine_un,$chaine_plusieurs,$var='nb'){
	if (!$nb=intval($nb)) return "";
	if ($nb>1) return _T($chaine_plusieurs, array($var => $nb));
	else return _T($chaine_un);
}
}

if (!function_exists('filtre_icone_dist')){
/**
 * un filtre icone mappe sur icone_inline, qui cree une icone a gauche par defaut
 * le code de icone_inline est grandement reproduit ici car les liens ajax portent simplement une class ajax
 * lorsque les interfaces sont en squelette, alors que l'implementation d'ajax de des scripts php
 * est plus complexe
 *
 * @param string $lien
 * @param string $texte
 * @param string $fond
 * @param string $align
 * @param string $fonction
 * @return string
 */
function filtre_icone_dist($lien, $texte, $fond, $align="", $fonction="", $class="",$javascript=""){
	$align = $align?$align:$GLOBALS['spip_lang_left'];
	global $spip_display;

	if ($fonction == "supprimer.gif") {
		$style = 'icone36 danger';
	} else {
		$style = 'icone36';
		if (strlen($fonction) < 3) $fonction = "rien.gif";
	}
	$style .= " " . substr(basename($fond),0,-4);

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

	// cas d'ajax_action_auteur: faut defaire le boulot
	// (il faudrait fusionner avec le cas $javascript)
	if (preg_match(",^<a\shref='([^']*)'([^>]*)>(.*)</a>$,i",$lien,$r))
		list($x,$lien,$atts,$texte)= $r;
	else $atts = '';

	if ($align && $align!='center') $align = "float: $align; ";

	$icone = "<a style='$align' class='$style $class'"
	. $atts
	. $javascript
	. "\nhref='"
	. $lien
	. "'>"
	. $icone
	. (($spip_display == 3)	? '' : "<span>$texte</span>")
	  . "</a>\n";

	if ($align <> 'center') return $icone;
	$style = " style='text-align:center;'";
	return "<div$style>$icone</div>";
}
}


if (!function_exists('filtre_explode_dist')){
/**
 * filtre explode pour les squelettes permettant d'ecrire
 * #GET{truc}|explode{-}
 *
 * @param strong $a
 * @param string $b
 * @return array
 */
function filtre_explode_dist($a,$b){return explode($b,$a);}
}

if (!function_exists('filtre_implode_dist')){
/**
 * filtre implode pour les squelettes permettant d'ecrire
 * #GET{truc}|implode{-}
 *
 * @param array $a
 * @param string $b
 * @return string
 */
function filtre_implode_dist($a,$b){return implode($b,$a);}
}

if (!function_exists('bando_images_background') AND !defined('_DIR_PLUGIN_BANDO')){
function bando_images_background(){
	return '';
}
}

if (!function_exists('bando_style_prive_theme') AND !defined('_DIR_PLUGIN_BANDO')){
function bando_style_prive_theme() {
	return '';
}
}

?>