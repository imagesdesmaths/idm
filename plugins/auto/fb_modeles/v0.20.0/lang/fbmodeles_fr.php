<?php
// This is a SPIP language file  --  Ceci est un fichier langue de SPIP
// Fichier source, a modifier dans svn://zone.spip.org/spip-zone/_plugins_/modeles_facebook/trunk/lang/
if (!defined('_ECRIRE_INC_VERSION')) return;

$GLOBALS[$GLOBALS['idx_lang']] = array(

	// C
	'cf_navigation' => 'Cf. [colonne de navigation->@url@]',
	'cfg_comment_appid' => 'Identifiant d\'une application propre à vote site ; cela nécessite d\'avoir créé l\'application.',
	'cfg_comment_border_color' => 'Indiquez une couleur en code héxadécimal AVEC le dièse initial.',
	'cfg_comment_colorscheme' => 'Sélectionnez ici le profil prédéterminé par les modules qui sera utilisé pour l\'affichage.',
	'cfg_comment_font' => 'Sélectionnez ici la police de caractère qui sera utilisée pour l\'affichage des modules.',
	'cfg_comment_identifiants' => '{{Utilisez les champs ci-dessous pour préciser les différents identifiants que vous souhaitez utiliser.}} Ils ne sont pas obligatoires, mais peuvent permettre notamment de suivre des statistiques précises proposées par Facebook.',
	'cfg_comment_pageid' => 'Identifiant d\'une page ; cela nécessite d\'avoir créé la page.',
	'cfg_comment_reglages' => '{{Vous pouvez ici choisir certains réglages concernant les outils javascript de Facebook.}} Par défaut, les modèles utilisent le langage XFBML ({SDK javascript Facebook}) mais vous pouvez désactiver cette fonctionnalité, les outils seront alors chargés en frames.',
	'cfg_comment_url_page' => 'Adresse URL complète de votre page ou profil Facebook ; elle sera utilisée par défaut par les modèles (URL du type "<code>http://www.facebook.com/...</code>").',
	'cfg_comment_userid' => 'Identifiant(s) utilisateur(s) des administrateurs des plugins. Vous pouvez en indiquer plusieurs en les séparant par une virgule.',
	'cfg_comment_xfbml' => 'Utilisation de la bibliothèque javascript du SDK Facebook et du langage associé. Si vous choisissez "non", les modules seront présentés en iframe.',
	'cfg_descr' => 'Vous devez ici définir les différents identifiants fournis par le système Facebook.<br /><br />Plus d\'infos : [->http://www.facebook.com/insights/].

Pour inclure les balises "Open Graph" en en-tête de vos pages publiques, vous devez insérer le modèle "insert_head_og" en lui passant l\'environnement : {{#MODELE{insert_head_og}{env}}}.
<br /><br />Plus d\'infos : [->http://developers.facebook.com/docs/opengraph/].',
	'cfg_descr_titre' => 'Modèles Facebook',
	'cfg_identifiants' => 'Identifiants Facebook',
	'cfg_label_appid' => 'Identifiant application "App ID"',
	'cfg_label_border_color' => 'Couleur de bordure par défaut',
	'cfg_label_colorscheme' => 'Profil de couleurs',
	'cfg_label_font' => 'Police utilisée par défaut',
	'cfg_label_pageid' => 'Identifiant page "Page ID"',
	'cfg_label_titre' => 'Configuration des modèles Facebook',
	'cfg_label_url_page' => 'URL de page ou profil',
	'cfg_label_userid' => 'Identifiant utilisateur "User ID"',
	'cfg_label_xfbml' => 'Utilisation du XFBML',
	'cfg_reglages' => 'Réglages par défaut',

	// D
	'defaut' => 'Défaut',
	'doc_chapo' => 'Le plugin Modèles Facebook pour SPIP 2.0 ({et plus}) propose un ensemble de modèles, ou noisettes, permettant d\'utiliser simplement et rapidement les plugins sociaux proposés par Facebook.',
	'doc_en_ligne' => 'Documentation',
	'doc_titre_court' => 'Documentation Modèles Facebook',
	'doc_titre_page' => 'Page de documentation du plugin Modèles Facebook',
	'documentation' => '{{{Utilisation du plugin}}}

Comme montré ci-dessus, les modèles s\'incluent directement en leur passant les options souhaitées.

Chaque modèle peut recevoir une liste d\'options, dont certaines sont nécessaires à son affichage. Pour une liste complète, reportez-vous aux informations des en-tête de fichiers de modèles, dans le répertoire "<code>modeles/</code>" du plugin.

Le plugin propose également un modèle générant des informations {{Open Graph}}, les metas informations utilisées par Facebook, propres à chaque objet SPIP. Pour l\'utiliser, vous devez ajouter manuellement en en-tête de vos squelettes le modèle "{{insert_head_og}}".

{{Attention - }}Ce modèle nécessite de recevoir l\'environnement courant, vous devez donc l\'inclure dans chacun des squelettes de pages ({"article.html", "rubrique.html" ...}) et non dans l\'inclusion globale en en-tête ({"inc_head.html"}) en indiquant : 
<cadre class=\'spip\'>
{{#MODELE{insert_head_og}{env}}}
</cadre>
',

	// E
	'exemple' => '{{{Exemple}}}

Les différents blocs ci-dessous vous présentent un exemple de chaque modèle avec des valeurs fictives. Reportez-vous au modèle correspondant pour les options.',

	// F
	'fb_modeles' => 'Modèles Facebook',

	// I
	'info_doc' => 'Si vous rencontrez des problèmes pour afficher cette page, [cliquez-ici->@link@].',
	'info_doc_titre' => 'Note concernant l\'affichage de cette page',
	'info_skel_contrib' => 'Page de documentation complète en ligne sur spip-contrib : [->http://www.spip-contrib.fr/?article3567].',
	'info_skel_doc' => 'Cette page de documentation est conçue sous forme de squelette SPIP fonctionnant avec la distribution standard ({fichiers du répertoire "squelettes-dist/"}). Si vous ne parvenez pas à visualiser la page, ou que votre site utilise ses propres squelettes, les liens ci-dessous vous permettent de gérer son affichage :

-* [Mode "texte simple"->@mode_brut@] ({html simple + balise INSERT_HEAD})
-* [Mode "squelette Zpip"->@mode_zpip@] ({squelette Z compatible})
-* [Mode "squelette SPIP"->@mode_spip@] ({compatible distribution})',

	// J
	'javascript_inactif' => 'Le javascript est inactif sur votre navigateur. Certaines fonctionnalités de cet outil seront inactives ...',

	// L
	'licence' => 'Plugin pour SPIP 2.0+ : {{"Facebook Models" - copyright © 2009 [Piero Wbmstr->http://www.spip-contrib.net/PieroWbmstr] sous licence [GPL->http://www.opensource.org/licenses/gpl-3.0.html] }}.',

	// N
	'new_window' => 'Nouvelle fenêtre',
	'non' => 'Non',

	// O
	'oui' => 'Oui',

	// P
	'page_test' => 'Page de test (locale)',
	'page_test_in_new_window' => 'Page de test en nouvelle fenêtre',
	'personnalisation' => '{{{Personnalisation}}}

Chaque modèle présente son contenu dans un bloc de type <code>div</code> portant des classes CSS du type <code>fb_modeles fb_XXX</code> où {{XXX}} est le nom du modèle. Cela permet une personnalisation des styles pour l\'ensemble des modèles et pour chacun d\'eux.


Par exemple pour le module Facebook "Send" :
<cadre class="spip">
<div class="fb_modeles fb_send">
     ... contenu ... 
</div>
</cadre>',

	// S
	'sep' => '----',

	// T
	'titre_original' => 'Facebook Models, plugin pour SPIP 2.0+'
);

?>
