<?php
// This is a SPIP language file  --  Ceci est un fichier langue de SPIP
// extrait automatiquement de http://trad.spip.org/tradlang_module/sites?lang_cible=pt
// ** ne pas modifier le fichier **

if (!defined('_ECRIRE_INC_VERSION')) return;

$GLOBALS[$GLOBALS['idx_lang']] = array(

	// A
	'articles_dispo' => 'En attente', # NEW
	'articles_meme_auteur' => 'Tous les articles de cet auteur', # NEW
	'articles_off' => 'Bloqués', # NEW
	'articles_publie' => 'Publiés', # NEW
	'articles_refuse' => 'Supprimés', # NEW
	'articles_tous' => 'Tous', # NEW
	'aucun_article_syndic' => 'Aucun article syndiqué', # NEW
	'avis_echec_syndication_01' => 'A ligação falhou: o backend indicado é indecifrável ou não propõe nenhum artigo. ',
	'avis_echec_syndication_02' => 'A ligação falhou: impossível aceder ao  backend deste sítio.',
	'avis_site_introuvable' => 'Não se encontra o sítio',
	'avis_site_syndique_probleme' => 'Atenção: a ligação deste sítio teve um problema  ; o sistema está portanto temporariamente interrompido. Verifique o endereço do ficheiro de ligação deste sítio (<b>@url_syndic@</b>), e tente uma nova recuperação das informações. ', # MODIF
	'avis_sites_probleme_syndication' => 'Estes sítios tiveram um problema de ligação  ',
	'avis_sites_syndiques_probleme' => 'Estes sítios provocaram um problema  ',

	// B
	'bouton_exporter' => 'Exporter', # NEW
	'bouton_importer' => 'Importer', # NEW
	'bouton_radio_modere_posteriori' => 'moderado a posteriori', # MODIF
	'bouton_radio_modere_priori' => 'moderado a priori', # MODIF
	'bouton_radio_non_syndication' => 'Não há vinculação',
	'bouton_radio_syndication' => 'Vinculação',

	// C
	'confirmer_purger_syndication' => 'Êtes-vous certain de vouloir supprimer tous les articles syndiqués de ce site ?', # NEW

	// E
	'entree_adresse_fichier_syndication' => 'Endereço do ficheiro  « backend » para a vinculação :', # MODIF
	'entree_adresse_site' => '<b>Endereço do sítio</b> [Obrigatório]',
	'entree_description_site' => 'Descrição do sítio',
	'erreur_fichier_format_inconnu' => 'Le format du fichier @fichier@ n\'est pas pris en charge.', # NEW
	'erreur_fichier_incorrect' => 'Impossible de lire le fichier.', # NEW

	// F
	'form_prop_nom_site' => 'Nome do sítio',

	// I
	'icone_article_syndic' => 'Article syndiqué', # NEW
	'icone_articles_syndic' => 'Articles syndiqués', # NEW
	'icone_controler_syndication' => 'Publication des articles syndiqués', # NEW
	'icone_modifier_site' => 'Modificar este sítio',
	'icone_referencer_nouveau_site' => 'Referenciar um novo sítio',
	'icone_site_reference' => 'Sites référencés', # NEW
	'icone_supprimer_article' => 'Supprimer cet article', # NEW
	'icone_supprimer_articles' => 'Supprimer ces articles', # NEW
	'icone_valider_article' => 'Valider cet article', # NEW
	'icone_valider_articles' => 'Valider ces articles', # NEW
	'icone_voir_sites_references' => 'Ver os sítios referenciados',
	'info_1_site_importe' => '1 site a été importé', # NEW
	'info_a_valider' => '[a validar]',
	'info_aucun_site_importe' => 'Aucun site n\'a pu être importé', # NEW
	'info_bloquer' => 'bloquear',
	'info_bloquer_lien' => 'bloquear este vínculo',
	'info_derniere_syndication' => 'A última vinculação deste sítio foi efectuada a',
	'info_liens_syndiques_1' => 'laços vinculados',
	'info_liens_syndiques_2' => 'estão à espera de validação',
	'info_nb_sites_importes' => '@nb@ sites ont été importés', # NEW
	'info_nom_site_2' => '<b>Nome do sítio</b> [Obrigatório]',
	'info_panne_site_syndique' => 'Sítio vinculado avariado',
	'info_probleme_grave' => 'problema de',
	'info_question_proposer_site' => 'Quem pode propor sítios referenciados ?',
	'info_retablir_lien' => 'restabelecer este vínculo',
	'info_site_attente' => 'Sítio Web à espera de validação',
	'info_site_propose' => 'Sítio proposto a :',
	'info_site_reference' => 'Sítio referenciado em linha',
	'info_site_refuse' => 'Sítio Web recusado',
	'info_site_syndique' => 'Este sítio está vinculado....', # MODIF
	'info_site_valider' => 'Sítios a validar',
	'info_sites_referencer' => 'Referenciar este sítio',
	'info_sites_refuses' => 'Os sítios recusados ',
	'info_statut_site_1' => 'Este sítio é :',
	'info_statut_site_2' => 'Publicado',
	'info_statut_site_3' => 'Proposto',
	'info_statut_site_4' => 'Para o caixote do lixo', # MODIF
	'info_syndication' => 'vinculação:',
	'info_syndication_articles' => 'artigo(s)',
	'item_bloquer_liens_syndiques' => 'Impedir os laços vinculados para validação',
	'item_gerer_annuaire_site_web' => 'Gerir um anuário de sítios Web',
	'item_non_bloquer_liens_syndiques' => 'Não impedir os laços resultantes da vinculação',
	'item_non_gerer_annuaire_site_web' => 'Desactivar o anuário de sítios Web',
	'item_non_utiliser_syndication' => 'Não utilizar a vinculação automática',
	'item_utiliser_syndication' => 'Utilizar a vinculação automática',

	// L
	'label_exporter_avec_mots_cles_1' => 'Exporter les mots-clés sous forme de tags', # NEW
	'label_exporter_id_parent' => 'Exporter les sites de la rubrique', # NEW
	'label_exporter_publie_seulement_1' => 'Exporter uniquement les sites publiés', # NEW
	'label_fichier_import' => 'Fichier HTML', # NEW
	'label_importer_les_tags_1' => 'Importer les tags sous forme de mot-clé', # NEW
	'label_importer_statut_publie_1' => 'Publier automatiquement les sites', # NEW
	'lien_mise_a_jour_syndication' => 'Actualizar agora',
	'lien_nouvelle_recuperation' => 'Tentar uma nova recuperação dos dados',
	'lien_purger_syndication' => 'Effacer tous les articles syndiqués', # NEW

	// N
	'nombre_articles_syndic' => '@nb@ articles syndiqués', # NEW

	// S
	'statut_off' => 'Supprimé', # NEW
	'statut_prop' => 'En attente', # NEW
	'statut_publie' => 'Publié', # NEW
	'syndic_choix_moderation' => 'Que fazer com as novas ligações provenientes deste sítio ?',
	'syndic_choix_oublier' => 'Que fazer com as ligações que não aparecem mais no ficheiro de sindicação  ?',
	'syndic_choix_resume' => 'Certains sites diffusent le texte complet des articles. Lorsque celui-ci est disponible souhaitez-vous syndiquer :', # NEW
	'syndic_lien_obsolete' => 'ligação desactualizada',
	'syndic_option_miroir' => 'bloquear automaticamente',
	'syndic_option_oubli' => 'eliminar (após @mês@ mês)',
	'syndic_option_resume_non' => 'le contenu complet des articles (au format HTML)', # NEW
	'syndic_option_resume_oui' => 'un simple résumé (au format texte)', # NEW
	'syndic_options' => 'Opções de sindicação :',

	// T
	'texte_expliquer_export_bookmarks' => 'Vous pouvez exporter une liste de sites au format Marque-page HTML,
	pour vous permettre ensuite de l\'importer dans votre navigateur ou dans un service en ligne', # NEW
	'texte_expliquer_import_bookmarks' => 'Vous pouvez importer une liste de sites au format Marque-page HTML,
	en provenance de votre navigateur ou d\'un service en ligne de gestion des Marques-pages.', # NEW
	'texte_liens_sites_syndiques' => 'Os laços resultantes dos sítios vinculados podem
 ser bloqueados a priori ; a definição
 a seguir indica a definição por defeito dos
 sítios vinculados depois da sua criação. Depois é
 possível, de qualquer modo, desbloquear cada laço individualmente, ou escolher
, sítio por sítio, bloquear os laços futuros deste ou daquele sítio.', # MODIF
	'texte_messages_publics' => 'Mensagens públicas do artigo :',
	'texte_non_fonction_referencement' => 'Pode preferir não utilizar esta função automática, e indicar os elementos relativos a este sítio...', # MODIF
	'texte_referencement_automatique' => '<b>Referenciamento automatizado de um sítio</b><br />Pode referenciar rapidamente um sítio Web indicando a seguir o endereço URL desejado, ou o endereço do seu backend. SPIP vai recuperar automaticamente as informações relativas a esse sítio (título, descrição...).', # MODIF
	'texte_referencement_automatique_verifier' => 'Veuillez vérifier les informations fournies par <tt>@url@</tt> avant d\'enregistrer.', # NEW
	'texte_syndication' => 'É possível recuperar automaticamente, quando um sítio Web o permitir, 
 a lista das suas novidades. Para tal, deve activar a vinculação. 
  <blockquote><i>Alguns serviços de hospedagem desactivam esta funcionalidade ; 
 neste caso, não poderá utilizar a vinculação de conteúdo
a partir do seu sítio.</i></blockquote>', # MODIF
	'titre_articles_syndiques' => 'Artigos vinculados tirados deste sítio',
	'titre_dernier_article_syndique' => 'Últimos artigos vinculados',
	'titre_exporter_bookmarks' => 'Exporter des Marques-pages', # NEW
	'titre_importer_bookmarks' => 'Importer des Marques-pages', # NEW
	'titre_importer_exporter_bookmarks' => 'Importer et Exporter des Marques-pages', # NEW
	'titre_page_sites_tous' => 'Os sítios referenciados',
	'titre_referencement_sites' => 'Referenciação de sítios e vinculação',
	'titre_site_numero' => 'SÍTIO NÚMERO :',
	'titre_sites_proposes' => 'Os sítios propostos',
	'titre_sites_references_rubrique' => 'Os sítios referenciados nesta rubrica',
	'titre_sites_syndiques' => 'Os sítios vinculados',
	'titre_sites_tous' => 'Os sítios referenciados',
	'titre_syndication' => 'Vinculação de sítios',
	'tout_voir' => 'Voir tous les articles syndiqués', # NEW

	// U
	'un_article_syndic' => '1 article syndiqué' # NEW
);

?>
