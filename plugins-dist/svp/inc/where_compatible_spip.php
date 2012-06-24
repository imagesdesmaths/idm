<?php
if (!defined("_ECRIRE_INC_VERSION")) return;

/**
 * Fonction qui construit le WHERE du select des plugins ou paquets
 * compatibles avec une version ou une branche de spip.
 * Cette fonction est appelee par le critere {compatible_spip}
 * @return 
 */
function inc_where_compatible_spip($version='', $table, $op) {

	// le critere s'applique a une VERSION (1.9.2, 2.0.8, ...)
	if (count(explode('.', $version)) == 3) {
		$min = 'SUBSTRING_INDEX(' . $table . '.compatibilite_spip, \';\', 1)';
		$max = 'SUBSTRING_INDEX(' . $table . '.compatibilite_spip, \';\', -1)';

		$where = 'CASE WHEN '.$min.' = \'\'
	OR '.$min.' = \'[\'
	THEN \'1.9.0\' <= \''.$version.'\'
	ELSE TRIM(LEADING \'[\' FROM '.$min.') <= \''.$version.'\'
	END
AND
	CASE WHEN '.$max.' = \'\'
	OR '.$max.' = \']\'
	THEN \'99.99.99\' >= \''.$version.'\'
	WHEN '.$max.' = \')\'
	OR '.$max.' = \'[\'
	THEN \'99.99.99\' > \''.$version.'\'
	WHEN RIGHT('.$max.', 1) = \')\'
	OR RIGHT('.$max.', 1) = \'[\'
	THEN LEFT('.$max.', LENGTH('.$max.') - 1) > \''.$version.'\'
	ELSE LEFT('.$max.', LENGTH('.$max.') - 1) >= \''.$version.'\'
	END';
	}
	// le critere s'applique a une BRANCHE (1.9, 2.0, ...)
	elseif (count(explode('.', $version)) == 2) {
		$where = 'LOCATE(\''.$version.'\', '.$table.'.branches_spip) '.$op.' 0';
	}
	// le critere est vide ou mal specifie
	else {
		$where = '1=1';
	}

	return $where;
}
?>
