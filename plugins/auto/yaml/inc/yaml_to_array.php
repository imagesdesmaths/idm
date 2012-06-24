<?php

if (!defined('_ECRIRE_INC_VERSION')) return;

function inc_yaml_to_array_dist($u) {
	include_spip('inc/yaml');
	if (is_array($yaml = yaml_decode($u)))
		$tableau = $yaml;
	else if (is_object($yaml))
		$tableau = (array) $yaml;

	return $tableau;
}

?>
