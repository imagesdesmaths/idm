<?php
/**
 * Jin Framework
 * Diatem
 */
namespace jin\log;

use jin\log\Debug;
use jin\lang\TimeTools;

/** Boite d'analyse des performances
 *
 * 	@auteur		Loïc Gerard
 * 	@version	0.0.1
 * 	@check		24/04/2014
 */
class PerfAnalyser {

    /** Tableau des points de contrôle enregistrés
     * @type	array
     * 	@var array
     */
    private $points = array();

    
    /** Constructeur (instancie un premier point de contrôle, débute l'analyse)
     */
    public function __construct() {
	$this->_addPoint('[START]');
    }

    
    /** Ajoute un point de contrôle sur lequel analyser le temps écoulé depuis l'instanciation de la classe
     */
    public function addPoint() {
	$this->_addPoint();
    }

    
    /** Ajoute techniquement le point de contrôle
     * 	@param 	string	 $entete	[optionel] En-tête affiché ('[POINT]' par défaut)
     */
    private function _addPoint($entete = '[POINT]') {
	$trace = debug_backtrace();
	$time = TimeTools::getTimestampInMs();
	if (count($this->points) == 0) {
	    $elapsed = 0;
	} else {
	    $elapsed = $time - $this->points[0]['time'];
	}
	$p = array('time' => $time, 'entete' => $entete, 'contexte' => $trace[1]['file'] . ' ligne ' . $trace[1]['line'], 'elapsed' => $elapsed);
	$this->points[] = $p;
    }

    
    /** Génère et affiche un rapport de performances. (Ajoute un dernier point de contrôle qui clôt l'analyse)
     * 	@param	string	$titre	    [optionel] Titre du rapport ('Rapport de performance' par défaut)
     */
    public function renderTimeReport($titre = 'Rapport de performance') {
	if (Debug::getEnabled() || Config::get('reportTimeEnabled')) {
	    $this->_addPoint('[STOP]');
	    $diff = $this->points[count($this->points) - 1]['time'] - $this->points[0]['time'];

	    $dump = '';

	    $c = count($this->points);
	    for ($i = 0; $i < $c; $i++) {


		$dump .= '<div class="dump_segment_content_point">';
		$dump .= '<b>' . $this->points[$i]['entete'] . '</b> ' . $this->points[$i]['contexte'] . ' :: <b>' . $this->points[$i]['elapsed'] . ' ms</b>';
		$dump .= '</div>';
	    }

	    $dump .= '<div class="dump_segment_content_pointend">';
	    $dump .= '<B>TOTAL : ' . $diff . ' ms</b>';
	    $dump .= '</div>';

	    echo Debug::getCustomTrace($titre, array(array('name' => 'Points d\'analyse', 'content' => $dump)));
	}
    }
    
    
    /**
     * Retourne le temps total d'execution en milisecondes
     * @return integer
     */
    public function getTotalTimeInMS(){
	$diff = $this->points[count($this->points) - 1]['time'] - $this->points[0]['time'];
	return $diff;
    }

}
