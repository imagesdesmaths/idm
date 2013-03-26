<?php
// This is a SPIP language file  --  Ceci est un fichier langue de SPIP
// extrait automatiquement de http://trad.spip.net/tradlang_module/couteauprive?lang_cible=en
// ** ne pas modifier le fichier **

if (!defined('_ECRIRE_INC_VERSION')) return;

$GLOBALS[$GLOBALS['idx_lang']] = array(

	// 2
	'2pts_non' => ': no',
	'2pts_oui' => ': yes',

	// S
	'SPIP_liens:description' => '@puce@ All links on the site open in the current window by default. It may be useful to open external links in a new window, i.e. by adding {target=&quot;_blank&quot;} to all &lt;a&gt; link tags in one of the SPIP classes {spip_out}, {spip_url} or {spip_glossaire}. It is sometimes necessary to add one of these classes to the links in the site\'s templates (html files) in order make this functionality wholly effective.[[%radio_target_blank3%]]

@puce@ SPIP provides the shortcut <code>[?word]</code> to link words to their definitions. By default (or if you leave the checkbox below empty), wikipedia.org is used as the external glossary. You may choose another address if you wish. <br />Test link: [?SPIP][[%url_glossaire_externe2%]]',
	'SPIP_liens:description1' => '@puce@ SPIP includes a CSS style for "mailto:" email links: a little envelope should appear just before each "mailto" link. However, not all browsers are able to display it (specifically IE6, IE7 and SAF3, in particular, cannot). It is up to you to decide whether to retain this image insertion feature.
_ Test link:[->test@example.com] (Reload the whole page to test.)[[%enveloppe_mails%]]',
	'SPIP_liens:nom' => 'SPIP and external links',
	'SPIP_tailles:description' => '@puce@ In order to lighten the memory load on your server, SPIP allows you to restrict the dimensions (height and width) and the file sizes of the images, logos or documents that are attached to the various content elements of your site. If a given file exceeds the specified size, the form will still return the data in question but they will be destroyed and SPIP will not retain them for reuse, neither in the IMG/ directory nor in the database. A warning message will then be sent to the user.

A null or blank value indicates an unlimited value.
[[Height: %img_Hmax% pixels]][[->Width: %img_Wmax% pixels]][[->File size: %img_Smax% KB]]
[[Height: %logo_Hmax% pixels]][[->Width: %logo_Wmax% pixels]][[->File size: %logo_Smax% KB]]
[[File size: %doc_Smax% KB]]

@puce@ Enter here the maximum space reserved for remote files that SPIP will be able to download (from server to server) and store on your site. The default value here is 16 MB.[[%copie_Smax% MB]]

@puce@ In order to avoid PHP memory overloads in processing large images with the GD2 library, SPIP tests the server capacities and can then refuse to process images that are too large. It is possible to deactivate this test by manually defining the maximum number of pixels supported for the calculation processes.

The value of 1,000,000 pixels appears to be reasonable for a configuration with little available memory. A null or blank value will mean that the testing will occur on the server.
[[%img_GDmax% maximum pixels]]

@puce@ The GD2 library is used to modify the compression quality of any JPG images. A higher percentage corresponds to better quality.
[[%img_GDqual% %]]',
	'SPIP_tailles:nom' => 'Memory limits',

	// A
	'acces_admin' => 'Administrators\' access:',
	'action_rapide' => 'Rapid action, only if you know what you are doing!',
	'action_rapide_non' => 'Rapid action, available when this tool is activated:',
	'admins_seuls' => 'Only administrators',
	'aff_tout:description' => 'It may be useful to view all sections or all authors on your site regardless of their status (during development, for example). By default, SPIP does display in public area the authors and sections with at least one published element.

Although it is possible to override this behavior using the criterion [<html>{tout}</html>->http://www.spip.net/fr_article4250.html], this tool automates the process and avoid to add this criterion to all loops SECTIONS and/or your AUTHORS skeletons.',
	'aff_tout:nom' => 'Display all',
	'alerte_urgence:description' => 'Displayed at the top of all public pages headband alert to broadcast the emergency message defined below.
_The <code><multi/></code> tag are recommended in case of multilingual website. [[%alerte_message%]]',
	'alerte_urgence:nom' => 'Alert message',
	'attente' => 'Waiting...',
	'auteur_forum:description' => 'Request all authors of public messages to fill in (with at least one letter!) a name and/or email in order to avoid completely anonymous messages. Note that the tool performs a JavaScript validation with the user\'s browser.[[%auteur_forum_nom%]][[->%auteur_forum_email%]][[->%auteur_forum_deux%]]
{Caution: The third option cancels the 2 others. It is important to verify that the forms in your SPIP templates are compatible with this tool.}',
	'auteur_forum:nom' => 'No anonymous forums',
	'auteur_forum_deux' => 'Or a least one of the two previous fields',
	'auteur_forum_email' => 'The field «@_CS_FORUM_EMAIL@»',
	'auteur_forum_nom' => 'The field «@_CS_FORUM_NOM@»',
	'auteurs:description' => 'This tool configures the appearance of [the authors page->./?exec=auteurs], in the private area.

@puce@ Define here the maximum number of authors to display in the central frame of the authors page. Beyond this number, page numbering will be triggered.[[%max_auteurs_page%]]

@puce@ Which kinds of authors should be listed on these pages?
[[%auteurs_tout_voir%[[->%auteurs_0%]][[->%auteurs_1%]][[->%auteurs_5%]][[->%auteurs_6%]][[->%auteurs_n%]]]]',
	'auteurs:nom' => 'Authors page',
	'autobr:description' => 'Applies the {|post_autobr} filter to certain types of SPIP content, replacing single line feeds with an HTML line break  &lt;br />.',
	'autobr:description1' => 'Breaking with a tradition history, SPIP 3 now takes into account indentation (simple line break) in its contents. Here you can disable this behavior and revert to the old system where the simple line break is not recognized - like in HTML.',
	'autobr:description2' => 'Objects containing this tag (not exhaustive)
- Articles : @ARTICLES@.
- Sections : @RUBRIQUES@.
- Forums : @FORUMS@.',
	'autobr:nom' => 'Automatic line breaks',
	'autobr_non' => 'All site text between &lt;alinea>&lt;/alinea> tags',
	'autobr_oui' => 'All article text and public messages  (the #TEXTE tag)',
	'autobr_racc' => 'Line breaks: <b>&lt;alinea>&lt;/alinea></b>',

	// B
	'balise_set:description' => 'In order to reduce the complexity of code segments like <code>#SET{x,#GET{x}|a_filter}</code>, this tool offers you the following short-cut: <code>#SET_UN_FILTRE{x}</code>. The filter applied to a variable is therefore passed in the name of the tag.

Examples: <code>#SET{x,1}#SET_PLUS{x,2}</code> or <code>#SET{x,avions}#SET_REPLACE{x,ons,ez}</code>.',
	'balise_set:nom' => 'Extended #SET tag',
	'barres_typo_edition' => 'Editing contents',
	'barres_typo_forum' => 'Forum messages',
	'barres_typo_intro' => 'The «Porte-Plume» plugin is installed. Please choose here the typographical bars on which to insert various buttons.',
	'basique' => 'Basic',
	'blocs:aide' => 'Collapsible blocks: <b><bloc></bloc></b> (alias: <b><invisible></invisible></b>) and <b><visible></visible></b>',
	'blocs:description' => 'Allows you to create blocks which show/hide themselves when you click on their titles.

@puce@ {{In SPIP texts}}: authors can use the new <bloc> (or <invisible>) and <visible> tags in their texts as below: 

<quote><code>
<bloc>
 A clickable title

 The text to be shown/hidden, after two empty lines.
 </bloc>
</code></quote>

@puce@ {{In templates}}: you can use the new #BLOC_TITRE, #BLOC_DEBUT and #BLOC_FIN tags like this: 

<quote><code> #BLOC_TITRE or #BLOC_TITRE(my_URL)
 My title
 #BLOC_RESUME    (optional)
 a summary version of the following block
 #BLOC_DEBUT
 My collapsible block (which will contain the indicated URL, if needed)
 #BLOC_FIN</code></quote>

@puce@ If you tick "yes" below, opening one block will cause all other blocks on the page to close. i.e. only one block is open at a time.[[%bloc_unique%]]

@puce@ If you tick "yes" below, the state of the numbered blocks will be kept in a session cookie, in order to maintain the page\'s appearance as long as the session lasts.[[%blocs_cookie%]]

@puce@ By default, the Swiss Army Knife plugin uses the HTML tag <h4> for the titles of the collapsible blocks. You can specify another tag to use instead here <hN>:[[%bloc_h4%]]

@puce@ In order to obtain a smoother transition when you click on the title, your collapsible blocks can be animated with a "sliding" effect".[[%blocs_slide%]][[->%blocs_millisec% milliseconds]]',
	'blocs:nom' => 'Folding Blocks',
	'boites_privees:description' => 'All of the boxes described below appear either here in the private zone.[[%cs_rss%]][[->%format_spip%]][[->%stat_auteurs%]][[->%qui_webmasters%]][[->%bp_urls_propres%]][[->%bp_tri_auteurs%]]
- {{Updates to the Swiss Army Knife tool}}: a frame on this current configuration page indicating the most recent modifications made to the code of the ([Source->@_CS_RSS_SOURCE@]) plugin.
- {{Articles in SPIP format}}: a collapsible frame for your articles allowing you to see the source code used by their authors.
- {{Author updates}}: a collapsible frame on the [authors page->./?exec=auteurs] indicating the 10 most recently connected authors and any unconfirmed content they have written. Only site administrators can see these details.
- {{The SPIP webmasters}}: a collapsible frame on the [author\'s page->./?exec=auteurs] listing the administrators that have been granted SPIP webmaster status. Only administrators can see these details. If you are one of the webmasters yourself, you can also see the " [.->webmestres] " tool.
- {{Tidy URLs}}: a collapsible frame for each content object (article, section, auteur, ...) indicating the tidy URL associated we well as any possible aliases that may exist. The " [.->type_urls] " tool offers you fine-grained configuration of your site\'s URLs.
- {{Sorted authors}}: a collapsible frame for articles that have more than one author and providing a simple mechanism to adjust their sort order of listing.',
	'boites_privees:nom' => 'Private boxes',
	'bp_tri_auteurs' => 'Order of authors',
	'bp_urls_propres' => 'See clean URLs',
	'brouteur:description' => '@puce@ {{(Browser) section selector}}. Use the AJAX section selector when there are %rubrique_brouteur% section(s) or more.

@puce@ {{Keywords selector}}. Use a search field instead of a dropdown list starting from %select_mots_clefs% keyword(s).

@puce@ {{Authors selection}}. The addition of an author is made with a mini-navigator in the following panel:
<q1>• A dropdown selection box for less than %select_min_auteurs% author(s).
_ • A search field starting from %select_max_auteurs% author(s).</q1>',
	'brouteur:nom' => 'Configuration of the section selector',

	// C
	'cache_controle' => 'Cache control',
	'cache_nornal' => 'Normal usage',
	'cache_permanent' => 'Permanent cache',
	'cache_sans' => 'No cache',
	'categ:admin' => '1. Administration',
	'categ:devel' => '55. Development',
	'categ:divers' => '60. Miscellaneous',
	'categ:interface' => '10. Private interface',
	'categ:public' => '40. Public site',
	'categ:securite' => '5. Security',
	'categ:spip' => '50. Tags, filters, criteria',
	'categ:typo-corr' => '20. Text improvements',
	'categ:typo-racc' => '30. Typographical shortcuts',
	'certaines_couleurs' => 'Only the tags defined below @_CS_ASTER@:',
	'chatons:aide' => 'Smileys: @liste@',
	'chatons:description' => 'Insert images (or IRC engine for {chats}) in all texts where appears like a string such as
«{{<code>:name</code>}}».
_ This tool will replace these shortcuts with the images of the same name found in the <code>mon_squelette_toto/img/chatons/</code> directory, or else, by default, those found in <code>@_DIR_CS_ROOT@img/chatons/</code>.',
	'chatons:nom' => 'Smileys',
	'citations_bb:description' => 'In order to respect the HTML usage in the SPIP content of your site (articles, sections, etc.), this tool replaces the markup &lt;quote&gt; by the markup  &lt;q&gt; when there are no line returns. In fact, quotations must be surrounded by &lt;q&gt; tags and the quotations containing paragraphs must be surrounded by  &lt;blockquote&gt;.',
	'citations_bb:nom' => 'Well delimited citations',
	'class_spip:description1' => 'Here you can define some SPIP shortcuts. An empty value is equivalent to using the default.[[%racc_hr%]]',
	'class_spip:description2' => '@puce@ {{SPIP shortcuts}}.

This is where you can define some SPIP shortcuts. An empty value is equivalent to using the default.[[%racc_hr%]][[%puce%]]',
	'class_spip:description3' => '
{N.B. If the "[.->pucesli]" tool has been activated, then the automatic replacing of "-" hyphens will no longer occur; a regular &lt;ul>&lt;li> list will be used instead.}

SPIP normally uses the &lt;h3> tag for subtitles. Here you can choose a different tag to be used instead: [[%racc_h1%]][[->%racc_h2%]]',
	'class_spip:description4' => 'SPIP normally uses the &lt;strong> tag for marking boldface type. But &lt;b> could also be used, with or without styling. You can choose: [[%racc_g1%]][[->%racc_g2%]]

SPIP normally uses the &lt;i> tag for marking italics. But &lt;em> could also be used, with or without styling. You can choose: [[%racc_i1%]][[->%racc_i2%]]

You can also define the code used to open and close the calls to footnotes (N.B. These changes will only be visible on the public site.): [[%ouvre_ref%]][[->%ferme_ref%]]

You can define the code used to open and close footnotes: [[%ouvre_note%]][[->%ferme_note%]]

@puce@ {{The default SPIP styles}}. Up to version 1.92 of SPIP, typographical shortcuts produced HTML tags all marked with the class "spip". For example, <code><p class="spip"></code>. Here you can define the style of these tags in order to link them to your own stylesheets. An empty box means that no particular style will be applied.

{N.B. If any of the above shortcuts (horizontal line, subtitle, italics, bold) have been modified, then the styles below will not be applied.}

<q1>
_ {{1.}} Tags &lt;p>, &lt;i>, &lt;strong>: [[%style_p%]]
_ {{2.}} Tags &lt;tables>, &lt;hr>, &lt;h3>, &lt;blockquote> and the lists (&lt;ol>, &lt;ul>, etc.):[[%style_h%]]

N.B. by changing the second parameter you will lose any standard SPIP styles associated with those tags.</q1>',
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
	'copie_vers' => 'Copy to: @dir@',
	'corbeille:description' => 'SPIP automatically deletes objets which have been put in the dustbin after one day. This is done by a "Cron" job, usually at 4 am. Here, you can block this process taking place in order to regulate the dustbin emptying yourself. [[%arret_optimisation%]]',
	'corbeille:nom' => 'Wastebin',
	'corbeille_objets' => '@nb@ object(s) in the wastebin.',
	'corbeille_objets_lies' => '@nb_lies@ connection(s) detected.',
	'corbeille_objets_vide' => 'No object in the wastebin',
	'corbeille_objets_vider' => 'Delete the selected objects',
	'corbeille_vider' => 'Empty the wastebin:',
	'couleurs:aide' => 'Text colouring: <b>[coul]text[/coul]</b>@fond@ with <b>coul</b> = @liste@',
	'couleurs:description' => 'Provides short-cuts to add colours to any text on the site (articles, news items, titles, forums, ...) by using bracket tags as short-cuts: <code>[colour]text[/colour]</code>.

Here are two identical examples to change the colour of some text:@_CS_EXEMPLE_COULEURS2@

In the same way, to change the background colour if the following option allows:@_CS_EXEMPLE_COULEURS3@

[[%couleurs_fonds%]]
[[%set_couleurs%]][[-><set_couleurs valeur="1">%couleurs_perso%</set_couleurs>]]
@_CS_ASTER@The format of these personalised tags have to be of existing colours or defined pairs "tag=colour", separated by commas. Examples: "grey, red", "smooth=yellow, strong=red", "low=#99CC11, high=brown" but also "grey=#DDDDCC, red=#EE3300". For the first and last examples, the allowed tags are: <code>[grey]</code> and <code>[red]</code> (<code>[fond grey]</code> and <code>[fond red]</code> if background colours are allowed).',
	'couleurs:nom' => 'Coloured text',
	'couleurs_fonds' => ', <b>[fond coul]text[/coul]</b>, <b>[bg coul]text[/coul]</b>',
	'cs_comportement:description' => '@puce@ {{Logs.}} Record a lot of information about the functions executed by the Swiss Army Knife plugin in the {spip.log} files which can be found in this directory: {<html>@_CS_DIR_LOG@</html>}.
_ Configure logging options using the tool«[.->spip_log]».[[%log_couteau_suisse%]]

@puce@ {{SPIP options.}} SPIP sorts and applies the plugins in a particular order. To be sure that the Swiss Army Knife is at the top and is thereby able to have priority control over certain SPIP options, tick the following checkbox option. If the permissions on your server allow it, the file {<html>@_CS_FILE_OPTIONS@</html>} will be modified to include {<html>@_CS_DIR_TMP@couteau-suisse/mes_spip_options.php</html>}.

[[%spip_options_on%]]@_CS_FILE_OPTIONS_ERR@

@puce@ {{External requests.}} The Swiss Army Knife regularly checks for new versions of itself and shows any available updates on its configuration page.  In addition, this plugin contains certain tools which may be required for importing remote libraries.

If the external requests involved do not work from your server, or you wish to lock down a possible security weakness, check these boxes to turn them off.[[%distant_off%]][[->%distant_outils_off%]]',
	'cs_comportement:nom' => 'Behaviour of the Swiss Army Knife',
	'cs_comportement_ko' => '{{Note:}} This parameter requires a severity filter set over @gr2@ instead of @gr1@ now.',
	'cs_distant_off' => 'Checks of remote versions',
	'cs_distant_outils_off' => 'The Swiss Knife tools which have remote files',
	'cs_log_couteau_suisse' => 'Detailed logs of the Swiss Army Knife',
	'cs_reset' => 'Are you sure you wish to completely reset the Swiss Army Knife?',
	'cs_reset2' => 'All activated tools will be deactivated and their options reset.',
	'cs_spip_options_erreur' => 'Warning: modification of the "<html>@_CS_FILE_OPTIONS@</html>" file has failed!',
	'cs_spip_options_on' => 'SPIP options in "<html@_CS_FILE_OPTIONS@</html"',

	// D
	'decoration:aide' => 'Decoration: <b>&lt;tag&gt;test&lt;/tag&gt;</b>, with<b>tag</b> = @liste@',
	'decoration:description' => 'New, configurable styles in your text using angle brackets and tags. Example: 
&lt;mytag&gt;my text&lt;/mytag&gt; or : &lt;mytag/&gt;.<br />Define below the CSS styles you need. Put each tag on a separate line, using the following syntaxes:
- {type.mytag = my CSS style}
- {type.mytag.class = my CSS class}
- {type.mytag.lang = my language (e.g. en)}
- {unalias = mytag}

The parameter {type} above can be one of three values:
- {span}: inline tag 
- {div}: block element tag
- {auto}: tag chosen automatically by the plugin

[[%decoration_styles%]]',
	'decoration:nom' => 'Decoration',
	'decoupe:aide' => 'Tabbed block: <b>&lt;onglets>&lt;/onglets></b><br/>Page or tab separator: @sep@',
	'decoupe:aide2' => 'Alias: @sep@',
	'decoupe:description' => '@puce@ Divides the display of an article into several pages using automatic page numbering. Simply place four consecutive + characters (<code>++++</code>) in your article wherever you wish a page break to occur.

By default, the Swiss Army Knife plugin inserts the pagination links at the top and bottom of the page. But you can place the links elsewhere in your template by using the #CS_DECOUPE tag, which you can activate here:
[[%balise_decoupe%]]

@puce@ If you use this separator between <onglets> and </onglets> tags, then you will receive a tabbed page instead.

In templates you can use the tags #ONGLETS_DEBUT (start), #ONGLETS_TITRE (title) and #ONGLETS_FIN (end).

This tool may be combined with "[.->sommaire]".',
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
	'detail_spip_options' => '{{Note}}: If this tool malfunctions, give the SPIP options priority by using the "@lien@" utility.',
	'detail_spip_options2' => 'It is recommended to give the SPIP options priority using the «[.->cs_comportement]» utility.',
	'detail_spip_options_ok' => '{{Note}}: This tool currently gives the SPIP options priority using the "@lien@" utility.',
	'detail_surcharge' => 'Tool overloaded:',
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
	'docgen' => 'General documentation',
	'docwiki' => 'Ideas notebook',
	'dossier_squelettes:description' => 'Changes which template directory to use. For example: "squelettes/mytemplate". You can register several directories by separating them with a colon <html>":"</html>. If you leave the following box empty (or type "dist" in it), then the default "dist" template, supplied with SPIP, will be used.[[%dossier_squelettes%]]',
	'dossier_squelettes:nom' => 'Template directory',

	// E
	'ecran_activer' => 'Enable the security screen',
	'ecran_conflit' => 'Warning: the "@file@" static file may cause a conflict.
Please choose your protection method !',
	'ecran_conflit2' => 'Note: a static file named "@file@" has been detected and activated. It is possible that the Swiss Army Knife could not update it or configure it.',
	'ecran_ko' => 'Inactive screen!',
	'ecran_maj_ko' => 'Version {{@n@}} of the security screen is available. Please update the remote file for this utility.',
	'ecran_maj_ko2' => 'Version @n@ of the safetu screen is available. You can update the remote file " [.->ecran_securite] ".',
	'ecran_maj_ok' => '(appears to be up to date).',
	'ecran_securite:description' => 'The security screen is a PHP file directly downloaded from the official SPIP site which protects your sites by blocking certain attacks aimed at specific security flaws. This system allows you to react very quickly whenever a problem is discovered, by covering up for such flaws without needing to immediately update your site nor apply any complex patches.

Important note: the screen locks down certain variables. For example, the variables named as <code>id_xxx</code> are all checked as being whole integer numbers in order to avoid SQL code injections via this very common URL variable. Certain plugins are not compatible with all of the rules imposed by this screen, including those that might use a syntax like  <code>&id_x=new</code> to create a new object {x}.

In addition to the security, this screen has a configurable ability to restrict access by indexing robots to the PHP scripts, in such a way as to indicate that they should " come back later " whenever the server is currently saturated.[[ %ecran_actif%]][[->
@puce@ Adjust the anti-robot protection when the server load exceeds the value: %ecran_load%
_ {The default value is 4. Assign a value of 0 to deactivate this process.}@_ECRAN_CONFLIT@]]

When making an official update, update the associated remote file (click above on [update]) to take advantage of the most recent protective measures.

- Local file version: ',
	'ecran_securite:nom' => 'Security screen',
	'effaces' => 'Deleted',
	'en_travaux:description' => 'Makes it possible to display a customised message on the public site and also in the private editing area during maintenance work.',
	'en_travaux:nom' => 'Site in maintenance mode',
	'erreur:bt' => '<span style="color:red;">Warning:</span> the typographical toolbar (version @version@) appears to be an old version.<br />The Swiss Army Knife is compatible only with version @mini@ or newer.',
	'erreur:description' => 'missing id in the tool\'s definition!',
	'erreur:distant' => 'The distant server',
	'erreur:jquery' => '{{N.B.}} : {jQuery} does not appear to be active for this page. Please consult the paragraph about the plugin\'s required libraries [in this article->http://www.spip-contrib.net/?article2166] or reload this page.',
	'erreur:js' => 'A Javascript error appears to have occurred on this page, hindering its action. Please activate Javascript in your browser, or try deactivating some SPIP plugins which may be causing interference.',
	'erreur:nojs' => 'Javascript has been deactivated on this page.',
	'erreur:nom' => 'Error!',
	'erreur:probleme' => 'Problem with: @pb@',
	'erreur:traitements' => 'The The Swiss Army Knife - Compilation error: forbidden mixing of \'typo\' and \'propre\'!',
	'erreur:version' => 'This tool is unavailable in this version of SPIP.',
	'erreur_groupe' => 'Warning: the "@groupe@" group has not been defined!',
	'erreur_mot' => 'Warning: the "@mot@" keyword has not been defined!',
	'etendu' => 'Expanded',

	// F
	'f_jQuery:description' => 'Prevents the installation of {jQuery} on the public site in order to economise some "machine resources". The jQuery library ([->http://jquery.com/]) is useful in JavaScript programming and many plugins use it. SPIP uses it in the editing interface.

N.B. some Swiss Knife tools require {jQuery} to be installed. ',
	'f_jQuery:nom' => 'Deactivate jQuery',
	'filets_sep:aide' => 'Dividing lines: <b>__i__</b> or <b>i</b> is a number between <b>0</b> and <b>@max@</b>.<br />Other available lines: @liste@',
	'filets_sep:description' => 'Inserts separating lines for any SPIP texts which can be customised with a stylesheet.
_ The syntax is: «__code__», where "code" is either the identifying number (from 0 to 7) of the line to insert and which is linked to the corresponding style, or the name of an image in the <code>dossier_de_mon_squelette/img/filets/</code> directory or by default, in the directory <code>@_DIR_CS_ROOT@img/filets/</code>.',
	'filets_sep:nom' => 'Dividing lines',
	'filtrer_javascript:description' => 'Three modes are available for controlling JavaScript inserted directly in the text of articles:
- <i>never</i>: JavaScript is prohibited everywhere
- <i>default</i>: the presence of JavaScript is highlighted in red in the editing interface
- <i>always</i>: JavaScript is always accepted.

N.B. in forums, petitions, RSS feeds, etc., JavaScript is <b>always</b> made secure.[[%radio_filtrer_javascript3%]]',
	'filtrer_javascript:nom' => 'JavaScript management',
	'flock:description' => 'Deactivates the file-locking system which uses the PHP {flock()} function. Some web-hoting environments are unable to work with this function. Do not activate this tool if your site is functioning normally.',
	'flock:nom' => 'Files are not locked',
	'fonds' => 'Backgrounds:',
	'forcer_langue:description' => 'Forces the language context for multilingual templates which have a form or language menu able to manage the language cookie.

Technically, this tool does this:
- deactivates the search for a template matching the object\'s language.
- deactivates the automatic <code>{lang_select}</code> criterion on SPIP objects (articles, news items, sections, etc.).

This means that multi blocks will always displayed in the language requested by the visitor.',
	'forcer_langue:nom' => 'Force language',
	'format_spip' => 'Articles in SPIP format',
	'forum_lgrmaxi:description' => 'By default forum messages are not limited in size. If this tool is activated, an error message is shown each time someone tries to post a message larger than the size given, and the message is refused. An empty value (or 0) means that no limit will be imposed.[[%forum_lgrmaxi%]]',
	'forum_lgrmaxi:nom' => 'Size of forums',

	// G
	'glossaire:aide' => 'A text with no glossary: <b>@_CS_SANS_GLOSSAIRE@</b>',
	'glossaire:description' => '@puce@ Use one or several groups of keywords to manage an internal glossary. Enter the names of the keyword groups here, separating them by « : ». If you leave the box empty (or enter &quot;Glossaire&quot;), it is the &quot;Glossaire&quot; group which will be used.[[%glossaire_groupes%]]

@puce@ You can indicate the maximum number of links to create in a text for each word. A null or negative value will mean that all instances of the words will be processed. [[%glossaire_limite% per keyword]]

@puce@ There is a choice of two options for generating the small window which appears for the mouseover or hover event. [[%glossaire_js%]][[->%glossaire_abbr%]]',
	'glossaire:nom' => 'Internal glossary',
	'glossaire_abbr' => 'Ignore tags <code><abbr></code> and <code><acronym></code>',
	'glossaire_css' => 'CSS solution',
	'glossaire_erreur' => 'The "@mot1@" keyword makes the "@mot2@" undetectable',
	'glossaire_inverser' => 'Correction proposed: reverse the order of the keywords in the database.',
	'glossaire_js' => 'JavaScript solution',
	'glossaire_ok' => 'The list of @nb@ keyword(s) checked in the database appears to be correct.',
	'guillemets:description' => 'Automatically replaces straight inverted commas (") by curly ones, using the correct ones for the current language. The replacement does not change the text stored in the database, but only the display on the screen.',
	'guillemets:nom' => 'Curly inverted commas',

	// H
	'help' => '{{This page is only accessible to main site administrators.}} It gives access to the configuration of some additional functions of the {{Swiss Army Knife}}.',
	'help2' => 'Local version: @version@',
	'help3' => '<p>Documentation links:@contribs@</p><p>Resets:
_ • [Hidden tools|Return to the original appearance of this page->@hide@]
_ • [Whole plugin|Reset to the original state of the plugin->@reset@]@install@
</p>',
	'horloge:description' => 'Tool currently under development. It offers a JavaScript clock. Tag: <code>#HORLOGE</code>. Model: <code><horloge></code>

Available arguments: {zone}, {format} and/or {id}.',
	'horloge:nom' => 'Clock',

	// I
	'icone_visiter:description' => 'Replaces the standard "<:icone_visiter_site:>" button (top right on this page) with the site logo, if there is one.

To define this logo, go to the "<:titre_configuration:>" page by clicking on the "<:icone_configuration_site:>" button.', # MODIF
	'icone_visiter:nom' => '"<:icone_visiter_site:>" button',
	'insert_head:description' => 'Activate the tag [#INSERT_HEAD->http://www.spip.net/en_article2421.html] in all templates, whether or not this tag is present between &lt;head&gt; et &lt;/head&gt;. This option can be used to allow plugins to insert javascript code (.js) or stylesheets (.css).',
	'insert_head:nom' => '#INSERT_HEAD tag',
	'insertions:description' => 'N.B.: tool in development!! [[%insertions%]]',
	'insertions:nom' => 'Auto-correct',
	'introduction:description' => 'This tag can be used in the skeletons to generate news or in the sections to provide summaries of articles, for news , etc...

{{Beware}}: If you have another plugin defining the function {balise_INTRODUCTION()} or if you have defined it in your templates, you will get a compilation error.

@puce@ You can specify (as a percentage of the default value) the length of the text generated by the tag #INTRODUCTION. A null value, or a value equal to 100 will not modify anything and uses the following default values: 500 characters for the articles, 300 for the news items and 600 for forums or sections.[[%lgr_introduction% %]]

@puce@ By default, if the text is too long, #INTRODUCTION will end with 3 dots (an ellipsis): <html>" (…)"</html>. You can change this to a customised string which indicates that there is more text available.[[%suite_introduction%]]

@puce@ If the #INTRODUCTION tag is used to give a summary of an article, the Swiss Army Knife can generate a link to the article for the 3 dots or string  that indicates that there is more text available. For example: "Read more…"[[%lien_introduction%]]',
	'introduction:nom' => '#INTRODUCTION tag',

	// J
	'jcorner:description' => '"Pretty Corners" is a tool which makes it easy to change the appearance of the corners of {{coloured boxes}} on the public pages of your site. Almost anything is possible!
_ See this page for examples: [->http://www.malsup.com/jquery/corner/].

Make a list below of the elements in your templates which are to be rounded by using the CSS syntax (.class, #id, etc. ). Use the sign " = " to specify the jQuery command to apply, and a double slash (" // ") for any comments. If no equals sign is provided, rounded corners equivalent to <code>.my_class = .corner()</code> will be applied.[[%jcorner_classes%]]

N.B. This tool requires the {Round Corners} jQuery plugin in order to function. If the remote file is properly installed,  the Swiss Army Knife plugin can activate it automatically if you check this box. [[%jcorner_plugin%]]',
	'jcorner:nom' => 'Pretty Corners',
	'jcorner_plugin' => '" Round Corners plugin "',
	'jq_localScroll' => 'jQuery.LocalScroll ([demo->http://demos.flesler.com/jquery/localScroll/])',
	'jq_scrollTo' => 'jQuery.ScrollTo ([demo->http://demos.flesler.com/jquery/scrollTo/])',
	'js_defaut' => 'Default',
	'js_jamais' => 'Never',
	'js_toujours' => 'Always',
	'jslide_aucun' => 'No animation',
	'jslide_fast' => 'Slide fast',
	'jslide_lent' => 'Slide slow',
	'jslide_millisec' => 'Slide speed :',
	'jslide_normal' => 'Slide normally',

	// L
	'label:admin_travaux' => 'Close the public site for:',
	'label:alinea' => 'Scope of application:',
	'label:alinea2' => 'Except :',
	'label:alinea3' => 'Disable the inclusion of indentations :',
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
	'label:enveloppe_mails' => 'Small envelope before email addresses:',
	'label:expo_bofbof' => 'Place in superscript: <html>St(e)(s), Bx, Bd(s) et Fb(s)</html>',
	'label:filtre_gravite' => 'Maximum severity accepted :',
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
	'label:long_url' => 'Length of clickable description:',
	'label:marqueurs_urls_propres' => 'Add markers to distinguish between objects (SPIP>=2.0:<br />(e.g. " - " pour -My-section-, " @ " for @My-site@) ',
	'label:max_auteurs_page' => 'Authors per page:',
	'label:message_travaux' => 'Your maintenance message:',
	'label:moderation_admin' => 'Automatically validate messages from:',
	'label:mot_masquer' => 'Keyword hiding the contents:',
	'label:nombre_de_logs' => 'File rotation :',
	'label:ouvre_note' => 'Opening and closing markers of footnotes',
	'label:ouvre_ref' => 'Opening and closing markers of footnote links',
	'label:paragrapher' => 'Always insert paragraphs:',
	'label:prive_travaux' => 'Access to the editing area for:',
	'label:prof_sommaire' => 'Depth maintained (1 to 4):',
	'label:puce' => 'Public bullet «<html>-</html>»:',
	'label:quota_cache' => 'Quota value',
	'label:racc_g1' => 'Beginning and end of "<html>{{bolded text}}</html>":',
	'label:racc_h1' => 'Beginning and end of a «<html>{{{subtitle}}}</html>»:',
	'label:racc_hr' => 'Horizontal line (<html>----</html>) :',
	'label:racc_i1' => 'Beginning and end of «<html>{italics}</html>»:',
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
	'label:tout_rub' => 'Publicly display all folowing objects:',
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

In French texts, SPIP follows the rules of French typography and inserts a space before question and exclamation marks, and uses French-style quotation marks when appropriate. This tool prevents this from happening in URLs where such replacements are inappropriate.[[%liens_interrogation%]]

@puce@ {{Orphan links}}.

Systematically replaces all URLs which authors have placed in texts (especially often in forums), and which are thus not clickable, by links in the normal SPIP format. For example, {<html>www.spip.net</html>} will be replaced by: [->www.spip.net].

You can choose the type of replacements used:
_ • {Basic}: links such as {<html>http://spip.net</html>} (whatever protocol) and {<html>www.spip.net</html>} are replaced.
_ • {Extended}: additionally links such as these are also replaced:  {<html>me@spip.net</html>}, {<html>mailto:myaddress</html>} or {<html>news:mynews</html>}.
_ • {By default}: automatic replacement (from SPIP version 2.0).
[[%liens_orphelins%]]',
	'liens_orphelins:description1' => '[[If the URL is more than %long_url% characters long, SPIP will reduce it to %coupe_url% characters]].',
	'liens_orphelins:nom' => 'Fine URLs',
	'local_ko' => 'The automatic update of local file «@file@» failed. If the tool malfunctions, try a manual update.',
	'log_brut' => 'Data written in raw format (no HTML)',
	'log_fileline' => 'Extra debug information',

	// M
	'mailcrypt:description' => 'Hides all the email links in your textes and replaces them with a Javascript link which activates the visitor\'s email programme when the link is clicked. This antispam tool attempts to prevent web robots from collecting email addresses which have been placed in forums or in the text displayed by the tags in your templates.',
	'mailcrypt:nom' => 'MailCrypt',
	'mailcrypt_balise_email' => 'Also consider the #EMAIL tag of your skeletons',
	'mailcrypt_fonds' => 'Do not protect the following backgrounds :<br /><q4>{Separate them by two points «~:~» and make sure that these backgrounds remain inaccessible to web robots.}</q4>',
	'maj_actualise_ok' => 'The plugin « @plugin@ » has not officially changed its version, but the files have been updated to take advantage of the latest revision of code.',
	'maj_auto:description' => 'This tool is used to help you easily manage the updates of your various plugins, specifically by retrieving the version number located in your various local <code>svn.revision</code> files and comparing them with those found on the <code>zone.spip.org</code> site.

The list above offers the possibility of running SPIP\'s automatic update process for each of the plugins already installed in the  <code>plugins/auto/</code> directory. The other plugins located in the  <code>plugins/</code> directory are simply listed for information purposes. If the remote version can not be located, then try to proceed with updating the plugin manually.

Note: since the <code>.zip</code> files are not always instantly reconstructed, you might have to wait a while before you can carry out the total update of a very recently modified plugin.',
	'maj_auto:nom' => 'Automatic updates',
	'maj_fichier_ko' => 'The file « @file@ » can not be found!',
	'maj_librairies_ko' => 'Libraries not found!',
	'masquer:description' => 'This tool is used for hiding specific editorial content (sections or articles) tagged with the keyword specified below from the public site, without requiring any other modifications to your templates. If a section is hidden, then so is its entire sub-branch.[[%mot_masquer%]]

To override and force the display of such hidden content, just add the <code>{tout_voir}</code> (view all) criterion to the loops in your template(s).

Published objects but hidden from the editorial content :
-* Rubriques : @_RUB@.
-* Articles : @_ART@.',
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
	'outil_actualiser' => 'Update the tool',
	'outil_cacher' => 'No longer show',
	'outil_desactiver' => 'Deactivate',
	'outil_desactiver_le' => 'Deactivate this tool',
	'outil_inactif' => 'Inactive tool',
	'outil_intro' => 'This page lists the functionalities provided by the plugin.<br /><br />By clicking on the names of the tools below, you choose the ones which you can then switch on/off using the central button: active tools will be disabled and <i>vice versa</i>. When you click, the tools description is shown above the list. The tool categories are collapsible to hide the tools they contain. A double-click allows you to directly switch a tool on/off.<br /><br />For first use, it is recommended to activate tools one by one, thus reavealing any incompatibilites with your templates, with SPIP or with other plugins.<br /><br />N.B.: simply loading this page recompiles all the Swiss Army Knife tools.',
	'outil_intro_old' => 'This is the old interface.<br /><br />If you have difficulties in using <a href=\\\'./?exec=admin_couteau_suisse\\\'>the new interface</a>, please let us know in the forum of <a href=\\\'http://www.spip-contrib.net/?article2166\\\'>Spip-Contrib</a>.',
	'outil_nb' => '@pipe@: @nb@ tool',
	'outil_nbs' => '@pipe@: @nb@ tools',
	'outil_permuter' => 'Switch the tool: « @text@ » ?',
	'outils_actifs' => 'Activated tools:',
	'outils_caches' => 'Hidden tools:',
	'outils_cliquez' => 'Click the names of the tools above to show their description.',
	'outils_concernes' => 'Affected: ',
	'outils_desactives' => 'Deactivated: ',
	'outils_inactifs' => 'Inactive tools:',
	'outils_liste' => 'List of tools of the Swiss Army Knife',
	'outils_non_parametrables' => 'Cannot be configured:',
	'outils_permuter_gras1' => 'Switch the tools in bold type',
	'outils_permuter_gras2' => 'Switch the @nb@ tools in bold type?',
	'outils_resetselection' => 'Reset the selection',
	'outils_selectionactifs' => 'Select all the active tools',
	'outils_selectiontous' => 'ALL',

	// P
	'pack_actuel' => 'Pack @date@',
	'pack_actuel_avert' => 'Warning: the overrides of globals, special authorisations and "define()" functions are not specified here',
	'pack_actuel_titre' => 'UP-TO-DATE CONFIGURATION PACK OF THE SWISS ARMY KNIFE',
	'pack_alt' => 'See the current configuration parameters',
	'pack_delete' => 'Delete a configuration pack',
	'pack_descrip' => 'Your "Current configuration pack" brings together all the parameters activated for the Swiss Army Knife plugin. It remembers both whether a tool is activated or not, and, if it is, what options have been chosen.

If write access privileges permit, this PHP code may be placed in the /config/mes_options.php file. It will place a reset link on the page of the "{@pack@}" pack. Of course, you can change its name below.

If you reset the plugin by clicking on a pack, the Swiss Army Knife plugin will automatically reconfigure itself according to the predefined values in that pack.',
	'pack_du' => 'Of the pack @pack@',
	'pack_installe' => 'Installation of a configuration pack',
	'pack_installer' => 'Are you sure you want to re-initialise the Swiss Army Knife and install the « @pack@ » pack?',
	'pack_nb_plrs' => 'There are @nb@ "configuration packs" currently available.',
	'pack_nb_un' => 'One "configuration pack" is currently available:',
	'pack_nb_zero' => 'No "configuration pack" is currently available.',
	'pack_outils_defaut' => 'Installation of the default tools',
	'pack_sauver' => 'Save the current configuration',
	'pack_sauver_descrip' => 'The button below allows you to insert into your <b>@file@</b> file the parameters needed for an additional "configuration pack" in the lefthand menu. This makes it possible to reconfigure the Swiss Army Knife with a single click to the current state.',
	'pack_supprimer' => 'Are you sure you want to delete the " @pack@ " pack?',
	'pack_titre' => 'Current configuration',
	'pack_variables_defaut' => 'Installation of the default variables',
	'par_defaut' => 'By default',
	'paragrapher2:description' => 'The SPIP function <code>paragrapher()</code> inserts the tags &lt;p&gt; et &lt;/p&gt; around all texts which do not have paragraphs. In order to have a finer control over your styles and layout, you can give a uniform look to your texts throughout the site.[[%paragrapher%]]',
	'paragrapher2:nom' => 'Insert paragraphs',
	'pipelines' => 'Entry points used:',
	'previsualisation:description' => 'By default, SPIP enables previewing an article in its public and CSS-styled version, but only when it has been "proposed for publication". However, this current tool allows authors to also preview articles while they are still being written. Anyone can therefore preview and modify their own editorial content repeatedly until they are content with its appearance.

@puce@ Warning: this functionality does not modify the preview rights. In order for your editors to actually be able to preview their articles "in progress", you still need to authorise this function (in the {[Configuration>Advanced functions->./?exec=config_fonctions]} menu in the private zone).',
	'previsualisation:nom' => 'Previewing articles',
	'puceSPIP' => 'Enable the "*" typographical short-cut',
	'puceSPIP_aide' => 'A SPIP bullet: <b>*</b>',
	'pucesli:description' => 'Replaces "-" (single hyphen) bullets in articles with "-*" ordered lists (transformed into  &lt;ul>&lt;li>…&lt;/li>&lt;/ul> in HTML) the style for which may be customised using CSS statements.

To retain access to SPIP\'s original bullet image (the little triangle), a new "*" short-cut at the start of the line can be offered to your editors:[[%puceSPIP%]]',
	'pucesli:nom' => 'Beautiful bullets',

	// Q
	'qui_webmestres' => 'SPIP webmasters',

	// R
	'raccourcis' => 'Active Swiss Army Knife typographical shortcuts:',
	'raccourcis_barre' => 'The Swiss Army Knife\'s typographical shorcuts',
	'rafraichir' => 'To complete the configuration of the plugin, click here to recalculate the current page.',
	'reserve_admin' => 'Access restricted to administrators',
	'rss_actualiser' => 'Update',
	'rss_attente' => 'Awaiting RSS...',
	'rss_desactiver' => 'Deactivate «Swiss Army Knife updates»',
	'rss_edition' => 'RSS feed updated:',
	'rss_source' => 'RSS source',
	'rss_titre' => 'Development of the «The Swiss Army Knife»:',
	'rss_var' => 'Swiss Army Knife updates',

	// S
	'sauf_admin' => 'Everyone, except administrators',
	'sauf_admin_redac' => 'Everyone, except administrators and editors',
	'sauf_identifies' => 'Everyone, except nominated authors',
	'sessions_anonymes:description' => 'Each week, the tool checks the anonymous sessions and removes files that are too old (more than @_NB_SESSIONS3@ days) in order not to overload the server, especially in case of SPAM on the forum.

File storing sessions: @_DIR_SESSIONS@

Your site currently stores @_NB_SESSIONS1@ session file(s) , @_NB_SESSIONS2@ corresponding to anonymous sessions.',
	'sessions_anonymes:nom' => 'Anonymous sessions',
	'set_options:description' => 'Select the type of private interface (simplified or advanced) for all editors, both existing and future ones. At the same time the button offering the choice between the two interfaces is also removed.[[%radio_set_options4%]]',
	'set_options:nom' => 'Type of private interface',
	'sf_amont' => 'Upstream',
	'sf_tous' => 'All',
	'simpl_interface:description' => 'Deactivates the pop-up menu for changing article status which shows onmouseover on the coloured status bullets. This can be useful if you wish to have an editing interface which is as simple as possible for the users.',
	'simpl_interface:nom' => 'Simplification of the editing interface',
	'smileys:aide' => 'Smileys: @liste@',
	'smileys:description' => 'Inserts smileys into texts containing a short-cut in this form <code>:-)</code>. Ideal for use in forums.
_ A tag is available for displaying a table of smileys in templates: #SMILEYS.
_ Images: [Sylvain Michel->http://www.guaph.net/]',
	'smileys:nom' => 'Smileys',
	'soft_scroller:description' => 'Gives a slow scroll effect when a visitor clicks on a link with an anchor tag. This helps the visitor to know where they are in a particularly long piece of text.

N.B. In order to work, this tool needs to be used in "DOCTYPE XHTML" pages (not HTML!). It also requires two {jQuery} plugins: {ScrollTo} et {LocalScroll}. The Swiss Army Knife can install them itself if you check the following two boxes. [[%scrollTo%]][[->%LocalScroll%]]
@_CS_PLUGIN_JQUERY192@',
	'soft_scroller:nom' => 'Soft anchors',
	'sommaire:description' => 'Builds a table of contents of your articles and sections in order to access the main headings quickly (HTML tags &lt;@h3@>A main title&lt;/@h3@>> or SPIP subtitle short-cuts such as: <code>{{{My subtitle}}}</code>).

For information purposes, the "[.->class_spip]" tool is used to select the &lt;hN> tag used for the SPIP subtitles.

@puce@ You can define the depth retained for the sub-headings used to construct the summary (1 = &lt;@h3@>, 2 = &lt;@h3@> and &lt;@h4@>, etc.) :[[%prof_sommaire%]]

@puce@ You can define here the maximum number of characters of the subtitles :[[%lgr_sommaire% characters]]

@puce@ The table of content anchors can be calculated from the title and not looking like: {tool_summary_NN}. This option also offers the syntax: <code>{{{My title<my_anchor}}}</code> which allows you to specify the anchor to be used.[[%jolies_ancres%]]

@puce@ You can also determine the way in which the plugin builds the summary: 
_ • Systematically, for each article (a tag named <code>@_CS_SANS_SOMMAIRE@</code> placed anywhere within the text of the article will make an exception to the rule).
_ • Only for articles containing the <code>@_CS_AVEC_SOMMAIRE@</code> tag.

[[%auto_sommaire%]]

@puce@ By default, the Swiss Army Knife automatically inserts the summary at the top of the article. But you can place it elsewhere, if you wish, by using the #CS_SOMMAIRE tag, which you can activate here:
[[%balise_sommaire%]]

The summary can be used in conjunction with: "[.->decoupe]" and "[.->titres_typo]".',
	'sommaire:nom' => 'Automatic T.O.C.',
	'sommaire_ancres' => 'Selected anchors: <b><html>{{{My Title&lt;my_anchor>}}}</html></b>',
	'sommaire_avec' => 'An article with summary: <b>@_CS_AVEC_SOMMAIRE@</b>',
	'sommaire_sans' => 'An article without summary: <b>@_CS_SANS_SOMMAIRE@</b>',
	'sommaire_titres' => 'Structured sub-headings: <b><html>{{{*Title}}}</html></b>, <b><html>{{{**Sub-title}}}</html></b>, etc.',
	'spam:description' => 'Attempts to fight against the sending of abusive and automatic messages through forms on the public site. Some words and the &lt;a>&lt;/a> tags are prohibited. Please teach your content editors to use SPIP short-cuts for any links.

@puce@ List here the sequences you wish to prohibit, separating them with spaces. [[%spam_mots%]]
<q1>• Expressions containing spaces should be placed within quotation marks, or use "+" to remplace the space.
_ • To specify a whole word, place it in parentheses. For example:~:~{(asses)}.
_ • To use a regular expression, first check the syntax, then place it between slashes and quotation marks.
_ Example~:~{<html>"/@test.(com|en)/"</html>}.
_ • To use a regular expression that works on HTML characters, place the text between "&#" and ";".
_ Example~:~{<html>"/&#(?:1[4-9][0-9]{3}|[23][0-9]{4});/"</html>}.</q1>

@puce@ Certain IP addresses can also be blocked at their source. But remember that behind these addresses (often variable in nature) there may be a multitude of individual users or even an entire network.[[%spam_ips%]]
<q1>• Use the "*" character to match several unknown characters, "?" for any single character, and brackets for classes of characters.</q1>',
	'spam:nom' => 'Fight against SPAM',
	'spam_ip' => 'IP blocking of @ip@:',
	'spam_test_ko' => 'This message would be blocked by the anti-SPAM filter!',
	'spam_test_ok' => 'This message would be accepted by the anti-SPAM filter!',
	'spam_tester_bd' => 'Also test your database and list the messages which have been blocked by the tool\'s current configuration settings.',
	'spam_tester_label' => 'Test your list of prohibited expressions or IP addresses here, using the following panel:',
	'spip_cache:description' => '@puce@ The cache occupies a certain amount of disk space and SPIP can limit the amount of space that can be consumed. Leaving empty or putting 0 means that no limit will be applied.[[%quota_cache% Mo]]

@puce@ When the site\'s contents are changed, SPIP immediately invalidates the cache without waiting for the next periodic recalculation. If your site experiences performance problems because of the load caused by repeated recalculations, you can choose "no" for this option.[[%derniere_modif_invalide%]]

@puce@ If the #CACHE tag is not found within a given template, then by default SPIP caches a page for 24 hours before recalculating it. You can better regulate the load on your server by modifying this default here.[[%duree_cache% heures]]

@puce@ If you are running several mutualised sites, you can specify here the default value for all the local sites (SPIP 2.0 mini).[[%duree_cache_mutu% hours]]',
	'spip_cache:description1' => '@puce@ By default, SPIP calculates all the public pages and caches them in order to accelerate their display. It can be useful, when developing the site to disable the cache temporarily, in order to see the effect of changes immediately.[[%radio_desactive_cache3%]]',
	'spip_cache:description2' => '@puce@ Four options to configure the cache: <q1>
_ • {Normal usage}: SPIP calculates and locates all the pages for the public site in the cache in order to speed up their delivery. After a certain time, the cache is recalculated and stored again.
_ • {Permanent cache}: the cache is never recalculated (time limits in the templates are ignored).
_ • {No cache}: temporarily deactivating the cache can be useful when the site is being developed. With this option, nothing is cached on disk.
_ • {Cache checking}: similar to the preceding option. However, all results are written to disk so that you can manually check them.</q1>[[%radio_desactive_cache4%]]',
	'spip_cache:description3' => '@puce@ The "Compresser" extension available in SPIP is used to compress the various CSS and JavaScript code sections of your pages and insert them in a static cache file. This speeds up the display of your site, and limits both the number of calls made to the server and the size of the files that need to be retrieved.',
	'spip_cache:nom' => 'SPIP and the cache',
	'spip_ecran:description' => 'Specify the screen width imposed on everyone in the private zone. A narrow screen will display two columns and a wide screen will display three. The default settings leaves the user to make their own choice which will be stored in a browser cookie.[[%spip_ecran%]]',
	'spip_ecran:nom' => 'Screen width',
	'spip_log:description' => '@puce@ Manage various parameters taken into account by SPIP to log events specific to website. PHP function to use <code>spip_log()</code>.@SPIP_OPTIONS@
[[Only keep %nombre_de_logs% file (s), each having %taille_des_logs% Ko maximum size <br/> <q3>{Reset one of these two boxes disables logs input.}</ q3>]]
 [[Other settings :->@puce@ folder where the logs are stored (leave empty by default):<q1> %dir_log% {Currently:} @DIR_LOG@</q1>]] [[->@puce@ File by default : %file_log%]] [[->@puce@ Extension : %file_log_suffix%]][[->@puce@ for each hit: %max_log% maximum file access]]',
	'spip_log:description2' => '@puce@ the SPIP severity filter allows you to select the level of maximum importance to be considered before starting a data log. Level 8 allows for example to store all the messages sent by SPIP. The default level is level 5.',
	'spip_log:description3' => '@puce@ specific logs of the Swiss Army Knife are activated here  «[.->cs_comportement]».
@puce@ jet lag used by the functions date / time can be configured here: «[.->timezone]» {(PHP 5.1 minimum)}.',
	'spip_log:nom' => 'SPIP and the logs',
	'stat_auteurs' => 'Authors in statistics',
	'statuts_spip' => 'Only the following SPIP status:',
	'statuts_tous' => 'Every status',
	'suivi_forums:description' => 'The author of an article is always informed when a message is posted in the article\'s public forum. It is also possible to inform others: either all the forum\'s participants, or  just all the authors of messages higher in the thread.[[%radio_suivi_forums3%]]',
	'suivi_forums:nom' => 'Overview of the public forums',
	'supprimer_cadre' => 'Delete this frame',
	'supprimer_numero:description' => 'Applies the supprimer_numero() SPIP function to all {{titles}}, {{names}} and {{types}} (of keywords) of the public site, without needing the filter to be present in the templates.<br />For a multilingual site, follow this syntax: <code>1. <multi>My Title[fr]Mon Titre[de]Mein Titel</multi></code>',
	'supprimer_numero:nom' => 'Delete the number',

	// T
	'test_i18n:description' => 'All language strings which are not internationalized (ie from files lang/*_XX.php) will appear in red.
_ Useful not to not forget any!

@puce@ A test :',
	'test_i18n:nom' => 'Missing translations',
	'timezone:description' => 'Since PHP 5.1.0, each call to a date/time function generates an alert level E_NOTICE if the time zone is not valid and / or a E_WARNING alert if you use system configurations, or the environment variable TZ.
_ Since PHP 5.4.0, the TZ environment variable and information available via the operating system is no longer used to guess the time difference.

Setting currently detected: @_CS_TZ@.

@puce@ {{Set below the jetlag to use on this site.}}
[[%timezone%<q3> Complete list of timezones: : [->http://www.php.net/manual/en/timezones.php].</q3>]].',
	'timezone:nom' => 'Jet lag',
	'titre' => 'The Swiss Army Knife',
	'titre_parent:description' => 'Within a loop, it is common to want to show the title of the parent of the current object. You normally need to use a second loop to do this, but a new tag #TITRE_PARENT makes the syntax easier. In the case of a MOTS loop, the tag gives the title of the keyword group. For other objects (articles, sections, news items, etc.) it gives the title of the parent section (if one such exists).

Note: For keywords, #TITRE_GROUPE is an alias tag for #TITRE_PARENT. SPIP treats the contents of these new tags as it does other #TITRE tags.

@puce@ If you are using SPIP 2.0, then you can use an array of tags of this form: #TITRE_XXX, which give you the title of the object \'xxx\', provided that the field \'id_xxx\' is present in the current table (i.e. #ID_XXX is available in the current loop).

For example, in an (ARTICLES) loop, #TITRE_SECTEUR will give the title of the sector of the current article, since the identifier #ID_SECTEUR (or the field  \'id_secteur\') is available in the loop.

The code <html>#TITRE_XXX{yy}</html> is also available to be used. Example: <html>#TITRE_ARTICLE{10}</html> will return the title of article #10.[[%titres_etendus%]]',
	'titre_parent:nom' => '#TITRE_PARENT/OBJECT tags',
	'titre_tests' => 'The Swiis Army Knife - Test page',
	'titres_typo:description' => 'Transform all of the intermediary headings <html>"{{{My sub-heading}}}"</html> into configurable typographical images.[[%i_taille% pt]][[%i_couleur%]][[%i_police%

Available fonts: @_CS_FONTS@]][[%i_largeur% px]][[%i_hauteur% pt]][[%i_padding% px]][[%i_align%]]

This tool is compatible with: " [.->sommaire] ".',
	'titres_typo:nom' => 'Sub-headings as images',
	'titres_typographies:description' => 'By default, typographical shortcuts of SPIP <html> <html>({, {{, etc.)</html> does not apply to objects titles in your skeletons.
_ This tool activate the application for automatic SPIP typographical shortcuts on all the tags #TITLE and relatives (#NOM for an author, etc.)..

Example of use: the title of a book mentioned in the title of an article, to put in italics.',
	'titres_typographies:nom' => 'Typographied title',
	'tous' => 'All',
	'toutes_couleurs' => 'The 36 colours in CSS styles: @_CS_EXEMPLE_COULEURS@',
	'toutmulti:aide' => 'Multilingual blocks: <b><:trad:></b>',
	'toutmulti:description' => 'Like what you already do in your skeletons, this tool allows you to freely use the language strings (from SPIP or your skeletons) in all content of your site (articles, titles, messages, etc.. ) using the shortcut <code>my_string:></code>.

More information on this can be found in [this article->http://www.spip.net/en_article2444.html].

User variables can also be added to the shortcuts. This feature was introduced with SPIP 2.0. For example, <code><:</code><code>my_string{name=Charles Martin, age=37}:></code> makes it possible to pass the values to the SPIP language file: <code>\'my_string\'=>\'Hi, I\'m @name@ and I am @age@ years old.</code>.

The SPIP PHP function used is: <code>_T(\'a_text\')</code> (with no parameters), and <code>_T(\'a_text\', array(\'arg1\'=>\'some words\', \'arg2\'=>\'other words\'))</code> (with parameters).

Do not forget to check that the variable used <code>\'a_text\'</code> is defined in the language files.',
	'toutmulti:nom' => 'Multilingual blocks',
	'trad_help' => '{{The Swiss Army Knife is translated by volunteers into several languages ​​and his original language is French.}}

Do not hesitate to offer your contribution if you find some problems in the texts of the plugin. The entire team thank you in advance.

To register to the translation space : @url@

For direct access to translations of the modules of Swiss Army Knife, click below on the target language of your choice. Once logged in, then locate the little pencil that appears by passing over the translated text and click.

Your changes will be taken into account a few days later as an update will be available for the Swiss Army Knife. If your language is not in the list, then the translation site allow you to easily create it.

{{Translations currently available}} : @trad@

{{Thanks to the translators}} @contrib@.',
	'trad_mod' => 'Module « @mod@ » : ',
	'travaux_masquer_avert' => 'Hide the frame indicating on the public site that maintenance is currently being carried out',
	'travaux_nocache' => 'Disable also the SPIP cache',
	'travaux_nom_site' => '@_CS_NOM_SITE@',
	'travaux_prochainement' => 'This site will be back online soon.
_ Thank you for your understanding.',
	'travaux_titre' => '@_CS_TRAVAUX_TITRE@',
	'tri_articles:description' => 'Choose the sort order to be used for displaying certain types of objects in the editing interface ([->./?exec=auteurs]), within the sections.

The options below use the SQL function \'ORDER BY\'. Only use the customised option if you know what you are doing (e.g. the fields available for articles are: {id_article, id_rubrique, titre, soustitre, surtitre, statut, date_redac, date_modif, lang, etc.})

@puce@ {{Order of the articles inside the sections}} [[%tri_articles%]][[->%tri_perso%]]

@puce@ {{Order of the groups in the add-a-keyword form}} [[%tri_groupes%]][[->%tri_perso_groupes%]]',
	'tri_articles:nom' => 'SPIP\'s sort orders',
	'tri_groupe' => 'Sort on the group id (ORDER BY id_groupe)',
	'tri_modif' => 'Sort by last modified date (ORDER BY date_modif DESC)',
	'tri_perso' => 'Sort by customised SQL, ORDER BY:',
	'tri_publi' => 'Sort by publication date (ORDER BY date DESC)',
	'tri_titre' => 'Sort by title (ORDER BY 0+titre,titre)',
	'trousse_balises:description' => 'Tool currently under development. It offers a few simple and practical tags to improve the legibility of your templates.

@puce@ {{#BOLO}}: generates a dummy text of about 3000 characters ("bolo" or "[?lorem ipsum]") for use with templates in development. An optional argument specifies the length of the text, e.g. <code>#BOLO{300}</code>. The tag accepts all SPIP\'s filters. For example, <code>[(#BOLO|majuscules)]</code>.
_ It can also be used as a model in content. Place <code><bolo300></code> in any text zone in order to obtain 300 characters of dummy text.

@puce@ {{#MAINTENANT}} (or {{#NOW}}): returns the current date, just like: <code>#EVAL{date(\'Y-m-d H:m:s\')}</code>. An optional argument specifies the format. For example, <code>#MAINTENANT{Y-m-d}</code>. As with <code>#DATE</code>, the display can be customised using filters: <code>[(#MAINTENANT|affdate)]</code>.

@puce {{#CHR<html>{XX}</html>}}: a tag equivalent to <code>#EVAL{"chr(XX)"}</code> which is useful for inserting special characters (such as a line feed) or characters which are reserved for special use by the SPIP compiler (e.g. square and curly brackets).

@puce@ {{#LESMOTS}}: ',
	'trousse_balises:nom' => 'Box of tags',
	'type_urls:description' => '@puce@ SPIP offers a choice between several types of URLs to generate for the access links on the pages of your site:

More information: [->http://www.spip.net/en_article3588.html] The "[.->boites_privees]" tool allows you to see on the page of each SPIP object the clean URL which is associated with it.[[%radio_type_urls3%]]
<q3>@_CS_ASTER@to use the types {html}, {propres}, {propres2}, {libres} or {arborescentes}, copy the file "htaccess.txt" from the root directory of the SPIP site to a file (also at the root) named ".htaccess" (be careful not to overwrite any existing configuration if there already is a file of this name). If your site is in a subdirectory, you may need to edit the line "RewriteBase" in the file in order for the defined URLs to direct requests to the SPIP files.</q3>

<radio_type_urls3 valeur="page">@puce@ {{"page" URLs}}: the default type for SPIP since version 1.9x.
_ Example: <code>/spip.php?article123</code>.
[[%terminaison_urls_page%]][[%separateur_urls_page%]]</radio_type_urls3>

<radio_type_urls3 valeur="html">@puce@ {{"HTML" URLs}}: URLs take the form of classic html pages.
_ Example: <code>/article123.html</code></radio_type_urls3>

<radio_type_urls3 valeur="propres">@puce@ {{"clean" URLs}}: URLs are constructed using the title of the object. Markers (_, -, +, @, etc.) surround the titles, depending on the type of object.
_ Examples: <code>/My-article-title</code> or <code>/-My-section-</code> or <code>/@My-site@</code>[[%terminaison_urls_propres%]][[%debut_urls_propres%]][[%marqueurs_urls_propres%]][[%url_max_propres%]]</radio_type_urls3>

<radio_type_urls3 valeur="propres2">@puce@ {{"clean2" URLs}}: the extension \'.html\' is added to the URLs generated.
_ Example: <code>/My-article-title.html</code> or <code>/-My-section-.html</code>
[[%debut_urls_propres2%]][[%marqueurs_urls_propres2%]][[%url_max_propres2%]]</radio_type_urls3>

<radio_type_urls3 valeur="libres">@puce@ {{"open" URLs}}: the URLs are like {"propres"}, but without markers (_, -, +, @, etc.) to differentiate the various objects.
_ Example: <code>/My-article-title</code> or <code>/My-section</code>
[[%terminaison_urls_libres%]][[%debut_urls_libres%]][[%url_max_libres%]]</radio_type_urls3>

<radio_type_urls3 valeur="arbo">@puce@ {{"hierarchical" URLs}}: URLs are built in a tree structure.
_ Example: <code>/sector/section1/section2/My-article-title</code>
[[%url_arbo_minuscules%]][[%urls_arbo_sans_type%]][[%url_arbo_sep_id%]][[%terminaison_urls_arbo%]][[%url_max_arbo%]]</radio_type_urls3>

<radio_type_urls3 valeur="propres-qs">@puce@ {{"qs-clean" URLs}}:  this system functions using a "Query-String", in other words, without using the .htaccess file. URLs are similar in form to {"propres"}.
_ Example: <code>/?My-article-title</code>
[[%terminaison_urls_propres_qs%]][[%url_max_propres_qs%]]</radio_type_urls3>

<radio_type_urls3 valeur="standard">@puce@ {{"standard" URLs}}: these now discarded URLs were used by SPIP up to version 1.8.
_ Example: <code>article.php3?id_article=123</code>
</radio_type_urls3>

@puce@ If you are using the type  {page} described above or if the object requested is not recognised, you can choose the {{calling script}} for SPIP. By default, SPIP uses {spip.php}, but {index.php} (format: <code>/index.php?article123</code>) or an empty value (format: <code>/?article123</code>) are also possible. To use any other value, you must create the corresponding file at the root of your site with the same contents as in the file {index.php}.[[%spip_script%]]',
	'type_urls:description1' => '@puce@ If you are using a format based on clean URLs ({propres}, {propres2}, {libres}, {arborescentes} ou {propres_qs}), the Swiss Army Knife can:
<q1>• make sure the URL is in {{lower case}}.</q1>[[%urls_minuscules%]]
<q1>• systematically add the {{id of the object}} to the URL (as a suffix, prefix, etc.).
_ (examples: <code>/My-article-title,457</code> or <code>/457-My-article-title</code>)</q1>',
	'type_urls:description2' => '{Note}: a change in this paragraph may need to clear the URLs table to allow SPIP to reflect the new settings.',
	'type_urls:nom' => 'Format of URLs',
	'typo_exposants:description' => '{{Text in French}}: improves the typographical rendering of common abbreviations by adding superscript where necessary (thus, {<acronym>Mme</acronym>} becomes {M<sup>me</sup>}). Common errors corrected: ({<acronym>2ème</acronym>} and {<acronym>2me</acronym>}, for example, become {2<sup>e</sup>}, the only correct abbreviation).

The rendered abbreviations correspond to those of the Imprimerie nationale given in the {Lexique des règles typographiques en usage à l\'Imprimerie nationale} (article " Abréviations ", Presses de l\'Imprimerie nationale, Paris, 2002).

The following expressions are also handled: <html>Dr, Pr, Mgr, St, Bx, m2, m3, Mn, Md, Sté, Éts, Vve, bd, Cie, 1o, 2o, etc.</html>

You can also choose here to use superscript for some other abbreviations, despite the negative opinion of the Imprimerie nationale:[[%expo_bofbof%]]

{{English text}}: the suffixes of ordinal numbers are placed in superscript: <html>1st, 2nd</html>, etc.',
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
	'url_verouillee' => 'URL locked',
	'urls_3_chiffres' => 'Require a minum of 3 digits',
	'urls_avec_id' => 'Place as a suffix',
	'urls_avec_id2' => 'Place as a prefix',
	'urls_base_total' => 'There are currently @nb@ URL(s) in the database',
	'urls_base_vide' => 'The URL database is empty',
	'urls_choix_objet' => 'Edit the URL of a specific object in the database:',
	'urls_edit_erreur' => 'The current URL format ("@type@") does not permit editing.',
	'urls_enregistrer' => 'Write this URL to the database',
	'urls_id_sauf_rubriques' => 'Exclude the following objects (separated by " : "):',
	'urls_minuscules' => 'Lower-case letters',
	'urls_nouvelle' => 'Edit the main "clean" URL',
	'urls_num_objet' => 'Number:',
	'urls_purger' => 'Empty all',
	'urls_purger_tables' => 'empty tables selected',
	'urls_purger_tout' => 'Reset the URLs stored in the database:',
	'urls_rechercher' => 'Find this object in the database',
	'urls_titre_objet' => 'Saved title:',
	'urls_type_objet' => 'Object:',
	'urls_url_calculee' => 'Public URL "@type@":',
	'urls_url_objet' => 'Saved "clean" URL:',
	'urls_valeur_vide' => 'Feedback : An empty value causes the removal of « clean » URL(s) saved and a recalculation of the main URL without locking.',
	'urls_verrouiller' => '{{Lock}} this URL so that SPIP cannot change it, e.g. when someone clicks on " @voir@ " or when the title is modified.',

	// V
	'validez_page' => 'To access modifications:',
	'variable_vide' => '(Empty)',
	'vars_modifiees' => 'The data has been modified',
	'version_a_jour' => 'Your version is up to date.',
	'version_distante' => 'Distant version...',
	'version_distante_off' => 'Remote checking deactivated',
	'version_nouvelle' => 'New version: @version@',
	'version_revision' => 'version: @revision@',
	'version_update' => 'Automatic update',
	'version_update_chargeur' => 'Automatic download',
	'version_update_chargeur_title' => 'Download the latest version of the plugin using the plugin «Downloader»',
	'version_update_title' => 'Downloads the latest version of the plugin and updates it automatically.',
	'verstexte:description' => '2 filters for your templates which make it possible to produce lighter pages.
_ version_texte: extracts the text content of an HTML page, except for some of the more basic tags.
_ version_plein_texte: extracts the textual content from an HTML page to display only the raw text.',
	'verstexte:nom' => 'Text version',
	'visiteurs_connectes:description' => 'Creates an HTML fragment for your templates which displays the number of visitors currently connected to the public site.

Simply add <code><INCLURE{fond=fonds/visiteurs_connectes}></code> in the template.',
	'visiteurs_connectes:inactif' => 'Beware : the website statistics are not activated',
	'visiteurs_connectes:nom' => 'Vistors logged in',
	'voir' => 'See: @voir@',
	'votre_choix' => 'Your choice:',

	// W
	'webmestres:description' => 'Within SPIP, the term {{webmaster}} refers to an {{administrator}} who has FTP access to the site. By default, from SPIP 2.0 on, this is assumed to be the administrator with <code>id_auteur=1</code>. Webmasters defined here have the privilege of no longer needing to use FTP to validate important actions on the site, such as upgrading the database structure or restoring a backup.

Current webmasters: {@_CS_LISTE_WEBMESTRES@}.
_ Eligible administrators: {@_CS_LISTE_ADMINS@}.

As a webmaster yourself, you have the administrative power to change this list of IDs. Use a colon as a separator « : » if there are to be several administrators. e.g. "1:5:6".[[%webmestres%]]',
	'webmestres:nom' => 'List of webmasters',

	// X
	'xml:description' => 'Activates the XML validator for the public site, as described in the [documentation->http://www.spip.net/en_article3582.html]. 
This tool is only visible for the site administrators: a button labeled "XML parsing" is added to the other administration.

@puce@ Useful to validate the syntax of your final pages, and manage Web accessibility troubles for the visually impaired.',
	'xml:nom' => 'XML validator'
);

?>
