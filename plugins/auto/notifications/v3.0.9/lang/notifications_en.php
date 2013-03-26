<?php
// This is a SPIP language file  --  Ceci est un fichier langue de SPIP
// extrait automatiquement de http://trad.spip.net/tradlang_module/notifications?lang_cible=en
// ** ne pas modifier le fichier **

if (!defined('_ECRIRE_INC_VERSION')) return;

$GLOBALS[$GLOBALS['idx_lang']] = array(

	// A
	'alt_logo_conf' => 'Notifications plugin logo',
	'article_prive' => 'Articles publishing',
	'article_prive_admins_restreints' => '<strong>Administrators</strong>: Administrators get notified when article(s) is(are) proposed in their section',
	'article_prive_auteurs' => '<strong>Authors</strong>: Authors get notified when their article(s) is(are) proposed, published or deleted.',
	'article_propose_detail' => 'The article "@titre@" is submitted for publication.',
	'article_propose_sujet' => '[@nom_site_spip@] Submitted: @titre@',
	'article_propose_titre' => 'Article submitted
	---------------',
	'article_propose_url' => 'You are invited to review it and to give your opinion
	in the forum linked to it. It is available at the address :',
	'article_publie_detail' => 'The article "@titre@" was validated by @connect_nom@.',
	'article_publie_sujet' => '[@nom_site_spip@] PUBLISHED: @titre@',
	'article_publie_titre' => 'Article published
	--------------',
	'article_valide_date' => 'Without change, this article will be published',
	'article_valide_detail' => 'The article "@titre@" is validated by @connect_nom@.',
	'article_valide_sujet' => '[@nom_site_spip@] VALIDATED: @titre@',
	'article_valide_titre' => 'Article validated
	--------------',
	'article_valide_url' => 'Meanwhile, it is visible at this temporary address :',

	// B
	'bouton_changer_pass' => 'Change my password',
	'bouton_finir_inscription' => 'Validate my registration',
	'breve_propose_detail' => 'The news item "@titre@" is proposed for publication since',
	'breve_propose_sujet' => '[@nom_site_spip@] Proposed: @titre@',
	'breve_propose_titre' => 'Proposed news item
	---------------',
	'breve_propose_url' => 'You are invited to view it and give your opinion
	in the forum attached to it. It is available at:',
	'breve_publie_detail' => 'The news item "@titre@" has just been published by @connect_nom@.',
	'breve_publie_sujet' => '[@nom_site_spip@] PUBLISHED: @titre@',
	'breve_publie_titre' => 'News item published
	--------------',

	// E
	'evenement_notification' => 'Following events may generate email notifications.',

	// F
	'form_forum_confirmer_email' => 'To confirm your email address, click the button below:',
	'forum_prives_auteur' => '<strong>Authors</strong>: Authors get notified when comments are posted to their article(s) or comment(s) on the private area.',
	'forum_prives_moderateur' => 'Please write here moderators\' email adress for private forums, coma separated.',
	'forum_prives_thread' => '<strong>Forum thread</strong>: Posters to the same thread get notified when a new comment is posted to the (private) thread.',
	'forums_prives' => 'Forums in private area',
	'forums_public' => 'Public forums',
	'forums_public_a_noter' => 'Note: if forums are awaiting validation from moderators before publication, only authors with rights to validate forums get notified when the comment is posted ; other recipients get notified only when moderators validate the comment.',
	'forums_public_auteurs' => '<strong>Authors</strong>: Authors get notified when new comments are posted to their article(s) on the public area.',
	'forums_public_moderateur' => 'Please write here moderators\' email adress for public forums, coma separated.',
	'forums_public_thread' => '<strong>Forum thread</strong>: Posters to the same thread get notified when a new comment is posted to the (public) thread.',

	// I
	'info_lien_publier_commentaire' => 'Publish this comment online',
	'info_lien_signaler_spam_commentaire' => 'Report as SPAM',
	'info_lien_supprimer_commentaire' => 'Delete this comment',
	'info_moderation_confirmee_off' => 'Message #@id_forum@ has been deleted',
	'info_moderation_confirmee_publie' => 'Message #@id_forum@ has been published online',
	'info_moderation_confirmee_spam' => 'Message #@id_forum@ has been reported as SPAM',
	'info_moderation_deja_faite' => 'Message #@id_forum@ has already been moderated as "@statut@".',
	'info_moderation_interdite' => 'You are not allowed to moderate this message',
	'info_moderation_lien_titre' => 'Moderate this message from the private area',
	'info_moderation_url_perimee' => 'This moderation link is not valid anymore.',
	'info_nouveau_commentaire' => 'New comment',
	'inscription' => 'Editors registration',
	'inscription_admins' => 'Administrators',
	'inscription_explication' => 'Which authors receive notifications when registering new editors?',
	'inscription_label' => 'Status',
	'inscription_statut_aucun' => 'None',
	'inscription_statut_webmestres' => 'Webmaster',

	// L
	'lien_documentation' => '<a href="http://www.spip-contrib.net/Notifications" class="spip_out">View documentation</a>',

	// M
	'message_a_valider' => 'Message to confirm:',
	'message_spam_a_confirmer' => 'SPAM to confirm:',
	'message_voir_configuration' => 'Look at the notification setup',
	'messagerie_interne' => 'Private messages',
	'messagerie_interne_signaler' => '<strong>Notify new private messages</strong>: activate this to get redactors notified when they haven\'t seen a Private Message had been sent to them. Redactors get notified 20 minutes after the Private Message is sent, in order to avoid spam, when the redactor is connected to the private area.',
	'moderateur' => '<strong>Moderator</strong>',

	// N
	'notifications' => 'Notifications',

	// P
	'pass_mail_passcookie_1' => 'To regain access to the site @nom_site_spip@, click the button:',
	'pass_mail_passcookie_2' => 'You can then enter a new password and reconnect to the site.',

	// S
	'signature_petition' => 'Petition signatures',
	'signature_petition_moderateur' => 'Please write here moderator\'s email address for petitions, coma separated.',
	'suivi_texte_acces_page' => 'Change my subscriptions to discussions',
	'suivis_perso' => 'Personnal notifications follow-up',
	'suivis_perso_activer_option' => 'If you activate this option, each visitor clicking this follow-up URL will be registered in the <code>spip_auteurs</code> DB table, with status <code>6visiteur</code>. He\'ll be then able to view all the messages he posted on the website, configure his own notification options, ...',
	'suivis_perso_non' => 'No follow-up',
	'suivis_perso_oui' => 'Follow-up activated',
	'suivis_perso_url_suivis' => '<strong>Add an URL for notifications follow-up</strong> in each notification email. CLicking on this URL will let the user configure his own notification preferences.',
	'suivis_public_article_thread' => 'TODO: Tickbox on each article/thread',
	'suivis_public_changer_email' => 'TODO: Change your email',
	'suivis_public_description' => 'You will be able (when this will be operationnal...) find here all your comments on this website, get a RSS stream for their answers, choose your notification mode, ...',
	'suivis_public_notif_desactiver' => 'TODO: Tickbox to stop notifications',
	'suivis_public_vos_forums' => 'Your forums',
	'suivis_public_vos_forums_date' => 'Your forums, by date',
	'suivis_public_votre_page' => 'This is your personnal Notifications follow-up for the website',

	// T
	'titre_moderation' => 'Moderation'
);

?>
