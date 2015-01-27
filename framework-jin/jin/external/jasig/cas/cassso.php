<?php
/**
 * Jin Framework
 * Diatem
 */

namespace jin\external\jasig\cas;
use jin\JinCore;
use jin\lang\StringTools;
use \phpCAS as phpCAS;

/** Gestion de l'authentification unique avec un serveur CAS de Jasig
 *
 * 	@auteur		Loïc Gerard
 */
class CasSSO{
    private static $host;
    private static $port;
    private static $context;
    private static $ssl;
    private static $debugging;
    private static $serviceId;
    private static $initialized;
    
    /**
     * Configure l'accès au serveur CAS. Nécessaire pour que les méthodes de
     * connexion puissent fonctionner correctement
     * @param string $host  Url du serveur CAS
     * @param integer $port Port du serveur CAS
     * @param string $serviceId	ID du service (pour CAS)
     * @param string $context	Contexte, ou namespace
     * @param boolean $ssl  [OPTIONEL] SSL activé (true par défaut)
     * @param boolean $debugging    [OPTIONAL] Mode debug activé (false par défaut)
     */
    public static function configure($host, $port, $serviceId, $context = 'cas', $ssl = true, $debugging = false){
	self::$host = $host;
	self::$port = $port;
	self::$context = $context;
	self::$ssl = $ssl;
	self::$debugging = $debugging;
	self::$serviceId = $serviceId;
	
	$casPath = JinCore::getJinRootPath().JinCore::getRelativeExtLibs().'cas/';
	require_once  $casPath.'CAS.php';
	
	if(self::$debugging){
	    phpCAS::setDebug();
	}
	
	$serviceId = StringTools::urlEncode(self::$serviceId);
	phpCAS::client(CAS_VERSION_2_0, self::$host, self::$port, self::$context);
	
	if(!self::$ssl){
	    phpCAS::setNoCasServerValidation();
	}
	
	phpCAS::setServerLoginURL(self::getBaseUrl().'login?service='.$serviceId);
	phpCAS::setServerServiceValidateURL(self::getBaseUrl().'serviceValidate');
	phpCAS::setServerProxyValidateURL(self::getBaseUrl().'proxyValidate');
	phpCas::setServerLogoutURL(self::getBaseUrl().'logout?destination='.$serviceId);
	
	self::$initialized = true;
    }
    
    
    /**
     * Initie une procédure de login
     */
    public static function login(){
	self::checkInit();
	
	phpCAS::forceAuthentication();
    }
    
    
    /**
     * Déconnexion au serveur CAS (tous services)
     */
    public static function logout(){
	self::checkInit();
	
	phpCAS::logout();
    }
    
    
    /**
     * Permet de savoir si l'utilisateur est connecté
     * @return boolean
     */
    public static function isLogin(){
	self::checkInit();
	
	return phpCAS::isAuthenticated();
    }
    
    
    /**
     * Vérifie l'authentification de l'utilisateur
     * @return boolean
     */
    public static function checkAuthentification(){
	self::checkInit();
	
	if(self::isLogin()){
	    return phpCAS::checkAuthentication();
	}else{
	    return false;
	}
    }
    
    
    /**
     * Initie automatiquement une procédure de login si l'utilisateur n'est pas connecté
     */
    public static function autoLogin(){
	self::checkInit();
	
	if(!self::isLogin()){
	    self::login();
	}
    }
    
    
    /**
     * Retourne l'userID de CAS pour l'utilisateur connecté
     * @return string
     */
    public static function getUser(){
	self::checkInit();
	
	return phpCAS::getUser();
    }
    
    
    /**
     * Retourne la version utilisée de CAS
     * @return string
     */
    public static function getCasVersion(){
	self::checkInit();
	
	return phpCAS::getVersion();
    }
    
    
    /**
     * Construit l'url de connexion au serveur
     * @return string
     */
    private static function getBaseUrl(){
	$baseUrl = 'https://';
	if(!self::$ssl){
	    $baseUrl = 'http://';
	}
	$baseUrl .= self::$host.':'.self::$port.'/'.self::$context.'/';
	return $baseUrl;
    }
    
    
    /**
     * Vérifie que la connexion à CAS est configurée avec CasSSO::configure. Génère une erreur dans le cas contraire
     * @throws \Exception
     */
    private static function checkInit(){
	if(!self::$initialized){
	    throw new \Exception('Vous devez appeler CasSSO::configure(...) avant toute autre opération d\'identification');
	}
    }
    
}
