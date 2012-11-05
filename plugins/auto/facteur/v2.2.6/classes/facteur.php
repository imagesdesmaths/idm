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

class Facteur extends PHPMailer {

	function Facteur($email, $objet, $message_html, $message_texte) {

		if (defined('_FACTEUR_DEBUG_SMTP')) {
			$this->SMTPDebug = _FACTEUR_DEBUG_SMTP ;
		}
		if ($GLOBALS['meta']['facteur_adresse_envoi'] == 'oui'
		  AND $GLOBALS['meta']['facteur_adresse_envoi_email'])
			$this->From = $GLOBALS['meta']['facteur_adresse_envoi_email'];
		else
			$this->From = (isset($GLOBALS['meta']["email_envoi"]) AND $GLOBALS['meta']["email_envoi"])?
				$GLOBALS['meta']["email_envoi"]
				:$GLOBALS['meta']['email_webmaster'];

		// Si plusieurs emails dans le from, pas de Name !
		if (strpos($this->From,",")===false){
			if ($GLOBALS['meta']['facteur_adresse_envoi'] == 'oui'
			  AND $GLOBALS['meta']['facteur_adresse_envoi_nom'])
				$this->FromName = $GLOBALS['meta']['facteur_adresse_envoi_nom'];
			else
				$this->FromName = strip_tags(extraire_multi($GLOBALS['meta']['nom_site']));
		}

		$this->CharSet = "utf-8";
		$this->Mailer = 'mail';
		$this->Subject = unicode_to_utf_8(charset2unicode($objet,$GLOBALS['meta']['charset']));

		//Pour un envoi multiple de mail, $email doit être un tableau avec les adresses.
		if (is_array($email)) {
			foreach ($email as $cle => $adresseMail) {
				if (!$this->AddAddress($adresseMail))
					spip_log("Erreur AddAddress $adresseMail : ".print_r($this->ErrorInfo,true),'facteur');
			}
		}
		else
			if (!$this->AddAddress($email))
				spip_log("Erreur AddAddress $email : ".print_r($this->ErrorInfo,true),'facteur');

		if (!empty($GLOBALS['meta']['facteur_smtp_sender'])) {
			$this->Sender = $GLOBALS['meta']['facteur_smtp_sender'];
			$this->AddCustomHeader("Errors-To: ".$this->Sender);
		}

		if (!empty($GLOBALS['meta']['facteur_cc'])) {
			$this->AddCC( $GLOBALS['meta']['facteur_cc'] );
		}
		if (!empty($GLOBALS['meta']['facteur_bcc'])) {
			$this->AddBCC( $GLOBALS['meta']['facteur_bcc'] );
		}
		
		if (isset($GLOBALS['meta']['facteur_smtp']) AND $GLOBALS['meta']['facteur_smtp'] == 'oui') {
			$this->Mailer	= 'smtp';
			$this->Host 	= $GLOBALS['meta']['facteur_smtp_host'];
			$this->Port 	= $GLOBALS['meta']['facteur_smtp_port'];
			if ($GLOBALS['meta']['facteur_smtp_auth'] == 'oui') {
				$this->SMTPAuth = true;
				$this->Username = $GLOBALS['meta']['facteur_smtp_username'];
				$this->Password = $GLOBALS['meta']['facteur_smtp_password'];
			}
			else {
				$this->SMTPAuth = false;
			}
			if (intval(phpversion()) == 5) {
			if ($GLOBALS['meta']['facteur_smtp_secure'] == 'ssl')
				$this->SMTPSecure = 'ssl';
			if ($GLOBALS['meta']['facteur_smtp_secure'] == 'tls')
				$this->SMTPSecure = 'tls';
			}
		}

		if (!empty($message_html)) {
			$message_html = unicode_to_utf_8(charset2unicode($message_html,$GLOBALS['meta']['charset']));
			$this->Body = $message_html;
			$this->IsHTML(true);
			if ($GLOBALS['meta']['facteur_filtre_images'])
				$this->JoindreImagesHTML();
			$this->UrlsAbsolues();
		}
		if (!empty($message_texte)) {
			$message_texte = unicode_to_utf_8(charset2unicode($message_texte,$GLOBALS['meta']['charset']));
			if (!$this->Body) {
				$this->IsHTML(false);
				$this->Body = $message_texte;
			}
			else {
				$this->AltBody = $message_texte;
			}
		}

		if ($GLOBALS['meta']['facteur_filtre_iso_8859'])
			$this->ConvertirUtf8VersIso8859();

	}
	
	/*
	 * Transforme du HTML en texte brut, mais proprement, c'est-à-dire en essayant
	 * de garder les titrages, les listes, etc
	 *
	 * @param string $html Le HTML à transformer
	 * @return string Retourne un texte brut formaté correctement
	 */
	function html2text($html){
		// On remplace tous les sauts de lignes par un espace
		$html = str_replace("\n", ' ', $html);
		
		// Supprimer tous les liens internes
		$texte = preg_replace("/\<a href=['\"]#(.*?)['\"][^>]*>(.*?)<\/a>/ims", "\\2", $html);
	
		// Supprime feuille style
		$texte = preg_replace(";<style[^>]*>[^<]*</style>;i", "", $texte);
	
		// Remplace tous les liens	
		$texte = preg_replace("/\<a[^>]*href=['\"](.*?)['\"][^>]*>(.*?)<\/a>/ims", "\\2 (\\1)", $texte);
	
		// Les titres
		$texte = preg_replace(";<h1[^>]*>;i", "\n= ", $texte);
		$texte = str_replace("</h1>", " =\n\n", $texte);
		$texte = preg_replace(";<h2[^>]*>;i", "\n== ", $texte);
		$texte = str_replace("</h2>", " ==\n\n", $texte);
		$texte = preg_replace(";<h3[^>]*>;i", "\n=== ", $texte);
		$texte = str_replace("</h3>", " ===\n\n", $texte);
		
		// Une fin de liste
		$texte = preg_replace(";</(u|o)l>;i", "\n\n", $texte);
		
		// Une saut de ligne *après* le paragraphe
		$texte = preg_replace(";<p[^>]*>;i", "\n", $texte);
		$texte = preg_replace(";</p>;i", "\n\n", $texte);
		// Les sauts de ligne interne
		$texte = preg_replace(";<br[^>]*>;i", "\n", $texte);
	
		//$texte = str_replace('<br /><img class=\'spip_puce\' src=\'puce.gif\' alt=\'-\' border=\'0\'>', "\n".'-', $texte);
		$texte = preg_replace (';<li[^>]*>;i', "\n".'- ', $texte);
	
	
		// accentuation du gras
		// <b>texte</b> -> **texte**
		$texte = preg_replace (';<b[^>]*>;i','**' ,$texte);
		$texte = str_replace ('</b>','**' ,$texte);
	
		// accentuation du gras
		// <strong>texte</strong> -> **texte**
		$texte = preg_replace (';<strong[^>]*>;i','**' ,$texte);
		$texte = str_replace ('</strong>','**' ,$texte);
	
	
		// accentuation de l'italique
		// <em>texte</em> -> *texte*
		$texte = preg_replace (';<em[^>]*>;i','/' ,$texte);
		$texte = str_replace ('</em>','*' ,$texte);
		
		// accentuation de l'italique
		// <i>texte</i> -> *texte*
		$texte = preg_replace (';<i[^>]*>;i','/' ,$texte);
		$texte = str_replace ('</i>','*' ,$texte);
	
		$texte = str_replace('&oelig;', 'oe', $texte);
		$texte = str_replace("&nbsp;", " ", $texte);
		$texte = filtrer_entites($texte);
	
		// On supprime toutes les balises restantes
		$texte = supprimer_tags($texte);
	
		$texte = str_replace("\x0B", "", $texte); 
		$texte = str_replace("\t", "", $texte) ;
		$texte = preg_replace(";[ ]{3,};", "", $texte);
	
		// espace en debut de ligne
		$texte = preg_replace("/(\r\n|\n|\r)[ ]+/", "\n", $texte);
	
		//marche po
		// Bring down number of empty lines to 4 max
		$texte = preg_replace("/(\r\n|\n|\r){3,}/m", "\n\n", $texte);
	
		//saut de lignes en debut de texte
		$texte = preg_replace("/^(\r\n|\n|\r)*/", "\n\n", $texte);
		//saut de lignes en debut ou fin de texte
		$texte = preg_replace("/(\r\n|\n|\r)*$/", "\n\n", $texte);
	
		// Faire des lignes de 75 caracteres maximum
		//$texte = wordwrap($texte);
	
		return $texte;
	}
	
	/**
	 * Transformer les urls des liens et des images en url absolues
	 * sans toucher aux images embarquees de la forme "cid:..."
	 */
	function UrlsAbsolues(){
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

	function JoindreImagesHTML() {
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
		while (list($key,) = each($image_types))
			$extensions[] = $key;

		preg_match_all('/["\'](([^"\']+)\.('.implode('|', $extensions).'))([?][^"\']+)?["\']/Ui', $this->Body, $images, PREG_SET_ORDER);

		$html_images = array();
		foreach($images as $im){
			if (!preg_match(",^[a-z0-9]+://,i",$im[1])
			 AND ($src = $im[1].$im[4])
			 AND (
			      file_exists($f=$im[1]) // l'image a ete generee depuis le meme cote que l'envoi
			      OR (_DIR_RACINE AND file_exists($f=_DIR_RACINE.$im[1])) // l'image a ete generee dans le public et on est dans le prive
			      OR (!_DIR_RACINE AND strncmp($im[1],"../",3)==0 AND file_exists($f=substr($im[1],3))) // l'image a ete generee dans le prive et on est dans le public
			     )
			 AND !isset($html_images[$src])){

				$extension = strtolower($im[3]);
				$header_extension = $image_types[$extension];
				$cid = md5($f); // un id unique pour un meme fichier
				// l'ajouter si pas deja present (avec un autre ?...)
				if (!in_array($cid,$html_images))
					$this->AddEmbeddedImage($f, $cid, basename($f),'base64',$header_extension);
				$this->Body = str_replace($src, "cid:$cid", $this->Body);
				$html_images[$src] = $cid; // marquer l'image comme traitee, inutile d'y revenir
			}
		}
	}


	/**
	 * Compat ascendante, obsolete
	 */
	function ConvertirStylesEnligne() {
		$this->Body = facteur_convertir_styles_inline($this->Body);
	}


	function safe_utf8_decode($text,$mode='texte_brut') {
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

	function ConvertirUtf8VersIso8859() {
		$this->CharSet	= 'iso-8859-1';
		$this->Body		= str_ireplace('charset=utf-8', 'charset=iso-8859-1', $this->Body);
		$this->Body		= $this->safe_utf8_decode($this->Body,'html');
		$this->AltBody	= $this->safe_utf8_decode($this->AltBody);
		$this->Subject	= $this->safe_utf8_decode($this->Subject);
		$this->FromName	= $this->safe_utf8_decode($this->FromName);
	}

	function ConvertirAccents() {
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
	public function Send() {
		ob_start();
		$retour = parent::Send();
		$error = ob_get_contents();
		ob_end_clean();
		if( !empty($error) ) {
			spip_log("Erreur Facteur->Send : $error",'facteur.err');
		}
		return $retour;
	}
	public function AddAttachment($path, $name = '', $encoding = 'base64', $type = 'application/octet-stream') {
		ob_start();
		$retour = parent::AddAttachment($path, $name, $encoding, $type);
		$error = ob_get_contents();
		ob_end_clean();
		if( !empty($error) ) {
			spip_log("Erreur Facteur->AddAttachment : $error",'facteur.err');
		}
		return $retour;
	}
	public function AddReplyTo($address, $name = '') {
		ob_start();
		$retour = parent::AddReplyTo($address, $name);
		$error = ob_get_contents();
		ob_end_clean();
		if( !empty($error) ) {
			spip_log("Erreur Facteur->AddReplyTo : $error",'facteur.err');
		}
		return $retour;
	}
	public function AddBCC($address, $name = '') {
		ob_start();
		$retour = parent::AddBCC($address, $name);
		$error = ob_get_contents();
		ob_end_clean();
		if( !empty($error) ) {
			spip_log("Erreur Facteur->AddBCC : $error",'facteur.err');
		}
		return $retour;
	}
	public function AddCC($address, $name = '') {
		ob_start();
		$retour = parent::AddCC($address, $name);
		$error = ob_get_contents();
		ob_end_clean();
		if( !empty($error) ) {
			spip_log("Erreur Facteur->AddCC : $error",'facteur.err');
		}
		return $retour;
	}
}

?>
