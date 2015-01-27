<?php
/**
 * Jin Framework
 * Diatem
 */
namespace jin\db;

use jin\db\PostgreSql;
use jin\db\MySql;
use \Exception;
use jin\JinCore;

/** Gestion de la connexion aux bases de données
 *
 * 	@auteur		Loïc Gerard
 * 	@version	alpha
 * 	@check
 */
class DbConnexion {
    /**
     * @var object  Objet connexion
     */
    public static $cnxHandler = NULL;
    
    /**
     * @var boolean Indique si la connexion a été ouverte avec succès 
     */
    private static $cnxOpened = false;

    
    /**	Initialise la connexion sur une Base de données PostgreSQL
     * 
     * @param string $host  Url du serveur PostgreSQL
     * @param string $user  Utilisateur de base de données
     * @param string $pass  Password de l'utilisateur
     * @param integer $port Port utilisé
     * @param string $dbname	Nom de la base de données
     * @return boolean	Succès ou echec de connexion
     */
    public static function connectWithPostgreSql($host, $user, $pass, $port, $dbname) {
	self::$cnxHandler = new PostgreSql($host, $user, $pass, $port, $dbname);
	return self::$cnxHandler->connect();
    }
    
    
    /**	Initialise la connexion sur une Base de données MySql
     * 
     * @param string $host  Url du serveur MySql
     * @param string $user  Utilisateur de base de données
     * @param string $pass  Password de l'utilisateur
     * @param integer $port Port utilisé
     * @param string $dbname	Nom de la base de données
     * @return boolean	Succès ou echec de connexion
     */
    public static function connectWithMySql($host, $user, $pass, $port, $dbname) {
	self::$cnxHandler = new MySql($host, $user, $pass, $port, $dbname);
	return self::$cnxHandler->connect();
    }
    
    
    /**	Initialise automatiquement une connexion sur un site géré avec WordPress
     */
    public static function connectWithWordPress(){
	include JinCore::getContainerPath().'wp-config.php';
	
	self::$cnxHandler = new MySql(DB_HOST, DB_USER, DB_PASSWORD, 5432, DB_NAME);
	return self::$cnxHandler->connect();
    }

    
    /**	Initialise une transaction
     * 
     */
    public static function beginTransaction() {
	self::$cnxHandler->beginTransaction();
    }

    
    /**	Effectue le commit de la transaction
     * 
     */
    public static function commitTransaction() {
	self::$cnxHandler->commitTransaction();
    }

    
    /**	Annule la transaction
     * 
     */
    public static function rollBackTransaction() {
	self::$cnxHandler->rollBackTransaction();
    }
    
    /**
     * Retourne le dernier ID inséré. (Avec MySql les arguments tableName et cle ne sont pas nécessaires)
     * @param string $tableName		Nom de la table
     * @param string $cle		Nom de la clé primaire
     */
    public function getLastInsertId($tableName = null, $cle = null){
	return self::$cnxHandler->getLastInsertId($tableName, $cle);
    }

}
