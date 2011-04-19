<?php
// Sait-on extraire ce format ?
// TODO: ici tester si les binaires fonctionnent
$GLOBALS['extracteur']['pdf'] = 'extracteur_pdf';

// NOTE : l'extracteur n'est pas oblige de convertir le contenu dans
// le charset du site, mais il *doit* signaler le charset dans lequel
// il envoie le contenu, de facon a ce qu'il soit converti au moment
// voulu ; dans le cas contraire le document sera lu comme s'il etait
// dans le charset iso-8859-1

// http://doc.spip.org/@extracteur_pdf
function extracteur_pdf($fichier, &$charset) {
  $charset = 'iso-8859-1';
	
  $texte = '';
  $output = array();
  if (defined('_FULLTEXT_PDF_EXE')) {
    $exe = _FULLTEXT_PDF_EXE;
  } else {
  	// TODO : essayer de trouver tout seul l'exécutable
  	spip_log('Erreur extraction PDF : Il faut spécifier _FULLTEXT_PDF_EXE dans mes_options.php');
  	return false;
  }
  if (defined(_FULLTEXT_PDF_CMD_OPTIONS) && '' != _FULLTEXT_PDF_CMD_OPTIONS) {
  	$options = ' '._FULLTEXT_PDF_CMD_OPTIONS.' ';
  } else {
  	$options = ' ';
  }
 	spip_log('Extraction PDF avec '.$exe, 'extract');
  $cmd = $exe.$options.$fichier;
  $sortie = exec($cmd, $output, $return_var);
  if ($return_var != 0) {
    if ($return_var == 3) {
      $erreur = "Le contenu de ce fichier PDF est protégé.";
    }
    spip_log('Erreur extraction '.$fichier.' (code '.$return_var.') : '.$erreur, 'extract');
    return false;
  } else {
    // on ouvre et on lit le .txt
    // TODO : comment connaitre l'encoding du fichier ?
    $nouveaufichier = str_replace('.pdf', '.txt', $fichier);
    if (file_exists($nouveaufichier) && is_readable($nouveaufichier)) {
      $texte = file_get_contents($nouveaufichier);
      unlink($nouveaufichier);
      return $texte;
    } else {
      spip_log('Erreur extraction PDF : Le fichier texte n\'existe pas ou n\'est pas lisible.', 'extract');
      return false;
    }
  }
}
?>
