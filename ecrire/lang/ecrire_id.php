<?php
// This is a SPIP language file  --  Ceci est un fichier langue de SPIP
// extrait automatiquement de http://www.spip.net/trad-lang/
// ** ne pas modifier le fichier **

if (!defined('_ECRIRE_INC_VERSION')) return;

$GLOBALS[$GLOBALS['idx_lang']] = array(

// A
'activer_plugin' => 'Aktifkan plugin',
'affichage' => 'Affichage', # NEW
'aide_non_disponible' => 'Bagian dari bantuan online ini belum tersedia dalam bahasa pengantar yang digunakan sekarang.',
'auteur' => 'Penulis:',
'avis_acces_interdit' => 'Dilarang mengakses.',
'avis_article_modifie' => 'Perhatian, @nom_auteur_modif@ telah mengedit artikel ini @date_diff@ menit yang lalu',
'avis_aucun_resultat' => 'Tidak ditemukan hasil apa-apa.',
'avis_chemin_invalide_1' => 'Path yang telah anda pilih',
'avis_chemin_invalide_2' => 'sepertinya tidak benar. Silakan kembali ke halaman sebelumnya dan verifikasi informasi yang diberikan.',
'avis_connexion_echec_1' => 'Koneksi ke server SQL gagal.', # MODIF
'avis_connexion_echec_2' => 'Kembali ke halaman sebelumnya, dan verifikasi informasi yang anda telah berikan.',
'avis_connexion_echec_3' => '<b>Catatan:</b> Pada sejumlah server, anda harus <b>memohon</b> aktivasi akses ke database SQL sebelum anda dapat menggunakannya. Jika anda tidak berhasil mengakses database anda, pastikan anda telah mengajukan permohonan ini.', # MODIF
'avis_connexion_ldap_echec_1' => 'Koneksi ke server LDAP gagal.',
'avis_connexion_ldap_echec_2' => 'Kembali ke halaman sebelumnya, dan verifikasi informasi yang anda telah berikan.',
'avis_connexion_ldap_echec_3' => 'Alternatif lainnya, jangan gunakan dukungan LDAP untuk mengimpor pengguna.',
'avis_conseil_selection_mot_cle' => '<b>Kelompok penting:</b> Sangat dianjurkan untuk memilih sebuah kata kunci untuk kelompok ini.',
'avis_deplacement_rubrique' => 'Peringatan! Bagian ini mengandung @contient_breves@ berita@scb@: jika anda memindahkannya, silakan cek kotak ini untuk konfirmasi.',
'avis_destinataire_obligatoire' => 'Anda harus memilih satu orang penerima sebelum mengirimkan pesan ini.',
'avis_doublon_mot_cle' => 'Un mot existe deja avec ce titre. &Ecirc;tes vous s&ucirc;r de vouloir cr&eacute;er le m&ecirc;me ?', # NEW
'avis_erreur_connexion_mysql' => 'Kesalahan koneksi SQL',
'avis_erreur_version_archive' => '<b>Peringatan! Berkas @archive@ berkaitan dengan
    sebuah versi SPIP yang lain dengan yang anda
    miliki.</b> Anda akan mengalami sejumlah
    kesulitan: risiko untuk merusak database anda,
    kejanggalan fungsional situs anda, dll. Jangan
    kirim permohonan impor ini.<p>Untuk informasi
    lebih lanjut, silakan lihat <a href="@spipnet@">
                                dokumentasi SPIP</a>.', # MODIF
'avis_espace_interdit' => '<b>Area terlarang</b><p>SPIP telah diinstal.',
'avis_lecture_noms_bases_1' => 'Sistem instalasi tidak dapat membaca nama-nama database yang terinstal.',
'avis_lecture_noms_bases_2' => 'Bisa jadi tidak ada database yang tersedia, atau fitur yang mengizinkan penampilan daftar database dinonaktifkan
  dengan alasan keamanan (yang sering ditemui pada banyak hosting).',
'avis_lecture_noms_bases_3' => 'Jika alternatif kedua benar, sangat mungkin sebuah database dinamai sama dengan log masuk anda:',
'avis_non_acces_message' => 'Anda tidak memiliki akses ke pesan ini.',
'avis_non_acces_page' => 'Anda tidak memiliki akses ke halaman ini.',
'avis_operation_echec' => 'Operasi gagal.',
'avis_operation_impossible' => 'Operasi tidak mungkin dijalankn',
'avis_probleme_archive' => 'Kesalahan membaca pada berkas @archive@',
'avis_site_introuvable' => 'Situs tidak ditemukan',
'avis_site_syndique_probleme' => 'Peringatan: sindikasi situs ini mengalami gangguan; oleh karena itu sistem dihentikan untuk sementara waktu. Silakan verifikasi alamat berkas sindikasi situs (<b>@url_syndic@</b>), dan coba sekali lagi untuk melanjutkan proses pengambilan informasi.', # MODIF
'avis_sites_probleme_syndication' => 'Situs-situs ini mengalami gangguan sindikasi',
'avis_sites_syndiques_probleme' => 'Situs-situs tersindikasi ini menimbulkan sebuah permasalahan',
'avis_suppression_base' => 'PERINGATAN, data yang dihapus tidak dapat dikembalikan lagi',
'avis_version_mysql' => 'Versi SQL anda (@version_mysql@) tidak mengizinkan perbaikan otomatis tabel-tabel database.',

// B
'bouton_acces_ldap' => 'Tambah sebuah akses ke LDAP >>',
'bouton_ajouter' => 'Tambah',
'bouton_ajouter_participant' => 'TAMBAH SEORANG PESERTA:',
'bouton_annonce' => 'PENGUMUMAN',
'bouton_annuler' => 'Batal',
'bouton_checkbox_envoi_message' => 'kemungkinan untuk mengirimkan sebuah pesan',
'bouton_checkbox_indiquer_site' => 'Anda harus mengisi nama untuk sebuah situs web',
'bouton_checkbox_qui_attribue_mot_cle_administrateurs' => 'administrator situs',
'bouton_checkbox_qui_attribue_mot_cle_redacteurs' => 'editor',
'bouton_checkbox_qui_attribue_mot_cle_visiteurs' => 'pengunjung situs umum saat mereka mengirimkan sebuah pesan di forum.',
'bouton_checkbox_signature_unique_email' => 'hanya satu tanda tangan per alamat e-mail',
'bouton_checkbox_signature_unique_site' => 'hanya satu tanda tangan per situs web',
'bouton_demande_publication' => 'Permohonan publikasi artikel ini',
'bouton_desactive_tout' => 'Non aktifkan semua',
'bouton_desinstaller' => 'D&eacute;sinstaller', # NEW
'bouton_effacer_index' => 'Hapus indeksasi',
'bouton_effacer_statistiques' => 'Effacer les statistiques', # NEW
'bouton_effacer_tout' => 'Hapus SEMUA',
'bouton_envoi_message_02' => 'KIRIM SEBUAH PESAN',
'bouton_envoyer_message' => 'Pesan terakhir: kirim',
'bouton_forum_petition' => 'FORUM &amp; PETISI',
'bouton_modifier' => 'Modifikasi',
'bouton_pense_bete' => 'MEMO PRIBADI',
'bouton_radio_activer_messagerie' => 'Aktifkan sistem pesan intern',
'bouton_radio_activer_messagerie_interne' => 'Aktifkan sistem pesan intern',
'bouton_radio_activer_petition' => 'Aktifkan petisi',
'bouton_radio_afficher' => 'Tampilkan',
'bouton_radio_apparaitre_liste_redacteurs_connectes' => 'Muncul di daftar editor-editor yang terkoneksi',
'bouton_radio_articles_futurs' => 'untuk artikel yang akan dipublikasikan di masa depan saja (tidak ada aksi di database).',
'bouton_radio_articles_tous' => 'untuk semua artikel tanpa pengecualian.',
'bouton_radio_articles_tous_sauf_forum_desactive' => 'untuk semua artikel, terkecuali artikel yang forumnya dinonaktifkan.',
'bouton_radio_desactiver_messagerie' => 'Non aktifkan sistem pesan',
'bouton_radio_enregistrement_obligatoire' => 'Registrasi diperlukan (
  pengguna harus mendaftarkan diri dengan memberikan alamat e-mailnya
  sebelum dapat berkontribusi).',
'bouton_radio_envoi_annonces_adresse' => 'Kirim pengumuman ke alamat:',
'bouton_radio_envoi_liste_nouveautes' => 'Kirim daftar berita terbaru',
'bouton_radio_moderation_priori' => 'Moderasi awal (
 kontribusi hanya akan ditampilkan setelah validasi
 oleh administrator).',
'bouton_radio_modere_abonnement' => 'registrasi diperlukan',
'bouton_radio_modere_posteriori' => 'moderasi akhir',
'bouton_radio_modere_priori' => 'moderasi awal',
'bouton_radio_non_apparaitre_liste_redacteurs_connectes' => 'Jangan muncul di daftar editor-editor yang terkoneksi',
'bouton_radio_non_envoi_annonces_editoriales' => 'Jangan kirim pengumuman editorial apapun juga',
'bouton_radio_non_syndication' => 'Tidak ada sindikasi',
'bouton_radio_pas_petition' => 'Tidak ada petisi',
'bouton_radio_petition_activee' => 'Petisi diaktifkan',
'bouton_radio_publication_immediate' => 'Publikasi pesan segera
 (kontribusi akan ditampilkan sesegera mungkin setelah dikirimkan, kemudian
 administrator dapat menghapusnya).',
'bouton_radio_sauvegarde_compressee' => 'simpan dalam bentuk kompresi di @fichier@',
'bouton_radio_sauvegarde_non_compressee' => 'simpan dalam bentuk tidak terkompresi di @fichier@',
'bouton_radio_supprimer_petition' => 'Hapus petisi',
'bouton_radio_syndication' => 'Sindikasi:',
'bouton_redirection' => 'MENGALIHKAN TUJUAN	',
'bouton_relancer_installation' => 'Menjalankan instalasi kembali',
'bouton_restaurer_base' => 'Memulihkan database',
'bouton_suivant' => 'Selanjutnya',
'bouton_tenter_recuperation' => 'Usaha perbaikan',
'bouton_test_proxy' => 'Tes proxy',
'bouton_vider_cache' => 'Kosongkan cache',
'bouton_voir_message' => 'Lihat pesan sebelum divalidasi',

// C
'cache_mode_compresse' => 'Berkas-berkas cache disimpan dalam bentuk kompresi.',
'cache_mode_non_compresse' => 'Berkas-berkas cache ditulis dalam bentuk tidak terkompresi.',
'cache_modifiable_webmestre' => 'Parameter ini dapat dimodifikasi oleh webmaster.',
'calendrier_synchro' => 'Jika anda menggunakan aplikasi kalender yang kompatibel dengan <b>iCal</b>, anda dapat mensinkronisasikannya dengan informasi situs ini.',
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
'connexion_ldap' => 'Koneksi:',
'copier_en_local' => 'Kopi ke situs lokal',

// D
'date_mot_heures' => 'H',
'diff_para_ajoute' => 'Paragraf yang ditambah',
'diff_para_deplace' => 'Paragraf yang dipindahkan',
'diff_para_supprime' => 'Paragraf yang dihapus',
'diff_texte_ajoute' => 'Teks yang ditambah',
'diff_texte_deplace' => 'Teks yang dipindahkan',
'diff_texte_supprime' => 'Teks yang dihapus',
'double_clic_inserer_doc' => 'Klik ganda untuk memasukkan jalan pintas ini ke dalam teks',

// E
'email' => 'e-mail',
'email_2' => 'e-mail:',
'en_savoir_plus' => 'En savoir plus', # NEW
'entree_adresse_annuaire' => 'Alamat direktori',
'entree_adresse_email' => 'Alamat e-mail anda',
'entree_adresse_fichier_syndication' => 'Alamat berkas untuk sindikasi:',
'entree_adresse_site' => '<b>URL Situs</b> [Diperlukan]',
'entree_base_donnee_1' => 'Alamat database',
'entree_base_donnee_2' => '(Sering kali, alamat ini sesuai dengan alamat situs anda, kadangkala ia berkaitan dengan nama &laquo;localhost&raquo;, dan bisa juga dibiarkan tidak terisi sama sekali.)',
'entree_biographie' => 'Biografi singkat dalam beberapa kata.',
'entree_breve_publiee' => 'Apakah artikel berita ini akan dipublikasikan?',
'entree_chemin_acces' => '<b>Isi</B> path:',
'entree_cle_pgp' => 'Kunci PGP anda',
'entree_contenu_rubrique' => '(Isi bagian dalam beberapa kata.)',
'entree_description_site' => 'Deskripsi situs',
'entree_identifiants_connexion' => 'Pengidentifikasi koneksi anda...',
'entree_informations_connexion_ldap' => 'Silakan isi formulir ini dengan informasi koneksi LDAP. Anda akan memperoleh informasi yang diminta melalui administrator jaringan atau sistem anda.',
'entree_infos_perso' => 'Siapa anda?',
'entree_interieur_rubrique' => 'Dalam bagian:',
'entree_liens_sites' => '<b>Tautan web</B> (referensi, situs yang dapat dikunjungi...)',
'entree_login' => 'Log masuk anda',
'entree_login_connexion_1' => 'Log masuk koneksi',
'entree_login_connexion_2' => '(Kadang kala sesuai dengan log masuk akses FTP anda dan bisa jadi juga dibiarkan tidak terisi)',
'entree_login_ldap' => 'Log masuk awal LDAP',
'entree_mot_passe' => 'Kata sandi anda',
'entree_mot_passe_1' => 'Kata sandi koneksi',
'entree_mot_passe_2' => '(Kadang kala sesuai dengan kata sandi akses FTP anda dan bisa jadi juga dibiarkan tidak terisi)',
'entree_nom_fichier' => 'Silakan isi nama berkas @texte_compresse@:',
'entree_nom_pseudo' => 'Nama atau alias anda',
'entree_nom_pseudo_1' => '(Nama atau alias anda)',
'entree_nom_site' => 'Nama situs anda',
'entree_nouveau_passe' => 'Kata sandi baru',
'entree_passe_ldap' => 'Kata sandi',
'entree_port_annuaire' => 'Nomor port direktori',
'entree_signature' => 'Tanda tangan',
'entree_texte_breve' => 'Teks artikel berita',
'entree_titre_obligatoire' => '<b>Judul</b> [Dibutuhkan]<BR>',
'entree_url' => 'URL situs anda',
'erreur_plugin_desinstalation_echouee' => 'La d&eacute;sinstallation du plugin a echou&eacute;. Vous pouvez n&eacute;anmoins le desactiver.', # NEW
'erreur_plugin_fichier_absent' => 'Berkas hilang',
'erreur_plugin_fichier_def_absent' => 'Berkas definisi hilang',
'erreur_plugin_nom_fonction_interdit' => 'Nama fungsi yang dilarang',
'erreur_plugin_nom_manquant' => 'Nama plugin yang hilang',
'erreur_plugin_prefix_manquant' => 'Nama plugin tidak terdefinisi',
'erreur_plugin_tag_plugin_absent' => '&lt;plugin&gt; hilang dalam berkas definisi',
'erreur_plugin_version_manquant' => 'Versi plugin yang hilang',

// F
'forum_info_original' => 'asli',

// H
'htaccess_a_simuler' => 'Avertissement: la configuration de votre serveur HTTP ne tient pas compte des fichiers @htaccess@. Pour pouvoir assurer une bonne s&eacute;curit&eacute;, il faut que vous modifiez cette configuration sur ce point, ou bien que les constantes @constantes@ (d&eacute;finissables dans le fichier mes_options.php) aient comme valeur des r&eacute;pertoires en dehors de @document_root@.', # NEW
'htaccess_inoperant' => 'htaccess inop&eacute;rant', # NEW

// I
'ical_info1' => 'Halaman ini memberikan sejumlah metode untuk mengetahui dan berhubungan dengan aktivitas situs ini.',
'ical_info2' => 'Untuk informasi lebih lanjut, jangan segan-segan untuk mengunjungi <a href="@spipnet@">dokumentasi SPIP</a>.', # MODIF
'ical_info_calendrier' => 'Dua kalender berada di tangan anda siap untuk dipakai. Yang pertama adalah peta situs yang menampilkan semua artikel yang dipublikasi. Yang kedua berisikan pengumuman editorial sekaligus pesan-pesan pribadi terbaru anda: semuanya dapat disimpan berkat kunci pribadi yang bisa anda modifikasi setiap saat dengan jalan memperbaharui kata sandi.',
'ical_lien_rss_breves' => 'Sindikasi artikel berita situs',
'ical_methode_http' => 'Mengunduh',
'ical_methode_webcal' => 'Sinkronisasi (webcal://)',
'ical_texte_js' => 'Sebuah kode javascript mengizinkan anda untuk menampilkan secara mudah dan di setiap situs yang anda miliki, semua artikel terbaru yang dipublikasikan di situs ini.',
'ical_texte_prive' => 'Kalender ini, yang sifatnya pribadi sekali, menginformasikan anda seluruh aktivitas editorial pribadi situs ini (tugas-tugas, janji-janji pribadi, artikel-artikel dan berita-berita yang dikirimkan...).',
'ical_texte_public' => 'Kalender ini memperbolehkan anda mengikuti aktivitas umum situs ini (artikel-artikel dan berita-berita yang dipublikasi).',
'ical_texte_rss' => 'Anda dapat mensindikasi berita-berita terbaru situs ini melalui pembaca berkas XML/RSS (Rich Site Summary) apa saja. Ini juga merupakan format yang mengizinkan SPIP untuk membaca berita-berita terbaru yang dipublikasi oleh situs-situs lainnya menggunakan format yang kompatibel (situs-situs tersindikasi).',
'ical_titre_js' => 'Javascript',
'ical_titre_mailing' => 'Daftar Surat',
'ical_titre_rss' => 'Berkas-berkas sindikasi',
'icone_activer_cookie' => 'Meletakkan sebuah cookie',
'icone_admin_plugin' => 'Mengelola plugin',
'icone_afficher_auteurs' => 'Tampilkan penulis',
'icone_afficher_visiteurs' => 'Tampilkan pengunjung',
'icone_arret_discussion' => 'Berhenti berpartisipasi dalam diskusi ini',
'icone_calendrier' => 'Kalender',
'icone_creation_groupe_mots' => 'Buat sebuah kelompok kata kunci baru',
'icone_creation_mots_cles' => 'Buat sebuah kata kunci baru',
'icone_creer_auteur' => 'Buat seorang penulis baru dan asosiasikan dia dengan artikel ini',
'icone_creer_mot_cle' => 'Buat sebuah kata kunci baru dan tautkan ia ke artikel ini',
'icone_creer_mot_cle_breve' => 'Cr&eacute;er un nouveau mot-cl&eacute; et le lier &agrave; cette br&egrave;ve', # NEW
'icone_creer_mot_cle_rubrique' => 'Cr&eacute;er un nouveau mot-cl&eacute; et le lier &agrave; cette rubrique', # NEW
'icone_creer_mot_cle_site' => 'Cr&eacute;er un nouveau mot-cl&eacute; et le lier &agrave; ce site', # NEW
'icone_creer_rubrique_2' => 'Buat sebuah bagian baru',
'icone_ecrire_nouvel_article' => 'Berita dalam bagian ini',
'icone_envoyer_message' => 'Kirim pesan ini',
'icone_evolution_visites' => 'Kunjungi tingkat<br>@visites@ kunjungan',
'icone_modif_groupe_mots' => 'Modifikasi kelompok kata kunci ini',
'icone_modifier_article' => 'Modifikasi artikel ini',
'icone_modifier_breve' => 'Modifikasi artikel berita ini',
'icone_modifier_message' => 'Modifikasi pesan ini',
'icone_modifier_mot' => 'Modifier ce mot-cl&eacute;', # NEW
'icone_modifier_rubrique' => 'Modifikasi bagian ini',
'icone_modifier_site' => 'Modifikasi situs ini',
'icone_poster_message' => 'Kirim sebuah pesan',
'icone_publier_breve' => 'Publikasi artikel berita ini',
'icone_referencer_nouveau_site' => 'Referensi sebuah situs baru',
'icone_refuser_breve' => 'Tolak artikel berita ini',
'icone_relancer_signataire' => 'Relancer le signataire', # NEW
'icone_retour' => 'Kembali',
'icone_retour_article' => 'Kembali ke artikel',
'icone_suivi_forum' => 'Tindak lanjut dari forum umum: @nb_forums@ kontribusi',
'icone_supprimer_cookie' => 'Hapus cookie',
'icone_supprimer_groupe_mots' => 'Hapus kelompok ini',
'icone_supprimer_rubrique' => 'Hapus bagian ini',
'icone_supprimer_signature' => 'Hapus tanda tangan ini',
'icone_valider_signature' => 'Validasi tanda tangan ini',
'icone_voir_sites_references' => 'Tampilkan situs-situs referensi',
'icone_voir_tous_mots_cles' => 'Tampilkan semua kata kunci',
'image_administrer_rubrique' => 'Anda dapat mengelola bagian ini',
'info_1_article' => '1 artikel',
'info_1_breve' => '1 artikel berita',
'info_1_site' => '1 situs',
'info_activer_cookie' => 'Anda apat mengaktifkan <b>cookie administrasi</b>, yang memperbolehkan anda
 untuk berpindah-pindah dengan mudah antara situs umum dan area pribadi.',
'info_activer_forum_public' => '<i>Untuk mengaktifkan forum-forum umum, silakan pilih mode moderasi standar forum-forum tersebut:</I>',
'info_admin_gere_rubriques' => 'Administrator ini mengelola bagian-bagian berikut:',
'info_admin_gere_toutes_rubriques' => 'Administrator ini mengelola <b>semua bagian</b>.',
'info_admin_statuer_webmestre' => 'Donner &agrave; cet administrateur les droits de webmestre', # NEW
'info_admin_webmestre' => 'Cet administrateur est <b>webmestre</b>', # NEW
'info_administrateur' => 'Administrator',
'info_administrateur_1' => 'Administrator',
'info_administrateur_2' => 'situs (<i>gunakan dengan penuh kehati-hatian</i>)',
'info_administrateur_site_01' => 'Jika anda adalah seorang administrator situs, silakan',
'info_administrateur_site_02' => 'klik tautan ini',
'info_administrateurs' => 'Administrator',
'info_administrer_rubrique' => 'Anda dapat mengelola bagian ini',
'info_adresse' => 'ke alamat:',
'info_adresse_email' => 'ALAMAT E-MAIL:',
'info_adresse_url' => 'URL situs umum anda',
'info_afficher_visites' => 'Tampilkan kunjungan untuk:',
'info_affichier_visites_articles_plus_visites' => 'Tampilkan kunjungan untuk <b>artikel-artikel yang paling sering dikunjungi sejak awal:</b>',
'info_aide_en_ligne' => 'Bantuan Online SPIP',
'info_ajout_image' => 'Ketika anda menambahkan gambar sebagai lampiran pada sebuah artikel,
		SPIP dapat secara otomatis membuat gambar kecil dari
		gambar yang dimasukkan. Ini bermanfaat ,sebagai contoh, untuk membuat
		sebuah galeri gambar atau portfolio.',
'info_ajout_participant' => 'Peserta berikut telah ditambahkan:',
'info_ajouter_rubrique' => 'Tambah sebuah bagian untuk dikelola:',
'info_annonce_nouveautes' => 'Pengumuman-pengumuman berita terbaru',
'info_anterieur' => 'sebelumnya',
'info_appliquer_choix_moderation' => 'Terapkan pilihan moderasi ini:',
'info_article' => 'artikel',
'info_article_2' => 'artikel',
'info_article_a_paraitre' => 'Artikel-artikel bertanggal yang akan dipublikasikan',
'info_articles_02' => 'Artikel',
'info_articles_2' => 'Artikel',
'info_articles_auteur' => 'Artikel-artikel penulis ini',
'info_articles_lies_mot' => 'Artikel-artikel yang terasosiasi dengan kata kunci ini',
'info_articles_trouves' => 'Artikel ditemukan',
'info_articles_trouves_dans_texte' => 'Artikel ditemukan (dalam teks)',
'info_attente_validation' => 'Validasi tertunda artikel-artikel anda',
'info_aujourdhui' => 'hari ini:',
'info_auteur_message' => 'PENGIRIM PESAN:',
'info_auteurs' => 'Penulis',
'info_auteurs_par_tri' => 'Penulis@partri@',
'info_auteurs_trouves' => 'Penulis ditemukan',
'info_authentification_externe' => 'Ototentikasi eksternal',
'info_avertissement' => 'Peringatan',
'info_barre_outils' => 'avec sa barre d\'outils ?', # NEW
'info_base_installee' => 'Struktur database anda telah diinstal.',
'info_base_restauration' => 'Pemulihan database dalam proses.',
'info_bloquer' => 'blok',
'info_breves' => 'Apakah situs anda menggunakan sistem pemberitaan?',
'info_breves_03' => 'artikel berita',
'info_breves_liees_mot' => 'Berita-berita yang terasosiasi dengan kata kunci ini',
'info_breves_touvees' => 'Artikel berita ditemukan',
'info_breves_touvees_dans_texte' => 'Artikel berita ditemukan (dalam teks)',
'info_changer_nom_groupe' => 'Ganti nama kelompok ini:',
'info_chapeau' => 'Dek',
'info_chapeau_2' => 'Introduksi:',
'info_chemin_acces_1' => 'Pilihan: <b>Path akses dalam direktori</b>',
'info_chemin_acces_2' => 'Mulai sekarang, anda harus mengkonfigurasi path akses ke informasi direktori. Informasi ini penting untuk membaca profil pengguna yang disimpan dalam direktori.',
'info_chemin_acces_annuaire' => 'Pilihan: <b>Path akses dalam direktori</B>',
'info_choix_base' => 'Langkah ketiga:',
'info_classement_1' => '&nbsp;dari @liste@',
'info_classement_2' => '&nbsp;dari @liste@',
'info_code_acces' => 'Jangan lupa kode akses anda!',
'info_comment_lire_tableau' => 'Bagaimana membaca grafik ini',
'info_compresseur_gzip' => '<b>N.&nbsp;B.&nbsp;:</b> Il est recommand&#233; de v&#233;rifier au pr&#233;alable si l\'h&#233;bergeur compresse d&#233;j&#224; syst&#233;matiquement les scripts php&nbsp;; pour cela, vous pouvez par exemple utiliser le service suivant&nbsp;: @testgzip@', # NEW
'info_compresseur_texte' => 'Si votre serveur ne comprime pas automatiquement les pages html pour les envoyer aux internautes, vous pouvez essayer de forcer cette compression pour diminuer le poids des pages t&eacute;l&eacute;charg&eacute;es. <b>Attention</b> : cela peut ralentir considerablement certains serveurs.', # NEW
'info_compresseur_titre' => 'Optimisations et compression', # NEW
'info_config_forums_prive' => 'Dans l&#8217;espace priv&#233; du site, vous pouvez activer plusieurs types de forums&nbsp;:', # NEW
'info_config_forums_prive_admin' => 'Un forum r&#233;serv&#233; aux administrateurs du site&nbsp;:', # NEW
'info_config_forums_prive_global' => 'Un forum global, ouvert &#224; tous les r&#233;dacteurs&nbsp;:', # NEW
'info_config_forums_prive_objets' => 'Un forum sous chaque article, br&#232;ve, site r&#233;f&#233;renc&#233;, etc.&nbsp;:', # NEW
'info_config_suivi' => 'Jika alamat ini berkaitan dengan suatu daftar surat, anda dapat mengindikasikan di bawah alamat di mana pengunjung situs dapat mendaftarkan diri. Alamat ini dapat berupa URL (sebagai contoh halaman registrasi daftar surat melalui web), atau alamat e-mail dengan subyek yang spesifik (contoh: <tt>@adresse_suivi@?subject=subscribe</tt>):',
'info_config_suivi_explication' => 'Anda dapat berlangganan daftar surat situs ini. Anda akan menerima melalui e-mail secara otomatis, pengumuman-pengumuman yang berkenaan dengan artikel-artikel dan berita-berita yang dikirim untuk publikasi.',
'info_confirmer_passe' => 'Konfirmasi kata sandi baru:',
'info_conflit_edition_avis_non_sauvegarde' => 'Attention, les champs suivants ont &#233;t&#233; modifi&#233;s par ailleurs. Vos modifications sur ces champs n\'ont donc pas &#233;t&#233; enregistr&#233;es.', # NEW
'info_conflit_edition_differences' => 'Diff&#233;rences&nbsp;:', # NEW
'info_conflit_edition_version_enregistree' => 'La version enregistr&#233;e&nbsp;:', # NEW
'info_conflit_edition_votre_version' => 'Votre version&nbsp;:', # NEW
'info_connexion_base' => 'Langkah kedua: <b>Percobaan untuk koneksi ke database</B>',
'info_connexion_base_donnee' => 'Connexion &agrave; votre base de donn&eacute;es', # NEW
'info_connexion_ldap_ok' => 'Koneksi LDAP anda berhasil.</b><p> Anda dapat meneruskan ke langkah selanjutnya.</p>', # MODIF
'info_connexion_mysql' => 'Langkah pertama: <b>Koneksi SQL anda</b>',
'info_connexion_ok' => 'Koneksi berhasil.',
'info_contact' => 'Kontak',
'info_contenu_articles' => 'Isi artikel',
'info_creation_mots_cles' => 'Buat dan konfigurasi kata-kata kunci situs di sini',
'info_creation_paragraphe' => '(Untuk membuat paragraf, anda cukup meninggalkan baris-baris kosong.)',
'info_creation_rubrique' => 'Sebelum bisa menulis artikel,<BR> anda harus membuat paling tidak satu bagian.<BR>',
'info_creation_tables' => 'Langkah keempat: <b>Pembuatan tabel-tabel database</b>',
'info_creer_base' => '<b>Buat</b> sebuah database baru:',
'info_dans_groupe' => 'Dalam kelompok:',
'info_dans_rubrique' => 'Dalam bagian:',
'info_date_publication_anterieure' => 'Tanggal publikasi sebelumnya:',
'info_date_referencement' => 'TANGGAL REFERENSI SITUS INI:',
'info_delet_mots_cles' => 'Anda memohon penghapusan kata kunci
<b>@titre_mot@</b> (@type_mot@). Kata kunci ini ditautkan ke
<b>@texte_lie@</b>Anda harus mengkonfirmasi keputusan ini:',
'info_derniere_etape' => 'Langkah terakhir: <b>Selesai!',
'info_derniere_syndication' => 'Sindikasi terakhir situs ini dijalankan pada',
'info_derniers_articles_publies' => 'Artikel-artikel terakhir anda yang dipublikasi',
'info_desactiver_forum_public' => 'Non aktifkan penggunaan forum
	umum. Forum umum dapat digunakan berdasarkan kasus per kasus untuk
	artikel-artikel; dan penggunannya dilarang untuk bagian, berita, dll.',
'info_desactiver_messagerie_personnelle' => 'Anda dapat mengaktifkan atau menonaktifkan sistem pesan pribadi anda di situs ini.',
'info_descriptif' => 'Deskripsi:',
'info_desinstaller_plugin' => 'supprime les donn&eacute;es et d&eacute;sactive le plugin', # NEW
'info_discussion_cours' => 'Diskusi-diskusi yang sedang berlangsung',
'info_ecrire_article' => 'Sebelum dapat menulis artikel, anda harus membuat paling tidak satu bagian.',
'info_email_envoi' => 'Alamat e-mail pengirim (opsional)',
'info_email_envoi_txt' => 'Masukkan alamat e-mail pengirim yang digunakan untuk mengirim e-mail (secara standar, alamat penerima digunakan sebagai alamat pengirim)&nbsp;:',
'info_email_webmestre' => 'Alamat e-mail webmaster (opsional)',
'info_entrer_code_alphabet' => 'Masukkan kode set karakter yang akan digunakan:',
'info_envoi_email_automatique' => 'Pengiriman otomatis',
'info_envoi_forum' => 'Kirim forum ke penulis artikel',
'info_envoyer_maintenant' => 'Kirim sekarang',
'info_erreur_restauration' => 'Kesalahan pemulihan: berkas tidak ditemukan.',
'info_etape_suivante' => 'Lanjut ke langkah berikutnya',
'info_etape_suivante_1' => 'Anda dapat pindah ke langkah selanjutnya.',
'info_etape_suivante_2' => 'Anda dapat pindah ke langkah selanjutnya.',
'info_exportation_base' => 'ekspor database ke @archive@',
'info_facilite_suivi_activite' => 'Untuk menfasilitasi tindak lanjut dari aktivitas editorial situs;
  SPIP dapat mengirimkan notifikasi melalui e-mail, ke daftar surat seorang editor,
  sebagai contoh permohonan publikasi dan validasi artikel.',
'info_fichiers_authent' => 'Berkas ototentikasi ".htpasswd"',
'info_fonctionnement_forum' => 'Operasi forum:',
'info_forum_administrateur' => 'forum administrators',
'info_forum_interne' => 'forum internal',
'info_forum_ouvert' => 'Di area pribadi situs, sebuah forum terbuka untuk semua
		editor yang terdaftar. Di bawah, anda dapat mengaktifkan
		forum tambahan direservasi untuk para administrator.',
'info_forum_statistiques' => 'Statistik kunjungan',
'info_forums_abo_invites' => 'Situs anda berisikan forum-forum berlangganan; pengunjung dapat mendaftarkan diri pada forum-forum tersebut di situs umum.',
'info_gauche_admin_effacer' => '<b>Hanya administrator yang memiliki akses ke halaman ini.</b><p> Halaman ini memberikan akses ke berbagai tugas pemeliharaan teknis. Beberapa di antaranya memerlukan proses ototentikasi tersendiri yang membutuhkan akses FTP ke situs web.</p>', # MODIF
'info_gauche_admin_tech' => '<b>Hanya administrator yang memiliki akses ke halaman ini.</b><p> Halaman ini memberikan akses ke berbagai tugas pemeliharaan teknis. Beberapa di antaranya memerlukan proses ototentikasi tersendiri yang membutuhkan akses FTP ke situs web.</p>', # MODIF
'info_gauche_admin_vider' => '<b>Hanya administrator yang memiliki akses ke halaman ini.</b><p> Halaman ini memberikan akses ke berbagai tugas pemeliharaan teknis. Beberapa di antaranya memerlukan proses ototentikasi tersendiri yang membutuhkan akses FTP ke situs web.</p>', # MODIF
'info_gauche_auteurs' => 'Anda akan menemukan seluruh penulis situs di sini.
 Status dari setiap penulis ditunjukkan oleh warna icon (administrator = hijau; editor = kuning).',
'info_gauche_auteurs_exterieurs' => 'Penulis eksternal, tanpa akses ke situs, ditunjukkan oleh icon biru; penulis yang dihapus oleh icon warna keranjang sampah.',
'info_gauche_messagerie' => 'Sistem pesan mengizinkan anda bertukar pesan dengan sesama editor, untuk menyimpan memo (untuk keperluan pribadi anda) atau untuk menampilkan pengumuman di halaman depan area pribadi (jika anda seorang administrator).',
'info_gauche_numero_auteur' => 'NOMOR PENULIS:',
'info_gauche_numero_breve' => 'NOMOR ARTIKEL BERITA',
'info_gauche_statistiques_referers' => 'Halaman ini menampilkan daftar <i>pereferensi</I>, yakni situs-situs yang memuat tautan ke situs anda, hanya untuk kemarin dan hari ini: sesungguhnya daftar ini diperbaharui setiap 24 jam.',
'info_gauche_suivi_forum' => 'Halaman <i>tindak lanjut forum</i> adalah alat bantu pengelola situs anda (bukan area diskusi atau pengeditan). Halaman ini menampilkan semua kontribusi forum umum artikel ini dan mengizinkan anda untuk mengelola kontribusi-kontribusi ini.',
'info_gauche_suivi_forum_2' => 'Halaman <i>tindak lanjut forum</i> adalah alat bantu pengelola situs anda (bukan area diskusi atau pengeditan). Halaman ini menampilkan semua kontribusi forum umum artikel ini dan mengizinkan anda untuk mengelola kontribusi-kontribusi ini.',
'info_gauche_visiteurs_enregistres' => 'Anda akan menemukan di sini para pengunjung
	terdaftar di area umum situs (forum-forum berlangganan).',
'info_generation_miniatures_images' => 'Membuat gambar-gambar kecil',
'info_gerer_trad' => 'Aktifkan tautan penerjemahan?',
'info_groupe_important' => 'Kelompok penting',
'info_hebergeur_desactiver_envoi_email' => 'Sejumlah hosting menonaktifkan pengiriman e-mail
  otomatis di server mereka. Dalam hal ini fitur-fitur SPIP berikut tidak
  dapat diimplementasikan.',
'info_hier' => 'kemarin:',
'info_historique' => 'Revisi:',
'info_historique_activer' => 'Aktifkan pelacakan revisi',
'info_historique_affiche' => 'Tampilkan versi ini',
'info_historique_comparaison' => 'bandingkan',
'info_historique_desactiver' => 'Non aktifkan pelacakan revisi',
'info_historique_lien' => 'Tampilkan daftar versi',
'info_historique_texte' => 'Pelacakan revisi mengizinkan anda untuk melihat perubahan dan penambahan yang dibuat pada sebuah artikel dan menampilkan perbedaan di antara versi-versi yang ada.',
'info_historique_titre' => 'Pelacakan revisi',
'info_identification_publique' => 'Identitas umum anda...',
'info_image_process' => 'Pilih metode terbaik untuk membuat gambar kecil dengan mengklik gambar yang terkait.',
'info_image_process2' => '<b>Catatan:</b> <i>Jika anda tidak dapat melihat gambar, berarti server anda tidak dikonfigurasi untuk menggunakan peralatan yang ada. Jika anda ingin menggunakan fitur-fitur ini, hubungi bagian teknis penyedia hosting anda dan minta ekstensi &laquo;GD&raquo; atau &laquo;Imagick&raquo; diinstal.</i>',
'info_images_auto' => 'Gambar secara otomatis dikalkulasi',
'info_informations_personnelles' => 'Langkah kelima: <b>Informasi pribadi</B>',
'info_inscription_automatique' => 'Registrasi otomatis editor-editor baru',
'info_jeu_caractere' => 'Set karakter situs',
'info_jours' => 'hari',
'info_laisser_champs_vides' => 'biarkan kolom-kolom ini kosong)',
'info_langues' => 'Bahasa-bahasa situs',
'info_ldap_ok' => 'Ototentikasi LDAP diinstal.',
'info_lien_hypertexte' => 'Tautan web:',
'info_liens_syndiques_1' => 'tautan tersindikasi',
'info_liens_syndiques_2' => 'validasi tertunda.',
'info_liens_syndiques_3' => 'forum',
'info_liens_syndiques_4' => 'adalah',
'info_liens_syndiques_5' => 'forum',
'info_liens_syndiques_6' => 'adalah',
'info_liens_syndiques_7' => 'validasi tertunda.',
'info_liste_redacteurs_connectes' => 'Daftar editor-editor terkoneksi',
'info_login_existant' => 'Log masuk ini sudah ada.',
'info_login_trop_court' => 'Log masuk terlalu pendek.',
'info_logos' => 'Les logos', # NEW
'info_maximum' => 'maksimum:',
'info_meme_rubrique' => 'Dalam bagian yang sama',
'info_message' => 'Pesan dari',
'info_message_efface' => 'PESAN DIHAPUS',
'info_message_en_redaction' => 'Pesan-pesan anda dalam proses',
'info_message_technique' => 'Pesan teknis:',
'info_messagerie_interne' => 'Sistem pesan internal',
'info_mise_a_niveau_base' => 'Pembaharuan database SQL',
'info_mise_a_niveau_base_2' => '{{Peringatan!}} Anda telah menginstal berkas SPIP
  {yang lebih tua} daripada berkas yang terdapat sebelumnya
  di situs ini: database anda terancam hilang dan situs anda
  tidak akan bekerja sebagaimana mestinya lagi.<br>{{Instal kembali
  berkas-berkas SPIP}}',
'info_mode_fonctionnement_defaut_forum_public' => 'Mode operasi standar forum-forum umum',
'info_modifier_auteur' => 'Modifier l\'auteur :', # NEW
'info_modifier_breve' => 'Modifikasi artikel berita:',
'info_modifier_mot' => 'Modifier le mot-cl&eacute; :', # NEW
'info_modifier_rubrique' => 'Modifikasi bagian:',
'info_modifier_titre' => 'Modifikasi: @titre@',
'info_mon_site_spip' => 'Situs SPIP saya',
'info_mot_sans_groupe' => '(Kata-kata kunci tanpa kelompok...)',
'info_moteur_recherche' => 'Mesin pencari terintegrasi',
'info_mots_cles' => 'Kata-kata kunci',
'info_mots_cles_association' => 'Kata-kata kunci dalam kelompok ini dapat diasosiasikan dengan:',
'info_moyenne' => 'rata-rata:',
'info_multi_articles' => 'Aktifkan menu bahasa untuk artikel?',
'info_multi_cet_article' => 'Bahasa artikel ini:',
'info_multi_langues_choisies' => 'Silakan pilih di bawah bahasa yang tersedia untuk editor situs anda.
  Bahasa-bahasa yang telah digunakan oleh situs anda (di daftar paling atas) tidak dapat dinonaktifkan.',
'info_multi_rubriques' => 'Aktifkan menu bahasa untuk bagian?',
'info_multi_secteurs' => '... hanya untuk bagian-bagian yang berlokasi di root?',
'info_nom' => 'Nama',
'info_nom_destinataire' => 'Nama penerima',
'info_nom_site' => 'Nama situs anda',
'info_nom_site_2' => '<b>Nama situs</b> [Dibutuhkan]',
'info_nombre_articles' => '@nb_articles@ artikel,',
'info_nombre_breves' => '@nb_breves@ artikel berita,',
'info_nombre_partcipants' => 'PESERTA DISKUSI:',
'info_nombre_rubriques' => '@nb_rubriques@ bagian,',
'info_nombre_sites' => '@nb_sites@ situs,',
'info_non_deplacer' => 'Jangan pindahkan...',
'info_non_envoi_annonce_dernieres_nouveautes' => 'SPIP dapat mengirimkan pengumuman-pengumuman terbaru situs secara teratur.
		(artikel-artikel dan berita-berita yang baru saja dipublikasi).',
'info_non_envoi_liste_nouveautes' => 'Jangan kirim daftar berita-berita terbaru',
'info_non_modifiable' => 'tidak dapat dimodifikasi',
'info_non_suppression_mot_cle' => 'Saya tidak ingin menghapus kata kunci ini.',
'info_notes' => 'Catatan kaki',
'info_nouveaux_message' => 'Pesan-pesan baru',
'info_nouvel_article' => 'Artikel baru',
'info_nouvelle_traduction' => 'Terjemahan baru:',
'info_numero_article' => 'NOMOR ARTIKEL:',
'info_obligatoire_02' => '[Dibutuhkan]',
'info_option_accepter_visiteurs' => 'Izinkan registrasi pengunjung dari situs umum',
'info_option_email' => 'Ketika seorang pengunjung situs mengirimkan sebuah pesan ke forum
		yang terasosiasi dengan sebuah artikel, penulis artikel akan diinformasikan
		melalui e-mail. Anda ingin menggunakan opsi ini?', # MODIF
'info_option_faire_suivre' => 'Teruskan pesan forum ke penulis artikel',
'info_option_ne_pas_accepter_visiteurs' => 'Tolak registrasi pengunjung',
'info_option_ne_pas_faire_suivre' => 'Jangan teruskan pesan forum',
'info_options_avancees' => 'OPSI-OPSI LANJUTAN',
'info_ortho_activer' => 'Aktifkan pemeriksa ejaan.',
'info_ortho_desactiver' => 'Non aktifkan pemeriksa ejaan.',
'info_ou' => 'atau...',
'info_oui_suppression_mot_cle' => 'Saya ingin menghapus kata kunci ini selamanya.',
'info_page_interdite' => 'Halaman terlarang',
'info_par_nom' => 'berdasarkan nama',
'info_par_nombre_article' => '(berdasarkan jumlah artikel)',
'info_par_statut' => 'berdasarkan status',
'info_par_tri' => '(Oleh @tri@)',
'info_pas_de_forum' => 'tidak ada forum',
'info_passe_trop_court' => 'Kata sandi terlalu pendek.',
'info_passes_identiques' => 'Dua kata sandi tidak identik.',
'info_pense_bete_ancien' => 'Memo-memo lama anda', # MODIF
'info_plus_cinq_car' => 'lebih dari 5 karakter',
'info_plus_cinq_car_2' => '(Lebih dari 5 karakter)',
'info_plus_trois_car' => '(Lebih dari 3 karakter)',
'info_popularite' => 'popularitas: @popularite@; kunjungan: @visites@',
'info_popularite_2' => 'popularitas situs:',
'info_popularite_3' => 'popularitas:&nbsp;@popularite@; kunjungan:&nbsp;@visites@',
'info_popularite_4' => 'popularitas:&nbsp;@popularite@; kunjungan:&nbsp;@visites@',
'info_post_scriptum' => 'Postscript',
'info_post_scriptum_2' => 'Postscript:',
'info_pour' => 'untuk',
'info_preview_admin' => 'Hanya administrator yang memiliki akses ke mode preview',
'info_preview_comite' => 'Semua penulis memiliki akses ke mode preview',
'info_preview_desactive' => 'Mode preview dinonaktifkan',
'info_preview_texte' => 'Ada kemungkinan melihat situs terlebih dahulu seolah-olah semua artikel dan berita (yang paling tidak memiliki status "terkirim") telah dipublikasi. Apakah mode preview ini sebaiknya dibatasi hanya kepada administrator, terbuka untuk semua penulis atau dinonaktifkan selama-lamanya?',
'info_principaux_correspondants' => 'Korespondensi utama anda',
'info_procedez_par_etape' => 'silakan dilanjutkan langkah demi langkah',
'info_procedure_maj_version' => 'prosedur pembaharuan hendaknya dijalankan untuk
	mengadaptasi database degan versi terbaru SPIP.',
'info_proxy_ok' => 'Percobaan proxy berhasil.',
'info_ps' => 'P.S.',
'info_publier' => 'publikasi',
'info_publies' => 'Artikel anda dipublikasi secara online',
'info_question_accepter_visiteurs' => 'Jika templat situs anda mengizinkan pengunjung untuk mendaftar tanpa perlu memasuki area pribadi, silakan aktifkan opsi berikut:',
'info_question_activer_compactage_css' => 'Souhaitez-vous activer le compactage des feuilles de style (CSS) ?', # NEW
'info_question_activer_compactage_js' => 'Souhaitez-vous activer le compactage des scripts (javascript) ?', # NEW
'info_question_activer_compresseur' => 'Voulez-vous activer la compression du flux HTTP ?', # NEW
'info_question_gerer_statistiques' => 'Apakah situs anda ingin mengelola statistik kunjungan?',
'info_question_inscription_nouveaux_redacteurs' => 'Apakah anda mengizinkan registrasi editor baru dari
  situs yang dipublikasi? Jika anda setuju, pengunjung dapat mendaftar
  melalui formulir terotomasi, dan akan mengakses area pribadi untuk
  melihat artikel-artikel mereka. <blockquote><i>Selama proses registrasi,
  pengguna menerima sebuah e-mail terotomasi
  yang memberikan kode akses ke situs pribadi. Sejumlah
  hosting menonaktifkan pengiriman e-mail di server mereka:
  dalam hal ini ini registrasi terotomasi tidak dapat
  diimplementasikan.', # MODIF
'info_question_mots_cles' => 'Apakah anda ingin menggunakan kata-kata kunci di situs anda?',
'info_question_proposer_site' => 'Siapa yang dapat menyarankan situs-situs referensi?',
'info_question_utilisation_moteur_recherche' => 'Apakah anda ingin mengunakan mesin pencari yang terintegrasi dengan SPIP?
	(Menonaktifkannya akan meningkatkan kinerja sistem.)',
'info_question_vignettes_referer' => 'Lorsque vous consultez les statistiques, vous pouvez visualiser des aper&ccedil;us des sites d\'origine des visites', # NEW
'info_question_vignettes_referer_non' => 'Ne pas afficher les captures des sites d\'origine des visites', # NEW
'info_question_vignettes_referer_oui' => 'Afficher les captures des sites d\'origine des visites', # NEW
'info_question_visiteur_ajout_document_forum' => 'Si vous souhaitez autoriser les visiteurs &#224; joindre des documents (images, sons...) &#224; leurs messages de forum, indiquer ci-dessous la liste des extensions de documents autoris&#233;s pour les forums (ex: gif, jpg, png, mp3).', # NEW
'info_question_visiteur_ajout_document_forum_format' => 'Si vous souhaitez autoriser tous les types de documents consid&eacute;r&eacute;s comme fiables par SPIP, mettre une &eacute;toile. Pour ne rien autoriser, ne rien indiquer.', # NEW
'info_qui_attribue_mot_cle' => 'Kata-kata kunci dalam kelompok ini dapat ditunjuk oleh:',
'info_racine_site' => 'Root situs',
'info_recharger_page' => 'Silakan buka kembali halaman ini beberapa saat lagi.',
'info_recherche_auteur_a_affiner' => 'Terlalu banyaj hasil untuk "@cherche_auteur@"; silakan perbaiki pencarian anda.',
'info_recherche_auteur_ok' => 'Sejumlah editor ditemukan untuk "@cherche_auteur@":',
'info_recherche_auteur_zero' => 'Tidak ada hasil untuk "@cherche_auteur@".',
'info_recommencer' => 'Silakan coba lagi.',
'info_redacteur_1' => 'Redaktur',
'info_redacteur_2' => 'memiliki akses ke area pribadi (<i>disarankan</i>)',
'info_redacteurs' => 'Editor',
'info_redaction_en_cours' => 'PENGEDITAN DALAM PROSES',
'info_redirection' => 'Pengalihan tujuan',
'info_referencer_doc_distant' => 'Referensi dokumen di internet:',
'info_refuses' => 'Artikel anda ditolak',
'info_reglage_ldap' => 'Pilihan: <b>Menyesuaikan impor LDAP</b>',
'info_renvoi_article' => '<b>Pengalihan tujuan.</B> Artikel ini mengarah pada halaman:',
'info_reserve_admin' => 'Hanya administrator yang dapat memodifikasi alamat ini.',
'info_restauration_sauvegarde' => 'memulihkan backup @archive@', # MODIF
'info_restauration_sauvegarde_insert' => 'Insertion de @archive@ dans la base', # NEW
'info_restreindre_rubrique' => 'Batasi manajemen ke bagian:',
'info_resultat_recherche' => 'Hasil-hasil pencarian:',
'info_rubriques' => 'Bagian',
'info_rubriques_02' => 'bagian',
'info_rubriques_liees_mot' => 'Bagian-bagian yang terasosiasi dengan kata kunci ini',
'info_rubriques_trouvees' => 'Bagian ditemukan',
'info_rubriques_trouvees_dans_texte' => 'Bagian ditemukan (dalam teks)',
'info_sans_titre' => 'Tidak berjudul',
'info_sauvegarde' => 'Backup',
'info_sauvegarde_articles' => 'Backup artikel',
'info_sauvegarde_articles_sites_ref' => 'Backup artikel-artikel dari situs-situs referensi',
'info_sauvegarde_auteurs' => 'Backup penulis',
'info_sauvegarde_breves' => 'Backup berita',
'info_sauvegarde_documents' => 'Backup dokumen',
'info_sauvegarde_echouee' => 'Jika backup gagal (&laquo;Waktu eksekusi maksimum terlampaui&raquo;),',
'info_sauvegarde_forums' => 'Backup forum',
'info_sauvegarde_groupe_mots' => 'Backup kelompok kata kunci',
'info_sauvegarde_messages' => 'Backup pesan',
'info_sauvegarde_mots_cles' => 'Backup kata-kata kunci',
'info_sauvegarde_petitions' => 'Backup petisi',
'info_sauvegarde_refers' => 'Backup pereferensi',
'info_sauvegarde_reussi_01' => 'Backup berhasil.',
'info_sauvegarde_reussi_02' => 'Database telah berhasil disimpan di @archive@. Anda dapat',
'info_sauvegarde_reussi_03' => 'kembali ke manajemen',
'info_sauvegarde_reussi_04' => 'situs anda.',
'info_sauvegarde_rubrique_reussi' => 'Les tables de la rubrique @titre@ ont &eacute;t&eacute; sauvegard&eacute;e dans @archive@. Vous pouvez', # NEW
'info_sauvegarde_rubriques' => 'Backup Bagian',
'info_sauvegarde_signatures' => 'Backup tanda tangan petisi',
'info_sauvegarde_sites_references' => 'Backup situs-situs referensi',
'info_sauvegarde_type_documents' => 'Backup tipe dokumen',
'info_sauvegarde_visites' => 'Backup kunjungan',
'info_selection_chemin_acces' => '<b>Pilih</b> di bawah path akses dalam direktori:',
'info_selection_un_seul_mot_cle' => 'Anda hanya dapat memilih <b>satu kata kunci</b> dalam kelompok ini.',
'info_signatures' => 'tanda tangan',
'info_site' => 'Situs',
'info_site_2' => 'situs:',
'info_site_min' => 'situs',
'info_site_propose' => 'Situs dikirim pada:',
'info_site_reference_2' => 'Situs referensi',
'info_site_syndique' => 'Situs ini disindikasi...',
'info_site_valider' => 'Situs-situs yang akan divalidasi',
'info_site_web' => 'SITUS WEB:',
'info_sites' => 'situs',
'info_sites_lies_mot' => 'Situs-situs referensi yang terasosiasi dengan kata kunci ini',
'info_sites_proxy' => 'Menggunakan proxy',
'info_sites_refuses' => 'Situs-situs yang ditolak',
'info_sites_trouves' => 'Situs ditemukan',
'info_sites_trouves_dans_texte' => 'Situs ditemukan (dalam teks)',
'info_sous_titre' => 'Sub judul:',
'info_statut_administrateur' => 'Administrator',
'info_statut_auteur' => 'Status penulis ini:', # MODIF
'info_statut_auteur_a_confirmer' => 'Pendaftaran yang perlu dikonfirmasi',
'info_statut_auteur_autre' => 'Status lainnya:',
'info_statut_efface' => 'Dihapus',
'info_statut_redacteur' => 'Editor',
'info_statut_site_1' => 'Situs ini adalah:',
'info_statut_site_2' => 'Dipublikasi',
'info_statut_site_3' => 'Dikirim',
'info_statut_site_4' => 'Dalam keranjang sampah',
'info_statut_utilisateurs_1' => 'Status standar para pengguna yang diimpor',
'info_statut_utilisateurs_2' => 'Pilih status yang diberikan kepada orang-orang yang terdapat di direktori LDAP ketika terkoneksi pertama kali. Nanti anda dapat memodifikasi status tersebut untuk setiap penulis berdasarkan kasus per kasus.',
'info_suivi_activite' => 'Tindak lanjut aktivitas editorial',
'info_supprimer_mot' => 'hapus kata kunci ini',
'info_surtitre' => 'Judul atas:',
'info_syndication_integrale_1' => 'Situs anda menyediakan berkas-berkas sindikasi (lihat &#147;<a href="@url@">@titre@</a>&#148;).',
'info_syndication_integrale_2' => 'Apakah anda ingin mengirim seluruh artikel atau ringkasannya saja yang terdiri dari beberapa ratus karakter?',
'info_table_prefix' => 'Data situs ini disimpan di tabel bernama <tt><b>spip</b>_articles</tt>, <tt><b>spip</b>_rubriques</tt>, dst. Jika anda menginstal sejumlah situs dalam database yang sama, anda dapat mengubah prefiks dari nama tabel (Catatan: Gunakan hanya huruf-huruf kecil dan tidak beraksen.).',
'info_taille_maximale_images' => 'SPIP va tester la taille maximale des images qu\'il peut traiter (en millions de pixels).<br /> Les images plus grandes ne seront pas r&eacute;duites.', # NEW
'info_taille_maximale_vignette' => 'Ukuran maksimum gambar-gambar kecil yang dihasilkan oleh sistem:',
'info_terminer_installation' => 'Anda dapat menyelesaikan sekarang proses instalasi standar.',
'info_texte' => 'Teks',
'info_texte_explicatif' => 'Teks penjelasan',
'info_texte_long' => '(Teks terlalu panjang: akan muncul dalam beberapa bagian yang akan disusun kembali setelah validasi.)',
'info_texte_message' => 'Teks pesan anda:',
'info_texte_message_02' => 'Teks pesan',
'info_titre' => 'Judul:',
'info_titre_mot_cle' => 'Nama atau judul kata kunci ini',
'info_total' => 'total:',
'info_tous_articles_en_redaction' => 'Semua artikel dalam proses',
'info_tous_articles_presents' => 'Semua artikel yang dipublikasi dalam bagian ini',
'info_tous_articles_refuses' => 'Tous les articles refus&eacute;s', # NEW
'info_tous_les' => 'setiap:',
'info_tous_redacteurs' => 'Pengumuman kepada semua editor',
'info_tout_site' => 'Seluruh situs',
'info_tout_site2' => 'Artikel-artikel belum diterjemahkan ke dalam bahasa ini.',
'info_tout_site3' => 'Artikel telah diterjemahkan ke dalam bahasa ini, tapi sejumlah modifikasi telah dibuat untuk artikel referensi. Oleh karenanya terjemahan memerlukan pembaharuan.',
'info_tout_site4' => 'Artikel telah diterjemahkan ke dalam bahasa ini, dan ini merupakan terjemahan yang terbaru.',
'info_tout_site5' => 'Artikel asli.',
'info_tout_site6' => '<b>Peringatan:</b> hanya artikel-artikel asli yang ditampilkan.
Terjemahan diasosiasikan dengan yang asli,
dalam warna yang menunjukkan statusnya:',
'info_travail_colaboratif' => 'Kolaborasi kerja pada artikel',
'info_un_article' => 'sebuah artikel,',
'info_un_mot' => 'Satu kata kunci pada waktu yang bersamaan',
'info_un_site' => 'sebuah situs,',
'info_une_breve' => 'sebuah artikel berita,',
'info_une_rubrique' => 'sebuah bagian,',
'info_une_rubrique_02' => '1 bagian',
'info_url' => 'URL:',
'info_url_site' => 'URL SITUS:',
'info_urlref' => 'Tautan web:',
'info_utilisation_spip' => 'SPIP siap untuk digunakan...',
'info_visites_par_mois' => 'Tampilan bulanan:',
'info_visites_plus_populaires' => 'Tampilkan kunjungan untuk <b>artikel-artikel yang terpopuler</b> dan untuk <b>artikel-artikel yang terakhir dipublikasi:</b>',
'info_visiteur_1' => 'Pengunjung',
'info_visiteur_2' => 'situs umum',
'info_visiteurs' => 'Pengunjung',
'info_visiteurs_02' => 'Pengunjung situs umum',
'install_adresse_base_hebergeur' => 'Adresse de la base de donn&eacute;es attribu&eacute;e par l\'h&eacute;bergeur', # NEW
'install_base_ok' => 'La base @base@ a &eacute;t&eacute; reconnue', # NEW
'install_echec_annonce' => 'Instalasi ini tidak akan bekerja, atau akan menghasilkan situs yang tidak berfungsi sebagaimana mestinya...',
'install_extension_mbstring' => 'SPIP tidak dapat bekerja dengan:',
'install_extension_php_obligatoire' => 'SPIP membutuhkan sebuah ekstensi php:',
'install_login_base_hebergeur' => 'Login de connexion attribu&eacute; par l\'h&eacute;bergeur', # NEW
'install_nom_base_hebergeur' => 'Nom de la base attribu&eacute; par l\'h&eacute;bergeur&nbsp;:', # NEW
'install_pas_table' => 'Base actuellement sans tables', # NEW
'install_pass_base_hebergeur' => 'Mot de passe de connexion attribu&eacute; par l\'h&eacute;bergeur', # NEW
'install_php_version' => 'Versi PHP @version@ terlalu tua (minimum = @minimum@)',
'install_select_langue' => 'Pilih sebuah bahasa dengan mengklik tombol "selanjutnya" untuk memulasi prosedur instalasi.',
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
'intem_redacteur' => 'editor',
'intitule_licence' => 'Licence', # NEW
'item_accepter_inscriptions' => 'Izinkan pendaftaran',
'item_activer_forum_administrateur' => 'Aktifkan forum administrator',
'item_activer_messages_avertissement' => 'Aktifkan pesan-pesan peringatan',
'item_administrateur_2' => 'administrator',
'item_afficher_calendrier' => 'Tampilkan dalam kalender',
'item_ajout_mots_cles' => 'Otorisasi penambahan kata-kata kunci ke forum',
'item_autoriser_documents_joints' => 'Otorisasi dokumen yang terlampir di artikel',
'item_autoriser_documents_joints_rubriques' => 'Otorisasi dokumen dalam bagian',
'item_autoriser_selectionner_date_en_ligne' => 'Permettre de modifier la date de chaque document', # NEW
'item_autoriser_syndication_integrale' => 'Ikut sertakan semua artikel dalam berkas sindikasi',
'item_bloquer_liens_syndiques' => 'Blokir tautan sindikasi untuk validasi',
'item_breve_refusee' => 'TIDAK - Artikel berita ditolak',
'item_breve_validee' => 'YA - Artikel berita divalidasi',
'item_choix_administrateurs' => 'administrator',
'item_choix_generation_miniature' => 'Buat gambar-gambar kecil secara otomatis.',
'item_choix_non_generation_miniature' => 'Jangan buat gambar-gambar kecil.',
'item_choix_redacteurs' => 'editor',
'item_choix_visiteurs' => 'pengunjung situs umum',
'item_compresseur' => 'Activer la compression', # NEW
'item_config_forums_prive_global' => 'Activer le forum des r&#233;dacteurs', # NEW
'item_config_forums_prive_objets' => 'Activer ces forums', # NEW
'item_creer_fichiers_authent' => 'Buat berkas .htpasswd',
'item_desactiver_forum_administrateur' => 'Non aktifkan forum administrator',
'item_gerer_annuaire_site_web' => 'Kelola direktori situs-situs web',
'item_gerer_statistiques' => 'Kelola statistik',
'item_limiter_recherche' => 'Batasi pencarian pada informasi yang terdapat di situs anda',
'item_login' => 'Log masuk',
'item_messagerie_agenda' => 'Activer la messagerie et l&#8217;agenda', # NEW
'item_mots_cles_association_articles' => 'artikel',
'item_mots_cles_association_breves' => 'artikel berita',
'item_mots_cles_association_rubriques' => 'bagian',
'item_mots_cles_association_sites' => 'situs-situs referensi atau tersindikasi.',
'item_non' => 'No',
'item_non_accepter_inscriptions' => 'Jangan izinkan pendaftaran',
'item_non_activer_messages_avertissement' => 'Tidak ada pesan-pesan kesalahan',
'item_non_afficher_calendrier' => 'Jangan tampilkan dalam kalender',
'item_non_ajout_mots_cles' => 'Jangan otorisasi penambahan kata-kata kunci ke forum',
'item_non_autoriser_documents_joints' => 'Jangan otorisasi dokumen dalam artikel',
'item_non_autoriser_documents_joints_rubriques' => 'Jangan otorisasi dokumen dalam bagian',
'item_non_autoriser_selectionner_date_en_ligne' => 'La date des documents est celle de leur ajout sur le site', # NEW
'item_non_autoriser_syndication_integrale' => 'Kirim ringkasan saja',
'item_non_bloquer_liens_syndiques' => 'Jangan blokir tautan web yang berasal dari sindikasi',
'item_non_compresseur' => 'D&#233;sactiver la compression', # NEW
'item_non_config_forums_prive_global' => 'D&#233;sactiver le forum des r&#233;dacteurs', # NEW
'item_non_config_forums_prive_objets' => 'D&#233;sactiver ces forums', # NEW
'item_non_creer_fichiers_authent' => 'Jangan buat berkas-berkas ini',
'item_non_gerer_annuaire_site_web' => 'Non aktifkan direktori situs-situs web',
'item_non_gerer_statistiques' => 'Jangan kelola statistik',
'item_non_limiter_recherche' => 'Perluas pencarian isi dari situs-situs referensi',
'item_non_messagerie_agenda' => 'D&#233;sactiver la messagerie et l&#8217;agenda', # NEW
'item_non_publier_articles' => 'Jangan publikasi artikel sebelum tanggal publikasinya.',
'item_non_utiliser_breves' => 'Jangan gunakan berita',
'item_non_utiliser_config_groupe_mots_cles' => 'Jangan gunakan konfigurasi lanjutan kelompok kata kunci',
'item_non_utiliser_moteur_recherche' => 'Jangan gunakan sistem',
'item_non_utiliser_mots_cles' => 'Jangan gunakan kata-kata kunci',
'item_non_utiliser_syndication' => 'Jangan gunakan sindikasi terotomasi',
'item_nouvel_auteur' => 'Penulis baru',
'item_nouvelle_breve' => 'Artikel berita baru',
'item_nouvelle_rubrique' => 'Bagian baru',
'item_oui' => 'Ya',
'item_publier_articles' => 'Publikasi artikel tanpa menghiraukan tanggal publikasinya.',
'item_reponse_article' => 'Balasan pada artikel',
'item_utiliser_breves' => 'Gunakan berita',
'item_utiliser_config_groupe_mots_cles' => 'Gunakan konfigurasi lanjutan kelompok kata kunci',
'item_utiliser_moteur_recherche' => 'Gunakan mesin pencari',
'item_utiliser_mots_cles' => 'Gunakan kata-kata kunci',
'item_utiliser_syndication' => 'Gunakan sindikasi terotomasi',
'item_visiteur' => 'pengunjung',

// J
'jour_non_connu_nc' => 'tidak dikenal',

// L
'ldap_correspondance' => 'h&eacute;ritage du champ @champ@', # NEW
'ldap_correspondance_1' => 'H&eacute;ritage des champs LDAP', # NEW
'ldap_correspondance_2' => 'Pour chacun des champs SPIP suivants, indiquer le nom du champ LDAP correspondant. Laisser vide pour ne pas le remplir, s&eacute;parer par des espaces ou des virgules pour essayer plusieurs champs LDAP.', # NEW
'lien_ajout_destinataire' => 'Tambahkan penerima ini',
'lien_ajouter_auteur' => 'Tambahkan penulis ini',
'lien_ajouter_participant' => 'Tambahkan seorang peserta',
'lien_email' => 'e-mail',
'lien_forum_public' => 'Kelola artikel forum umum ini',
'lien_mise_a_jour_syndication' => 'Perbaharui sekarang',
'lien_nom_site' => 'NAMA SITUS:',
'lien_nouvelle_recuperation' => 'Mencoba melakukan pengambilan data baru',
'lien_reponse_article' => 'Balasan pada artikel',
'lien_reponse_breve' => 'Balasan pada artikel berita',
'lien_reponse_breve_2' => 'Balasan pada artikel berita',
'lien_reponse_rubrique' => 'Balasan pada bagian',
'lien_reponse_site_reference' => 'Balasan pada situs-situs referensi:',
'lien_retirer_auteur' => 'Hapus penulis',
'lien_retrait_particpant' => 'Hapus peserta ini',
'lien_site' => 'situs',
'lien_supprimer_rubrique' => 'hapus bagian ini',
'lien_tout_deplier' => 'Buka semuanya',
'lien_tout_replier' => 'Tutup semuanya',
'lien_tout_supprimer' => 'Hapus semua',
'lien_trier_nom' => 'Disusun berdasarkan nama',
'lien_trier_nombre_articles' => 'Disusun berdasarkan jumlah artikel',
'lien_trier_statut' => 'Disusun berdasarkan status',
'lien_voir_en_ligne' => 'LIHAT ONLINE:',
'logo_article' => 'LOGO ARTIKEL',
'logo_auteur' => 'LOGO PENULIS',
'logo_breve' => 'LOGO ARTIKEL BERITA',
'logo_mot_cle' => 'LOGO KATA KUNCI',
'logo_rubrique' => 'LOGO BAGIAN',
'logo_site' => 'LOGO SITUS INI',
'logo_standard_rubrique' => 'LOGO STANDAR UNTUK BAGIAN',
'logo_survol' => 'LOGO SAMARAN',

// M
'menu_aide_installation_choix_base' => 'Pilih database anda',
'module_fichier_langue' => 'Berkas bahasa',
'module_raccourci' => 'Jalan pintas',
'module_texte_affiche' => 'Teks tampilan',
'module_texte_explicatif' => 'Anda dapat memasukkan jalan-jalan pintas berikut ke dalam templat situs anda. Mereka akan diterjemahkan secara otomatis dalam berbagai bahasa bila berkas bahasanya telah tersedia.',
'module_texte_traduction' => 'Berkas bahasa &laquo;&nbsp;@module@&nbsp;&raquo; tersedia di:',
'mois_non_connu' => 'tidak dikenal',

// N
'nouvelle_version_spip' => 'La version @version@ de SPIP est disponible', # NEW

// O
'onglet_contenu' => 'Contenu', # NEW
'onglet_declarer_une_autre_base' => 'D&eacute;clarer une autre base', # NEW
'onglet_discuter' => 'Discuter', # NEW
'onglet_documents' => 'Documents', # NEW
'onglet_interactivite' => 'Interactivit&eacute;', # NEW
'onglet_proprietes' => 'Propri&eacute;t&eacute;s', # NEW
'onglet_repartition_actuelle' => 'sekarang',
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
'plugin_etat_developpement' => 'dalam pengembangan',
'plugin_etat_experimental' => 'eksperimental',
'plugin_etat_stable' => 'stabil',
'plugin_etat_test' => 'sedang dites',
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
'plugins_liste' => 'Daftar plugin',
'plugins_liste_extensions' => 'Extensions', # NEW
'plugins_recents' => 'Plugins r&eacute;cents.', # NEW
'plugins_vue_hierarchie' => 'Hi&eacute;rarchie', # NEW
'plugins_vue_liste' => 'Liste', # NEW
'protocole_ldap' => 'Versi protokol:',

// R
'repertoire_plugins' => 'Directori:',

// S
'sans_heure' => 'sans heure', # NEW
'sauvegarde_fusionner' => 'Gabung database sekarang dengan backup',
'sauvegarde_fusionner_depublier' => 'D&eacute;publier les objets fusionn&eacute;s', # NEW
'sauvegarde_url_origine' => 'Jika diperlukan, URL situs sumber:',
'statut_admin_restreint' => '(admin terbatas)',
'syndic_choix_moderation' => 'Apa yang akan dilakukan dengan tautan berikut dari situs ini?',
'syndic_choix_oublier' => 'Apa yang akan dilakukan dengan tautan yang tidak ada lagi dalam berkas sindikasi?',
'syndic_choix_resume' => 'Sejumlah situs menawarkan teks penuh dari artikel-artikel mereka. Ketika teks penuh tersedia, apakah anda ingin mensindikasikannya:',
'syndic_lien_obsolete' => 'tautan yang tidak perlu',
'syndic_option_miroir' => 'blokir secara otomatis',
'syndic_option_oubli' => 'hapus (setelah @mois@&nbsp;bulan)',
'syndic_option_resume_non' => 'isi penuh dari artikel (format HTML)',
'syndic_option_resume_oui' => 'sekedar ringkasan (format teks)',
'syndic_options' => 'Opsi sindikasi:',

// T
'taille_cache_image' => 'Gambar-gambar dikalkulasi secara otomatis oleh SPIP (gambar kecil, judul yang ditransformasi ke dalam grafik, formula matematika dalam format Tex, dll.) dengan jumlah keseluruhan @taille@ di direktori @dir@ .',
'taille_cache_infinie' => 'Situs ini tidak memiliki batasan tetap untuk ukuran direktori cache.',
'taille_cache_maxi' => 'SPIP sedang mencoba untuk membatasi ukuran direktori cache sebesar lebih kurang <b>@octets@</b> data.',
'taille_cache_octets' => 'Ukuran cache sekarang adalah @octets@.',
'taille_cache_vide' => 'Cache kosong.',
'taille_repertoire_cache' => 'Ukuran cache saat ini',
'text_article_propose_publication' => 'Artikel yang dikirimkan untuk publikasi. Jangan segan-segan memberikan opini anda melalui forum yang yang terlampir di artikel ini (di bagian bawah halaman).', # MODIF
'text_article_propose_publication_forum' => 'N\'h&eacute;sitez pas &agrave; donner votre avis gr&acirc;ce au forum attach&eacute; &agrave; cet article (en bas de page).', # NEW
'texte_acces_ldap_anonyme_1' => 'Sejumlah server LDAP tidak mengizinkan akses anonim. Dalam hal ini anda harus memberikan satu pengidentifikasi akses awal agar bisa mencari informasi dalam direktori setelahnya. Walaupun demikian, dalam banyak kasus kolom-kolom berikut dapat dibiarkan kosong tidak terisi.',
'texte_admin_effacer_01' => 'Perintah ini menghapus <i>semua</i> isi database,
termasuk <i>semua</i> parameter akses untuk editor dan administrator. Setelah mengeksekusinya, anda sebaiknya
menginstal kembali SPIP untuk membuat database baru dan akses administrator pertama.',
'texte_admin_effacer_stats' => 'Cette commande efface toutes les donn&eacute;es li&eacute;es aux statistiques de visite du site, y compris la popularit&eacute; des articles.', # NEW
'texte_admin_tech_01' => 'Opsi ini mengizinkan anda untuk menyimpan isi database ke dalam sebuah berkas di direktori @dossier@. Juga, mengingatkan anda untuk mengambil seluruh direktori @img@, yang berisikan gambar-gambar dan dokumen-dokumen yang digunakan dalam artikel dan bagian.',
'texte_admin_tech_02' => 'Peringatan: backup ini HANYA dapat dipulihkan dalam sebuah situs yang diinstal dalam versi yang sama dengan SPIP. Anda seharusnya tidak mengosongkan database dan diharapkan menginstal kembali backup setelah pembaharuan... Untuk informasi lebih lanjut silakan membaca <a href="@spipnet@">dokumentasi SPIP</a>.', # MODIF
'texte_admin_tech_03' => 'Anda dapat memilih untuk menyimpan berkas dalam bentuk kompresi 
	untuk mempercepat tranfer ke mesin anda atau server backup dan menyimpan sejumlah ruangan di disk.',
'texte_admin_tech_04' => 'Dans un but de fusion avec une autre base, vous pouvez limiter la sauvegarde &agrave; la rubrique: ', # NEW
'texte_adresse_annuaire_1' => '( Jika direktori anda diinstal di mesin yang sama dengan situs web anda, kemungkinan besar ini adalah &laquo;localhost&raquo;.)',
'texte_ajout_auteur' => 'Penulis berikut telah ditambahkan ke artikel:',
'texte_annuaire_ldap_1' => 'Jika anda memiliki akses ke sebuah direktori (LDAP), anda dapat menggunakannya untuk mengimpor pengguna secara otomatis di bawah SPIP.',
'texte_article_statut' => 'Status artikel:',
'texte_article_virtuel' => 'Artikel maya',
'texte_article_virtuel_reference' => '<b>Artikel maya:</b> artikel referensi di situs SPIP anda, yang dialihkan ke lain URL. Untuk menghapus pengalihan, hapuslah URL di atas.',
'texte_aucun_resultat_auteur' => 'Tidak ada hasil untuk "@cherche_auteur@".',
'texte_auteur_messagerie' => 'Situs ini dapat memonitor secara terus-menerus daftar editor-editor yang terkoneksi, yang mengizinkan anda untuk bertukar pesan secara langsung. Anda dapat memilih untuk tidak muncul dalam daftar ini (yang membuat anda kemudian, "tak terlihat" di hadapan pengguna lainnya).',
'texte_auteur_messagerie_1' => 'Situs ini mengizinkan anda untuk bertukar pesan dan membuat forum diskusi pribadi di antara pengunjung situs. Anda dapat memilih untuk tidak berpartisipasi dalam pertukaran ini.',
'texte_auteurs' => 'PENULIS',
'texte_breves' => 'Berita adalah teks singkat dan sederhana yang mengizinkan
	publikasi online informasi, ulasan-ulasan, peristiwa-peristiwa.....',
'texte_choix_base_1' => 'Pilih database anda:',
'texte_choix_base_2' => 'Server SQL berisikan sejumlah database.',
'texte_choix_base_3' => '<b>Pilih</B> di bawah salah satu yang diberikan hosting anda kepada anda:',
'texte_choix_table_prefix' => 'Prefiks untuk tabel:',
'texte_commande_vider_tables_indexation' => 'Gunakan perintah ini untuk mengosongkan tabel terindeksasi
			yang digunakan oleh mesin pencari SPIP. Ini akan memberi anda
			sejumlah ruangan di disk.',
'texte_comment_lire_tableau' => 'Peringkat artikel di klasifikasi
		popularitas, ditunjukkan dalam margin; popularitas
		artikel (perkiraan jumlah kunjungan harian yang dimiliki
		jika lalu lintas sekarang diperlihara) dan jumlah
		kunjungan yang disimpan sejak awal ditampilkan dalam
		balon yang muncul sewaktu mouse diletakkan di atas judul.',
'texte_compacter_avertissement' => 'Attention &#224; ne pas activer ces options durant le d&#233;veloppement de votre site : les &#233;l&#233;ments compact&#233;s perdent toute lisibilit&#233;.', # NEW
'texte_compacter_script_css' => 'SPIP peut compacter les scripts javascript et les feuilles de style CSS, pour les enregistrer dans des fichiers statiques ; cela acc&#233;l&#232;re l\'affichage du site.', # NEW
'texte_compresse_ou_non' => '(yang ini dapat dikompres atau tidak)',
'texte_compresseur_page' => 'SPIP peut compresser automatiquement chaque page qu\'il envoie aux
visiteurs du site. Ce r&#233;glage permet d\'optimiser la bande passante (le
site est plus rapide derri&#232;re une liaison &#224; faible d&#233;bit), mais
demande plus de puissance au serveur.', # NEW
'texte_compte_element' => '@count@ elemen',
'texte_compte_elements' => '@count@ elemen',
'texte_config_groupe_mots_cles' => 'Apakah anda ingin menaktifkan konfigurasi lanjutan kelompok kata kunci,
			dengan menspesifikasi, sebagai contoh sebuah kata unik per kelompok
			dapat dipilih, yang menurut kelompok tersebut penting...?',
'texte_conflit_edition_correction' => 'Veuillez contr&#244;ler ci-dessous les diff&#233;rences entre les deux versions du texte&nbsp;; vous pouvez aussi copier vos modifications, puis recommencer.', # NEW
'texte_connexion_mysql' => 'Merujuk kepada informasi yang diberikan hosting anda kepada anda: mereka seharusnya memberikan anda, jika hosting anda mendukung SQL, kode koneksi ke server SQL.', # MODIF
'texte_contenu_article' => '(Isi artikel dalam beberapa kata.)',
'texte_contenu_articles' => 'Berdasarkan tampilan yang dipilih untuk situs anda, anda dapat memilih
  sejumlah elemen artikel tidak digunakan.
  Gunakan daftar berikut untuk memilih elemen mana yang akan dipakai.',
'texte_crash_base' => 'Jika database anda
			rusak, anda dapat mencoba memperbaikinya
			secara otomatis.',
'texte_creer_rubrique' => 'Sebelum dapat menulis artikel,<BR> anda harus membuat sebuah bagian.',
'texte_date_creation_article' => 'TANGGAL PENULISAN ARTIKEL:',
'texte_date_publication_anterieure' => 'Tanggal publikasi awal:',
'texte_date_publication_anterieure_nonaffichee' => 'Sembunyikan data publikasi awal.',
'texte_date_publication_article' => 'TANGGAL PUBLIKASI ONLINE:',
'texte_descriptif_petition' => 'Deskripsi petisi',
'texte_descriptif_rapide' => 'Deskripsi singkat',
'texte_documents_joints' => 'Anda dapat mengizinkan penambahan dokumen (berkas-berkas office, gambar,
 multimedia, dll.) ke artikel dan/atau bagian. Berkas-berkas ini
 kemudian dapat direferensi dalam artikel atau ditampilkan terpisah.', # MODIF
'texte_documents_joints_2' => 'Pengaturan ini tidak menghentikan penambahan gambar secara langsung dalam artikel.',
'texte_effacer_base' => 'Hapus database SPIP',
'texte_effacer_donnees_indexation' => 'Hapus data terindeksasi',
'texte_effacer_statistiques' => 'Effacer les statistiques', # NEW
'texte_en_cours_validation' => 'Artikel-artikel dan berita-berita berikut dikirim untuk publikasi. Jangan segan-segan memberikan opini anda melalui forum yang terlampir di dalamnya.', # MODIF
'texte_en_cours_validation_forum' => 'N\'h&eacute;sitez pas &agrave; donner votre avis gr&acirc;ce aux forums qui leur sont attach&eacute;s.', # NEW
'texte_enrichir_mise_a_jour' => 'Anda dapat memperkaya tampilan teks anda dengan menggunakan &laquo;jalan pintas typografis&raquo;.',
'texte_fichier_authent' => '<b>Haruskah SPIP membuat berkas <tt>.htpasswd</tt>
  dan <tt>.htpasswd-admin</tt> dalam direktori @dossier@?</b><p>
  Berkas-berkas ini dapat digunakan untuk membatasi akses penulis
  dan administrator di bagian lain situs anda
  (sebagai contoh, program statistik eksternal).</p><p>
  Jika anda tidak memerlukan berkas-berkas tersebut, anda dapat
  membiarkannya dengan nilai standar yang diberikan (tidak ada 
  pemmbuat berkas-berkas baru).</p>', # MODIF
'texte_informations_personnelles_1' => 'Sistem akan memberikan anda sekarang akses tersendiri ke situs.',
'texte_informations_personnelles_2' => '(Catatan: jika ini adalah instalasi kembali, dan akses anda masih berlaku, anda dapat',
'texte_introductif_article' => '(Teks Pengantar artikel.)',
'texte_jeu_caractere' => 'Anda disarankan menggunakan aksara universal (<tt>utf-8</tt>) di situs anda. Ini memungkinkan untuk menampilkan teks dalam segala bahsa. Browser modern tidak akan mengalami kesulitan dalam menangani set karakter ini.',
'texte_jeu_caractere_2' => 'Catatan: Pengaturan ini tidak akan mengubah teks yang sudah disimpan dalam database.',
'texte_jeu_caractere_3' => 'Situs anda saat ini menggunakan set karakter ini:',
'texte_jeu_caractere_4' => 'Jika itu tidak berkaitan dengan situasi yang anda miliki dengan data anda (sebagai contoh, setelah pemulihan database anda dari backup), atau jika <em>anda mengkonfigurasi situs ini</em> dan berkeinginan menggunakan set karakter yang berbeda, silakan tunjukkan set karakter di sini:',
'texte_jeu_caractere_conversion' => 'Catatan: Anda dapat memutuskan untuk mengubah semua teks (artickel, berita, forum, dll.) situs anda dan semua set karakter ke <tt>utf-8</tt>. Untuk melakukan ini, silakan kunjungi <a href="@url@">halaman konversi UTF-8</a>.',
'texte_lien_hypertexte' => '(Jika pesan anda merujuk pada sebuah artikel yang dipublikasi di Web, atau ke halaman yang berisikan informasi lebih banyak, silakan memasukkan judul halaman dan URL nya di sini.)',
'texte_liens_sites_syndiques' => 'Tautan yang berasal dari situs-situs tersindikasi
			dapat diblok sebelumnya; pengaturan berikut
			menampilkan pengaturan standar dari situs-
			situs tersindikasi setelah dibuat. Ini
			memungkinkan untuk memblokir setiap tautan
			secara individual, atau memilih, untuk setiap
			situs, memblokir tautan yang berasal dari
			situs-situs tertentu.',
'texte_login_ldap_1' => '(Biarkan kosong untuk akses anonim atau masukkan path lengkap, sebagai contoh &laquo;<tt>uid=smith, ou=users, dc=my-domain, dc=com</tt>&raquo;.)',
'texte_login_precaution' => 'Peringatan! Ini adalah log masuk yang anda gunakan untuk terkoneksi sekarang.
	Gunakan formulir ini dengan hati-hati...',
'texte_message_edit' => 'Peringatan: pesan ini dapat dimodifikasi oleh semua administrator situs, dan muncul di hadapan semua editor. Gunakan pengumuman hanya untuk menekankan pentingnya sebuah kejadian dalam siklus hidup situs.',
'texte_messagerie_agenda' => 'Une messagerie permet aux r&#233;dacteurs du site de communiquer entre eux directement dans l&#8217;espace priv&#233; du site. Elle est associ&#233;e &#224; un agenda.', # NEW
'texte_messages_publics' => 'Pesan umum artikel:',
'texte_mise_a_niveau_base_1' => 'Anda harus memperbaharui berkas-berkas SPIP.
	Sekarang anda harus memperbaharui database situs.',
'texte_modifier_article' => 'Modifikasi artikel:',
'texte_moteur_recherche_active' => '<b>Mesin pencari diaktifkan.</b> Gunakan perintah ini
		jika anda ingin mengeksekusi indeksasi ulang (setelah pemulihan
		sebuah backup sebagai contohnya). Anda seharusnya memperhatikan bahwa
		dokumen yang dimodifikasi secara normal (dari tatap muka SPIP) akan diindeks
		kembali secara otomatis: oleh karenanya perintah ini hanya berlaku dalam
		situasi tertentu saja.',
'texte_moteur_recherche_non_active' => 'Mesin pencari tidak diaktifkan.',
'texte_mots_cles' => 'Kata-kata kunci mengizinkan anda untuk membuat tautan bertopik di antara artikel-artikel anda
  tanpa memperhatikan lokasi bagiannya. Dengan cara itu anda dapat
  memperkaya navigasi situs anda atau menggunakan properti ini
  untuk mengkustomisasi artikel di templat anda.',
'texte_mots_cles_dans_forum' => 'Apakah anda hendak mengizinkan penggunaan kata-kata kunci yang dapat dipilih oleh pengunjung, di forum situs umum? (Peringatan: opsi ini jarang dipakai sebagaimana mestinya.)',
'texte_multilinguisme' => 'Jika anda ingin mengelola artikel-artikel dalam beberapa bahasa, dengan navigasi yang kompleks, anda dapat menambah sebuah menu pemilih bahasa di artikel dan/atau bagian, sesuai dengan organisasi dari situs anda.',
'texte_multilinguisme_trad' => 'Selain itu, anda juga dapat mengaktifkan sistem manajemen tautan di antara terjemahan yang berbeda dari sebuah artikel.',
'texte_non_compresse' => '<i>tidak dikompresi</i> (server anda tidak mendukung fitur ini)',
'texte_non_fonction_referencement' => 'Anda dapat memilih untuk tidak menggunakan fitur terotomasi ini, dan masukkan elemen-elemen yang berkaitan dengan situs secara manual...',
'texte_nouveau_message' => 'Pesan baru',
'texte_nouveau_mot' => 'Kata kunci baru',
'texte_nouvelle_version_spip_1' => 'Anda baru saja menginstal versi terbaru SPIP.',
'texte_nouvelle_version_spip_2' => 'Versi terbaru ini membutuhkan pembaharuan secara menyeluruh daripada biasanya. Jika anda adalah webmaster situs ini, silakan hapus berkas @connect@ dan jalankan kembali instalasi untuk memperbaharui paramater-parameter koneksi database anda. <p>(Catatan: Jika anda lupa paramater-parameter koneksi database anda, silakan lihat berkas @connect@ sebelum menghapusnya!)</p>', # MODIF
'texte_operation_echec' => 'Kembali ke halaman sebelumnya, pilih database lain atau buat yang baru. Verifikasi informasi yang diberikan oleh hosting anda.',
'texte_plus_trois_car' => 'lebih dari 3 karakter',
'texte_plusieurs_articles' => 'Sejumla penulis ditemukan untuk "@cherche_auteur@":',
'texte_port_annuaire' => '(Nilai standar dipakai pada umumnya.)',
'texte_presente_plugin' => 'Halaman ini menampilkan daftar plugin yang tersedia di situs. Aktifkan plugin yang anda butuhkan dengan memberi tanda di kotak yang bersangkutan.',
'texte_proposer_publication' => 'Ketika artikel anda selesai ditulis,<br> anda dapat mengirimkannya untuk publikasi.',
'texte_proxy' => 'Dalam beberapa kasus (intranet, jaringan pribadi...),
		<i>proxy HTTP</i> perlu digunakan untuk menjangkau situs-situs tersindikasi.
		Kalau memang ada proxy, masukkan alamat di bawah,
		<tt><html>http://proxy:8080</html></tt>. Pada umumnya,
		anda akan membiarkan kotak ini kosong.',
'texte_publication_articles_post_dates' => 'Perilaku apa SPIP seharusnya terapkan berkaitan dengan artikel-artikel
		yang publikasinya diset untuk
		sebuah tanggal di masa depan?',
'texte_rappel_selection_champs' => '[Ingat untuk memilih kolom ini dengan benar.]',
'texte_recalcul_page' => 'Jika anda hanya ingin
memperbaharui satu halaman, anda sebaiknya melakukannya dari area umum dan gunakan tombol &laquo; perbaharui &raquo;.',
'texte_recapitiule_liste_documents' => 'Halaman ini menampilkan daftar dari dokumen-dokumen yang anda tempatkan di bagian-bagian. Untuk memodifikasi informasi setiap dokumen, ikuti tautan ke halaman bagiannya.',
'texte_recuperer_base' => 'Perbaiki database',
'texte_reference_mais_redirige' => 'artikel referensi di situs SPIP anda, tapi mengarah ke URL lain.',
'texte_referencement_automatique' => '<b>Referensi situs terotomasi</b><br>Anda dapat mereferensi sebuah situs web secara cepat dengan memberikan di bawah URL yang dimaksud, atau alamat berkas sindikasinya. SPIP secara otomatis akan mengambil informasi yang berkaitan dengan situs tersebut (judul, deskripsi...).',
'texte_referencement_automatique_verifier' => 'Veuillez v&eacute;rifier les informations fournies par <tt>@url@</tt> avant d\'enregistrer.', # NEW
'texte_requetes_echouent' => '<b>Wetika sejumlah query SQL gagal
  secara sistematis dan tanpa alasan yang jelas, bisa jadi
  permasalahannya adalah database itu sendiri.</b><p>
  SQL memiliki fitur yang dapat memperbaiki tabel-tabelnya
  ketika mereka secara tidak sengaja menjadi rusak.
  Di sini, anda dapat mencoba melakukan perbaikan tersebut;
  jika gagal, anda sebaiknya menyimpan salinan dari tampilan
  yang mungkin dapat dijadikan petunjuk apa yang salah...</p><p>
  Jika permasalahan ini msih berlanjut, hubungi hosting anda.</p>', # MODIF
'texte_restaurer_base' => 'Pulihkan isi backup database',
'texte_restaurer_sauvegarde' => 'Opsi ini mengizinkan anda untuk memulihkan backup database
sebelumnya. Untuk melakukannya, berkas yang berisikan backup harus disimpan di
direktori @dossier@.
Berhati-hatilah dengan fitur ini: <b>Setiap modifikasi atau kerusakan tidak
dapat dipulihkan kembali.</b>',
'texte_sauvegarde' => 'Backup isi database',
'texte_sauvegarde_base' => 'Backup database',
'texte_sauvegarde_compressee' => 'Backup akan disimpan dalam berkas tidak terkompresi @fichier@.',
'texte_selection_langue_principale' => 'Anda dapat memilih di bawah "bahasa utama" situs. Untungnya, pilihan ini tidak membatasi anda menulis artikel dalam bahasa yang dipilih, tapi mengizinkan anda untuk menentukan

<ul><li> format tanggal standar di situs umum</li>

<li> mesin typografis yang akan digunakan oleh SPIP untuk menghasilkan teks;</li>

<li> bahasa yang digunakan di formulir-formulir situs umum</li>

<li> bahasa standar yang ditampilkan di area pribadi.</li></ul>',
'texte_signification' => 'Balok-balok gelap mewakili kumulatif entri (total sub-sub bagian), balok-balok terang mewakili jumlah kunjungan untuk setiap bagian.',
'texte_sous_titre' => 'Sub judul',
'texte_statistiques_visites' => '(balok gelap:  Minggu / kurva gelap: tingkat rata-rata)',
'texte_statut_attente_validation' => 'validasi yang tertunda',
'texte_statut_publies' => 'dipublikasi online',
'texte_statut_refuses' => 'ditolak',
'texte_suppression_fichiers' => 'Gunakan perintah ini untuk menghapus semua berkas
dalam cache SPIP. Ini mengizinkan anda, antara lain, untuk memaksa semua halaman diperbaharui jika
anda memasukkan modifikasi yang penting di grafik atau struktur situs.',
'texte_sur_titre' => 'Judul atas',
'texte_syndication' => 'Jika sebuah situs mengizinkannya, daftar isi terbaru dari situs tersebut
  dapat diambil secara otomatis. Untuk melakukannya, anda harus mengaktifkan sindikasi.
  <blockquote><i>Sejumlah hosting menonaktifkan fungsi ini; 
  dalam hal ini, anda tidak dapat menggunakan sindikasi isi
  dari situs anda.</i></blockquote>', # MODIF
'texte_table_ok' => ': tabel ini OK.',
'texte_tables_indexation_vides' => 'Tabel terindeksasi mesin kosong.',
'texte_tentative_recuperation' => 'Usaha perbaikan',
'texte_tenter_reparation' => 'Usaha untuk memperbaiki database.',
'texte_test_proxy' => 'Untuk mencoba proxy ini, masukkan alamat sebuah situs web di sini
				yang ingin anda tes.',
'texte_titre_02' => 'Subyek:',
'texte_titre_obligatoire' => '<b>Judul</b> [Dibutuhkan]',
'texte_travail_article' => '@nom_auteur_modif@ telah bekerja di artikel ini @date_diff@ menit yang lalu',
'texte_travail_collaboratif' => 'Jika beberapa editor sering bekerja sama dalam artikel yang sama, sistem dapat menandai artikel-artikel yang saat itu sedang &laquo;dibuka&raquo; guna menghindari konflik saat diedit.
  Opsi ini dinonaktifkan secara standar untuk menghindri pesan-pesan peringatan yang tidak perlu.',
'texte_trop_resultats_auteurs' => 'Terlalu banyak hasil untuk "@cherche_auteur@"; silakan perbaiki pencarian anda.',
'texte_type_urls' => 'Vous pouvez choisir ci-dessous le mode de calcul de l\'adresse des pages.', # NEW
'texte_type_urls_attention' => 'Attention ce r&eacute;glage ne fonctionnera que si le fichier @htaccess@ est correctement install&eacute; &agrave; la racine du site.', # NEW
'texte_unpack' => 'mengunduh versi terakhir',
'texte_utilisation_moteur_syndiques' => 'Ketika anda menggunakan mesin pencari SPIP, anda dapat melakukan pencarian di situs dan artikel yang tersindikasi dala dua cara yang berbeda. <br>- Cara termudah adalah mencari hanya di judul dan deskripsi artikel. <br>- Kedua, cara yang lebih bagus, selain di atas juga mencari dalam teks situs-situs referensi. Jika anda mereferensi sebuah situs, SPIP akan melakukan pencarian di teks situs tersebut.', # MODIF
'texte_utilisation_moteur_syndiques_2' => 'Metode ini memaksa SPIP untuk mengunjungi situs-situs referensi secara teratur, yang mungkin dapat menurunkan kinerja situs anda.',
'texte_vide' => 'kosong',
'texte_vider_cache' => 'Kosongkan cache',
'titre_admin_effacer' => 'Pemeliharaan teknis',
'titre_admin_tech' => 'Pemeliharaan teknis',
'titre_admin_vider' => 'Pemeliharaan teknis',
'titre_articles_syndiques' => 'Artikel-artikel tersindikasi ditarik dari situs ini',
'titre_breves' => 'Berita',
'titre_cadre_afficher_article' => 'Tampilkan artikel:',
'titre_cadre_afficher_traductions' => 'Tampikan status terjemahan dari bahasa-bahasa berikut:',
'titre_cadre_ajouter_auteur' => 'TAMBAH SEORANG PENULIS:',
'titre_cadre_forum_administrateur' => 'Forum pribadi para administrator',
'titre_cadre_forum_interne' => 'Forum intern',
'titre_cadre_interieur_rubrique' => 'Dalam bagian',
'titre_cadre_numero_auteur' => 'NOMOR PENULIS',
'titre_cadre_signature_obligatoire' => '<b>Tanda tangan</B> [Dibutuhkan]<BR>',
'titre_compacter_script_css' => 'Compactage des scripts et CSS', # NEW
'titre_compresser_flux_http' => 'Compression du flux HTTP', # NEW
'titre_config_contenu_notifications' => 'Notifications', # NEW
'titre_config_contenu_prive' => 'Dans l&#8217;espace priv&#233;', # NEW
'titre_config_contenu_public' => 'Sur le site public', # NEW
'titre_config_fonctions' => 'Konfigurasi situs',
'titre_config_forums_prive' => 'Forums de l&#8217;espace priv&#233;', # NEW
'titre_config_groupe_mots_cles' => 'Konfigurasi kelompok kata kunci',
'titre_configuration' => 'Konfigurasi situs',
'titre_conflit_edition' => 'Conflit lors de l\'&#233;dition', # NEW
'titre_connexion_ldap' => 'Opsi: <b>Koneksi LDAP anda</b>',
'titre_dernier_article_syndique' => 'Artikel-artikel sindikasi terbaru',
'titre_documents_joints' => 'Lampiran',
'titre_evolution_visite' => 'Tingkat kunjungan',
'titre_forum_suivi' => 'Tindak lanjut forum',
'titre_gauche_mots_edit' => 'NOMOR KATA KUNCI:',
'titre_groupe_mots' => 'KELOMPOK KATA KUNCI:',
'titre_langue_article' => 'BAHASA ARTIKEL',
'titre_langue_breve' => 'BAHASA ARTIKEL BERITA',
'titre_langue_rubrique' => 'BAHASA BAGIAN',
'titre_langue_trad_article' => 'BAHASA ARTIKEL DAN TERJEMAHAN',
'titre_les_articles' => 'ARTIKEL',
'titre_messagerie_agenda' => 'Messagerie et agenda', # NEW
'titre_mots_cles_dans_forum' => 'Kata-kata kunci di forum situs umum',
'titre_mots_tous' => 'Kata kunci',
'titre_naviguer_dans_le_site' => 'Jelajah situs...',
'titre_nouveau_groupe' => 'Kelompok baru',
'titre_nouvelle_breve' => 'Artikel berita baru',
'titre_nouvelle_rubrique' => 'Bagian baru',
'titre_numero_rubrique' => 'NOMOR BAGIAN:',
'titre_page_admin_effacer' => 'Pemeliharaan teknis: mengahpus database',
'titre_page_articles_edit' => 'Modifikasi: @titre@',
'titre_page_articles_page' => 'Artikel',
'titre_page_articles_tous' => 'Seluruh situs',
'titre_page_auteurs' => 'Pengunjung',
'titre_page_breves' => 'Berita',
'titre_page_breves_edit' => 'Modifikasi artikel berita: &laquo;@titre@&raquo;',
'titre_page_calendrier' => 'Kalender @nom_mois@ @annee@',
'titre_page_config_contenu' => 'Konfigurasi situs',
'titre_page_config_fonctions' => 'Konfigurasi situs',
'titre_page_configuration' => 'Konfigurasi situs',
'titre_page_controle_petition' => 'Tindak lanjut petisi',
'titre_page_delete_all' => 'penghapusan menyeluruh dan tidak dapat dikembalikan lagi',
'titre_page_documents_liste' => 'Lampiran',
'titre_page_forum' => 'Forum administrator',
'titre_page_forum_envoi' => 'Kirim sebuah pesan',
'titre_page_forum_suivi' => 'Tindak lanjut forum',
'titre_page_index' => 'Area pribadi anda',
'titre_page_message_edit' => 'Tulis sebuah pesan',
'titre_page_messagerie' => 'Sistem pesan anda',
'titre_page_mots_tous' => 'Kata kunci',
'titre_page_recherche' => 'Hasil pencarian @recherche@',
'titre_page_sites_tous' => 'Situs-situs referensi',
'titre_page_statistiques' => 'Statistik berdasarkan bagian',
'titre_page_statistiques_messages_forum' => 'Messages de forum', # NEW
'titre_page_statistiques_referers' => 'Statistik (tautan masuk)',
'titre_page_statistiques_signatures_jour' => 'Nombre de signatures par jour', # NEW
'titre_page_statistiques_signatures_mois' => 'Nombre de signatures par mois', # NEW
'titre_page_statistiques_visites' => 'Statistik kunjungan',
'titre_page_upgrade' => 'Pembaharuan SPIP',
'titre_publication_articles_post_dates' => 'Publikasi artikel terjadwal',
'titre_referencement_sites' => 'Referensi dan sindikasi situs',
'titre_referencer_site' => 'Referensi situs:',
'titre_rendez_vous' => 'JANJI:',
'titre_reparation' => 'Perbaikan',
'titre_site_numero' => 'NOMOR SITUS:',
'titre_sites_proposes' => 'Situs-situs yang dikirim',
'titre_sites_references_rubrique' => 'Situs-situs referensi dalam bagian ini',
'titre_sites_syndiques' => 'Situs-situs tersindikasi',
'titre_sites_tous' => 'Situs-situs referensi',
'titre_suivi_petition' => 'Tindak lanjut petisi',
'titre_syndication' => 'Sindikasi situs',
'titre_type_urls' => 'Type d\'adresses URL', # NEW
'tls_ldap' => 'Pengamanan layer transportasi:',
'tout_dossier_upload' => 'Seluruh direktori @upload@',
'trad_article_inexistant' => 'Tidak ada artikel dengan nomor ini',
'trad_article_traduction' => 'Semua versi artikel ini:',
'trad_deja_traduit' => 'Artikel ini adalah terjemahan dari artikel yang sekarang.',
'trad_delier' => 'Berhenti menautkan artikel ini ke terjemahannya',
'trad_lier' => 'Artikel ini adalah terjemahan dari artikel nomor:',
'trad_new' => 'Tulis terjemahan baru untuk artikel ini',

// U
'upload_fichier_zip' => 'berkas ZIP',
'upload_fichier_zip_texte' => 'Berkas yang hendak anda instal adalah berkas ZIP.',
'upload_fichier_zip_texte2' => 'Berkas ini bisa jadu:',
'upload_info_mode_document' => 'D&#233;poser cette image dans le portfolio', # NEW
'upload_info_mode_image' => 'Retirer cette image du portfolio', # NEW
'upload_limit' => 'Berkas ini terlalu besar untuk server; ukuran maksimum yang diperbolehkan untuk <i>unggah</i> adalah @max@.',
'upload_zip_conserver' => 'Conserver l&#8217;archive apr&#232;s extraction', # NEW
'upload_zip_decompacter' => 'diekstrak dan setiap berkas yang terdapat di dalamnya akan diinstal di situs. Berkas-berkas yang akan diinstal adalah:',
'upload_zip_telquel' => 'diinstal seperti apa adanya, sebagai berkas ZIP;',
'upload_zip_titrer' => 'Titrer selon le nom des fichiers', # NEW
'utf8_convert_attendez' => 'Tunggu beberapa saat dan perbaharui halaman ini.',
'utf8_convert_avertissement' => 'Anda akan mengubah isi database anda (artikel, berita, dll) dari set karakter <b>@orig@</b> ke set karakter <b>@charset@</b>.',
'utf8_convert_backup' => 'Jangan lupa membuat backup lengkap situs anda terlebih dahulu. Anda juga perlu memeriksa bahawa templat dan bahasa anda kompatibel dengan @charset@.',
'utf8_convert_erreur_deja' => 'Situs anda sudah dalam @charset@, tidak ada yang perlu diubah.',
'utf8_convert_erreur_orig' => 'Kesalahan: set karakter @charset@ tidak didukung.',
'utf8_convert_termine' => 'Selesai!',
'utf8_convert_timeout' => '<b>Penting:</b> Jika server menunjukkan <i>timeout</i>, silakan perbaharui halaman di mana anda memperoleh pesan &laquo;Selesai!&raquo;.',
'utf8_convert_verifier' => 'Anda sekarang harus mengosongkan cache situs dan periksa apakah semuanya baik-baik saja di halaman-halaman umum situs. Jika anda mengalami sebuah permasalahan besar, sebuah backup data asli anda (dalam format SQL) telah dibuat di direktori @rep@.',
'utf8_convertir_votre_site' => 'Ubah situs anda ke utf-8',

// V
'version' => 'Versi:',
'version_deplace_rubrique' => 'D&#233;plac&#233; de <b>&#171;&nbsp;@from@&nbsp;&#187;</b> vers <b>&#171;&nbsp;@to@&nbsp;&#187;</b>.', # NEW
'version_initiale' => 'Versi awal'
);

?>
