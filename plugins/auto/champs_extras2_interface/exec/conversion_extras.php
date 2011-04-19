<?php
if (!defined("_ECRIRE_INC_VERSION")) return;

include_spip('inc/presentation');

function exec_conversion_extras_dist(){
	global $spip_lang_right;
	// si pas autorise : message d'erreur
	if (!autoriser('configurer', 'conversion_extras')) {
		include_spip('inc/minipres');
		echo minipres();
		die();
	}

	// pipeline d'initialisation
	pipeline('exec_init', array('args'=>array('exec'=>'conversion_extras'),'data'=>''));

	// entetes
	$commencer_page = charger_fonction('commencer_page', 'inc');
	echo $commencer_page(_T('iextras:titre_page_conversion_extras'), "configuration", "configuration");
	
	// titre
	echo "<br /><br /><br />\n"; // outch que c'est vilain !
	echo gros_titre(_T('iextras:titre_conversion_extras'),'', false);
	
	// barre d'onglets
	echo barre_onglets("configuration", "iextras");
	
	// colonne gauche
	echo debut_gauche('', true);
	echo pipeline('affiche_gauche', array('args'=>array('exec'=>'conversion_extras'),'data'=>''));
	
	// colonne droite
	echo creer_colonne_droite('', true);
	echo pipeline('affiche_droite', array('args'=>array('exec'=>'conversion_extras'),'data'=>''));
	
	// centre
	echo debut_droite('', true);

	// contenu
	include_spip('inc/iextras');
	include_spip('inc/cextras_gerer');

	if (!is_array($GLOBALS['champs_extra']))
		die ('Rien a convertir');

	foreach ($GLOBALS['champs_extra'] as $type => $ext) {
		echo "<h2>$type</h2>\n";
		echo "<dl>";

		foreach ($ext as $extra => $def) {
			echo "<dt>$extra</dt>\n";
			
			echo "<dd>$def</dd>\n";
			echo "<dd>";

			$vals = iextras_a_convertir($type, $extra);
			if ($vals) {
				if (_request('convertir') == "$type-$extra"
				AND preg_match(',^[a-z0-9_]+$,i', _request('extra_dest'))
				AND $s = sql_select(_request('extra_dest'), 'spip_'.table_objet($type))
				) {
					iextras_convertir($type, $extra);
				}
				else {
					echo count($vals)." $type ($extra) à convertir : veuillez indiquer le nom du champ extra2 o&#249; recopier les donn&#233;es";
					echo "<form action='".parametre_url(self(), 'convertir', '')."' method='post'>
						<input type='hidden' name='convertir' value='$type-$extra' />
						<input type='text' name='extra_dest' value='' />
						<input type='submit' value='Convertir' />
						</form>\n";
				}
			
			} else
				echo "Aucun $type ($extra) &#224; convertir.";
			echo "</dd>\n";

		}
	
		echo "</dl>\n";
	
	}

	// fin contenu

	echo pipeline('affiche_milieu', array('args'=>array('exec'=>'conversion_extras'),'data'=>''));

	echo fin_gauche(), fin_page();
}

// items a convertir
function iextras_a_convertir($type, $extra) {
	$s = sql_select(id_table_objet($type)." AS id,extra", 'spip_'.table_objet($type), "extra LIKE ".sql_quote("%$extra%"));
	$vals = array();
	while ($t = sql_fetch($s)) {
		if (is_array($e = @unserialize($t['extra']))
		AND strlen($val = $e[$extra]))
			$vals[$t['id']] = $e[$extra];
	}
	return $vals;
}

// Effectuer la conversion
function iextras_convertir($type, $extra) {
	$s = sql_select(id_table_objet($type)." AS id,extra", 'spip_'.table_objet($type), "extra LIKE ".sql_quote("%$extra%"));

	$extra2 = _request('extra_dest');
	$cpt = 0;
	while ($t = sql_fetch($s)) {
		if (is_array($e = @unserialize($t['extra']))
		AND strlen($val = $e[$extra])) {
			unset($e[$extra]);
			if (count($e))
				$e = serialize($e);
			else
				$e = '';

			sql_updateq('spip_'.table_objet($type),
				array('extra'=>$e,$extra2 => $val),
				id_table_objet($type) .'='. $t['id']
			);
			
			$cpt++;
		}
	}

	echo $cpt." $type ($extra) convertis";
}

?>
