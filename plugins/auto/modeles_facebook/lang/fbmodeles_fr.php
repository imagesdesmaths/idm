<?php
// RAPPELS
// Les textes de cette page peuvent etre rediges avec les raccourcis typo de SPIP
// !! - Les accents doivent etre code en HTML : é => &eacute;
// !! - Les apostrophes doivents etre echappees : ' => \'

$GLOBALS[$GLOBALS['idx_lang']] = array(
	'oui' => 'Oui',
	'non' => 'Non',

// B //
	// Configuration (CFG)
	'bouton_reset' => 'R&#233;initialiser',
	'bouton_effacer' => 'Effacer',

// C //
	// Documentation
	'cf_navigation' => 'Cf. [colonne de navigation->@url@]',
	'configuration' => '{{{Configuration}}}

Le plugin est pr&eacute;vu pour proposer une page de configuration gr&acirc;ce au plugin {{[CFG : moteur de configuration->http://www.spip-contrib.net/?rubrique575]}} mais celui-ci n\'est pas obligatoire.

@bloc_cfg@
',
	'cfg_pas_installe' => 'Le plugin CFG ne semble pas install&eacute; sur votre site.',
	'cfg_page' => 'Page de configuration',	
	// Configuration (CFG)
	'cfg_descr_titre' => 'Mod&egrave;les Facebook',
	'cfg_label_titre' => 'Configuration des mod&egrave;les Facebook',
	'cfg_descr' => 'Vous devez ici d&eacute;finir les diff&eacute;rents identifiants fournis par le syst&egrave;me Facebook.<br /><br />Plus d\'infos : [->http://www.facebook.com/insights/].

Pour inclure les balises "Open Graph" en en-t&ecirc;te de vos pages publiques, vous devez ins&eacute;rer le mod&egrave;le "insert_head_og" en lui passant l\'environnement : {{&#035;MODELE&#123;insert_head_og&#125;&#123;env&#125;}}.
<br /><br />Plus d\'infos : [->http://developers.facebook.com/docs/opengraph/].',
	'cfg_identifiants' => 'Identifiants Facebook',
	'cfg_comment_identifiants' => '{{Utilisez les champs ci-dessous pour pr&eacute;ciser les diff&eacute;rents identifiants que vous souhaitez utiliser.}} Ils ne sont pas obligatoires, mais peuvent permettre notamment de suivre des statistiques pr&eacute;cises propos&eacute;es par Facebook.',
	'cfg_reglages' => 'R&eacute;glages par d&eacute;faut',
	'cfg_comment_reglages' => '{{Vous pouvez ici choisir certains r&eacute;glages concernant les outils javascript de Facebook.}} Par d&eacute;faut, les mod&egrave;les utilisent le langage XFBML ({SDK javascript Facebook}) mais vous pouvez d&eacute;sactiver cette fonctionnalit&eacute;, les outils seront alors charg&eacute;s en frames.',
	'cfg_label_appid' => 'Identifiant application "App ID"',
	'cfg_comment_appid' => 'Identifiant d\'une application propre &agrave; vote site ; cela n&eacute;cessite d\'avoir cr&eacute;&eacute; l\'application.',
	'cfg_label_pageid' => 'Identifiant page "Page ID"',
	'cfg_comment_pageid' => 'Identifiant d\'une page ; cela n&eacute;cessite d\'avoir cr&eacute;&eacute; la page.',
	'cfg_label_userid' => 'Identifiant utilisateur "User ID"',
	'cfg_comment_userid' => 'Identifiant(s) utilisateur(s) des administrateurs des plugins. Vous pouvez en indiquer plusieurs en les s&eacute;parant par une virgule.',
	'cfg_label_url_page' => 'URL de page ou profil',
	'cfg_comment_url_page' => 'Adresse URL compl&egrave;te de votre page ou profil Facebook ; elle sera utilis&eacute;e par d&eacute;faut par les mod&egrave;les (URL du type "<code>http://www.facebook.com/...</code>").',
	'cfg_label_xfbml' => 'Utilisation du XFBML',
	'cfg_comment_xfbml' => 'Utilisation de la biblioth&egrave;que javascript du SDK Facebook et du langage associ&eacute;. Si vous choisissez "non", les modules seront pr&eacute;sent&eacute;s en iframe.',
	'cfg_label_border_color' => 'Couleur de bordure par d&eacute;faut',
	'cfg_comment_border_color' => 'Indiquez une couleur en code h&eacute;xad&eacute;cimal AVEC le di&egrave;se initial.',
	'cfg_label_font' => 'Police utilis&eacute;e par d&eacute;faut',
	'cfg_comment_font' => 'S&eacute;lectionnez ici la police de caract&egrave;re qui sera utilis&eacute;e pour l\'affichage des modules.',
	'cfg_label_colorscheme' => 'Profil de couleurs',
	'cfg_comment_colorscheme' => 'S&eacute;lectionnez ici le profil pr&eacute;d&eacute;termin&eacute; par les modules qui sera utilis&eacute; pour l\'affichage.',

// D //
	// Documentation
	'doc_titre_page' => 'Page de documentation du plugin Mod&egrave;les Facebook',	
	'doc_titre_court' => 'Documentation Mod&egrave;les Facebook',	
	'doc_en_ligne' => 'Documentation du plugin sur Spip-Contrib',
	'doc_chapo' => 'Le plugin Mod&egrave;les Facebook pour SPIP 2.0 ({et plus}) propose un ensemble de mod&egrave;les, ou noisettes, permettant d\'utiliser simplement et rapidement les plugins sociaux propos&eacute;s par Facebook.',
	'documentation' => '{{{Utilisation du plugin}}}

Comme montr&eacute; ci-dessus, les mod&egrave;les s\'incluent directement en leur passant les options souhait&eacute;es.

Chaque mod&egrave;le peut recevoir une liste d\'options, dont certaines sont n&eacute;cessaires &agrave; son affichage. Pour une liste compl&egrave;te, reportez-vous aux informations des en-t&ecirc;te de fichiers de mod&egrave;les, dans le r&eacute;pertoire "<code>modeles/</code>" du plugin.

Le plugin propose &eacute;galement un mod&egrave;le g&eacute;n&eacute;rant des informations {{Open Graph}}, les metas informations utilis&eacute;es par Facebook, propres &agrave; chaque objet SPIP. Pour l\'utiliser, vous devez ajouter manuellement en en-t&ecirc;te de vos squelettes le mod&egrave;le "{{insert_head_og}}".

{{Attention - }}Ce mod&egrave;le n&eacute;cessite de recevoir l\'environnement courant, vous devez donc l\'inclure dans chacun des squelettes de pages ({"article.html", "rubrique.html" ...}) et non dans l\'inclusion globale en en-t&ecirc;te ({"inc_head.html"}) en indiquant : 
<cadre class=\'spip\'>
{{&#035;MODELE&#123;insert_head_og&#125;&#123;env&#125;}}
</cadre>
',

// E //
	// Configuration (CFG)
	'enregistrer_les_modifications' => 'Enregsitrer les modifications',
	'effacer_les_modifications' => 'Effacer les modifications',
	'effacer_config_courante' => 'Effacer votre configuration',
	// Documentation
	'exemple' => '{{{Exemple}}}

Les diff&eacute;rents blocs ci-dessous vous pr&eacute;sentent un exemple de chaque mod&egrave;le avec des valeurs fictives ({la page utilisera vos valeurs si vous utilisez [CFG->http://www.spip-contrib.net/?rubrique575]}). Reportez-vous au mod&egrave;le correspondant pour les options.',

// F //
	'fb_modeles' => 'Mod&egrave;les Facebook',

// J //
	'javascript_inactif' => 'Le javascript est inactif sur votre navigateur. Certaines fonctionnalit&eacute;s de cet outil seront inactives ...',
	
// L //
	'licence' => 'Plugin pour SPIP 2.0+ : {{"Facebook Models" - copyright &#169; 2009 [Piero Wbmstr->http://www.spip-contrib.net/PieroWbmstr] sous licence ([GPL->http://www.opensource.org/licenses/gpl-3.0.html]}) }}.',

// N //
	'new_window' => 'Nouvelle fen&ecirc;tre',

// P //
	'page_test' => 'Page de test (locale)',
	'page_test_in_new_window' => 'Page de test en nouvelle fen&#234;tre',
	// Documentation
	'personnalisation' => '{{{Personnalisation}}}

Chaque mod&egrave;le pr&eacute;sente son contenu dans un bloc de type <code>div</code> portant des classes CSS du type <code>fb_modeles fb_XXX</code> o&ugrave; {{XXX}} est le nom du modèle. Cela permet une personnalisation des styles pour l\'ensemble des mod&egrave;les et pour chacun d\'eux.


Par exemple pour le module Facebook "Send" :
<cadre class="spip">
<div class="fb_modeles fb_send">
     ... contenu ... 
</div>
</cadre>',

// T //
	'titre_original' => 'Facebook Models, plugin pour SPIP 2.0+',

// Infos squelette de doc
	'sep' => '----',
	'info_doc' => 'Si vous rencontrez des probl&#232;mes pour afficher cette page, [cliquez-ici->@link@].',
	'info_doc_titre' => 'Note concernant l&#039;affichage de cette page',
	'info_skel_doc' => 'Cette page de documentation est con&#231;ue sous forme de squelette SPIP fonctionnant avec la distribution standard ({fichiers du r&#233;pertoire &#034;squelettes-dist/&#034;}). Si vous ne parvenez pas &#224; visualiser la page, ou que votre site utilise ses propres squelettes, les liens ci-dessous vous permettent de g&#233;rer son affichage :

-* [Mode &#034;texte simple&#034;->@mode_brut@] ({html simple + balise INSERT_HEAD})
-* [Mode &#034;squelette Zpip&#034;->@mode_zpip@] ({squelette Z compatible})
-* [Mode &#034;squelette SPIP&#034;->@mode_spip@] ({compatible distribution})',
	'info_skel_contrib' => 'Page de documentation compl&egrave;te en ligne sur spip-contrib : [->http://www.spip-contrib.fr/?article3567].',

);
?>
