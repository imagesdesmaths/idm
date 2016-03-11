<?php
/*
 * Plugin Facteur 2
 * (c) 2009-2011 Collectif SPIP
 * Distribue sous licence GPL
 *
 */

if (!defined("_ECRIRE_INC_VERSION")) return;

include_spip('inc/charsets');
include_spip('inc/texte');
include_spip('inc/filtres');

if (!class_exists('PHPMailer')) {
	include_spip('phpmailer-php5/class.phpmailer');
	include_spip('phpmailer-php5/class.smtp');
}

include_spip('facteur_fonctions');

/**
 * Wrapper de spip_log pour par PHPMailer
 * @param $message
 * @param $level
 */
function facteur_log_debug($message,$level){
	spip_log("$level: ".trim($message),"facteur"._LOG_DEBUG);
}


class Facteur extends PHPMailer {

	/**
	 * @param $email
	 * @param $objet
	 * @param $message_html
	 * @param $message_texte
	 * @param array $options
	 *
	 */
	public function __construct($email, $objet, $message_html, $message_texte, $options = array()) {
		// On récupère toutes les options par défaut depuis le formulaire de config
		$defaut = array();
		foreach (array(
			'adresse_envoi', 'adresse_envoi_email', 'adresse_envoi_nom',
			'cc', 'bcc',
			'smtp', 'smtp_host', 'smtp_port', 'smtp_auth',
			'smtp_username', 'smtp_password', 'smtp_secure', 'smtp_sender',
			'filtre_images', 'filtre_iso_8859',
		) as $config) {
			$defaut[$config] = isset($GLOBALS['meta']["facteur_$config"]) ? $GLOBALS['meta']["facteur_$config"] : '';
		}
		// On fusionne les options avec d'éventuelles surcharges lors de l'appel
		$options = array_merge($defaut, $options);

		// par defaut on log rien car tres verbeux
		// on utilise facteur_log_debug qui filtre log SPIP en _LOG_DEBUG
		$this->SMTPDebug = 0;
		$this->Debugoutput = "facteur_log_debug";
		// Il est possible d'avoir beaucoup plus de logs avec 2, 3 ou 4, ce qui logs les échanges complets avec le serveur
		// utiliser avec un define('_MAX_LOG',1000); car sinon on est limite a 100 lignes par hit et phpMailer est tres verbeux
		if (defined('_FACTEUR_DEBUG_SMTP')) {
			$this->SMTPDebug = _FACTEUR_DEBUG_SMTP ;
		}
		$this->exceptions = false;


		if (
			$options['adresse_envoi'] == 'oui'
			and $options['adresse_envoi_email']
		) {
			$this->From = $options['adresse_envoi_email'];
		}
		else {
			$this->From = (isset($GLOBALS['meta']["email_envoi"]) AND $GLOBALS['meta']["email_envoi"]) ?
				$GLOBALS['meta']["email_envoi"]
				: $GLOBALS['meta']['email_webmaster'];
		}

		// Si plusieurs emails dans le from, pas de Name !
		if (strpos($this->From,",") === false) {
			if (
				$options['adresse_envoi'] == 'oui'
				and $options['adresse_envoi_nom']
			) {
				$this->FromName = $options['adresse_envoi_nom'];
			}
			// Par défaut, l'envoyeur est le nom du site
			else {
				$this->FromName = strip_tags(extraire_multi($GLOBALS['meta']['nom_site']));
			}
		}

		$this->CharSet = "utf-8";
		$this->Mailer = 'mail';
		$this->Subject = unicode_to_utf_8(charset2unicode($objet,$GLOBALS['meta']['charset']));

		//Pour un envoi multiple de mail, $email doit être un tableau avec les adresses.
		if (is_array($email)) {
			foreach ($email as $cle => $adresseMail) {
				if (!$this->AddAddress($adresseMail)) {
					spip_log("Erreur AddAddress $adresseMail : ".print_r($this->ErrorInfo, true), 'facteur.'._LOG_ERREUR);
				}
			}
		}
		elseif (!$this->AddAddress($email)) {
			spip_log("Erreur AddAddress $email : ".print_r($this->ErrorInfo, true), 'facteur.'._LOG_ERREUR);
		}
		
		// Retour des erreurs
		if (!empty($options['smtp_sender'])) {
			$this->Sender = $options['smtp_sender'];
			$this->AddCustomHeader("Errors-To: ".$this->Sender);
		}
		
		// Destinataires en copie, seulement s'il n'y a pas de destinataire de test
		if (!defined('_TEST_EMAIL_DEST')){
			if (!empty($options['cc'])) {
				$this->AddCC($options['cc']);
			}
			if (!empty($options['bcc'])) {
				$this->AddBCC($options['bcc']);
			}
		}
		
		// Si on envoie avec un SMTP explicite
		if (isset($options['smtp']) AND $options['smtp'] == 'oui') {
			$this->Mailer	= 'smtp';
			$this->Host 	= $options['smtp_host'];
			$this->Port 	= $options['smtp_port'];
			
			// SMTP authentifié
			if ($options['smtp_auth'] == 'oui') {
				$this->SMTPAuth = true;
				$this->Username = $options['smtp_username'];
				$this->Password = $options['smtp_password'];
			}
			else {
				$this->SMTPAuth = false;
			}
			
			if ($options['smtp_secure'] == 'ssl') {
				$this->SMTPSecure = 'ssl';
			}
			if ($options['smtp_secure'] == 'tls') {
				$this->SMTPSecure = 'tls';
			}

			// Pour le moment on remet l'ancien fonctionnement :
			// on ne doit pas tester les certificats si pas demandé explicitement avec l'option TLS !
			$this->SMTPAutoTLS = false;
		}
		
		// S'il y a un contenu HTML
		if (!empty($message_html)) {
			$message_html = unicode_to_utf_8(charset2unicode($message_html, $GLOBALS['meta']['charset']));
			
			$this->Body = $message_html;
			$this->IsHTML(true);
			if ($options['filtre_images']) {
				$this->JoindreImagesHTML();
			}
			
			$this->UrlsAbsolues();
		}
		
		// S'il y a un contenu texte brut
		if (!empty($message_texte)) {
			$message_texte = unicode_to_utf_8(charset2unicode($message_texte, $GLOBALS['meta']['charset']));
			
			// Si pas de HTML on le remplace en tant que contenu principal
			if (!$this->Body) {
				$this->IsHTML(false);
				$this->Body = $message_texte;
			}
			// Sinon on met le texte brut en contenu alternatif
			else {
				$this->AltBody = $message_texte;
			}
		}

		if ($options['filtre_iso_8859']) {
			$this->ConvertirUtf8VersIso8859();
		}
	}

	/**
	 * @param bool $exceptions
	 */
	public function SetExceptions($exceptions){
		$this->exceptions = ($exceptions?true:false);
	}

	/**
	 * Transforme du HTML en texte brut, mais proprement
	 * utilise le filtre facteur_mail_html2text
	 * @uses facteur_mail_html2text()
	 *
	 * @param string $html Le HTML à transformer
	 * @param bool $advanced Inutilisé
	 * @return string Retourne un texte brut formaté correctement
	 */
	public function html2text($html, $advanced = false){
		return facteur_mail_html2text($html);
	}

	/**
	 * Compat ascendante, obsolete
	 * @deprecated
	 */
	public function ConvertirStylesEnligne() {
		$this->Body = facteur_convertir_styles_inline($this->Body);
	}

	/**
	 * Transformer les urls des liens et des images en url absolues
	 * sans toucher aux images embarquees de la forme "cid:..."
	 */
	protected function UrlsAbsolues($base=null){
		include_spip('inc/filtres_mini');
		if (preg_match_all(',(<(a|link)[[:space:]]+[^<>]*href=["\']?)([^"\' ><[:space:]]+)([^<>]*>),imsS',
		  $this->Body, $liens, PREG_SET_ORDER)) {
			foreach ($liens as $lien) {
				if (strncmp($lien[3],"cid:",4)!==0){
					$abs = url_absolue($lien[3], $base);
					if ($abs <> $lien[3] and !preg_match('/^#/',$lien[3]))
						$this->Body = str_replace($lien[0], $lien[1].$abs.$lien[4], $this->Body);
				}
			}
		}
		if (preg_match_all(',(<(img|script)[[:space:]]+[^<>]*src=["\']?)([^"\' ><[:space:]]+)([^<>]*>),imsS',
		  $this->Body, $liens, PREG_SET_ORDER)) {
			foreach ($liens as $lien) {
				if (strncmp($lien[3],"cid:",4)!==0){
					$abs = url_absolue($lien[3], $base);
					if ($abs <> $lien[3])
						$this->Body = str_replace($lien[0], $lien[1].$abs.$lien[4], $this->Body);
				}
			}
		}
	}

	/**
	 * Embed les images HTML dans l'email
	 */
	protected function JoindreImagesHTML() {
		$image_types = array(
							'gif'	=> 'image/gif',
							'jpg'	=> 'image/jpeg',
							'jpeg'	=> 'image/jpeg',
							'jpe'	=> 'image/jpeg',
							'bmp'	=> 'image/bmp',
							'png'	=> 'image/png',
							'tif'	=> 'image/tiff',
							'tiff'	=> 'image/tiff',
							'swf'	=> 'application/x-shockwave-flash'
						);
		$src_found = array();
		$images_embeded = array();
		if (preg_match_all(
			'/["\'](([^"\']+)\.('.implode('|', array_keys($image_types)).'))([?][^"\']+)?([#][^"\']+)?["\']/Uims',
			$this->Body, $images, PREG_SET_ORDER)) {

			$adresse_site = $GLOBALS['meta']['adresse_site'].'/';
			foreach($images as $im){
				$im = array_pad($im, 6, null);
				$src_orig = $im[1].$im[4].$im[5];
				if (!isset($src_found[$src_orig])){ // deja remplace ? rien a faire (ie la meme image presente plusieurs fois)
					// examiner le src et voir si embedable
					$src = $im[1];
					if ($src AND strncmp($src,$adresse_site,strlen($adresse_site))==0)
						$src = _DIR_RACINE . substr($src,strlen($adresse_site));
					if ($src
					  AND !preg_match(",^[a-z0-9]+://,i",$src)
					  AND (
					      file_exists($f=$src) // l'image a ete generee depuis le meme cote que l'envoi
					      OR (_DIR_RACINE AND file_exists($f=_DIR_RACINE.$src)) // l'image a ete generee dans le public et on est dans le prive
					      OR (!_DIR_RACINE AND file_exists($f=_DIR_RESTREINT.$src)) // l'image a ete generee dans le prive et on est dans le public
					     )
					  ){
						if (!isset($images_embeded[$f])){
							$extension = strtolower($im[3]);
							$header_extension = $image_types[$extension];
							$cid = md5($f); // un id unique pour un meme fichier
							$images_embeded[$f] = $cid; // marquer l'image comme traitee, inutile d'y revenir
							$this->AddEmbeddedImage($f, $cid, basename($f),'base64',$header_extension);
						}

						$this->Body = str_replace($src_orig, "cid:".$images_embeded[$f], $this->Body);
						$src_found[$src_orig] = $f;
					}
				}
			}
		}
	}


	/**
	 * Conversion safe d'un texte utf en isotruc
	 * @param string $text
	 * @param string $mode
	 * @return string
	 */
	protected function safe_utf8_decode($text,$mode='texte_brut') {
		if (!is_utf8($text))
			return ($text);

		if (function_exists('iconv') && $mode == 'texte_brut') {
			$text = str_replace('’',"'",$text);
			$text = iconv("UTF-8", "ISO-8859-1//TRANSLIT", $text);
			return str_replace('&#8217;',"'",$text);
		}
		else {
			if ($mode == 'texte_brut') {
				$text = str_replace('’',"'",$text);
			}
			$text = unicode2charset(utf_8_to_unicode($text),'iso-8859-1');
			return str_replace('&#8217;',"'",$text);
		}
	}

	/**
	 * Convertir tout le mail utf en isotruc
	 */
	protected function ConvertirUtf8VersIso8859() {
		$this->CharSet	= 'iso-8859-1';
		$this->Body		= str_ireplace('charset=utf-8', 'charset=iso-8859-1', $this->Body);
		$this->Body		= $this->safe_utf8_decode($this->Body,'html');
		$this->AltBody	= $this->safe_utf8_decode($this->AltBody);
		$this->Subject	= $this->safe_utf8_decode($this->Subject);
		$this->FromName	= $this->safe_utf8_decode($this->FromName);
	}

	/**
	 * Convertir les accents du body en entites html
	 */
	protected function ConvertirAccents() {
		// tableau à compléter au fur et à mesure
		$cor = array(
						'à' => '&agrave;',
						'â' => '&acirc;',
						'ä' => '&auml;',
						'ç' => '&ccedil;',
						'é' => '&eacute;',
						'è' => '&egrave;',
						'ê' => '&ecirc;',
						'ë' => '&euml;',
						'î' => '&icirc;',
						'ï' => '&iuml;',
						'ò' => '&ograve;',
						'ô' => '&ocirc;',
						'ö' => '&ouml;',
						'ù' => '&ugrave;',
						'û' => '&ucirc;',
						'œ' => '&oelig;',
						'€' => '&euro;'
					);

		$this->Body = strtr($this->Body, $cor);
	}


	/**
	 * Une fonction wrapper pour appeler une methode de phpMailer
	 * en recuperant l'erreur eventuelle, en la loguant via SPIP et en lancant une exception si demandee
	 * @param string $function
	 * @param array $args
	 * @return bool
	 * @throws phpmailerException
	 */
	protected function callWrapper($function,$args){
		$exceptions = $this->exceptions;
		$this->exceptions = true;
		try {
			$retour = call_user_func_array($function,$args);
			$this->exceptions = $exceptions;
		}
		catch (phpmailerException $exc) {
			spip_log($function."() : ".$exc->getMessage(),'facteur.'._LOG_ERREUR);
			$this->exceptions = $exceptions;
			if ($this->exceptions) {
				throw $exc;
			}
			return false;
		}

		return $retour;
	}

	/*
	 * Appel des fonctions parents via le callWrapper qui se charge de loger les erreurs
	 */

	public function Send() {
		$args = func_get_args();
		return $this->callWrapper("parent::Send",$args);
	}
	public function addAttachment($path, $name = '', $encoding = 'base64', $type = '', $disposition = 'attachment') {
		$args = func_get_args();
		return $this->callWrapper("parent::AddAttachment",$args);
	}
	public function AddReplyTo($address, $name = '') {
		$args = func_get_args();
		return $this->callWrapper("parent::AddReplyTo",$args);
	}
	public function AddBCC($address, $name = '') {
		$args = func_get_args();
		return $this->callWrapper("parent::AddBCC",$args);
	}
	public function AddCC($address, $name = '') {
		$args = func_get_args();
		return $this->callWrapper("parent::AddCC",$args);
	}
}
