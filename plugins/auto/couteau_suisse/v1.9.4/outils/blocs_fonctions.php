<?php
	
/* Trois ou quatre balises pour creer des blocs depliables : 

#BLOC_TITRE     		/ {une_URL} si ajax, {un_numero} si bloc numerote, {visible} si bloc deplie /
Mon titre
#BLOC_RESUME			/ facultatif /
Mon resume qui disparait si on clique
#BLOC_DEBUT
Mon bloc depliable		/ qui est aussi l'emplacement pour l'Ajax si le fragment est donne /
#BLOC_FIN

*/

@define('_BLOC_TITRE_H', 'h4');

// Pour la balise suivante, l'ordre des arguments importe peu
// Un bloc replie, titre simple : #BLOC_TITRE
// Un bloc replie AJAX : #BLOC_TITRE{fragment} (fragment est une URLs)
// Un bloc replie numerote : #BLOC_TITRE{numero} (numero est un nombre entier)
// Un bloc deplie ou replie : ajouter l'argument 'visible' ou 'invisible' : #BLOC_TITRE{visible}
// Par defaut : les blocs sont replies
function balise_BLOC_TITRE($p) {
	// Les arguments : 'visible' ou 'invisible', un numero, une URL
	$p->code = "blocs_balises('titre', array(".blocs_arguments($p).'))';
	$p->interdire_scripts = false;
	return $p;
}

function blocs_arguments(&$p) {
	$i = 0; $args = array();
	while(($a = interprete_argument_balise(++$i,$p)) != NULL) $args[] = $a;
	return join(",", $args);
}

// 3 balises obsoletes
function balise_BLOC_TITRE_NUM(&$p) {return balise_BLOC_TITRE($p);}
function balise_BLOC_VISIBLE_TITRE_NUM(&$p) {return balise_BLOC_VISIBLE_TITRE($p);}
function balise_BLOC_VISIBLE_TITRE(&$p) {
	// Produire le premier argument {visible}
	$texte = new Texte; $texte->type='texte'; $texte->texte='visible';
	array_unshift($p->param, array(0=>NULL, 1=>array(0=>$texte)));
	return balise_BLOC_TITRE($p);
}

function balise_BLOC_RESUME($p) {
	$p->code = "blocs_balises('resume')";
	$p->interdire_scripts = false;
	return $p;
}

function balise_BLOC_DEBUT($p) {
	$p->code = "blocs_balises('debut', array(".blocs_arguments($p).'))';
	$p->interdire_scripts = false;
	return $p;
}

function balise_BLOC_FIN($p) {
	$p->code = "blocs_balises('fin')";
	$p->interdire_scripts = false;
	return $p;
}

function balise_BLOC_TITRE_DEBUT($p) {
	$p->code = "blocs_balises('titre_debut', array(".blocs_arguments($p).'))';
	$p->interdire_scripts = false;
	return $p;
}

function balise_BLOC_TITRE_FIN($p) {
	$p->code = "blocs_balises('titre_fin')";
	$p->interdire_scripts = false;
	return $p;
}

// Renvoie un code JQuery pour deplier un bloc au chargement de la page.
// Exemple pour deplier le 5eme bloc : #BLOC_DEPLIER{4} (l'index commence a zero)
function balise_BLOC_DEPLIER($p) {
	$eq = interprete_argument_balise(1, $p);
	$p->code = "bloc_deplier_script(intval($eq))";
	$p->interdire_scripts = false;
	return $p;
}
// Renvoie un code JQuery pour deplier un bloc numerote au chargement de la page.
// Exemple pour deplier le bloc .cs_bloc4 : #BLOC_DEPLIER_NUM{4}
function balise_BLOC_DEPLIER_NUM($p) {
	$eq = interprete_argument_balise(1, $p);
	$p->code = "bloc_num_deplier_script(intval($eq))";
	$p->interdire_scripts = false;
	return $p;
}

// Renvoie un code JQuery pour courcuiter la variable configurant les blocs uniques
// Argument : oui/non ou 0/1
function balise_BLOC_UNIQUE($p) {
	$arg = interprete_argument_balise(1, $p);
	$p->code = "bloc_unique_script($arg)";
	$p->interdire_scripts = false;
	return $p;
}

// fonction (SPIP>=2.0) pour le calcul de la balise #BLOC_DEPLIER
function bloc_deplier_script($num=0) {
	return $num<0?'':http_script("jQuery(document).ready(function() { jQuery('"._BLOC_TITRE_H.".blocs_titre').eq($num).click(); });");
}
// fonction (SPIP>=2.0) pour le calcul de la balise #BLOC_DEPLIER_NUM
function bloc_num_deplier_script($num=-1) {
	return $num<0?'':http_script("jQuery(document).ready(function() { jQuery('div.cs_bloc$num').children('.blocs_titre').eq(0).click(); });");
}
// fonction (SPIP>=2.0) pour le calcul de la balise #BLOC_UNIQUE
function bloc_unique_script($num=1) {
	$num = ($num==='oui' || intval($num)>0)?1:0;
	return http_script("var blocs_replier_tout = $num;");
}

// fonction pour le calcul des balises de type #BLOC_XXX
// $args ne sert que pour #BLOC_TITRE et contient les arguments de la balise sous forme de tableau
function blocs_balises($type, $args = array()) {
	// statut binaire : bit1=ajax bit2=titre bit3=resume bit4=debut
	// 2 = ajax (20 si distant) ; 1 = titre pas d'ajax (10 si distant); idem negatif = bloc visible
	static $bloc_stade;
	$k = isset($bloc_stade)?count($bloc_stade):0;
	$stade = $k?abs($bloc_stade[--$k]):0;
	$distant = $replie = 1; $id = $numero = '';
	switch($type) {
	case 'titre_debut':
		// id pour le bloc distant
		$id = ' id="cs_bloc_id_' . reset($args) . '"';
		$distant = 10;
	case 'titre':
		foreach($args as $a) {	
			if(is_numeric($a = trim($a))) $numero = ' cs_bloc'.$a.'" id="deplier_num'.$a;	
			elseif($a=='visible') $replie = -1;
			elseif($a=='invisible') $replie = 1;
			elseif(strlen($a)) $fragment = $a;
		}
		if (isset($fragment)){
			$ajax = ' blocs_ajax ';
			$bloc_stade[] = 2*$distant*$replie;
		} else {
			$fragment = "javascript:;";
			$ajax = '';
			$bloc_stade[] = 1*$distant*$replie;
		}
		$replie = $replie>0?' blocs_replie':'';
		return "<div class=\"cs_blocs$numero\"><"._BLOC_TITRE_H." class=\"blocs_titre$replie$ajax\"$id><a href=\"$fragment\">";
	case 'resume':
		$class = $bloc_stade[$k]>0?'':' blocs_invisible blocs_slide';
		if($stade<1 || $stade>2) // on DOIT arriver de titre
			die("Erreur : #BLOC_RESUME sans #BLOC_TITRE ($stade)");
		$bloc_stade[$k] = $bloc_stade[$k]>0?3:-3;	// 3 = resume
		return "</a></"._BLOC_TITRE_H."><div class=\"blocs_resume$class\">";
	case 'debut':
		if(count($args)) {
			// debut d'un bloc depliable a distance
			foreach($args as $a) {	
				if($a=='visible') $replie = -1;
				elseif($a=='invisible') $replie = 1;
				elseif(strlen($a)) $id = " cs_bloc_id_$a";
			}
			$bloc_stade[]=11;
			$class = $replie>0?' blocs_invisible blocs_slide':'';
			return "<div class=\"blocs_destination$class$id\">";
		}
		$class = $bloc_stade[$k]<0?'':' blocs_invisible blocs_slide';
		$bloc_stade[$k]=$bloc_stade[$k]>0?4:-4; // 4=debut
		if($stade == 3)	// on arrive du resume, fermer la div resume seulement
			return "</div><div class=\"blocs_destination$class\">";
		else {
			if($stade<1 || $stade>2) // on DOIT arriver de titre
				die("Erreur : #BLOC_DEBUT sans #BLOC_TITRE ($stade)");
			return '</a></'._BLOC_TITRE_H."><div class=\"blocs_destination$class\">";
		}
	case 'titre_fin':
		$k = isset($bloc_stade)?abs(array_pop($bloc_stade)):0;
		if($k==10 || $k==20) // on DOIT arriver de #BLOC_TITRE_DEBUT
			return '</a></'._BLOC_TITRE_H.'></div>';
		die("Erreur : #BLOC_TITRE_FIN sans #BLOC_TITRE_DEBUT ($k)");
	case 'fin':
		$k = isset($bloc_stade)?abs(array_pop($bloc_stade)):0;
		switch($k) {
			case 4: return "</div></div>";
			case 11: return "</div>";
			default: die("Erreur : #BLOC_FIN sans #BLOC_DEBUT ($k)");
		}

	}
}

?>