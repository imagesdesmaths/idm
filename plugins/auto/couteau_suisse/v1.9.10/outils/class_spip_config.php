<?php
if (!defined("_ECRIRE_INC_VERSION")) return;

# Fichier de configuration pris en compte par config_outils.php et specialement dedie a la configuration des 'class' SPIP
# -----------------------------------------------------------------------------------------------------------------------

function outils_class_spip_config_dist() {

// Ajout de l'outil 'class_spip'
add_outil(array(
	'id' => 'class_spip',
	'code:spip_options' => "\$GLOBALS['class_spip']='%%style_p%%';\n\$GLOBALS['class_spip_plus']='%%style_h%%';\n%%racc_hr%%%%racc_h1%%%%racc_h2%%%%racc_i1%%%%racc_i2%%%%racc_g1%%%%racc_g2%%%%puce%%",
	'code:fonctions'=>"%%ouvre_ref%%%%ferme_ref%%%%ouvre_note%%%%ferme_note%%",
	'categorie' => 'public',
	'description' => 
	// avant SPIP 2.0 : <hr/> seulement
	// et apres : <hr/> + puce
		(!defined('_SPIP19300')?'<:class_spip:1:>':'<:class_spip:2:>').
	// des SPIP 1.91 : les intertitres
		'<:class_spip:3:>'.
	// des SPIP 2.0 : les italiques, les gras + les styles
		(!defined('_SPIP19300')?'':'<:class_spip:4:>'),
));

// Ajout des variables utilisees ci-dessus
add_variables(array(
	'nom' => 'style_p',
	'format' => _format_CHAINE,
	'defaut' =>  "''",
	'code:strlen(%s)' => ' class=%s',
), array(
	'nom' => 'style_h',
	'format' => _format_CHAINE,
	'defaut' =>  '"spip"',
	'code:strlen(%s)' => ' class=%s',
), array(
	'nom' => 'racc_hr',
	'format' => _format_CHAINE,
	'defaut' => defined('_SPIP19300')?"''":"'<hr class=\"spip\" />'",
	'code:strlen(%s)' => "\$GLOBALS['ligne_horizontale']=%s;\n",
	'code:!strlen(%s)' => defined('_SPIP19300')?"\$GLOBALS['ligne_horizontale']=\"<hr\$GLOBALS[class_spip_plus] />\";\n":"",
), array(
	'nom' => 'racc_h1',
	'format' => _format_CHAINE,
	'defaut' => defined('_SPIP19300')?"''":"'<h3 class=\"spip\">'",
	'code:strlen(%s)' => "\$GLOBALS['debut_intertitre']=%s;\n",
	'code:!strlen(%s)' => "\$GLOBALS['debut_intertitre']=\"<h3\$GLOBALS[class_spip_plus]>\";\n",
), array(
	'nom' => 'racc_h2',
	'format' => _format_CHAINE,
	'defaut' => defined('_SPIP19300')?"''":"'</h3>'",
	'code:strlen(%s)' => "\$GLOBALS['fin_intertitre']=%s;\n",
	'code:!strlen(%s)' => "\$GLOBALS['fin_intertitre']='</h3>';\n",
), array(
	'nom' => 'racc_i1',
	'format' => _format_CHAINE,
	'defaut' => '',
	'code:strlen(%s)' => "\$GLOBALS['debut_italique']=%s;\n",
	'code:!strlen(%s)' => "\$GLOBALS['debut_italique']=\"<i\$GLOBALS[class_spip]>\";\n",
), array(
	'nom' => 'racc_i2',
	'format' => _format_CHAINE,
	'defaut' => '',
	'code:strlen(%s)' => "\$GLOBALS['fin_italique']=%s;\n",
	'code:!strlen(%s)' => "\$GLOBALS['fin_italique']='</i>';\n",
), array(
	'nom' => 'racc_g1',
	'format' => _format_CHAINE,
	'defaut' => '',
	'code:strlen(%s)' => "\$GLOBALS['debut_gras']=%s;\n",
	'code:!strlen(%s)' => "\$GLOBALS['debut_gras']=\"<strong\$GLOBALS[class_spip]>\";\n",
), array(
	'nom' => 'racc_g2',
	'format' => _format_CHAINE,
	'defaut' => '',
	'code:strlen(%s)' => "\$GLOBALS['fin_gras']=%s;\n",
	'code:!strlen(%s)' => "\$GLOBALS['fin_gras']='</strong>';\n",
), array(
	'nom'	=>	'ouvre_ref',
	'format'=>	_format_CHAINE,
	'code:!strlen(%s)'=>"\$GLOBALS['ouvre_ref']='&nbsp;[';\n",
	'code:strlen(%s)'=>"\$GLOBALS['ouvre_ref']=%s;\n"
), array(
	'nom'	=>	'ferme_ref',
	'format'=>	_format_CHAINE,
	'code:!strlen(%s)'=>"\$GLOBALS['ferme_ref']=']';\n",
	'code:strlen(%s)'=>"\$GLOBALS['ferme_ref']=%s;\n"
), array(
	'nom'	=>	'ouvre_note',
	'format'=>	_format_CHAINE,
	'code:!strlen(%s)'=>"\$GLOBALS['ouvre_note']='[';\n",
	'code:strlen(%s)'=>"\$GLOBALS['ouvre_note']=%s;\n"
), array(
	'nom'	=>	'ferme_note',
	'format'=>	_format_CHAINE,
	'code:!strlen(%s)'=>	"\$GLOBALS['ferme_note']=']';\n",
	'code:strlen(%s)'=> "\$GLOBALS['ferme_note']=%s;\n"
), array(
	'nom' => 'puce',
	'format' => _format_CHAINE,
	'defaut' => defined('_SPIP19300')?"''":'"AUTO"',
	'code:strlen(%s)' => "\$GLOBALS['puce']=%s;",
));

}

?>