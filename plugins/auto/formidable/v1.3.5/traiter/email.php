<?php

// Sécurité
if (!defined("_ECRIRE_INC_VERSION")) return;

function traiter_email_dist($args, $retours){
	$formulaire = $args['formulaire'];
	$options = $args['options'];
	$saisies = unserialize($formulaire['saisies']);
	$traitements = unserialize($formulaire['traitements']);
	$champs = saisies_lister_champs($saisies);
	
	// On récupère les destinataires
	if ($options['champ_destinataires']){
		$destinataires = _request($options['champ_destinataires']);
		if (!is_array($destinataires) and intval($destinataires)){
			$destinataires = array($destinataires);
		}
		if (is_array($destinataires)){
			// On récupère les mails des destinataires
			$destinataires = array_map('intval', $destinataires);
			$destinataires = sql_allfetsel(
				'email',
				'spip_auteurs',
				sql_in('id_auteur', $destinataires)
			);
			$destinataires = array_map('reset', $destinataires);
		}
	}
	if (!$destinataires)
		$destinataires = array();
	
	// On ajoute les destinataires en plus
	if ($options['destinataires_plus']){
		$destinataires_plus = explode(',', $options['destinataires_plus']);
		$destinataires_plus = array_map('trim', $destinataires_plus);
		$destinataires = array_merge($destinataires, $destinataires_plus);
		$destinataires = array_unique($destinataires);
	}
	
	// On récupère le courriel de l'envoyeur s'il existe
	if ($options['champ_courriel']){
		$courriel_envoyeur = _request($options['champ_courriel']);
	}
	if (!$courriel_envoyeur) $courriel_envoyeur = '';
	
	// Si on a bien des destinataires, on peut continuer
	if ($destinataires or ($courriel_envoyeur and $options['activer_accuse'])){
		include_spip('inc/filtres');
		include_spip('inc/texte');
		
		$nom_site_spip = supprimer_tags(typo($GLOBALS['meta']['nom_site']));
		
		// On parcourt les champs pour générer le tableau des valeurs
		$valeurs = array();
		foreach ($champs as $champ){
			$valeurs[$champ] = _request($champ);
		}
		
		// On récupère le nom de l'envoyeur
		if ($options['champ_nom']){
			$a_remplacer = array();
			if (preg_match_all('/@[\w]+@/', $options['champ_nom'], $a_remplacer)){
				$a_remplacer = $a_remplacer[0];
				foreach ($a_remplacer as $cle=>$val) $a_remplacer[$cle] = trim($val, '@');
				$a_remplacer = array_flip($a_remplacer);
				$a_remplacer = array_intersect_key($valeurs, $a_remplacer);
				$a_remplacer = array_merge($a_remplacer, array('nom_site_spip' => $nom_site_spip));
			}
			$nom_envoyeur = trim(_L($options['champ_nom'], $a_remplacer));
		}
		if (!$nom_envoyeur) $nom_envoyeur = $GLOBALS['meta']['nom_site'];
		
		// On récupère le sujet s'il existe sinon on le construit
		if ($options['champ_sujet']){
			$a_remplacer = array();
			if (preg_match_all('/@[\w]+@/', $options['champ_sujet'], $a_remplacer)){
				$a_remplacer = $a_remplacer[0];
				foreach ($a_remplacer as $cle=>$val) $a_remplacer[$cle] = trim($val, '@');
				$a_remplacer = array_flip($a_remplacer);
				$a_remplacer = array_intersect_key($valeurs, $a_remplacer);
				$a_remplacer = array_merge($a_remplacer, array('nom_site_spip' => $nom_site_spip));
			}
			$sujet = trim(_L($options['champ_sujet'], $a_remplacer));
		}
		if (!$sujet) $sujet = _T('formidable:traiter_email_sujet', array('nom'=>$nom_envoyeur));
		$sujet = filtrer_entites($sujet);
		
		// Mais quel va donc être le fond ?
		if (find_in_path('notifications/formulaire_'.$formulaire['identifiant'].'_email.html'))
			$notification = 'notifications/formulaire_'.$formulaire['identifiant'].'_email';
		else
			$notification = 'notifications/formulaire_email';
		
		// On génère le mail avec le fond
		$html = recuperer_fond(
			$notification,
			array(
				'id_formulaire' => $formulaire['id_formulaire'],
				'titre' => _T_ou_typo($formulaire['titre']),
				'traitements' => $traitements,
				'saisies' => $saisies,
				'valeurs' => $valeurs
			)
		);
		
		// On génère le texte brut
		include_spip('classes/facteur');
		$texte = Facteur::html2text($html);
		
		// On utilise la forme avancé de Facteur
		$corps = array(
			'html' => $html,
			'texte' => $texte,
			'nom_envoyeur' => $nom_envoyeur
		);
		// Si l'utilisateur n'a pas indiqué autrement, on met le courriel de l'envoyeur dans
		// Reply-To et on laisse le from par defaut de Facteur car sinon ca bloque sur les
		// SMTP un peu restrictifs.
		$courriel_from = "";
		if ($courriel_envoyeur && $options['activer_vrai_envoyeur']){
			$courriel_from = $courriel_envoyeur;
		} else if ($courriel_envoyeur) {
			$corps['repondre_a'] = $courriel_envoyeur;
		}
		
		// On envoie enfin le message
		$envoyer_mail = charger_fonction('envoyer_mail','inc');
		
		// On envoie aux destinataires
		if ($destinataires)
			$ok = $envoyer_mail($destinataires, $sujet, $corps, $courriel_from, "X-Originating-IP: ".$GLOBALS['ip']);
		
		// Si c'est bon, on envoie l'accusé de réception
		if ($ok and $courriel_envoyeur and $options['activer_accuse']){
			// On récupère le sujet s'il existe sinon on le construit
			if ($options['sujet_accuse']){
				$a_remplacer = array();
				if (preg_match_all('/@[\w]+@/', $options['sujet_accuse'], $a_remplacer)){
					$a_remplacer = $a_remplacer[0];
					foreach ($a_remplacer as $cle=>$val) $a_remplacer[$cle] = trim($val, '@');
					$a_remplacer = array_flip($a_remplacer);
					$a_remplacer = array_intersect_key($valeurs, $a_remplacer);
					$a_remplacer = array_merge($a_remplacer, array('nom_site_spip' => $nom_site_spip));
				}
				$sujet_accuse = trim(_L($options['sujet_accuse'], $a_remplacer));
			}
			if (!$sujet_accuse) $sujet_accuse = _T('formidable:traiter_email_sujet_accuse');
			$sujet_accuse = filtrer_entites($sujet_accuse);
			
			// Mais quel va donc être le fond ?
			if (find_in_path('notifications/formulaire_'.$formulaire['identifiant'].'_accuse.html'))
				$accuse = 'notifications/formulaire_'.$formulaire['identifiant'].'_accuse';
			else
				$accuse = 'notifications/formulaire_accuse';
				
			// On génère l'accusé de réception
			$html_accuse = recuperer_fond(
				$accuse,
				array(
					'id_formulaire' => $formulaire['id_formulaire'],
					'titre' => _T_ou_typo($formulaire['titre']),
					'message_retour' => $formulaire['message_retour'],
					'traitements' => $traitements,
					'saisies' => $saisies,
					'valeurs' => $valeurs
				)
			);
			
			// On génère le texte brut
			$texte = Facteur::html2text($html_accuse);
			
			$corps = array(
				'html' => $html_accuse,
				'texte' => $texte,
				'nom_envoyeur' => $nom_site_spip
			);

			$ok = $envoyer_mail($courriel_envoyeur, $sujet_accuse, $corps, $courriel_from, "X-Originating-IP: ".$GLOBALS['ip']);
		}
		
		if ($ok){
			$retours['message_ok'] .= "\n<br/>"._T('formidable:traiter_email_message_ok');
		}
		else{
			$retours['message_erreur'] .= "\n<br/>"._T('formidable:traiter_email_message_erreur');
		}
	}
	
	return $retours;
}

?>
