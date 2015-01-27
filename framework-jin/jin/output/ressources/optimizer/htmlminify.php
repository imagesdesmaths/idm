<?php
/**
 * Jin Framework
 * Diatem
 */
namespace jin\output\ressources\optimizer;

/**
 * Gestion de la compression de texte HTML
 */
class HtmlMinify {

    /**
     * Compresse du contenu HTML
     * @param string $content	Contenu à compresser
     * @return string
     */
    public static function htmlMinify($content) {
	$content = str_replace(array(chr(9), chr(10), chr(11), chr(13)), ' ', $content);
	$content = preg_replace('`<\!\-\-[^\[]*\-\->`U', ' ', $content);
	$content = preg_replace('/[ ]+/', ' ', $content);
	$content = str_replace('> <', '><', $content);
	return $content;
    }

}
