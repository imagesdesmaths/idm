<?php
// This is a SPIP language file  --  Ceci est un fichier langue de SPIP
// extrait automatiquement de http://trad.spip.org/tradlang_module/forum?lang_cible=pt
// ** ne pas modifier le fichier **

if (!defined('_ECRIRE_INC_VERSION')) return;

$GLOBALS[$GLOBALS['idx_lang']] = array(

	// A
	'aucun_message_forum' => 'Aucun message de forum', # NEW

	// B
	'bouton_radio_articles_futurs' => 'aos futuros artigos unicamente (não há acção sobre a base de dados) ',
	'bouton_radio_articles_tous' => 'a todos os artigos sem excepção',
	'bouton_radio_articles_tous_sauf_forum_desactive' => 'a todos os artigos, excepto aqueles cujo fórum está desactivado',
	'bouton_radio_enregistrement_obligatoire' => 'Registo obrigatório (os
utilizadores devem ter uma assinatura ao fornecer o seu endereço e-mail antes de
 poderem enviar contribuições).',
	'bouton_radio_moderation_priori' => 'Moderação a  priori (as
 contribuições aparecem publicamente só depois da validação pelos
 administradores). ', # MODIF
	'bouton_radio_modere_abonnement' => 'moderado com assinatura',
	'bouton_radio_modere_posteriori' => 'moderado a posteriori', # MODIF
	'bouton_radio_modere_priori' => 'moderado a priori', # MODIF
	'bouton_radio_publication_immediate' => 'Publicação imediata das mensagens
 (as contribuições afixam-se logo que são enviadas, os administradores podem suprimi-las depois).',

	// D
	'documents_interdits_forum' => 'Documents interdits dans le forum', # NEW

	// E
	'erreur_enregistrement_message' => 'Votre message n\'a pas pu être enregistré en raison d\'un problème technique', # NEW

	// F
	'form_pet_message_commentaire' => 'Uma mensagem, um comentário ?',
	'forum' => 'Fórum',
	'forum_acces_refuse' => 'Já não tem acesso a esses fóruns.',
	'forum_attention_dix_caracteres' => '<b>Atenção !</b> a sua mensagem contém menos de dez carácteres.',
	'forum_attention_message_non_poste' => 'Attention, vous n\'avez pas posté votre message !', # NEW
	'forum_attention_trois_caracteres' => '<b>Atenção !</b> o seu título contém menos de três carácteres.',
	'forum_attention_trop_caracteres' => '<b>Attention !</b> votre message est trop long (@compte@ caractères) : pour pouvoir être enregistré, il ne doit pas dépasser @max@ caractères.', # NEW
	'forum_avez_selectionne' => 'Seleccionou :',
	'forum_cliquer_retour' => 'Clicar <a href=\'@retour_forum@\'>ici</a> para continuar.',
	'forum_forum' => 'fórum',
	'forum_info_modere' => 'Este fórum está moderado a priori : a sua contribuição só aparecerá depois de ser validada por um administrador do sítio.', # MODIF
	'forum_lien_hyper' => '<b>Link hipertexto</b> (opcional)', # MODIF
	'forum_message' => 'Votre message', # NEW
	'forum_message_definitif' => 'Mensagem definitiva: mandar para o sítio',
	'forum_message_trop_long' => 'A sua mensagem é demasiado comprida. O tamanho máximo é 20000 carácteres.', # MODIF
	'forum_ne_repondez_pas' => 'Não responder para este mail mas no fórum, para o endereço seguinte:', # MODIF
	'forum_page_url' => '(Se a sua mensagem se refere a um artigo publicado na Web, ou a uma página que fornece mais informações, por favor indique a seguir o título da página e o seu endereço URL.)',
	'forum_permalink' => 'Lien permanent vers le commentaire', # NEW
	'forum_poste_par' => 'Mensagem posta@parauteur@ depois do seu artigo', # MODIF
	'forum_qui_etes_vous' => '<b>Quem é você?</b> (opcional)', # MODIF
	'forum_saisie_texte_info' => 'Ce formulaire accepte les raccourcis SPIP <code>[-&gt;url] {{gras}} {italique} &lt;quote&gt; &lt;code&gt;</code> et le code HTML <code>&lt;q&gt; &lt;del&gt; &lt;ins&gt;</code>. Pour créer des paragraphes, laissez simplement des lignes vides.', # NEW
	'forum_texte' => 'Texto da sua mensagem:', # MODIF
	'forum_titre' => 'Título:', # MODIF
	'forum_url' => 'URL:', # MODIF
	'forum_valider' => 'Validar a sua escolha',
	'forum_voir_avant' => 'Ver esta mensagem antes de mandar', # MODIF
	'forum_votre_email' => 'O seu endereço email:', # MODIF
	'forum_votre_nom' => 'O seu nome (pseudónimo):', # MODIF
	'forum_vous_enregistrer' => 'Para participar
 nesse fórum, deve estar previamente registado. É favor
  indicar a seguir o identificador pessoal que lhe foi
 fornecido. Se não está registado, deve  ',
	'forum_vous_inscrire' => 'inscrever-se.',

	// I
	'icone_bruler_message' => 'Signaler comme Spam', # NEW
	'icone_bruler_messages' => 'Signaler comme Spam', # NEW
	'icone_legitimer_message' => 'Signaler comme licite', # NEW
	'icone_poster_message' => 'Enviar uma mensagem ',
	'icone_suivi_forum' => 'Seguimento do fórum público : @nb_forums@ contribuição(ões)',
	'icone_suivi_forums' => 'Seguir/gerir os fóruns',
	'icone_supprimer_message' => 'Suprimir esta mensagem',
	'icone_supprimer_messages' => 'Supprimer ces messages', # NEW
	'icone_valider_message' => 'Validar esta mensagem',
	'icone_valider_messages' => 'Valider ces messages', # NEW
	'icone_valider_repondre_message' => 'Valider & Répondre à ce message', # NEW
	'info_1_message_forum' => '1 message de forum', # NEW
	'info_activer_forum_public' => '<i>Para activar os fóruns públicos, favor escolher o seu modo
  de moderação por defeito </i>', # MODIF
	'info_appliquer_choix_moderation' => 'Aplicar esta escolha de moderação :',
	'info_config_forums_prive' => 'Dans l’espace privé du site, vous pouvez activer plusieurs types de forums :', # NEW
	'info_config_forums_prive_admin' => 'Un forum réservé aux administrateurs du site :', # NEW
	'info_config_forums_prive_global' => 'Un forum global, ouvert à tous les rédacteurs :', # NEW
	'info_config_forums_prive_objets' => 'Un forum sous chaque article, brève, site référencé, etc. :', # NEW
	'info_desactiver_forum_public' => 'Desactivar a utilização dos fóruns
 públicos. Os fóruns públicos poderão ser autorizados caso a caso
 nos artigos ; serão proibidos nas rubricas, notícias, etc.',
	'info_envoi_forum' => 'Envio dos fóruns aos autores dos artigos',
	'info_fonctionnement_forum' => 'Funcionamento do fórum :',
	'info_forums_liees_mot' => 'Les messages de forum liés à ce mot', # NEW
	'info_gauche_suivi_forum_2' => 'A página <i>acompanhamento dos fóruns </i> é um instrumento de gestão do seu sítio (e não um espaço de discussão ou de redacção). Exibe todas as contribuições do fórum público deste artigo e permite-lhe gerir essas contribuições. ', # MODIF
	'info_liens_syndiques_3' => 'fóruns',
	'info_liens_syndiques_4' => 'são',
	'info_liens_syndiques_5' => 'forum',
	'info_liens_syndiques_6' => 'é',
	'info_liens_syndiques_7' => 'à espera de validação',
	'info_liens_texte' => 'Lien(s) contenu(s) dans le texte du message', # NEW
	'info_liens_titre' => 'Lien(s) contenu(s) dans le titre du message', # NEW
	'info_mode_fonctionnement_defaut_forum_public' => 'Modo de funcionamento por defeito dos fóruns públicos',
	'info_nb_messages_forum' => '@nb@ messages de forum', # NEW
	'info_option_email' => 'Quando um visitante do sítio deixa uma nova mensagem no fórum
 ligado a um artigo, os autores do artigo podem ser
 avisados por e-mail. Deseja utilizar essa opção ?', # MODIF
	'info_pas_de_forum' => 'não há fórum',
	'info_question_visiteur_ajout_document_forum' => 'Si vous souhaitez autoriser les visiteurs à joindre des documents (images, sons...) à leurs messages de forum, indiquer ci-dessous la liste des extensions de documents autorisés pour les forums (ex: gif, jpg, png, mp3).', # MODIF
	'info_question_visiteur_ajout_document_forum_format' => 'Si vous souhaitez autoriser tous les types de documents considérés comme fiables par SPIP, mettre une étoile. Pour ne rien autoriser, ne rien indiquer.', # MODIF
	'interface_formulaire' => 'Interface formulaire', # NEW
	'interface_onglets' => 'Interface avec onglets', # NEW
	'item_activer_forum_administrateur' => 'Activar o fórum dos administradores',
	'item_config_forums_prive_global' => 'Activer le forum des rédacteurs', # NEW
	'item_config_forums_prive_objets' => 'Activer ces forums', # NEW
	'item_desactiver_forum_administrateur' => 'Desactivar o fórum dos administradores',
	'item_non_config_forums_prive_global' => 'Désactiver le forum des rédacteurs', # NEW
	'item_non_config_forums_prive_objets' => 'Désactiver ces forums', # NEW

	// L
	'lien_reponse_article' => 'Resposta ao artigo',
	'lien_reponse_breve_2' => 'Resposta à notícia',
	'lien_reponse_message' => 'Réponse au message', # NEW
	'lien_reponse_rubrique' => 'Resposta à rubrica ',
	'lien_reponse_site_reference' => 'Resposta ao sítio referenciado', # MODIF

	// M
	'messages_aucun' => 'Aucun', # NEW
	'messages_meme_auteur' => 'Tous les messages de cet auteur', # NEW
	'messages_meme_email' => 'Tous les messages de cet email', # NEW
	'messages_meme_ip' => 'Tous les messages de cette IP', # NEW
	'messages_off' => 'Supprimés', # NEW
	'messages_perso' => 'Personnels', # NEW
	'messages_privadm' => 'Administrateurs', # NEW
	'messages_prive' => 'Privés', # NEW
	'messages_privoff' => 'Supprimés', # NEW
	'messages_privrac' => 'Généraux', # NEW
	'messages_prop' => 'Proposés', # NEW
	'messages_publie' => 'Publiés', # NEW
	'messages_spam' => 'Spam', # NEW
	'messages_tous' => 'Tous', # NEW

	// O
	'onglet_messages_internes' => 'Mensagens internas',
	'onglet_messages_publics' => 'Mensagens públicas',
	'onglet_messages_vide' => 'Mensagens sem texto',

	// R
	'repondre_message' => 'Responder a esta mensagem',

	// S
	'statut_off' => 'Supprimé', # NEW
	'statut_original' => 'original', # NEW
	'statut_prop' => 'Proposé', # NEW
	'statut_publie' => 'Publié', # NEW
	'statut_spam' => 'Spam', # NEW

	// T
	'text_article_propose_publication_forum' => 'N\'hésitez pas à donner votre avis grâce au forum attaché à cet article (en bas de page).', # NEW
	'texte_en_cours_validation' => 'Les articles, brèves, forums ci dessous sont proposés à la publication.', # NEW
	'texte_en_cours_validation_forum' => 'N\'hésitez pas à donner votre avis grâce aux forums qui leur sont attachés.', # NEW
	'texte_messages_publics' => 'Messages publics sur :', # NEW
	'titre_cadre_forum_administrateur' => 'Fórum privado dos administradores',
	'titre_cadre_forum_interne' => 'Fórum interno',
	'titre_config_forums_prive' => 'Forums de l’espace privé', # NEW
	'titre_forum' => 'Fórum',
	'titre_forum_suivi' => 'Acompanhamento dos fóruns',
	'titre_page_forum_suivi' => 'Acompanhamento dos fóruns',
	'titre_selection_action' => 'Sélection', # NEW
	'tout_voir' => 'Voir tous les messages', # NEW

	// V
	'voir_messages_objet' => 'voir les messages' # NEW
);

?>
