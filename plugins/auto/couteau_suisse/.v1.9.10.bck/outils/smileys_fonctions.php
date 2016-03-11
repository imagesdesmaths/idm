<?php

// Outil SMILEYS - 25 decembre 2006
// balise #SMILEYS : Patrice Vanneufville, 2007
// Toutes les infos sur : http://contrib.spip.net/?article1561
// dessin des frimousses : Sylvain Michel [http://www.guaph.net/]

function balise_SMILEYS_dist($p) {
	// Fonctions abandonnees par le plugin Porte Plume
	$js_compat = !defined('_DIR_PLUGIN_PORTE_PLUME')?"":"<script type=\"text/javascript\">/*<![CDATA[*/
// From SPIP 2.0 (spip_barre.js)
if(typeof barre_inserer!='function') { function barre_inserer(text,champ) {
	var txtarea = champ;
	if(document.selection){
		txtarea.focus();
		var r = document.selection.createRange();
		if (r == null) {
			txtarea.selectionStart = txtarea.value.length;
			txtarea.selectionEnd = txtarea.selectionStart;
		} else {
			var re = txtarea.createTextRange();
			var rc = re.duplicate();
			re.moveToBookmark(r.getBookmark());
			rc.setEndPoint('EndToStart', re);
			txtarea.selectionStart = rc.text.length;
			txtarea.selectionEnd = rc.text.length + r.text.length;
		}
	} 
	mozWrap(txtarea, '', text);
}}
// From http://www.massless.org/mozedit/
if(typeof mozWrap!='function') { function mozWrap(txtarea, open, close) {
	var selLength = txtarea.textLength;
	var selStart = txtarea.selectionStart;
	var selEnd = txtarea.selectionEnd;
	if (selEnd == 1 || selEnd == 2)	selEnd = selLength;
	var selTop = txtarea.scrollTop;
	// Raccourcir la selection par double-clic si dernier caractere est espace	
	if (selEnd - selStart > 0 && (txtarea.value).substring(selEnd-1,selEnd) == ' ') selEnd = selEnd-1;
	var s1 = (txtarea.value).substring(0,selStart);
	var s2 = (txtarea.value).substring(selStart, selEnd)
	var s3 = (txtarea.value).substring(selEnd, selLength);
	txtarea.value = s1 + open + s2 + close + s3;
	selDeb = selStart + open.length;
	selFin = selEnd + close.length;
	window.setSelectionRange(txtarea, selDeb, selFin);
	txtarea.scrollTop = selTop;
	txtarea.focus();
	return;
}}
/*]]>*/</script>\n";
	// le tableau des smileys est present dans les metas
	$smileys = cs_lire_data_outil('smileys');;
	// valeurs par defaut
	$nb_col = 8;
	$titre = _T('couteau:smileys_dispos');
	$head = '';
	$liens = false;
	// traitement des arguments : [(#SMILEYS{arg1, arg2, ...})]
	$n=1;
	$arg = interprete_argument_balise($n++,$p);
	while ($arg){
		// un nombre est le nombre de colonne
		if (preg_match(",'([0-9]+)',", $arg, $reg)) 
			$nb_col = intval($reg[1]);
		// on veut un titre
		elseif ($arg=="'titre'") 
			$head = "<thead><tr class=\"row_first\"><td colspan=\"$nb_col\">$titre</td></tr></thead>";
		// on veut un lien d'insertion sur chaque smiley
		elseif ($arg=="'liens'") {
			$liens = true;
			include_spip('outils/smileys');
			$smileys = smileys_uniques($smileys);
		}
		$arg = interprete_argument_balise($n++,$p);
	}
	$max = count($smileys[0]);
	if (!$nb_col) $nb_col = $max;
	$html = "<table summary=\"$titre\" class=\"spip cs_smileys smileys\">$head";
	$l = 1;
	for ($i=0; $i<$max; $i++) {
		if ($i % $nb_col == 0) {
			$class = 'row_'.alterner($l++, 'even', 'odd');
			$html .= "<tr class=\"$class\">";
		}
		$html .= $liens
			?"<td><a href=\"javascript:barre_inserer('{$smileys[0][$i]}',document.getElementById('".(defined('_SPIP19300')?'texte':'textarea_1')."'))\">{$smileys[1][$i]}</a></td>"
			:"<td>{$smileys[1][$i]}<br />{$smileys[0][$i]}</td>";
		if ($i % $nb_col == $nb_col - 1)
			$html .= "</tr>\n";
	}
	// on finit la ligne qd meme...
	if ($i = $max % $nb_col) $html .= str_repeat('<td>&nbsp;</td>', $nb_col - $i) . '</tr>';

	// accessibilite : alt et title avec le smiley en texte
	$html = $js_compat . echappe_retour($html, 'SMILE');
	$html = str_replace("'", "\'", $html);
	$p->code = "'$html\n</table>\n'";
	$p->interdire_scripts = false;
	$p->type = 'html';
	return $p;
}

?>