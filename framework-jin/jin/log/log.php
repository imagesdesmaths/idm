<?php
/**
 * Jin Framework
 * Diatem
 */

namespace jin\log;

use jin\filesystem\File;
use \DateTime;

/**  Permet l'écriture de logs
 *
 * 	@auteur		Loïc Gerard
 * 	@version	0.0.1
 * 	@check		24/04/2014
 */
class Log {
    /**	Service actif / inactif
     *
     * @var boolean
     */
    private static $enabled = false;
    
    
    /**	Chemin d'accès relatif ou absolu au fichier de logs
     *
     * @var string
     */
    private static $logFilePath = '';

    /**	Active les logs
     * 
     * @param string $writePath	Chemin relatif ou absolu du fichier dans lequel écrire les logs
     * @return boolean	Activation réussie ou non
     * @throws \Exception
     */
    public static function enableLogging($writePath){
	if(is_file($writePath)){
	    self::$enabled = true;
	    self::$logFilePath = $writePath;
	    return true;
	}else{
	    throw new \Exception('Impossible d\'activer les logs dans le fichier '.$writePath.' : celui ci n\'existe pas.');
	    return false;
	}
    }
    
    
    /**	Désactive les logs
     * 
     */
    public static function disableLogging(){
	self::$enabled = false;
    }
    
    
    /**	Ecrire dans les logs
     * 
     * @param string $output  Ligne à écrire
     */
    public static function write($output) {
	if (self::$enabled) {
	    $d = new DateTime();
	    $f = new File(self::$logFilePath, true);
	    $f->write($d->format('d/m/Y H:i:s') . ' - ' . $output . "\n", true);
	}
    }

    
    /**	Réinitialise le fichier de logs
     * 
     */
    public static function clear() {
	if (self::$enabled) {
	    $f = new File(self::$logFilePath, true);
	    $f->write('', false);
	}
    }

    
    /**	Modifie la destination des logs
     * 
     * @param string $writePath
     * @return boolean
     * @throws \Exception
     */
    private static function setPath($writePath) {
	if(is_file($writePath)){
	    self::$logFilePath = $writePath;
	    return true;
	}else{
	    throw new \Exception('Impossible de modifier la destination des logs : le fichier '.$writePath.' n\'existe pas.');
	    return false;
	}
    }
}
