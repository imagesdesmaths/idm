<?php
/**
 * Jin Framework
 * Diatem
 */
namespace jin\output\ressources\optimizer;

/**
 * Gestion de la compression de texte CSS
 */
class CssMinify {

    /**
     * Compresse du contenu CSS
     * @param string $css	Contenu à compresser
     * @return string
     */
    public static function cssMinify($css) {
	$css = preg_replace('#\s+#', ' ', $css);
	$css = preg_replace('#/\*.*?\*/#s', '', $css);
	$css = str_replace('; ', ';', $css);
	$css = str_replace(': ', ':', $css);
	$css = str_replace(' {', '{', $css);
	$css = str_replace('{ ', '{', $css);
	$css = str_replace(', ', ',', $css);
	$css = str_replace('} ', '}', $css);
	$css = str_replace(';}', '}', $css);

	return trim($css);
    }

}
