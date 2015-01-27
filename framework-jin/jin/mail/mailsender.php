<?php
/**
 * Jin Framework
 * Diatem
 */
namespace jin\mail;

/** Classe d'envoi d'emails
 *
 *  @auteur     Loïc Gerard
 *  @version    alpha
 *  @check
 */
class MailSender {

    /** Emails de destination
     *
     *  @var array
     */
    private $destinataire = array();


    /** Emails de destination en copie conforme
     *
     *  @var array
     */
    private $destinataireCC = array();


    /** Emails de destination en copie conforme invisible
     *
     *  @var array
     */
    private $destinataireCCI = array();


    /** Pièces jointes
     *
     *  @var array
     */
    private $attachements = array();


    /** Headers
     *
     *  @var array
     */
    private $xheaders = array();


    /** Referentiel de priorités
     *
     *  @var array
     */
    private $priorities = array('1 (Highest)', '2 (High)', '3 (Normal)', '4 (Low)', '5 (Lowest)');


    /** Charset utilisé
     *
     *  @var string
     */
    private $charset = "utf-8";


    /** Bits encoding
     *
     *  @var string
     */
    private $ctencoding = "8bit";

    var $receipt = 0;

    /** Contenu du mail
     *
     *  @var string
     */
    private $mailContent = null;


    /** Type de contenu
     *
     *  @var string
     */
    private $mailContentType = 'text';


    /** Clé unique
     *
     *  @var string
     */
    private $boundary = null;


    /** Constructeur
     *  @return     void
     */
    public function __construct() {
    $this->boundary = "--" . md5(uniqid("myboundary"));
    }


    /** Définit le sujet du mail
     *
     *  @param      string      $sujet          Sujet du mail
     *  @return     void
     */
    public function setSujet($sujet) {
    $this->xheaders['Subject'] = strtr($sujet, "\r\n", "  ");
    }


    /** Définit l'adresse email de l'expéditeur
     *
     *  @param      string      $email          Adresse email de l'expéditeur
     *  @return     void
     */
    public function setExpediteur($email) {
    if (!is_string($email)) {
        throw new \Exception('L\'adresse email de l\'expéditeur doit être au format String');
        return;
    }

    $this->xheaders['From'] = $email;
    }


    /** Définit l'adresse email de retour (ReplyTo)
     *
     *  @param      string      $email          Adresse email de retour
     *  @return     void
     */
    public function setReplyTo($email) {
    if (!is_string($email)) {
        throw new \Exception('L\'adresse email de retour doit être au format String');
        return;
    }

    $this->xheaders["Reply-To"] = $email;
    }


    /** Ajoute un destinataire
     *
     *  @param      string      $email          Adresse email de destination
     *  @return     void
     */
    public function addDestinataire($email) {
    if (!is_string($email)) {
        throw new \Exception('L\'adresse email de destinatation doit être au format String');
        return;
    }

    $this->destinataire[] = $email;
    }


    /** Définit un tableau de destinataires
     *
     *  @param      array       $emailArray         Adresses email de destination
     *  @return     void
     */
    public function setDestinataires($emailArray) {
    if (!is_array($emailArray)) {
        throw new \Exception('Le tableau d\'adresses email de destinatation doit être au format Array');
        return;
    }

    $this->destinataire = $emailArray;
    }


    /** Ajoute un destinataire Copie Conforme
     *
     *  @param      string      $email          Adresse email de destination
     *  @return     void
     */
    public function addDestinataireCC($email) {
    if (!is_string($email)) {
        throw new \Exception('L\'adresse email de destinatation Copie Conforme doit être au format String');
        return;
    }

    $this->destinataireCC[] = $email;
    }


    /** Définit un tableau de destinataires Copie Conforme
     *
     *  @param      array       $emailArray         Adresses email de destination
     *  @return     void
     */
    public function setDestinatairesCC($emailArray) {
    if (!is_array($emailArray)) {
        throw new \Exception('Le tableau d\'adresses email de destinatation Copie Conforme doit être au format Array');
        return;
    }

    $this->destinataireCC = $emailArray;
    }


    /** Ajoute un destinataire Copie Conforme Invisible
     *
     *  @param      string      $email          Adresse email de destination
     *  @return     void
     */
    public function addDestinataireCCI($email) {
    if (!is_string($email)) {
        throw new \Exception('L\'adresse email de destinatation Copie Conforme Invisible doit être au format String');
        return;
    }

    $this->destinataireCCI[] = $email;
    }


    /** Définit un tableau de destinataires Copie Conforme Invisible
     *
     *  @param      array       $emailArray         Adresses email de destination
     *  @return     void
     */
    public function setDestinatairesCCI($emailArray) {
    if (!is_array($emailArray)) {
        throw new \Exception('Le tableau d\'adresses email de destinatation Copie Conforme Invisible doit être au format Array');
        return;
    }

    $this->destinataireCCI = $emailArray;
    }


    /** Définit le corps du message
     *
     *  @param      string      $content            Contenu du message
     *  @param      boolean     $html               [optionel] Message au format HTML ? (FALSE par défaut)
     *  @return     void
     */
    public function setMessage($content, $html = false) {
    if ($html) {
        $this->mailContentType = 'html';
    }
    $this->mailContent = $content;
    }


    /** Construit le corps du message à partir d'un template prédéfini
     *
     *  @param      string      $template           Chemin d'accès du template à utiliser pour le mail
     *  @param      array       $data               Données à substituer dans le template
     *  @param      boolean     $html               [optionel] Message au format HTML ? (FALSE par défaut)
     *  @param      string      $tags               [optionel] Tags utilisé. Doit contenir un unique espace pour identifier les tags d'ouveture et de fermeture ("{{ }}" par défaut)
     *  @return     void
     */
    public function buildMessageFromTemplate($template, $data, $html = false, $tags = '{{ }}') {
    if(!is_file($template)) {
        throw new \Exception('Le template fourni est introuvable : ' . $template);
        return;
    }
    if(substr_count($tags, ' ') != 1) {
        throw new \Exception('Le tag doit contenir un unique espace pour identifier les tags d\'ouveture et de fermeture : ' . $tags);
        return;
    }
    $content = file_get_contents($template);
    $tags = explode(' ', $tags);
    foreach($data as $key => $value) {
        $content = preg_replace('/'.$tags[0].'\s*'.$key.'\s*'.$tags[1].'/i', $value, $content);
    }
    self::setMessage($content, true);
    }


    /** Définit le niveau de priorité
     *
     *  @param      number       $priorite          Niveau de priorité (de 1 à 5 - 3 = normal, 1 = le plus fort, 5 = le plus faible)
     *  @return     void
     */
    public function setPriorite($priorite) {
    if (!intval($priorite)) {
        throw new \Exception('La priorité fournie doit être un nombre valide');
        return;
    }
    if (!isset($this->priorities[$priorite - 1])) {
        throw new \Exception('La priorité doit être un nombre entre 1 et 5');
        return;
    }

    $this->xheaders["X-Priority"] = $this->priorities[$priorite - 1];
    }


    /** Attacher un fichier au mail
     *
     *  @param      string      $filePath           Chemin du fichier
     *  @param      string      $mimeType           [optionel] MimeType (application/x-unknown-content-type par défaut)
     *  @param      string      $disposition            [optionel] Type d'attachement (inline ou attachment - attachment par défaut. inline : la pièce jointe est intégrée si possible dans le contenu du mail, attachment : la pièce jointe est toujours attachée.)
     *  @return     void
     */
    public function addPieceJointe($filePath, $mimeType = 'application/x-unknown-content-type', $disposition = 'attachment') {
    $this->attachements[] = array('aattach' => $filePath, 'actype' => $mimeType, 'adispo' => $disposition);
    }


    /** Envoie le mail
     *  @return void
     *  @throws \Exception
     */
    public function send() {
    if (is_null($this->destinataire)) {
        throw new \Exception('Vous devez spécifier au minimum une adresse email de destination');
        return;
    }
    if (!array_key_exists('From', $this->xheaders)) {
        throw new \Exception('L\'adresse email de l\'expéditeur n\'a pas été spécifiée');
        return;
    }
    if (is_null($this->mailContent)) {
        throw new \Exception('Vous devez spécifier un contenu au mail');
        return;
    }

    $this->buildMail();

    $strTo = implode(', ', $this->destinataire);

    // envoie du mail
    $res = @mail($strTo, $this->xheaders['Subject'], $this->fullBody, $this->headers);
    }


    /** Construit le contenu du mail
     *  @return void
     */
    private function buildMail() {
    //On construit les headers
    $this->headers = "";

    if (count($this->destinataireCC) > 0) {
        $this->xheaders['CC'] = implode(', ', $this->destinataireCC);
    }

    if (count($this->destinataireCCI) > 0) {
        $this->xheaders['BCC'] = implode(', ', $this->destinataireCCI);
    }


    $this->xheaders["Mime-Version"] = "1.0";
    if ($this->mailContentType == 'html') {
        $this->xheaders["Content-Type"] = "text/html; charset=$this->charset";
    } else {
        $this->xheaders["Content-Type"] = "text/plain; charset=$this->charset";
    }
    $this->xheaders["Content-Transfer-Encoding"] = $this->ctencoding;


    $this->xheaders["X-Mailer"] = "Php/Sylab";

    //Fichiers attachés
    if (count($this->attachements) > 0) {
        $this->buildAttachements();
    } else {
        $this->fullBody = $this->mailContent;
    }

    reset($this->xheaders);
    while (list($hdr, $value ) = each($this->xheaders)) {
        if ($hdr != "Subject") {
        $this->headers .= "$hdr: $value\n";
        }
    }
    }


    /** Construit les fichiers attachés
     *  @return void
     *  @throws \Exception
     */
    private function buildAttachements() {
    $this->xheaders["Content-Type"] = "multipart/mixed;\n boundary=\"$this->boundary\"";

    $this->fullBody = "This is a multi-part message in MIME format.\n--$this->boundary\n";
    if ($this->mailContentType == 'html') {
        $this->fullBody .= "Content-Type: text/html; charset=$this->charset\nContent-Transfer-Encoding: $this->ctencoding\n\n" . $this->mailContent . "\n";
    } else {
        $this->fullBody .= "Content-Type: text/plain; charset=$this->charset\nContent-Transfer-Encoding: $this->ctencoding\n\n" . $this->mailContent . "\n";
    }

    $sep = chr(13) . chr(10);

    $ata = array();
    $k = 0;

    // for each attached file, do...
    for ($i = 0; $i < count($this->attachements); $i++) {
        $filename = $this->attachements[$i]['aattach'];
        $basename = basename($filename);
        $ctype = $this->attachements[$i]['actype']; // content-type
        $disposition = $this->attachements[$i]['adispo'];

        if (!file_exists($filename)) {
        throw new \Exception('Le fichier ' . $filename . ' ne peut être trouvé');
        return;
        }
        $subhdr = "--$this->boundary\nContent-type: $ctype;\n name=\"$basename\"\nContent-Transfer-Encoding: base64\nContent-Disposition: $disposition;\n  filename=\"$basename\"\n";
        $ata[$k++] = $subhdr;
        // non encoded line length
        $linesz = filesize($filename) + 1;
        $fp = fopen($filename, 'r');
        $ata[$k++] = chunk_split(base64_encode(fread($fp, $linesz)));
        fclose($fp);
    }

    $this->fullBody .= implode($sep, $ata);
    }

}
