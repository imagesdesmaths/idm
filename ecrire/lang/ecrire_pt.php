<?php
// This is a SPIP language file  --  Ceci est un fichier langue de SPIP
// extrait automatiquement de http://www.spip.net/trad-lang/
// ** ne pas modifier le fichier **

if (!defined('_ECRIRE_INC_VERSION')) return;

$GLOBALS[$GLOBALS['idx_lang']] = array(

// A
'activer_plugin' => 'Activer le plugin', # NEW
'affichage' => 'Affichage', # NEW
'aide_non_disponible' => 'Esta parte da ajuda em linha ainda n&atilde;o est&aacute; dispon&iacute;vel nesta l&iacute;ngua ',
'auteur' => 'Auteur&nbsp;:', # NEW
'avis_acces_interdit' => 'Accesso proibido ',
'avis_article_modifie' => 'Aten&ccedil;&atilde;o, @nom_auteur_modif@  trabalhou neste artigo h&aacute; @date_diff@ minutes',
'avis_aucun_resultat' => 'Nenhum resultado ',
'avis_chemin_invalide_1' => 'O caminho que escolheu ',
'avis_chemin_invalide_2' => 'n&atilde;o parece v&aacute;lido. Favor volte &agrave; p&aacute;gina anterior e verifique as informa&ccedil;&otilde;es fornecidas. ',
'avis_connexion_echec_1' => 'A liga&ccedil;&atilde;o ao servidor  SQL falhou.', # MODIF
'avis_connexion_echec_2' => 'Volte &agrave; p&aacute;gina anterior e verifique as informa&ccedil;&otilde;es que forneceu ',
'avis_connexion_echec_3' => '<b>N.B.</b> Em diversos servidores, precisa <b>solicitar</b> a activa&ccedil;&atilde;o do seu acesso &agrave; base de dados SQL antes de poder utiliz&aacute;-la. Se n&atilde;o consegue ligar-se, verifique se efectuou esse pedido.', # MODIF
'avis_connexion_ldap_echec_1' => 'A liga&ccedil;&atilde;o ao servidor LDAP falhou',
'avis_connexion_ldap_echec_2' => 'Volte &agrave; p&aacute;gina anterior e verifique as informa&ccedil;&otilde;es que forneceu ',
'avis_connexion_ldap_echec_3' => 'Alternativamente, n&atilde;o utilize o suporte LDAP para importar utilizadores.',
'avis_conseil_selection_mot_cle' => '<b>Grupo importante&nbsp;:</b> &eacute; muito aconselh&aacute;vel seleccionar uma palavra-chave neste grupo.',
'avis_deplacement_rubrique' => 'Aten&ccedil;&atilde;o&nbsp;! Esta rubrica cont&eacute;m @contient_breves@ informa&ccedil;&atilde;o@scb@&nbsp;: se a deslocar, favor confirm&aacute;-lo nesta caixa',
'avis_destinataire_obligatoire' => 'Deve indicar um destinat&aacute;rio antes de mandar esta mensagem.',
'avis_doublon_mot_cle' => 'Un mot existe deja avec ce titre. &Ecirc;tes vous s&ucirc;r de vouloir cr&eacute;er le m&ecirc;meme ?', # MODIF
'avis_erreur_connexion_mysql' => 'Erro de liga&ccedil;&atilde;o SQL', # MODIF
'avis_erreur_version_archive' => '<b>Aten&ccedil;&atilde;o! O ficheiro @archive@ corresponde a
    uma vers&atilde;o de SPIP diferente da que
    tem instalada.</b> Enfrentar&aacute; grandes
    dificuldades: risco de destrui&ccedil;&atilde;o da sua
    base de dados, mau funcionamento
    generalizado do site etc.
    N&atilde;o valide este pedido de importa&ccedil;&atilde;o.
    <p>Para mais informa&ccedil;&otilde;es, leia
    <a href="@spipnet@">a documenta&ccedil;&atilde;o do SPIP</a>.</p>', # MODIF
'avis_espace_interdit' => '<b>Espa&ccedil;o interdito</b><p>SPIP j&aacute; est&aacute; instalado.', # MODIF
'avis_lecture_noms_bases_1' => 'O programa de instala&ccedil;&atilde;o n&atilde;o conseguiu ler os nomes das bases de dados instaladas. ',
'avis_lecture_noms_bases_2' => 'Ou nenhuma base est&aacute; dispon&iacute;vel, ou a fun&ccedil;&atilde;o que permite listar as bases foi desactivada
 por raz&otilde;es de seguran&ccedil;a( o que &eacute; o caso em muitos servi&ccedil;os de hospedagem).  ',
'avis_lecture_noms_bases_3' => 'Na segunda alternativa, &eacute; prov&aacute;vel que uma base tendo o  seu nome de login seja utiliz&aacute;vel &nbsp;:',
'avis_non_acces_message' => 'N&atilde;o tem acesso a esta mensagem. ',
'avis_non_acces_page' => 'N&atilde;o tem acesso a esta p&aacute;gina. ',
'avis_operation_echec' => 'A opera&ccedil;&atilde;o falhou. ',
'avis_operation_impossible' => 'Op&eacute;ration impossible', # NEW
'avis_probleme_archive' => 'Problema de leitura do ficheiro @archive@',
'avis_site_introuvable' => 'N&atilde;o se encontra o s&iacute;tio',
'avis_site_syndique_probleme' => 'Aten&ccedil;&atilde;o: a liga&ccedil;&atilde;o deste s&iacute;tio teve um problema &nbsp;; o sistema est&aacute; portanto temporariamente interrompido. Verifique o endere&ccedil;o do ficheiro de liga&ccedil;&atilde;o deste s&iacute;tio (<b>@url_syndic@</b>), e tente uma nova recupera&ccedil;&atilde;o das informa&ccedil;&otilde;es. ', # MODIF
'avis_sites_probleme_syndication' => 'Estes s&iacute;tios tiveram um problema de liga&ccedil;&atilde;o  ',
'avis_sites_syndiques_probleme' => 'Estes s&iacute;tios provocaram um problema  ',
'avis_suppression_base' => 'Aten&ccedil;&atilde;o, a supress&atilde;o dos dados &eacute; irrevers&iacute;vel',
'avis_version_mysql' => 'A sua vers&atilde;o de SQL (@version_mysql@) n&atilde;o permite a auto-repara&ccedil;&atilde;o das tabelas da base.', # MODIF

// B
'bouton_acces_ldap' => 'Acrescentar o acesso a LDAP >>', # MODIF
'bouton_ajouter' => 'Acrescentar ',
'bouton_ajouter_participant' => 'ACRESCENTAR UM PARTICIPANTE&nbsp;:',
'bouton_annonce' => 'AN&Uacute;NCIO',
'bouton_annuler' => 'Annuler', # NEW
'bouton_checkbox_envoi_message' => 'possibilidade de mandar uma mensagem',
'bouton_checkbox_indiquer_site' => 'indicar obrigatoriamente um s&iacute;tio Web',
'bouton_checkbox_qui_attribue_mot_cle_administrateurs' => 'os administradores do s&iacute;tio',
'bouton_checkbox_qui_attribue_mot_cle_redacteurs' => 'os redactores',
'bouton_checkbox_qui_attribue_mot_cle_visiteurs' => 'os visitantes do s&iacute;tio p&uacute;blico quando mandam uma mensagem num f&oacute;rum',
'bouton_checkbox_signature_unique_email' => 'uma &uacute;nica assinatura por endere&ccedil;o email',
'bouton_checkbox_signature_unique_site' => 'uma &uacute;nica assinatura por s&iacute;tio Web',
'bouton_demande_publication' => 'Pedir a publica&ccedil;&atilde;o deste artigo ',
'bouton_desactive_tout' => 'Tout d&eacute;sactiver', # NEW
'bouton_desinstaller' => 'D&eacute;sinstaller', # NEW
'bouton_effacer_index' => 'Apagar os &iacute;ndices',
'bouton_effacer_statistiques' => 'Effacer les statistiques', # NEW
'bouton_effacer_tout' => 'Apagar TUDO',
'bouton_envoi_message_02' => 'MANDAR UMA MENSAGEM',
'bouton_envoyer_message' => 'Mensagem definitiva: mandar',
'bouton_forum_petition' => 'F&Oacute;RUM &amp; ABAIXO-ASSINADO', # MODIF
'bouton_modifier' => 'Modificar',
'bouton_pense_bete' => 'MEMORANDO DE USO PESSOAL',
'bouton_radio_activer_messagerie' => 'Activar a caixa do correio interno',
'bouton_radio_activer_messagerie_interne' => 'Activar a caixa de correio interno',
'bouton_radio_activer_petition' => 'Activar o abaixo-assinado',
'bouton_radio_afficher' => 'Exibir',
'bouton_radio_apparaitre_liste_redacteurs_connectes' => 'Aparecer na lista dos redactores ligados',
'bouton_radio_articles_futurs' => 'aos futuros artigos unicamente (n&atilde;o h&aacute; ac&ccedil;&atilde;o sobre a base de dados) ',
'bouton_radio_articles_tous' => 'a todos os artigos sem excep&ccedil;&atilde;o',
'bouton_radio_articles_tous_sauf_forum_desactive' => 'a todos os artigos, excepto aqueles cujo f&oacute;rum est&aacute; desactivado',
'bouton_radio_desactiver_messagerie' => 'Desactivar a caixa de correio',
'bouton_radio_enregistrement_obligatoire' => 'Registo obrigat&oacute;rio (os
utilizadores devem ter uma assinatura ao fornecer o seu endere&ccedil;o e-mail antes de
 poderem enviar contribui&ccedil;&otilde;es).',
'bouton_radio_envoi_annonces_adresse' => 'Enviar os an&uacute;ncios para o endere&ccedil;o:',
'bouton_radio_envoi_liste_nouveautes' => 'Enviar a lista das novidades',
'bouton_radio_moderation_priori' => 'Modera&ccedil;&atilde;o a  priori (as
 contribui&ccedil;&otilde;es aparecem publicamente s&oacute; depois da valida&ccedil;&atilde;o pelos
 administradores). ',
'bouton_radio_modere_abonnement' => 'moderado com assinatura',
'bouton_radio_modere_posteriori' => 'moderado a posteriori',
'bouton_radio_modere_priori' => 'moderado a priori',
'bouton_radio_non_apparaitre_liste_redacteurs_connectes' => 'N&atilde;o aparecer na lista dos redactores',
'bouton_radio_non_envoi_annonces_editoriales' => 'N&atilde;o enviar an&uacute;ncios editoriais',
'bouton_radio_non_syndication' => 'N&atilde;o h&aacute; vincula&ccedil;&atilde;o',
'bouton_radio_pas_petition' => 'N&atilde;o h&aacute; abaixo-assinado',
'bouton_radio_petition_activee' => 'Abaixo-assinado activado',
'bouton_radio_publication_immediate' => 'Publica&ccedil;&atilde;o imediata das mensagens
 (as contribui&ccedil;&otilde;es afixam-se logo que s&atilde;o enviadas, os administradores podem suprimi-las depois).',
'bouton_radio_sauvegarde_compressee' => 'Salvaguarda comprimida como @fichier@', # MODIF
'bouton_radio_sauvegarde_non_compressee' => 'salvaguarda n&atilde;o comprimida como   @fichier@', # MODIF
'bouton_radio_supprimer_petition' => 'Suprimir o abaixo-assinado',
'bouton_radio_syndication' => 'Vincula&ccedil;&atilde;o',
'bouton_redirection' => 'REDIRIGIR',
'bouton_relancer_installation' => 'Lan&ccedil;ar de novo a instala&ccedil;&atilde;o',
'bouton_restaurer_base' => 'Restaurar a base',
'bouton_suivant' => 'Seguinte',
'bouton_tenter_recuperation' => 'Tentar uma repara&ccedil;&atilde;o',
'bouton_test_proxy' => 'Testar o proxy',
'bouton_vider_cache' => 'Esvaziar a cache',
'bouton_voir_message' => 'Ver esta mensagem antes de validar',

// C
'cache_mode_compresse' => 'Os ficheiros da cache s&atilde;o gravados em modo comprimido.',
'cache_mode_non_compresse' => 'Os ficheiros da cache s&atilde;o gravados em modo n&atilde;o comprimido.',
'cache_modifiable_webmestre' => 'Este par&acirc;metro &eacute; modific&aacute;vel pelo webmaster do site.',
'calendrier_synchro' => 'Se utilizar um software de agenda compat&iacute;vel <b>iCal</b>, pode sincroniz&aacute;-lo com as informa&ccedil;&otilde;es deste s&iacute;tio.',
'config_activer_champs' => 'Activer les champs suivants', # NEW
'config_choix_base_sup' => 'indiquer une base sur ce serveur', # NEW
'config_erreur_base_sup' => 'SPIP n\'a pas acc&egrave;s &agrave; la liste des bases accessibles', # NEW
'config_info_base_sup' => 'Si vous avez d\'autres bases de donn&eacute;es &agrave; interroger &agrave; travers SPIP, avec son serveur SQL ou avec un autre, le formulaire ci-dessous, vous permet de les d&eacute;clarer. Si vous laissez certains champs vides, les identifiants de connexion &agrave; la base principale seront utilis&eacute;s.', # NEW
'config_info_base_sup_disponibles' => 'Bases suppl&eacute;mentaires d&eacute;j&agrave; interrogeables:', # NEW
'config_info_enregistree' => 'La nouvelle configuration a &eacute;t&eacute; enregistr&eacute;e', # NEW
'config_info_logos' => 'Chaque &eacute;l&eacute;ment du site peut avoir un logo, ainsi qu\'un &laquo;&nbsp;logo de survol&nbsp;&raquo;', # NEW
'config_info_logos_utiliser' => 'Utiliser les logos', # NEW
'config_info_logos_utiliser_non' => 'Ne pas utiliser les logos', # NEW
'config_info_logos_utiliser_survol' => 'Utiliser les logos de survol', # NEW
'config_info_logos_utiliser_survol_non' => 'Ne pas utiliser les logos de survol', # NEW
'config_info_redirection' => 'En activant cette option, vous pourrez cr&eacute;er des articles virtuels, simples r&eacute;f&eacute;rences d\'articles publi&eacute;s sur d\'autres sites ou hors de SPIP.', # NEW
'config_redirection' => 'Articles virtuels', # NEW
'config_titre_base_sup' => 'D&eacute;claration d\'une base suppl&eacute;mentaire', # NEW
'config_titre_base_sup_choix' => 'Choisissez une base suppl&eacute;mentaire', # NEW
'connexion_ldap' => 'Connexion :', # NEW
'copier_en_local' => 'Copier en local', # NEW

// D
'date_mot_heures' => 'horas',
'diff_para_ajoute' => 'Par&aacute;grafo acrescentado',
'diff_para_deplace' => 'Par&aacute;grafo alterado',
'diff_para_supprime' => 'Par&aacute;grafo suprimido',
'diff_texte_ajoute' => 'Texto acrescentado',
'diff_texte_deplace' => 'Texto alterado',
'diff_texte_supprime' => 'Texto suprimido',
'double_clic_inserer_doc' => 'Fa&ccedil;a duplo clique para inserir este atalho no texto',

// E
'email' => 'email',
'email_2' => 'email :',
'en_savoir_plus' => 'En savoir plus', # NEW
'entree_adresse_annuaire' => 'Endere&ccedil;o do anu&aacute;rio',
'entree_adresse_email' => 'O seu endere&ccedil;o email',
'entree_adresse_fichier_syndication' => 'Endere&ccedil;o do ficheiro  &laquo;&nbsp;backend&nbsp;&raquo; para a vincula&ccedil;&atilde;o&nbsp;:', # MODIF
'entree_adresse_site' => '<b>Endere&ccedil;o do s&iacute;tio</b> [Obrigat&oacute;rio]',
'entree_base_donnee_1' => 'Endere&ccedil;o da base de dados',
'entree_base_donnee_2' => '(Muitas vezes, este endere&ccedil;o corresponde ao do seu s&iacute;tio, outras vezes, corresponde &agrave; men&ccedil;&atilde;o &laquo;localhost&raquo;, &agrave;s vezes, fica totalmente vazio.)',
'entree_biographie' => 'Curta biografia, em poucas palavras',
'entree_breve_publiee' => 'Deve-se publicar esta not&iacute;cia?',
'entree_chemin_acces' => '<b>Introduzir</b> o caminho de acesso&nbsp;:', # MODIF
'entree_cle_pgp' => 'A sua chave PGP',
'entree_contenu_rubrique' => '(Conte&uacute;do da rubrica em poucas palavras.)',
'entree_description_site' => 'Descri&ccedil;&atilde;o do s&iacute;tio',
'entree_identifiants_connexion' => 'Os seus identificadores de liga&ccedil;&atilde;o',
'entree_informations_connexion_ldap' => 'Favor p&ocirc;r neste formul&aacute;rio as informa&ccedil;&otilde;es de liga&ccedil;&atilde;o ao seu anu&aacute;rio LDAP.
Essas informa&ccedil;&otilde;es devem poder ser fornecidas pelo administrador do sistema,
ou da rede',
'entree_infos_perso' => 'Quem &eacute; voc&ecirc;?',
'entree_interieur_rubrique' => 'Dentro da rubrica&nbsp;:',
'entree_liens_sites' => '<b>La&ccedil;o hipertexto</b> (refer&ecirc;ncia, s&iacute;tio a visitar ...)', # MODIF
'entree_login' => 'O seu login',
'entree_login_connexion_1' => 'O login de liga&ccedil;&atilde;o',
'entree_login_connexion_2' => '(Corresponde &agrave;s vezes ao seu login de acesso ao FTP; deixado vazio outrs vezes)',
'entree_login_ldap' => 'Login LDAP inicial',
'entree_mot_passe' => 'A sua palavra-passe',
'entree_mot_passe_1' => 'A palavra-passe de liga&ccedil;&atilde;o',
'entree_mot_passe_2' => '(Corresponde, &agrave;s vezes, &agrave; sua palavra-passe para o FTP; outras vezes, vazio)',
'entree_nom_fichier' => 'Favor introduzir o nome do ficheiro @texte_compresse@:',
'entree_nom_pseudo' => 'O seu nome ou o seu pseud&oacute;nimo',
'entree_nom_pseudo_1' => '(O seu nome ou o seu pseud&oacute;nimo)',
'entree_nom_site' => 'O nome do seu s&iacute;tio',
'entree_nouveau_passe' => 'Nova palavra-passe',
'entree_passe_ldap' => 'Palavra-passe',
'entree_port_annuaire' => 'O n&uacute;mero de porta do anu&aacute;rio',
'entree_signature' => 'Assinatura',
'entree_texte_breve' => 'Texto da not&iacute;cia',
'entree_titre_obligatoire' => '<b>T&iacute;tulo</b> [Obrigat&oacute;rio]<br />', # MODIF
'entree_url' => 'O endere&ccedil;o (URL) do seu s&iacute;tio',
'erreur_plugin_desinstalation_echouee' => 'La d&eacute;sinstallation du plugin a echou&eacute;. Vous pouvez n&eacute;anmoins le desactiver.', # NEW
'erreur_plugin_fichier_absent' => 'Fichier absent', # NEW
'erreur_plugin_fichier_def_absent' => 'Fichier de d&eacute;finition absent', # NEW
'erreur_plugin_nom_fonction_interdit' => 'Nom de fonction interdit', # NEW
'erreur_plugin_nom_manquant' => 'Nom du plugin manquant', # NEW
'erreur_plugin_prefix_manquant' => 'Espace de nommage du plugin non d&eacute;fini', # NEW
'erreur_plugin_tag_plugin_absent' => '&lt;plugin&gt; manquant dans le fichier de d&eacute;finition', # NEW
'erreur_plugin_version_manquant' => 'Version du plugin manquante', # NEW

// F
'forum_info_original' => 'original', # NEW

// H
'htaccess_a_simuler' => 'Avertissement: la configuration de votre serveur HTTP ne tient pas compte des fichiers @htaccess@. Pour pouvoir assurer une bonne s&eacute;curit&eacute;, il faut que vous modifiez cette configuration sur ce point, ou bien que les constantes @constantes@ (d&eacute;finissables dans le fichier mes_options.php) aient comme valeur des r&eacute;pertoires en dehors de @document_root@.', # NEW
'htaccess_inoperant' => 'htaccess inop&eacute;rant', # NEW

// I
'ical_info1' => 'Esta p&aacute;gina apresenta muitos m&eacute;todos para permanecer em contacto com a vida deste s&iacute;tio.',
'ical_info2' => 'Para mais informa&ccedil;&otilde;es sobre estas t&eacute;cnicas, consultar  <a href="@spipnet@">a documenta&ccedil;&atilde;o de SPIP</a>.', # MODIF
'ical_info_calendrier' => 'Dois calend&aacute;rios est&atilde;o &agrave; sua disposi&ccedil;&atilde;o. O primeiro &eacute; uma planta do s&iacute;tio anunciando todos os artigos publicados. O segundo cont&eacute;m os an&uacute;ncios editoriais assim como as &uacute;ltimas mensagens privadas&nbsp;: est&aacute; reservado para si gra&ccedil;as a uma chave pessoal, que pode modificar a qualquer momento com a renova&ccedil;&atilde;o da sua palavra-passe.',
'ical_lien_rss_breves' => 'Syndication des br&egrave;ves du site', # NEW
'ical_methode_http' => 'Telecarregamento',
'ical_methode_webcal' => 'Sincroniza&ccedil;&atilde;o (webcal://)',
'ical_texte_js' => 'Uma linha de javascript permite-lhe exibir, muito simplesmente, em qualquer s&iacute;tio que lhe perten&ccedil;a, os artigos recentes publicados neste s&iacute;tio.',
'ical_texte_prive' => 'Este calend&aacute;rio, de uso estritamente pessoal, informa sobre a actividade editorial privada deste s&iacute;tio (tarefas e encontros pessoais, artigos e not&iacute;cias propostos...).',
'ical_texte_public' => 'Este calend&aacute;rio permite acompanhar a actividade p&uacute;blica deste s&iacute;tio (artigos e not&iacute;cias publicados).',
'ical_texte_rss' => 'Pode vincular as novidades deste s&iacute;tio em qualquer leitor de ficheiros de formato XML/RSS (Rich Site Summary). &Eacute; tamb&eacute;m o formato que permite a SPIP ler as novidades publicadas em outros s&iacute;tios que utilizam um formato de troca compat&iacute;vel.',
'ical_titre_js' => 'Javascript',
'ical_titre_mailing' => 'Mailing-list',
'ical_titre_rss' => 'Ficheiros &laquo; backend &raquo;', # MODIF
'icone_activer_cookie' => 'Activar o cookie de correspond&ecirc;ncia',
'icone_admin_plugin' => 'Gestion des plugins', # NEW
'icone_afficher_auteurs' => 'Exibir os autores',
'icone_afficher_visiteurs' => 'Exibir os visitantes',
'icone_arret_discussion' => 'N&atilde;o voltar a participar nesta discuss&atilde;o',
'icone_calendrier' => 'Calend&aacute;rio',
'icone_creation_groupe_mots' => 'Criar um novo grupo de palavras',
'icone_creation_mots_cles' => 'Criar uma nova palavra-chave',
'icone_creer_auteur' => 'Criar um novo autor e associ&aacute;-lo a este artigo',
'icone_creer_mot_cle' => 'Criar uma nova palavra-chave e vincul&aacute;-la a este artigo',
'icone_creer_mot_cle_breve' => 'Cr&eacute;er un nouveau mot-cl&eacute; et le lier &agrave; cette br&egrave;ve', # NEW
'icone_creer_mot_cle_rubrique' => 'Cr&eacute;er un nouveau mot-cl&eacute; et le lier &agrave; cette rubrique', # NEW
'icone_creer_mot_cle_site' => 'Cr&eacute;er un nouveau mot-cl&eacute; et le lier &agrave; ce site', # NEW
'icone_creer_rubrique_2' => 'Criar uma nova rubrica',
'icone_ecrire_nouvel_article' => 'As not&iacute;cias contidas nesta rubrica',
'icone_envoyer_message' => 'Enviar esta mensagem',
'icone_evolution_visites' => 'Evolu&ccedil;&atilde;o das visitas <br />@visites@ visitas', # MODIF
'icone_modif_groupe_mots' => 'Modificar este grupo de palavras',
'icone_modifier_article' => 'Modificar este artigo',
'icone_modifier_breve' => 'Modificar esta not&iacute;cia',
'icone_modifier_message' => 'Modificar esta mensagem',
'icone_modifier_mot' => 'Modifier ce mot-cl&eacute;', # NEW
'icone_modifier_rubrique' => 'Modificar esta rubrica',
'icone_modifier_site' => 'Modificar este s&iacute;tio',
'icone_poster_message' => 'Enviar uma mensagem ',
'icone_publier_breve' => 'Publicar esta not&iacute;cia',
'icone_referencer_nouveau_site' => 'Referenciar um novo s&iacute;tio',
'icone_refuser_breve' => 'Recusar esta not&iacute;cia',
'icone_relancer_signataire' => 'Relancer le signataire', # NEW
'icone_retour' => 'voltar',
'icone_retour_article' => 'Voltar ao artigo',
'icone_suivi_forum' => 'Seguimento do f&oacute;rum p&uacute;blico&nbsp;: @nb_forums@&nbsp;contribui&ccedil;&atilde;o(&otilde;es)',
'icone_supprimer_cookie' => 'Suprimir o cookie de correspond&ecirc;ncia',
'icone_supprimer_groupe_mots' => 'Suprimir este grupo',
'icone_supprimer_rubrique' => 'Suprimir esta rubrica',
'icone_supprimer_signature' => 'Suprimir esta assinatura',
'icone_valider_signature' => 'Validar esta assinatura',
'icone_voir_sites_references' => 'Ver os s&iacute;tios referenciados',
'icone_voir_tous_mots_cles' => 'Ver todas as palavras-chave',
'image_administrer_rubrique' => 'Pode administrar esta rubrica',
'info_1_article' => '1 artigo',
'info_1_breve' => '1 not&iacute;cia',
'info_1_site' => '1 s&iacute;tio',
'info_activer_cookie' => 'Pode activar um <b>cookie de correspond&ecirc;ncia</b>, o que lhe
 permitir&aacute; passar facilmente do s&iacute;tio p&uacute;blico ao s&iacute;tio privado ',
'info_activer_forum_public' => '<i>Para activar os f&oacute;runs p&uacute;blicos, favor escolher o seu modo
  de modera&ccedil;&atilde;o por defeito </i>', # MODIF
'info_admin_gere_rubriques' => 'Este administrador gere as seguintes rubricas:',
'info_admin_gere_toutes_rubriques' => 'Este administrador gere <b>todas as rubricas</b>.',
'info_admin_statuer_webmestre' => 'Donner &agrave; cet administrateur les droits de webmestre', # NEW
'info_admin_webmestre' => 'Cet administrateur est <b>webmestre</b>', # NEW
'info_administrateur' => 'Administrador',
'info_administrateur_1' => 'Administrador',
'info_administrateur_2' => 'do s&iacute;tio (<i>utilize com precau&ccedil;&atilde;o</i>)',
'info_administrateur_site_01' => 'Se for o administrador do s&iacute;tio,favor',
'info_administrateur_site_02' => 'clicar sobre este v&iacute;nculo',
'info_administrateurs' => 'Administradores',
'info_administrer_rubrique' => 'Pode administrar esta rubrica',
'info_adresse' => 'ao endere&ccedil;o&nbsp;:',
'info_adresse_email' => 'ENDERE&Ccedil;O EMAIL&nbsp;:',
'info_adresse_url' => 'Endere&ccedil;o (URL) do s&iacute;tio p&uacute;blico',
'info_afficher_visites' => 'Exibir as visitas para&nbsp;:',
'info_affichier_visites_articles_plus_visites' => 'Exibir as visitas para <b>os artigos mais visitados desde o in&iacute;ciol&nbsp;:</b>',
'info_aide_en_ligne' => 'Ajuda em linha SPIP',
'info_ajout_image' => 'Quando acrescentar imagens como documentos ligados a um artigo,
 SPIP pode criar para si, automaticamente, vinhetas (miniaturas) das
 imagens inseridas. Isso permite por exemplo criar
 automaticamente uma galeria ou um portfolio.',
'info_ajout_participant' => 'O seguinte participante foi acrescentado&nbsp;:',
'info_ajouter_rubrique' => 'Acrescentar uma rubrica a administrar&nbsp;:',
'info_annonce_nouveautes' => 'An&uacute;ncio das novidades',
'info_anterieur' => 'anterior',
'info_appliquer_choix_moderation' => 'Aplicar esta escolha de modera&ccedil;&atilde;o&nbsp;:',
'info_article' => 'artigo',
'info_article_2' => 'artigos',
'info_article_a_paraitre' => 'Os artigos p&oacute;s-datados a publicar',
'info_articles_02' => 'artigos',
'info_articles_2' => 'Artigos',
'info_articles_auteur' => 'Os artigos deste autor',
'info_articles_lies_mot' => 'Os artigos ligados a esta palavra-chave',
'info_articles_trouves' => 'Artigos encontrados',
'info_articles_trouves_dans_texte' => 'Artigos encontrados (no texto)',
'info_attente_validation' => 'Os seus artigos &agrave; espera de valida&ccedil;&atilde;o',
'info_aujourdhui' => 'hoje&nbsp;:',
'info_auteur_message' => 'AUTOR DA MENSAGEM',
'info_auteurs' => 'Os autores',
'info_auteurs_par_tri' => 'Autores@partri@',
'info_auteurs_trouves' => 'Autores encontrados',
'info_authentification_externe' => 'Autentifica&ccedil;&atilde;o externa',
'info_avertissement' => 'Aviso',
'info_barre_outils' => 'avec sa barre d\'outils ?', # NEW
'info_base_installee' => 'A estrutura da sua base de dados est&aacute; instalada',
'info_base_restauration' => 'A base est&aacute; em curso de restauro',
'info_bloquer' => 'bloquear',
'info_breves' => 'O seu s&iacute;tio utiliza o sistema de not&iacute;cias',
'info_breves_03' => 'not&iacute;cias',
'info_breves_liees_mot' => 'As not&iacute;cias ligadas a esta palavra-chave',
'info_breves_touvees' => 'Not&iacute;cias encontradas',
'info_breves_touvees_dans_texte' => 'Not&iacute;cias encontradas (no texto)',
'info_changer_nom_groupe' => 'Modificar o nome deste grupo',
'info_chapeau' => 'Cabe&ccedil;alho',
'info_chapeau_2' => 'Cabe&ccedil;alho&nbsp;:',
'info_chemin_acces_1' => 'Op&ccedil;&otilde;es : <b>Caminho de acesso no anu&aacute;rio</b>', # MODIF
'info_chemin_acces_2' => 'Doravante, deve configurar o caminho de acesso &agrave;s informa&ccedil;&otilde;es no anu&aacute;rio. Esta informa&ccedil;&atilde;o &eacute; indispens&aacute;vel para ler os perfis de utilizador armazenados no anu&aacute;rio.',
'info_chemin_acces_annuaire' => 'Op&ccedil;&otilde;es : <b>Caminho de acesso no anu&aacute;rio', # MODIF
'info_choix_base' => 'Terceira etapa&nbsp;:',
'info_classement_1' => '<sup>er</sup> no @liste@',
'info_classement_2' => '<sup>e</sup> no @liste@',
'info_code_acces' => 'N&atilde;o se esque&ccedil;a dos seus pr&oacute;prios c&oacute;digos de acesso&nbsp;!',
'info_comment_lire_tableau' => 'Como ler este quadro',
'info_compresseur_gzip' => '<b>N.&nbsp;B.&nbsp;:</b> Il est recommand&#233; de v&#233;rifier au pr&#233;alable si l\'h&#233;bergeur compresse d&#233;j&#224; syst&#233;matiquement les scripts php&nbsp;; pour cela, vous pouvez par exemple utiliser le service suivant&nbsp;: @testgzip@', # NEW
'info_compresseur_texte' => 'Si votre serveur ne comprime pas automatiquement les pages html pour les envoyer aux internautes, vous pouvez essayer de forcer cette compression pour diminuer le poids des pages t&eacute;l&eacute;charg&eacute;es. <b>Attention</b> : cela peut ralentir considerablement certains serveurs.', # NEW
'info_compresseur_titre' => 'Optimisations et compression', # NEW
'info_config_forums_prive' => 'Dans l&#8217;espace priv&#233; du site, vous pouvez activer plusieurs types de forums&nbsp;:', # NEW
'info_config_forums_prive_admin' => 'Un forum r&#233;serv&#233; aux administrateurs du site&nbsp;:', # NEW
'info_config_forums_prive_global' => 'Un forum global, ouvert &#224; tous les r&#233;dacteurs&nbsp;:', # NEW
'info_config_forums_prive_objets' => 'Un forum sous chaque article, br&#232;ve, site r&#233;f&#233;renc&#233;, etc.&nbsp;:', # NEW
'info_config_suivi' => 'Se este endere&ccedil;o corresponder a uma mailing-list, pode indicar, a seguir, o endere&ccedil;o no qual os participantes no s&iacute;tio podem inscrever-se. Este endere&ccedil;o pode ser uma URL (por exemplo a p&aacute;gina de inscri&ccedil;&atilde;o na lista pela Web), ou um endere&ccedil;o email com um assunto espec&iacute;fico (por exemplo: <tt>@adresse_suivi@?subject=subscribe</tt>):',
'info_config_suivi_explication' => ' Pode assinar a  mailing-list deste s&iacute;tio. Receber&aacute; ent&atilde;o, por correio electr&oacute;nico, os an&uacute;ncios de artigos e de not&iacute;cias propostos para publica&ccedil;&atilde;o.',
'info_confirmer_passe' => 'Confirmar esta nova palavra-passe',
'info_conflit_edition_avis_non_sauvegarde' => 'Attention, les champs suivants ont &#233;t&#233; modifi&#233;s par ailleurs. Vos modifications sur ces champs n\'ont donc pas &#233;t&#233; enregistr&#233;es.', # NEW
'info_conflit_edition_differences' => 'Diff&#233;rences&nbsp;:', # NEW
'info_conflit_edition_version_enregistree' => 'La version enregistr&#233;e&nbsp;:', # NEW
'info_conflit_edition_votre_version' => 'Votre version&nbsp;:', # NEW
'info_connexion_base' => 'Segunda etapa: <b>Teste de liga&ccedil;&atilde;o &agrave; base</b>', # MODIF
'info_connexion_base_donnee' => 'Connexion &agrave; votre base de donn&eacute;es', # NEW
'info_connexion_ldap_ok' => 'A liga&ccedil;&atilde;o LDAP foi bem sucedida.</b><p> Pode passar para a etapa seguinte.</p>', # MODIF
'info_connexion_mysql' => 'Primeira etapa : <b>A sua liga&ccedil;&atilde;o SQL<b>', # MODIF
'info_connexion_ok' => 'A liga&ccedil;&atilde;o foi bem sucedida.',
'info_contact' => 'Contacto',
'info_contenu_articles' => 'Conte&uacute;do dos artigos',
'info_creation_mots_cles' => 'Crie e configure aqui as palavras-chave do s&iacute;tio',
'info_creation_paragraphe' => '(Para criar par&aacute;grafos, deixe simplesmente linhas vazias.)',
'info_creation_rubrique' => 'Antes de poder escrever artigos, <br />deve criar pelo menos uma rubrica.<br />', # MODIF
'info_creation_tables' => 'Quarta etapa : <b>Cria&ccedil;&atilde;o das tabelas da base<b>', # MODIF
'info_creer_base' => '<b>Criar</b> uma nova base de dados', # MODIF
'info_dans_groupe' => 'No grupo :',
'info_dans_rubrique' => 'Na rubrica :',
'info_date_publication_anterieure' => 'Data de publica&ccedil;&atilde;o anterior:',
'info_date_referencement' => 'DATA DE REFERENCIAMENTO DESTE S&Iacute;TIO&nbsp;:',
'info_delet_mots_cles' => 'Pediu para suprimir a palavra-chave
<b>@titre_mot@</b> (@type_mot@). Esta palavra-chave estando ligada a
 <b>@texte_lie@</b> deve confirmar esta decis&atilde;o&nbsp;:', # MODIF
'info_derniere_etape' => '&Uacute;ltima etapa : <b>Acabou !', # MODIF
'info_derniere_syndication' => 'A &uacute;ltima vincula&ccedil;&atilde;o deste s&iacute;tio foi efectuada a',
'info_derniers_articles_publies' => 'Os seus &uacute;ltimos artigos publicados em linha',
'info_desactiver_forum_public' => 'Desactivar a utiliza&ccedil;&atilde;o dos f&oacute;runs
 p&uacute;blicos. Os f&oacute;runs p&uacute;blicos poder&atilde;o ser autorizados caso a caso
 nos artigos ; ser&atilde;o proibidos nas rubricas, not&iacute;cias, etc.',
'info_desactiver_messagerie_personnelle' => 'Pode activar ou desactivar o seu correio pessoal neste s&iacute;tio.',
'info_descriptif' => 'Descri&ccedil;&atilde;o:',
'info_desinstaller_plugin' => 'supprime les donn&eacute;es et d&eacute;sactive le plugin', # NEW
'info_discussion_cours' => 'Discuss&otilde;es em curso',
'info_ecrire_article' => 'Antes de poder escrever artigos, deve criar pelo menos uma rubrica.',
'info_email_envoi' => 'Endere&ccedil;o de email de envio (opcional)',
'info_email_envoi_txt' => 'Indique aqui o endere&ccedil;o a utilizar para mandar os emails (se n&atilde;o for o caso, o endere&ccedil;o do destinat&aacute;rio ser&aacute; utilizado como endere&ccedil;o de envio)&nbsp;:',
'info_email_webmestre' => 'Endere&ccedil;o e-mail do webmestre (opcional)',
'info_entrer_code_alphabet' => 'Insira o c&oacute;digo do alfabeto a utilizar&nbsp;:',
'info_envoi_email_automatique' => 'Envio autom&aacute;tico de mails',
'info_envoi_forum' => 'Envio dos f&oacute;runs aos autores dos artigos',
'info_envoyer_maintenant' => 'Enviar agora',
'info_erreur_restauration' => 'Erro de restauro : ficheiro inexistente',
'info_etape_suivante' => 'Passar para a seguinte etapa',
'info_etape_suivante_1' => 'Pode passar para a etapa seguinte',
'info_etape_suivante_2' => 'Pode passar para a etapa seguinte',
'info_exportation_base' => 'exporta&ccedil;&atilde;o da base para @archive@',
'info_facilite_suivi_activite' => 'A fim de facilitar o acompanhamento da actividade
 editorial do s&iacute;tio, SPIP pode fazer chegar por email, por exemplo
 a uma <i>mailing-list</i> dos redactores, o an&uacute;ncio dos pedidos de
 publica&ccedil;&atilde;o e das valida&ccedil;&otilde;es de artigos.',
'info_fichiers_authent' => 'Ficheiros de autentica&ccedil;&atilde;o &laquo;&nbsp;.htpasswd&nbsp;&raquo;',
'info_fonctionnement_forum' => 'Funcionamento do f&oacute;rum&nbsp;:',
'info_forum_administrateur' => 'f&oacute;rum dos administradores',
'info_forum_interne' => 'f&oacute;rum interno',
'info_forum_ouvert' => 'No espa&ccedil;o privado do s&iacute;tio, um f&oacute;rum est&aacute; aberto a todos
 os redactores registados. Pode, a seguir, activar um
 f&oacute;rum suplementar, reservado apenas aos administradores',
'info_forum_statistiques' => 'Estat&iacute;sticas das visitas',
'info_forums_abo_invites' => 'O seu site cont&eacute;m f&oacute;runs por assinatura; os visitantes s&atilde;o convidados a registar-se no site p&uacute;blico.',
'info_gauche_admin_effacer' => '<b>Esta p&aacute;gina &eacute; acess&iacute;vel apenas aos respons&aacute;veis pelo site.</b><p> Ela d&aacute; acesso &agrave;s diferentes fun&ccedil;&otilde;es de manuten&ccedil;&atilde;o t&eacute;cnica. Algumas dessas fun&ccedil;&otilde;es possuem um processo espec&iacute;fico de autentica&ccedil;&atilde;o que exige acesso FTP ao website.</p>', # MODIF
'info_gauche_admin_tech' => '<b>Esta p&aacute;gina est&aacute; acess&iacute;vel apenas aos respons&aacute;veis pelo site.</b><p> Ela d&aacute; acesso &agrave;s diferentes fun&ccedil;&otilde;es de manuten&ccedil;&atilde;o t&eacute;cnica. Algumas dessas fun&ccedil;&otilde;es possuem um processo espec&iacute;fico de autentica&ccedil;&atilde;o que exige acesso FTP ao website.</p>', # MODIF
'info_gauche_admin_vider' => '<b>Esta p&aacute;gina &eacute; acess&iacute;vel apenas aos respons&aacute;veis pelo site.</b><p> Ela d&aacute; acesso &agrave;s diferentes fun&ccedil;&otilde;es de manuten&ccedil;&atilde;o t&eacute;cnica. Algumas dessas fun&ccedil;&otilde;es possuem um processo espec&iacute;fico de autentica&ccedil;&atilde;o que exige acesso FTP ao website</p>', # MODIF
'info_gauche_auteurs' => 'Encontrar&aacute; aqui todos os autores do site.
Os estatuto dos autores &eacute; indicado pela cor dos &iacute;cones (administrador = verde; redactor = amarelo).',
'info_gauche_auteurs_exterieurs' => 'Os autores externos, sem acesso ao s&iacute;tio, s&atilde;o indicados por um &iacute;cone azul&nbsp;;
 os autores apagados, por um caixote de lixo.',
'info_gauche_messagerie' => 'A caixa de correio permite-lhe trocar mensagens entre redactores, conservar memorandos (para o seu uso pessoal) ou exibir an&uacute;ncios na p&aacute;gina de abertura do espa&ccedil;o privado ( se for administrador).',
'info_gauche_numero_auteur' => 'AUTOR N&Uacute;MERO',
'info_gauche_numero_breve' => 'NOT&Iacute;CIA N&Uacute;MERO',
'info_gauche_statistiques_referers' => 'Esta p&aacute;gina apresenta a lista dos  <i>referers</i>, ou seja, dos sites que cont&ecirc;m links para o seu site, unicamente para ontem e hoje; esta lista &eacute; actualizada a cada 24 horas.',
'info_gauche_suivi_forum' => 'A p&aacute;gina de <i>acompanhamento dos f&oacute;runs </i> &eacute; um instrumento de gest&atilde;o do seu s&iacute;tio (e n&atilde;o um espa&ccedil;o de discuss&atilde;o ou de redac&ccedil;&atilde;o). Exibe todas as contribui&ccedil;&otilde;es do f&oacute;rum p&uacute;blico deste artigo e permite-lhe gerir essas contribui&ccedil;&otilde;es. ', # MODIF
'info_gauche_suivi_forum_2' => 'A p&aacute;gina <i>acompanhamento dos f&oacute;runs </i> &eacute; um instrumento de gest&atilde;o do seu s&iacute;tio (e n&atilde;o um espa&ccedil;o de discuss&atilde;o ou de redac&ccedil;&atilde;o). Exibe todas as contribui&ccedil;&otilde;es do f&oacute;rum p&uacute;blico deste artigo e permite-lhe gerir essas contribui&ccedil;&otilde;es. ', # MODIF
'info_gauche_visiteurs_enregistres' => 'Encontrar&aacute; aqui os visitantes registados
 no espa&ccedil;o p&uacute;blico do s&iacute;tio (f&oacute;runs por assinatura).',
'info_generation_miniatures_images' => 'Gera&ccedil;&atilde;o de miniaturas das imagens',
'info_gerer_trad' => 'Gerir os v&iacute;nculos de tradu&ccedil;&atilde;o?',
'info_groupe_important' => 'Grupo importante',
'info_hebergeur_desactiver_envoi_email' => 'Alguns servi&ccedil;os de hospedagem desactivam o envio autom&aacute;tico de
 mails a partir dos seus  servidores. Nesse caso, as seguintes
 funcionalidades de SPIP n&atilde;o funcionar&atilde;o.',
'info_hier' => 'ontem&nbsp;:',
'info_historique' => 'Revis&otilde;es&nbsp;:',
'info_historique_activer' => 'Activar o acompanhamento das revis&otilde;es',
'info_historique_affiche' => 'Visualizar esta vers&atilde;o',
'info_historique_comparaison' => 'compara&ccedil;&atilde;o',
'info_historique_desactiver' => 'Desactivar o acompanhamento das revis&otilde;es',
'info_historique_lien' => 'Visualizar o hist&oacute;rico de altera&ccedil;&otilde;es',
'info_historique_texte' => 'O acompanhamento das revis&otilde;es permite conservar um hist&oacute;rico de todas as  altera&ccedil;&otilde;es realizadas ao conte&uacute;do dum artigo, e visualizar as diferen&ccedil;as entre as sucessivas vers&otilde;es',
'info_historique_titre' => 'Acompanhamento das revis&otilde;es',
'info_identification_publique' => 'A sua identidade p&uacute;blica...',
'info_image_process' => 'Seleccione o melhor m&eacute;todo de criar as vinhetas clicando sobre a imagem correspondente.',
'info_image_process2' => '<b>N.B.</b> <i> Se nenhuma imagem aparece, ent&atilde;o o servidor que alberga o seu s&iacute;tio n&atilde;o foi configurado para utilizar tais ferramentas. Se deseja utilizar essas fun&ccedil;&otilde;es, contacte o responsavel t&eacute;cnico e pe&ccedil;a as extens&otilde;es  &laquo;GD&raquo; ou &laquo;Imagick&raquo;.</i>',
'info_images_auto' => 'Imagens calculadas automaticamente',
'info_informations_personnelles' => 'Quinta etapa : <b>Informa&ccedil;&otilde;es pessoais<b>', # MODIF
'info_inscription_automatique' => 'Inscri&ccedil;&atilde;o autom&aacute;tica de novos redactores',
'info_jeu_caractere' => 'Jogo de car&aacute;cteres do s&iacute;tio',
'info_jours' => 'dias',
'info_laisser_champs_vides' => 'deixar estes campos vazios)',
'info_langues' => 'L&iacute;nguas do s&iacute;tio',
'info_ldap_ok' => 'A autentica&ccedil;&atilde;o LDAP est&aacute; instalada.',
'info_lien_hypertexte' => 'V&iacute;nculo hipertexto :',
'info_liens_syndiques_1' => 'la&ccedil;os vinculados',
'info_liens_syndiques_2' => 'est&atilde;o &agrave; espera de valida&ccedil;&atilde;o',
'info_liens_syndiques_3' => 'f&oacute;runs',
'info_liens_syndiques_4' => 's&atilde;o',
'info_liens_syndiques_5' => 'forum',
'info_liens_syndiques_6' => '&eacute;',
'info_liens_syndiques_7' => '&agrave; espera de valida&ccedil;&atilde;o',
'info_liste_redacteurs_connectes' => 'Lista dos redactores ligados',
'info_login_existant' => 'Este login j&aacute; existe.',
'info_login_trop_court' => 'Login demasiado curto.',
'info_logos' => 'Les logos', # NEW
'info_maximum' => 'm&aacute;ximo&nbsp;:',
'info_meme_rubrique' => 'Na mesma rubrica',
'info_message' => 'Mensagem do',
'info_message_efface' => 'MENSAGEM APAGADA',
'info_message_en_redaction' => 'As suas mensagens em curso de redac&ccedil;&atilde;o',
'info_message_technique' => 'Mensagem t&eacute;cnica:',
'info_messagerie_interne' => 'Correio interno',
'info_mise_a_niveau_base' => 'nivela&ccedil;&atilde;o da sua base SQL', # MODIF
'info_mise_a_niveau_base_2' => '{{Aten&ccedil;&atilde;o!}} Instalou uma vers&atilde;o
 dos ficheiros SPIP {anterior} &agrave; que se encontrava
 antes neste s&iacute;tio: a sua base de dados corre o risco de se perder
 e o seu s&iacute;tio j&aacute; n&atilde;o funcionar&aacute; .<br />{{Re-instalar os
 ficheiros de SPIP.}}', # MODIF
'info_mode_fonctionnement_defaut_forum_public' => 'Modo de funcionamento por defeito dos f&oacute;runs p&uacute;blicos',
'info_modifier_auteur' => 'Modifier l\'auteur :', # NEW
'info_modifier_breve' => 'Modificar a not&iacute;cia :',
'info_modifier_mot' => 'Modifier le mot-cl&eacute; :', # NEW
'info_modifier_rubrique' => 'Modificar a rubrica :',
'info_modifier_titre' => 'Modificar : @titre@',
'info_mon_site_spip' => 'O meu s&iacute;tio SPIP',
'info_mot_sans_groupe' => '(Palavras sem grupo...)',
'info_moteur_recherche' => 'Motor integrado de pesquisa',
'info_mots_cles' => 'As palavras-chave',
'info_mots_cles_association' => 'As palavras-chave deste grupo podem ser associadas&nbsp;:',
'info_moyenne' => 'm&eacute;dia&nbsp;:',
'info_multi_articles' => 'Activar o menu de l&iacute;ngua sobre os artigos&nbsp;?',
'info_multi_cet_article' => 'L&iacute;ngua deste artigo&nbsp;:',
'info_multi_langues_choisies' => 'Favor seleccionar a seguir as l&iacute;nguas &agrave; disposi&ccedil;&atilde;o dos redactores do seu s&iacute;tio.
 As l&iacute;nguas j&aacute; utilizadas no seu s&iacute;tio (exibidas em primeiro lugar) n&atilde;o podem ser desactivadas.',
'info_multi_rubriques' => 'Activar o menu de l&iacute;ngua sobre as rubricas&nbsp;? ',
'info_multi_secteurs' => '... s&oacute; para as rubricas situadas na ra&iacute;z&nbsp;?',
'info_nom' => 'Nome',
'info_nom_destinataire' => 'Nome do destinat&aacute;rio',
'info_nom_site' => 'Nome do seu s&iacute;tio',
'info_nom_site_2' => '<b>Nome do s&iacute;tio</b> [Obrigat&oacute;rio]',
'info_nombre_articles' => '@nb_articles@ artigos,',
'info_nombre_breves' => '@nb_breves@ not&iacute;cias,',
'info_nombre_partcipants' => 'PARTICIPANTES NA DISCUSS&Atilde;O :',
'info_nombre_rubriques' => '@nb_rubriques@ rubricas,',
'info_nombre_sites' => '@nb_sites@ s&iacute;tios,',
'info_non_deplacer' => 'N&atilde;o deslocar...',
'info_non_envoi_annonce_dernieres_nouveautes' => 'SPIP pode enviar regularmente o an&uacute;ncio das &uacute;ltimas novidades do s&iacute;tio
 (artigos e not&iacute;cias recentemente publicados).',
'info_non_envoi_liste_nouveautes' => 'N&atilde;o enviar a lista das novidades',
'info_non_modifiable' => 'n&atilde;o pode ser modificado',
'info_non_suppression_mot_cle' => 'n&atilde;o quero suprimir esta palavra-chave.',
'info_notes' => 'Notas',
'info_nouveaux_message' => 'Novas mensagens',
'info_nouvel_article' => 'Novo artigo',
'info_nouvelle_traduction' => 'Nova tradu&ccedil;&atilde;o&nbsp;:',
'info_numero_article' => 'ARTIGO N&Uacute;MERO&nbsp;:',
'info_obligatoire_02' => '[Obigat&oacute;rio]',
'info_option_accepter_visiteurs' => 'Aceitar a inscri&ccedil;&atilde;o de visitantes do site p&uacute;blico',
'info_option_email' => 'Quando um visitante do s&iacute;tio deixa uma nova mensagem no f&oacute;rum
 ligado a um artigo, os autores do artigo podem ser
 avisados por e-mail. Deseja utilizar essa op&ccedil;&atilde;o&nbsp;?', # MODIF
'info_option_faire_suivre' => 'Fazer seguir as mensagens dos f&oacute;runs para os autores dos artigos',
'info_option_ne_pas_accepter_visiteurs' => 'Recusar a inscri&ccedil;&atilde;o dos visitantes',
'info_option_ne_pas_faire_suivre' => 'N&atilde;o fazer seguir as mensagens dos f&oacute;runs',
'info_options_avancees' => 'OP&Ccedil;&Otilde;ES AVAN&Ccedil;ADAS',
'info_ortho_activer' => 'Activar o corrector ortogr&aacute;fico',
'info_ortho_desactiver' => 'Desactivar o corrector ortogr&aacute;fico',
'info_ou' => 'ou...',
'info_oui_suppression_mot_cle' => 'quero suprimir definitivamente esta palavra-chave.',
'info_page_interdite' => 'P&aacute;gina proibida',
'info_par_nom' => 'par nom', # NEW
'info_par_nombre_article' => '(por n&uacute;mero de artigos)', # MODIF
'info_par_statut' => 'par statut', # NEW
'info_par_tri' => '\'(par @tri@)\'', # NEW
'info_pas_de_forum' => 'n&atilde;o h&aacute; f&oacute;rum',
'info_passe_trop_court' => 'Palavra-passe demasiado curta',
'info_passes_identiques' => 'As duas palavras-passe n&atilde;o s&atilde;o id&ecirc;nticas.',
'info_pense_bete_ancien' => 'Os seus antigos memorandos', # MODIF
'info_plus_cinq_car' => 'mais de 5 car&aacute;cteres',
'info_plus_cinq_car_2' => '(Mais de 5 car&aacute;cteres)',
'info_plus_trois_car' => '(Mais de 3 car&aacute;cteres)',
'info_popularite' => 'popularidade&nbsp;:&nbsp;@popularite@&nbsp;; visitas&nbsp;:&nbsp;@visites@',
'info_popularite_2' => 'popularidade do s&iacute;tio&nbsp;:',
'info_popularite_3' => 'popularidade&nbsp;:&nbsp;@popularite@&nbsp;; visitas&nbsp;:&nbsp;@visites@',
'info_popularite_4' => 'popularidade&nbsp;:&nbsp;@popularite@&nbsp;; visitas&nbsp;:&nbsp;@visites@',
'info_post_scriptum' => 'Post-Scriptum',
'info_post_scriptum_2' => 'Post-scriptum :',
'info_pour' => 'para',
'info_preview_admin' => 'Apenas os administradores podem visualizar o site',
'info_preview_comite' => 'Todos os redactores podem visualizar o site',
'info_preview_desactive' => 'A visualiza&ccedil;&atilde;o est&aacute; totalmente desactivada',
'info_preview_texte' => '&Eacute; poss&iacute;vel visualizar o site como se todas os artigos e notas (tendo pelo menos o estatuto de &laquo;proposta&raquo;) estivessem publicados. Esta possibilidade deve estar dispon&iacute;vel apenas para os administradores, para todos os redactores, ou para ningu&eacute;m?',
'info_principaux_correspondants' => 'Os seus principais correspondentes',
'info_procedez_par_etape' => 'proceder etapa por etapa',
'info_procedure_maj_version' => 'o procedimento de actualiza&ccedil;&atilde;o deve ser lan&ccedil;ado para adaptar
a base de dados &agrave; nova vers&atilde;o de SPIP.',
'info_proxy_ok' => 'Test du proxy r&eacute;ussi.', # NEW
'info_ps' => 'P.S', # MODIF
'info_publier' => 'publicar',
'info_publies' => 'Os seus artigos publicados em linha',
'info_question_accepter_visiteurs' => 'Se os par&acirc;metros do seu site prev&ecirc;em o registo de visitantes sem acesso ao espa&ccedil;o privado, por favor, active a op&ccedil;&atilde;o abaixo:',
'info_question_activer_compactage_css' => 'Souhaitez-vous activer le compactage des feuilles de style (CSS) ?', # NEW
'info_question_activer_compactage_js' => 'Souhaitez-vous activer le compactage des scripts (javascript) ?', # NEW
'info_question_activer_compresseur' => 'Voulez-vous activer la compression du flux HTTP ?', # NEW
'info_question_gerer_statistiques' => 'O seu s&iacute;tio deve gerir as estat&iacute;sticas das visitas&nbsp;?',
'info_question_inscription_nouveaux_redacteurs' => 'Aceita as inscri&ccedil;&otilde;es de novos redactores a
 partir do s&iacute;tio p&uacute;blico&nbsp;? Se aceitar, os visitantes poder&atilde;o inscrever-se
 a partir de um formul&aacute;rio automatizado e aceder&atilde;o ent&atilde;o ao espa&ccedil;o privado para
propor os seus pr&oacute;prios artigos. <blockquote><i>Durante a fase de inscri&ccedil;&atilde;o,
 os utilizadores recebem um correio electr&oacute;nico autom&aacute;tico
fornecendo-lhes os seus c&oacute;digos de acesso ao s&iacute;tio privado.Alguns
servi&ccedil;os de hospedagem desactivam o envio de mails a partir dos seus
 servidores&nbsp;: nesse caso, a inscri&ccedil;&atilde;o autom&aacute;tica &eacute;
 imposs&iacute;vel.', # MODIF
'info_question_mots_cles' => 'Deseja utilizar as palavras-chave no seu s&iacute;tio&nbsp;?',
'info_question_proposer_site' => 'Quem pode propor s&iacute;tios referenciados&nbsp;?',
'info_question_utilisation_moteur_recherche' => 'Deseja utilizar o motor integrado de pesquisa a SPIP&nbsp;?
(desactiv&aacute;-lo acelera o funcionamento do sistema)',
'info_question_vignettes_referer' => 'Lorsque vous consultez les statistiques, vous pouvez visualiser des aper&ccedil;us des sites d\'origine des visites', # NEW
'info_question_vignettes_referer_non' => 'Ne pas afficher les captures des sites d\'origine des visites', # NEW
'info_question_vignettes_referer_oui' => 'Afficher les captures des sites d\'origine des visites', # NEW
'info_question_visiteur_ajout_document_forum' => 'Si vous souhaitez autoriser les visiteurs &#224; joindre des documents (images, sons...) &#224; leurs messages de forum, indiquer ci-dessous la liste des extensions de documents autoris&#233;s pour les forums (ex: gif, jpg, png, mp3).', # NEW
'info_question_visiteur_ajout_document_forum_format' => 'Si vous souhaitez autoriser tous les types de documents consid&eacute;r&eacute;s comme fiables par SPIP, mettre une &eacute;toile. Pour ne rien autoriser, ne rien indiquer.', # NEW
'info_qui_attribue_mot_cle' => 'As palavras deste grupo podem ser atribuidas por&nbsp;:',
'info_racine_site' => 'Raiz do s&iacute;tio',
'info_recharger_page' => 'Favor voltar a carregar esta p&aacute;gina daqui a pouco.',
'info_recherche_auteur_a_affiner' => 'Demasiados resultados para "@cherche_auteur@" ; favor afinar a pesquisa.',
'info_recherche_auteur_ok' => 'Muitos redactores encontrados para "@cherche_auteur@":',
'info_recherche_auteur_zero' => 'Nenhum resultado para "@cherche_auteur@".',
'info_recommencer' => 'Favor recome&ccedil;ar',
'info_redacteur_1' => 'Redactor',
'info_redacteur_2' => 'tendo acesso ao espa&ccedil;o privado(<i>recomendado</i>)',
'info_redacteurs' => 'Redactores',
'info_redaction_en_cours' => 'EM CURSO DE REDAC&Ccedil;&Atilde;O',
'info_redirection' => 'Redirigir',
'info_referencer_doc_distant' => 'Referenciar um documento na internet&nbsp;:',
'info_refuses' => 'Os seus artigos recusados',
'info_reglage_ldap' => 'Op&ccedil;&otilde;es : <b>Acerto da importa&ccedil;&atilde;o LDAP</b>', # MODIF
'info_renvoi_article' => '<b>Redirigir.</b> Este artigo remete para a p&aacute;gina:', # MODIF
'info_reserve_admin' => 'S&oacute; os administradores podem modificar este endere&ccedil;o.',
'info_restauration_sauvegarde' => 'restauro da salvaguarda @archive@', # MODIF
'info_restauration_sauvegarde_insert' => 'Insertion de @archive@ dans la base', # NEW
'info_restreindre_rubrique' => 'Limitar a gest&atilde;o &agrave; rubrica : ',
'info_resultat_recherche' => 'Resultados da pesquisa ;',
'info_rubriques' => 'Rubricas',
'info_rubriques_02' => 'rubricas',
'info_rubriques_liees_mot' => 'As rubricas ligadas a esta palavra-chave',
'info_rubriques_trouvees' => 'Rubricas encontradas',
'info_rubriques_trouvees_dans_texte' => 'Rubricas encontradas (no texto)',
'info_sans_titre' => 'Sem t&iacute;tulo',
'info_sauvegarde' => 'Salvaguarda',
'info_sauvegarde_articles' => 'Salvaguardar os artigos',
'info_sauvegarde_articles_sites_ref' => 'Salvaguardar os artigos dos s&iacute;tios referenciados',
'info_sauvegarde_auteurs' => 'Salvaguardar os autores',
'info_sauvegarde_breves' => 'Salvaguardar as not&iacute;cias',
'info_sauvegarde_documents' => 'Salvaguardar os documentos',
'info_sauvegarde_echouee' => 'Se a salvaguarda falhar (&laquo;Maximum execution time exceeded&raquo;),',
'info_sauvegarde_forums' => 'Salvaguardar os f&oacute;runs',
'info_sauvegarde_groupe_mots' => 'Salvaguardar os grupos de palavras',
'info_sauvegarde_messages' => 'Salvaguardar as mensagens',
'info_sauvegarde_mots_cles' => 'Salvaguardar as palavras-chave',
'info_sauvegarde_petitions' => 'Salvaguardar os abaixo-assinados',
'info_sauvegarde_refers' => 'Salvaguardar os referers',
'info_sauvegarde_reussi_01' => 'Salvaguarda bem sucedida',
'info_sauvegarde_reussi_02' => 'A base foi salvaguardada em @archive@. Pode', # MODIF
'info_sauvegarde_reussi_03' => 'voltar &agrave; gest&atilde;o',
'info_sauvegarde_reussi_04' => 'do seu s&iacute;tio',
'info_sauvegarde_rubrique_reussi' => 'Les tables de la rubrique @titre@ ont &eacute;t&eacute; sauvegard&eacute;e dans @archive@. Vous pouvez', # NEW
'info_sauvegarde_rubriques' => 'Salvaguardar as rubricas',
'info_sauvegarde_signatures' => 'Salvaguardar as assinaturas de abaixo-assinados',
'info_sauvegarde_sites_references' => 'Salvaguardar os s&iacute;tios referenciados',
'info_sauvegarde_type_documents' => 'Salvaguardar os tipos de documentos',
'info_sauvegarde_visites' => 'Salvaguardar as visitas',
'info_selection_chemin_acces' => '<b>Seleccione</b> a seguir o caminho de acesso no anu&aacute;rio&nbsp;:',
'info_selection_un_seul_mot_cle' => 'S&oacute; se pode seleccionar <b>uma &uacute;nica palavra-chave ao</b> mesmo tempo neste grupo',
'info_signatures' => 'assinaturas',
'info_site' => 'S&iacute;tio',
'info_site_2' => 's&iacute;tio :',
'info_site_min' => 's&iacute;tio',
'info_site_propose' => 'S&iacute;tio proposto a :',
'info_site_reference_2' => 'S&iacute;tio referenciado',
'info_site_syndique' => 'Este s&iacute;tio est&aacute; vinculado....',
'info_site_valider' => 'S&iacute;tios a validar',
'info_site_web' => 'S&Iacute;TIO WEB :',
'info_sites' => 's&iacute;tios',
'info_sites_lies_mot' => 'Os s&iacute;tios referenciados ligados a esta palavra-chave',
'info_sites_proxy' => 'Utilizar um proxy',
'info_sites_refuses' => 'Os s&iacute;tios recusados ',
'info_sites_trouves' => 'S&iacute;tios encontrados',
'info_sites_trouves_dans_texte' => 'S&iacute;tios encontrados (no texto)',
'info_sous_titre' => 'Sub-t&iacute;tulo :',
'info_statut_administrateur' => 'Administrador',
'info_statut_auteur' => 'Estatuto deste autor :', # MODIF
'info_statut_auteur_a_confirmer' => 'Inscription &agrave; confirmer', # NEW
'info_statut_auteur_autre' => 'Autre statut&nbsp;:', # NEW
'info_statut_efface' => 'Apagado',
'info_statut_redacteur' => 'Redactor',
'info_statut_site_1' => 'Este s&iacute;tio &eacute;&nbsp;:',
'info_statut_site_2' => 'Publicado',
'info_statut_site_3' => 'Proposto',
'info_statut_site_4' => 'Para o caixote do lixo',
'info_statut_utilisateurs_1' => 'Estatuto por defeito dos utilizadores importados',
'info_statut_utilisateurs_2' => 'Escolha o estatuto atribu&iacute;do &agrave;s pessoas presentes no anu&aacute;rio LDAP quando elas se ligam pela primeira vez. Poder&aacute; depois modificar este valor para cada autor, caso a caso.',
'info_suivi_activite' => 'Acompanhamento da actividade editorial',
'info_supprimer_mot' => 'suprimir&nbsp;esta&nbsp;palavra',
'info_surtitre' => 'Antet&iacute;tulo',
'info_syndication_integrale_1' => 'Votre site propose des fichiers de syndication (voir &laquo;&nbsp;<a href="@url@">@titre@</a>&nbsp;&raquo;).', # NEW
'info_syndication_integrale_2' => 'Souhaitez-vous transmettre les articles dans leur int&eacute;gralit&eacute;, ou ne diffuser qu\'un r&eacute;sum&eacute; de quelques centaines de caract&egrave;res&nbsp;?', # NEW
'info_table_prefix' => 'Vous pouvez modifier le pr&eacute;fixe du nom des tables de donn&eacute;es (ceci est indispensable lorsque l\'on souhaite installer plusieurs sites dans la m&ecirc;me base de donn&eacute;es). Ce pr&eacute;fixe s\'&eacute;crit en lettres minuscules, non accentu&eacute;es, et sans espace.', # NEW
'info_taille_maximale_images' => 'SPIP va tester la taille maximale des images qu\'il peut traiter (en millions de pixels).<br /> Les images plus grandes ne seront pas r&eacute;duites.', # NEW
'info_taille_maximale_vignette' => 'Tamanho m&aacute;ximo das vinhetas geradas pelo sistema&nbsp;:',
'info_terminer_installation' => 'Pode agora acabar o procedimento de instala&ccedil;&atilde;o tipo.',
'info_texte' => 'Texto',
'info_texte_explicatif' => 'Texto explicativo',
'info_texte_long' => '(o texto &eacute; comprido&nbsp;: aparece, por isso, em muitas partes que ser&atilde;o coladas depois da valida&ccedil;&atilde;o.)',
'info_texte_message' => 'Texto da sua mensagem :',
'info_texte_message_02' => 'Texto da mensagem',
'info_titre' => 'T&iacute;tulo :',
'info_titre_mot_cle' => 'Nome ou t&iacute;tulo da palavra-chave',
'info_total' => 'total :',
'info_tous_articles_en_redaction' => 'Todos os artgos em curso de redac&ccedil;&atilde;o',
'info_tous_articles_presents' => 'Todos os artigos publicados nesta rubrica',
'info_tous_articles_refuses' => 'Tous les articles refus&eacute;s', # NEW
'info_tous_les' => 'todos os',
'info_tous_redacteurs' => 'An&uacute;ncios a todos os redactores',
'info_tout_site' => 'Todo o s&iacute;tio',
'info_tout_site2' => 'O artigo n&atilde;o est&aacute; traduzido nesta l&iacute;ngua.',
'info_tout_site3' => 'O artigo foi traduzido nesta l&iacute;ngua, mas foram feitas modifica&ccedil;&otilde;es ao artigo original. A tradu&ccedil;&atilde;o necessita ser actualizada.',
'info_tout_site4' => 'O artigo foi traduzido nesta l&iacute;ngua e a tradu&ccedil;&atilde;o est&aacute; actual.',
'info_tout_site5' => 'Artigo original.',
'info_tout_site6' => '<b>Aten&ccedil;&atilde;o:</b> s&oacute; os artigos originais s&atilde;o mostrados.
As tradu&ccedil;&otilde;es est&atilde;o associadas ao original,
numa cor que indica o seu estado:',
'info_travail_colaboratif' => 'Trabalho colaborativo sobre os artigos',
'info_un_article' => 'um artigo',
'info_un_mot' => 'Uma &uacute;nica palavra de cada vez',
'info_un_site' => 'um s&iacute;tio',
'info_une_breve' => 'uma not&iacute;cia,',
'info_une_rubrique' => 'uma rubrica,',
'info_une_rubrique_02' => '1 rubrica',
'info_url' => 'URL :', # MODIF
'info_url_site' => 'URL DO S&Iacute;TIO :', # MODIF
'info_urlref' => 'Liga&ccedil;&atilde;o hipertexto&nbsp;:',
'info_utilisation_spip' => 'Pode come&ccedil;ar agora a utilizar o sistema de publica&ccedil;&atilde;o assistida...',
'info_visites_par_mois' => 'Exibi&ccedil;&atilde;o por m&ecirc;s :',
'info_visites_plus_populaires' => 'Exibir as visitas para <b>os artigos mais populares</b> e para <b>os &uacute;ltimos artigos publicados&nbsp;:</b>',
'info_visiteur_1' => 'Visitante',
'info_visiteur_2' => 'do s&iacute;tio p&uacute;blico',
'info_visiteurs' => 'Visitantes',
'info_visiteurs_02' => 'Visitantes do s&iacute;tio p&uacute;blico',
'install_adresse_base_hebergeur' => 'Adresse de la base de donn&eacute;es attribu&eacute;e par l\'h&eacute;bergeur', # NEW
'install_base_ok' => 'La base @base@ a &eacute;t&eacute; reconnue', # NEW
'install_echec_annonce' => 'A instala&ccedil;&atilde;o vai provavelmente falhar,ou criar um s&iacute;tio n&atilde;o funcional',
'install_extension_mbstring' => 'O SPIP n&atilde;o funciona com&nbsp;:',
'install_extension_php_obligatoire' => 'O SPIP exige a extens&atilde;o php&nbsp;:',
'install_login_base_hebergeur' => 'Login de connexion attribu&eacute; par l\'h&eacute;bergeur', # NEW
'install_nom_base_hebergeur' => 'Nom de la base attribu&eacute; par l\'h&eacute;bergeur&nbsp;:', # NEW
'install_pas_table' => 'Base actuellement sans tables', # NEW
'install_pass_base_hebergeur' => 'Mot de passe de connexion attribu&eacute; par l\'h&eacute;bergeur', # NEW
'install_php_version' => 'PHP version @version@ insuffisant (minimum = @minimum@)', # NEW
'install_select_langue' => 'Seleccione uma l&iacute;ngua e depois clique no bot&atilde;o "&nbsp;seguinte&nbsp;" para lan&ccedil;ar o procedimento de instala&ccedil;&atilde;o.',
'install_select_type_db' => 'Indiquer le type de base de donn&eacute;es&nbsp;:', # NEW
'install_select_type_mysql' => 'MySQL', # NEW
'install_select_type_pg' => 'PostgreSQL', # NEW
'install_select_type_sqlite2' => 'SQLite 2', # NEW
'install_select_type_sqlite3' => 'SQLite 3', # NEW
'install_serveur_hebergeur' => 'Serveur de base de donn&eacute;es attribu&eacute; par l\'h&eacute;bergeur', # NEW
'install_table_prefix_hebergeur' => 'Pr&eacute;fixe de table attribu&eacute; par l\'h&eacute;bergeur&nbsp;:', # NEW
'install_tables_base' => 'Tables de la base', # NEW
'install_types_db_connus' => 'SPIP sait utiliser <b>MySQL</b> (le plus r&eacute;pandu), <b>PostgreSQL</b> et <b>SQLite</b>.', # NEW
'install_types_db_connus_avertissement' => 'Attention&nbsp;: plusieurs plugins ne fonctionnent qu\'avec MySQL', # NEW
'intem_redacteur' => 'redactor',
'intitule_licence' => 'Licence', # NEW
'item_accepter_inscriptions' => 'Aceitar as inscri&ccedil;&otilde;es',
'item_activer_forum_administrateur' => 'Activar o f&oacute;rum dos administradores',
'item_activer_messages_avertissement' => 'Activar as mensagens de aviso',
'item_administrateur_2' => 'administrador',
'item_afficher_calendrier' => 'Exibir o calend&aacute;rio',
'item_ajout_mots_cles' => 'Autorizar a adi&ccedil;&atilde;o de palavras-chave aos f&oacute;runs',
'item_autoriser_documents_joints' => 'Autorizar os documentos juntos aos artigos',
'item_autoriser_documents_joints_rubriques' => 'Autorizar os documentos nas rubricas',
'item_autoriser_selectionner_date_en_ligne' => 'Permettre de modifier la date de chaque document', # NEW
'item_autoriser_syndication_integrale' => 'Diffuser l\'int&eacute;gralit&eacute; des articles dans les fichiers de syndication', # NEW
'item_bloquer_liens_syndiques' => 'Impedir os la&ccedil;os vinculados para valida&ccedil;&atilde;o',
'item_breve_refusee' => 'N&Atilde;O - Not&iacute;cia recusada',
'item_breve_validee' => 'SIM - Not&iacute;cia validada',
'item_choix_administrateurs' => 'os administradores',
'item_choix_generation_miniature' => 'Gerar automaticamente as miniaturas das imagens.',
'item_choix_non_generation_miniature' => 'N&atilde;o gerar miniaturas das imagens.',
'item_choix_redacteurs' => 'os redactores',
'item_choix_visiteurs' => 'os visitadores do s&iacute;tio p&uacute;blico',
'item_compresseur' => 'Activer la compression', # NEW
'item_config_forums_prive_global' => 'Activer le forum des r&#233;dacteurs', # NEW
'item_config_forums_prive_objets' => 'Activer ces forums', # NEW
'item_creer_fichiers_authent' => 'Criar os ficheiros .htpasswd',
'item_desactiver_forum_administrateur' => 'Desactivar o f&oacute;rum dos administradores',
'item_gerer_annuaire_site_web' => 'Gerir um anu&aacute;rio de s&iacute;tios Web',
'item_gerer_statistiques' => 'Gerir as estat&iacute;sticas',
'item_limiter_recherche' => 'Limitar a pesquisa &agrave;s informa&ccedil;&otilde;es contidas no seu s&iacute;tio',
'item_login' => 'Login',
'item_messagerie_agenda' => 'Activer la messagerie et l&#8217;agenda', # NEW
'item_mots_cles_association_articles' => 'aos artigos',
'item_mots_cles_association_breves' => '&agrave;s not&iacute;cias',
'item_mots_cles_association_rubriques' => '&agrave;s rubricas',
'item_mots_cles_association_sites' => 'aos s&iacute;tios referenciados ou vinculados.',
'item_non' => 'N&atilde;o',
'item_non_accepter_inscriptions' => 'N&atilde;o aceitar as inscri&ccedil;&otilde;es',
'item_non_activer_messages_avertissement' => 'N&atilde;o h&aacute; mensagens de aviso',
'item_non_afficher_calendrier' => 'N&atilde;o exibir no calend&aacute;rio',
'item_non_ajout_mots_cles' => 'Proibir a utiliza&ccedil;&atilde;o das palavras-chave nos f&oacute;runs',
'item_non_autoriser_documents_joints' => 'N&atilde;o autorizar os documentos nos artigos',
'item_non_autoriser_documents_joints_rubriques' => 'N&atilde;o autorizar os documentos nas rubricas',
'item_non_autoriser_selectionner_date_en_ligne' => 'La date des documents est celle de leur ajout sur le site', # NEW
'item_non_autoriser_syndication_integrale' => 'Ne diffuser qu\'un r&eacute;sum&eacute;', # NEW
'item_non_bloquer_liens_syndiques' => 'N&atilde;o impedir os la&ccedil;os resultantes da vincula&ccedil;&atilde;o',
'item_non_compresseur' => 'D&#233;sactiver la compression', # NEW
'item_non_config_forums_prive_global' => 'D&#233;sactiver le forum des r&#233;dacteurs', # NEW
'item_non_config_forums_prive_objets' => 'D&#233;sactiver ces forums', # NEW
'item_non_creer_fichiers_authent' => 'N&atilde;o criar estes ficheiros',
'item_non_gerer_annuaire_site_web' => 'Desactivar o anu&aacute;rio de s&iacute;tios Web',
'item_non_gerer_statistiques' => 'N&atilde;o gerir as estat&iacute;sticas',
'item_non_limiter_recherche' => 'Alargar a pesquisa ao conte&uacute;do dos s&iacute;tios referenciados',
'item_non_messagerie_agenda' => 'D&#233;sactiver la messagerie et l&#8217;agenda', # NEW
'item_non_publier_articles' => 'N&atilde;o publicar os artigos antes da data de publica&ccedil;&atilde;o fixada.',
'item_non_utiliser_breves' => 'N&atilde;o utilizar as not&iacute;cias',
'item_non_utiliser_config_groupe_mots_cles' => 'N&atilde;o utilizar a configura&ccedil;&atilde;o avan&ccedil;ada dos grupos de palavras-chave',
'item_non_utiliser_moteur_recherche' => 'N&atilde;o utilizar o motor',
'item_non_utiliser_mots_cles' => 'N&atilde;o utilizar as palavras-chave',
'item_non_utiliser_syndication' => 'N&atilde;o utilizar a vincula&ccedil;&atilde;o autom&aacute;tica',
'item_nouvel_auteur' => 'Novo autor',
'item_nouvelle_breve' => 'Nova not&iacute;cia',
'item_nouvelle_rubrique' => 'Nova rubrica',
'item_oui' => 'Sim',
'item_publier_articles' => 'Publicar os artigos, seja qual for a sua data de publica&ccedil;&atilde;o.',
'item_reponse_article' => 'Resposta ao artigo',
'item_utiliser_breves' => 'Utilizar as not&iacute;cias',
'item_utiliser_config_groupe_mots_cles' => 'Utilizar a configura&ccedil;&atilde;o avan&ccedil;ada dos grupos de palavras-chave',
'item_utiliser_moteur_recherche' => 'Utilizar o motor de pesquisa',
'item_utiliser_mots_cles' => 'Utilizar as palavras-chave',
'item_utiliser_syndication' => 'Utilizar a vincula&ccedil;&atilde;o autom&aacute;tica',
'item_visiteur' => 'visitante',

// J
'jour_non_connu_nc' => 'n.c.',

// L
'ldap_correspondance' => 'h&eacute;ritage du champ @champ@', # NEW
'ldap_correspondance_1' => 'H&eacute;ritage des champs LDAP', # NEW
'ldap_correspondance_2' => 'Pour chacun des champs SPIP suivants, indiquer le nom du champ LDAP correspondant. Laisser vide pour ne pas le remplir, s&eacute;parer par des espaces ou des virgules pour essayer plusieurs champs LDAP.', # NEW
'lien_ajout_destinataire' => 'Acrescentar este destinat&aacute;rio',
'lien_ajouter_auteur' => 'Acrescentar este autor',
'lien_ajouter_participant' => 'Acrescentar um participante',
'lien_email' => 'email',
'lien_forum_public' => 'Gerir o f&oacute;rum p&uacute;blico deste artigo',
'lien_mise_a_jour_syndication' => 'Actualizar agora',
'lien_nom_site' => 'NOME DO S&Iacute;TIO',
'lien_nouvelle_recuperation' => 'Tentar uma nova recupera&ccedil;&atilde;o dos dados',
'lien_reponse_article' => 'Resposta ao artigo',
'lien_reponse_breve' => 'Resposta &agrave; not&iacute;cia',
'lien_reponse_breve_2' => 'Resposta &agrave; not&iacute;cia',
'lien_reponse_rubrique' => 'Resposta &agrave; rubrica ',
'lien_reponse_site_reference' => 'Resposta ao s&iacute;tio referenciado',
'lien_retirer_auteur' => 'Tirar o autor',
'lien_retrait_particpant' => 'tirar este participante',
'lien_site' => 's&iacute;tio',
'lien_supprimer_rubrique' => 'suprimir esta rubrica',
'lien_tout_deplier' => 'Expandir tudo',
'lien_tout_replier' => 'Recolher tudo',
'lien_tout_supprimer' => 'Tout supprimer', # NEW
'lien_trier_nom' => 'Seleccionar por nome',
'lien_trier_nombre_articles' => 'seleccionar por n&uacute;mero de artgos',
'lien_trier_statut' => 'Seleccionar por estatuto',
'lien_voir_en_ligne' => 'VER EM LINHA',
'logo_article' => 'LOGOTIPO DO ARTIGO',
'logo_auteur' => 'LOGOTIPO DO AUTOR ',
'logo_breve' => 'LOGOTIPO DA NOT&Iacute;CIA',
'logo_mot_cle' => 'LOGOTIPO DA PALAVRA-CHAVE ',
'logo_rubrique' => 'LOGOTIPO DA RUBRICA',
'logo_site' => 'LOGOTIPO DESTE S&Iacute;TIO',
'logo_standard_rubrique' => 'LOGOTIPO MODELO DAS RUBRICAS ',
'logo_survol' => 'LOGOTIPO PARA  LEITURA  R&Aacute;PIDA',

// M
'menu_aide_installation_choix_base' => 'Escolha da sua base',
'module_fichier_langue' => 'Ficheiro de l&iacute;ngua',
'module_raccourci' => 'Atalhos',
'module_texte_affiche' => 'Texto exibido',
'module_texte_explicatif' => 'Pode inserir os seguintes atalhos nos esqueletos do seu s&iacute;tio p&uacute;blico. Ser&atilde;o automaticamente traduzidos para as v&aacute;rias l&iacute;nguas nas quais h&aacute; um ficheiro de l&iacute;ngua.',
'module_texte_traduction' => 'O ficheiro de l&iacute;ngua &laquo;&nbsp;@module@&nbsp;&raquo; est&aacute; dispon&iacute;vel em&nbsp;:',
'mois_non_connu' => 'n&atilde;o conhecido',

// N
'nouvelle_version_spip' => 'La version @version@ de SPIP est disponible', # NEW

// O
'onglet_contenu' => 'Contenu', # NEW
'onglet_declarer_une_autre_base' => 'D&eacute;clarer une autre base', # NEW
'onglet_discuter' => 'Discuter', # NEW
'onglet_documents' => 'Documents', # NEW
'onglet_interactivite' => 'Interactivit&eacute;', # NEW
'onglet_proprietes' => 'Propri&eacute;t&eacute;s', # NEW
'onglet_repartition_actuelle' => 'actualmente',
'onglet_sous_rubriques' => 'Sous-rubriques', # NEW

// P
'page_pas_proxy' => 'Cette page ne doit pas passer par le proxy', # NEW
'pas_de_proxy_pour' => 'Au besoin, indiquez les machines ou domaines pour lesquels ce proxy ne doit pas s\'appliquer (par exemple&nbsp;: @exemple@)', # NEW
'plugin_charge_paquet' => 'Chargement du paquet @name@', # NEW
'plugin_charger' => 'T&#233;l&#233;charger', # NEW
'plugin_erreur_charger' => 'erreur&nbsp;: impossible de charger @zip@', # NEW
'plugin_erreur_droit1' => 'Le r&#233;pertoire <code>@dest@</code> n\'est pas accessible en &#233;criture.', # NEW
'plugin_erreur_droit2' => 'Veuillez v&#233;rifier les droits sur ce r&#233;pertoire (et le cr&#233;er le cas &#233;ch&#233;ant), ou installer les fichiers par FTP.', # NEW
'plugin_erreur_zip' => 'echec pclzip&nbsp;: erreur @status@', # NEW
'plugin_etat_developpement' => 'en d&eacute;veloppement', # NEW
'plugin_etat_experimental' => 'exp&eacute;rimental', # NEW
'plugin_etat_stable' => 'stable', # NEW
'plugin_etat_test' => 'en test', # NEW
'plugin_impossible_activer' => 'Impossible d\'activer le plugin @plugin@', # NEW
'plugin_info_automatique1' => 'Si vous souhaitez autoriser l\'installation automatique des plugins, veuillez&nbsp;:', # NEW
'plugin_info_automatique1_lib' => 'Si vous souhaitez autoriser l\'installation automatique de cette librairie, veuillez&nbsp;:', # NEW
'plugin_info_automatique2' => 'cr&#233;er un r&#233;pertoire <code>@rep@</code>&nbsp;;', # NEW
'plugin_info_automatique3' => 'v&#233;rifier que le serveur est autoris&#233; &#224; &#233;crire dans ce r&#233;pertoire.', # NEW
'plugin_info_automatique_creer' => '&#224; cr&#233;er &#224; la racine du site.', # NEW
'plugin_info_automatique_exemples' => 'exemples&nbsp;:', # NEW
'plugin_info_automatique_ftp' => 'Vous pouvez installer des plugins, par FTP, dans le r&#233;pertoire <tt>@rep@</tt>', # NEW
'plugin_info_automatique_lib' => 'Certains plugins demandent aussi &#224; pouvoir t&#233;l&#233;charger des fichiers dans le r&#233;pertoire <code>lib/</code>, &#224; cr&#233;er le cas &#233;ch&#233;ant &#224; la racine du site.', # NEW
'plugin_info_automatique_liste' => 'Vos listes de plugins&nbsp;:', # NEW
'plugin_info_automatique_liste_officielle' => 'les plugins officiels', # NEW
'plugin_info_automatique_liste_update' => 'Mettre &#224; jour les listes', # NEW
'plugin_info_automatique_ou' => 'ou...', # NEW
'plugin_info_automatique_select' => 'S&#233;lectionnez ci-dessous un plugin&nbsp;: SPIP le t&#233;l&#233;chargera et l\'installera dans le r&#233;pertoire <code>@rep@</code>&nbsp;; si ce plugin existe d&#233;j&#224;, il sera mis &#224; jour.', # NEW
'plugin_info_extension_1' => 'Les extensions ci-dessous sont charg&#233;es et activ&#233;es dans le r&#233;pertoire @extensions@.', # NEW
'plugin_info_extension_2' => 'Elles ne sont pas d&#233;sactivables.', # NEW
'plugin_info_telecharger' => '&#224; t&#233;l&#233;charger depuis @url@ et &#224; installer dans @rep@', # NEW
'plugin_librairies_installees' => 'Librairies install&#233;es', # NEW
'plugin_necessite_lib' => 'Ce plugin n&#233;cessite la librairie @lib@', # NEW
'plugin_necessite_plugin' => 'N&eacute;cessite le plugin @plugin@ en version @version@ minimum.', # NEW
'plugin_necessite_spip' => 'N&eacute;cessite SPIP en version @version@ minimum.', # NEW
'plugin_source' => 'source:&nbsp;', # NEW
'plugin_titre_automatique' => 'Installation automatique', # NEW
'plugin_titre_automatique_ajouter' => 'Ajouter des plugins', # NEW
'plugin_titre_installation' => 'Installation du plugin @plugin@', # NEW
'plugin_zip_active' => 'Continuez pour l\'activer', # NEW
'plugin_zip_adresse' => 'indiquez ci-dessous l\'adresse d\'un fichier zip de plugin &#224; t&#233;l&#233;charger, ou encore l\'adresse d\'une liste de plugins.', # NEW
'plugin_zip_adresse_champ' => 'Adresse du plugin ou de la liste&nbsp;', # NEW
'plugin_zip_content' => 'Il contient les fichiers suivants (@taille@),<br />pr&#234;ts &#224; installer dans le r&#233;pertoire <code>@rep@</code>', # NEW
'plugin_zip_installe_finie' => 'Le fichier @zip@ a &#233;t&#233; d&#233;compact&#233; et install&#233;.', # NEW
'plugin_zip_installe_rep_finie' => 'Le fichier @zip@ a &#233;t&#233; d&#233;compact&#233; et install&#233; dans le r&#233;pertoire @rep@', # NEW
'plugin_zip_installer' => 'Vous pouvez maintenant l\'installer.', # NEW
'plugin_zip_telecharge' => 'Le fichier @zip@ a &#233;t&#233; t&#233;l&#233;charg&#233;', # NEW
'plugins_actif_aucun' => 'Aucun plugin activ&#233;.', # NEW
'plugins_actif_un' => 'Un plugin activ&#233;.', # NEW
'plugins_actifs' => '@count@ plugins activ&#233;s.', # NEW
'plugins_actifs_liste' => 'Plugins actifs', # NEW
'plugins_compte' => '@count@ plugins', # NEW
'plugins_disponible_un' => 'Un plugin disponible.', # NEW
'plugins_disponibles' => '@count@ plugins disponibles.', # NEW
'plugins_erreur' => 'Erreur dans les plugins : @plugins@', # NEW
'plugins_liste' => 'Liste des plugins', # NEW
'plugins_liste_extensions' => 'Extensions', # NEW
'plugins_recents' => 'Plugins r&eacute;cents.', # NEW
'plugins_vue_hierarchie' => 'Hi&eacute;rarchie', # NEW
'plugins_vue_liste' => 'Liste', # NEW
'protocole_ldap' => 'Version du protocole :', # NEW

// R
'repertoire_plugins' => 'R&eacute;pertoire&nbsp;:', # NEW

// S
'sans_heure' => 'sans heure', # NEW
'sauvegarde_fusionner' => 'Fusionner la base actuelle et la sauvegarde', # NEW
'sauvegarde_fusionner_depublier' => 'D&eacute;publier les objets fusionn&eacute;s', # NEW
'sauvegarde_url_origine' => 'Eventuellement, URL du site d\'origine :', # NEW
'statut_admin_restreint' => '(admin restrito)',
'syndic_choix_moderation' => 'Que fazer com as novas liga&ccedil;&otilde;es provenientes deste s&iacute;tio&nbsp;?',
'syndic_choix_oublier' => 'Que fazer com as liga&ccedil;&otilde;es que n&atilde;o aparecem mais no ficheiro de sindica&ccedil;&atilde;o &nbsp;?',
'syndic_choix_resume' => 'Certains sites diffusent le texte complet des articles. Lorsque celui-ci est disponible souhaitez-vous syndiquer&nbsp;:', # NEW
'syndic_lien_obsolete' => 'liga&ccedil;&atilde;o desactualizada',
'syndic_option_miroir' => 'bloquear automaticamente',
'syndic_option_oubli' => 'eliminar (ap&oacute;s @m&ecirc;s@&nbsp;m&ecirc;s)',
'syndic_option_resume_non' => 'le contenu complet des articles (au format HTML)', # NEW
'syndic_option_resume_oui' => 'un simple r&eacute;sum&eacute; (au format texte)', # NEW
'syndic_options' => 'Op&ccedil;&otilde;es de sindica&ccedil;&atilde;o&nbsp;:',

// T
'taille_cache_image' => 'As imagens calculadas automaticamente pelo SPIP (miniaturas dos documentos, t&iacute;tulos apresentados sob forma gr&aacute;fica, fun&ccedil;&otilde;es matem&aacute;ticas no formato TeX...) ocupam no direct&oacute;rio @dir@ um total de @taille@.',
'taille_cache_infinie' => 'Este site n&atilde;o prev&ecirc; limita&ccedil;&atilde;o de tamanho do diret&oacute;rio <code>CACHE/</code>.', # MODIF
'taille_cache_maxi' => 'O SPIP tenta limitar o tamanho do diret&oacute;rio <code>CACHE/</code> deste site em cerca de <b>@octets@</b>.', # MODIF
'taille_cache_octets' => 'O tamanho da cache &eacute; atualmente de  @octets@.',
'taille_cache_vide' => 'A cache est&aacute; vazia.',
'taille_repertoire_cache' => 'Tamanho do direct&oacute;rio cache',
'text_article_propose_publication' => 'Artigo proposto para publica&ccedil;&atilde;o. N&atilde;o hesite em dar a sua opini&atilde;o gra&ccedil;as ao f&oacute;rum ligado a este artigo (no fundo da p&aacute;gina).', # MODIF
'text_article_propose_publication_forum' => 'N\'h&eacute;sitez pas &agrave; donner votre avis gr&acirc;ce au forum attach&eacute; &agrave; cet article (en bas de page).', # NEW
'texte_acces_ldap_anonyme_1' => 'Alguns servidores LDAP n&atilde;o aceitam nenhum acesso an&oacute;nimo. Nesse caso, &eacute; preciso especificar um identificador de acesso inicial a fim de poder depois procurar informa&ccedil;&otilde;es no anu&aacute;rio. Na maior parte dos casos, por&eacute;m, os seguintes campos poder&atilde;o ser deixados vazios.',
'texte_admin_effacer_01' => 'Este comando apaga <i>todo</i> o conte&uacute;do da base de dados,
inclusive <i>todos</i> os acessos de redactores e administradores. Depois de o ter executado, dever&aacute; lan&ccedil;ar a
reinstala&ccedil;&atilde;o de SPIP para recriar uma nova base assim como um primeiro acesso administrador.',
'texte_admin_effacer_stats' => 'Cette commande efface toutes les donn&eacute;es li&eacute;es aux statistiques de visite du site, y compris la popularit&eacute; des articles.', # NEW
'texte_admin_tech_01' => 'Esta op&ccedil;&atilde;o permite-lhe salvaguardar o conte&uacute;do da base num ficheiro que ser&aacute; armazenado no direct&oacute;rio @dossier@.N&atilde;o esquecer tamb&eacute;m recuperar a totalidade do direct&oacute;rio <i>IMG/</i>, que cont&eacute;m as imagens e os documentos utlizados nos artigos e rubricas.', # MODIF
'texte_admin_tech_02' => 'Aten&ccedil;&atilde;o: esta salvaguarda s&oacute; poder&aacute; ser restaurada
 num s&iacute;tio instalado sob a mesma vers&atilde;o de SPIP. Nunca apague a sua base de dados esperando que esta seja reinstalada ap&oacute;s a actualiza&ccedil;&atilde;o. Consulte <a href="@spipnet@">a documenta&ccedil;&atilde;o de SPIP</a>.', # MODIF
'texte_admin_tech_03' => 'Pode escolher a salvaguarda do ficheiro sob a forma comprimida, para
encurtar a sua transfer&ecirc;ncia para o seu computador ou para um servidor de salvaguarda e poupar o espa&ccedil;o do disco.',
'texte_admin_tech_04' => 'Dans un but de fusion avec une autre base, vous pouvez limiter la sauvegarde &agrave; la rubrique: ', # NEW
'texte_adresse_annuaire_1' => '(Se o seu anu&aacute;rio est&aacute; instalado na mesma m&aacute;quina que este s&iacute;tio Web, trata-se de &laquo;localhost&raquo;.)',
'texte_ajout_auteur' => 'O seguinte autor foi acrescentado ao artigo :',
'texte_annuaire_ldap_1' => 'Se tiver acesso a um anu&aacute;rio (LDAP), pode utiliz&aacute;-lo para importar automaticamente utilizadores sob SPIP.',
'texte_article_statut' => 'Este artigo est&aacute; :',
'texte_article_virtuel' => 'Artigo virtual',
'texte_article_virtuel_reference' => '<b>Artigo virtual&nbsp;:</b> artigo referenciado no seu s&iacute;tio SPIP, mas redirigido para uma outra URL. Para suprimir a redirec&ccedil;&atilde;o, apague a URL acima.',
'texte_aucun_resultat_auteur' => 'Nenhum resultado para "@cherche_auteur@"',
'texte_auteur_messagerie' => 'Este site pode indicar permanentemente a lista dos redactores ligados, o que lhe permite trocar mensagens  em directo ( quando o correio est&aacute; desactivado mais acima, a lista dos redactores est&aacute; desactivada). Pode decidir n&atilde;o aparecer nesta lista (estando &laquo;&nbsp;invis&iacute;vel&nbsp;&raquo; para os outros utilizadores).',
'texte_auteur_messagerie_1' => 'Este s&iacute;tio permite a troca de mensagens e a constitui&ccedil;&atilde;o de f&oacute;runs de discuss&atilde;o privados entre os participantes do s&iacute;tio. Pode decidir n&atilde;o participar nessas trocas.',
'texte_auteurs' => 'OS AUTORES',
'texte_breves' => 'As not&iacute;cias s&atilde;o textos curtos e simples que permitem
 p&ocirc;r rapidamente em linha informa&ccedil;&otilde;es concisas, gerir
uma revista de imprensa, um calend&aacute;rio dos acontecimentos...',
'texte_choix_base_1' => 'Escolher a sua base',
'texte_choix_base_2' => 'O servidor SQL contem muitas bases de dados.', # MODIF
'texte_choix_base_3' => '<b>Seleccione</b> a seguir a que lhe foi atribuida pelo seu servi&ccedil;o de hospedagem.', # MODIF
'texte_choix_table_prefix' => 'Pr&eacute;fixe des tables&nbsp;:', # NEW
'texte_commande_vider_tables_indexation' => 'Utilize este comando para esvaziar as tabelas de indexa&ccedil;&atilde;o utilizadas
  pelo motor integrado de pesquisa em SPIP. Isso permitir-lhe-&aacute; ganhar espa&ccedil;o em disco',
'texte_comment_lire_tableau' => 'O lugar do artigo,
na classifica&ccedil;&atilde;o por popularidade, &eacute; indicado na margem&nbsp;; a popularidade do artigo (uma estimativa do
 n&uacute;mero de visitas di&aacute;rias que receber&aacute; se o ritmo actual de
 consulta se mantiver) e o n&uacute;mero de visitas recebidas
desde o in&iacute;cio s&atilde;o exibidos no bal&atilde;o que
 aparece quando o rato sobrevoa o t&iacute;tulo.',
'texte_compacter_avertissement' => 'Attention &#224; ne pas activer ces options durant le d&#233;veloppement de votre site : les &#233;l&#233;ments compact&#233;s perdent toute lisibilit&#233;.', # NEW
'texte_compacter_script_css' => 'SPIP peut compacter les scripts javascript et les feuilles de style CSS, pour les enregistrer dans des fichiers statiques ; cela acc&#233;l&#232;re l\'affichage du site.', # NEW
'texte_compresse_ou_non' => '(este pode ser comprimido ou n&atilde;o)',
'texte_compresseur_page' => 'SPIP peut compresser automatiquement chaque page qu\'il envoie aux
visiteurs du site. Ce r&#233;glage permet d\'optimiser la bande passante (le
site est plus rapide derri&#232;re une liaison &#224; faible d&#233;bit), mais
demande plus de puissance au serveur.', # NEW
'texte_compte_element' => '@count@ elemento',
'texte_compte_elements' => '@count@ elementos',
'texte_config_groupe_mots_cles' => 'Deseja activar a configura&ccedil;&atilde;o avan&ccedil;ada das palavras-chave,
 indicando por exemplo que se pode seleccionar uma &uacute;nica
 palavra por grupo, que um grupo &eacute; importante... ?', # MODIF
'texte_conflit_edition_correction' => 'Veuillez contr&#244;ler ci-dessous les diff&#233;rences entre les deux versions du texte&nbsp;; vous pouvez aussi copier vos modifications, puis recommencer.', # NEW
'texte_connexion_mysql' => 'Consulte as informa&ccedil;&otilde;es fornecidas pelo seu servi&ccedil;o de hospedagem&nbsp;: deve encontrar nelas, se o seu hospedeiro suporta SQL, os c&oacute;digos de liga&ccedil;&atilde;o ao servidoe SQL.', # MODIF
'texte_contenu_article' => '(Conte&uacute;do do artigo em poucas palavras.)',
'texte_contenu_articles' => 'Segundo a maqueta adoptada para o seu s&iacute;tio, pode decidir
que alguns elementos dos artigos n&atilde;o s&atilde;o utilizados.
   Utilize a lista a seguir para indicar quais s&atilde;o os elementos dispon&iacute;veis.',
'texte_crash_base' => 'Se a sua base de dados foi
 destru&iacute;da, pode tentar uma repara&ccedil;&atilde;o
 autom&aacute;tica.',
'texte_creer_rubrique' => 'Antes de poder escrever artigos, <br /> deve criar uma rubrica.', # MODIF
'texte_date_creation_article' => 'DATA DE CRIA&Ccedil;&Atilde;O DO ARTIGO:',
'texte_date_publication_anterieure' => 'Data de redac&ccedil;&atilde;o anterior&nbsp;:',
'texte_date_publication_anterieure_nonaffichee' => 'N&atilde;o exibir a data de redac&ccedil;&atilde;o anterior',
'texte_date_publication_article' => 'DATA DE PUBLICA&Ccedil;&Atilde;O ONLINE:',
'texte_descriptif_petition' => 'Descri&ccedil;&atilde;o do abaixo-assinado',
'texte_descriptif_rapide' => 'Descri&ccedil;&atilde;o r&aacute;pida',
'texte_documents_joints' => 'Pode autorizar a inclus&atilde;o de documentos (ficheiros, imagens,  multim&eacute;dia etc.) nos artigos e/ou nas sec&ccedil;&otilde;es. Estes ficheiros podem, em seguida, ser referenciados no artigo, ou exibidos separadamente.', # MODIF
'texte_documents_joints_2' => 'Esta combina&ccedil;&atilde;o n&atilde;o impede a inser&ccedil;&atilde;o de imagens directamente nos artigos.',
'texte_effacer_base' => 'Apagar a base de dados SPIP',
'texte_effacer_donnees_indexation' => 'Apagar os dados de indexa&ccedil;&atilde;o',
'texte_effacer_statistiques' => 'Effacer les statistiques', # NEW
'texte_en_cours_validation' => 'Os artigos e not&iacute;cias seguintes est&atilde;o propostos para publica&ccedil;&atilde;o. N&atilde;o hesite em dar a sua opini&atilde;o gra&ccedil;as aos f&oacute;runs que lhes est&atilde;o ligados.', # MODIF
'texte_en_cours_validation_forum' => 'N\'h&eacute;sitez pas &agrave; donner votre avis gr&acirc;ce aux forums qui leur sont attach&eacute;s.', # NEW
'texte_enrichir_mise_a_jour' => 'Pode enriquecer a pagina&ccedil;&atilde;o do seu texto, utilizando &laquo;&nbsp;atalhos tipogr&aacute;ficos&nbsp;&raquo;.',
'texte_fichier_authent' => '<b>SPIP dever&aacute; criar os ficheiros especiais<tt>.htpasswd-admin</tt> no repert&oacute;rio<tt>ecrire/data/<tt> ?</b><p>
  Estes ficheiros podem servir-lhe para restringir o acesso aos autores
e administradores em outros lugares do seu sites
(programa externo de estat&iacute;sticas, por exemplo).<p>
 Se n&atilde;o utilizou, pode deixar esta op&ccedil;&atilde;o
no seu valor por defeito (n&atilde;o h&aacute; cria&ccedil;&atilde;o 
 dos ficheiros).', # MODIF
'texte_informations_personnelles_1' => 'O sistema vai agora criar-lhe um acesso personalizado ao s&iacute;tio',
'texte_informations_personnelles_2' => '(Nota : se se tratar de uma reinstala&ccedil;&atilde;o e se o seu acesso continua funcional, pode',
'texte_introductif_article' => '(Texto introdut&oacute;rio do artigo.)',
'texte_jeu_caractere' => 'Esta op&ccedil;&atilde;o &eacute; &uacute;til se o seu s&iacute;tio precisa de exibir alfabetos
 diferentes do alfabeto romano ( ou  &laquo;&nbsp;ocidental&nbsp;&raquo;) e seus derivados.
 Nesse caso, pode ser prefer&iacute;vel mudar a defini&ccedil;&atilde;o por defeito para utilizar
 um jogo de car&aacute;cteres adequado&nbsp;; aconselhamos, em todos os casos, a proceder a experi&ecirc;ncias
 a fim de encontrar uma solu&ccedil;&atilde;o satisfat&oacute;ria. Se modificar este par&acirc;metro, n&atilde;o esque&ccedil;a tamb&eacute;m de adaptar
o s&iacute;tio p&uacute;blico (balisa<tt>#CHARSET</tt>).', # MODIF
'texte_jeu_caractere_2' => 'Esta defini&ccedil;&atilde;o n&atilde;o tem efeito retroactivo. Por
 conseguinte, os textos j&aacute; introduzidos podem ser exibidos
 incorrectamente depois de uma modifica&ccedil;&atilde;o da defini&ccedil;&atilde;o. Em todo
 o caso, poder&aacute; voltar &agrave; defini&ccedil;&atilde;o anterior sem preju&iacute;zo.', # MODIF
'texte_jeu_caractere_3' => 'Votre site est actuellement install&eacute; dans le jeu de caract&egrave;res&nbsp;:', # NEW
'texte_jeu_caractere_4' => 'Si cela ne correspond pas &agrave; la r&eacute;alit&eacute; de vos donn&eacute;es (suite, par exemple, &agrave; une restauration de base de donn&eacute;es), ou si <em>vous d&eacute;marrez ce site</em> et souhaitez partir sur un autre jeu de caract&egrave;res, veuillez indiquer ce dernier ici&nbsp;:', # NEW
'texte_jeu_caractere_conversion' => 'Note&nbsp;: vous pouvez d&eacute;cider de convertir une fois pour toutes l\'ensemble des textes de votre site (articles, br&egrave;ves, forums, etc.) vers l\'alphabet <tt>utf-8</tt>, en vous rendant sur <a href="@url@">la page de conversion vers l\'utf-8</a>.', # NEW
'texte_lien_hypertexte' => '(Se a sua mensagem se refere a um artigo publicado na Web, ou a uma p&aacute;gina que fornece mais informa&ccedil;&otilde;es, favor indicar a seguir o t&iacute;tulo da p&aacute;gina e o endere&ccedil;o URL.)',
'texte_liens_sites_syndiques' => 'Os la&ccedil;os resultantes dos s&iacute;tios vinculados podem
 ser bloqueados a priori&nbsp;; a defini&ccedil;&atilde;o
 a seguir indica a defini&ccedil;&atilde;o por defeito dos
 s&iacute;tios vinculados depois da sua cria&ccedil;&atilde;o. Depois &eacute;
 poss&iacute;vel, de qualquer modo, desbloquear cada la&ccedil;o individualmente, ou escolher
, s&iacute;tio por s&iacute;tio, bloquear os la&ccedil;os futuros deste ou daquele s&iacute;tio.',
'texte_login_ldap_1' => '(Deixar vazio para um acesso an&oacute;nimo, ou introduzir o caminho completo, por exemplo, &laquo;&nbsp;<tt>uid=silva, ou=users, dc=meu-dominio, dc=com</tt>&nbsp;&raquo;.)',
'texte_login_precaution' => 'Aten&ccedil;&atilde;o&nbsp;! Isto &eacute; o login sob o qual est&aacute; ligado actualmente.
Utilize este formul&aacute;rio com precau&ccedil;&atilde;o...',
'texte_message_edit' => 'Aten&ccedil;&atilde;o&nbsp;: esta mensagem pode ser modificada por todos os administradores do s&iacute;tio, e &eacute; vis&iacute;vel por todos os redactores. Utilizar os an&uacute;ncios apenas para exibir acontecimentos importantes da vida do s&iacute;tio.',
'texte_messagerie_agenda' => 'Une messagerie permet aux r&#233;dacteurs du site de communiquer entre eux directement dans l&#8217;espace priv&#233; du site. Elle est associ&#233;e &#224; un agenda.', # NEW
'texte_messages_publics' => 'Mensagens p&uacute;blicas do artigo :',
'texte_mise_a_niveau_base_1' => 'Acaba de actualizar os ficheiros SPIP.
&eacute; preciso agora p&ocirc;r a n&iacute;vel a base de dados
 do s&iacute;tio. ',
'texte_modifier_article' => 'Modificar o artigo :',
'texte_moteur_recherche_active' => '<b>O motor de pesquisa est&aacute; activado.</b> Utilize este comando
 se desejar proceder a uma reindexa&ccedil;&atilde;o r&aacute;pida (ap&oacute;s restauro
de uma salvaguarda por exemplo). Note que os documentos modificados de
 maneira normal (a partir da interface SPIP) s&atilde;o automaticamente
 reindexados&nbsp;: este comando portanto s&oacute; &eacute; &uacute;til de maneira excepcional',
'texte_moteur_recherche_non_active' => 'O motor de pesquisa n&atilde;o est&aacute; activado.',
'texte_mots_cles' => 'As palavras-chave permitem criar la&ccedil;os tem&aacute;ticos entre os seus artigos
 independentemente da sua coloca&ccedil;&atilde;o nas rubricas. Pode assim
 enriquecer a navega&ccedil;&atilde;o do seu s&iacute;tio, e at&eacute; utilizar essas propriedades
 para personalizar a apresenta&ccedil;&atilde;o dos artigos nos esqueletos.',
'texte_mots_cles_dans_forum' => 'Deseja permitir a utiliza&ccedil;&atilde;o das palvras-chave seleccion&aacute;veis pelos visitadores, nos f&oacute;runs do s&iacute;tio p&uacute;blico&nbsp;? (Aten&ccedil;&atilde;o&nbsp;: esta op&ccedil;&atilde;o &eacute; relativamente complexa de utilizar correctamente.)', # MODIF
'texte_multilinguisme' => 'Se desejar gerir artigos em muitas l&iacute;nguas, com uma navega&ccedil;&atilde;o complexa, pode acrescentar um menu de l&iacute;ngua aos artigos e/ou nas rubricas, em fun&ccedil;&atilde;o da organiza&ccedil;&atilde;o do seu s&iacute;tio.',
'texte_multilinguisme_trad' => 'Pode tamb&eacute;m activar um sistema de gest&atilde;o de la&ccedil;os entre as diferentes tradu&ccedil;&otilde;es de um artigo.',
'texte_non_compresse' => '<i>n&atilde;o comprimido</i> ( o seu sezrvidor n&atilde;o suporta esta funcionalidade)',
'texte_non_fonction_referencement' => 'Pode preferir n&atilde;o utilizar esta fun&ccedil;&atilde;o autom&aacute;tica, e indicar os elementos relativos a este s&iacute;tio...',
'texte_nouveau_message' => 'Nova mensagem',
'texte_nouveau_mot' => 'Nova palavra',
'texte_nouvelle_version_spip_1' => 'Instalou uma nova vers&atilde;o de SPIP.',
'texte_nouvelle_version_spip_2' => 'Esta nova vers&atilde;o precisa de uma actualiza&ccedil;&atilde;o mais completa do que o normal. Se &eacute; o webmaster do site, por favor, apague o ficheiro <tt>inc_connect.php3</tt> do direct&oacute;rio <tt>ecrire</tt> e retome a instala&ccedil;&atilde;o de forma a incluir os seus par&acirc;metros de liga&ccedil;&atilde;o &agrave; base de dados.<p> (NB.: se n&atilde;o se lembra dos seus par&acirc;metros de liga&ccedil;&atilde;o, consulte o arquivo <tt>inc_connect.php3</tt> antes de apag&aacute;-lo...)</p>', # MODIF
'texte_operation_echec' => 'Volte &agrave; p&aacute;gina anterior, seleccione uma outra base ou crie uma nova. Verifique as informa&ccedil;&otilde;es fornecidas pelo seu servi&ccedil;o de hospedagem.',
'texte_plus_trois_car' => 'mais de 3 car&aacute;cteres',
'texte_plusieurs_articles' => 'Muitos autores encontrados para "@cherche_auteur@":',
'texte_port_annuaire' => '(O valor indicado por defeito conv&eacute;m geralmente.)',
'texte_presente_plugin' => 'Cette page liste les plugins disponibles sur le site. Vous pouvez activer les plugins n&eacute;cessaires en cochant la case correspondante.', # NEW
'texte_proposer_publication' => 'Quando acabar o seu artigo, <br /> pode propor a sua publica&ccedil;&atilde;o.', # MODIF
'texte_proxy' => 'Em alguns caso (intranet, redes protegidas...),
 pode ser necess&aacute;rio utilizar um <i>proxy HTTP</i>  para atingir os s&iacute;tios vinculados.
 Se for o caso, indique a seguir o endere&ccedil;o, sob a forma
 <tt><html>http://proxy:8080</html></tt>. Em geral,
 deixar&aacute; esta caixa vazia.', # MODIF
'texte_publication_articles_post_dates' => 'Que comportamento SPIP deve adoptar perante os artigos cuja
 data de publica&ccedil;&atilde;o foi fixada para um prazo futuro&nbsp;?',
'texte_rappel_selection_champs' => '[N&atilde;o esquecer de seleccionar correctamente este campo.]',
'texte_recalcul_page' => 'Se quiser
recompor uma &uacute;nica p&aacute;gina, passe pelo espa&ccedil;o p&uacute;blico e utilize o bot&atilde;o &laquo;recompor&raquo;.',
'texte_recapitiule_liste_documents' => 'Esta p&aacute;gina recapitula a lista dos documentos que colocou nas rubricas. Para modificar as informa&ccedil;&otilde;es de cada documento, siga o link para a p&aacute;gina da rubrica.',
'texte_recuperer_base' => 'Reparar a base de dados',
'texte_reference_mais_redirige' => 'artigo referenciado no seu s&iacute;tio SPIP, mas redirigido para uma outra URL.',
'texte_referencement_automatique' => '<b>Referenciamento automatizado de um s&iacute;tio</b><br />Pode referenciar rapidamente um s&iacute;tio Web indicando a seguir o endere&ccedil;o URL desejado, ou o endere&ccedil;o do seu backend. SPIP vai recuperar automaticamente as informa&ccedil;&otilde;es relativas a esse s&iacute;tio (t&iacute;tulo, descri&ccedil;&atilde;o...).', # MODIF
'texte_referencement_automatique_verifier' => 'Veuillez v&eacute;rifier les informations fournies par <tt>@url@</tt> avant d\'enregistrer.', # NEW
'texte_requetes_echouent' => '<b>Quando alguns pedidos SQL falharem
 sistematicamente e sem zaz&atilde;o aparente, &eacute; poss&iacute;vel
 que seja por causa da  pr&oacute;pria base de dados
.</b><p>
 SQL disp&otilde;e de uma funcionalidade de repara&ccedil;&atilde;o das suas tabelas quando foram acidententalmente
 danificadas. Pode tentar aqui essa repara&ccedil;&atilde;o&nbsp;: se falhar, conserve uma c&oacute;pia da exibi&ccedil;&atilde;o que talvez contenha
 ind&iacute;cios daquilo que n&atilde;o funciona...<p>
 Se o problema persistir, contacte com o seu servi&ccedil;o de hospedagem.', # MODIF
'texte_restaurer_base' => 'Restaurar o conte&uacute;do de uma salvaguarda da base',
'texte_restaurer_sauvegarde' => 'Esta op&ccedil;&atilde;o permite restaurar uma salvaguarda da base anteriormente
  efectuada. Para esse efeito, o ficheiro que cont&eacute;m a salvaguarda deve ter sido
 posto no direct&oacute;rio @dossier@.
 Seja prudente com esta funcionalidade&nbsp;: <b>as eventuais modifica&ccedil;&otilde;es, e/ou perdas s&atilde;o irrevers&iacute;veis.</b>  ', # MODIF
'texte_sauvegarde' => 'Salvaguardar o conte&uacute;do da base',
'texte_sauvegarde_base' => 'Salvaguardar a base',
'texte_sauvegarde_compressee' => 'A salvaguarda far-se-&aacute; no ficheiro n&atilde;o comprimido @fichier@.', # MODIF
'texte_selection_langue_principale' => 'Pode seleccionar a seguir a  &laquo;&nbsp;l&iacute;ngua principal&nbsp;&raquo; do s&iacute;tio. Esta op&ccedil;&atilde;o n&atilde;o o obriga - felizmente&nbsp;! - a escrever os seus artigos na l&iacute;ngua seleccionada, mas permite determinar&nbsp;:
 <u><li> o formato por defeito das datas no s&iacute;tio p&uacute;blico&nbsp;;</li>
 <li> a natureza do motor tipogr&aacute;fico que SPIP deve utilizar para a restitui&ccedil;&atilde;o dos textos&nbsp;;</li>
  <li> a l&iacute;ngua utilizada nos formul&aacute;rios do s&iacute;tio p&uacute;blico&nbsp;;</li>
  <li> a l&iacute;ngua apresentada por defeito no espa&ccedil;o privado.</li></ul> ',
'texte_signification' => 'As barras vermelhas representam as entradas acumuladas (total das sub-rubricas), as barras verdes o n&uacute;mero de visitas para cada rubrica.',
'texte_sous_titre' => 'Sub-t&iacute;tulo',
'texte_statistiques_visites' => '(barras escuras : domingo / curva escura : evolu&ccedil;&atilde;o da m&eacute;dia)',
'texte_statut_attente_validation' => '&agrave; espera de valida&ccedil;&atilde;o',
'texte_statut_publies' => 'publicados em linha',
'texte_statut_refuses' => 'recusados',
'texte_suppression_fichiers' => 'Utilize este comando para suprimir todos os ficheiros presentes
na cache SPIP. Isso permite, por exemplo, obrigar uma recomposi&ccedil;&atilde;o de todas as p&aacute;ginas se voc&ecirc;
 fez modifica&ccedil;&otilde;esimportantes de grafismo ou de estrutura do s&iacute;tio.',
'texte_sur_titre' => 'Supra-t&iacute;tulo',
'texte_syndication' => '&Eacute; poss&iacute;vel recuperar automaticamente, quando um s&iacute;tio Web o permitir, 
 a lista das suas novidades. Para tal, deve activar a vincula&ccedil;&atilde;o. 
  <blockquote><i>Alguns servi&ccedil;os de hospedagem desactivam esta funcionalidade&nbsp;; 
 neste caso, n&atilde;o poder&aacute; utilizar a vincula&ccedil;&atilde;o de conte&uacute;do
a partir do seu s&iacute;tio.</i></blockquote>', # MODIF
'texte_table_ok' => ': esta tabela est&aacute; OK.',
'texte_tables_indexation_vides' => 'As tabelas de indexa&ccedil;&atilde;o do motor est&atilde;o vazias.',
'texte_tentative_recuperation' => 'Tentativa de repara&ccedil;&atilde;o',
'texte_tenter_reparation' => 'Tentar uma repara&ccedil;&atilde;o da base de dados',
'texte_test_proxy' => 'Para experimentar este proxy, indique aqui o endere&ccedil;o de um s&iacute;tio Web
  que deseje testar;',
'texte_titre_02' => 'T&iacute;tulo',
'texte_titre_obligatoire' => '<b>T&iacute;tulo</b> [Obrigat&oacute;rio]', # MODIF
'texte_travail_article' => '@nom_auteur_modif@ trabalhou sobre este artigo h&aacute; @date_diff@ minutes',
'texte_travail_collaboratif' => 'Se &eacute; frequente muitos redactores
 trabalharem no mesmo artigo, o sistema
 pode exibir os artigos recentemente &laquo;&nbsp;abertos&nbsp;&raquo;
a fim de evitar as modifica&ccedil;&otilde;es simult&acirc;neas.
  Esta op&ccedil;&atilde;o est&aacute; desactivada por defeito
  a fim de evitar exibir mensagens de aviso
 intempestivas.',
'texte_trop_resultats_auteurs' => 'Demasiado resultados para "@cherche_auteur@" ; favor afinar a pesquisa.',
'texte_type_urls' => 'Vous pouvez choisir ci-dessous le mode de calcul de l\'adresse des pages.', # NEW
'texte_type_urls_attention' => 'Attention ce r&eacute;glage ne fonctionnera que si le fichier @htaccess@ est correctement install&eacute; &agrave; la racine du site.', # NEW
'texte_unpack' => 'telecarregamento da &uacute;ltima vers&atilde;o',
'texte_utilisation_moteur_syndiques' => 'Quando utilizar o motor integrado de pesquisa 
  no SPIP, pode efectuar as pesquisas nos s&iacute;tios e
 nos artigos vinculados de duas maneiras
 diferentes. <br /><img src=\'puce.gif\'> A mais
 simples consiste em pesquisar unicamente nos
 t&iacute;tulos e descri&ccedil;&otilde;es dos artigos. <br /><img src=\'puce.gif\'>
  Um segundo m&eacute;todo, muito mais poderoso, permite
ao SPIP pesquisar igualmente no texto dos
 s&iacute;tios referenciados&nbsp;. Se referenciar
 um s&iacute;tio, SPIP vai ent&atilde;o efectuar a
 pesquisa no texto do pr&oacute;prio s&iacute;tio.', # MODIF
'texte_utilisation_moteur_syndiques_2' => 'Este m&eacute;todo obriga SPIP a visitar
  regularmente os s&iacute;tios referenciados,
  o que pode provocar uma pequena desacelera&ccedil;&atilde;o do seu pr&oacute;prio s&iacute;tio.',
'texte_vide' => 'vazio',
'texte_vider_cache' => 'Esvaziar a cache',
'titre_admin_effacer' => 'Manuten&ccedil;&atilde;o t&eacute;cnica',
'titre_admin_tech' => 'Manuten&ccedil;&atilde;o t&eacute;cnica',
'titre_admin_vider' => 'Manuten&ccedil;&atilde;o t&eacute;cnica',
'titre_articles_syndiques' => 'Artigos vinculados tirados deste s&iacute;tio',
'titre_breves' => 'As not&iacute;cias',
'titre_cadre_afficher_article' => 'Exibir os artigos',
'titre_cadre_afficher_traductions' => 'Exibir o estado das tradu&ccedil;&otilde;es para estas l&iacute;nguas:',
'titre_cadre_ajouter_auteur' => 'ACRESCENTAR UM AUTOR :',
'titre_cadre_forum_administrateur' => 'F&oacute;rum privado dos administradores',
'titre_cadre_forum_interne' => 'F&oacute;rum interno',
'titre_cadre_interieur_rubrique' => 'Dentro da rubrica',
'titre_cadre_numero_auteur' => 'AUTOR N&Uacute;MERO',
'titre_cadre_signature_obligatoire' => '<b>Assinatura</b> [Obrigat&oacute;rio]<br />', # MODIF
'titre_compacter_script_css' => 'Compactage des scripts et CSS', # NEW
'titre_compresser_flux_http' => 'Compression du flux HTTP', # NEW
'titre_config_contenu_notifications' => 'Notifications', # NEW
'titre_config_contenu_prive' => 'Dans l&#8217;espace priv&#233;', # NEW
'titre_config_contenu_public' => 'Sur le site public', # NEW
'titre_config_fonctions' => 'Configura&ccedil;&atilde;o do s&iacute;tio',
'titre_config_forums_prive' => 'Forums de l&#8217;espace priv&#233;', # NEW
'titre_config_groupe_mots_cles' => 'Configura&ccedil;&atilde;o dos grupos de palavras-chave',
'titre_configuration' => 'Configura&ccedil;&atilde;o do s&iacute;tio',
'titre_conflit_edition' => 'Conflit lors de l\'&#233;dition', # NEW
'titre_connexion_ldap' => 'Op&ccedil;&otilde;es: <b>Sua liga&ccedil;&atilde;o LDAP</b>',
'titre_dernier_article_syndique' => '&Uacute;ltimos artigos vinculados',
'titre_documents_joints' => 'Documentos anexados',
'titre_evolution_visite' => 'Evolu&ccedil;&atilde;o das visitas',
'titre_forum_suivi' => 'Acompanhamento dos f&oacute;runs',
'titre_gauche_mots_edit' => 'PALAVRA N&Uacute;MERO :',
'titre_groupe_mots' => 'GRUPO DE PALAVRAS :',
'titre_langue_article' => 'L&Iacute;NGUA DO ARTIGO ',
'titre_langue_breve' => 'L&Iacute;NGUA DA NOT&Iacute;CIA',
'titre_langue_rubrique' => 'L&Iacute;NGUA DA RUBRICA',
'titre_langue_trad_article' => 'L&Iacute;NGUA E TRADU&Ccedil;&Otilde;ES DO ARTIGO',
'titre_les_articles' => 'OS ARTIGOS',
'titre_messagerie_agenda' => 'Messagerie et agenda', # NEW
'titre_mots_cles_dans_forum' => 'Palavras-chave nos f&oacute;runs do s&iacute;tio p&uacute;blico',
'titre_mots_tous' => 'As palavras-chave',
'titre_naviguer_dans_le_site' => 'Navegar no s&iacute;tio',
'titre_nouveau_groupe' => 'Novo grupo',
'titre_nouvelle_breve' => 'Nova not&iacute;cia',
'titre_nouvelle_rubrique' => 'Nova rubrica',
'titre_numero_rubrique' => 'RUBRICA N&Uacute;MERO&nbsp;:',
'titre_page_admin_effacer' => 'Manuten&ccedil;&atilde;o t&eacute;cnica : apagar a base',
'titre_page_articles_edit' => 'Modificar : @titre@',
'titre_page_articles_page' => 'Os artigos',
'titre_page_articles_tous' => 'Todo o s&iacute;tio',
'titre_page_auteurs' => 'Visitantes',
'titre_page_breves' => 'Not&iacute;cias',
'titre_page_breves_edit' => 'Modificar a not&iacute;cia : &laquo; @titre@ &raquo;',
'titre_page_calendrier' => 'Calend&aacute;rio @nom_mois@ @annee@',
'titre_page_config_contenu' => 'Configura&ccedil;&atilde;o do s&iacute;tio',
'titre_page_config_fonctions' => 'Configura&ccedil;&atilde;o do s&iacute;tio',
'titre_page_configuration' => 'Configura&ccedil;&atilde;o do s&iacute;tio',
'titre_page_controle_petition' => 'Acompanhamento dos abaixo-assinados',
'titre_page_delete_all' => 'Supress&atilde;o total e irrevers&iacute;vel',
'titre_page_documents_liste' => 'Os documentos das rubricas',
'titre_page_forum' => 'F&oacute;rum dos administradores',
'titre_page_forum_envoi' => 'Enviar uma mensagem',
'titre_page_forum_suivi' => 'Acompanhamento dos f&oacute;runs',
'titre_page_index' => 'O seu espa&ccedil;o privado',
'titre_page_message_edit' => 'Redigir uma mensagem',
'titre_page_messagerie' => 'O seu correio',
'titre_page_mots_tous' => 'Palavras-chave',
'titre_page_recherche' => 'Resultados da pesquisa @recherche@',
'titre_page_sites_tous' => 'Os s&iacute;tios referenciados',
'titre_page_statistiques' => 'Estat&iacute;sticas por rubricas',
'titre_page_statistiques_messages_forum' => 'Messages de forum', # NEW
'titre_page_statistiques_referers' => 'Estat&iacute;sticas (liga&ccedil;&otilde;es de entrada)',
'titre_page_statistiques_signatures_jour' => 'Nombre de signatures par jour', # NEW
'titre_page_statistiques_signatures_mois' => 'Nombre de signatures par mois', # NEW
'titre_page_statistiques_visites' => 'Estat&iacute;sticas das visitas',
'titre_page_upgrade' => 'Reactualiza&ccedil;&atilde;o de SPIP',
'titre_publication_articles_post_dates' => 'Publica&ccedil;&atilde;o dos artigos p&oacute;s-datados',
'titre_referencement_sites' => 'Referencia&ccedil;&atilde;o de s&iacute;tios e vincula&ccedil;&atilde;o',
'titre_referencer_site' => 'Referenciar o s&iacute;tio',
'titre_rendez_vous' => 'ENCONTROS',
'titre_reparation' => 'Repara&ccedil;&atilde;o',
'titre_site_numero' => 'S&Iacute;TIO N&Uacute;MERO&nbsp;:',
'titre_sites_proposes' => 'Os s&iacute;tios propostos',
'titre_sites_references_rubrique' => 'Os s&iacute;tios referenciados nesta rubrica',
'titre_sites_syndiques' => 'Os s&iacute;tios vinculados',
'titre_sites_tous' => 'Os s&iacute;tios referenciados',
'titre_suivi_petition' => 'Seguimento dos abaixo-assinados',
'titre_syndication' => 'Vincula&ccedil;&atilde;o de s&iacute;tios',
'titre_type_urls' => 'Type d\'adresses URL', # NEW
'tls_ldap' => 'Transport Layer Security :', # NEW
'tout_dossier_upload' => 'Todo o diret&oacute;rio @upload@',
'trad_article_inexistant' => 'N&atilde;o h&aacute; artigo com este n&uacute;mero',
'trad_article_traduction' => 'Todas as vers&otilde;es deste artigo&nbsp;:',
'trad_deja_traduit' => 'Este artigo &eacute; j&aacute; uma tradu&ccedil;&atilde;o do presente artigo.', # MODIF
'trad_delier' => 'N&atilde;o voltar a ligar este artigo a estas tradu&ccedil;&otilde;es',
'trad_lier' => 'Este artigo &eacute; uma tradu&ccedil;&atilde;o do artigo n&uacute;mero&nbsp;:',
'trad_new' => 'Escrever uma nova tradu&ccedil;&atilde;o deste artigo',

// U
'upload_fichier_zip' => 'Ficheiro ZIP',
'upload_fichier_zip_texte' => 'O ficheiro que prop&ocirc;s instalar &eacute; um ficheiro Zip.',
'upload_fichier_zip_texte2' => 'Este ficheiro pode ser:',
'upload_info_mode_document' => 'D&#233;poser cette image dans le portfolio', # NEW
'upload_info_mode_image' => 'Retirer cette image du portfolio', # NEW
'upload_limit' => 'Este ficheiro &eacute; grande demais para o servidor; o tamanho m&aacute;ximo autorizado para <i>upload</i> &eacute; de @max@.',
'upload_zip_conserver' => 'Conserver l&#8217;archive apr&#232;s extraction', # NEW
'upload_zip_decompacter' => 'expandido e cada elemento que ele cont&eacute;m gravados no site. Os ficheiros que ser&atilde;o ent&atilde;o gravados s&atilde;o:',
'upload_zip_telquel' => 'instalado; como ficheiro compactado Zip;',
'upload_zip_titrer' => 'Titrer selon le nom des fichiers', # NEW
'utf8_convert_attendez' => 'Attendez quelques instants et rechargez cette page.', # NEW
'utf8_convert_avertissement' => 'Vous vous appr&ecirc;tez &agrave; convertir le contenu de votre base de donn&eacute;es (articles, br&egrave;ves, etc) du jeu de caract&egrave;res <b>@orig@</b> vers le jeu de caract&egrave;res <b>@charset@</b>.', # NEW
'utf8_convert_backup' => 'N\'oubliez pas de faire auparavant une sauvegarde compl&egrave;te de votre site. Vous devrez aussi v&eacute;rifier que vos squelettes et fichiers de langue sont compatibles @charset@.', # NEW
'utf8_convert_erreur_deja' => 'Votre site est d&eacute;j&agrave; en @charset@, inutile de le convertir...', # NEW
'utf8_convert_erreur_orig' => 'Erreur&nbsp;: le jeu de caract&egrave;res @charset@ n\'est pas support&eacute;.', # NEW
'utf8_convert_termine' => 'C\'est termin&eacute;&nbsp;!', # NEW
'utf8_convert_timeout' => '<b>Important&nbsp;:</b> en cas de <i>timeout</i> du serveur, veuillez recharger la page jusqu\'&agrave; ce qu\'elle indique &laquo;&nbsp;termin&eacute;&nbsp;&raquo;.', # NEW
'utf8_convert_verifier' => 'Vous devez maintenant aller vider le cache, et v&eacute;rifier que tout se passe bien sur les pages publiques du site. En cas de gros probl&egrave;me, une sauvegarde de vos donn&eacute;es a &eacute;t&eacute; r&eacute;alis&eacute;e (au format SQL) dans le r&eacute;pertoire @rep@.', # NEW
'utf8_convertir_votre_site' => 'Convertir votre site en utf-8', # NEW

// V
'version' => 'Version&nbsp;:', # NEW
'version_deplace_rubrique' => 'D&#233;plac&#233; de <b>&#171;&nbsp;@from@&nbsp;&#187;</b> vers <b>&#171;&nbsp;@to@&nbsp;&#187;</b>.', # NEW
'version_initiale' => 'vers&atilde;o inicial'
);

?>
