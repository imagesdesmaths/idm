<?php
// This is a SPIP language file  --  Ceci est un fichier langue de SPIP
// Fichier source, a modifier dans svn://zone.spip.org/spip-zone/_plugins_/notifications/trunk/lang/
if (!defined('_ECRIRE_INC_VERSION')) return;

$GLOBALS[$GLOBALS['idx_lang']] = array(

	// A
	'alt_logo_conf' => 'Logo du plugin Notifications',
	'article_prive' => 'Publication d\'articles',
	'article_prive_admins_restreints' => '<strong>Administrateurs</strong> : Les administrateurs restreints reçoivent les notifications lors de proposition d\'articles dans leur rubrique',
	'article_prive_auteurs' => '<strong>Auteurs</strong> : les auteurs reçoivent les notifications lors de la publication de leur(s) article(s)',
	'article_propose_detail' => 'L\'article "@titre@" est proposé à la publication
	depuis',
	'article_propose_sujet' => '[@nom_site_spip@] Propose : @titre@',
	'article_propose_titre' => 'Article proposé
	---------------',
	'article_propose_url' => 'Vous êtes invité à venir le consulter et à donner votre opinion
	dans le forum qui lui est attaché. Il est disponible à l\'adresse :',
	'article_publie_detail' => 'L\'article "@titre@" vient d\'être publié par @connect_nom@.',
	'article_publie_sujet' => '[@nom_site_spip@] PUBLIE : @titre@',
	'article_publie_titre' => 'Article publié
	--------------',
	'article_valide_date' => 'Sous réserve de changement, cet article sera publié',
	'article_valide_detail' => 'L\'article "@titre@" a été validé par @connect_nom@.',
	'article_valide_sujet' => '[@nom_site_spip@] VALIDE : @titre@',
	'article_valide_titre' => 'Article validé
	--------------',
	'article_valide_url' => 'En attendant, il est visible à cette adresse temporaire :',

	// B
	'breve_propose_detail' => 'La brève "@titre@" est proposée à la publication
	depuis',
	'breve_propose_sujet' => '[@nom_site_spip@] Propose : @titre@',
	'breve_propose_titre' => 'Brève proposée
	---------------',
	'breve_propose_url' => 'Vous êtes invité à venir la consulter et à donner votre opinion
	dans le forum qui lui est attaché. Elle est disponible à l\'adresse :',
	'breve_publie_detail' => 'La brève "@titre@" vient d\'être publiée par @connect_nom@.',
	'breve_publie_sujet' => '[@nom_site_spip@] PUBLIE : @titre@',
	'breve_publie_titre' => 'Brève publiée
	--------------',

	// E
	'evenement_notification' => 'Les événements suivants peuvent déclencher une notification par email.',

	// F
	'forum_prives_auteur' => '<strong>Auteurs</strong> : les auteurs reçoivent les notifications des forums postés sous leurs articles ou leurs messages dans le site privé.',
	'forum_prives_moderateur' => 'Indiquez ci-dessous l\'adresse email du modérateur des forums privés (ou plusieurs, séparés par des virgules).',
	'forum_prives_thread' => '<strong>Fil de discussion</strong> : les participants au même fil de discussion reçoivent les notifications des forums (privés).',
	'forums_prives' => 'Forums privés',
	'forums_public' => 'Forums publics',
	'forums_public_a_noter' => 'À noter : dans le cas des forums modérés à priori, seuls les auteurs ayant le droit de valider les forums sont notifiés lors de l\'envoi du forum ; les autres destinataires sont notifiés lors de la validation du message par le modérateur.',
	'forums_public_auteurs' => '<strong>Auteurs</strong> : les auteurs reçoivent les notifications des forums postés sous leurs articles dans le site public.',
	'forums_public_moderateur' => 'Indiquez ci-dessous l\'adresse email du modérateur des forums publics (ou plusieurs, séparés par des virgules).',
	'forums_public_thread' => '<strong>Fil de discussion</strong> : les participants au même fil de discussion reçoivent les notifications des forums (publics).',

	// I
	'inscription' => 'Inscription des rédacteurs',
	'inscription_admins' => 'Administrateurs',
	'inscription_explication' => 'Quels auteurs reçoivent les notifications lors de l\'inscription de nouveaux rédacteurs ?',
	'inscription_label' => 'Statut',
	'inscription_statut_aucun' => 'Aucun',
	'inscription_statut_webmestres' => 'Webmestres',

	// L
	'lien_documentation' => '<a href="http://www.spip-contrib.net/Notifications" class="spip_out">Cf. documentation</a>',

	// M
	'message_voir_configuration' => 'Voir la configuration des notifications',
	'messagerie_interne' => 'Messagerie interne',
	'messagerie_interne_signaler' => '<strong>Signaler les nouveaux messages privés</strong> : activer cette option pour que le site envoie une notification lorsqu\'un rédacteur n\'a pas vu un nouveau message dans sa messagerie. Le système attend 20 minutes avant de notifier le rédacteur, de manière à ne pas spammer un rédacteur déjà en ligne dans l\'espace privé.',
	'moderateur' => '<strong>Modérateur</strong>',

	// N
	'notifications' => 'Notifications',

	// S
	'signature_petition' => 'Signatures de pétition',
	'signature_petition_moderateur' => 'Indiquez ci-dessous l\'adresse email du modérateur des pétitions (ou plusieurs, séparés par des virgules).',
	'suivis_perso' => 'Suivi personnalisé',
	'suivis_perso_activer_option' => 'Si vous activez cette option, chaque visiteur qui se connecte sur cet URL de suivi sera enregistré dans la table <code>spip_auteurs</code>, avec le statut <code>6visiteur</code>. Il pourra alors voir l\'ensemble des messages qu\'il a signés sur le forum, régler ses options de notification, etc.',
	'suivis_perso_non' => 'Pas de suivi',
	'suivis_perso_oui' => 'Suivi activé',
	'suivis_perso_url_suivis' => '<strong>Ajouter une URL de suivi personnalisé</strong> dans chacun des emails de notification. À partir de cette URL, l\'utilisateur pourra configurer ses préférences individuelles de notification.',
	'suivis_public_article_thread' => 'TODO: case à cocher sur chaque article/thread',
	'suivis_public_changer_email' => 'TODO: changer d\'email',
	'suivis_public_description' => 'Vous pourrez (quand ce sera fonctionnel...) y retrouver tous vos messages de forum, obtenir un fil RSS des réponses qui y seront apportées, choisir votre mode de notification, etc.',
	'suivis_public_notif_desactiver' => 'TODO: case à cocher pour ne plus recevoir de notifications',
	'suivis_public_vos_forums' => 'Vos forums',
	'suivis_public_vos_forums_date' => 'Vos forums, par date',
	'suivis_public_votre_page' => 'Ceci est votre page personnalisée de suivi du site'
);

?>
