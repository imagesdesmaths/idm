<?php
/**
 * Jin Framework
 * Diatem
 */

namespace jin\log;

use jin\lang\StringTools;
use jin\filesystem\File;
use jin\filesystem\AssetFile;
use \ReflectionMethod;


/** Outils de debuggage/dump
 *
 * 	@auteur		Loïc Gerard
 * 	@version	0.0.1
 * 	@check		24/04/2014
 */
class Debug {

    /** Etat d'activation de l'affichage des instructions de debug
     * 
     * 	@var boolean
     */
    private static $activated = true;

    
    /** Premier trace/dump envoyé dans la sortie navigateur. (Pour affichage css nécessaire)
     * 
     * 	@var boolean
     */
    private static $firstDump = false;

    
    //----------------------------------------------------------------------------------------
    //DUMP

    /** Affiche le dump de la structure d'une variable
     * 
     * 	@param	mixed	$var	Variable à tracer
     */
    public static function dump($var) {
	if (self::$activated) {
	    echo self::getDump($var);
	}
    }
    
    
    /** Retourne le dump de la structure d'une variable
     * 
     * 	@param	mixed	$var	Variable à tracer
     * 	@return string	Dump formaté HTML de la structure
     *	@todo Tests sur les classes SGBD à refaire
     */
    public static function getDump($var) {
	//Trace
	$trace = debug_backtrace();

	//Initialise la sortie
	$dump = '';

	//Header
	$dump .= self::getHeader('Dump de variable');

	//Contexte
	$dump .= '<div class="dump_segment">Contexte</div>';
	if (count($trace) > 2) {
	    $dump .= self::getContext($trace[1], $trace[2]);
	} else {
	    $dump .= self::getContext($trace[1]);
	}


	//Requête SQL
	if (is_object($var) && get_class($var) == 'sylab\common\sgbd\Query') {
	    $dump .= '<div class="dump_segment">Requête SQL</div>';
	    $dump .= '<div class="dump_segment_content">' . $var->getSql() . '</div>';
	}

	//Exploration
	$dump .= '<div class="dump_segment">Exploration de la variable</div>';
	$dump .= '<div class="dump_segment_content">';
	if (is_object($var) && get_class($var) == 'sylab\framework\query\Query') {
	    $dump .= self::getDumpQueryResult($var->getQueryResults());
	} elseif (is_object($var) && get_class($var) == 'sylab\framework\query\QueryResult') {
	    $dump .= self::getDumpQueryResult($var);
	} else {
	    $dump .= self::getDumpContent($var);
	}
	$dump .= '</div>';

	//Footer
	$dump .= self::getFooter();

	return $dump;
    }

    
    /**	Retourne le dump d'une query
     * 
     * @param Query $var Instance de jin\query\Query	
     * @return string	Code HTML du dump de la Query
     */
    public static function getDumpQueryResult($var) {
	$header = true;

	$dump = '<table cellpadding=5 cellspacing=0>';
	$i = 1;
	foreach ($var as $ligne) {
	    //Affichage du header
	    if ($header) {
		$dump .= '<tr>';
		foreach ($ligne as $key => $value) {
		    if (!is_numeric($key)) {
			$dump .= '<th>' . $key . '</th>';
		    }
		}
		$dump .= '</tr>';

		$header = false;
	    }

	    //Affichage des données
	    $class = '';
	    if (!($i % 2)) {
		$class = 'highlight';
	    }
	    $dump .= '<tr class="' . $class . '">';

	    foreach ($ligne as $key => $value) {
		if (!is_numeric($key)) {
		    if ($value != '') {
			$dump .= '<td>' . $value . '</td>';
		    } else {
			$dump .= '<td>&nbsp;</td>';
		    }
		}
	    }
	    $dump .= '</tr>';
	    $i++;
	}
	$dump .= '</table>';


	return $dump;
    }

    
    /** Retourne le dump d'une variable standard
     * 
     * @param type $var	Variable à dumper
     * @return string	Dump formatté HTML
     */
    private static function getDumpContent($var) {
	$dump = '<div class="dump_segment_content_main">';
	$dump .= '<div class="dump_variable">';
	$dump .= '<ul>';
	$dump .= self::dumpElement($var);
	$dump .= '</ul>';
	$dump .= '</div>';
	$dump .= '</div>';

	return $dump;
    }

    
    /** Dump d'un élément (fonction recursive)
     * 	@param	mixed	$var Variable à tracer
     * 	@param	string	$name Nom de l'élément ('' par défaut)
     * 	@return string	Dump de la variable
     */
    private static function dumpElement($var, $name = '') {
	$dump = '';

	//On récupère le type de variable
	$type = gettype($var);

	//Is parcourable
	$iterable = $type == 'object' || $type == 'array';

	//Affichage des informations sur l'élément courant
	$dump .= '<li>';
	$dump .= '<div class="dump_item">';

	if ($name !== "") {
	    $dump .= '<div class="dump_name">' . $name . '</div><div class="dump_pleinseparator">&nbsp;</div>';
	}
	$dump .= '<div class="dump_type">' . $type . '</div>';
	if ($type == 'string') {
	    $dump .= '<div class="dump_separator">&nbsp;</div><div class="dump_size">(' . StringTools::len($var) . ' caractères)</div>';
	} else if ($type == 'object') {
	    $dump .= '<div class="dump_separator">&nbsp;</div><div class="dump_size">' . get_class($var) . '</div>';
	} else if ($type == 'array') {
	    $dump .= '<div class="dump_separator">&nbsp;</div><div class="dump_size">(' . count($var) . ' éléments)</div>';
	}
	$dump .= '<div class="dump_clear"></div>';
	$dump .= '</div>';

	//Affichage du contenu

	if ($type == 'string') {
	    $dump .= '<div class="dump_item_content">' . htmlspecialchars($var) . '</div>';
	} else if ($type == 'boolean') {
	    $dump .= '<div class="dump_item_content">';
	    if ($var) {
		$dump .= 'TRUE';
	    } else {
		$dump .= 'FALSE';
	    }
	    $dump .= '</div>';
	} else if ($type == 'object') {
	    $dump .= '';
	} else {
	    $dump .= '<div class="dump_item_content">' . $var . '</div>';
	}

	//On parcourt les éléments iterables
	if ($iterable) {
	    $dump .= '<ul>';
	    foreach ($var as $key => $e) {
		$dump .= self::dumpElement($e, $key);
	    }
	    $dump .= '</ul>';
	}

	//Fermeture balise élément
	$dump .= '</li>';


	return $dump;
    }

    
    //----------------------------------------------------------------------------------------
    //TRACE

    /** Trace la pile d'execution
     * 
     * 	@return	void
     */
    public static function trace() {
	if (self::$activated) {
	    echo self::getTrace();
	}
    }

    
    /** Retourne le contenu d'un trace de la pile d'execution
     * 
     * 	@return string	Contenu formaté de la pile d'execution
     */
    public static function getTrace() {
	//Trace
	$trace = debug_backtrace();

	//Initialise la sortie
	$dump = '';

	//Header
	$dump .= self::getHeader('Trace du contexte');

	//Contexte
	$dump .= '<div class="dump_segment">Contexte</div>';

	$nb = count($trace);

	for ($i = 1; $i < $nb; $i++) {
	    if ($i < $nb - 1) {
		$dump .= self::getContext($trace[$i], $trace[$i + 1]);
	    } else {
		$dump .= self::getContext($trace[$i]);
	    }
	}

	//Footer
	$dump .= self::getFooter();

	return $dump;
    }

    
    //----------------------------------------------------------------------------------------
    //CUSTOM TRACE

    
    /**	Permet de rendre un contenu sous la forme d'un trace personnalisé
     * 
     * @param string $titre   Titre de la fenêtre
     * @param string $content	Contenu à afficher
     * @return string	Contenu formatté HTML
     */
    public static function getCustomTrace($titre, $content) {
	//Initialise la sortie
	$dump = '';

	//Header
	$dump .= self::getHeader($titre);

	//Onglets
	foreach ($content as $onglet) {
	    $dump .= '<div class="dump_segment">' . $onglet['name'] . '</div>';
	    $dump .= '<div class="dump_segment_content">';
	    $dump .= $onglet['content'];
	    $dump .= '</div>';
	}

	//Footer
	$dump .= self::getFooter();

	return $dump;
    }

    
    //----------------------------------------------------------------------------------------
    //METHODES GENERIQUES

    
    /** Retourne la balise style pour l'affichage des dump/trace
     * 
     * 	@return string	Contenu style
     */
    private static function getStyle() {
	$f = new AssetFile('debug/style.css');
	$styles = $f->getContent();

	$s = '<style>';
	$s .= $styles;
	$s .= '</style>';

	return $s;
    }

    
    
    /** Retourne la balise script pour l'affichage des dump/trace
     * 
     * 	@return string	Contenu script
     */
    private static function getScript() {
	$f = new AssetFile('debug/debug.js');
	$script = $f->getContent();

	$s = '<script language="javascript">';
	$s .= $script;
	$s .= '</script>';

	return $s;
    }

    
    /** Retourne la trace d'un contexte
     * 
     * 	@param array	$contexte   Contexte à analyser
     * 	@param array 	$rcontexte  Contexte servant à analyser la méthode courante (contexte à n+1)
     * 	@return string	Contexte formaté
     */
    public static function getContext($contexte, $rcontexte = NULL) {
	$dump = '';

	$segmentId = uniqid();
	$dump .= '<div class="dump_segment_content">';

	$dump .= '<div onclick="javascript:debugOpenClose(\'' . $segmentId . '\');" class="dump_segment_content_header" id="dump_segment_' . $segmentId . '">';
	$dump .= '<b>' . $contexte['file'] . '</b> ligne ' . $contexte['line'] . '</div>';

	$dump .= '<div class="dump_segment_content_main" style="display:none;" id="dump_segment_content_' . $segmentId . '">';

	if (!is_null($rcontexte) && isset($rcontexte['function']) && $rcontexte['function'] != '') {

	    $dump .= '<div class="dump_segment_content_context">';

	    if (isset($rcontexte['class'])) {
		$dump .= '<div class="dump_segment_content_context_line"><b>classe :</b> ' . $rcontexte['class'] . '</div>';
	    }

	    $dump .= '<div class="dump_segment_content_context_line"><b>méthode :</b> ' . $rcontexte['function'] . "(";

	    //Cas d'une méthode
	    if (isset($rcontexte['class'])) {
		$rm = new ReflectionMethod($rcontexte['class'], $rcontexte['function']);
		$argsname = $rm->getParameters();
		$args = $rcontexte['args'];

		$nb = count($argsname);
		for ($i = 0; $i < $nb; $i++) {
		    $ap = $argsname[$i];
		    if ($i > 0) {
			$dump .= ', ';
		    }
		    $dump .= $argsname[$i]->name;
		}
	    } else {
		//Cas d'une fonction
		$args = $rcontexte['args'];

		$nb = count($args);
		for ($i = 0; $i < $nb; $i++) {
		    if ($i > 0) {
			$dump .= ', ';
		    }
		    $dump .= $i . '=\'' . $args[$i] . '\'';
		}
	    }
	    $dump .= ')</div>';
	    $dump .= '</div>';
	}

	$file = new File($contexte['file']);
	$index = $contexte['line'] - 5;
	if ($index < 0) {
	    $index = 0;
	}
	$fileLines = $file->getLines($index, 11, false);

	$nb = count($fileLines);
	for ($i = 0; $i < $nb; $i++) {
	    if ($index == $contexte['line'] - 1) {
		$dump .= '<div class="dump_file_line dump_file_line_selected">';
	    } else {
		$dump .= '<div class="dump_file_line">';
	    }

	    $dump .= '<div class="dump_file_line_number">' . ($index + 1) . '</div><div class="dump_file_line_content">' . htmlspecialchars($fileLines[$i]) . '</div>';
	    $index++;
	    $dump .= '</div>';
	}
	$dump .= '<div class="clear"></div>';

	$dump .= '</div>';

	$dump .= '</div>';


	return $dump;
    }

    
    /** Retourne un header formaté d'une opération de debug/trace
     * 
     * 	@param string 	$titre		[optionel] Titre de la fenêtre (Vide par défaut)
     * 	@return string	Contenu formaté
     */
    private static function getHeader($titre = NULL) {
	$dump = '';

	//Style
	if (!self::$firstDump) {
	    $dump .= self::getStyle();
	    $dump .= self::getScript();
	}

	//En-tête
	$dump .= '<div class="dump_container">';
	if ($titre) {
	    $dump .= '<div class="dump_title">' . $titre . '</div>';
	}

	return $dump;
    }

    
    /** Retourne un footer formaté d'une opération de debug/trace
     * 
     * 	@return string	Contenu formaté
     */
    private static function getFooter() {
	$dump = '';
	$dump .= '</div>';

	return $dump;
    }
    

    /** Active ou désactive les instructions de debug
     * 
     * 	@param	boolean	$etat	Etat d'activation
     * 	@return	void
     */
    public static function setEnabled($etat) {
	self::$activated = $etat;
    }

    
    /** Retourne le statut d'activation du debug
     * 
     * 	@return	boolean	Etat d'activation
     */
    public static function getEnabled() {
	return self::$activated;
    }

}
