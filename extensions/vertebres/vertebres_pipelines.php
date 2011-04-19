<?php

if (!defined("_ECRIRE_INC_VERSION")) return;

/*
 * Determiner l'utilisation du vertebreur
 * lorsque l'on passe un appel spip.php?page=table:articles
 */
function vertebres_styliser($flux) {

	// si pas de squelette trouve,
	// on verifie si on demande une vue de table
	if (!$squelette = $flux['data']) {
		
		$ext = $flux['args']['ext'];
		$fond = $flux['args']['fond'];
		$connect = $flux['args']['connect'];
		
		// Si pas de squelette regarder si c'est une table
		// et si l'on a la permission de l'afficher
		$trouver_table = charger_fonction('trouver_table', 'base');
		if (preg_match('/^table:(.*)$/', $fond, $r)
		AND $table = $trouver_table($r[1], $connect)
		AND include_spip('inc/autoriser')
		AND autoriser('webmestre')
		) {
			$fond = $r[1];
			$base = _DIR_TMP . 'table_' . $fond . ".$ext";
			if (!file_exists($base)
			OR  $GLOBALS['var_mode']) {
				$vertebrer = charger_fonction('vertebrer', 'public');
				ecrire_fichier($base, $vertebrer($table));
			}
			
			// sauver les changements
			$flux['data'] = _DIR_TMP . 'table_' . $fond;
		}
	}
	
	return $flux;
}

?>
