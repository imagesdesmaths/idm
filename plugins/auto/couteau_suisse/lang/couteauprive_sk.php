<?php
// This is a SPIP language file  --  Ceci est un fichier langue de SPIP
// extrait automatiquement de http://www.spip.net/trad-lang/
// ** ne pas modifier le fichier **

if (!defined("_ECRIRE_INC_VERSION")) return;

$GLOBALS[$GLOBALS['idx_lang']] = array(

	// 2
	'2pts_non' => '<NEW>:&nbsp;&#269;.',
	'2pts_oui' => '<NEW>:&nbsp;&aacute;no',

	// S
	'SPIP_liens:description' => '@puce@ By default, all links on the site open in the current window. But it can be useful to open external links in a new window, i.e. adding {target="_blank"} to all link tags bearing one of the SPIP classes {spip_out}, {spip_url} or {spip_glossaire}. It is sometimes necessary to add one of these classes to the links in the site\'s templates (html files) in order make this functionality wholly effective.[[%radio_target_blank3%]]

@puce@ SPIP provides the shortcut <code>[?word]</code> to link words to their definition. By default (or if you leave the box below empty), wikipedia.org is used as the external glossary. You may choose another address. <br />Test link: [?SPIP][[%url_glossaire_externe2%]]', # MODIF
	'SPIP_liens:description1' => '@puce@ SPIP includes a CSS style for email links: a little envelope appears before each "mailto" link. However not all browsers can display it (IE6, IE7 and SAF3, in particular, cannot). It is up to you to decide whether to keep this addition.
_ Test link:[->test@test.com] (Reload the page to test.)[[%enveloppe_mails%]]', # MODIF
	'SPIP_liens:nom' => '<NEW>SPIP a extern&eacute; odkazy',
	'SPIP_tailles:description' => '<MODIF>@puce@ Afin d\'all&eacute;ger la m&eacute;moire de votre serveur, SPIP vous permet de limiter les dimensions (hauteur et largeur) et la taille du fichier des images, logos ou documents joints aux divers contenus de votre site. Si un fichier d&eacute;passe la taille indiqu&eacute;e, le formulaire enverra bien les donn&eacute;es mais elles seront d&eacute;truites et SPIP n\'en tiendra pas compte, ni dans le r&eacute;pertoire IMG/, ni en base de donn&eacute;es. Un message d\'avertissement sera alors envoy&eacute; &agrave; l\'utilisateur.

Une valeur nulle ou non renseign&eacute;e correspond &agrave; une valeur illimit&eacute;e.
[[Hauteur : %img_Hmax% pixels]][[->Largeur : %img_Wmax% pixels]][[->Poids du fichier : %img_Smax% Ko]]
[[Hauteur : %logo_Hmax% pixels]][[->Largeur : %logo_Wmax% pixels]][[->Poids du fichier : %logo_Smax% Ko]]
[[Poids du fichier : %doc_Smax% Ko]]

@puce@ D&eacute;finissez ici l\'espace maximal r&eacute;serv&eacute; aux fichiers distants que SPIP pourrait t&eacute;l&eacute;charger (de serveur &agrave; serveur) et stocker sur votre site. La valeur par d&eacute;faut est ici de 16 Mo.[[%copie_Smax% Mo]]

@puce@ Afin d\'&eacute;viter un d&eacute;passement de m&eacute;moire PHP dans le traitement des grandes images par la librairie GD2, SPIP teste les capacit&eacute;s du serveur et peut donc refuser de traiter les trop grandes images. Il est possible de d&eacute;sactiver ce test en d&eacute;finissant manuellement le nombre maximal de pixels support&eacute;s pour les calculs.

La valeur de 1~000~000 pixels semble correcte pour une configuration avec peu de m&eacute;moire. Une valeur nulle ou non renseign&eacute;e entra&icirc;nera le test du serveur.
[[%img_GDmax% pixels au maximum]]', # MODIF
	'SPIP_tailles:nom' => '<NEW>Obmedzenia pam&auml;te',

	// A
	'acces_admin' => '<NEW>Spr&aacute;vcovsk&yacute; pr&iacute;stup:',
	'action_rapide' => 'Rapid action, only if you know what you are doing!', # MODIF
	'action_rapide_non' => 'Rapid action, available when this tool is activated:', # MODIF
	'admins_seuls' => '<NEW>Len spr&aacute;vcovia',
	'attente' => '<NEW>&#268;ak&aacute; sa...',
	'auteur_forum:description' => 'Request all authors of public messages to fill in (with at least one letter!) a name and/or email in order to avoid completely anonymous messages. Note that the tool effectuates a Javascript validation on the user browser.[[%auteur_forum_nom%]][[->%auteur_forum_email%]][[->%auteur_forum_deux%]]
{Caution : The third option cancel the others. It\'s important to verify that the forms of your template are compatibles with this tool.}', # MODIF
	'auteur_forum:nom' => '<NEW>&#381;iadne anonymn&eacute; f&oacute;ra',
	'auteur_forum_deux' => '<NEW>alebo aspo&#328; jedno z dvoch predch&aacute;dzaj&uacute;cich pol&iacute;',
	'auteur_forum_email' => '<NEW>Pole &#132;@_CS_FORUM_EMAIL@&#147;',
	'auteur_forum_nom' => '<NEW>Pole &#132;@_CS_FORUM_NOM@&#147;',
	'auteurs:description' => 'This tool configures the appearance of [the authors\' page->./?exec=auteurs], in the private area.

@puce@ Define here the maximum number of authors to display in the central frame of the author\'s page. Beyond this number page numbering will be triggered.[[%max_auteurs_page%]]

@puce@ Which kinds of authors should be listed on the spages?
[[%auteurs_tout_voir%[[->%auteurs_0%]][[->%auteurs_1%]][[->%auteurs_5%]][[->%auteurs_6%]][[->%auteurs_n%]]]]', # MODIF
	'auteurs:nom' => '<NEW>Autorsk&aacute; str&aacute;nka',

	// B
	'balise_set:description' => 'Afin d\'all&eacute;ger les &eacute;critures du type <code>#SET{x,#GET{x}|un_filtre}</code>, cet outil vous offre le raccourci suivant : <code>#SET_UN_FILTRE{x}</code>. Le filtre appliqu&eacute; &agrave; une variable passe donc dans le nom de la balise.



Exemples : <code>#SET{x,1}#SET_PLUS{x,2}</code> ou <code>#SET{x,avions}#SET_REPLACE{x,ons,ez}</code>.', # NEW
	'balise_set:nom' => 'Balise #SET &eacute;tendue', # NEW
	'barres_typo_edition' => '<MODIF>Editing contents', # MODIF
	'barres_typo_forum' => '<NEW>Spr&aacute;vy vo f&oacute;re',
	'barres_typo_intro' => 'The &laquo;Porte-Plume&raquo; plugin is installed. Please choose here the typographical bars on which to insert various buttons.', # MODIF
	'basique' => 'Basic', # MODIF
	'blocs:aide' => 'Folding blocks: <b>&lt;bloc&gt;&lt;/bloc&gt;</b> (alias: <b>&lt;invisible&gt;&lt;/invisible&gt;</b>) and <b>&lt;visible&gt;&lt;/visible&gt;</b>', # MODIF
	'blocs:description' => '<MODIF>Allows you to create blocks which show/hide when you click on the title.

@puce@ {{In SPIP texts}}: authors can use the tags &lt;bloc&gt; (or &lt;invisible&gt;) and &lt;visible&gt; in this way: 

<quote><code>
<bloc>
 Clickable title
 
 The text which be shown/hidden, after two new lines.
 </bloc>
</code></quote>

@puce@ {{In templates}}: you can use the tags #BLOC_TITRE, #BLOC_DEBUT and #BLOC_FIN in this way: 
<quote><code> #BLOC_TITRE
 My title
 #BLOC_RESUME    (optional)
 a summary of the following block
 #BLOC_DEBUT
 My collapsible block (which can be loaded by an AJAX URL, if needed)
 #BLOC_FIN</code></quote>

@puce@ If you tick "yes" below, opening one block will cause all other blocks on the page to close. i.e. only one block is open at a time.[[%bloc_unique%]]

@puce@ If you tick "yes" below, the state of the numbered blocks will be kept in a session cookie, in order to maintain the page\'s appearance as long as the session lasts.[[%blocs_cookie%]]

@puce@ By default, the Penknife uses the HTML tag &lt;h4&gt; for the titles of the collapsible blocks. You can specify another tag here &lt;hN&gt;:[[%bloc_h4%]]', # MODIF
	'blocs:nom' => 'Folding Blocks', # MODIF
	'boites_privees:description' => 'All the boxes described below appear somewhere in the editing area.[[%cs_rss%]][[->%format_spip%]][[->%stat_auteurs%]][[->%qui_webmasters%]][[->%bp_urls_propres%]][[->%bp_tri_auteurs%]]
- {{Penknife updates}}: a box on this configuration page showing the last changes made to the code of the plugin ([Source->@_CS_RSS_SOURCE@]).
- {{Articles in SPIP format}}: an extra folding box for your articles showing the source code used by their authors.
- {{Author stats}}: an extra box on [the authors\' page->./?exec=auteurs] showing the last 10 connected authors and unconfirmed registrations. Only administrators can view this information.
- {{SPIP webmasters}} : a box on the [authors\' page->./?exec=auteurs] showing which administrators are also SPIP webmasters. Only administrators can see this information. If you are a webmaster, see also the the tool "[.->webmestres]".
- {{Friendly URLs}}: a box for each objet type (article, section, author, ...) showing the clean URL associated with it and any existing aliases. The tool &laquo;&nbsp;[.->type_urls]&nbsp;&raquo; makes possible a fine adjustment of the site\'s URLs.- {{Order of authors}}: a folding box for articles which have more than one author, allowing you simply to adjust the order in which they are displayed.', # MODIF
	'boites_privees:nom' => 'Private boxes', # MODIF
	'bp_tri_auteurs' => 'Order of authors', # MODIF
	'bp_urls_propres' => 'See clean URLs', # MODIF
	'brouteur:description' => '<MODIF>Use the AJAX section selector when there are more than %rubrique_brouteur% section(s)', # MODIF
	'brouteur:nom' => 'Configuration of the section selector', # MODIF

	// C
	'cache_controle' => 'Cache control', # MODIF
	'cache_nornal' => 'Normal usage', # MODIF
	'cache_permanent' => 'Permanent cache', # MODIF
	'cache_sans' => 'No cache', # MODIF
	'categ:admin' => '1. Administration', # MODIF
	'categ:divers' => '60. Miscellaneous', # MODIF
	'categ:interface' => '10. Private interface', # MODIF
	'categ:public' => '40. Public site', # MODIF
	'categ:securite' => '5. S&eacute;curit&eacute;', # NEW
	'categ:spip' => '50. Tags, filters, criteria', # MODIF
	'categ:typo-corr' => '20. Text improvements', # MODIF
	'categ:typo-racc' => '30. Typographical shortcuts', # MODIF
	'certaines_couleurs' => 'Only the tags defined below @_CS_ASTER@:', # MODIF
	'chatons:aide' => 'Smileys: @liste@', # MODIF
	'chatons:description' => 'Replace <code>:name</code> with smiley images in the text.
_ This tool will replace the shortcuts by the images of the same name found in the directory <code>mon_squelette_toto/img/chatons/</code>, or else, by default, in <code>couteau_suisse/img/chatons/</code>.', # MODIF
	'chatons:nom' => 'Smileys', # MODIF
	'citations_bb:description' => '<MODIF>In order to respect the HTML usages in the SPIP content of your site (articles, sections, etc.), this tool replaces the markup &lt;quote&gt; by the markup &lt;q&gt; when there is no line return. ', # MODIF
	'citations_bb:nom' => 'Well delimited citations', # MODIF
	'class_spip:description1' => 'Here you can define some SPIP shortcuts. An empty value is equivalent to using the default.[[%racc_hr%]]', # MODIF
	'class_spip:description2' => '@puce@ {{SPIP shortcuts}}.

Here you can define some SPIP shortcuts. An empty value is equivalent to using the default.[[%racc_hr%]][[%puce%]]', # MODIF
	'class_spip:description3' => '

{N.B. If the tool "[.->pucesli]" is active, then the replacing of the hyphen "-" will no longer take place; a list &lt;ul>&lt;li> will be used instead.}

SPIP normally uses the &lt;h3&gt; tag for subtitles. Here you can choose a different tag: [[%racc_h1%]][[->%racc_h2%]]', # MODIF
	'class_spip:description4' => '

SPIP normally uses &lt;strong> for marking boldface type. But &lt;b> could also be used. You can choose: [[%racc_g1%]][[->%racc_g2%]]

SPIP normally uses &lt;i> for marking italics. But &lt;em> could also be used. You can choose: [[%racc_i1%]][[->%racc_i2%]]

 You can also define the code used to open and close the calls to footnotes (N.B. These changes will only be visible on the public site.): [[%ouvre_ref%]][[->%ferme_ref%]]
 
 You can define the code used to open and close footnotes: [[%ouvre_note%]][[->%ferme_note%]]

@puce@ {{SPIP styles}}. Up to version 1.92 of SPIP, typographical shortcuts produced HTML tags all marked with the class "spip". For exeample, <code><p class="spip"></code>. Here you can define the style of these tags to link them to your stylesheet. An empty box means that no particular style will be applied.

{N.B. If any shortcuts above (horizontal line, subtitle, italics, bold) have been modified, then the styles below will not be applied.}

<q1>
_ {{1.}} Tags &lt;p&gt;, &lt;i&gt;, &lt;strong&gt;: [[%style_p%]]
_ {{2.}} Tags &lt;tables&gt;, &lt;hr&gt;, &lt;h3&gt;, &lt;blockquote&gt; and the lists (&lt;ol&gt;, &lt;ul&gt;, etc.):[[%style_h%]]

N.B.: by changing the second parameter you will lose any standard styles associated with these tags.</q1>', # MODIF
	'class_spip:nom' => 'SPIP and its shortcuts...', # MODIF
	'code_css' => 'CSS', # MODIF
	'code_fonctions' => 'Functions', # MODIF
	'code_jq' => 'jQuery', # MODIF
	'code_js' => 'JavaScript', # MODIF
	'code_options' => 'Options', # MODIF
	'code_spip_options' => 'SPIP options', # MODIF
	'compacte_css' => 'Compacter les CSS', # NEW
	'compacte_js' => 'Compacter le Javacript', # NEW
	'compacte_prive' => 'Ne rien compacter en partie priv&eacute;e', # NEW
	'compacte_tout' => 'Ne rien compacter du tout (rend caduques les options pr&eacute;c&eacute;dentes)', # NEW
	'contrib' => 'More information: @url@', # MODIF
	'corbeille:description' => 'SPIP automatically deletes objets which have been put in the dustbin after one day. This is done by a "Cron" job, usually at 4 am. Here, you can block this process taking place in order to regulate the dustbin emptying yourself. [[%arret_optimisation%]]', # MODIF
	'corbeille:nom' => 'Wastebin', # MODIF
	'corbeille_objets' => '@nb@ object(s) in the wastebin.', # MODIF
	'corbeille_objets_lies' => '@nb_lies@ connection(s) detected.', # MODIF
	'corbeille_objets_vide' => 'No object in the wastebin', # MODIF
	'corbeille_objets_vider' => 'Delete the selected objects', # MODIF
	'corbeille_vider' => 'Empty the wastebin:', # MODIF
	'couleurs:aide' => 'Text colouring: <b>[coul]text[/coul]</b>@fond@ with <b>coul</b> = @liste@', # MODIF
	'couleurs:description' => '<MODIF>Provide shortcuts to add colours in any text of the site (articles, news items, titles, forums, ...)

Here are two identical examples to change the colour of text:@_CS_EXEMPLE_COULEURS2@

In the same way, to change the font if the following option allows:@_CS_EXEMPLE_COULEURS3@

[[%couleurs_fonds%]]
[[%set_couleurs%]][[->%couleurs_perso%]]
@_CS_ASTER@The format of this personalised tags have to be of existing colours or define pairs &laquo;tag=colour&raquo;, separated by comas. Examples : &laquo;grey, red&raquo;, &laquo;smooth=yellow, strong=red&raquo;, &laquo;low=#99CC11, high=brown&raquo; but also &laquo;grey=#DDDDCC, red=#EE3300&raquo;. For the first and last example, the allowed tags are: <code>[grey]</code> et <code>[red]</code> (<code>[fond grey]</code> et <code>[fond red]</code> if the backgrounds are allowed).', # MODIF
	'couleurs:nom' => 'Coloured text', # MODIF
	'couleurs_fonds' => ', <b>[fond&nbsp;coul]text[/coul]</b>, <b>[bg&nbsp;coul]text[/coul]</b>', # MODIF
	'cs_comportement:description' => '<MODIF>@puce@ {{Logs.}} Record a lot of information about the working of the Penknife in the {spip.log} files which can be found in this directory: {@_CS_DIR_TMP@}[[%log_couteau_suisse%]]

@puce@ {{SPIP options.}} SPIP places plugins in order. To be sure that the Penknife is at the head and is thus able to control certain SPIP options, check the following option. If the permissions on your server allow it, the file {@_CS_FILE_OPTIONS@} will be modified to include {@_CS_DIR_TMP@couteau-suisse/mes_spip_options.php}.
[[%spip_options_on%]]

@puce@ {{External requests.}} The Penknife checks regularly for new versions of the plugin and shows available updates on its configuration page. If the external requests involved do not work from your server, check this box to turn this off.[[%distant_off%]]', # MODIF
	'cs_comportement:nom' => 'Behaviour of the Penknife', # MODIF
	'cs_distant_off' => 'Checks of remote versions', # MODIF
	'cs_distant_outils_off' => '<NEW>Les outils du Couteau Suisse ayant des fichiers distants', # MODIF
	'cs_log_couteau_suisse' => 'Detailed logs of the Penknife', # MODIF
	'cs_reset' => 'Are you sure you wish to completely reset the Penknife?', # MODIF
	'cs_reset2' => 'All activated tools will be deactivated and their options reset.', # MODIF
	'cs_spip_options_erreur' => '<NEW>Attention : la modification du ficher &laquo;<html>@_CS_FILE_OPTIONS@</html>&raquo; a &eacute;chou&eacute; !', # MODIF
	'cs_spip_options_on' => '<MODIF>SPIP options in "@_CS_FILE_OPTIONS@"', # MODIF

	// D
	'decoration:aide' => 'D&eacute;coration: <b>&lt;tag&gt;test&lt;/tag&gt;</b>, with<b>tag</b> = @liste@', # MODIF
	'decoration:description' => 'New, configurable styles in your text using angle brackets and tags. Example: 
&lt;mytag&gt;texte&lt;/mytag&gt; ou : &lt;mytag/&gt;.<br />Define below the CSS styles you need. Put each tag on a separate lign, using the following syntaxes:
- {type.mytag = mon style CSS}
- {type.mytag.class = ma classe CSS}
- {type.mytag.lang = ma langue (ex : en)}
- {unalias = mytag}

The parameter {type} above can be one of three values:
- {span} : inline tag 
- {div} : block element tag
- {auto} : tag chosen automtically by the plugin

[[%decoration_styles%]]', # MODIF
	'decoration:nom' => 'Decoration', # MODIF
	'decoupe:aide' => '<MODIF>Tabbed block: <b>&lt;onglets>&lt;/onglets></b><br/>Page or tab separator: @sep@', # MODIF
	'decoupe:aide2' => 'Alias:&nbsp;@sep@', # MODIF
	'decoupe:description' => '@puce@ Divides the display of an article into pages using automatic page numbering. Simply place four consecutive + signes (<code>++++</code>) where you wish a page break to occur.

By default, the Penknife inserts the pagination links at the top and bottom of the page. But you can place the links elsewhere in your template by using the #CS_DECOUPE tag, which you can activate here:
[[%balise_decoupe%]]

@puce@ If you use this separator between  &lt;onglets&gt; and &lt;/onglets&gt; tags, then you will receive a tabbed page instead.

In templates you can use the tags #ONGLETS_DEBUT, #ONGLETS_TITRE and #ONGLETS_FIN.

This tool may be combined with "[.->sommaire]".', # MODIF
	'decoupe:nom' => 'Division in pages and tabs', # MODIF
	'desactiver_flash:description' => 'Deletes the flash objects from your site and replaces them by the associated alternative content.', # MODIF
	'desactiver_flash:nom' => 'Deactivate flash objects', # MODIF
	'detail_balise_etoilee' => '{{N.B.}} : Check the use made in your templates of starred tags. This tool will not apply its treatment to the following tag(s): @bal@.', # MODIF
	'detail_disabled' => '<NEW>Param&egrave;tres non modifiables :', # MODIF
	'detail_fichiers' => 'Files:', # MODIF
	'detail_fichiers_distant' => '<NEW>Fichiers distants :', # MODIF
	'detail_inline' => 'Inline code:', # MODIF
	'detail_jquery2' => 'This tool uses the {jQuery} library.', # MODIF
	'detail_jquery3' => '{{N.B.}}: this tool requires the plugin [jQuery pour SPIP 1.92->http://files.spip.org/spip-zone/jquery_192.zip] in order to function correctly with this version of SPIP.', # MODIF
	'detail_pipelines' => 'Pipelines:', # MODIF
	'detail_raccourcis' => '<NEW>Voici la liste des raccourcis typographiques reconnus par cet outil.', # MODIF
	'detail_spip_options' => '{{Note}} : En cas de dysfonctionnement de cet outil, placez les options SPIP en amont gr&acirc;ce &agrave; l\'outil &laquo;@lien@&raquo;.', # NEW
	'detail_spip_options2' => 'Il est recommand&eacute; de placer les options SPIP en amont gr&acirc;ce &agrave; l\'outil &laquo;[.->cs_comportement]&raquo;.', # NEW
	'detail_spip_options_ok' => '{{Note}} : Cet outil place actuellement des options SPIP en amont gr&acirc;ce &agrave; l\'outil &laquo;@lien@&raquo;.', # NEW
	'detail_traitements' => 'Treatment:', # MODIF
	'devdebug:description' => '{{Cet outil vous permet de voir les erreurs PHP &agrave; l\'&eacute;cran.}}<br />Vous pouvez choisir le niveau d\'erreurs d\'ex&eacute;cution PHP qui sera affich&eacute; si le d&eacute;bogueur est actif, ainsi que l\'espace SPIP sur lequel ces r&eacute;glages s\'appliqueront.', # NEW
	'devdebug:item_e_all' => 'Tous les messages d&#039;erreur (all)', # NEW
	'devdebug:item_e_error' => 'Erreurs graves ou fatales (error)', # NEW
	'devdebug:item_e_notice' => 'Notes d&#039;ex&#233;cution (notice)', # NEW
	'devdebug:item_e_strict' => 'Tous les messages + les conseils PHP (strict)', # NEW
	'devdebug:item_e_warning' => 'Avertissements (warning)', # NEW
	'devdebug:item_espace_prive' => 'Espace priv&eacute;', # NEW
	'devdebug:item_espace_public' => 'Espace public', # NEW
	'devdebug:item_tout' => 'Tout SPIP', # NEW
	'devdebug:nom' => 'D&eacute;bogueur de d&eacute;veloppement', # NEW
	'distant_aide' => '<NEW>Cet outil requiert des fichiers distants qui doivent tous &ecirc;tre correctement install&eacute;s en librairie. Avant d\'activer cet outil ou d\'actualiser ce cadre, assurez-vous que les fichiers requis sont bien pr&eacute;sents sur le serveur distant.', # MODIF
	'distant_charge' => '<NEW>Fichier correctement t&eacute;l&eacute;charg&eacute; et install&eacute; en librairie.', # MODIF
	'distant_charger' => '<NEW>Lancer le t&eacute;l&eacute;chargement', # MODIF
	'distant_echoue' => '<NEW>Erreur sur le chargement distant, cet outil risque de ne pas fonctionner !', # MODIF
	'distant_inactif' => '<NEW>Fichier introuvable (outil inactif).', # MODIF
	'distant_present' => '<NEW>Fichier pr&eacute;sent en librairie depuis le @date@.', # MODIF
	'dossier_squelettes:description' => 'Changes which template directory to use. For example: "squelettes/mytemplate". You can register several directories by separating them with a colon <html>":"</html>. If you leave the following box empty (or type "dist" in it), then the default "dist" template, supplied with SPIP, will be used.[[%dossier_squelettes%]]', # MODIF
	'dossier_squelettes:nom' => 'Template directory', # MODIF

	// E
	'ecran_activer' => 'Activer l\'&eacute;cran de s&eacute;curit&eacute;', # NEW
	'ecran_conflit' => 'Attention : le fichier &laquo;@file@&raquo; entre en conflit et doit &ecirc;tre supprim&eacute; !', # NEW
	'ecran_ko' => 'Ecran inactif !', # NEW
	'ecran_maj_ko' => 'La version {{@n@}} de l\'&eacute;cran de s&eacute;curit&eacute; est disponible. Veuillez actualiser le fichier distant de cet outil.', # NEW
	'ecran_maj_ok' => '(semble &agrave; jour).', # NEW
	'ecran_securite:description' => 'L\'&eacute;cran de s&eacute;curit&eacute; est un fichier PHP directement t&eacute;l&eacute;charg&eacute; du site officiel de SPIP, qui prot&egrave;ge vos sites en bloquant certaines attaques li&eacute;es &agrave; des trous de s&eacute;curit&eacute;. Ce syst&egrave;me permet de r&eacute;agir tr&egrave;s rapidement lorsqu\'un probl&egrave;me est d&eacute;couvert, en colmatant le trou sans pour autant devoir mettre &agrave; niveau tout son site ni appliquer un &laquo; patch &raquo; complexe.

A savoir : l\'&eacute;cran verrouille certaines variables. Ainsi, par exemple, les  variables nomm&eacute;es <code>id_xxx</code> sont toutes  contr&ocirc;l&eacute;es comme &eacute;tant obligatoirement des valeurs num&eacute;riques enti&egrave;res, afin d\'&eacute;viter toute injection de code SQL via ce genre de variable tr&egrave;s courante. Certains plugins ne sont pas compatibles avec toutes les r&egrave;gles de l\'&eacute;cran, utilisant par exemple <code>&id_x=new</code> pour cr&eacute;er un objet {x}.

Outre la s&eacute;curit&eacute;, cet &eacute;cran a la capacit&eacute; r&eacute;glable de moduler les acc&egrave;s des robots  d\'indexation aux scripts PHP, de mani&egrave;re &agrave; leur dire de &laquo;&nbsp;revenir plus tard&nbsp;&raquo;  lorsque le serveur est satur&eacute;.[[ %ecran_actif%]][[->
@puce@ R&eacute;gler la protection anti-robots quand la charge du serveur (load)  exc&egrave;de la valeur : %ecran_load%
_ {La valeur par d&eacute;faut est 4. Mettre 0 pour d&eacute;sactiver ce processus.}@_ECRAN_CONFLIT@]]

En cas de mise &agrave; jour officielle, actualisez le fichier distant associ&eacute; (cliquez ci-dessus sur [actualiser]) afin de b&eacute;n&eacute;ficier de la protection la plus r&eacute;cente.

- Version du fichier local : ', # NEW
	'ecran_securite:nom' => 'Ecran de s&eacute;curit&eacute;', # NEW
	'effaces' => 'Deleted', # MODIF
	'en_travaux:description' => '<MODIF>Makes it possible to display a customised message on the public site and also in the editing area during maintenance work.
[[%message_travaux%]][[%titre_travaux%]][[%admin_travaux%]][[%prive_travaux%]]', # MODIF
	'en_travaux:nom' => 'Site in maintenance mode', # MODIF
	'erreur:bt' => '<span style=\\"color:red;\\">Warning:</span> the typographical bar appears to be an old version (@version@).<br />The Penknife is compatible only with version @mini@ or newer.', # MODIF
	'erreur:description' => 'missing id in the tool\'s definition!', # MODIF
	'erreur:distant' => 'The distant server', # MODIF
	'erreur:jquery' => '{{N.B.}} : {jQuery} does not appear to be active for this page. Please consult the paragraph about the plugin\'s required libraries [in this article->http://www.spip-contrib.net/?article2166] or reload this page.', # MODIF
	'erreur:js' => 'A Javascript error appears to have occurred on this page, hindering its action. Please activate Javascript in your browser, or try deactivating some SPIP plugins which may be causing interference.', # MODIF
	'erreur:nojs' => 'Javascript has been deactivated on this page.', # MODIF
	'erreur:nom' => 'Error!', # MODIF
	'erreur:probleme' => 'Problem with: @pb@', # MODIF
	'erreur:traitements' => 'The Penknife - Compilation error: forbidden mixing of \'typo\' and \'propre\'!', # MODIF
	'erreur:version' => 'This tool is unavailable in this version of SPIP.', # MODIF
	'erreur_groupe' => '<NEW>Attention : le groupe &laquo;@groupe@&raquo; n\'est pas d&#233;fini !', # MODIF
	'erreur_mot' => '<NEW>Attention : le mot-cl&#233; &laquo;@mot@&raquo; n\'est pas d&#233;fini !', # MODIF
	'etendu' => 'Expanded', # MODIF

	// F
	'f_jQuery:description' => '<MODIF>Prevents the installation of {jQuery} on the public site in order to economise some "machine resources". The jQuery library ([->http://jquery.com/]) is useful in Javascript programming and many plugins use it. SPIP uses it in the editing interface.

N.B: some Penknife tools require {jQuery} to be installed. ', # MODIF
	'f_jQuery:nom' => 'Deactivate jQuery', # MODIF
	'filets_sep:aide' => '<MODIF>Dividing lines: <b>__i__</b> or <b>i</b> is a number.<br />Other available lines: @liste@', # MODIF
	'filets_sep:description' => 'Inserts separating lines for any SPIP texts which can be customised with a stylesheet.
_ The syntax is: "__code__", where "code" is either the identifying number (from 0 to 7) of the line to insert and which is linked to the corresponding style, or the name of an image in the plugins/couteau_suisse/img/filets directory.', # MODIF
	'filets_sep:nom' => 'Dividing lines', # MODIF
	'filtrer_javascript:description' => 'Three modes are available for controlling JavaScript inserted directly in the text of articles:
- <i>never</i>: JavaScript is prohibited everywhere
- <i>default</i>: the presence of Javascript is highlighted in red in the editing interface
- <i>always</i>: JavaScript is always accepted.

N.B.: in forums, petitions, RSS feeds, etc., JavaScript is <b>always</b> made secure.[[%radio_filtrer_javascript3%]]', # MODIF
	'filtrer_javascript:nom' => 'JavaScript management', # MODIF
	'flock:description' => 'Deactivates the file-locking system which uses the PHP {flock()} function. Some web-hoting environments are unable to work with this function. Do not activate this tool if your site is functioning normally.', # MODIF
	'flock:nom' => 'Files are not locked', # MODIF
	'fonds' => 'Backgrounds:', # MODIF
	'forcer_langue:description' => 'Forces the language context for multiligual templates which have a language menu able to manage the language cookie.

Technically, this tool does this:
- deactivates the choice of template according to the object\'s language.
- deactivates the automatic <code>{lang_select}</code> criterion on SPIP objects (articles, news items, sections, etc.).

Thus multi blocks are always displayed in the language requested by the visitor.', # MODIF
	'forcer_langue:nom' => 'Force language', # MODIF
	'format_spip' => 'Articles in SPIP format', # MODIF
	'forum_lgrmaxi:description' => 'By default forum messages are not limited in size. If this tool is activated, an error message is shown each time someone tries to post a message larger than the size given, and the message is refused. An empty value (or 0) means that no limit will be imposed.[[%forum_lgrmaxi%]]', # MODIF
	'forum_lgrmaxi:nom' => 'Size of forums', # MODIF

	// G
	'glossaire:aide' => 'A text with no glossary: <b>@_CS_SANS_GLOSSAIRE@</b>', # MODIF
	'glossaire:description' => '@puce@ Use one or several groups of keywords to manage an internal glossary. Enter the names of the groups here, separating them by  colons (:). If you leave the box empty (or enter "Glossaire"), it is the "Glossaire" group which will be used.[[%glossaire_groupes%]]

@puce@ You can indicate the maximum number of links to create in a text for each word. A null or negative value will mean that all instances of the words will be treated. [[%glossaire_limite% par mot-cl&eacute;]]

@puce@ There is a choice of two options for generating the small window which appears on the mouseover. [[%glossaire_js%]]', # MODIF
	'glossaire:nom' => 'Internal glossary', # MODIF
	'glossaire_css' => 'CSS solution', # MODIF
	'glossaire_erreur' => '<NEW>Le mot &laquo;@mot1@&raquo; rend ind&#233;tectable le mot &laquo;@mot2@&raquo;', # MODIF
	'glossaire_inverser' => '<NEW>Correction propos&#233;e : inverser l\'ordre des mots en base.', # MODIF
	'glossaire_js' => 'JavaScript solution', # MODIF
	'glossaire_ok' => '<NEW>La liste des @nb@ mot(s) &#233;tudi&#233;(s) en base semble correcte.', # MODIF
	'guillemets:description' => 'Automatically replaces straight inverted commas (") by curly ones, using the correct ones for the current language. The replacement does not change the text stored in the database, but only the display on the screen.', # MODIF
	'guillemets:nom' => 'Curly inverted commas', # MODIF

	// H
	'help' => '{{This page is only accessible to main site administrators.}} It gives access to the configuration of some additional functions of the {{Penknife}}.', # MODIF
	'help2' => 'Local version: @version@', # MODIF
	'help3' => '<MODIF><p>Documentation links:<br/>• [Le&nbsp;Couteau&nbsp;Suisse->http://www.spip-contrib.net/?article2166]@contribs@</p><p>Resets :
_ • [Hidden tools|Return to the original appearance of this page->@hide@]
_ • [Whole plugin|Reset to the original state of the plugin->@reset@]@install@
</p>', # MODIF
	'horloge:description' => '<MODIF>Tool in development. It offers a Javascript clock. Tag: <code>#HORLOGE{format,utc,id}</code>. Model: <code><horloge></code>', # MODIF
	'horloge:nom' => 'Clock', # MODIF

	// I
	'icone_visiter:description' => '<MODIF>Replaces the standard "Visit" button (top right on this page) by the site logo, if it exists.

To set this logo, go to the page "Site configuration" by clicking the "Configuration" button.', # MODIF
	'icone_visiter:nom' => '<MODIF>"Visit" button', # MODIF
	'insert_head:description' => 'Activate the tag [#INSERT_HEAD->http://www.spip.net/en_article2421.html] in all templates, whether or not this tag is present between &lt;head&gt; et &lt;/head&gt;. This option can be used to allow plugins to insert javascript code (.js) or stylesheets (.css).', # MODIF
	'insert_head:nom' => '#INSERT_HEAD tag', # MODIF
	'insertions:description' => 'N.B.: tool in development!! [[%insertions%]]', # MODIF
	'insertions:nom' => 'Auto-correct', # MODIF
	'introduction:description' => 'This tag can be used in templates to generate short summaries of articles, new items, etc.</p>
<p>{{Beware}} : If you have another plugin defining the fonction {balise_INTRODUCTION()} or you have defined it in your templates, you will get a compilation error.</p>
@puce@ You can specify (as a percentage of the default value) the length of the text generated by the tag #INTRODUCTION. A null value, or a value equal to 100 will not modify anything and return the defaults: 500 characters for the articles, 300 for the news items and 600 for forums and sections.
[[%lgr_introduction%&nbsp;%]]
@puce@ By default, if the text is too long, #INTRODUCTION will end with 3 dots: <html>&laquo;&amp;nbsp;(…)&raquo;</html>. You can change this to a customized string which shows that there is more text available.
[[%suite_introduction%]]
@puce@ If the #INTRODUCTION tag is used to give a summary of an article, the Penknife can generate a link to the article on the 3 dots or string marking that there is more text available. For example : &laquo;Read the rest of the article…&raquo;
[[%lien_introduction%]]
', # MODIF
	'introduction:nom' => '#INTRODUCTION tag', # MODIF

	// J
	'jcorner:description' => '"Pretty Corners" is a tool which makes it easy to change the appearance of the corners of {{coloured boxes}} on the public pages of your site. Almost anything is possible!
_ See this page for examples: [->http://www.malsup.com/jquery/corner/].

Make a list below of the elements in your templates which are to be rounded. Use CSS syntax (.class, #id, etc. ). Use the sign "&nbsp;=&nbsp;" to specify the jQuery command to apply, and a double slash ("&nbsp;//&nbsp;") for comments. If no equals sign is provided, rounded corners equivalent to  <code>.ma_classe = .corner()</code> will be applied.[[%jcorner_classes%]]

N.B. This tool requires the {Round Corners} jQuery plugin in order to function. The Penknife can install it automatically if you check this box. [[%jcorner_plugin%]]', # MODIF
	'jcorner:nom' => 'Pretty Corners', # MODIF
	'jcorner_plugin' => '"&nbsp;Round Corners plugin&nbsp;"', # MODIF
	'jq_localScroll' => 'jQuery.LocalScroll ([demo->http://demos.flesler.com/jquery/localScroll/])', # MODIF
	'jq_scrollTo' => 'jQuery.ScrollTo ([demo->http://demos.flesler.com/jquery/scrollTo/])', # MODIF
	'js_defaut' => 'Default', # MODIF
	'js_jamais' => 'Never', # MODIF
	'js_toujours' => 'Always', # MODIF
	'jslide_aucun' => '<NEW>Aucune animation', # MODIF
	'jslide_fast' => '<NEW>Glissement rapide', # MODIF
	'jslide_lent' => '<NEW>Glissement lent', # MODIF
	'jslide_millisec' => '<NEW>Glissement durant&nbsp;:', # MODIF
	'jslide_normal' => '<NEW>Glissement normal', # MODIF

	// L
	'label:admin_travaux' => 'Close the public site for:', # MODIF
	'label:arret_optimisation' => 'Stop SPIP from emptying the wastebin automatically:', # MODIF
	'label:auteur_forum_nom' => 'The visitor must specify:', # MODIF
	'label:auto_sommaire' => 'Systematic creation of a summary:', # MODIF
	'label:balise_decoupe' => 'Activate the #CS_DECOUPE tag:', # MODIF
	'label:balise_sommaire' => 'Activate the tag #CS_SOMMAIRE :', # MODIF
	'label:bloc_h4' => 'Tag for the titles:', # MODIF
	'label:bloc_unique' => 'Only one block open on the page:', # MODIF
	'label:blocs_cookie' => 'Cookie usage:', # MODIF
	'label:blocs_slide' => '<NEW>Type d\'animation&nbsp;:', # MODIF
	'label:compacte_css' => 'Compression du HEAD :', # NEW
	'label:copie_Smax' => '<NEW>Espace maximal r&eacute;serv&eacute; aux copies locales :', # MODIF
	'label:couleurs_fonds' => 'Allow backgrounds:', # MODIF
	'label:cs_rss' => 'Activate:', # MODIF
	'label:debut_urls_propres' => 'Beginning of the URLs:', # MODIF
	'label:decoration_styles' => 'Your personalised style tags:', # MODIF
	'label:derniere_modif_invalide' => 'Refresh immediately after a modification:', # MODIF
	'label:devdebug_espace' => 'Filtrage de l\'espace concern&#233; :', # NEW
	'label:devdebug_mode' => 'Activer le d&eacute;bogage', # NEW
	'label:devdebug_niveau' => 'Filtrage du niveau d\'erreur renvoy&eacute; :', # NEW
	'label:distant_off' => 'Deactivate:', # MODIF
	'label:doc_Smax' => '<NEW>Taille maximale des documents :', # MODIF
	'label:dossier_squelettes' => 'Directory(ies) to use:', # MODIF
	'label:duree_cache' => 'Duration of local cache:', # MODIF
	'label:duree_cache_mutu' => 'Duration of mutualised cache:', # MODIF
	'label:ecran_actif' => '@_CS_CHOIX@', # NEW
	'label:enveloppe_mails' => 'Small envelope before email addresses:', # MODIF
	'label:expo_bofbof' => 'Place in superscript: <html>St(e)(s), Bx, Bd(s) et Fb(s)</html>', # MODIF
	'label:forum_lgrmaxi' => 'Value (in characters):', # MODIF
	'label:glossaire_groupes' => 'Group(s) used:', # MODIF
	'label:glossaire_js' => 'Technique used:', # MODIF
	'label:glossaire_limite' => 'Maximum number of links created:', # MODIF
	'label:i_align' => '<NEW>Alignement du texte&nbsp;:', # MODIF
	'label:i_couleur' => '<NEW>Couleur de la police&nbsp;:', # MODIF
	'label:i_hauteur' => '<NEW>Hauteur de la ligne de texte (&eacute;q. &agrave; {line-height})&nbsp;:', # MODIF
	'label:i_largeur' => '<NEW>Largeur maximale de la ligne de texte&nbsp;:', # MODIF
	'label:i_padding' => '<NEW>Espacement autour du texte (&eacute;q. &agrave; {padding})&nbsp;:', # MODIF
	'label:i_police' => '<NEW>Nom du fichier de la police (dossiers {polices/})&nbsp;:', # MODIF
	'label:i_taille' => '<NEW>Taille de la police&nbsp;:', # MODIF
	'label:img_GDmax' => '<NEW>Calculs d\'images avec GD :', # MODIF
	'label:img_Hmax' => '<NEW>Taille maximale des images :', # MODIF
	'label:insertions' => 'Auto-correct:', # MODIF
	'label:jcorner_classes' => 'Improve the corners of the following CSS selectors:', # MODIF
	'label:jcorner_plugin' => 'Install the following {jQuery} plugin:', # MODIF
	'label:jolies_ancres' => '<NEW>Calculer de jolies ancres :', # MODIF
	'label:lgr_introduction' => 'Length of summary:', # MODIF
	'label:lgr_sommaire' => 'Length of summary (9 to 99):', # MODIF
	'label:lien_introduction' => 'Clickable follow-on dots:', # MODIF
	'label:liens_interrogation' => 'Protect URLs:', # MODIF
	'label:liens_orphelins' => 'Clickable links:', # MODIF
	'label:log_couteau_suisse' => 'Activate:', # MODIF
	'label:logo_Hmax' => '<NEW>Taille maximale des logos :', # MODIF
	'label:marqueurs_urls_propres' => '<MODIF>Add markers to distinguish between objects (SPIP>=2.0) :<br/>(e.g.. : "&nbsp;-&nbsp;" for -My-section-, "&nbsp;@&nbsp;" for @My-site@) ', # MODIF
	'label:max_auteurs_page' => 'Authors per page:', # MODIF
	'label:message_travaux' => 'Your maintenance message:', # MODIF
	'label:moderation_admin' => 'Automatically validate messages from:', # MODIF
	'label:mot_masquer' => '<NEW>Mot-cl&#233; masquant les contenus :', # MODIF
	'label:ouvre_note' => 'Opening and closing markers of footnotes', # MODIF
	'label:ouvre_ref' => 'Opening and closing markers of footnote links', # MODIF
	'label:paragrapher' => 'Always insert paragraphs:', # MODIF
	'label:prive_travaux' => 'Access to the editing area for:', # MODIF
	'label:prof_sommaire' => '<NEW>Profondeur retenue (1 &agrave; 4) :', # MODIF
	'label:puce' => 'Public bullet &laquo;<html>-</html>&raquo;:', # MODIF
	'label:quota_cache' => 'Quota value', # MODIF
	'label:racc_g1' => 'Beginning and end of "<html>{{bolded text}}</html>":', # MODIF
	'label:racc_h1' => 'Beginning and end of a &laquo;<html>{{{subtitle}}}</html>&raquo;:', # MODIF
	'label:racc_hr' => 'Horizontal line (<html>----</html>) :', # MODIF
	'label:racc_i1' => 'Beginning and end of &laquo;<html>{italics}</html>&raquo;:', # MODIF
	'label:radio_desactive_cache3' => 'Deactivate the cache', # MODIF
	'label:radio_desactive_cache4' => 'Use of the cache', # MODIF
	'label:radio_target_blank3' => 'New window for external links:', # MODIF
	'label:radio_type_urls3' => 'URL format:', # MODIF
	'label:scrollTo' => 'Instal the following {jQuery} plugins:', # MODIF
	'label:separateur_urls_page' => '<MODIF>Separating character \'type-id\'<br/>(eg.: ?article-123):', # MODIF
	'label:set_couleurs' => 'Set to be used ', # MODIF
	'label:spam_ips' => '<NEW>Adresses IP &agrave; bloquer :', # MODIF
	'label:spam_mots' => 'Prohibited sequences:', # MODIF
	'label:spip_options_on' => 'Include', # MODIF
	'label:spip_script' => 'Calling script', # MODIF
	'label:style_h' => 'Your style:', # MODIF
	'label:style_p' => 'Your style:', # MODIF
	'label:suite_introduction' => 'Follow-on dots', # MODIF
	'label:terminaison_urls_page' => 'URL endings (e.g.: .html):', # MODIF
	'label:titre_travaux' => 'Message title:', # MODIF
	'label:titres_etendus' => 'Activate the extended use of the tags #TITRE_XXX:', # MODIF
	'label:url_arbo_minuscules' => 'Preserve the case of titles in URLs:', # MODIF
	'label:url_arbo_sep_id' => '<MODIF>Separation character \'title-id\', used in the event of homonyms:<br/>(do not use \'/\')', # MODIF
	'label:url_glossaire_externe2' => 'Link to external glossary:', # MODIF
	'label:url_max_propres' => '<NEW>Longueur maximale des URLs (caract&egrave;res) :', # MODIF
	'label:urls_arbo_sans_type' => 'Show the type of SPIP object in URLs:', # MODIF
	'label:urls_avec_id' => 'A systematic id, but ...', # MODIF
	'label:webmestres' => 'List of the website managers:', # MODIF
	'liens_en_clair:description' => 'Makes the filter: \'liens_en_clair\' available to you. Your text probably contains hyperlinks which are not visible when the page is printed. This filter adds the link code between square brackets for every clickabel link (external links and email addresses). N.B: in printing mode (when using the parameter \'cs=print\' or \'page=print\' in the URL), this treatment is automatically applied.', # MODIF
	'liens_en_clair:nom' => 'Visible hyperlinks', # MODIF
	'liens_orphelins:description' => 'This tool has two functions:

@puce@ {{Correct Links}}.

In French texts, SPIP follows the rules of French typography and inserts a space before question and exclamation marks. This tool prevents this from happening in URLs.[[%liens_interrogation%]]

@puce@ {{Orphan links}}.

Systematically replaces all URLs which authors have placed in texts (especially often in forums) and which are thus not clickable, by links in the SPIP format. For example, {<html>www.spip.net</html>} will be replaced by: [->www.spip.net].

You can choose the manner of replacement:
_ • {Basic}: links such as {<html>http://spip.net</html>} (whatever protocol) and {<html>www.spip.net</html>} are replaced.
_ • {Extended}: additionally links such as these are also replaced:  {<html>me@spip.net</html>}, {<html>mailto:myaddress</html>} ou {<html>news:mynews</html>}.
_ • {By default}: automatic replacement (from SPIP version 2.0).
[[%liens_orphelins%]]', # MODIF
	'liens_orphelins:nom' => 'Fine URLs', # MODIF

	// M
	'mailcrypt:description' => 'Hides all the email links in your textes and replaces them with a Javascript link which activates the visitor\'s email programme when the link is clicked. This antispam tool attempts to prevent web robots from collecting email addresses which have been placed in forums or in the text displayed by the tags in your templates.', # MODIF
	'mailcrypt:nom' => 'MailCrypt', # MODIF
	'maj_auto:description' => '<NEW>Cet outil vous permet de g&eacute;rer facilement la mise &agrave; jour de vos diff&eacute;rents plugins, r&eacute;cup&eacute;rant notamment le num&eacute;ro de r&eacute;vision contenu dans le fichier <code>svn.revision</code> et le comparant avec celui trouv&eacute; sur <code>zone.spip.org</code>.

La liste ci-dessus offre la possibilit&eacute; de lancer le processus de mise &agrave; jour automatique de SPIP sur chacun des plugins pr&eacute;alablement install&eacute;s dans le dossier <code>plugins/auto/</code>. Les autres plugins se trouvant dans le dossier <code>plugins/</code> sont simplement list&eacute;s &agrave; titre d\'information. Si la r&eacute;vision distante n\'a pas pu &ecirc;tre trouv&eacute;e, alors tentez de proc&eacute;der manuellement &agrave; la mise &agrave; jour du plugin.

Note : les paquets <code>.zip</code> n\'&eacute;tant pas reconstruits instantan&eacute;ment, il se peut que vous soyez oblig&eacute; d\'attendre un certain d&eacute;lai avant de pouvoir effectuer la totale mise &agrave; jour d\'un plugin tout r&eacute;cemment modifi&eacute;.', # MODIF
	'maj_auto:nom' => '<NEW>Mises &agrave; jour automatiques', # MODIF
	'masquer:description' => '<NEW>Cet outil permet de masquer sur le site public et sans modification particuli&egrave;re de vos squelettes, les contenus (rubriques ou articles) qui ont le mot-cl&#233; d&eacute;fini ci-dessous. Si une rubrique est masqu&eacute;e, toute sa branche l\'est aussi.[[%mot_masquer%]]

Pour forcer l\'affichage des contenus masqu&eacute;s, il suffit d\'ajouter le crit&egrave;re <code>{tout_voir}</code> aux boucles de votre squelette.', # MODIF
	'masquer:nom' => '<NEW>Masquer du contenu', # MODIF
	'meme_rubrique:description' => '<NEW>D&eacute;finissez ici le nombre d\'objets list&eacute;s dans le cadre nomm&eacute; &laquo;<:info_meme_rubrique:>&raquo; et pr&eacute;sent sur certaines pages de l\'espace priv&eacute;.[[%meme_rubrique%]]', # MODIF
	'message_perso' => 'oh!', # MODIF
	'moderation_admins' => 'authenticated administrators', # MODIF
	'moderation_message' => 'This forum is pre-moderated: your contribution will only appear once it has been validated by one of the site administrators (unless you are logged in and authorised to post directly).', # MODIF
	'moderation_moderee:description' => 'Makes it possible to moderate the moderation of the <b>pre-moderated</b> public forums for logged-in visitors.<br />Example: I am the webmaster of a site, and I reply to the message of a user who asks why they need to validate their own message. Moderating moderation does it for me! [[%moderation_admin%]][[-->%moderation_redac%]][[-->%moderation_visit%]]', # MODIF
	'moderation_moderee:nom' => 'Moderate moderation', # MODIF
	'moderation_redacs' => 'authenticated authors', # MODIF
	'moderation_visits' => 'Visitors authenticated', # MODIF
	'modifier_vars' => 'Change these @nb@ parameters', # MODIF
	'modifier_vars_0' => 'Change these parameters', # MODIF

	// N
	'no_IP:description' => 'Deactivates, in order to preserve confidentiality, the mechanism which records the IP addresses of visitors to your site. SPIP will thus no longer record any IP addresses, neither temporarily at the time of the visits (used for managing statistics or for spip.log), nor in the forums (source of posts).', # MODIF
	'no_IP:nom' => 'No IP recording', # MODIF
	'nouveaux' => 'New', # MODIF

	// O
	'orientation:description' => '3 new criteria for your templates: <code>{portrait}</code>, <code>{carre}</code> et <code>{paysage}</code>. Ideal for sorting photos according to their format (carre = square; paysage = landscape).', # MODIF
	'orientation:nom' => 'Picture orientation', # MODIF
	'outil_actif' => 'Activated tool', # MODIF
	'outil_actif_court' => 'actif', # NEW
	'outil_activer' => 'Activate', # MODIF
	'outil_activer_le' => 'Activate the tool', # MODIF
	'outil_cacher' => 'No longer show', # MODIF
	'outil_desactiver' => 'Deactivate', # MODIF
	'outil_desactiver_le' => 'Deactivate this tool', # MODIF
	'outil_inactif' => 'Inactive tool', # MODIF
	'outil_intro' => 'This page lists the functionalities which the plugin makes available to you.<br /><br />By clicking on the names of the tools below, you choose the ones which you can then switch on/off using the central button: active tools will be disabled and <i>vice versa</i>. When you click, the tools description is shown above the list. The tool categories are collapsible to hide the tools they contain. A double-click allows you to directly switch a tool on/off.<br /><br />For first use, it is recommended to activate tools one by one, thus reavealing any incompatibilites with your templates, with SPIP or with other plugins.<br /><br />N.B.: simply loading this page recompiles all the Penknife tools.', # MODIF
	'outil_intro_old' => 'This is the old interface.<br /><br />If you have difficulties in using <a href=\\\'./?exec=admin_couteau_suisse\\\'>the new interface</a>, please let us know in the forum of <a href=\\\'http://www.spip-contrib.net/?article2166\\\'>Spip-Contrib</a>.', # MODIF
	'outil_nb' => '<MODIF>@pipe@ : @nb@ tool', # MODIF
	'outil_nbs' => '<MODIF>@pipe@ : @nb@ tools', # MODIF
	'outil_permuter' => 'Switch the tool: &laquo; @text@ &raquo; ?', # MODIF
	'outils_actifs' => 'Activated tools:', # MODIF
	'outils_caches' => 'Hidden tools:', # MODIF
	'outils_cliquez' => 'Click the names of the tools above to show their description.', # MODIF
	'outils_concernes' => '<NEW>Sont concern&eacute;s : ', # MODIF
	'outils_desactives' => '<NEW>Sont d&eacute;sactiv&eacute;s : ', # MODIF
	'outils_inactifs' => 'Inactive tools:', # MODIF
	'outils_liste' => 'List of tools of the Penknife', # MODIF
	'outils_non_parametrables' => 'Cannot be configured:', # MODIF
	'outils_permuter_gras1' => 'Switch the tools in bold type', # MODIF
	'outils_permuter_gras2' => 'Switch the @nb@ tools in bold type?', # MODIF
	'outils_resetselection' => 'Reset the selection', # MODIF
	'outils_selectionactifs' => 'Select all the active tools', # MODIF
	'outils_selectiontous' => 'ALL', # MODIF

	// P
	'pack_actuel' => 'Pack @date@', # MODIF
	'pack_actuel_avert' => '<MODIF>Warning: the overrides of globals and of "define()" are not specified here', # MODIF
	'pack_actuel_titre' => 'UP-TO-DATE CONFIGURATION PACK OF THE PENKNIFE', # MODIF
	'pack_alt' => 'See the current configuration parameters', # MODIF
	'pack_delete' => '<NEW>Supression d\'un pack de configuration', # MODIF
	'pack_descrip' => 'Your "Current configuration pack" brings together all the parameters activated for the Penknife plugin. It remembers both whether a tool is activated or not and, if so, what options have been chosen.

This PHP code may be placed in the /config/mes_options.php file. It will place a reset link on the page of the "pack {@pack@}". Of course, you can change its name below.

If you reset the plugin by clicking on a pack, the Penknife will reconfigure itself according to the values defined in that pack.', # MODIF
	'pack_du' => '• of the pack @pack@', # MODIF
	'pack_installe' => 'Installation of a configuration pack', # MODIF
	'pack_installer' => 'Are you sure you want to re-initialise the Penknife and install the &laquo;&nbsp;@pack@&nbsp;&raquo; pack?', # MODIF
	'pack_nb_plrs' => '<MODIF>At the moment there are @nb@ "configuration packs" available.', # MODIF
	'pack_nb_un' => '<MODIF>A "configuration pack" is currently available.', # MODIF
	'pack_nb_zero' => 'No "configuration pack" is currently available.', # MODIF
	'pack_outils_defaut' => 'Installation of the default tools', # MODIF
	'pack_sauver' => 'Save the current configuration', # MODIF
	'pack_sauver_descrip' => 'The button below allows you to insert into your <b>@file@</b> file the parameters needed for an additional "configuration pack" in the the lefthand menu. This makes it possible to reconfigure the Penknife with a single click to the current state.', # MODIF
	'pack_supprimer' => '<NEW>&Ecirc;tes-vous s&ucirc;r de vouloir supprimer le pack &laquo;&nbsp;@pack@&nbsp;&raquo; ?', # MODIF
	'pack_titre' => 'Current configuration', # MODIF
	'pack_variables_defaut' => 'Installation of the default variables', # MODIF
	'par_defaut' => 'By default', # MODIF
	'paragrapher2:description' => 'The SPIP function <code>paragrapher()</code> inserts the tags &lt;p&gt; and &lt;/p&gt; around all texts which do not have paragraphs. In order to have a finer control over your styles and layout, you can give a uniform look to your texts throughout the site.[[%paragrapher%]]', # MODIF
	'paragrapher2:nom' => 'Insert paragraphs', # MODIF
	'pipelines' => 'Entry points used:', # MODIF
	'previsualisation:description' => '<NEW>Par d&eacute;faut, SPIP permet de pr&eacute;visualiser un article dans sa version publique et styl&eacute;e, mais uniquement lorsque celui-ci a &eacute;t&eacute; &laquo; propos&eacute; &agrave; l&rsquo;&eacute;valuation &raquo;. Hors cet outil permet aux auteurs de pr&eacute;visualiser &eacute;galement les articles pendant leur r&eacute;daction. Chacun peut alors pr&eacute;visualiser et modifier son texte &agrave; sa guise.

@puce@ Attention : cette fonctionnalit&eacute; ne modifie pas les droits de pr&eacute;visualisation. Pour que vos r&eacute;dacteurs aient effectivement le droit de pr&eacute;visualiser leurs articles &laquo; en cours de r&eacute;daction &raquo;, vous devez l&rsquo;autoriser (dans le menu {[Configuration&gt;Fonctions avanc&eacute;es->./?exec=config_fonctions]} de l&rsquo;espace priv&eacute;).', # MODIF
	'previsualisation:nom' => '<NEW>Pr&eacute;visualisation des articles', # MODIF
	'puceSPIP' => '<NEW>Autoriser le raccourci &laquo;*&raquo;', # MODIF
	'puceSPIP_aide' => '<NEW>Une puce SPIP : <b>*</b>', # MODIF
	'pucesli:description' => '<MODIF>Replaces bullets &laquo;-&raquo; (simple dash) in articles with ordered lists &laquo;-*&raquo; (transformed into  &lt;ul>&lt;li>…&lt;/li>&lt;/ul> in HTML) whose style may be customised using CSS.', # MODIF
	'pucesli:nom' => 'Beautiful bullets', # MODIF

	// Q
	'qui_webmestres' => 'SPIP webmasters', # MODIF

	// R
	'raccourcis' => 'Active Penknife typographical shortcuts:', # MODIF
	'raccourcis_barre' => 'The Penknife\'s typographical shorcuts', # MODIF
	'reserve_admin' => 'Access restricted to administrators', # MODIF
	'rss_actualiser' => 'Update', # MODIF
	'rss_attente' => 'Awaiting RSS...', # MODIF
	'rss_desactiver' => 'Deactivate &laquo;Penknife updates&raquo;', # MODIF
	'rss_edition' => 'RSS feed updated:', # MODIF
	'rss_source' => 'RSS source', # MODIF
	'rss_titre' => 'Development of the &laquo;The Penknife&raquo;:', # MODIF
	'rss_var' => 'Penknife updates', # MODIF

	// S
	'sauf_admin' => 'All, except administrators', # MODIF
	'sauf_admin_redac' => '<NEW>Tous, sauf les administrateurs et r&eacute;dacteurs', # MODIF
	'sauf_identifies' => '<NEW>Tous, sauf les auteurs identifi&eacute;s', # MODIF
	'set_options:description' => 'Preselects the type of interface (simplified or advanced) for all editors, both existing and future ones. At the same time the button offering the choice between the two interfaces is also removed.[[%radio_set_options4%]]', # MODIF
	'set_options:nom' => 'Type of private interface', # MODIF
	'sf_amont' => 'Upstream', # MODIF
	'sf_tous' => 'All', # MODIF
	'simpl_interface:description' => 'Deactivates the pop-up menu for changing article status which shows onmouseover on the coloured status bullets. This can be useful if you wish to have an editing interface which is as simple as possible for the users.', # MODIF
	'simpl_interface:nom' => 'Simplification of the editing interface', # MODIF
	'smileys:aide' => 'Smileys: @liste@', # MODIF
	'smileys:description' => '<MODIF>Inserts smileys in texts containing a shortcut in this form <acronym>:-)</acronym>. Ideal for forums.
_ A tag is available for displaying a table of smileys in templates: #SMILEYS.
_ Images : [Sylvain Michel->http://www.guaph.net/]', # MODIF
	'smileys:nom' => 'Smileys', # MODIF
	'soft_scroller:description' => 'Gives a slow scroll effect when a visitor clicks on a link with an anchor tag. This helps the visitor to know where they are in a long text.

N.B. In order to work, this tool needs to be used in &laquo;DOCTYPE XHTML&raquo; pages (not HTML!). It also requires two {jQuery} plugins: {ScrollTo} et {LocalScroll}. The Penknife can install them itself if you check the following two boxes. [[%scrollTo%]][[->%LocalScroll%]]
@_CS_PLUGIN_JQUERY192@', # MODIF
	'soft_scroller:nom' => 'Soft anchors', # MODIF
	'sommaire:description' => '<MODIF>Builds a summary of your articles in order to access the main headings quickly (HTML tags &lt;h3>A Subtitle&lt;/h3> or SPIP subtitle shortcuts in the form: <code>{{{My subtitle}}}</code>).

@puce@ You can define the maximum number of characters of the subtitles used to make the summary:[[%lgr_sommaire% characters]]

@puce@ You can also determine the way in which the plugin constructs the summary: 
_ • Systematically, for each article (a tag <code>@_CS_SANS_SOMMAIRE@</code> placed anywhere within the text of the article will make an exception to the rule).
_ • Only for articles containing the <code>@_CS_AVEC_SOMMAIRE@</code> tag.

[[%auto_sommaire%]]

@puce@ By default, the Penknife inserts the summary at the top of the article. But you can place it elsewhere, if you wish, by using the #CS_SOMMAIRE tag, which you can activate here:
[[%balise_sommaire%]]

The summary can be used in conjunction with : {[.->decoupe]}.', # MODIF
	'sommaire:nom' => '<MODIF>An automatic summary', # MODIF
	'sommaire_ancres' => '<NEW>Ancres choisies : <b><html>{{{Mon Titre&lt;mon_ancre&gt;}}}</html></b>', # MODIF
	'sommaire_avec' => 'An article with summary: <b>@_CS_AVEC_SOMMAIRE@</b>', # MODIF
	'sommaire_sans' => 'An article without summary: <b>@_CS_SANS_SOMMAIRE@</b>', # MODIF
	'sommaire_titres' => '<NEW>Intertitres hi&eacute;rarchis&eacute;s&nbsp;: <b><html>{{{*Titre}}}</html></b>, <b><html>{{{**Sous-titre}}}</html></b>, etc.', # MODIF
	'spam:description' => '<MODIF>Attempts to fight against the sending of abusive and automatic messages through forms on the public site. Some words and the tags  &lt;a>&lt;/a> are prohibited. Train your authors to use SPIP shortcuts for links.

@puce@ List here the sequences you wish to prohibit separating them with spaces. [[%spam_mots%]]
<q1>• Expressions containing spaces should be placed within inverted commas.
_ • To specify a whole word, place it in brackets. For example: {(asses)}.
_ • To use a regular expression, first check the syntax, then place it between slashes and inverted commas.
_ Example:~{<html>"/@test.(com|en)/"</html>}.
_ • Pour une expression r&eacute;guli&egrave;re devant agir sur des caract&egrave;res HTML, placez le test entre &laquo;&amp;#&raquo; et &laquo;;&raquo;.
_ Example:~{<html>"/&amp;#(?:1[4-9][0-9]{3}|[23][0-9]{4});/"</html>}.</q1>

@puce@ Certaines adresses IP peuvent &eacute;galement &ecirc;tre bloqu&eacute;es &agrave; la source. Sachez toutefois que derri&egrave;re ces adresses (souvent variables), il peut y avoir plusieurs utilisateurs, voire un r&eacute;seau entier.[[%spam_ips%]]
<q1>• Utilisez le caract&egrave;re &laquo;*&raquo; pour plusieurs chiffres, &laquo;?&raquo; pour un seul et les crochets pour des classes de chiffres.</q1>', # MODIF
	'spam:nom' => 'Fight against SPAM', # MODIF
	'spam_ip' => '<NEW>Blocage IP de @ip@ :', # MODIF
	'spam_test_ko' => 'This message would be blocked by the anti-SPAM filter!', # MODIF
	'spam_test_ok' => 'This message would be accepted by the anti-SPAM filter!', # MODIF
	'spam_tester_bd' => '<NEW>Testez &eacute;galement votre votre base de donn&eacute;es et listez les messages qui auraient &eacute;t&eacute; bloqu&eacute;s par la configuration actuelle de l\'outil.', # MODIF
	'spam_tester_label' => '<MODIF>Test your list of prohibited expressions here:', # MODIF
	'spip_cache:description' => '@puce@ The cache occupies disk space and SPIP can limit the amount of space taken up. Leaving empty or putting 0 means that no limit will be applied.[[%quota_cache% Mo]]

@puce@ When the site\'s contents are changed, SPIP immediately invalidates the cache without waiting for the next periodic recalculation. If your site experiences performance problems because of the load of repeated recalculations, you can choose "no" for this option.[[%derniere_modif_invalide%]]

@puce@ If the #CACHE tag is not found in a template then by default SPIP caches a page for 24 hours before recalculating it. You can modify this default here.[[%duree_cache% heures]]

@puce@ If you are running several mutualised sites, you can specify here the default value for all the local sites (SPIP 2.0 mini).[[%duree_cache_mutu% heures]]', # MODIF
	'spip_cache:description1' => '<MODIF>@puce@ By default, SPIP calculates all the public pages and caches them in order to accelerate their display. It can be useful, when developing the site to disable the cache temporarily, in order to see the effect of changes immediately.@_CS_CACHE_EXTENSION@[[%radio_desactive_cache3%]]', # MODIF
	'spip_cache:description2' => '@puce@ Four options to configure the cache: <q1>
_ • {Normal usage}: SPIP places all the calculated pages of the public site in the cache in order to speed up their delivery. After a certain time the cache is recalculated and stored again.
_ • {Permanent cache}: the cache is never recalculated (time limits in the templates are ignored).
_ • {No cache}: temporarily deactivating the cache can be useful when the site is being developed. With this option, nothing is cached on disk.
_ • {Cache checking}: similar to the preceding option. However, all results are written to disk in order to be able to check them.</q1>[[%radio_desactive_cache4%]]', # MODIF
	'spip_cache:description3' => '@puce@ L\'extension &laquo; Compresseur &raquo; pr&eacute;sente dans SPIP permet de compacter les diff&eacute;rents &eacute;l&eacute;ments CSS et Javascript de vos pages et de les placer dans un cache statique. Cela acc&eacute;l&egrave;re l\'affichage du site, et limite le nombre d\'appels sur le serveur et la taille des fichiers &agrave; obtenir.', # NEW
	'spip_cache:nom' => 'SPIP and the cache', # MODIF
	'spip_ecran:description' => '<NEW>D&eacute;termine la largeur d\'&eacute;cran impos&eacute;e &agrave; tous en partie priv&eacute;e. Un &eacute;cran &eacute;troit pr&eacute;sentera deux colonnes et un &eacute;cran large en pr&eacute;sentera trois. Le r&eacute;glage par d&eacute;faut laisse l\'utilisateur choisir, son choix &eacute;tant stock&eacute; dans un cookie.[[%spip_ecran%]]', # MODIF
	'spip_ecran:nom' => '<NEW>Largeur d\'&eacute;cran', # MODIF
	'stat_auteurs' => 'Authors in statistics', # MODIF
	'statuts_spip' => 'Only the following SPIP status:', # MODIF
	'statuts_tous' => 'Every status', # MODIF
	'suivi_forums:description' => 'The author of an article is always informed when a message is posted in the article\'s public forum. It is also possible to inform others: either all the forum\'s participants, or  just all the authors of messages higher in the thread.[[%radio_suivi_forums3%]]', # MODIF
	'suivi_forums:nom' => 'Overview of the public forums', # MODIF
	'supprimer_cadre' => 'Delete this frame', # MODIF
	'supprimer_numero:description' => 'Applies the supprimer_numero() SPIP function to all {{titles}}, {{names}} and {{types}} (of keywords) of the public site, without needing the filter to be present in the templates.<br />For a multilingual site, follow this syntax: <code>1. <multi>My Title[fr]Mon Titre[de]Mein Titel</multi></code>', # MODIF
	'supprimer_numero:nom' => 'Delete the number', # MODIF

	// T
	'titre' => 'The Penknife', # MODIF
	'titre_parent:description' => 'Within a loop it is common to want to show the title of the parent of the current object. You normally need to use a second loop to do this, but a new tag #TITRE_PARENT makes the syntax easier. In the case of a MOTS loop, the tag gives the title of the keyword group. For other objetcs (articles, sections, news items, etc.) it gives the title of the parent section (if it exists).

Note: For keywords, #TITRE_GROUPE is an alias of #TITRE_PARENT. SPIP treats the contents of these new tags as it does other #TITRE tags.

@puce@ If you are using SPIP 2.0, then you can use an array of tags of this form: #TITRE_XXX, which give you the title of the object \'xxx\', provided that the field \'id_xxx\' is present in the current table (i.e. #ID_XXX is available in the current loop).

For example, in an (ARTICLES) loop, #TITRE_SECTEUR will give the title of the sector of the current article, since the identifier #ID_SECTEUR (or the field  \'id_secteur\') is available in the loop.[[%titres_etendus%]]', # MODIF
	'titre_parent:nom' => '#TITRE_PARENT/OBJECT tags', # MODIF
	'titre_tests' => 'The Penknife - Test page', # MODIF
	'titres_typo:description' => '<NEW>Transforme tous les intertitres <html>&laquo; {{{Mon intertitre}}} &raquo;</html> en image typographique param&eacute;trable.[[%i_taille% pt]][[%i_couleur%]][[%i_police%

Polices disponibles : @_CS_FONTS@]][[%i_largeur% px]][[%i_hauteur% pt]][[%i_padding% px]][[%i_align%]]

Cet outil est compatible avec : &laquo;&nbsp;[.->sommaire]&nbsp;&raquo;.', # MODIF
	'titres_typo:nom' => '<NEW>Intertitres en image', # MODIF
	'tous' => 'All', # MODIF
	'toutes_couleurs' => 'The 36 colours in CSS styles: @_CS_EXEMPLE_COULEURS@', # MODIF
	'toutmulti:aide' => 'Multilingual blocks: <b><:trad:></b>', # MODIF
	'toutmulti:description' => 'Makes it possible to use the shortcut <code><:a_text:></code> in order to place multilingual blocks from language files, whether SPIP\'s own or your customised ones, anywhere in the text, titles, etc. of an article.

More information on this can be found in [this article->http://www.spip.net/en_article2444.html].

User variables can also be added to the shortcuts. This was introduced with SPIP 2.0. For example, <code><:a_text{name=John, tel=2563}:></code> makes it possible to pass the values to the SPIP language file: <code>\'a_text\'=>\'Please contact @name@, the administrator, on @tel@.</code>.

The SPIP function used is: <code>_T(\'a_text\')</code> (with no parmameters), and <code>_T(\'a_text\', array(\'arg1\'=>\'some words\', \'arg2\'=>\'other words\'))</code> (with parameters).

Do not forget to check that the variable used <code>\'a_text\'</code> is defined in the language files.', # MODIF
	'toutmulti:nom' => 'Multilingual blocks', # MODIF
	'travaux_masquer_avert' => '<NEW>Masquer le cadre indiquant sur le site public qu\'une maintenance est en cours', # MODIF
	'travaux_nom_site' => '@_CS_NOM_SITE@', # MODIF
	'travaux_prochainement' => 'This site will be back online soon.
_ Thank you for your understanding.', # MODIF
	'travaux_titre' => '@_CS_TRAVAUX_TITRE@', # MODIF
	'tri_articles:description' => '<MODIF>Choose the sort order to be used for displaying articles in the editing interface ([->./?exec=auteurs]), within the sections.

The options below use the SQL function \'ORDER BY\'. Only use the customised option if you know what you are doing (the available fields are: {id_article, id_rubrique, titre, soustitre, surtitre, statut, date_redac, date_modif, lang, etc.})
[[%tri_articles%]][[->%tri_perso%]]', # MODIF
	'tri_articles:nom' => '<MODIF>Article sort order', # MODIF
	'tri_groupe' => '<NEW>Tri sur l\'id du groupe (ORDER BY id_groupe)', # MODIF
	'tri_modif' => 'Sort by last modified date (ORDER BY date_modif DESC)', # MODIF
	'tri_perso' => 'Sort by customised SQL, ORDER BY:', # MODIF
	'tri_publi' => 'Sort by publication date (ORDER BY date DESC)', # MODIF
	'tri_titre' => 'Sort by title (ORDER BY 0+titre,titre)', # MODIF
	'trousse_balises:description' => '<MODIF>Tool in development. It offers a few simple tags for templates.

@puce@ {{#BOLO}}: generates a dummy text of about 3000 characters ("bolo" ou "lorem ipsum") for use with templates in development. An optional argument specifies the length of the text, e.g. <code>#BOLO{300}</code>. The tag accepts all SPIP\'s filters. For example, <code>[(#BOLO|majuscules)]</code>.
_ It can also be used as a model in content. Place <code><bolo300></code> in any text zone in order to obtain 300 characters of dummy text.

@puce@ {{#MAINTENANT}} (or {{#NOW}}): renders the current date, just like: <code>#EVAL{date(\'Y-m-d H:i:s\')}</code>. An optional argument specifies the format. For example, <code>#MAINTENANT{Y-m-d}</code>. As with <code>#DATE</code> the display can be customised using filters: <code>[(#MAINTENANT|affdate)]</code>.

- {{#CHR<html>{XX}</html>}}: a tag equivalent to <code>#EVAL{"chr(XX)"}</code> which is useful for inserting special characters (such as a line feed) or characters which are reserved for special use by the SPIP compiler (e.g. square and curly brackets).

@puce@ {{#LESMOTS}}: ', # MODIF
	'trousse_balises:nom' => 'Box of tags', # MODIF
	'type_urls:description' => '<MODIF>@puce@ SPIP offers a choice between several types of URLs for your site:

More information: [->http://www.spip.net/en_article3588.html] The "[.->boites_privees]" tool allows you to see on the page of each SPIP object the clean URL which is associated with it.
[[%radio_type_urls3%]]
<q3>@_CS_ASTER@to use the types {html}, {propres}, {propres2}, {libres} or {arborescentes}, copy the file "htaccess.txt" from the root directory of the SPIP site to a file (also at the root) named ".htaccess" (be careful not to overwrite any existing configuration if there already is a file of this name). If your site is in a subdirectory, you may need to edit the line "RewriteBase" in the file in order for the defined URLs to direct requests to the SPIP files.</q3>

<radio_type_urls3 valeur="page">@puce@ {{URLs &laquo;page&raquo;}}: the default type for SPIP since version 1.9x.
_ Example: <code>/spip.php?article123</code>.
[[%terminaison_urls_page%]][[%separateur_urls_page%]]</radio_type_urls3>

<radio_type_urls3 valeur="html">@puce@ {{URLs &laquo;html&raquo;}}: URLs take the form of classic html pages.
_ Example : <code>/article123.html</code></radio_type_urls3>

<radio_type_urls3 valeur="propres">@puce@ {{URLs &laquo;propres&raquo;}}: URLs are constructed using the title of the object. Markers (_, -, +, @, etc.) surround the titles, depending on the type of object.
_ Examples : <code>/My-article-title</code> or <code>/-My-section-</code> or <code>/@My-site@</code>[[%terminaison_urls_propres%]][[%debut_urls_propres%]][[%marqueurs_urls_propres%]]</radio_type_urls3>

<radio_type_urls3 valeur="propres2">@puce@ {{URLs &laquo;propres2&raquo;}}: the extension \'.html\' is added to the URLs generated.
_ Example : <code>/My-article-title.html</code> or <code>/-My-section-.html</code>
[[%debut_urls_propres2%]][[%marqueurs_urls_propres2%]]</radio_type_urls3>

<radio_type_urls3 valeur="libres">@puce@ {{URLs &laquo;libres&raquo;}} : the URLs are like {&laquo;propres&raquo;}, but without markers  (_, -, +, @, etc.) to differentiate the objects.
_ Example : <code>/My-article-title</code> or <code>/My-section</code>
[[%terminaison_urls_libres%]][[%debut_urls_libres%]]</radio_type_urls3>

<radio_type_urls3 valeur="arbo">@puce@ {{URLs &laquo;arborescentes&raquo;}}: URLs are built in a tree structure.
_ Example : <code>/sector/section1/section2/My-article-title</code>
[[%url_arbo_minuscules%]][[%urls_arbo_sans_type%]][[%url_arbo_sep_id%]][[%terminaison_urls_arbo%]]</radio_type_urls3>

<radio_type_urls3 valeur="propres-qs">@puce@ {{URLs &laquo;propres-qs&raquo;}}:  this system functions using a "Query-String", in other words, without using the .htaccess file. The URLs are of the form. URLs are similar in form to {&laquo;propres&raquo;}.
_ Example : <code>/?My-article-title</code>
[[%terminaison_urls_propres_qs%]]</radio_type_urls3>

<radio_type_urls3 valeur="standard">@puce@ {{URLs &laquo;standard&raquo;}}: these now discarded URLs were used by SPIP up to version 1.8.
_ Example : <code>article.php3?id_article=123</code>
</radio_type_urls3>

@puce@ If you are using the type  {page} described above or if the object requested is not recognised, you can choose the calling script for SPIP. By default, SPIP uses {spip.php}, but {index.php} (format: <code>/index.php?article123</code>) or an empty value (format: <code>/?article123</code>) are also possible. To use any other value, you need to create the corresponding file at the root of your site with the same contents as in the file {index.php}.
[[%spip_script%]]', # MODIF
	'type_urls:description1' => '@puce@ If you are using a format based on URLs &laquo;propres&raquo; ({propres}, {propres2}, {libres}, {arborescentes} ou {propres_qs}), the Penknife can:
<q1>• make sure the URL is in {{lower case}}.</q1>[[%urls_minuscules%]]
<q1>• systematically add the {{ID of the object}} to the URL (as a suffix, prefix, etc.).
_ (examples: <code>/My-article-title,457</code> or <code>/457-My-article-title</code>)</q1>', # MODIF
	'type_urls:nom' => 'Format of URLs', # MODIF
	'typo_exposants:description' => '{{Text in French}}: improves the typographical rendering of common abbreviations by adding superscript where necessary (thus, {<acronym>Mme</acronym>} becomes {M<sup>me</sup>}). Common errors corrected:  ({<acronym>2&egrave;me</acronym>} and  {<acronym>2me</acronym>}, for example, become {2<sup>e</sup>}, the only correct abbreviation).

The rendered abbreviations correspond to those of the Imprimerie nationale given in the {Lexique des r&egrave;gles typographiques en usage &agrave; l\'Imprimerie nationale} (article &laquo;&nbsp;Abr&eacute;viations&nbsp;&raquo;, Presses de l\'Imprimerie nationale, Paris, 2002).

The following expressions are also handled: <html>Dr, Pr, Mgr, St, Bx, m2, m3, Mn, Md, St&eacute;, &Eacute;ts, Vve, bd, Cie, 1o, 2o, etc.</html>

You can also choose here to use superscript for some other abbreviations, despite the negative opinion of the Imprimerie nationale:[[%expo_bofbof%]]

{{English text}}: the suffixes of ordinal numbers are placed in superscript: <html>1st, 2nd</html>, etc.', # MODIF
	'typo_exposants:nom' => 'Superscript', # MODIF

	// U
	'url_arbo' => 'arborescentes@_CS_ASTER@', # MODIF
	'url_html' => 'html@_CS_ASTER@', # MODIF
	'url_libres' => 'libres@_CS_ASTER@', # MODIF
	'url_page' => 'page', # MODIF
	'url_propres' => 'propres@_CS_ASTER@', # MODIF
	'url_propres-qs' => 'propres-qs', # MODIF
	'url_propres2' => 'propres2@_CS_ASTER@', # MODIF
	'url_propres_qs' => 'propres_qs', # MODIF
	'url_standard' => 'standard', # MODIF
	'urls_3_chiffres' => 'Require a minum of 3 digits', # MODIF
	'urls_avec_id' => 'Place as a suffix', # MODIF
	'urls_avec_id2' => 'Place as a prefix', # MODIF
	'urls_base_total' => 'There are currently @nb@ URL(s) in the database', # MODIF
	'urls_base_vide' => 'The URL database is empty', # MODIF
	'urls_choix_objet' => 'Edit the URL of a specific object in the database:', # MODIF
	'urls_edit_erreur' => 'The current URL format ("@type@") does not permit editing.', # MODIF
	'urls_enregistrer' => 'Write this URL to the database', # MODIF
	'urls_id_sauf_rubriques' => '<MODIF>Exclude the sections', # MODIF
	'urls_minuscules' => 'Lower-case letters', # MODIF
	'urls_nouvelle' => 'Edit the "clean" URL', # MODIF
	'urls_num_objet' => 'Number:', # MODIF
	'urls_purger' => 'Empty all', # MODIF
	'urls_purger_tables' => 'empty tables selected', # MODIF
	'urls_purger_tout' => 'Reset the URLs stored in the database:', # MODIF
	'urls_rechercher' => 'Find this object in the database', # MODIF
	'urls_titre_objet' => 'Saved title:', # MODIF
	'urls_type_objet' => '<MODF>Order:', # MODIF
	'urls_url_calculee' => 'URL PUBLIC  &laquo;&nbsp;@type@&nbsp;&raquo;:', # MODIF
	'urls_url_objet' => 'Saved "clean" URL:', # MODIF
	'urls_valeur_vide' => '(An empty value triggers the recalculation of the URL)', # MODIF

	// V
	'validez_page' => 'To access modifications:', # MODIF
	'variable_vide' => '(Empty)', # MODIF
	'vars_modifiees' => 'The data has been modified', # MODIF
	'version_a_jour' => '<NEW>Va&#353;a verzia je aktu&aacute;lna.',
	'version_distante' => 'Distant version...', # MODIF
	'version_distante_off' => 'REmote checking deactivated', # MODIF
	'version_nouvelle' => '<NEW>Nov&aacute; verzia: @version@',
	'version_revision' => '<NEW>verzia: @revision@',
	'version_update' => 'Automatic update', # MODIF
	'version_update_chargeur' => 'Automatic download', # MODIF
	'version_update_chargeur_title' => 'Download the latest version of the plugin using the plugin &laquo;Downloader&raquo;', # MODIF
	'version_update_title' => 'Downloads the latest version of the plugin and updates it automatically.', # MODIF
	'verstexte:description' => '2 filters for your templates which make it possible to produce lighter pages.
_ version_texte : extracts the text content of an HTML page, excluding some basic tags.
_ version_plein_texte : extracts the full text content from an html page.', # MODIF
	'verstexte:nom' => 'Text version', # MODIF
	'visiteurs_connectes:description' => 'Creates an HTML fragment for your templates which displays on the public site the number of vistors logged in.

Simply add <code><INCLURE{fond=fonds/visiteurs_connectes}></code> in the template.', # MODIF
	'visiteurs_connectes:nom' => '<NEW>Prihl&aacute;sen&iacute; n&aacute;v&#353;tevn&iacute;ci',
	'voir' => '<NEW>Pozri: @voir@',
	'votre_choix' => '<NEW>V&aacute;&#353; v&yacute;ber:',

	// W
	'webmestres:description' => 'For SPIP, a {{webmaster}} means an {{administrator}} who has an FTP access to the site. By default, from SPIP 2.0 on, this is assumed to be the administrator whose <code>id_auteur=1</code>. Webmasters defined here have the privelege of no longer needing to use FTP to validate important actions on the site, such as upgrading the database format or restoring a backup.

Current webmasters: {@_CS_LISTE_WEBMESTRES@}.
_ Eligible administrators: {@_CS_LISTE_ADMINS@}.

As a webmaster yourself, you can change this list od IDs. Use a colon as a separator if there are more than one. e.g. "1:5:6".[[%webmestres%]]', # MODIF
	'webmestres:nom' => '<NEW>zoznam webmasterov',

	// X
	'xml:description' => 'Activates the XML validator for the public site, as described in the [documentation->http://www.spip.net/en_article3582.html]. An &laquo;&nbsp;Analyse XML&nbsp;&raquo; button is added to the other admin buttons.', # MODIF
	'xml:nom' => '<NEW>Valid&aacute;tor XML'
);

?>
