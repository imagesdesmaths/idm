<?php
/**
 * Jin Framework
 * Diatem
 */
namespace jin\mail;

/** Gestion d'une webmail
 *
 * 	@auteur		Loïc Gerard
 * 	@version	alpha
 * 	@check
 */
class MailConnector {

    /** Boîte de réception
     *
     * 	@var object
     *
     */
    private $boite;

    
    /** Serveur mail, port, protocole, dossier (exemple : '{imap.gmail.com:993/imap/ssl}INBOX')
     *
     * 	@var string
     *
     */
    private $host;

    
    /** Nom d'utilisateur
     *
     * 	@var string
     *
     */
    private $user;

    
    /** Mot de passe du compte
     *
     * 	@var string
     *
     */
    private $pass;

    
    /** Constructeur
     * 	@param		string	 	$host		Serveur mail, port, protocole, dossier
     * 	@param 		string		$user		Nom d'utilisateur
     * 	@param 		string		$pass		Mot de passe du compte
     * 	@throws		Exception
     * 	@return		void
     */
    public function __construct($host, $user, $pass) {
	//Vérifie que l'extension imap soit bien installée sur le serveur
	if (!extension_loaded('imap')) {
	    throw new \Exception('Extension Imap nécessaire');
	}
	$this->host = $host;
	$this->user = $user;
	$this->pass = $pass;
    }

    
    /** Connexion à la boîte mail
     * 	@return		void
     */
    public function connect() {
	$this->boite = \imap_open($this->host, $this->user, $this->pass);
    }

    
    /** Récupère tous les emails
     * 	@return		array				Tableau d'emails(pk,vu,sujet,expediteur,date,message,listPJ)
     */
    public function getEmails() {
	//Récupère la liste des identifiants des emails présents
	$listEmailTmp = \imap_search($this->boite, 'ALL');
	//Inversion de l'ordre pour mettre le plus récent en premier
	rsort($listEmailTmp);
	$listEmail = array();
	foreach ($listEmailTmp as $idEmail) {
	    //On fait appel à getEmail pour éviter de faire deux fois le même traitement
	    $listEmail[] = $this->getEmail($idEmail);
	}
	return $listEmail;
    }

    
    /** Récupère un email spécifique
     * 	@param 		string		$idEmail	Identifiant de l'email à récupérer
     * 	@return		array				email(pk,vu,sujet,expediteur,date,message,listPJ)
     */
    public function getEmail($idEmail) {
	$entete = \imap_fetch_overview($this->boite, $idEmail, 0);
	//Selon la présence ou non de pièce-jointe la partie message en html 
	//ne se trouve pas au même endroit dans la structure du mail
	$structure = \imap_fetchstructure($this->boite, $idEmail);
	$listPJ = array();
	//Si le mail est de type Mixed (présence de pièce-jointes)
	if (strtoupper($structure->subtype) == 'MIXED') {
	    $message = \imap_fetchbody($this->boite, $idEmail, 1.2);
	    $positionPJ = 2;
	    foreach ($structure->parts as $parts) {
		if ($parts->ifdisposition > 0 && strtoupper($parts->disposition) == 'ATTACHMENT') {
		    $listPJ[] = array(
			'nom' => $parts->dparameters[0]->value,
			'data' => imap_fetchbody($this->boite, $idEmail, $positionPJ)
		    );
		    $positionPJ ++;
		}
	    }
	}
	//Si le mail est de type Alternative 
	if (strtoupper($structure->subtype) == 'ALTERNATIVE') {
	    $message = \imap_fetchbody($this->boite, $idEmail, 2);
	}
	//On sauvegarde les parties utiles dans un tableau
	$email = array(
	    'pk' => $idEmail,
	    'vu' => $entete[0]->seen,
	    'sujet' => \imap_utf8($entete[0]->subject),
	    'expediteur' => \imap_utf8($entete[0]->from),
	    'date' => date('d/m/yy G:i', strtotime(\imap_utf8($entete[0]->date))),
	    'message' => mb_convert_encoding(quoted_printable_decode($message), 'UTF-8'),
	    'listPJ' => $listPJ
	);
	return $email;
    }

    
    /** Fermeture de la connexion à la boîte mail
     * 	@return		void
     */
    public function close() {
	\imap_close($this->boite);
    }

}
