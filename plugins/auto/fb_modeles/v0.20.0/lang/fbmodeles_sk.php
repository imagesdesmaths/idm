<?php
// This is a SPIP language file  --  Ceci est un fichier langue de SPIP
// extrait automatiquement de http://trad.spip.org/tradlang_module/fbmodeles?lang_cible=sk
// ** ne pas modifier le fichier **

if (!defined('_ECRIRE_INC_VERSION')) return;

$GLOBALS[$GLOBALS['idx_lang']] = array(

	// C
	'cf_navigation' => 'Pozri [stĺpec s navigáciou->@url@]',
	'cfg_comment_appid' => 'Identifiant d\'une application propre à vote site ; cela nécessite d\'avoir créé l\'application.', # NEW
	'cfg_comment_border_color' => 'Zadajte kód farby v šestnástkovej sústave AJ S úvodnou mriežkou.',
	'cfg_comment_colorscheme' => 'Sélectionnez ici le profil prédéterminé par les modules qui sera utilisé pour l\'affichage.', # NEW
	'cfg_comment_font' => 'Sélectionnez ici la police de caractère qui sera utilisée pour l\'affichage des modules.', # NEW
	'cfg_comment_identifiants' => '{{Utilisez les champs ci-dessous pour préciser les différents identifiants que vous souhaitez utiliser.}} Ils ne sont pas obligatoires, mais peuvent permettre notamment de suivre des statistiques précises proposées par Facebook.', # NEW
	'cfg_comment_pageid' => 'Identifiant d\'une page ; cela nécessite d\'avoir créé la page.', # NEW
	'cfg_comment_reglages' => '{{Vous pouvez ici choisir certains réglages concernant les outils javascript de Facebook.}} Par défaut, les modèles utilisent le langage XFBML ({SDK javascript Facebook}) mais vous pouvez désactiver cette fonctionnalité, les outils seront alors chargés en frames.', # NEW
	'cfg_comment_url_page' => 'Adresse URL complète de votre page ou profil Facebook ; elle sera utilisée par défaut par les modèles (URL du type "<code>http://www.facebook.com/...</code>").', # NEW
	'cfg_comment_userid' => 'Identifiant(s) utilisateur(s) des administrateurs des plugins. Vous pouvez en indiquer plusieurs en les séparant par une virgule.', # NEW
	'cfg_comment_xfbml' => 'Utilisation de la bibliothèque javascript du SDK Facebook et du langage associé. Si vous choisissez "non", les modules seront présentés en iframe.', # NEW
	'cfg_descr' => 'Vous devez ici définir les différents identifiants fournis par le système Facebook.<br /><br />Plus d\'infos : [->http://www.facebook.com/insights/].

Pour inclure les balises "Open Graph" en en-tête de vos pages publiques, vous devez insérer le modèle "insert_head_og" en lui passant l\'environnement : {{#MODELE{insert_head_og}{env}}}.
<br /><br />Plus d\'infos : [->http://developers.facebook.com/docs/opengraph/].', # NEW
	'cfg_descr_titre' => 'Šablóny Facebooku',
	'cfg_identifiants' => 'Prihlásenie na Facebook',
	'cfg_label_appid' => 'Prihlásenie pre aplikáciu "App ID"',
	'cfg_label_border_color' => 'Predvolená farba pozadia',
	'cfg_label_colorscheme' => 'Farebná schéma',
	'cfg_label_font' => 'Predvolené písmo',
	'cfg_label_pageid' => 'Prihlásenie pre stránku "Page ID"',
	'cfg_label_titre' => 'Nastavenia šablón Facebooku',
	'cfg_label_url_page' => 'URL de page ou profil', # NEW
	'cfg_label_userid' => 'Prihlásenie používateľa "User ID"',
	'cfg_label_xfbml' => 'Použitie XFBML',
	'cfg_reglages' => 'Predvolené nastavenia',

	// D
	'defaut' => 'Predvolené',
	'doc_chapo' => 'Le plugin Modèles Facebook pour SPIP 2.0 ({et plus}) propose un ensemble de modèles, ou noisettes, permettant d\'utiliser simplement et rapidement les plugins sociaux proposés par Facebook.', # NEW
	'doc_en_ligne' => 'Dokumentácia',
	'doc_titre_court' => 'Dokumentácia Šablón Facebooku',
	'doc_titre_page' => 'Stránka s dokumentáciou zásuvného modulu Šablóny Facebooku',
	'documentation' => '{{{Utilisation du plugin}}}

Comme montré ci-dessus, les modèles s\'incluent directement en leur passant les options souhaitées.

Chaque modèle peut recevoir une liste d\'options, dont certaines sont nécessaires à son affichage. Pour une liste complète, reportez-vous aux informations des en-tête de fichiers de modèles, dans le répertoire "<code>modeles/</code>" du plugin.

Le plugin propose également un modèle générant des informations {{Open Graph}}, les metas informations utilisées par Facebook, propres à chaque objet SPIP. Pour l\'utiliser, vous devez ajouter manuellement en en-tête de vos squelettes le modèle "{{insert_head_og}}".

{{Attention - }}Ce modèle nécessite de recevoir l\'environnement courant, vous devez donc l\'inclure dans chacun des squelettes de pages ({"article.html", "rubrique.html" ...}) et non dans l\'inclusion globale en en-tête ({"inc_head.html"}) en indiquant : 
<cadre class=\'spip\'>
{{#MODELE{insert_head_og}{env}}}
</cadre>
', # NEW

	// E
	'exemple' => '{{{Exemple}}}

Les différents blocs ci-dessous vous présentent un exemple de chaque modèle avec des valeurs fictives. Reportez-vous au modèle correspondant pour les options.', # NEW

	// F
	'fb_modeles' => 'Šablóny Facebooku',

	// I
	'info_doc' => 'Ak sa vám táto stránka nezobrazuje správne, [kliknite sem.->@link@]',
	'info_doc_titre' => 'Poznámka o zobrazení tejto stránky',
	'info_skel_contrib' => 'Stránka s kompletnou dokumentáciou spip-contribu online: [->http://www.spip-contrib.fr/?article3567].',
	'info_skel_doc' => 'Cette page de documentation est conçue sous forme de squelette SPIP fonctionnant avec la distribution standard ({fichiers du répertoire "squelettes-dist/"}). Si vous ne parvenez pas à visualiser la page, ou que votre site utilise ses propres squelettes, les liens ci-dessous vous permettent de gérer son affichage :

-* [Mode "texte simple"->@mode_brut@] ({html simple + balise INSERT_HEAD})
-* [Mode "squelette Zpip"->@mode_zpip@] ({squelette Z compatible})
-* [Mode "squelette SPIP"->@mode_spip@] ({compatible distribution})', # NEW

	// J
	'javascript_inactif' => 'Javascript je vo vašom prehliadači vypnutý. Niektoré funkcie nebudú fungovať.',

	// L
	'licence' => 'Plugin pour SPIP 2.0+ : {{"Facebook Models" - copyright © 2009 [Piero Wbmstr->http://www.spip-contrib.net/PieroWbmstr] sous licence [GPL->http://www.opensource.org/licenses/gpl-3.0.html] }}.', # NEW

	// N
	'new_window' => 'Nové okno',
	'non' => 'Nie',

	// O
	'oui' => 'Áno',

	// P
	'page_test' => 'Testovacia stránka (lokálne)',
	'page_test_in_new_window' => 'Testovacia stránka v novom okne',
	'personnalisation' => '{{{Personnalisation}}}

Chaque modèle présente son contenu dans un bloc de type <code>div</code> portant des classes CSS du type <code>fb_modeles fb_XXX</code> où {{XXX}} est le nom du modèle. Cela permet une personnalisation des styles pour l\'ensemble des modèles et pour chacun d\'eux.


Par exemple pour le module Facebook "Send" :
<cadre class="spip">
<div class="fb_modeles fb_send">
     ... contenu ... 
</div>
</cadre>', # NEW

	// S
	'sep' => '----',

	// T
	'titre_original' => 'Šablóny pre Facebook, zásuvný modul pre SPIP >2.0'
);

?>
