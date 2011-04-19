<?php
// This is a SPIP language file  --  Ceci est un fichier langue de SPIP
// extrait automatiquement de http://www.spip.net/trad-lang/
// ** ne pas modifier le fichier **

if (!defined("_ECRIRE_INC_VERSION")) return;

$GLOBALS[$GLOBALS['idx_lang']] = array(

	// 2
	'2pts_non' => ':&nbsp;no',
	'2pts_oui' => ':&nbsp;yes',

	// S
	'SPIP_liens:description' => '@puce@ By default, all links on the site open in the current window. But it can be useful to open external links in a new window, i.e. adding {target="_blank"} to all link tags bearing one of the SPIP classes {spip_out}, {spip_url} or {spip_glossaire}. It is sometimes necessary to add one of these classes to the links in the site\'s templates (html files) in order make this functionality wholly effective.[[%radio_target_blank3%]]

@puce@ SPIP provides the shortcut <code>[?word]</code> to link words to their definition. By default (or if you leave the box below empty), wikipedia.org is used as the external glossary. You may choose another address. <br />Test link: [?SPIP][[%url_glossaire_externe2%]]', # MODIF
	'SPIP_liens:description1' => '@puce@ SPIP includes a CSS style for email links: a little envelope appears before each "mailto" link. However not all browsers can display it (IE6, IE7 and SAF3, in particular, cannot). It is up to you to decide whether to keep this addition.

_ Test link:[->test@test.com] (Reload the page to test.)[[%enveloppe_mails%]]', # MODIF
	'SPIP_liens:nom' => 'SPIP and external links',
	'SPIP_tailles:description' => '@puce@ In order to lighten the memory load on your server, SPIP allows you to restrict the dimensions (height and width) and the file sizes for images, logos or documents attached to the various contents of your site. If a given file exceeds the specified size, the form will still return the data in question but they will be destroyed and SPIP will not retain them for reuse, neither in the IMG/ directory nor in the database. A warning message will then be sent to the user.



A null or blank value indicates an unlimited value.

[[Height: %img_Hmax% pixels]][[->Width: %img_Wmax% pixels]][[->File size: %img_Smax% KB]]

[[Height: %logo_Hmax% pixels]][[->Width: %logo_Wmax% pixels]][[->File size: %logo_Smax% KB]]
[[File size: %doc_Smax% KB]]

@puce@ Enter here the maximum space reserved for remote files that SPIP will be able to download (from server to server) and store on your site. The default value here is 16 MBo.[[%copie_Smax% MB]]



@puce@ In order to avoid PHP memory overloads in processing large images with the GD2 library, SPIP tests the server capacities and can then refuse to process images that are too large. It is possible to deactivate this test by manually defining the maximum number of pixels supported for the calculation processes.



The value of 1,000,000 pixels appears to be reasonable for a configuration with little available memory. A null or blank value will mean that the testing will occur on the server.

[[%img_GDmax% maximum pixels]]



@puce@ The GD2 library is used to modify the compression quality of the JPG images. A high percentage corresponds to better quality.

[[%img_GDqual% %]]', # MODIF
	'SPIP_tailles:nom' => 'Memory limits',

	// A
	'acces_admin' => 'Administrators\' access:',
	'action_rapide' => 'Rapid action, only if you know what you are doing!',
	'action_rapide_non' => 'Rapid action, available when this tool is activated:',
	'admins_seuls' => 'Only administrators',
	'attente' => 'Waiting...',
	'auteur_forum:description' => 'Request all authors of public messages to fill in (with at least one letter!) a name and/or email in order to avoid completely anonymous messages. Note that the tool effectuates a Javascript validation on the user\'s browser.[[%auteur_forum_nom%]][[->%auteur_forum_email%]][[->%auteur_forum_deux%]]

{Caution: The third option cancels the 2 others. It\'s important to verify that the forms of your template are compatible with this tool.}', # MODIF
	'auteur_forum:nom' => 'No anonymous forums',
	'auteur_forum_deux' => 'Or a least one of the two previous fields',
	'auteur_forum_email' => 'The field &laquo;@_CS_FORUM_EMAIL@&raquo;',
	'auteur_forum_nom' => 'The field &laquo;@_CS_FORUM_NOM@&raquo;',
	'auteurs:description' => 'This tool configures the appearance of [the authors\' page->./?exec=auteurs], in the private area.



@puce@ Define here the maximum number of authors to display in the central frame of the author\'s page. Beyond this number, page numbering will be triggered.[[%max_auteurs_page%]]



@puce@ Which kinds of authors should be listed on these pages?
[[%auteurs_tout_voir%[[->%auteurs_0%]][[->%auteurs_1%]][[->%auteurs_5%]][[->%auteurs_6%]][[->%auteurs_n%]]]]', # MODIF
	'auteurs:nom' => 'Authors page',

	// B
	'balise_set:description' => 'In order to reduce the complexity of code segments like <code>#SET{x,#GET{x}|a_filter}</code>, this tool offers you the following short-cut: <code>#SET_UN_FILTRE{x}</code>. The filter applied to a variable is therefore passed in the name of the tag.



Examples: <code>#SET{x,1}#SET_PLUS{x,2}</code> or <code>#SET{x,avions}#SET_REPLACE{x,ons,ez}</code>.', # MODIF
	'balise_set:nom' => 'Extended #SET tag',
	'barres_typo_edition' => 'Editing contents',
	'barres_typo_forum' => 'Forum messages',
	'barres_typo_intro' => 'The &laquo;Porte-Plume&raquo; plugin is installed. Please choose here the typographical bars on which to insert various buttons.',
	'basique' => 'Basic',
	'blocs:aide' => 'Folding blocks: <b>&lt;bloc&gt;&lt;/bloc&gt;</b> (alias: <b>&lt;invisible&gt;&lt;/invisible&gt;</b>) and <b>&lt;visible&gt;&lt;/visible&gt;</b>',
	'blocs:description' => 'Allows you to create blocks which show/hide when you click on the title.



@puce@ {{In SPIP texts}}: authors can use the tags &lt;bloc&gt; (or &lt;invisible&gt;) and &lt;visible&gt; as shown below: 



<quote><code>

<bloc>

 Clickable title

 

 The text which is to be shown/hidden, after two new lines.

 </bloc>

</code></quote>



@puce@ {{In templates}}: you can use the new tags #BLOC_TITRE, #BLOC_DEBUT and #BLOC_FIN in this way: 

<quote><code> #BLOC_TITRE or #BLOC_TITRE(my_URL)

 My title

 #BLOC_RESUME    (optional)

 a summary of the following block

 #BLOC_DEBUT

 My collapsible block (which can be loaded by an AJAX URL, if needed)

 #BLOC_FIN</code></quote>



@puce@ If you tick "yes" below, opening one block will cause all other blocks on the page to close. i.e. only one block is open at a time.[[%bloc_unique%]]



@puce@ If you tick "yes" below, the state of the numbered blocks will be kept in a session cookie, in order to maintain the page\'s appearance as long as the session lasts.[[%blocs_cookie%]]



@puce@ By default, the Swiss Knife plugin uses the HTML tag &lt;h4&gt; for the titles of the collapsible blocks. You can specify another tag to use instead here &lt;hN&gt;:[[%bloc_h4%]]



@puce@ In order to obtain a smoother transition when you click on the title, your collapsible blocks can be animated with a "sliding" effect".[[%blocs_slide%]][[->%blocs_millisec% millisecondes]]', # MODIF
	'blocs:nom' => 'Folding Blocks',
	'boites_privees:description' => 'All the boxes described below appear somewhere in the editing area.[[%cs_rss%]][[->%format_spip%]][[->%stat_auteurs%]][[->%qui_webmasters%]][[->%bp_urls_propres%]][[->%bp_tri_auteurs%]]

- {{Swiss knife updates}}: a box on this configuration page showing the last changes made to the code of the plugin ([Source->@_CS_RSS_SOURCE@]).

- {{Articles in SPIP format}}: an extra folding box for your articles showing the source code used by their authors.

- {{Author stats}}: an extra box on [the authors\' page->./?exec=auteurs] showing the last 10 connected authors and unconfirmed registrations. Only administrators can view this information.

- {{SPIP webmasters}}: a box on the [authors\' page->./?exec=auteurs] showing which administrators are also SPIP webmasters. Only administrators can see this information. If you are a webmaster, see also the the tool "[.->webmestres]".

- {{Friendly URLs}}: a box for each objet type (article, section, author, ...) showing the clean URL associated with it and any existing aliases. The tool "&nbsp;[.->type_urls]&nbsp;" makes possible a fine adjustment of the site\'s URLs.

 {{Order of authors}}: a folding box for articles which have more than one author, allowing you simply to adjust the order in which they are displayed.', # MODIF
	'boites_privees:nom' => 'Private boxes',
	'bp_tri_auteurs' => 'Order of authors',
	'bp_urls_propres' => 'See clean URLs',
	'brouteur:description' => '@puce@ {{(Browser) section selector}}. Use the AJAX section selector when there are %rubrique_brouteur% section(s) or more.

@puce@ {{Keywords selector}}. Use a search field instead of a selection list starting from %select_mots_clefs% keyword(s).

@puce@ {{Authors selection}}. The addition of an author is made with a mini-navigator in the following panel:
<q1>• A selection for at least %select_min_auteurs% author(s).
_ • A search field starting from %select_max_auteurs% author(s).</q1>', # MODIF
	'brouteur:nom' => 'Configuration of the section selector',

	// C
	'cache_controle' => 'Cache control',
	'cache_nornal' => 'Normal usage',
	'cache_permanent' => 'Permanent cache',
	'cache_sans' => 'No cache',
	'categ:admin' => '1. Administration',
	'categ:divers' => '60. Miscellaneous',
	'categ:interface' => '10. Private interface',
	'categ:public' => '40. Public site',
	'categ:securite' => '5. S&eacute;curit&eacute;', # NEW
	'categ:spip' => '50. Tags, filters, criteria',
	'categ:typo-corr' => '20. Text improvements',
	'categ:typo-racc' => '30. Typographical shortcuts',
	'certaines_couleurs' => 'Only the tags defined below @_CS_ASTER@:',
	'chatons:aide' => 'Smileys: @liste@',
	'chatons:description' => 'Replace <code>:name</code> tags with smiley images in the text.

_ This tool will replace the shortcuts by the images of the same name found in the directory <code>mon_squelette_toto/img/chatons/</code>, or else, by default, in <code>couteau_suisse/img/chatons/</code>.', # MODIF
	'chatons:nom' => 'Smileys',
	'citations_bb:description' => 'In order to respect the HTML usages in the SPIP content of your site (articles, sections, etc.), this tool replaces the markup &lt;quote&gt; by the markup &lt;q&gt; when there are no line returns. In fact, quotations must be surrounded by &lt;q&gt; tags and the quotations containing paragraphs must be surrounded by &lt;blockquote&gt; tags.',
	'citations_bb:nom' => 'Well delimited citations',
	'class_spip:description1' => 'Here you can define some SPIP shortcuts. An empty value is equivalent to using the default.[[%racc_hr%]]',
	'class_spip:description2' => '@puce@ {{SPIP shortcuts}}.



Here you can define some SPIP shortcuts. An empty value is equivalent to using the default.[[%racc_hr%]][[%puce%]]', # MODIF
	'class_spip:description3' => '



{N.B. If the tool "[.->pucesli]" is active, then the replacing of the hyphen "-" will no longer take place; a list &lt;ul>&lt;li> will be used instead.}



SPIP normally uses the &lt;h3&gt; tag for subtitles. Here you can choose a different tag: [[%racc_h1%]][[->%racc_h2%]]', # MODIF
	'class_spip:description4' => '



SPIP normally uses the &lt;strong> tag for marking boldface type. But &lt;b> could also be used. You can choose: [[%racc_g1%]][[->%racc_g2%]]



SPIP normally uses the &lt;i> tag for marking italics. But &lt;em> could also be used. You can choose: [[%racc_i1%]][[->%racc_i2%]]



 You can also define the code used to open and close the calls to footnotes (N.B. These changes will only be visible on the public site.): [[%ouvre_ref%]][[->%ferme_ref%]]

 

 You can define the code used to open and close footnotes: [[%ouvre_note%]][[->%ferme_note%]]



@puce@ {{The default SPIP styles}}. Up to version 1.92 of SPIP, typographical shortcuts produced HTML tags all marked with the class "spip". For example, <code><p class="spip"></code>. Here you can define the style of these tags to link them to your own stylesheets. An empty box means that no particular style will be applied.



{N.B. If any of the above shortcuts (horizontal line, subtitle, italics, bold) have been modified, then the styles below will not be applied.}



<q1>

_ {{1.}} Tags &lt;p&gt;, &lt;i&gt;, &lt;strong&gt;: [[%style_p%]]

_ {{2.}} Tags &lt;tables&gt;, &lt;hr&gt;, &lt;h3&gt;, &lt;blockquote&gt; and the lists (&lt;ol&gt;, &lt;ul&gt;, etc.):[[%style_h%]]



N.B.: by changing the second parameter you will lose any standard styles associated with these tags.</q1>', # MODIF
	'class_spip:nom' => 'SPIP and its shortcuts...',
	'code_css' => 'CSS',
	'code_fonctions' => 'Functions',
	'code_jq' => 'jQuery',
	'code_js' => 'JavaScript',
	'code_options' => 'Options',
	'code_spip_options' => 'SPIP options',
	'compacte_css' => 'Compress the CSS code',
	'compacte_js' => 'Compress the JavaScript code',
	'compacte_prive' => 'Do not compress anything in the private zone',
	'compacte_tout' => 'No compression at all (renders the previous options null and void)',
	'contrib' => 'More information: @url@',
	'corbeille:description' => 'SPIP automatically deletes objets which have been put in the dustbin after one day. This is done by a "Cron" job, usually at 4 am. Here, you can block this process taking place in order to regulate the dustbin emptying yourself. [[%arret_optimisation%]]',
	'corbeille:nom' => 'Wastebin',
	'corbeille_objets' => '@nb@ object(s) in the wastebin.',
	'corbeille_objets_lies' => '@nb_lies@ connection(s) detected.',
	'corbeille_objets_vide' => 'No object in the wastebin',
	'corbeille_objets_vider' => 'Delete the selected objects',
	'corbeille_vider' => 'Empty the wastebin:',
	'couleurs:aide' => 'Text colouring: <b>[coul]text[/coul]</b>@fond@ with <b>coul</b> = @liste@',
	'couleurs:description' => 'Provide short-cuts to add colours to any text on the site (articles, news items, titles, forums, ...) by using bracket tags as short-cuts: <code>[couleur]text[/couleur]</code>.



Here are two identical examples to change the colour of some text:@_CS_EXEMPLE_COULEURS2@



In the same way, to change the background colour if the following option allows:@_CS_EXEMPLE_COULEURS3@



[[%couleurs_fonds%]]

[[%set_couleurs%]][[-><set_couleurs valeur="1">%couleurs_perso%</set_couleurs>]]
@_CS_ASTER@The format of these personalised tags have to be of existing colours or defined pairs "tag=colour", separated by comas. Examples: "grey, red", "smooth=yellow, strong=red", "low=#99CC11, high=brown" but also "grey=#DDDDCC, red=#EE3300". For the first and last examples, the allowed tags are: <code>[grey]</code> and <code>[red]</code> (<code>[fond grey]</code> and <code>[fond red]</code> if background colours are allowed).', # MODIF
	'couleurs:nom' => 'Coloured text',
	'couleurs_fonds' => ', <b>[fond&nbsp;coul]text[/coul]</b>, <b>[bg&nbsp;coul]text[/coul]</b>',
	'cs_comportement:description' => '@puce@ {{Logs.}} Record a lot of information about the working of the Swiss Knife plugin in the {spip.log} files which can be found in this directory: {<html>@_CS_DIR_TMP@</html>}[[%log_couteau_suisse%]]



@puce@ {{SPIP options.}} SPIP sorts and applies the plugins in a particular order. To be sure that the Swiss Knife is at the top and is thus able to control certain SPIP options, tick the following checkbox option. If the permissions on your server allow it, the file {<html>@_CS_FILE_OPTIONS@</html>} will be modified to include {/html>@_CS_DIR_TMP@couteau-suisse/mes_spip_options.php</html>}.

[[%spip_options_on%]]@_CS_FILE_OPTIONS_ERR@



@puce@ {{External requests.}} The Swiss Knife regularly checks for new versions of itself and shows available updates on its configuration page.  In addition, this plugin contains certain tools which may be required for importing remote libraries.



If the external requests involved do not work from your server, or you wish to lock down a possible security weakness, check this box to turn this off.[[%distant_off%]][[->%distant_outils_off%]]', # MODIF
	'cs_comportement:nom' => 'Behaviour of the Penknife',
	'cs_distant_off' => 'Checks of remote versions',
	'cs_distant_outils_off' => 'The Swiss Knife tools which have remote files',
	'cs_log_couteau_suisse' => 'Detailed logs of the Penknife',
	'cs_reset' => 'Are you sure you wish to completely reset the Penknife?',
	'cs_reset2' => 'All activated tools will be deactivated and their options reset.',
	'cs_spip_options_erreur' => 'Warning: modification of the "<html>@_CS_FILE_OPTIONS@</html>" file has failed!',
	'cs_spip_options_on' => 'SPIP options in "<html@_CS_FILE_OPTIONS@</html"',

	// D
	'decoration:aide' => 'D&eacute;coration: <b>&lt;tag&gt;test&lt;/tag&gt;</b>, with<b>tag</b> = @liste@',
	'decoration:description' => 'New, configurable styles in your text using angle brackets and tags. Example: 

&lt;mytag&gt;texte&lt;/mytag&gt; or : &lt;mytag/&gt;.<br />Define below the CSS styles you need. Put each tag on a separate line, using the following syntaxes:

- {type.mytag = my CSS style}

- {type.mytag.class = my CSS class}

- {type.mytag.lang = my languagee (e.g. en)}

- {unalias = mytag}



The parameter {type} above can be one of three values:

- {span} : inline tag 

- {div} : block element tag

- {auto} : tag chosen automatically by the plugin



[[%decoration_styles%]]', # MODIF
	'decoration:nom' => 'Decoration',
	'decoupe:aide' => 'Tabbed block: <b>&lt;onglets>&lt;/onglets></b><br/>Page or tab separator: @sep@',
	'decoupe:aide2' => 'Alias:&nbsp;@sep@',
	'decoupe:description' => '@puce@ Divides the display of an article into pages using automatic page numbering. Simply place four consecutive + characters (<code>++++</code>) where you wish a page break to occur.



By default, the Swiss Knife plugin inserts the pagination links at the top and bottom of the page. But you can place the links elsewhere in your template by using the #CS_DECOUPE tag, which you can activate here:

[[%balise_decoupe%]]



@puce@ If you use this separator between &lt;onglets&gt; and &lt;/onglets&gt; tags, then you will receive a tabbed page instead.



In templates you can use the tags #ONGLETS_DEBUT, #ONGLETS_TITRE and #ONGLETS_FIN.



This tool may be combined with "[.->sommaire]".', # MODIF
	'decoupe:nom' => 'Division in pages and tabs',
	'desactiver_flash:description' => 'Deletes the flash objects from your site and replaces them by the associated alternative content.',
	'desactiver_flash:nom' => 'Deactivate flash objects',
	'detail_balise_etoilee' => '{{N.B.}} : Check the use made in your templates of starred tags. This tool will not apply its treatment to the following tag(s): @bal@.',
	'detail_disabled' => 'Non modifiable parameters:',
	'detail_fichiers' => 'Files:',
	'detail_fichiers_distant' => 'Remote files:',
	'detail_inline' => 'Inline code:',
	'detail_jquery2' => 'This tool uses the {jQuery} library.',
	'detail_jquery3' => '{{N.B.}}: this tool requires the plugin [jQuery pour SPIP 1.92->http://files.spip.org/spip-zone/jquery_192.zip] in order to function correctly with this version of SPIP.',
	'detail_pipelines' => 'Pipelines:',
	'detail_raccourcis' => 'Here is a list of the typographical short-cuts recognised by this tool.',
	'detail_spip_options' => '{{Note}}: If this tool malfunctions, give the SPIP options priority using the "@lien@" utility.', # MODIF
	'detail_spip_options2' => 'Il est recommand&eacute; de placer les options SPIP en amont gr&acirc;ce &agrave; l\'outil &laquo;[.->cs_comportement]&raquo;.', # NEW
	'detail_spip_options_ok' => '{{Note}}: This tool currently gives the SPIP options priority using the "@lien@" utility.', # MODIF
	'detail_traitements' => 'Treatment:',
	'devdebug:description' => '{{This tool enables you to see any PHP errors on the screen.}}<br />You can choose the level of PHP execution errors that will be displayed whenever the debugger is active, as well as the SPIP space to which these settings will apply.',
	'devdebug:item_e_all' => 'All messages errors (all)',
	'devdebug:item_e_error' => 'Serious or fatal errors (error)',
	'devdebug:item_e_notice' => 'Execution notices (notice)',
	'devdebug:item_e_strict' => 'All PHP messages and warnings (strict)',
	'devdebug:item_e_warning' => 'Warnings (warning)',
	'devdebug:item_espace_prive' => 'Private space',
	'devdebug:item_espace_public' => 'Public space',
	'devdebug:item_tout' => 'All of SPIP',
	'devdebug:nom' => 'Development debugger',
	'distant_aide' => 'This tool requires remote files which must all be correctly installed in the library. Before activating this tool or updating this frame, make sure that the required files really are available on the remote server.',
	'distant_charge' => 'File correctly downloaded and installed in the library.',
	'distant_charger' => 'Start the download',
	'distant_echoue' => 'An error occurred with the remote file download - this tool may not work properly!',
	'distant_inactif' => 'Can not find the remote file (tool is inactive).',
	'distant_present' => 'The file exists in the library since @date@.',
	'dossier_squelettes:description' => 'Changes which template directory to use. For example: "squelettes/mytemplate". You can register several directories by separating them with a colon <html>":"</html>. If you leave the following box empty (or type "dist" in it), then the default "dist" template, supplied with SPIP, will be used.[[%dossier_squelettes%]]',
	'dossier_squelettes:nom' => 'Template directory',

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
	'effaces' => 'Deleted',
	'en_travaux:description' => 'Makes it possible to display a customised message on the public site and also in the editing area during maintenance work.

[[%message_travaux%]][[%titre_travaux%]][[%admin_travaux%]][[-><admin_travaux valeur="1">%avertir_travaux%</admin_travaux>]][[%prive_travaux%]]', # MODIF
	'en_travaux:nom' => 'Site in maintenance mode',
	'erreur:bt' => '<span style=\\"color:red;\\">Warning:</span> the typographical bar appears to be an old version (@version@).<br />The Penknife is compatible only with version @mini@ or newer.',
	'erreur:description' => 'missing id in the tool\'s definition!',
	'erreur:distant' => 'The distant server',
	'erreur:jquery' => '{{N.B.}} : {jQuery} does not appear to be active for this page. Please consult the paragraph about the plugin\'s required libraries [in this article->http://www.spip-contrib.net/?article2166] or reload this page.',
	'erreur:js' => 'A Javascript error appears to have occurred on this page, hindering its action. Please activate Javascript in your browser, or try deactivating some SPIP plugins which may be causing interference.',
	'erreur:nojs' => 'Javascript has been deactivated on this page.',
	'erreur:nom' => 'Error!',
	'erreur:probleme' => 'Problem with: @pb@',
	'erreur:traitements' => 'The Penknife - Compilation error: forbidden mixing of \'typo\' and \'propre\'!',
	'erreur:version' => 'This tool is unavailable in this version of SPIP.',
	'erreur_groupe' => 'Warning: the "@groupe@" group has not been defined!',
	'erreur_mot' => 'Warning: the "@mot@" keyword has not been defined!',
	'etendu' => 'Expanded',

	// F
	'f_jQuery:description' => 'Prevents the installation of {jQuery} on the public site in order to economise some "machine resources". The jQuery library ([->http://jquery.com/]) is useful in Javascript programming and many plugins use it. SPIP uses it in the editing interface.



N.B: some Swiss Knife tools require {jQuery} to be installed. ', # MODIF
	'f_jQuery:nom' => 'Deactivate jQuery',
	'filets_sep:aide' => 'Dividing lines: <b>__i__</b> or <b>i</b> is a number between <b>0</b> and <b>@max@</b>.<br />Other available lines: @liste@',
	'filets_sep:description' => 'Inserts separating lines for any SPIP texts which can be customised with a stylesheet.

_ The syntax is: "__code__", where "code" is either the identifying number (from 0 to 7) of the line to insert and which is linked to the corresponding style, or the name of an image in the plugins/couteau_suisse/img/filets directory.', # MODIF
	'filets_sep:nom' => 'Dividing lines',
	'filtrer_javascript:description' => 'Three modes are available for controlling JavaScript inserted directly in the text of articles:

- <i>never</i>: JavaScript is prohibited everywhere

- <i>default</i>: the presence of JavaScript is highlighted in red in the editing interface

- <i>always</i>: JavaScript is always accepted.



N.B.: in forums, petitions, RSS feeds, etc., JavaScript is <b>always</b> made secure.[[%radio_filtrer_javascript3%]]', # MODIF
	'filtrer_javascript:nom' => 'JavaScript management',
	'flock:description' => 'Deactivates the file-locking system which uses the PHP {flock()} function. Some web-hoting environments are unable to work with this function. Do not activate this tool if your site is functioning normally.',
	'flock:nom' => 'Files are not locked',
	'fonds' => 'Backgrounds:',
	'forcer_langue:description' => 'Forces the language context for multilingual templates which have a form or language menu able to manage the language cookie.



Technically, this tool does this:

- deactivates the choice of template according to the object\'s language.

- deactivates the automatic <code>{lang_select}</code> criterion on SPIP objects (articles, news items, sections, etc.).



This means that multi blocks are always displayed in the language requested by the visitor.', # MODIF
	'forcer_langue:nom' => 'Force language',
	'format_spip' => 'Articles in SPIP format',
	'forum_lgrmaxi:description' => 'By default forum messages are not limited in size. If this tool is activated, an error message is shown each time someone tries to post a message larger than the size given, and the message is refused. An empty value (or 0) means that no limit will be imposed.[[%forum_lgrmaxi%]]',
	'forum_lgrmaxi:nom' => 'Size of forums',

	// G
	'glossaire:aide' => 'A text with no glossary: <b>@_CS_SANS_GLOSSAIRE@</b>',
	'glossaire:description' => '@puce@ Use one or several groups of keywords to manage an internal glossary. Enter the names of the groups here, separating them by  colons (:). If you leave the box empty (or enter "Glossaire"), it is the "Glossaire" group which will be used.[[%glossaire_groupes%]]



@puce@ You can indicate the maximum number of links to create in a text for each word. A null or negative value will mean that all instances of the words will be treated. [[%glossaire_limite% par mot-cl&eacute;]]



@puce@ There is a choice of two options for generating the small window which appears for the mouseover or hover event. [[%glossaire_js%]]', # MODIF
	'glossaire:nom' => 'Internal glossary',
	'glossaire_css' => 'CSS solution',
	'glossaire_erreur' => 'The "@mot1@" keyword makes the "@mot2@" undetectable',
	'glossaire_inverser' => 'Correction proposed: reverse the order of the keywords in the database.',
	'glossaire_js' => 'JavaScript solution',
	'glossaire_ok' => 'The list of @nb@ keyword(s) checked in the database appears to be correct.',
	'guillemets:description' => 'Automatically replaces straight inverted commas (") by curly ones, using the correct ones for the current language. The replacement does not change the text stored in the database, but only the display on the screen.',
	'guillemets:nom' => 'Curly inverted commas',

	// H
	'help' => '{{This page is only accessible to main site administrators.}} It gives access to the configuration of some additional functions of the {{Penknife}}.',
	'help2' => 'Local version: @version@',
	'help3' => '<p>Documentation links:<br/>• [{{Le&nbsp;Couteau&nbsp;Suisse}}->http://www.spip-contrib.net/?article2166]@contribs@</p><p>Resets:

_ • [Hidden tools|Return to the original appearance of this page->@hide@]

_ • [Whole plugin|Reset to the original state of the plugin->@reset@]@install@

</p>', # MODIF
	'horloge:description' => 'Tool currently under development. It offers a JavaScript clock. Tag: <code>#HORLOGE</code>. Model: <code><horloge></code>



Available arguments: {zone}, {format} and/or {id}.', # MODIF
	'horloge:nom' => 'Clock',

	// I
	'icone_visiter:description' => 'Replaces the standard "Visit" button (top right on this page) with the site logo, if there is one.



To define this logo, go to the page "<:titre_configuration:>" page by clicking the "<:icone_configuration_site:>" button.', # MODIF
	'icone_visiter:nom' => '"<:icone_visiter_site:>" button',
	'insert_head:description' => 'Activate the tag [#INSERT_HEAD->http://www.spip.net/en_article2421.html] in all templates, whether or not this tag is present between &lt;head&gt; et &lt;/head&gt;. This option can be used to allow plugins to insert javascript code (.js) or stylesheets (.css).',
	'insert_head:nom' => '#INSERT_HEAD tag',
	'insertions:description' => 'N.B.: tool in development!! [[%insertions%]]',
	'insertions:nom' => 'Auto-correct',
	'introduction:description' => 'This tag can be used in templates to generate short summaries of articles, new items, etc., typically on the home page or in sections</p>

<p>{{Beware}} : If you have another plugin defining the function {balise_INTRODUCTION()} or you have defined it in your templates, you will get a compilation error.</p>

@puce@ You can specify (as a percentage of the default value) the length of the text generated by the tag #INTRODUCTION. A null value, or a value equal to 100 will not modify anything and return the defaults: 500 characters for the articles, 300 for the news items and 600 for forums and sections.

[[%lgr_introduction%&nbsp;%]]

@puce@ By default, if the text is too long, #INTRODUCTION will end with 3 dots (ellipsis): <html>"&amp;nbsp;(…)"</html>. You can change this to a customised string which shows that there is more text available.

[[%suite_introduction%]]

@puce@ If the #INTRODUCTION tag is used to give a summary of an article, the Swiss Knife can generate a link to the article for the 3 dots or string  that indicates that there is more text available. For example: "Read the rest of the article…"

[[%lien_introduction%]]

', # MODIF
	'introduction:nom' => '#INTRODUCTION tag',

	// J
	'jcorner:description' => '"Pretty Corners" is a tool which makes it easy to change the appearance of the corners of {{coloured boxes}} on the public pages of your site. Almost anything is possible!

_ See this page for examples: [->http://www.malsup.com/jquery/corner/].



Make a list below of the elements in your templates which are to be rounded. Use CSS syntax (.class, #id, etc. ). Use the sign "&nbsp;=&nbsp;" to specify the jQuery command to apply, and a double slash ("&nbsp;//&nbsp;") for comments. If no equals sign is provided, rounded corners equivalent to  <code>.ma_classe = .corner()</code> will be applied.[[%jcorner_classes%]]



N.B. This tool requires the {Round Corners} jQuery plugin in order to function. The Swiss Knife plugin can install it automatically if you check this box. [[%jcorner_plugin%]]', # MODIF
	'jcorner:nom' => 'Pretty Corners',
	'jcorner_plugin' => '"&nbsp;Round Corners plugin&nbsp;"',
	'jq_localScroll' => 'jQuery.LocalScroll ([demo->http://demos.flesler.com/jquery/localScroll/])',
	'jq_scrollTo' => 'jQuery.ScrollTo ([demo->http://demos.flesler.com/jquery/scrollTo/])',
	'js_defaut' => 'Default',
	'js_jamais' => 'Never',
	'js_toujours' => 'Always',
	'jslide_aucun' => 'No animation',
	'jslide_fast' => 'Slide fast',
	'jslide_lent' => 'Slide slow',
	'jslide_millisec' => 'Slide speed&nbsp;:',
	'jslide_normal' => 'Slide normally',

	// L
	'label:admin_travaux' => 'Close the public site for:',
	'label:arret_optimisation' => 'Stop SPIP from emptying the wastebin automatically:',
	'label:auteur_forum_nom' => 'The visitor must specify:',
	'label:auto_sommaire' => 'Systematic creation of a summary:',
	'label:balise_decoupe' => 'Activate the #CS_DECOUPE tag:',
	'label:balise_sommaire' => 'Activate the tag #CS_SOMMAIRE :',
	'label:bloc_h4' => 'Tag for the titles:',
	'label:bloc_unique' => 'Only one block open on the page:',
	'label:blocs_cookie' => 'Cookie usage:',
	'label:blocs_slide' => 'Type of animation:',
	'label:compacte_css' => 'Compression of the HEAD:',
	'label:copie_Smax' => 'Maximum space reserved for local copies:',
	'label:couleurs_fonds' => 'Allow backgrounds:',
	'label:cs_rss' => 'Activate:',
	'label:debut_urls_propres' => 'Beginning of the URLs:',
	'label:decoration_styles' => 'Your personalised style tags:',
	'label:derniere_modif_invalide' => 'Refresh immediately after a modification:',
	'label:devdebug_espace' => 'Filtering of the space in question:',
	'label:devdebug_mode' => 'Activate debugging',
	'label:devdebug_niveau' => 'Filtering of error severity reported:',
	'label:distant_off' => 'Deactivate:',
	'label:doc_Smax' => 'Maximum document size:',
	'label:dossier_squelettes' => 'Directory(ies) to use:',
	'label:duree_cache' => 'Duration of local cache:',
	'label:duree_cache_mutu' => 'Duration of mutualised cache:',
	'label:ecran_actif' => '@_CS_CHOIX@', # NEW
	'label:enveloppe_mails' => 'Small envelope before email addresses:',
	'label:expo_bofbof' => 'Place in superscript: <html>St(e)(s), Bx, Bd(s) et Fb(s)</html>',
	'label:forum_lgrmaxi' => 'Value (in characters):',
	'label:glossaire_groupes' => 'Group(s) used:',
	'label:glossaire_js' => 'Technique used:',
	'label:glossaire_limite' => 'Maximum number of links created:',
	'label:i_align' => 'Text alignment:',
	'label:i_couleur' => 'Font colour:',
	'label:i_hauteur' => 'Line height of the text:',
	'label:i_largeur' => 'Maximum width of the text line:',
	'label:i_padding' => 'Text padding:',
	'label:i_police' => 'Font file name ({polices/} folders):',
	'label:i_taille' => 'Font size:',
	'label:img_GDmax' => 'Use GD to process images:',
	'label:img_Hmax' => 'Maximum image size:',
	'label:insertions' => 'Auto-correct:',
	'label:jcorner_classes' => 'Improve the corners of the following CSS selectors:',
	'label:jcorner_plugin' => 'Install the following {jQuery} plugin:',
	'label:jolies_ancres' => 'Create pretty anchors:',
	'label:lgr_introduction' => 'Length of summary:',
	'label:lgr_sommaire' => 'Length of summary (9 to 99):',
	'label:lien_introduction' => 'Clickable follow-on dots:',
	'label:liens_interrogation' => 'Protect URLs:',
	'label:liens_orphelins' => 'Clickable links:',
	'label:log_couteau_suisse' => 'Activate:',
	'label:logo_Hmax' => 'Logo maximum height:',
	'label:marqueurs_urls_propres' => 'Add markers to distinguish between objects (SPIP>=2.0:<br />(e.g. "&nbsp;-&nbsp;" pour -My-section-, "&nbsp;@&nbsp;" for @My-site@) ',
	'label:max_auteurs_page' => 'Authors per page:',
	'label:message_travaux' => 'Your maintenance message:',
	'label:moderation_admin' => 'Automatically validate messages from:',
	'label:mot_masquer' => 'Keyword hiding the contents:',
	'label:ouvre_note' => 'Opening and closing markers of footnotes',
	'label:ouvre_ref' => 'Opening and closing markers of footnote links',
	'label:paragrapher' => 'Always insert paragraphs:',
	'label:prive_travaux' => 'Access to the editing area for:',
	'label:prof_sommaire' => 'Depth maintained (1 to 4):',
	'label:puce' => 'Public bullet &laquo;<html>-</html>&raquo;:',
	'label:quota_cache' => 'Quota value',
	'label:racc_g1' => 'Beginning and end of "<html>{{bolded text}}</html>":',
	'label:racc_h1' => 'Beginning and end of a &laquo;<html>{{{subtitle}}}</html>&raquo;:',
	'label:racc_hr' => 'Horizontal line (<html>----</html>) :',
	'label:racc_i1' => 'Beginning and end of &laquo;<html>{italics}</html>&raquo;:',
	'label:radio_desactive_cache3' => 'Deactivate the cache',
	'label:radio_desactive_cache4' => 'Use of the cache',
	'label:radio_target_blank3' => 'New window for external links:',
	'label:radio_type_urls3' => 'URL format:',
	'label:scrollTo' => 'Instal the following {jQuery} plugins:',
	'label:separateur_urls_page' => 'Separating character for \'type-id\'<br />(e.g. ?article-123):',
	'label:set_couleurs' => 'Set to be used ',
	'label:spam_ips' => 'IP addresses to block:',
	'label:spam_mots' => 'Prohibited sequences:',
	'label:spip_options_on' => 'Include',
	'label:spip_script' => 'Calling script',
	'label:style_h' => 'Your style:',
	'label:style_p' => 'Your style:',
	'label:suite_introduction' => 'Follow-on dots',
	'label:terminaison_urls_page' => 'URL endings (e.g.: .html):',
	'label:titre_travaux' => 'Message title:',
	'label:titres_etendus' => 'Activate the extended use of the tags #TITRE_XXX:',
	'label:url_arbo_minuscules' => 'Preserve the case of titles in URLs:',
	'label:url_arbo_sep_id' => 'Separation character for \'title-id\', used in the event of homonyms:<br />(do not use \'/\')',
	'label:url_glossaire_externe2' => 'Link to external glossary:',
	'label:url_max_propres' => 'Maximum length of URLs (characters):',
	'label:urls_arbo_sans_type' => 'Show the type of SPIP object in URLs:',
	'label:urls_avec_id' => 'A systematic id, but ...',
	'label:webmestres' => 'List of the website managers:',
	'liens_en_clair:description' => 'Makes the filter: \'liens_en_clair\' available to you. Your text probably contains hyperlinks which are not visible when the page is printed. This filter adds the link code between square brackets for every clickabel link (external links and email addresses). N.B: in printing mode (when using the parameter \'cs=print\' or \'page=print\' in the URL), this treatment is automatically applied.',
	'liens_en_clair:nom' => 'Visible hyperlinks',
	'liens_orphelins:description' => 'This tool has two functions:



@puce@ {{Correct Links}}.



In French texts, SPIP follows the rules of French typography and inserts a space before question and exclamation marks, and uses French-style quotation marks when appropriate. This tool prevents this from happening in URLs.[[%liens_interrogation%]]



@puce@ {{Orphan links}}.



Systematically replaces all URLs which authors have placed in texts (especially often in forums), and which are thus not clickable, by links in the SPIP format. For example, {<html>www.spip.net</html>} will be replaced by: [->www.spip.net].



You can choose the manner of replacement:

_ • {Basic}: links such as {<html>http://spip.net</html>} (whatever protocol) and {<html>www.spip.net</html>} are replaced.

_ • {Extended}: additionally links such as these are also replaced:  {<html>me@spip.net</html>}, {<html>mailto:myaddress</html>} ou {<html>news:mynews</html>}.

_ • {By default}: automatic replacement (from SPIP version 2.0).

[[%liens_orphelins%]]', # MODIF
	'liens_orphelins:nom' => 'Fine URLs',

	// M
	'mailcrypt:description' => 'Hides all the email links in your textes and replaces them with a Javascript link which activates the visitor\'s email programme when the link is clicked. This antispam tool attempts to prevent web robots from collecting email addresses which have been placed in forums or in the text displayed by the tags in your templates.',
	'mailcrypt:nom' => 'MailCrypt',
	'maj_auto:description' => 'This tool is used to help you easily manage the updates of your various plugins, specifically be retrieving the version number located in your various local <code>svn.revision</code> files and comparing them with those found on the <code>zone.spip.org</code> site.



The list above offers the possibility of running SPIP\'s automatic update process for each of the plugins already installed in the  <code>plugins/auto/</code> directory. The other plugins located in the  <code>plugins/</code> directory are simply listed for information purposes. If the remote version can not be located, then try to proceed with updating the plugin manually.



Note: since the <code>.zip</code> files are not always instantly reconstructed, you might have to wait a while before you can carry out the total update of a recently modified plugin.', # MODIF
	'maj_auto:nom' => 'Automatic updates',
	'masquer:description' => 'This tool is used for hiding specific editorial content (sections or articles) tagged with the keyword specified below from the public site without requiring any other modifications to your templates. If a section is hidden, then so is its entire sub-branch.[[%mot_masquer%]]



To override and force the display of such hidden content, just add the <code>{tout_voir}</code> criteria to the loops in your template(s).', # MODIF
	'masquer:nom' => 'Hide editorial content',
	'meme_rubrique:description' => 'Define here the number of objects listed in the panel labelled "<:info_meme_rubrique:>" available on some of the private zone pages.[[%meme_rubrique%]]',
	'message_perso' => 'oh!',
	'moderation_admins' => 'authenticated administrators',
	'moderation_message' => 'This forum is pre-moderated: your contribution will only appear once it has been validated by one of the site administrators (unless you are logged in and authorised to post directly).',
	'moderation_moderee:description' => 'Makes it possible to moderate the moderation of the <b>pre-moderated</b> public forums for logged-in visitors.<br />Example: I am the webmaster of a site, and I reply to the message of a user who asks why they need to validate their own message. Moderating moderation does it for me! [[%moderation_admin%]][[-->%moderation_redac%]][[-->%moderation_visit%]]',
	'moderation_moderee:nom' => 'Moderate moderation',
	'moderation_redacs' => 'authenticated authors',
	'moderation_visits' => 'Visitors authenticated',
	'modifier_vars' => 'Change these @nb@ parameters',
	'modifier_vars_0' => 'Change these parameters',

	// N
	'no_IP:description' => 'Deactivates, in order to preserve confidentiality, the mechanism which records the IP addresses of visitors to your site. SPIP will thus no longer record any IP addresses, neither temporarily at the time of the visits (used for managing statistics or for spip.log), nor in the forums (source of posts).',
	'no_IP:nom' => 'No IP recording',
	'nouveaux' => 'New',

	// O
	'orientation:description' => '3 new criteria for your templates: <code>{portrait}</code>, <code>{carre}</code> et <code>{paysage}</code>. Ideal for sorting photos according to their format (carre = square; paysage = landscape).',
	'orientation:nom' => 'Picture orientation',
	'outil_actif' => 'Activated tool',
	'outil_actif_court' => 'active',
	'outil_activer' => 'Activate',
	'outil_activer_le' => 'Activate the tool',
	'outil_cacher' => 'No longer show',
	'outil_desactiver' => 'Deactivate',
	'outil_desactiver_le' => 'Deactivate this tool',
	'outil_inactif' => 'Inactive tool',
	'outil_intro' => 'This page lists the functionalities which the plugin makes available to you.<br /><br />By clicking on the names of the tools below, you choose the ones which you can then switch on/off using the central button: active tools will be disabled and <i>vice versa</i>. When you click, the tools description is shown above the list. The tool categories are collapsible to hide the tools they contain. A double-click allows you to directly switch a tool on/off.<br /><br />For first use, it is recommended to activate tools one by one, thus reavealing any incompatibilites with your templates, with SPIP or with other plugins.<br /><br />N.B.: simply loading this page recompiles all the Penknife tools.',
	'outil_intro_old' => 'This is the old interface.<br /><br />If you have difficulties in using <a href=\\\'./?exec=admin_couteau_suisse\\\'>the new interface</a>, please let us know in the forum of <a href=\\\'http://www.spip-contrib.net/?article2166\\\'>Spip-Contrib</a>.',
	'outil_nb' => '@pipe@: @nb@&nbsp;tool',
	'outil_nbs' => '@pipe@: @nb@&nbsp;tools',
	'outil_permuter' => 'Switch the tool: &laquo; @text@ &raquo; ?',
	'outils_actifs' => 'Activated tools:',
	'outils_caches' => 'Hidden tools:',
	'outils_cliquez' => 'Click the names of the tools above to show their description.',
	'outils_concernes' => 'Affected: ',
	'outils_desactives' => 'Deactivated: ',
	'outils_inactifs' => 'Inactive tools:',
	'outils_liste' => 'List of tools of the Penknife',
	'outils_non_parametrables' => 'Cannot be configured:',
	'outils_permuter_gras1' => 'Switch the tools in bold type',
	'outils_permuter_gras2' => 'Switch the @nb@ tools in bold type?',
	'outils_resetselection' => 'Reset the selection',
	'outils_selectionactifs' => 'Select all the active tools',
	'outils_selectiontous' => 'ALL',

	// P
	'pack_actuel' => 'Pack @date@',
	'pack_actuel_avert' => 'Warning: the overrides of globals, special authorisations and "define()" functions are not specified here',
	'pack_actuel_titre' => 'UP-TO-DATE CONFIGURATION PACK OF THE PENKNIFE',
	'pack_alt' => 'See the current configuration parameters',
	'pack_delete' => 'Delete a configuration pack',
	'pack_descrip' => 'Your "Current configuration pack" brings together all the parameters activated for the Swiss Knife plugin. It remembers both whether a tool is activated or not and, if so, what options have been chosen.



If write access privileges permit, this PHP code may be placed in the /config/mes_options.php file. It will place a reset link on the page of the "pack {@pack@}". Of course, you can change its name below.



If you reset the plugin by clicking on a pack, the Swiss Knife plugin will reconfigure itself according to the values defined in that pack.', # MODIF
	'pack_du' => '• of the pack @pack@',
	'pack_installe' => 'Installation of a configuration pack',
	'pack_installer' => 'Are you sure you want to re-initialise the Penknife and install the &laquo;&nbsp;@pack@&nbsp;&raquo; pack?',
	'pack_nb_plrs' => 'There are @nb@ "configuration packs" currently available.',
	'pack_nb_un' => 'One "configuration pack" is currently available:',
	'pack_nb_zero' => 'No "configuration pack" is currently available.',
	'pack_outils_defaut' => 'Installation of the default tools',
	'pack_sauver' => 'Save the current configuration',
	'pack_sauver_descrip' => 'The button below allows you to insert into your <b>@file@</b> file the parameters needed for an additional "configuration pack" in the the lefthand menu. This makes it possible to reconfigure the Penknife with a single click to the current state.',
	'pack_supprimer' => 'Are you sure you want to delete the "&nbsp;@pack@&nbsp;" pack?',
	'pack_titre' => 'Current configuration',
	'pack_variables_defaut' => 'Installation of the default variables',
	'par_defaut' => 'By default',
	'paragrapher2:description' => 'The SPIP function <code>paragrapher()</code> inserts the tags &lt;p&gt; and &lt;/p&gt; around all texts which do not have paragraphs. In order to have a finer control over your styles and layout, you can give a uniform look to your texts throughout the site.[[%paragrapher%]]',
	'paragrapher2:nom' => 'Insert paragraphs',
	'pipelines' => 'Entry points used:',
	'previsualisation:description' => 'By default, SPIP enables previewing an article in its public and CSS-styled version, but only when it has been "proposed for publication". However, this tool allows authors to also preview articles while they are still being written. Anyone can therefore preview and modify their own text to their own liking.



@puce@ Warning: this functionality does not modify the preview rights. In order for your editors to actually be able to preview their articles "in progress", you still need to authorise this function (in the {[Configuration&gt;Advanced functions->./?exec=config_fonctions]} menu in the private zone).', # MODIF
	'previsualisation:nom' => 'Previewing articles',
	'puceSPIP' => 'Enable the "*" typographical short-cut',
	'puceSPIP_aide' => 'A SPIP bullet: <b>*</b>',
	'pucesli:description' => 'Replaces "-" (single hyphen) bullets in articles with "-*" ordered lists (transformed into  &lt;ul>&lt;li>…&lt;/li>&lt;/ul> in HTML) whose style may be customised using CSS.



To retain access to SPIP\'s original bullet image (the little triangle), a new "*" short-cut at the start of the line can be suggested to your editors:[[%puceSPIP%]]', # MODIF
	'pucesli:nom' => 'Beautiful bullets',

	// Q
	'qui_webmestres' => 'SPIP webmasters',

	// R
	'raccourcis' => 'Active Penknife typographical shortcuts:',
	'raccourcis_barre' => 'The Penknife\'s typographical shorcuts',
	'reserve_admin' => 'Access restricted to administrators',
	'rss_actualiser' => 'Update',
	'rss_attente' => 'Awaiting RSS...',
	'rss_desactiver' => 'Deactivate &laquo;Penknife updates&raquo;',
	'rss_edition' => 'RSS feed updated:',
	'rss_source' => 'RSS source',
	'rss_titre' => 'Development of the &laquo;The Penknife&raquo;:',
	'rss_var' => 'Penknife updates',

	// S
	'sauf_admin' => 'All, except administrators',
	'sauf_admin_redac' => 'Everyone, except administrators and editors',
	'sauf_identifies' => 'Everyone, except nominated authors',
	'set_options:description' => 'Preselects the type of interface (simplified or advanced) for all editors, both existing and future ones. At the same time the button offering the choice between the two interfaces is also removed.[[%radio_set_options4%]]',
	'set_options:nom' => 'Type of private interface',
	'sf_amont' => 'Upstream',
	'sf_tous' => 'All',
	'simpl_interface:description' => 'Deactivates the pop-up menu for changing article status which shows onmouseover on the coloured status bullets. This can be useful if you wish to have an editing interface which is as simple as possible for the users.',
	'simpl_interface:nom' => 'Simplification of the editing interface',
	'smileys:aide' => 'Smileys: @liste@',
	'smileys:description' => 'Inserts smileys in texts containing a short-cut in this form <code>:-)</code>. Ideal for use in forums.

_ A tag is available for displaying a table of smileys in templates: #SMILEYS.

_ Images: [Sylvain Michel->http://www.guaph.net/]', # MODIF
	'smileys:nom' => 'Smileys',
	'soft_scroller:description' => 'Gives a slow scroll effect when a visitor clicks on a link with an anchor tag. This helps the visitor to know where they are in a long text.



N.B. In order to work, this tool needs to be used in "DOCTYPE XHTML" pages (not HTML!). It also requires two {jQuery} plugins: {ScrollTo} et {LocalScroll}. The Swiss Knife can install them itself if you check the following two boxes. [[%scrollTo%]][[->%LocalScroll%]]

@_CS_PLUGIN_JQUERY192@', # MODIF
	'soft_scroller:nom' => 'Soft anchors',
	'sommaire:description' => 'Builds a mini table-of-contents of your articles and sections in order to access the main headings quickly (HTML tags &lt;@h3@>A big title&lt;/@h3@>> or SPIP subtitle short-cuts in the form: <code>{{{My subtitle}}}</code>).



For information purposes, the "&nbsp;[.->class_spip]&nbsp;" tool is used to select the &lt;hN> tag used for SPIP sub-titles.



@puce@ You can define the depth retained for the sub-headings used to construct the summary (1 = &lt;@h3@>, 2 = &lt;@h3@> and &lt;@h4@>, etc.) :[[%prof_sommaire%]]



@puce@ You can define the maximum number of characters of the subtitles used to make the summary:[[%lgr_sommaire% characters]]



@puce@ The table of content anchors can be calculated from the title and not looking like: {tool_summary_NN}. This option also offers the syntax: <code>{{{My title<my_anchor}}}</code> which allows you to specify the anchor to be used.[[%jolies_ancres%]]



@puce@ You can also determine the way in which the plugin constructs the summary: 

_ • Systematically, for each article (a tag named <code>@_CS_SANS_SOMMAIRE@</code> placed anywhere within the text of the article will make an exception to the rule).

_ • Only for articles containing the <code>@_CS_AVEC_SOMMAIRE@</code> tag.



[[%auto_sommaire%]]



@puce@ By default, the Swiss Knife automatically inserts the summary at the top of the article. But you can place it elsewhere, if you wish, by using the #CS_SOMMAIRE tag, which you can activate here:

[[%balise_sommaire%]]



The summary can be used in conjunction with: "{[.->decoupe]}" and "&nbsp;[.->titres_typo]&nbsp;".', # MODIF
	'sommaire:nom' => 'Automatic T.O.C.',
	'sommaire_ancres' => 'Selected anchors: <b><html>{{{My Title&lt;my_anchor&gt;}}}</html></b>',
	'sommaire_avec' => 'An article with summary: <b>@_CS_AVEC_SOMMAIRE@</b>',
	'sommaire_sans' => 'An article without summary: <b>@_CS_SANS_SOMMAIRE@</b>',
	'sommaire_titres' => 'Structured sub-headings: <b><html>{{{*Title}}}</html></b>, <b><html>{{{**Sub-title}}}</html></b>, etc.',
	'spam:description' => 'Attempts to fight against the sending of abusive and automatic messages through forms on the public site. Some words and the &lt;a>&lt;/a> tags are prohibited. Train your authors to use SPIP short-cuts for links.



@puce@ List here the sequences you wish to prohibit, separating them with spaces. [[%spam_mots%]]

<q1>• Expressions containing spaces should be placed within quotation marks.

_ • To specify a whole word, place it in parentheses. For example: {(asses)}.

_ • To use a regular expression, first check the syntax, then place it between slashes and quotation marks.

_ Example:~{<html>"/@test.(com|en)/"</html>}.

_ • To use a regular expression that works on HTML characters, place the text between "&amp;#" and ";".

_ Example:~{<html>"/&amp;#(?:1[4-9][0-9]{3}|[23][0-9]{4});/"</html>}.</q1>



@puce@ Certain IP addresses can also be blocked at their source. But remember that behind these addresses (often variable in nature) there may be a plethora of users or even an entire network.[[%spam_ips%]]

<q1>• Use the "*" character to replace several unknown letters, "?" for a single one and brackets for classes of letters.</q1>', # MODIF
	'spam:nom' => 'Fight against SPAM',
	'spam_ip' => 'IP blocking of @ip@:',
	'spam_test_ko' => 'This message would be blocked by the anti-SPAM filter!',
	'spam_test_ok' => 'This message would be accepted by the anti-SPAM filter!',
	'spam_tester_bd' => 'Also test your database and list the messages which have been blocked by the tool\'s current configuration settings.',
	'spam_tester_label' => 'Test your list of prohibited expressions or IP addresses here, using the following panel:',
	'spip_cache:description' => '@puce@ The cache occupies disk space and SPIP can limit the amount of space taken up. Leaving empty or putting 0 means that no limit will be applied.[[%quota_cache% Mo]]



@puce@ When the site\'s contents are changed, SPIP immediately invalidates the cache without waiting for the next periodic recalculation. If your site experiences performance problems because of the load of repeated recalculations, you can choose "no" for this option.[[%derniere_modif_invalide%]]



@puce@ If the #CACHE tag is not found in a template, then by default SPIP caches a page for 24 hours before recalculating it. You can modify this default here.[[%duree_cache% heures]]



@puce@ If you are running several mutualised sites, you can specify here the default value for all the local sites (SPIP 2.0 mini).[[%duree_cache_mutu% heures]]', # MODIF
	'spip_cache:description1' => '@puce@ By default, SPIP calculates all the public pages and caches them in order to accelerate their display. It can be useful, when developing the site to disable the cache temporarily, in order to see the effect of changes immediately.[[%radio_desactive_cache3%]]',
	'spip_cache:description2' => '@puce@ Four options to configure the cache: <q1>

_ • {Normal usage}: SPIP places all the calculated pages of the public site in the cache in order to speed up their delivery. After a certain time the cache is recalculated and stored again.

_ • {Permanent cache}: the cache is never recalculated (time limits in the templates are ignored).

_ • {No cache}: temporarily deactivating the cache can be useful when the site is being developed. With this option, nothing is cached on disk.

_ • {Cache checking}: similar to the preceding option. However, all results are written to disk in order to be able to check them.</q1>[[%radio_desactive_cache4%]]', # MODIF
	'spip_cache:description3' => '@puce@ The "Compresser" extension available in SPIP is used to compress the various CSS and JavaScript code sections of your pages and insert them in a static cache file. This speeds up the display of your site, and limits both the number of calls made to the server and the size of the files that need to be retrieved.', # MODIF
	'spip_cache:nom' => 'SPIP and the cache',
	'spip_ecran:description' => 'Specify the screen width imposed on everyone in the private zone. A narrow screen will display two columns and a wide screen will display three. The default settings leaves the user to make their own choice which will be stored in a browser cookie.[[%spip_ecran%]]',
	'spip_ecran:nom' => 'Screen width',
	'stat_auteurs' => 'Authors in statistics',
	'statuts_spip' => 'Only the following SPIP status:',
	'statuts_tous' => 'Every status',
	'suivi_forums:description' => 'The author of an article is always informed when a message is posted in the article\'s public forum. It is also possible to inform others: either all the forum\'s participants, or  just all the authors of messages higher in the thread.[[%radio_suivi_forums3%]]',
	'suivi_forums:nom' => 'Overview of the public forums',
	'supprimer_cadre' => 'Delete this frame',
	'supprimer_numero:description' => 'Applies the supprimer_numero() SPIP function to all {{titles}}, {{names}} and {{types}} (of keywords) of the public site, without needing the filter to be present in the templates.<br />For a multilingual site, follow this syntax: <code>1. <multi>My Title[fr]Mon Titre[de]Mein Titel</multi></code>',
	'supprimer_numero:nom' => 'Delete the number',

	// T
	'titre' => 'The Penknife',
	'titre_parent:description' => 'Within a loop, it is common to want to show the title of the parent of the current object. You normally need to use a second loop to do this, but a new tag #TITRE_PARENT makes the syntax easier. In the case of a MOTS loop, the tag gives the title of the keyword group. For other objects (articles, sections, news items, etc.) it gives the title of the parent section (if it exists).



Note: For keywords, #TITRE_GROUPE is an alias of #TITRE_PARENT. SPIP treats the contents of these new tags as it does other #TITRE tags.



@puce@ If you are using SPIP 2.0, then you can use an array of tags of this form: #TITRE_XXX, which give you the title of the object \'xxx\', provided that the field \'id_xxx\' is present in the current table (i.e. #ID_XXX is available in the current loop).



For example, in an (ARTICLES) loop, #TITRE_SECTEUR will give the title of the sector of the current article, since the identifier #ID_SECTEUR (or the field  \'id_secteur\') is available in the loop.



The code <html>#TITRE_XXX{yy}</html> is also available to be used. Example: <html>#TITRE_ARTICLE{10}</html> will return the title of article #10.[[%titres_etendus%]]', # MODIF
	'titre_parent:nom' => '#TITRE_PARENT/OBJECT tags',
	'titre_tests' => 'The Penknife - Test page',
	'titres_typo:description' => 'Transform all of the intermediary headings <html>" {{{My sub-heading}}} "</html> into configurable typographical images.[[%i_taille% pt]][[%i_couleur%]][[%i_police%



Available fonts: @_CS_FONTS@]][[%i_largeur% px]][[%i_hauteur% pt]][[%i_padding% px]][[%i_align%]]



This tool is compatible with: "&nbsp;[.->sommaire]&nbsp;".', # MODIF
	'titres_typo:nom' => 'Sub-headings as images',
	'tous' => 'All',
	'toutes_couleurs' => 'The 36 colours in CSS styles: @_CS_EXEMPLE_COULEURS@',
	'toutmulti:aide' => 'Multilingual blocks: <b><:trad:></b>',
	'toutmulti:description' => 'Makes it possible to use the shortcut <code><:a_text:></code> in order to place multilingual blocks from language files, whether SPIP\'s own or your customised ones, anywhere in the text, titles, etc. of an article.



More information on this can be found in [this article->http://www.spip.net/en_article2444.html].



User variables can also be added to the shortcuts. This was introduced with SPIP 2.0. For example, <code><:a_text{name=John, tel=2563}:></code> makes it possible to pass the values to the SPIP language file: <code>\'a_text\'=>\'Please contact @name@, the administrator, on @tel@.</code>.



The SPIP function used is: <code>_T(\'a_text\')</code> (with no parameters), and <code>_T(\'a_text\', array(\'arg1\'=>\'some words\', \'arg2\'=>\'other words\'))</code> (with parameters).



Do not forget to check that the variable used <code>\'a_text\'</code> is defined in the language files.', # MODIF
	'toutmulti:nom' => 'Multilingual blocks',
	'travaux_masquer_avert' => 'Hide the frame indicating on the public site that maintenance is currently being carried out',
	'travaux_nom_site' => '@_CS_NOM_SITE@',
	'travaux_prochainement' => 'This site will be back online soon.

_ Thank you for your understanding.', # MODIF
	'travaux_titre' => '@_CS_TRAVAUX_TITRE@',
	'tri_articles:description' => 'Choose the sort order to be used for displaying certain types of objects in the editing interface ([->./?exec=auteurs]), within the sections.



The options below use the SQL function \'ORDER BY\'. Only use the customised option if you know what you are doing (the available fields are: {id_article, id_rubrique, titre, soustitre, surtitre, statut, date_redac, date_modif, lang, etc.})



@puce@ {{Order of the articles inside the sections}} [[%tri_articles%]][[->%tri_perso%]]



@puce@ {{Order of the groups in the add-a-keyword form}} [[%tri_groupes%]][[->%tri_perso_groupes%]]', # MODIF
	'tri_articles:nom' => 'SPIP\'s sort orders',
	'tri_groupe' => 'Sort on the group id (ORDER BY id_groupe)',
	'tri_modif' => 'Sort by last modified date (ORDER BY date_modif DESC)',
	'tri_perso' => 'Sort by customised SQL, ORDER BY:',
	'tri_publi' => 'Sort by publication date (ORDER BY date DESC)',
	'tri_titre' => 'Sort by title (ORDER BY 0+titre,titre)',
	'trousse_balises:description' => 'Tool currently under development. It offers a few simple and practical tags to improve the legibility of your templates.



@puce@ {{#BOLO}}: generates a dummy text of about 3000 characters ("bolo" ou "[?lorem ipsum]") for use with templates in development. An optional argument specifies the length of the text, e.g. <code>#BOLO{300}</code>. The tag accepts all SPIP\'s filters. For example, <code>[(#BOLO|majuscules)]</code>.

_ It can also be used as a model in content. Place <code><bolo300></code> in any text zone in order to obtain 300 characters of dummy text.



@puce@ {{#MAINTENANT}} (or {{#NOW}}): returns the current date, just like: <code>#EVAL{date(\'Y-m-d H:m:s\')}</code>. An optional argument specifies the format. For example, <code>#MAINTENANT{Y-m-d}</code>. As with <code>#DATE</code> the display can be customised using filters: <code>[(#MAINTENANT|affdate)]</code>.



@puce {{#CHR<html>{XX}</html>}}: a tag equivalent to <code>#EVAL{"chr(XX)"}</code> which is useful for inserting special characters (such as a line feed) or characters which are reserved for special use by the SPIP compiler (e.g. square and curly brackets).



@puce@ {{#LESMOTS}}: ', # MODIF
	'trousse_balises:nom' => 'Box of tags',
	'type_urls:description' => '@puce@ SPIP offers a choice between several types of URLs to generate the access links for pages on your site:



More information: [->http://www.spip.net/en_article3588.html] The "[.->boites_privees]" tool allows you to see on the page of each SPIP object the clean URL which is associated with it.

[[%radio_type_urls3%]]

<q3>@_CS_ASTER@to use the types {html}, {propres}, {propres2}, {libres} or {arborescentes}, copy the file "htaccess.txt" from the root directory of the SPIP site to a file (also at the root) named ".htaccess" (be careful not to overwrite any existing configuration if there already is a file of this name). If your site is in a subdirectory, you may need to edit the line "RewriteBase" in the file in order for the defined URLs to direct requests to the SPIP files.</q3>



<radio_type_urls3 valeur="page">@puce@ {{URLs &laquo;page&raquo;}}: the default type for SPIP since version 1.9x.

_ Example: <code>/spip.php?article123</code>.
[[%terminaison_urls_page%]][[%separateur_urls_page%]]</radio_type_urls3>



<radio_type_urls3 valeur="html">@puce@ {{URLs &laquo;html&raquo;}}: URLs take the form of classic html pages.

_ Example: <code>/article123.html</code></radio_type_urls3>



<radio_type_urls3 valeur="propres">@puce@ {{URLs "propres"}}: URLs are constructed using the title of the object. Markers (_, -, +, @, etc.) surround the titles, depending on the type of object.

_ Examples: <code>/My-article-title</code> or <code>/-My-section-</code> or <code>/@My-site@</code>[[%terminaison_urls_propres%]][[%debut_urls_propres%]][[%marqueurs_urls_propres%]][[%url_max_propres%]]</radio_type_urls3>



<radio_type_urls3 valeur="propres2">@puce@ {{URLs "propres2"}}: the extension \'.html\' is added to the URLs generated.

_ Example: <code>/My-article-title.html</code> or <code>/-My-section-.html</code>

[[%debut_urls_propres2%]][[%marqueurs_urls_propres2%]][[%url_max_propres2%]]</radio_type_urls3>



<radio_type_urls3 valeur="libres">@puce@ {{URLs &laquo;libres&raquo;}} : the URLs are like {&laquo;propres&raquo;}, but without markers  (_, -, +, @, etc.) to differentiate the objects.

_ Example: <code>/My-article-title</code> or <code>/My-section</code>

[[%terminaison_urls_libres%]][[%debut_urls_libres%]][[%url_max_libres%]]</radio_type_urls3>



<radio_type_urls3 valeur="arbo">@puce@ {{URLs &laquo;arborescentes&raquo;}}: URLs are built in a tree structure.

_ Example: <code>/sector/section1/section2/My-article-title</code>

[[%url_arbo_minuscules%]][[%urls_arbo_sans_type%]][[%url_arbo_sep_id%]][[%terminaison_urls_arbo%]][[%url_max_arbo%]]</radio_type_urls3>



<radio_type_urls3 valeur="propres-qs">@puce@ {{URLs "propres-qs"}}:  this system functions using a "Query-String", in other words, without using the .htaccess file. URLs are similar in form to {&laquo;propres&raquo;}.

_ Example: <code>/?My-article-title</code>

[[%terminaison_urls_propres_qs%]][[%url_max_propres_qs%]]</radio_type_urls3>



<radio_type_urls3 valeur="standard">@puce@ {{URLs "standard"}}: these now discarded URLs were used by SPIP up to version 1.8.

_ Example: <code>article.php3?id_article=123</code>
</radio_type_urls3>



@puce@ If you are using the type  {page} described above or if the object requested is not recognised, you can choose the {{calling script}} for SPIP. By default, SPIP uses {spip.php}, but {index.php} (format: <code>/index.php?article123</code>) or an empty value (format: <code>/?article123</code>) are also possible. To use any other value, you need to create the corresponding file at the root of your site with the same contents as in the file {index.php}.

[[%spip_script%]]', # MODIF
	'type_urls:description1' => '@puce@ If you are using a format based on "propres" URLs ({propres}, {propres2}, {libres}, {arborescentes} ou {propres_qs}), the Swiss Knife can:

<q1>• make sure the URL is in {{lower case}}.</q1>[[%urls_minuscules%]]

<q1>• systematically add the {{ID of the object}} to the URL (as a suffix, prefix, etc.).

_ (examples: <code>/My-article-title,457</code> or <code>/457-My-article-title</code>)</q1>', # MODIF
	'type_urls:nom' => 'Format of URLs',
	'typo_exposants:description' => '{{Text in French}}: improves the typographical rendering of common abbreviations by adding superscript where necessary (thus, {<acronym>Mme</acronym>} becomes {M<sup>me</sup>}). Common errors corrected: ({<acronym>2&egrave;me</acronym>} and {<acronym>2me</acronym>}, for example, become {2<sup>e</sup>}, the only correct abbreviation).



The rendered abbreviations correspond to those of the Imprimerie nationale given in the {Lexique des r&egrave;gles typographiques en usage &agrave; l\'Imprimerie nationale} (article &laquo;&nbsp;Abr&eacute;viations&nbsp;&raquo;, Presses de l\'Imprimerie nationale, Paris, 2002).



The following expressions are also handled: <html>Dr, Pr, Mgr, St, Bx, m2, m3, Mn, Md, St&eacute;, &Eacute;ts, Vve, bd, Cie, 1o, 2o, etc.</html>



You can also choose here to use superscript for some other abbreviations, despite the negative opinion of the Imprimerie nationale:[[%expo_bofbof%]]



{{English text}}: the suffixes of ordinal numbers are placed in superscript: <html>1st, 2nd</html>, etc.', # MODIF
	'typo_exposants:nom' => 'Superscript',

	// U
	'url_arbo' => 'arborescentes@_CS_ASTER@',
	'url_html' => 'html@_CS_ASTER@',
	'url_libres' => 'libres@_CS_ASTER@',
	'url_page' => 'page',
	'url_propres' => 'propres@_CS_ASTER@',
	'url_propres-qs' => 'propres-qs',
	'url_propres2' => 'propres2@_CS_ASTER@',
	'url_propres_qs' => 'propres_qs',
	'url_standard' => 'standard',
	'urls_3_chiffres' => 'Require a minum of 3 digits',
	'urls_avec_id' => 'Place as a suffix',
	'urls_avec_id2' => 'Place as a prefix',
	'urls_base_total' => 'There are currently @nb@ URL(s) in the database',
	'urls_base_vide' => 'The URL database is empty',
	'urls_choix_objet' => 'Edit the URL of a specific object in the database:',
	'urls_edit_erreur' => 'The current URL format ("@type@") does not permit editing.',
	'urls_enregistrer' => 'Write this URL to the database',
	'urls_id_sauf_rubriques' => 'Exclude the following objects (separated by "&nbsp;:&nbsp;"):',
	'urls_minuscules' => 'Lower-case letters',
	'urls_nouvelle' => 'Edit the "clean" URL',
	'urls_num_objet' => 'Number:',
	'urls_purger' => 'Empty all',
	'urls_purger_tables' => 'empty tables selected',
	'urls_purger_tout' => 'Reset the URLs stored in the database:',
	'urls_rechercher' => 'Find this object in the database',
	'urls_titre_objet' => 'Saved title:',
	'urls_type_objet' => '<MODF>Order:',
	'urls_url_calculee' => 'URL PUBLIC  &laquo;&nbsp;@type@&nbsp;&raquo;:',
	'urls_url_objet' => 'Saved "clean" URL:',
	'urls_valeur_vide' => '(An empty value triggers the recalculation of the URL)',

	// V
	'validez_page' => 'To access modifications:',
	'variable_vide' => '(Empty)',
	'vars_modifiees' => 'The data has been modified',
	'version_a_jour' => 'Your version is up to date.',
	'version_distante' => 'Distant version...',
	'version_distante_off' => 'REmote checking deactivated',
	'version_nouvelle' => 'New version: @version@',
	'version_revision' => 'version: @revision@',
	'version_update' => 'Automatic update',
	'version_update_chargeur' => 'Automatic download',
	'version_update_chargeur_title' => 'Download the latest version of the plugin using the plugin &laquo;Downloader&raquo;',
	'version_update_title' => 'Downloads the latest version of the plugin and updates it automatically.',
	'verstexte:description' => '2 filters for your templates which make it possible to produce lighter pages.

_ version_texte: extracts the text content of an HTML page, excluding some basic tags.

_ version_plein_texte: extracts the full text content from an HTML page.', # MODIF
	'verstexte:nom' => 'Text version',
	'visiteurs_connectes:description' => 'Creates an HTML fragment for your templates which displays on the public site the number of visitors currently logged in.



Simply add <code><INCLURE{fond=fonds/visiteurs_connectes}></code> in the template.', # MODIF
	'visiteurs_connectes:nom' => 'Vistors logged in',
	'voir' => 'See: @voir@',
	'votre_choix' => 'Your choice:',

	// W
	'webmestres:description' => 'For SPIP, the term {{webmaster}} refers to an {{administrator}} who has FTP access to the site. By default, from SPIP 2.0 on, this is assumed to be the administrator whose <code>id_auteur=1</code>. Webmasters defined here have the privilege of no longer needing to use FTP to validate important actions on the site, such as upgrading the database format or restoring a backup.



Current webmasters: {@_CS_LISTE_WEBMESTRES@}.

_ Eligible administrators: {@_CS_LISTE_ADMINS@}.



As a webmaster yourself, you can change this list of IDs. Use a colon as a separator if there are more than one. e.g. "1:5:6".[[%webmestres%]]', # MODIF
	'webmestres:nom' => 'list of webmasters',

	// X
	'xml:description' => 'Activates the XML validator for the public site, as described in the [documentation->http://www.spip.net/en_article3582.html]. An &laquo;&nbsp;Analyse XML&nbsp;&raquo; button is added to the other admin buttons.',
	'xml:nom' => 'XML validator'
);

?>
