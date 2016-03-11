<?php
/**
 * Plugin Spip-Bonux
 * Le plugin qui lave plus SPIP que SPIP
 * (c) 2008 Mathieu Marcillaud, Cedric Morin, Tetue
 * Licence GPL
 *
 * Fonctions d'export d'une requete sql ou d'un tableau
 * au format CSV
 * Merge du plugin csv_import et spip-surcharges
 *
 */

if (!defined('_ECRIRE_INC_VERSION')) return;

include_spip('inc/charsets');
include_spip('inc/filtres');
include_spip('inc/texte');

/**
 * Exporter un champ pour un export CSV : pas de retour a la ligne,
 * et echapper les guillements par des doubles guillemets
 * @param string $champ
 * @return string
 */
function exporter_csv_champ($champ) {
	#$champ = str_replace("\r", "\n", $champ);
	#$champ = preg_replace(",[\n]+,ms", "\n", $champ);
	#$champ = str_replace("\n", ", ", $champ);
	$champ = preg_replace(',[\s]+,ms', ' ', $champ);
	$champ = str_replace('"', '""', $champ);
	return '"'.$champ.'"';
}

/**
 * Exporter une ligne complete au format CSV, avec delimiteur fourni
 * @param array $ligne
 * @param string $delim
 * @return string
 */
function exporter_csv_ligne($ligne, $delim = ',', $importer_charset = null) {
	$output = join($delim, array_map('exporter_csv_champ', $ligne))."\r\n";
	if ($importer_charset){
		$output = str_replace('’', '\'', $output);
    $output = unicode2charset(html2unicode(charset2unicode($output)), $importer_charset);
	}
	return $output;
}


function inc_exporter_csv_dist($titre, $resource, $delim=',', $entetes = null,$envoyer = true){

	$filename = preg_replace(',[^-_\w]+,', '_', translitteration(textebrut(typo($titre))));
	
	if ($delim == 'TAB') $delim = "\t";
	if (!in_array($delim,array(',',';',"\t")))
		$delim = ",";

	$charset = $GLOBALS['meta']['charset'];
	$importer_charset = null;
	if ($delim == ',')
		$extension = 'csv';
	else {
		$extension = 'xls';
		# Excel n'accepte pas l'utf-8 ni les entites html... on transcode tout ce qu'on peut
		$importer_charset = $charset = 'iso-8859-1';
	}
	$filename = "$filename.$extension";

	if ($entetes AND is_array($entetes) AND count($entetes))
		$output = exporter_csv_ligne($entetes,$delim,$importer_charset);

	// on passe par un fichier temporaire qui permet de ne pas saturer la memoire
	// avec les gros exports
	$fichier = sous_repertoire(_DIR_CACHE,"export") . $filename;
	$fp = fopen($fichier, 'w');
	$length = fwrite($fp, $output);

	while ($row=is_array($resource)?array_shift($resource):sql_fetch($resource)){
		$output = exporter_csv_ligne($row,$delim,$importer_charset);
		$length += fwrite($fp, $output);
	}
	fclose($fp);

	if ($envoyer) {
		Header("Content-Type: text/comma-separated-values; charset=$charset");
		Header("Content-Disposition: attachment; filename=$filename");
		//non supporte
		//Header("Content-Type: text/plain; charset=$charset");
		Header("Content-Length: $length");
		ob_clean();
    flush();
    readfile($fichier);
	}

	return $fichier;
}

?>