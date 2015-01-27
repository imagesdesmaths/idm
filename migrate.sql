CREATE TABLE IF NOT EXISTS `mail_envoi` (
  `pk_mail` int(11) NOT NULL AUTO_INCREMENT,
  `date_ajout` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_envoi` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `expediteur` varchar(255) DEFAULT NULL,
  `destinataire` varchar(255) DEFAULT NULL,
  `reponse` varchar(255) DEFAULT NULL,
  `entete` text,
  `corps` text,
  `corps_text` text NOT NULL,
  `in_tentative` int(11) DEFAULT '0',
  `in_publipostage` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`pk_mail`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
CREATE TABLE IF NOT EXISTS `mail_envoi` (
  `pk_mail` int(11) NOT NULL AUTO_INCREMENT,
  `date_ajout` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_envoi` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `expediteur` varchar(255) DEFAULT NULL,
  `destinataire` varchar(255) DEFAULT NULL,
  `reponse` varchar(255) DEFAULT NULL,
  `entete` text,
  `corps` text,
  `corps_text` text NOT NULL,
  `in_tentative` int(11) DEFAULT '0',
  `in_publipostage` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`pk_mail`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

INSERT INTO `spip_groupes_mots` (`id_groupe`, `titre`, `unseul`, `obligatoire`, `tables_liees`, `minirezo`, `comite`, `forum`) 
(SELECT MAX(id_groupe)+1, 'Actualité importante', 'oui', 'non', 'articles', 'oui', 'oui', 'non' FROM `spip_groupes_mots`);
INSERT INTO `spip_mots` (`titre`, `id_groupe`, `type`) 
(SELECT 'Actualité', MAX(id_groupe), 'Actualité importante' FROM `spip_groupes_mots`);
INSERT INTO `spip_mots` (`titre`, `id_groupe`, `type`)
(SELECT 'Événement', MAX(id_groupe), 'Actualité importante' FROM `spip_groupes_mots`);

UPDATE `spip_rubriques` SET `titre` = 'La tribune des mathématiciens' WHERE `titre` LIKE 'billets des habitu%';
UPDATE `spip_rubriques` SET `titre` = 'Revue de presse' WHERE `titre` LIKE 'actualit%';

CREATE TABLE IF NOT EXISTS `spip_random` (
  `id_random` bigint(21) NOT NULL AUTO_INCREMENT,
  `objet` varchar(25) NOT NULL,
  `id_objet` bigint(21) NOT NULL DEFAULT '0',
  `type` text NOT NULL,
  `date_picked` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id_random`),
  KEY `object` (`objet`,`id_objet`),
  KEY `id_random` (`id_random`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

INSERT INTO `spip_idm_teams` (`team`, `id_auteur`) VALUES
('secretaire_redaction', 1),
('secretaire_redaction', 41),
('secretaire_redaction', 2423),
('secretaire_redaction', 2532);


