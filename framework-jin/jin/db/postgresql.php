<?php

/**
 * Jin Framework
 * Diatem
 */

namespace jin\db;

use \PDO;
use \Exception;

/** Connexion aux bases de données PostgreSQL (Ne pas utiliser cette classe directement. Utiliser la classe jin\db\DbConnexion.
 *
 * 	@auteur		Loïc Gerard
 * 	@version	alpha
 * 	@check
 */
class PostgreSql {
    /**
     * @var string  Url du serveur PostgreSQL
     */
    protected $host = NULL;
    
    
    /**
     * @var string  Nom de l'utilisateur de la base de données
     */
    protected $user = NULL;
    
    
    /**
     * @var string  Password de l'utilisateur
     */
    protected $pass = NULL;
    
    
    /**
     * @var integer Port utilisé
     */
    protected $port = NULL;
   
    
    /**
     * @var string  Nom de la base de données
     */
    protected $dbname = NULL;
    
    
    /**
     * @var string  Chaine de connexion
     */
    private $dns = NULL;
    
    
    /**
     * @var /PDO    Objet PDO gérant la connexion
     */
    public $cnx = NULL;

    
    /**	Constructeur
     * 
     * @param string $host  Url du serveur
     * @param string $user  Nom de l'utilisateur de la base de données
     * @param string $pass  Password de l'utilisateur
     * @param integer $port Port
     * @param string $dbname	Nom de la base de données
     */
    public function __construct($host, $user, $pass, $port, $dbname) {
	$this->host = $host;
	$this->user = $user;
	$this->pass = $pass;
	$this->port = $port;
	$this->dbname = $dbname;

	$this->dns = 'pgsql:host=' . $this->host . ';port=' . $this->port . ';dbname=' . $this->dbname . ';user=' . $this->user . ';password=' . $this->pass;
    }

    
    /**	Ouvre une connexion
     * 
     * @return boolean
     */
    public function connect() {
	try {
	    $this->cnx = new PDO($this->dns, $this->user, $this->pass);
	    $this->cnx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	    return true;
	} catch (Exception $e) {
	    return false;
	}
    }

    
    /**	Débute une transaction
     * 
     */
    public function beginTransaction() {
	$this->cnx->beginTransaction();
    }

    
    /**	Effectue le commit de la transaction
     * 
     */
    public function commitTransaction() {
	$this->cnx->commit();
    }

    
    /**	Annule la transaction
     * 
     */
    public function rollBackTransaction() {
	$this->cnx->rollback();
    }
    
    
    /**
     * Retourne le dernier ID inséré. 
     * @param string $tableName		Nom de la table
     * @param string $cle		Nom de la clé primaire
     */
    public function getLastInsertId($tableName, $cle){
	$last_insert_id = $this->cnx->lastInsertId($tableName.'_'.$cle.'_seq');
	return $last_insert_id;
    }

}
