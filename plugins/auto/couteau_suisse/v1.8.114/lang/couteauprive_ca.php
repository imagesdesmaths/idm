<?php
// This is a SPIP language file  --  Ceci est un fichier langue de SPIP
// extrait automatiquement de http://trad.spip.net/tradlang_module/couteauprive?lang_cible=ca
// ** ne pas modifier le fichier **

if (!defined('_ECRIRE_INC_VERSION')) return;

$GLOBALS[$GLOBALS['idx_lang']] = array(

	// 2
	'2pts_non' => ' : no',
	'2pts_oui' => ' : si',

	// S
	'SPIP_liens:description' => '@puce@ Tots els enllaços del lloc s\'obren, per defecte, a la mateixa finestra de navegació en la que esteu. Però pot ser útil obrir els enllaços externs al lloc en una nova finestra exterior -- això es pot aconseguir afegint {target="_blank"} a totes les etiquetes &lt;a&gt; dotades per SPIP del tipus {spip_out}, {spip_url} o {spip_glossaire}. A vegades pot ser necessari afegir una d\'aquestes classes als enllaços de l\'esquelet del lloc (fitxers html) per tal d\'ampliar al màxim aquesta funcionalitat.[[%radio_target_blank3%]]

@puce@ SPIP permet lligar paraules amb la seva definició gràcies a la drecera tipogràfica <code>[?mot]</code>. Per defecte (o si deixeu buida la casella de més avall), el glossari extern us retorna cap a l\'enciclopèdia lliure wikipedia.org. Us toca a vosaltres escollir quina adreça voleu utilitzar. <br />Enllaç de prova: [?SPIP][[%url_glossaire_externe2%]]', # MODIF
	'SPIP_liens:description1' => '@puce@ SPIP ha previst un estil CSS pels enllaços «~mailto:~»: un petit sobre hauria d\'aparèixer al davant de cada enllaç lligat a un correu electrònic; però com que no tots els navegadors el poden mostrar (sobretot IE6, IE7 i SAF3), heu de veure si voleu conservar aquest afegit.
_ Enllaç de test: [->test@test.com] (recarregueu la pàgina completament).[[%enveloppe_mails%]]',
	'SPIP_liens:nom' => 'SPIP i els enllaços externs',
	'SPIP_tailles:description' => '@puce@ Per tal d\'alleugerir la memòria del vostre servidor, SPIP us permet limitar les dimensions (amplada i llargada) i la mida del fitxer de les imatges, logos o documents adjunts als diversos continguts del vostre lloc. Si un fitxer sobrepassa la mida indicada, el formulari enviarà bé les dades però seran destruïdes i SPIP no les tindrà en compte, ni a dins del directori IMG/, ni a la base de dades. Llavors s\'enviarà un missatge d\'advertència a l\'usuari.

Un valor nul o no informat correspon a un valor il·limitat.
[[Alçada: %img_Hmax% píxels]][[->Amplada: %img_Wmax% píxels]][[->Pes del fitxer: %img_Smax% Ko]]
[[Alçada: %logo_Hmax% píxels]][[->Amplada: %logo_Wmax% píxels]][[->Pes del fitxer: %logo_Smax% Ko]]
[[Pes del fitxer: %doc_Smax% Ko]]

@puce@ Definiu aquí l\'espai màxim reservat als fitxer distants que SPIP podria descarregar (de servidor a servidor) i emmagatzemar al vostre lloc. Aquí, el valor per defecte és de 16 Mb.[[%copie_Smax% Mo]]

@puce@ Per tal d\'evitar un depassament de memòria PHP en el tractament per la llibreria GD2 de grans imatges, SPIP prova les capacitats del servidor i, per tant, pot refusar tractar les imatges massa grans. És possible desactivar aquest test definint manualment el nombre màxim de píxels suportats pels càlculs.

El valor de 1~000~000 píxels sembla correcte per una configuració amb poca memòria. Un valor nul o no indicat activarà el test del servidor.
[[%img_GDmax% píxels com a màxim]]

@puce@ La llibreria GD2 permet ajustar la qualitat de la compressió de les imatges JPG. Un percentatge elevat equival a una qualitat elevada.
[[%img_GDqual% %]]',
	'SPIP_tailles:nom' => 'Límits de la memòria',

	// A
	'acces_admin' => 'Accés administradors:',
	'action_rapide' => 'Acció ràpida, només si sabeu què us feu! ',
	'action_rapide_non' => 'Acció ràpida, disponible un cop aquesta eina siga activada :',
	'admins_seuls' => 'Només els administradors',
	'aff_tout:description' => 'Il parfois utile d\'afficher toutes les rubriques ou tous les auteurs de votre site sans tenir compte de leur statut (pendant la période de développement par exemple). Par défaut, SPIP n\'affiche en public que les auteurs et les rubriques ayant au moins un élément publié.

Bien qu\'il soit possible de contourner ce comportement à l\'aide du critère [<html>{tout}</html>->http://www.spip.net/fr_article4250.html], cet outil automatise le processus et vous évite d\'ajouter ce critère à toutes les boucles RUBRIQUES et/ou AUTEURS de vos squelettes.', # NEW
	'aff_tout:nom' => 'Affiche tout', # NEW
	'alerte_urgence:description' => 'Affiche en tête de toutes les pages publiques un bandeau d\'alerte pour diffuser le message d\'urgence défini ci-dessous.
_ Les balises <code><multi/></code> sont recommandées en cas de site multilingue.[[%alerte_message%]]', # NEW
	'alerte_urgence:nom' => 'Message d\'alerte', # NEW
	'attente' => 'Espera...',
	'auteur_forum:description' => 'Incita a tots els autors de missatges públics a omplir (amb una lletra com a mínim!) un nom i/o un correu electrònic per tal d\'evitar les contribucions totalment anònimes. Fixeu-vos que aquesta eina fa una verificació del JavaScript al lloc del visitant.[[%auteur_forum_nom%]][[->%auteur_forum_email%]][[->%auteur_forum_deux%]]
{Alerta: Escollir la tercera opció anul·la les 2 primeres. És important verificar que els formularis del vostre esquelet són compatibles completament amb aquesta eina.}',
	'auteur_forum:nom' => 'No als fòrums anònims',
	'auteur_forum_deux' => 'O, al menys un dels dos camps precedents',
	'auteur_forum_email' => 'El camp «@_CS_FORUM_EMAIL@»',
	'auteur_forum_nom' => 'El camp «@_CS_FORUM_NOM@»',
	'auteurs:description' => 'Aquesta eina configura l\'aparença de [la pàgina autors->./?exec=auteurs], a la part privada.

@puce@ Definiu aquí el nombre màxim d\'autors a mostrar en el quadre central de la pàgina d\'autors. Més enllà, trobem una paginació.[[%max_auteurs_page%]]

@puce@ Quins estats d\'autors es poden llistar en aquesta pàgina?
[[%auteurs_tout_voir%[[->%auteurs_0%]][[->%auteurs_1%]][[->%auteurs_5%]][[->%auteurs_6%]][[->%auteurs_n%]]]]',
	'auteurs:nom' => 'Pàgina d\'autors',
	'autobr:description' => 'Aplica, en alguns continguts SPIP, el filtre {|post_autobr} que substitueix tots els salts de línia simples per un salt de línia HTML <br />.[[%alinea%]][[->%alinea2%]]', # MODIF
	'autobr:description1' => 'Rompant avec une tradition historique, SPIP 3 tient désormais compte par défaut des alinéas (retours de ligne simples) dans ses contenus. Vous pouvez ici désactiver ce comportement et revenir à l\'ancien système où le retour de ligne simple n\'est pas reconnu -- à l\'instar du langage HTML.', # NEW
	'autobr:description2' => 'Objets contenant cette balise (non exhaustif) :
- Articles : @ARTICLES@.
- Rubriques : @RUBRIQUES@.
- Forums : @FORUMS@.', # NEW
	'autobr:nom' => 'Retorns de línia automàtics',
	'autobr_non' => 'A l\'interior d\'etiquetes &lt;alinea>&lt;/alinea>',
	'autobr_oui' => 'Articles i missatges públics (etiquetes @BALISES@)',
	'autobr_racc' => 'Retorns de línia: <b>&lt;alinea>&lt;/alinea></b>', # MODIF

	// B
	'balise_set:description' => 'Per simplificar les escriptures del tipus <code>#SET{x,#GET{x}|un_filtre}</code>, aquesta eina us ofereix la següent drecera: <code>#SET_UN_FILTRE{x}</code>. El filtre aplicat a una variable passa, per tant, al nom de l\'etiqueta.

Exemples: <code>#SET{x,1}#SET_PLUS{x,2}</code> o <code>#SET{x,avions}#SET_REPLACE{x,ons,ez}</code>.',
	'balise_set:nom' => 'Etiqueta #SET ampliada',
	'barres_typo_edition' => 'Edició dels continguts',
	'barres_typo_forum' => 'Missatges del Fòrum',
	'barres_typo_intro' => 'S\'ha detectar el connector «Porte-Plume». Vulgueu escollir aquí les barres tipogràfiques on s\'inseriran alguns botons. ',
	'basique' => 'Bàsic',
	'blocs:aide' => 'Blocs Desplegables: <b>&lt;bloc&gt;&lt;/bloc&gt;</b> (alias : <b>&lt;invisible&gt;&lt;/invisible&gt;</b>) i <b>&lt;visible&gt;&lt;/visible&gt;</b>',
	'blocs:description' => 'Us permet crear blocs que, amb el títol clicable, els pot tornar visibles o invisibles.

@puce@ {{En els textos SPIP}}: els redactors tenen disponibles les noves etiquetes &lt;bloc&gt; (o &lt;invisible&gt;) i &lt;visible&gt; per utilitzar en el seus textos d\'aquesta manera:

<quote><code>
<bloc>
 Un títol que esdevindrà clicable

 El text a amagar/mostrar, després de dos salts de línia...
 </bloc>
</code></quote>

@puce@ {{En els esquelets}}: teniu disponibles les noves etiquetes #BLOC_TITRE, #BLOC_DEBUT i #BLOC_FIN per utilitzar d\'aquesta manera: 

<quote><code> #BLOC_TITRE o #BLOC_TITRE{mon_URL}
 El meu títol
 #BLOC_RESUME    (facultatiu)
 una versió resumida del bloc següent
 #BLOC_DEBUT
 El meu bloc desplegable (que contindrà el URL al que apunta si és necessari)
 #BLOC_FIN</code></quote>

@puce@ Marcant amb una creu «si» més avall, l\'obertura d\'un bloc provocarà el tancament de tots els altres blocs de la pàgina, per tal de tenir-ne només un d\'obert a la vegada.[[%bloc_unique%]]

@puce@ Marcant amb una creu «si» més avall, l\'estat dels blocs enumerats serà emmagatzemat a una galeta mentre duri la sessió, per tal de conservar l\'aspecte de la pàgina en cas de retorn.[[%blocs_cookie%]]

@puce@ El Ganivet Suís utilitza, per defecte, l\'etiqueta HTML &lt;h4&gt; pel títol dels blocs desplegables. Escolliu aquí una altra etiqueta <hN> :[[%bloc_h4%]]

@puce@ Per tal d\'obtenir un efecte més agradable al moment del clic, els vostres blocs desplegables es poden animar com si \\"llisquessin\\".[[%blocs_slide%]][[->%blocs_millisec% millisecondes]]',
	'blocs:nom' => 'Blocs Desplegables',
	'boites_privees:description' => 'Tots els quadres descrits més avall apareixen aquí o a la part privada.[[%cs_rss%]][[->%format_spip%]][[->%stat_auteurs%]][[->%qui_webmasters%]][[->%bp_urls_propres%]][[->%bp_tri_auteurs%]]
- {{Les revisions del Ganivet Suís}}: un quadre a la pàgina actual de configuració, indicant les últimes modificacions aportades al codi del plugin ([Source->@_CS_RSS_SOURCE@]).
- {{Els articles en format SPIP}}: un quadre desplegable suplementari pels vostres articles que permet conèixer el codi font utilitzat pels seus autors.
- {{Els autors en estat}}: un quadre desplegable sobre [la page des auteurs->./?exec=auteurs] que indica els 10 últims connectats i les inscripcions no confirmades. Aquestes informacions només les veuen els administradors.
- {{Els Webmestres SPIP}}: un quadre desplegable a [la page des auteurs->./?exec=auteurs] que indica els administradors que tenen el nivell de Webmestre SPIP. Només els administradors veuen aquestes informacions. Si tu mateix ets Webmestre, mira també l\'eina « [.->webmestres] ».
- {{Els URLs propis}}: un quadre desplegable per cada objecte de contingut (article, secció, autor,...) indicant el URL propi associat així com el seu àlies eventual. L\'eina « [.->type_urls] » us permet una configuració dels URLs del vostre lloc Web.
- {{Les classificacions d\'autors}}: un quadre desplegable pels articles que contenen més d\'un autor i que permet simplement ajustar-ne l\'ordre de visualització. ',
	'boites_privees:nom' => 'Requadres privats',
	'bp_tri_auteurs' => 'Les classificacions d\'autors',
	'bp_urls_propres' => 'Els URLs propis',
	'brouteur:description' => '@puce@ {{Selector de secció (cercador)}}. Utilitzeu el selector de secció en AJAX a partir de %rubrique_brouteur% secció(ons).

@puce@ {{Selecció de paraules clau}}. Utilitzeu un camp de cerca en lloc d\'una llista de selecció a partir de %select_mots_clefs% mot(s)-clef(s).

@puce@ {{Selecció d\'autors}}. L\'afegit d\'un autor es fa per mini-navegador a dins de la forquilla següent:
<q1>• Una llista de selecció per menys de %select_min_auteurs% autor(s).
_ • Un camp de cerca a partir de %select_max_auteurs% autor(s).</q1>',
	'brouteur:nom' => 'Regulació dels selectors',

	// C
	'cache_controle' => 'Control de la memòria cau',
	'cache_nornal' => 'Ús normal',
	'cache_permanent' => 'Memòria cau permanent',
	'cache_sans' => 'Sense memòria cau',
	'categ:admin' => '1. Administració',
	'categ:devel' => '55. Développement', # NEW
	'categ:divers' => '60. Divers',
	'categ:interface' => '10. Interfície privada',
	'categ:public' => '40. Visualització pública',
	'categ:securite' => '5. Seguretat',
	'categ:spip' => '50. Etiquetes, filtres, criteris',
	'categ:typo-corr' => '20. Millora dels textos',
	'categ:typo-racc' => '30. Dreceres tipogràfiques',
	'certaines_couleurs' => 'Només les etiquetes definides més avall@_CS_ASTER@ :',
	'chatons:aide' => 'Emoticones: @liste@',
	'chatons:description' => 'Insereix imatges (o emoticones pels {xats}) en tots els textos on apareix una cadena del tipus <code>:nom</code>.
_ Aquesta eina substitueix aquestes dreceres per les imatges amb el mateix nom que troba a dins de la vostra carpeta <code>mon_squelette_toto/img/chatons/</code>, o per defecte, la carpeta <code>couteau_suisse/img/chatons/</code>.', # MODIF
	'chatons:nom' => 'Emoticones',
	'citations_bb:description' => 'Per tal de respectar els usos en HTML a dins dels continguts SPIP del vostre lloc (articles, seccions, etc.), aquesta eina substitueix les etiquetes &lt;quote&gt; per etiquetes &lt;q&gt; quan no hi ha salt de línia. Efectivament, les citacions curtes han d\'estar envoltades per &lt;q&gt; i les citacions que contenen paràgrafs per &lt;blockquote&gt;.',
	'citations_bb:nom' => 'Citacions ben etiquetades',
	'class_spip:description1' => 'Aquí podeu definir algunes dreceres d\'SPIP. Un valor buit equival a utilitzar el valor per defecte.[[%racc_hr%]]',
	'class_spip:description2' => '@puce@ {{Les dreceres d\'SPIP}}.

Aquí podeu definir algunes dreceres d\'SPIP. Un valor buit equival a fer servir el valor per defecte.[[%racc_hr%]][[%puce%]]',
	'class_spip:description3' => '

{Atenció: si l\'eina « [.->pucesli] » està activada, la substitució del guionet « - » no es farà; al seu lloc s\'utilitzarà una llista del tipus &lt;ul>&lt;li>.}

SPIP utilitza habitualment l\'etiqueta <h3> pels subtítols. Escolliu aquí un altre emplaçament:[[%racc_h1%]][[->%racc_h2%]]',
	'class_spip:description4' => '

SPIP ha escollit utilitzar l\'etiqueta <strong> per transcriure les negretes. Però &lt;b> també hauria pogut anar bé, amb o sense estil. Vosaltres decidiu:[[%racc_g1%]][[->%racc_g2%]]

SPIP ha escollit utilitzar l\'etiqueta &lt;i> per transcriure les itàliques. Però &lt;em> també hauria pogut anar bé, amb o sense estil. Vosaltres decidiu: [[%racc_i1%]][[->%racc_i2%]]

 Podeu també definir el codi obrint i tancant per les crides de notes a peu de pàgina (Atenció! Les modificacions només seran visibles a l\'espai públic: [[%ouvre_ref%]][[->%ferme_ref%]]

 Podeu definir el codi obrint i tancant per les notes de peu de pàgina: [[%ouvre_note%]][[->%ferme_note%]]

@puce@ {{Els estils d\'SPIP per defecte}}. Fins a la versió 1.92 d\'SPIP, les dreceres tipogràfiques produïen sistemàticament etiquetes vestides de l\'estil "spip". Per exemple: <code><p class="spip"></code>. Aquí podeu definir l\'estil d\'aquestes etiquetes en funció dels vostres fulls d\'estil. Una caixa buida significa que no s\'aplicarà cap estil en particular.

{Atenció: si algunes dreceres (línia horitzontal, subtítol, itàlica, negreta) s\'han modificat més amunt, els estils posteriors no s\'aplicaran.}

<q1>
_ {{1.}} Etiquetes &lt;p&gt;, &lt;i&gt;, &lt;strong&gt; :[[%style_p%]]
_ {{2.}} Etiquetes &lt;tables&gt;, &lt;hr&gt;, &lt;h3&gt;, &lt;blockquote&gt; i les llistes (&lt;ol&gt;, &lt;ul&gt;, etc.): [[%style_h%]]

Fixeu-vos-hi bé: modificant aquest segon estil, també perdeu els estils estàndards d\'SPIP associats a aquestes etiquetes.</q1>',
	'class_spip:nom' => 'SPIP i les seves dreceres…',
	'code_css' => 'CSS',
	'code_fonctions' => 'Funcions',
	'code_jq' => 'jQuery',
	'code_js' => 'JavaScript',
	'code_options' => 'Opcions',
	'code_spip_options' => 'Opcions SPIP',
	'compacte_css' => 'Compactar els CSS',
	'compacte_js' => 'Compactar el Javacript',
	'compacte_prive' => 'No compactar res a la part privada',
	'compacte_tout' => 'No compactar res de res (fa caducar les opcions anteriors)',
	'contrib' => 'Més informacions: @url@',
	'copie_vers' => 'Copia cap a: @dir@',
	'corbeille:description' => 'SPIP suprimeix automàticament els objectes llençats a la paperera les últimes 24 hores, en general des de les 4 de la matinada, gràcies a una tasca «CRON» (llançament periòdic i/o automàtic dels processos programats prèviament). Aquí podeu impedir aquest procés per tal de gestionar millor la vostra paperera. [[%arret_optimisation%]]',
	'corbeille:nom' => 'La paperera',
	'corbeille_objets' => '@nb@ objecte(s) a la paperera. ',
	'corbeille_objets_lies' => '@nb_lies@ enllaç(os) detectat(s).',
	'corbeille_objets_vide' => 'Cap objecte a la paperera.',
	'corbeille_objets_vider' => 'Suprimir els objectes seleccionats',
	'corbeille_vider' => 'Buidar la paperera:',
	'couleurs:aide' => 'Acolorir el text: <b>[coul]text[/coul]</b>@fond@ amb <b>coul</b> = @liste@',
	'couleurs:description' => 'Permet aplicar fàcilment colors a tots els textos del lloc (articles, breus, títols, fòrum, …) utilitzant etiquetes entre claudàtors en dreceres: <code>[couleur]texte[/couleur]</code>.

Dos exemples idèntics per canviar el color del text:@_CS_EXEMPLE_COULEURS2@

Ídem per canviar el fons, si la opció de més avall ho permet:@_CS_EXEMPLE_COULEURS3@

[[%couleurs_fonds%]]
[[%set_couleurs%]][[-><set_couleurs valeur="1">%couleurs_perso%</set_couleurs>]]
@_CS_ASTER@El format d\'aquestes etiquetes personalitzades ha de llistar colors existents o definir parelles «balise=couleur», separats tots per comes. Exemples: «gris, vermell», «fluix=groc, fort=vermell», «baix=#99CC11, alt=marró» o fins i tot «gris=#DDDDCC, vermell=#EE3300». Pel primer i l\'últim exemple, les etiquetes autoritzades són: <code>[gris]</code> i <code>[rouge]</code> (<code>[fond gris]</code> i <code>[fond rouge]</code> si els fons estan permesos).',
	'couleurs:nom' => 'Tot en colors',
	'couleurs_fonds' => ', <b>[fond coul]text[/coul]</b>, <b>[bg coul]text[/coul]</b>',
	'cs_comportement:description' => '@puce@ {{Logs.}} Podeu obtenir molta informació sobre el funcionament del Ganivet Suís als fitxers {spip.log} que es poden trobar a dins del directori: {<html>@_CS_DIR_TMP@</html>}[[%log_couteau_suisse%]]

@puce@ {{Opcions SPIP.}} SPIP ordena els connectors en un ordre específic. Si voleu estar segurs que el Ganivet Suís estigui al capdamunt i gestioni abans certes opcions d\'SPIP, marqueu la següent opció. Si els drets del vostre servidor ho permeten, el fitxer {<html>@_CS_FILE_OPTIONS@</html>} serà modificat automàticament per incloure el fitxer {<html>@_CS_DIR_TMP@couteau-suisse/mes_spip_options.php</html>}.

[[%spip_options_on%]]@_CS_FILE_OPTIONS_ERR@

@puce@ {{Peticions externes.}} D\'una banda, el Ganivet Suís verifica regularment si existeix una versió més recent del seu codi i informa a la seva pàgina de configuració que hi ha una actualització disponible. Per l\'altra, aquest connector necessita per funcionar certes eines que poden necessitar la importació de llibreries distants.

Si els requeriments externs del vostre servidor us posen problemes o teniu problemes de millora de seguretat, marqueu les següents caselles.[[%distant_off%]][[->%distant_outils_off%]]', # MODIF
	'cs_comportement:nom' => 'Comportaments del Ganivet Suís',
	'cs_comportement_ko' => '{{Note :}} ce paramètre requiert un filtre de gravité réglé à plus de @gr2@ au lieu de @gr1@ actuellement.', # NEW
	'cs_distant_off' => 'Les verificacions de versions distants',
	'cs_distant_outils_off' => 'Les eines del Ganivet Suís que tenen fitxers distants',
	'cs_log_couteau_suisse' => 'Els logs detallats del Ganivet Suís',
	'cs_reset' => 'Està segur de voler reinicialitzar totalment el Gavinet Suís?',
	'cs_reset2' => 'Totes les eines actives actualment seran desactivades i els seus paràmetres reinicialitzats.',
	'cs_spip_options_erreur' => 'Atenció: la modificació del fitxer «<html>@_CS_FILE_OPTIONS@</html>» ha fracassat!',
	'cs_spip_options_on' => 'Les opcions SPIP a «<html>@_CS_FILE_OPTIONS@</html>»',

	// D
	'decoration:aide' => 'Decoració: <b>&lt;balise&gt;test&lt;/balise&gt;</b>, amb <b>balise</b> = @liste@',
	'decoration:description' => 'Nous estils parametritzables a dins dels vostres textos i accessibles gràcies a les etiquetes amb parèntesi. Exemple: 
&lt;lamevaetiqueta&gt;text&lt;/lamevaetiqueta&gt; o: &lt;lamevaetiqueta/&gt;.<br />Definiu més avall els estils CSS que necessiteu, una etiqueta per línia, segons les següents sintaxis:
- {tipus.lamevaetiqueta = el meu estil CSS}
- {tipus.lamevaetiqueta.class = la meva classe CSS}
- {tipus.lamevaetiqueta.lang = la meva llengua (ex: ca)}
- {unalies = lamevaetiqueta}

El paràmetre {tipus} de més amunt pot agafar tres valors:
- {span}: etiqueta a l\'interior d\'un paràgraf (tipus Inline)
- {div}: etiqueta que crea un paràgraf nou (tipus Block)
- {auto}: etiqueta determinada automàticament pel plugin

[[%decoration_styles%]]',
	'decoration:nom' => 'Decoració',
	'decoupe:aide' => 'Bloc de pestanyes: <b>&lt;pestanyes>&lt;/pestanyes></b><br />Separador de pàgines o de pestanyes : @sep@',
	'decoupe:aide2' => 'Àlies: @sep@',
	'decoupe:description' => '@puce@ Talla la visualització pública d\'un article en diverses pàgines gràcies a una paginació automàtica. Situeu simplement a dins del vostre article quatre signes més consecutius (<code>++++</code>) a l\'indret on s\'hagi de realitzar el tall.

Per defecte, el Ganivet Suís insereix la paginació al capdamunt i al peu de l\'article automàticament. Però teniu la possibilitat de situar aquesta paginació allà on us interessi del vostre esquelet gràcies a una etiqueta #CS_DECOUPE que podeu activar aquí:
[[%balise_decoupe%]]

@puce@ Si feu servir aquest separador a l\'interior d\'etiquetes &lt;onglets&gt; i &lt;/onglets&gt; obtindreu aleshores un joc de pestanyes.

A dins dels esquelets: teniu a la vostra disposició les noves etiquetes #ONGLETS_DEBUT, #ONGLETS_TITRE i #ONGLETS_FIN.

Aquesta eina es pot acompanyar amb « [.->sommaire] ».',
	'decoupe:nom' => 'Talla en pàgines i pestanyes',
	'desactiver_flash:description' => 'Suprimeix els objectes flash de les pàgines del vostre lloc i les substitueix pel contingut alternatiu associat.',
	'desactiver_flash:nom' => 'Desactiva els objectes flash',
	'detail_balise_etoilee' => '{{Atenció}}: Verifiqueu bé l\'ús fet pels vostres esquelets d\'etiquetes estrellades. Els tractaments d\'aquesta eina no s\'aplicaran pas a: @bal@.',
	'detail_disabled' => 'Paràmetres no modificables:',
	'detail_fichiers' => 'Fitxers:',
	'detail_fichiers_distant' => 'Fitxers distants:',
	'detail_inline' => 'Codi inserit:',
	'detail_jquery2' => 'Aquesta eina utilitza la llibreria {jQuery}.',
	'detail_jquery3' => '{{Atenció}} : aquesta eina necessita el plugin [jQuery per SPIP 1.92->http://files.spip.org/spip-zone/jquery_192.zip] per funcionar correctament amb aquesta versió d\'SPIP.',
	'detail_pipelines' => 'Pipelines :',
	'detail_raccourcis' => 'Llista de dreceres tipogràfiques reconegudes per aquesta eina.',
	'detail_spip_options' => '{{Nota}}: En cas de disfunció d\'aquesta eina, poseu abans les opcions SPIP gràcies a l\'eina «@lien@».',
	'detail_spip_options2' => 'És recomanable posar més amunt les opcions gràcies a l\'eina «[.->cs_comportement]».', # MODIF
	'detail_spip_options_ok' => '{{Nota}}: Aquesta eina posa actualment les opcions SPIP més amunt gràcies a l\'eina «@lien@».',
	'detail_surcharge' => 'Eina sobrecarregada:',
	'detail_traitements' => 'Tractaments :',
	'devdebug:description' => '{{Aquesta eina us permet veure els errors PHP a la pantalla.}}<br />Podeu escollir el nivell d\'errors d\'execució PHP que es mostrarà si el depurador està actiu, així com l\'espai SPIP sobre el que s\'aplicaran aquests paràmetres.',
	'devdebug:item_e_all' => 'Tots els missatges d\'error (all)',
	'devdebug:item_e_error' => 'Errors greus o fatals (error)',
	'devdebug:item_e_notice' => 'Notes d\'execució (notice)',
	'devdebug:item_e_strict' => 'Tots els missatges + els consells PHP (strict)',
	'devdebug:item_e_warning' => 'Advertències (warning)',
	'devdebug:item_espace_prive' => 'Espai privat',
	'devdebug:item_espace_public' => 'Espai públic',
	'devdebug:item_tout' => 'Tot SPIP',
	'devdebug:nom' => 'Depurador de desenvolupament',
	'distant_aide' => 'Aquesta eina requereix fitxers distants que han d\'estar correctament instal·lats a la llibreria. Abans d\'activar aquesta eina o d\'actualitzar aquesta casella, assegureu-vos que els fitxers requerits estiguin presents al servidor distant.',
	'distant_charge' => 'Fitxer descarregat correctament i instal·lat a la llibreria. ',
	'distant_charger' => 'Llençar la descàrrega',
	'distant_echoue' => 'Error en la càrrega distant, aquesta eina té el risc de no funcionar!',
	'distant_inactif' => 'Fitxer introbable )eina inactiva).',
	'distant_present' => 'Fitxer present a la llibreria a partir del @date@.',
	'docgen' => 'Documentation générale', # NEW
	'docwiki' => 'Carnet d\'idées', # NEW
	'dossier_squelettes:description' => 'Modifica la carpeta de l\'esquelet utilitzat. Per exemple: "esquelets/elmeuesquelet". Podeu inscriure diverses carpetes separant-les pels dos punts <html>« : »</html>. Deixar buida la caixa que segueix (o teclejant "dist"), és l\'esquelet original "dist" subministrat per SPIP el que es farà servir.[[%dossier_squelettes%]]',
	'dossier_squelettes:nom' => 'Carpeta de l\'esquelet',

	// E
	'ecran_activer' => 'Activar la pantalla de seguretat',
	'ecran_conflit' => 'Atenció: el fitxer «@file@» entra en conflicte i s\'ha de suprimir!',
	'ecran_conflit2' => 'Nota: s\'ha detectat i activat un fitxer estàtic «@file@». El Ganivet Suís no podrà ni actualitzar-lo ni configurar-lo.', # MODIF
	'ecran_ko' => 'Pantalla inactiva!',
	'ecran_maj_ko' => 'Hi ha disponible la versió {{@n@}} de la pantalla de seguretat. Actualitzeu el fitxer distant d\'aquesta eina.',
	'ecran_maj_ko2' => 'La versió @n@ de la pantalla de seguretat està disponible. Podeu actualitzar el fitxer distant de l\'eina « [.->ecran_securite] ».',
	'ecran_maj_ok' => '(sembla actualitzat).',
	'ecran_securite:description' => 'La pantalla de seguretat és un fitxer PHP que es pot descarregar directament del lloc oficial d\'SPIP, que protegeix els vostres llocs bloquejant certs atacs lligats a forats de seguretat. Aquest sistema permet reaccionar molt ràpidament quan es descobreix un problema de seguretat, tapant el forat sense necessitat d\'actualitzar tot el lloc ni aplicar un « patch » complexe.

A tenir en compte: la pantalla tanca algunes variables. D\'aquesta manera, per exemple, les  variables anomenades <code>id_xxx</code> estan totes controlades com si fossin obligatòriament valors numèrics sencers, per tal d\'evitar qualsevol injecció de codi SQL via aquest tipus de variable molt corrent. Alguns connectors no són compatibles amb amb totes les regles de la pantalla, utilitzant per exemple <code>&id_x=new</code> per crear un objecte {x}.

A més a més de la seguretat, aquesta pantalla té la capacitat de modular els accessos dels robots d\'infaccès des robots  d\'indexació als scripts PHP, per tal de dir-los-hi de « tornar més tard » quan el servidor està saturat.[[ %ecran_actif%]][[->
@puce@ Regular la protecció anti-robots quan la càrrega del servidor (load) excedeix el valor: %ecran_load%
_ {El valor, per defecte, és 4. Posar 0 per desactivar aquest procès.}@_ECRAN_CONFLIT@]]

En cas d\'actualització oficial, actualitzeu el fitxer distant associat (cliqueu més amunt sobre [actualitzar]) per tal de beneficiar-vos de la protecció més recent.

- Versió del fitxer local: ',
	'ecran_securite:nom' => 'Pantalla de seguretat',
	'effaces' => 'Esborrats',
	'en_travaux:description' => 'Durant un període de manteniment, permet mostrar un missatge personalitzat a tot el lloc públic, eventualment la part privada.

[[%message_travaux%]][[%titre_travaux%]][[%admin_travaux%]][[-><admin_travaux valeur="1">%avertir_travaux%</admin_travaux>]][[%prive_travaux%]]', # MODIF
	'en_travaux:nom' => 'Lloc en manteniment',
	'erreur:bt' => '<span style="color:red;">Atenció:</span> la barra tipogràfica (versió @version@) sembla antiga.<br />El Ganivet Suís és compatible amb una versió igual o superior a @mini@.',
	'erreur:description' => 'id absent en la definició de l\'eina!',
	'erreur:distant' => 'servidor distant',
	'erreur:jquery' => '{{Nota}}: la llibreria {jQuery} sembla inactiva en aquesta pàgina. Consulteu [aquí->http://www.spip-contrib.net/?article2166] el paràgraf sobre les dependències del plugin o recarregar aquesta pàgina.',
	'erreur:js' => 'Sembla que s\'ha produït un error JavaScript en aquesta pàgina i impedeix el seu bon funcionament. Vulgueu activar JavaScript al vostre navegador o desactivar alguns plugins SPIP del vostre lloc.',
	'erreur:nojs' => 'Aquesta pàgina té el JavaScript desactivat.',
	'erreur:nom' => 'Error!',
	'erreur:probleme' => 'Problema a: @pb@',
	'erreur:traitements' => 'El Ganivet Suís - Error de compilació dels tractaments: barreja \'typo\' i \'propre\' prohibit!',
	'erreur:version' => 'Aquesta eina és indispensable en aquesta versió d\'SPIP.',
	'erreur_groupe' => 'Atenció: el grup «@groupe@» no està definit!',
	'erreur_mot' => 'Atenció: la paraula clau «@mot@» no s\'ha definit!',
	'etendu' => 'Estès',

	// F
	'f_jQuery:description' => 'Impedeix la instal·lació de {jQuery} a la part pública per tal d\'economitzar una mica de «temps màquina». Aquesta llibreria ([->http://jquery.com/]) aporta nombroses comoditats a la programació de JavaScript i pot ser utilitzada per alguns connectors. SPIP l\'utilitza a la seva part privada.

Atenció: certes eines del Ganivet Suís necessiten les funcions de {jQuery}. ',
	'f_jQuery:nom' => 'Desactiva jQuery',
	'filets_sep:aide' => 'Línies de Separació: <b>__i__</b> o <b>i</b> és un nombre de <b>0</b> a <b>@max@</b>.<br />Altres línies disponibles: @liste@',
	'filets_sep:description' => 'Insereix línies de separació, que es poden personalitzar per fulls d\'estil, a tots els textos d\'SPIP.
_ La sintaxi és: "__code__", o "code" representa o bé el número d\'identificació (de 0 a 7) de la línia a inserir en relació directa amb els estils corresponents, o bé el nom d\'una imatge situada a dins de la carpeta plugins/couteau_suisse/img/filets.', # MODIF
	'filets_sep:nom' => 'Línies de Separació',
	'filtrer_javascript:description' => 'Per gestionar la inserció de JavaScript a dins dels articles, podem fer-ho de tres maneres:
- <i>mai</i>: el JavaScript és rebutjat a tot arreu
- <i>defecte</i> : el JavaScript s\'assenyala en vermell a l\'espai privat
- <i>sempre</i> : el JavaScript s\'accepta a tot arreu.

Atenció: a dins dels fòrums, peticions, flux sindicats, etc., la gestió del JavaScript és <b>sempre</b> segura.[[%radio_filtrer_javascript3%]]',
	'filtrer_javascript:nom' => 'Gestió del JavaScript',
	'flock:description' => 'Desactiva el sistema bloqueig de fitxers neutralitzant la funció PHP {flock()}. Alguns hostatjadors posen problemes greus fruit d\'un sistema de fitxers inadaptat o a una manca de sincronització. No activeu aquesta eina si el vostre lloc funciona normalment. ',
	'flock:nom' => 'Cap bloqueig de fitxers',
	'fonds' => 'Fons:',
	'forcer_langue:description' => 'Imposa el context de llengua pels jocs d\'esquelets multilingües que disposen d\'un formulari o d\'un menú de llengües que sap gestionar la galeta de llengües.

Tècnicament, aquesta eina té com efecte:
- desactivar la cerca del esquelet en funció de la llengua de l\'objecte,

- desactivar el criteri <code>{lang_select}</code> automàtic en els objectes clàssics (articles, breus, seccions... ).

Aleshores, els blocs multi es mostren sempre en la llengua demanada pel visitant.',
	'forcer_langue:nom' => 'Imposa la llengua',
	'format_spip' => 'Els articles en format SPIP',
	'forum_lgrmaxi:description' => 'Per defecte, els missatges de fòrum no tenen límits de mida. Si aquesta eina està activada, es mostrarà un missatge d\'error quan algú vulgui enviar un missatge d\'una mida superior al valor especificat, i el missatge es rebutjarà. Un valor buit o igual a 0 significa, no obstant, que no s\'aplica cap límit.[[%forum_lgrmaxi%]]',
	'forum_lgrmaxi:nom' => 'Mida dels fòrums',

	// G
	'glossaire:aide' => 'Un text sense glossari: <b>@_CS_SANS_GLOSSAIRE@</b>',
	'glossaire:description' => '@puce@ Gestió d\'un glossari intern lligat a un o diversos grups de paraules clau. Inscriviu aquí el nom dels grups separant-los per dos punts « : ». Deixant buida la casella que segueix (o teclejant "Glossari"), és el grup "Glossari" el que es farà servir.[[%glossaire_groupes%]]

@puce@ Per cada paraula, teniu la possibilitat d\'escollir el número màxim d\'enllaços creats als vostres textos. Tot valor nul o negatiu implica que es tractaran totes les paraules reconegudes. [[%glossaire_limite% par mot-clé]]

@puce@ S\'ofereixen dues solucions per gestionar la petita finestra automàtica que apareix quan hi passes per sobre el ratolí. [[%glossaire_js%]]', # MODIF
	'glossaire:nom' => 'Glossari intern',
	'glossaire_abbr' => 'Ignorer les balises <code><abbr></code> et <code><acronym></code>', # NEW
	'glossaire_css' => 'Solució CSS',
	'glossaire_erreur' => 'La paraula «@mot1@» fa que no es detecti la paraula «@mot2@»',
	'glossaire_inverser' => 'Correcció que es proposa: invertir l\'ordre de paraules a la base.',
	'glossaire_js' => 'Solució JavaScript',
	'glossaire_ok' => 'La llista de @nb@ paraula(es) estudiada(es) a la base sembla correcta.', # MODIF
	'guillemets:description' => 'Substitueix automàticament les cometes (") per les cometes tipogràfiques de la llengua de composició. La substitució, transparent per l\'usuari, no modifica el text original sinó només la seva publicació final. ',
	'guillemets:nom' => 'Cometes tipogràfiques',

	// H
	'help' => '{{Aquesta pàgina només és accessible pels responsables del lloc.}}<p>Permet la configuració de les diferents funcions suplementàries aportades pel plugin «{{Le Couteau Suisse}}».',
	'help2' => 'Versió local: @version@',
	'help3' => '<p>Enllaços de documentació:@contribs@</p><p>Reiniciacions:
_ • [Eines amagades|Tornar a l\'aparença inicial d\'aquesta pàgina->@hide@]
_ • [De tot el connector|Tornar a l\'estat inicial del connector->@reset@]@install@
</p>',
	'horloge:description' => 'Eina en curs de desenvolupament. Us ofereix un rellotge JavaScript. Etiqueta: <code>#HORLOGE</code> Model: <code><horloge></code>

Arguments disponibles: {zona}, {format} i/o {id}.',
	'horloge:nom' => 'Rellotge',

	// I
	'icone_visiter:description' => 'Substitueix la imatge del botó estàndard «<:icone_visiter_site:>» (a dalt a la dreta d\'aquesta pàgina) pel logotip del lloc, si existeix.

Per definir aquest logotip, dirigiu-vos a la pàgina «<:titre_configuration:>» fent un clic damunt del botó «<:icone_configuration_site:>».', # MODIF
	'icone_visiter:nom' => '« <:icone_visiter_site:> »',
	'insert_head:description' => 'Activa automàticament l\'etiqueta [#INSERT_HEAD->http://www.spip.net/fr_article1902.html] a tots els esquelets, tinguin o no aquesta etiqueta entre &lt;head&gt; i &lt;/head&gt;. Gràcies a aquesta opció, els plugins podran inserir JavaScript (.js) o fulls d\'estil (.css).',
	'insert_head:nom' => 'Etiqueta #INSERT_HEAD',
	'insertions:description' => 'ATENCIÓ: eina en curs de desenvolupament!! [[%insertions%]]',
	'insertions:nom' => 'Correccions automàtiques',
	'introduction:description' => 'Aquesta etiqueta que cal posar a dins dels esquelets serveix, en general a la pàgina principal o a les seccions, per fer un resum dels articles, de les notes breus, etc..</p>
<p>{{Atenció}}: Abans d\'activar aquesta funcionalitat, verifiqueu b&eacute; que no existeix ja cap funci&oacute; {balise_INTRODUCTION()} al vostre esquelet o als vostres plugins. La sobrec&agrave;rrega produ&iuml;ra un error de compilaci&oacute;.</p>
@puce@ Podeu precisar (en percentatge per relaci&oacute; al valor utilitzat per defecte) la llargada del text a retornar per l\'etiqueta #INTRODUCTION. Cap valor o igual a 100 no modifica l\'aspecte de la introducci&oacute; i utilitza, per tant, els valors per defecte seg&uuml;ents: 500 car&agrave;cters pels articles, 300 per les notes breus i 600 pels f&ograve;rums i les seccions.
[[%lgr_introduction%&nbsp;%]]

@puce@ Per defecte, els punts de continuaci&oacute; afegits al resultat de l\'etiqueta #INTRODUCTION si el text &eacute;s massa llarg s&oacute;n: <html>«&nbsp;(…)»</html>. Aqu&iacute; podeu precisar la vostra pr&ograve;pia cadena de car&agrave;cters que indiqui al lector que el text tallat t&eacute; una continuaci&oacute;.
[[%suite_introduction%]]
@puce@ Si l\'etiqueta #INTRODUCTION es fa servir per resumir un article, llavors el Ganivet Su&iacute;s pot fabricar un hipervincle al damunt dels punts de continuaci&oacute; definits m&eacute;s amunt per tal portar al lector cap al text original. Per exemple: &laquo;Llegir la continuaci&oacute; de l\'article…&raquo;
[[%lien_introduction%]]
', # MODIF
	'introduction:nom' => 'Etiqueta #INTRODUCTION',

	// J
	'jcorner:description' => '« Jolis Coins » és una eina que permet modificar fàcilment l\'aspecte de les cantonades dels vostres {{requadres acolorits}} a la part pública del vostre lloc. Tot és possible, o gairebé tot!
_ Podeu veure\'n el resultat a la pàgina següent: [->http://www.malsup.com/jquery/corner/].

Llisteu més avall els objectes del vostre esquelet que cal arrodonir utilitzant la sintaxi CSS (.class, #id, etc. ). Feu servir el signe « = » per especificar el comandament jQuery que s\'ha de fer servir i una doble barra inclinada (« // ») pels comentaris. En absència del signe igual, s\'aplicaran les cantonades rodones (equivalent a: <code>.ma_classe = .corner()</code>).[[%jcorner_classes%]]

Atenció, aquesta eina necessita per funcionar el plugin {jQuery}: {Round Corners}. El Ganivet Suís es pot instal·lar directament si marqueu amb una creu la casella següent. [[%jcorner_plugin%]]', # MODIF
	'jcorner:nom' => 'Jolis Coins',
	'jcorner_plugin' => '« Round Corners plugin »',
	'jq_localScroll' => 'jQuery.LocalScroll ([demo->http://demos.flesler.com/jquery/localScroll/])',
	'jq_scrollTo' => 'jQuery.ScrollTo ([demo->http://demos.flesler.com/jquery/scrollTo/])',
	'js_defaut' => 'Per defecte',
	'js_jamais' => 'Mai',
	'js_toujours' => 'Sempre',
	'jslide_aucun' => 'Cap animació',
	'jslide_fast' => 'Lliscament ràpid',
	'jslide_lent' => 'Lliscament lent',
	'jslide_millisec' => 'Lliscament durant :',
	'jslide_normal' => 'Lliscament normal',

	// L
	'label:admin_travaux' => 'Tancar el lloc públic per:',
	'label:alinea' => 'Camp d\'aplicació:',
	'label:alinea2' => 'Sauf :', # NEW
	'label:alinea3' => 'Désactiver la prise en compte des alinéas :', # NEW
	'label:arret_optimisation' => 'Impedir que SPIP buidi la paperera automàticament:',
	'label:auteur_forum_nom' => 'El visitant ha d\'especificar:',
	'label:auto_sommaire' => 'Creació sistemàtica del sumari:',
	'label:balise_decoupe' => 'Activar l\'etiqueta #CS_DECOUPE :',
	'label:balise_sommaire' => 'Activar l\'etiqueta #CS_SOMMAIRE :',
	'label:bloc_h4' => 'Etiqueta pels títols:',
	'label:bloc_unique' => 'Només un bloc obert a la pàgina:',
	'label:blocs_cookie' => 'Utilització de galetes:',
	'label:blocs_slide' => 'Tipus d\'animació:',
	'label:compacte_css' => 'Compressió del HEAD :',
	'label:copie_Smax' => 'Espai màxim reservat a les còpies locals:',
	'label:couleurs_fonds' => 'Permetre els fons:',
	'label:cs_rss' => 'Activar:',
	'label:debut_urls_propres' => 'Inici dels URLs :',
	'label:decoration_styles' => 'Les vostres etiquetes d\'estil personalitzat:',
	'label:derniere_modif_invalide' => 'Tornar a calcular després d\'una modificació:',
	'label:devdebug_espace' => 'Filtrat de la zona afectada:',
	'label:devdebug_mode' => 'Activar la depuració',
	'label:devdebug_niveau' => 'Filtrat del nivell d\'error retornat:',
	'label:distant_off' => 'Desactivar:',
	'label:doc_Smax' => 'Mida màxima dels documents:',
	'label:dossier_squelettes' => 'Carpeta(es) a utilitzar:',
	'label:duree_cache' => 'Durada de la memòria cau local:',
	'label:duree_cache_mutu' => 'Durada de la memòria cau en mutualització:',
	'label:enveloppe_mails' => 'Petit sobre davant dels correus electrònics:',
	'label:expo_bofbof' => 'Escriptura com exponents de: <html>St(e)(s), Bx, Bd(s) et Fb(s)</html>',
	'label:filtre_gravite' => 'Gravité maximale acceptée :', # NEW
	'label:forum_lgrmaxi' => 'Valor (en caràcters):',
	'label:glossaire_groupes' => 'Grup(s) utilitzat(s):',
	'label:glossaire_js' => 'Tècnica utilitzada:',
	'label:glossaire_limite' => 'Número màxim d\'enllaços creats:',
	'label:i_align' => 'Alineament del text:',
	'label:i_couleur' => 'Color de la font:',
	'label:i_hauteur' => 'Alçada de la línia de text (éq. à {line-height}) :',
	'label:i_largeur' => 'Amplada màxima de la línia de text:',
	'label:i_padding' => 'Espai a l\'entorn del text (éq. a {padding}) :',
	'label:i_police' => 'Nom del fitxer de la font (carpetes {polices/}) :',
	'label:i_taille' => 'Mida de la font:',
	'label:img_GDmax' => 'Càlculs d\'imatges amb GD:',
	'label:img_Hmax' => 'Mida màxima de les imatges:',
	'label:insertions' => 'Correccions automàtiques:',
	'label:jcorner_classes' => 'Millorar les cantonades dels següents selectors:',
	'label:jcorner_plugin' => 'Instal·lar el plugin {jQuery} següent:',
	'label:jolies_ancres' => 'Calcular boniques àncores:',
	'label:lgr_introduction' => 'Llargada del resum:',
	'label:lgr_sommaire' => 'Llargada del sumari (9 a 99):',
	'label:lien_introduction' => 'Punts de continuació clicables:',
	'label:liens_interrogation' => 'Protegir els URLs: ',
	'label:liens_orphelins' => 'Enllaços clicables:',
	'label:log_couteau_suisse' => 'Activar:',
	'label:logo_Hmax' => 'Mida màxima dels logos:',
	'label:long_url' => 'Llargada del redactat que es pot clicar:',
	'label:marqueurs_urls_propres' => 'Afegir els marcadors dissociant els objectes (SPIP>=2.0):<br />(ex.: « - » per -La-meva-secció-, « @ » per @Mon-site@) ',
	'label:max_auteurs_page' => 'Autors per pàgina:',
	'label:message_travaux' => 'El vostre missatge de manteniment:',
	'label:moderation_admin' => 'Validar automàticament els missatges de: ',
	'label:mot_masquer' => 'Paraula clau amagant els continguts:',
	'label:nombre_de_logs' => 'Rotation des fichiers :', # NEW
	'label:ouvre_note' => 'Obertura i tancament de les notes a peu de pàgina',
	'label:ouvre_ref' => 'Obertura i tancament de les crides de les notes a peu de pàgina',
	'label:paragrapher' => 'Sempre paràgrafs:',
	'label:prive_travaux' => 'Accessibilitat de l\'espai privat per:',
	'label:prof_sommaire' => 'Profunditat reservada (1 a 4) :',
	'label:puce' => 'Caràcter públic «<html>-</html>» :',
	'label:quota_cache' => 'Valor de la quota :',
	'label:racc_g1' => 'Entrada i sortida de la posada en «<html>{{negreta}}</html>»:',
	'label:racc_h1' => 'Entrada i sortida d\'un «<html>{{{subtítol}}}</html>» :',
	'label:racc_hr' => 'Línia horitzontal «<html>----</html>»:',
	'label:racc_i1' => 'Entrada i sortida de la posada en «<html>{cursiva}</html>» :',
	'label:radio_desactive_cache3' => 'Utilització de la memòria cau:',
	'label:radio_desactive_cache4' => 'Utilització de la memòria cau: ',
	'label:radio_target_blank3' => 'Nova finestra pels enllaços externs:',
	'label:radio_type_urls3' => 'Format dels URLs:',
	'label:scrollTo' => 'Instal·lar els plugins {jQuery} següents:',
	'label:separateur_urls_page' => 'Caràcter de separació \'type-id\'<br />(ex.: ?article-123):',
	'label:set_couleurs' => 'Set per utilitzar:',
	'label:spam_ips' => 'Adreces IP a bloquejar:',
	'label:spam_mots' => 'Seqüències prohibides:',
	'label:spip_options_on' => 'Incloure :',
	'label:spip_script' => 'Script de crida:',
	'label:style_h' => 'El vostre estil:',
	'label:style_p' => 'El vostre estil:',
	'label:suite_introduction' => 'Punts de continuació:',
	'label:terminaison_urls_page' => 'Terminacions dels URls (ex : « .html ») :',
	'label:titre_travaux' => 'Títol del missatge:',
	'label:titres_etendus' => 'Activar la utilització àmplia d\'etiquetes #TITRE_XXX :',
	'label:tout_rub' => 'Afficher en public tous les objets suivants :', # NEW
	'label:url_arbo_minuscules' => 'Conservar els tipus dels títols en els URLs:',
	'label:url_arbo_sep_id' => 'Caràcter de separació \'titre-id\' en cas de doublon:<br />(no utilitzar \'/\')',
	'label:url_glossaire_externe2' => 'Enllaç al glossari extern:',
	'label:url_max_propres' => 'Llargada màxima dels URLs (caràcters):',
	'label:urls_arbo_sans_type' => 'Mostrar el tipus d\'objecte SPIP als URLs:',
	'label:urls_avec_id' => 'Un id sistemàtic, però...',
	'label:webmestres' => 'Llista dels webmestres del lloc:',
	'liens_en_clair:description' => 'Posa a la vostra disposició el filtre: \'liens_en_clair\'. El vostre text conté probablement enllaços que no són visibles durant la impressió. Aquest filtre afegeix entre claudàtors el destí de cada enllaç clicable (enllaços externs o correus electrònics). Atenció: en mode impressió (paràmetre \'cs=print\' o \'page=print\' al url de la pàgina), aquesta funcionalitat s\'aplica automàticament.',
	'liens_en_clair:nom' => 'Enllaços visibles',
	'liens_orphelins:description' => 'Aquesta eina té dues funcions:

@puce@ {{Enllaços correctes}}.

SPIP té per costum inserir un espai abans dels interrogants o dels signes d\'exclamació, la tipografia francesa obliga. No obstant, els URLs dels vostres textos no estan protegits. Aquesta eina us permet protegir-los.[[%liens_interrogation%]]

@puce@ {{Enllaços orfes}}.

Substitueix sistemàticament tots els URLs deixats en text pels usuaris (sobretot als fòrums), i que no són clicables, `per enllaços en format SPIP. Per exemple: {<html>www.spip.net</html>} queda substituït per [->www.spip.net].

Podeu escollir el tipus de substitució:
_ • {Bàsic}: són substituïts els enllaços del tipus {<html>http://spip.net</html>} (tot protocol) o {<html>www.spip.net</html>}.
_ • {Extens}: són substituïts a més els enllaços del tipus {<html>moi@spip.net</html>}, {<html>mailto:monmail</html>} o {<html>news:mesnews</html>}.
_ • {Par defecte): substitució automàtica d\'origen (a partir de la versió 2.0 d\'SPIP).
[[%liens_orphelins%]]',
	'liens_orphelins:description1' => '[[Si l\'URL trobat sobrepassa els %long_url% caràcters, SPIP el redueix llavors a %coupe_url% caràcters]].',
	'liens_orphelins:nom' => 'URLs bonics',
	'local_ko' => 'La mise à jour automatique du fichier local «@file@» a échoué. Si l\'outil dysfonctionne, tentez une mise à jour manuelle.', # NEW
	'log_brut' => 'Données écrites en format brut (non HTML)', # NEW
	'log_fileline' => 'Informations supplémentaires de débogage', # NEW

	// M
	'mailcrypt:description' => 'Amaga tots els enllaços de correus presents als vostres textos substituint-los per un enllaç JavaScript que permet malgrat tot activar la missatgeria del lector. Aquesta eina antispam impedeix que els robots recullin les adreces electròniques deixades visibles als fòrums o a les etiquetes dels vostres esquelets.',
	'mailcrypt:nom' => 'MailCrypt',
	'mailcrypt_balise_email' => 'Traiter également la balise #EMAIL de vos squelettes', # NEW
	'mailcrypt_fonds' => 'Ne pas protéger les fonds suivants :<br /><q4>{Séparez-les par les deux points «~:~» et vérifiez bien que ces fonds restent totalement inaccessibles aux robots du Net.}</q4>', # NEW
	'maj_actualise_ok' => 'Le plugin « @plugin@ » n\'a pas officiellement changé de version, mais ses fichiers ont quand même été actualisés afin de bénéficier de la dernière révision de code.', # NEW
	'maj_auto:description' => 'Aquesta eina us permet gestionar fàcilment l\'actualització dels vostres connectors (plugins), recuperant sobretot el número de revisió que conté el fitxer <code>svn.revision</code> i comparant-lo amb el trobat a <code>zone.spip.org</code>.

La llista de més amunt ofereix la possibilitat de llançar el procés d\'actualització automàtic d\'SPIP a cadascun dels connectors (plugins) instal·lats prèviament a la carpeta <code>plugins/auto/</code>. El altres plugins que es troben a dins de la carpeta <code>plugins/</code> només es llisten com a mera informació. Si la revisió a distància no s\'ha trobat, proveu llavors de fer l\'actualització del connector manualment.

Nota: com que els paquets <code>.zip</code> no es poden reconstruir instantàniament, es probable que estigueu obligat a esperar un cert temps abans de poder efectuar l\'actualització total d\'un connector recentment modificat.',
	'maj_auto:nom' => 'Actualitzacions automàtiques',
	'maj_fichier_ko' => 'Le fichier « @file@ » est introuvable !', # NEW
	'maj_librairies_ko' => 'Librairies introuvables !', # NEW
	'masquer:description' => 'Aquesta eina permet amagar al lloc públic, i sense modificar els vostres esquelets, els continguts (seccions o articles) que tinguin la paraula clau definida més avall. Si una secció està amagada, també ho estarà tota la branca. [[%mot_masquer%]]

Per forçar la publicació de continguts amagats, n\'hi ha prou afegint el criteri <code>{tout_voir}</code> als bucles de la vostra plantilla.', # MODIF
	'masquer:nom' => 'Amagar el contingut',
	'meme_rubrique:description' => 'Definiu aquí la quantitat d\'objectes a llistar en el quadre anomenat  «<:info_meme_rubrique:>» i present a algunes pàgines de l\'espai privat.[[%meme_rubrique%]]',
	'message_perso' => 'Moltes gràcies als traductors que passaran per aquí. Pat ;-)',
	'moderation_admins' => 'administradors autenticats',
	'moderation_message' => 'Aquest fòrum està moderat a priori: la vostra contribució no apareixerà fins que hagi estat validada per un administrador del lloc, excepte si esteu identificats i autoritzats per publicar-hi directament.',
	'moderation_moderee:description' => 'Permet moderar la moderació dels fòrums públics <b>configurats a priori</b> pels usuaris inscrits. <br />Exemple : Jo sóc el webmestre del meu lloc, i jo responc un missatge d\'un usuari, per què he de validar el meu propi missatge? Moderació moderada ho fa per mi! [[%moderation_admin%]][[-->%moderation_redac%]][[-->%moderation_visit%]]',
	'moderation_moderee:nom' => 'Moderació moderada ',
	'moderation_redacs' => 'redactors autenticats',
	'moderation_visits' => 'visitants autenticats',
	'modifier_vars' => 'Modificar aquests @nb@ paràmetres',
	'modifier_vars_0' => 'Modificar aquests paràmetres',

	// N
	'no_IP:description' => 'Desactiva el mecanisme d\'enregistrament automàtic de les adreces IP dels visitants del vostre lloc per motius de confidencialitat: SPIP no conservarà més cap número IP, ni temporalment, de les persones que us puguin visitar (per gestionar les estadístiques o alimentar spip.log), ni en els fòrums (responsabilitat).',
	'no_IP:nom' => 'No emmagatzemar la IP',
	'nouveaux' => 'Nou',

	// O
	'orientation:description' => '3 nous criteris pels vostres esquelets: <code>{portrait}</code>, <code>{carre}</code> et <code>{paysage}</code>. Ideal per la classificació de les fotografies en funció de la seva forma. ',
	'orientation:nom' => 'Orientació de les imatges',
	'outil_actif' => 'Eina activa',
	'outil_actif_court' => 'actiu',
	'outil_activer' => 'Activar',
	'outil_activer_le' => 'Activar l\'eina',
	'outil_actualiser' => 'Actualiser l\'outil', # NEW
	'outil_cacher' => 'No visualitzar més',
	'outil_desactiver' => 'Desactivar',
	'outil_desactiver_le' => 'Desactivar l\'eina',
	'outil_inactif' => 'Eina inactiva',
	'outil_intro' => 'Aquesta pàgina llista les funcionalitats del plugin que teniu disponibles.<br /><br />Fent un clic damunt del nom de les eines que hi ha més avall, seleccioneu aquells als que podreu canviar l\'estat amb l\'ajuda del botó central: les eines activades es desactivaran i <i>viceversa</i>. A cada clic, la descripció apareix a sota de les llistes. Les categories són plegables i les eines es poden amagar.  El doble-clic permet de canviar l\'ordre ràpidament d\'una eina.<br /><br />Quan s\'usa per primer cop, és recomanable activar les eines una a una, per si apareixen algunes incompatibilitats amb el vostre esquelet, amb SPIP o amb altres plugins.<br /><br />Nota: la simple càrrega d\'aquesta pàgina torna a compilar el conjunt d\'eines del Ganivet Suís.',
	'outil_intro_old' => 'Aquesta interfície és antiga.<br /><br />Si trobeu problemes en l\'ús de la <a href=\'./?exec=admin_couteau_suisse\'>nova interfície</a>, no dubteu de dir-nos-ho al fòrum de <a href=\'http://www.spip-contrib.net/?article2166\'>Spip-Contrib</a>.',
	'outil_nb' => '@pipe@: @nb@eina',
	'outil_nbs' => '@pipe@: @nb@ eines',
	'outil_permuter' => 'Intercanviar l\'eina: «@text@»?',
	'outils_actifs' => 'Eines actives:',
	'outils_caches' => 'Eines amagades:',
	'outils_cliquez' => 'Feu un clic sobre el nom de les eines que hi ha més amunt per mostrar aquí la seva descripció. ',
	'outils_concernes' => 'Estan afectats: ',
	'outils_desactives' => 'Estan desactivats: ',
	'outils_inactifs' => 'Eines inactives:',
	'outils_liste' => 'Llista d\'eines del Ganivet Suís',
	'outils_non_parametrables' => 'No paarametrable:',
	'outils_permuter_gras1' => 'Intercanviar les eines en negreta',
	'outils_permuter_gras2' => 'Intercanviar les @nb@ eines en negreta?',
	'outils_resetselection' => 'Reiniciar la selecció',
	'outils_selectionactifs' => 'Seleccionar totes les eines actives',
	'outils_selectiontous' => 'TOTS',

	// P
	'pack_actuel' => 'Paquet @date@',
	'pack_actuel_avert' => 'Atenció, les sobrecàrregues en els  define(), les autoritzacions específiques o les globals no s\'especifiquen aquí',
	'pack_actuel_titre' => 'PAQUET ACTUAL DE CONFIGURACIÓ DEL GANIVET SUÍS',
	'pack_alt' => 'Veure els paràmetres de configuració en curs',
	'pack_delete' => 'Supressió d\'un paquet de configuració',
	'pack_descrip' => 'El vostre «Pack de configuració actual» reuneix el conjunt dels paràmetres de configuració en curs pel que fa al Ganivet Suís: l\'activació d\'eines i el valor de les seves eventuals variables.

Si els drets d\'escriptura ho permeten, el codi PHP que hi ha més avall es podrà situar a dins del fitxer {{/config/mes_options.php}} i afegirà un enllaç de tornar a carregar en aquesta pàgina del pack « {@pack@} ». Evidentment, podreu canviar el seu nom.

Si torneu a carregar el connector fent un clic sobre un pack, el Ganivet Suís es tornarà a configurar automàticament en funció dels paràmetres definits prèviament en aquest paquet.',
	'pack_du' => '• del pack @pack@', # MODIF
	'pack_installe' => 'Instal·lació d\'un pack de configuració',
	'pack_installer' => 'Està segur de voler reinicialitzar el Gavinet Suís i d\'instal·lar el pack « @pack@ » ?',
	'pack_nb_plrs' => 'Actualment hi ha @nb@ «paquets de configuració» disponibles:',
	'pack_nb_un' => 'Actualment hi ha un «paquet de configuració» disponible:',
	'pack_nb_zero' => 'No hi ha cap «paquet de configuració» disponible actualment.',
	'pack_outils_defaut' => 'Instal·lació d\'eines per defecte',
	'pack_sauver' => 'Salvar la configuració actual',
	'pack_sauver_descrip' => 'El botó que hi ha més avall us permet inserir directament en el vostre fitxer <b>@file@</b> els paràmetres necessaris per afegir un «paquet de configuració» al menú de l\'esquerre. Això us permetrà posteriorment tornar a configurar en un clic el vostre Ganivet Suís en l\'estat en què es troba actualment. ',
	'pack_supprimer' => 'Estàs segur que vols suprimir el paquet « @pack@ »?',
	'pack_titre' => 'Configuració Actual',
	'pack_variables_defaut' => 'Instal·lació de variables per defecte',
	'par_defaut' => 'Per defecte',
	'paragrapher2:description' => 'La funció SPIP <code>paragrapher()</code> insereix etiquetes &lt;p&gt; i &lt;/p&gt; a tots els textos que estan desproveïts de paràgrafs. Per tal de gestionar més finament els vostres estils i les vostres compaginacions, teniu la possibilitat d\'uniformitzar l\'aspecte dels textos del vostre lloc.[[%paragrapher%]]',
	'paragrapher2:nom' => 'Paràgraf',
	'pipelines' => 'Pipelines utilitzades:',
	'previsualisation:description' => 'Per defecte, SPIP permet fer una visualització prèvia d\'un article en la seva versió pública i amb estil, però només quan aquest ha estat «proposat per a ser avaluat». Aquesta eina també permet als autors una visualització prèvia dels articles durant la seva redacció. Cadascú pot, llavors, previsualitzar i modifica el seu text al seu gust.



@puce@ Atenció: aquesta funcionalitat no modifica pas els drets de previsualització. Per tal que els vostres redactors tingui efectivament el dret de previsualitzar els seus articles «en procés de correcció», heu d\'autoritzar-los (al menú {[Configuració Funcions avançades->./?exec=config_fonctions]} de l’espai privat).', # MODIF
	'previsualisation:nom' => 'Previsualització dels articles',
	'puceSPIP' => 'Autoritzar la drecera «*»',
	'puceSPIP_aide' => 'Un símbol SPIP : <b>*</b>',
	'pucesli:description' => 'Substitueix els caràcters «-» (guionet simple) dels diferents continguts del vostre lloc per llistes numerades «-*» (traduïdes a HTML per: &lt;ul>&lt;li>…&lt;/li>&lt;/ul>) i l\'estil del qual es pot personalitzar fàcilment amb CSS.

Per tal de conservar l\'accés al caràcter imatge original d\'SPIP (el petit triangle), podeu proposar als vostres redactor una nova drecera al començament de línia:[[%puceSPIP%]]',
	'pucesli:nom' => 'Caràcters bonics',

	// Q
	'qui_webmestres' => 'Els Webmestres SPIP',

	// R
	'raccourcis' => 'Dreceres tipogràfiques actives del Ganivet Suís:',
	'raccourcis_barre' => 'Les dreceres tipogràfiques del Ganivet Suís',
	'rafraichir' => 'Afin de terminer la configuration du plugin, merci d\'actualiser la page courante.', # NEW
	'reserve_admin' => 'Accés reservat als administradors.',
	'rss_actualiser' => 'Actualitzar',
	'rss_attente' => 'Esperant RSS...',
	'rss_desactiver' => 'Desactivar les «Revisions del Ganivet Suís»',
	'rss_edition' => 'Flux RSS actualitzat el:',
	'rss_source' => 'Font RSS',
	'rss_titre' => '«El Ganivet Suís» en desenvolupament:',
	'rss_var' => 'Les revisions del Ganivet Suís',

	// S
	'sauf_admin' => 'Tots, excepte els administradors',
	'sauf_admin_redac' => 'Tots, excepte els administradors i els redactors',
	'sauf_identifies' => 'Tots, excepte els autors identificats',
	'sessions_anonymes:description' => 'Chaque semaine, cet outil vérifie les sessions anonymes et supprime les fichiers qui sont trop anciens (plus de @_NB_SESSIONS3@ jours) afin de ne pas surcharger le serveur, notamment en cas de SPAM sur le forum.

Dossier stockant les sessions : @_DIR_SESSIONS@

Votre site stocke actuellement @_NB_SESSIONS1@ fichier(s) de session, @_NB_SESSIONS2@ correspondant à des sessions anonymes.', # NEW
	'sessions_anonymes:nom' => 'Sessions anonymes', # NEW
	'set_options:description' => 'Selecciona d\'entrada el tipus d\'interfície privada (simple o avançada) per tots els redactors ja existents o per aquells que poden venir i suprimeix el botó corresponent de la banda on hi ha les icones petites.[[%radio_set_options4%]]', # MODIF
	'set_options:nom' => 'Tipus d\'interfície privada',
	'sf_amont' => 'Més amunt',
	'sf_tous' => 'Tots',
	'simpl_interface:description' => 'Desactiva el menú de canvi ràpid de l\'estat d\'un article passant pel damunt del seu caràcter acolorit. Això és útil si busqueu obtenir una interfície privada el més simple possible per tal d\'optimitzar les prestacions del client. ',
	'simpl_interface:nom' => 'Alleugeriment de la interfície privada',
	'smileys:aide' => 'Emoticones: @liste@',
	'smileys:description' => 'Insereix emoticones a tots els textos on apareix una drecera del tipus <code>:-)</code>. Ideal pels fòrums.
_ Hi ha una etiqueta per mostrar una taula d\'emoticones a les vostres plantilles: #SMILEYS.
_ Dibuixos: [Sylvain Michel->http://www.guaph.net/]',
	'smileys:nom' => 'Emoticones',
	'soft_scroller:description' => 'Ofereix al vostre lloc públic un avançament endolcit de la pàgina quan el visitant fa un clic damunt d\'un enllaç que apunta a una àncora: molt útil per evitar perdre\'s en una pàgina complexa o en un text molt llarg...

Alerta, aquesta eina necessita per funcionar pàgines al «DOCTYPE XHTML» (no HTML!) i dos plugins {jQuery}: {ScrollTo} i {LocalScroll}. El Ganivet Suís els pot instal·lar directament si marqueu les caselles següents.[[%scrollTo%]][[->%LocalScroll%]]
@_CS_PLUGIN_JQUERY192@',
	'soft_scroller:nom' => 'Àncores suaus',
	'sommaire:description' => 'Construeix un resum pel text dels vostres articles i les vostres seccions per tal d\'accedir ràpidament als titulars (balises HTML &lt;@h3@>Un gran títol&lt;/@h3@>) o als subtítols SPIP : subtítols del tipus: (de sintaxi <code>{{{Un subtítol}}}</code>).

Per informació, l\'eina « [.->class_spip] » permet escollir l\'etiqueta &lt;hN> utilitzada pels subtítols d\'SPIP.

@puce@ Podeu definir aquí la profunditat que es tindrà en compte pels subtítols per construir el resum (1 = &lt;@h3@>, 2 = &lt;@h3@> i &lt;@h4@>, etc.):[[%prof_sommaire%]]

@puce@ Definiu aquí el número màxim de caràcters que es tindran en compte pel subtítol:[[%lgr_sommaire% caractères]]

@puce@ Les àncores del resum es poden calcular a partir del títol i no assemblar-se a: {outil_sommaire_NN}. Aquesta opció permet accedir també a la sintaxi <code>{{{Mon titre<mon_ancre>}}}</code> que permet escollir l\'àncora utilitzada.[[%jolies_ancres%]]

@puce@ Fixeu aquí el comportament del connector pel que fa a la creació del resum: 
_ • Sistemàtic per cada article (una etiqueta <code>@_CS_SANS_SOMMAIRE@</code> situada a qualsevol lloc o a l\'interior del text de l\'article crearà una excepció).
_ • Només pels articles que continguin l\'etiqueta <code>@_CS_AVEC_SOMMAIRE@</code>.

[[%auto_sommaire%]]

@puce@ Per defecte, el Ganivet Suís insereix automàticament el resum a la capçalera de l\'article. Però vosaltres teniu la possibilitat de situar-lo a qualsevol indret a dins de la vostra plantilla gràcies a una etiqueta #CS_SOMMAIRE.
[[%balise_sommaire%]]

Aquest resum es compatible amb « [.->decoupe] » i « [.->titres_typo] ».', # MODIF
	'sommaire:nom' => 'Resum automàtic',
	'sommaire_ancres' => 'àncores escollides: <b><html>{{{Mon Titre&lt;mon_ancre&gt;}}}</html></b>', # MODIF
	'sommaire_avec' => 'Un text amb sumari:  <b>@_CS_AVEC_SOMMAIRE@</b>',
	'sommaire_sans' => 'Un text sense sumari: <b>@_CS_SANS_SOMMAIRE@</b>',
	'sommaire_titres' => 'Subtítols jerarquitzats: <b><html>{{{*Titre}}}</html></b>, <b><html>{{{**Sous-titre}}}</html></b>, etc.',
	'spam:description' => 'Intenta lluitar contra els enviaments de missatges automàtics i malèvols a la part pública. Algunes paraules, com les etiquetes en clar &lt;a>&lt;/a>, estan prohibides: animeu als vostres redactors a fer servir les dreceres d\'enllaços en format SPIP.

@puce@ Llisteu aquí les seqüències prohibides separant-les per espais.[[%spam_mots%]]
<q1>• Per una expressió amb espais, poseu-la entre cometes.
_ • Per especificar una paraula sencera, poseu-la entre parèntesi. Exemple~:~{(asses)}.
_ • Per una expressió regular, verifiqueu bé la sintaxi i poseu-la entre barres inclinades i entre cometes.
_ Exemple~:~{<html>\\"/@test.(com|fr)/\\"</html>}.
_ • Per una expressió regular que tingui efecte sobre els caràcters HTML, situeu el test entre «&#» i «;».
_ Exemple~:~{<html>\\"/&#(?:1[4-9][0-9]{3}|[23][0-9]{4});/\\"</html>}.</q1>

@puce@ Algunes adreces IP es poden bloquejar també a la font. Sapigueu, no obstant, que al darrera d\'aquestes adreces (sovint variables), pot haver-hi diversos usuaris, una xarxa sencera.[[%spam_ips%]]
<q1>• Utilitzeu el caràcter «*» per diverses xifres, «?» per només una i els claudàtors per les classes de xifres.</q1>', # MODIF
	'spam:nom' => 'Lluita contra l\'SPAM',
	'spam_ip' => 'Bloqueig IP de @ip@ :',
	'spam_test_ko' => 'Aquest missatge serà bloquejat pel filtre anti-SPAM!',
	'spam_test_ok' => 'Aquest missatge serà acceptat pel filtre anti-SPAM.',
	'spam_tester_bd' => 'Proveu també la vostra base de dades i llisteu els missatges que s\'haurien d\'haver bloquejat amb la configuració actual de l\'eina. ',
	'spam_tester_label' => 'Per tal de testejar la vostra llista de seqüències prohibides o d\'adreces IP, utilitzeu el següent requadre:',
	'spip_cache:description' => '@puce@ La memòria cau ocupa un cert espai de disc i SPIP pot limitar-me la importància. Un valor buit o igual a 0 significa que no s\'aplica cap quota.[[%quota_cache% Mo]]

@puce@ Quan s\'ha fet una modificació del lloc, SPIP invalida immediatament la memòria cau sense esperar el càlcul periòdic següent. Si el vostre lloc té problemes de presentació com a conseqüència d\'una càrrega molt elevada, podeu marcar « non » en aquesta opció. [[%derniere_modif_invalide%]]

@puce@ Si l\'etiqueta #CACHE no es troba als vostres esquelets locals, SPIP considera per defecte que la memòria cau d\'una pàgina té una validesa de 24 hores abans de tornar-la a calcular. Per tal de gestionar millor la càrrega del vostre servidor, podeu modificar aquí aquest valor.[[%duree_cache% heures]]

@puce@ Si teniu diversos llocs mutualitzats, podeu especificar aquí el valor per defecte que es tindrà en compte per tots els llocs locals (SPIP 2.0 mini).[[%duree_cache_mutu% heures]]',
	'spip_cache:description1' => '@puce@ Per defecte, SPIP calcula totes les pàgines públiques i les col·loca a la memòria cau per tal d\'accelerar-ne la consulta. Desactivar temporalment la memòria cau pot ajudar al desenvolupament del lloc Web.[[%radio_desactive_cache3%]]',
	'spip_cache:description2' => '@puce@ Quatre opcions per orientar el funcionament de la memòria cau d\'SPIP : <q1>
_ • {Ús normal}: SPIP calcula totes les pàgines publiques i les posa a la memòria cau per tal d\'accelerar-ne la consulta. Després d\'un cert termini, la memòria cau es calcula de nou i s\'emmagatzema.
_ • {Memòria cau permanent}: els terminis d\'invalidació de la memòria cau s\'ignoren.
_ • {Sense memòria cau}: desactivar temporalment la memòria cau pot ajudar al desenvolupament del lloc Web. Aquí, no s\'emmagatzema res al disc.
_ • {Control de la memòria cau}: opció idèntica a l\'anterior, amb una escriptura al disc de tots els resultats per tal de poder, eventualment, controlar-los.</q1>[[%radio_desactive_cache4%]]',
	'spip_cache:description3' => '@puce@ L\'extensió «Compressor» present a SPIP permet compactar els diferents elements CSS i Javascript de les vostres pàgines i situar-los a dins d\'una memòria cau estàtica. Això accelera la visualització del lloc, i limita el número de crides al servidor i la mida dels fitxer a obtenir. ',
	'spip_cache:nom' => 'SPIP i la memòria cau…',
	'spip_ecran:description' => 'Determina l\'amplada de la pantalla imposada a tots a la part privada. Una pantalla estreta presentarà dues columnes i una pantalla ampla en presentarà tres. ésentera trois. La configuració per defecta deixa que l\'usuari trii, emmagatzemant en una galeta la tria feta.[[%spip_ecran%]]',
	'spip_ecran:nom' => 'Amplada de pantalla',
	'spip_log:description' => '@puce@ Gérez ici les différents paramètres pris en compte par SPIP pour mettre en logs les évènements particuliers du site. Fonction PHP à utiliser : <code>spip_log()</code>.@SPIP_OPTIONS@
[[Ne conserver que %nombre_de_logs% fichier(s), chacun ayant pour taille maximale %taille_des_logs% Ko.<br /><q3>{Mettre à zéro l\'une de ces deux cases désactive la mise en log.}</q3>]][[@puce@ Dossier où sont stockés les logs (laissez vide par défaut) :<q1>%dir_log%{Actuellement :} @DIR_LOG@</q1>]][[->@puce@ Fichier par défaut : %file_log%]][[->@puce@ Extension : %file_log_suffix%]][[->@puce@ Pour chaque hit : %max_log% accès par fichier maximum]]', # NEW
	'spip_log:description2' => '@puce@ Le filtre de gravité de SPIP permet de sélectionner le niveau d\'importance maximal à prendre en compte avant la mise en log d\'une donnée. Un niveau 8 permet par exemple de stocker tous les messages émis par SPIP.[[%filtre_gravite%]][[radio->%filtre_gravite_trace%]]', # NEW
	'spip_log:description3' => '@puce@ Les logs spécifiques au Couteau Suisse s\'activent ici : «[.->cs_comportement]».', # NEW
	'spip_log:nom' => 'SPIP et les logs', # NEW
	'stat_auteurs' => 'Els autors en stat',
	'statuts_spip' => 'Només els statuts SPIP següents:',
	'statuts_tous' => 'Tots els statuts',
	'suivi_forums:description' => 'Un autor d\'un article està sempre informat quan es publica un missatge al fòrum que aquest té associat. Però, a més, també es possible advertir a: tots els participants al fòrum o només als autors dels missatges en endavant.[[%radio_suivi_forums3%]]',
	'suivi_forums:nom' => 'Seguiment dels fòrums públics',
	'supprimer_cadre' => 'Suprimir aquest quadre',
	'supprimer_numero:description' => 'Aplica la funció SPIP supprimer_numero() al conjunt dels {{títols}}, dels {{noms}} i dels {{tipus}} (de paraules-clau) del lloc públic, sense que el filtre supprimer_numero estigui present als esquelets.<br />Heus aquí la sintaxis que cal utilitzar en el marc d\'un lloc multilingue : <code>1. <multi>My Title[fr]Mon Titre[de]El Meu Títol</multi></code>',
	'supprimer_numero:nom' => 'Suprimeix el número',

	// T
	'test_i18n:description' => 'Toutes les chaînes de langue qui ne sont pas internationalisées (donc présentes dans les fichiers lang/*_XX.php) vont apparaitre en rouge.
_ Utile pour n\'en oublier aucune !

@puce@ Un test : ', # NEW
	'test_i18n:nom' => 'Traductions manquantes', # NEW
	'timezone:description' => 'Depuis PHP 5.1.0, chaque appel à une fonction date/heure génère une alerte de niveau E_NOTICE si le décalage horaire n\'est pas valide et/ou une alerte de niveau E_WARNING si vous utilisez des configurations système, ou la variable d\'environnement TZ.
_ Depuis PHP 5.4.0, la variable d\'environnement TZ et les informations disponibles via le système d\'exploitation ne sont plus utilisées pour deviner le décalage horaire.

Réglage actuellement détecté : @_CS_TZ@.

@puce@ {{Définissez ci-dessous le décalage horaire à utiliser sur ce site.}}
[[%timezone%<q3>Liste complète des fuseaux horaires : [->http://www.php.net/manual/fr/timezones.php].</q3>]].', # NEW
	'timezone:nom' => 'Décalage horaire', # NEW
	'titre' => 'El Ganivet Suís',
	'titre_parent:description' => 'Al si d\'un bucle, és corrent voler mostrar el títol del parent de l\'objecte en curs. Tradicionalment, n\'hi hauria prou utilitzant un segon bucle, però aquesta nova etiqueta #TITRE_PARENT alleugerarà l\'escriptura dels vostres esquelets. El resultat que torna és: el títol del grup d\'una paraula clau o el de la secció parenta (si existeix) de qualsevol altre objecte (article, secció, breu, etc.).

Anoteu: Per les paraules clau, un àlies de #TITRE_PARENT és #TITRE_GROUPE. El tractament SPIP d\'aquestes noves etiquetes és similar al de #TITRE.

@puce@ Si treballeu sota SPIP 2.0, llavors teniu aquí, a la vostra disposició, tot un conjunt d\'etiquetes #TITRE_XXX que podran donar-vos el títol de l\'objecte \'xxx\', a condició que el camp \'id_xxx\' estigui present a la taula en curs (#ID_XXX utilitzable en el bucle en curs).

Per exemple, en un bucle sobre (ARTICLES), #TITRE_SECTEUR donarà el títol del sector en el que està situat l\'article en curs, ja que l\'identificador #ID_SECTEUR (o el camp \'id_secteur\') està disponible en aquest cas.

La sintaxi <html>#TITRE_XXX{yy}</html> se suporta igualment. Exemple: <html>#TITRE_ARTICLE{10}</html> retornarà el títol de l\'article #10.[[%titres_etendus%]]',
	'titre_parent:nom' => 'Etiqueta #TITRE_PARENT/OBJET',
	'titre_tests' => 'El Ganivet Suís - Pàgina de proves…',
	'titres_typo:description' => 'Transforma tots els subtítols <html>«{{{El meu subtítol}}}»</html> en imatge tipogràfica amb paràmetres.[[%i_taille% pt]][[%i_couleur%]][[%i_police%

Fonts disponibles : @_CS_FONTS@]][[%i_largeur% px]][[%i_hauteur% pt]][[%i_padding% px]][[%i_align%]]

Aquesta eina és compatible amb: « [.->sommaire] ».',
	'titres_typo:nom' => 'Subtítols en imatge',
	'titres_typographies:description' => 'Par défaut, les raccourcis typographiques de SPIP <html>({, {{, etc.)</html> ne s\'appliquent pas aux titres d\'objets dans vos squelettes.
_ Cet outil active donc l\'application automatique des raccourcis typographiques de SPIP sur toutes les balises #TITRE et apparentées (#NOM pour un auteur, etc.).

Exemple d\'utilisation : le titre d\'un livre cité dans le titre d\'un article, à mettre en italique.', # NEW
	'titres_typographies:nom' => 'Titres typographiés', # NEW
	'tous' => 'Tots',
	'toutes_couleurs' => 'Els 36 colors dels estils CSS :@_CS_EXEMPLE_COULEURS@',
	'toutmulti:aide' => 'Blocs multilingües : <b><:trad:></b>', # MODIF
	'toutmulti:description' => 'De manera semblant al que ja podeu fer en els vostres esquelets, aquesta eina us permet utilitzar lliurement les cadenes de llengües (d\'SPIP o dels vostres esquelets) en tots els continguts del vostre lloc Web (articles, títols, missatges, etc.) amb l\'ajuda de la drecera <code><:chaine:></code>.

Consulteu [aquí ->http://www.spip.net/ca_article2191.html] la documentació d\'SPIP que fa referència a aquest tema.

Aquesta eina accepta igualment els arguments introduïts per SPIP 2.0. Per exemple, la drecera <code><:ma_chaine{nom=Charles Martin, age=37}:></code> permet passar dos paràmetres a la següent cadena: <code>\'ma_chaine\'=>"Bonjour, je suis @nom@ et j\'ai @age@ ans"</code>.

La funció SPIP utilitzada en PHP és <code>_T(\'chaine\')</code> sense argument, i <code>_T(\'chaine\', array(\'arg1\'=>\'un texte\', \'arg2\'=>\'un autre texte\'))</code> amb arguments.

Per tant, no oblideu verificar que la clau  <code>\'chaine\'</code> està ben definida en els fitxers de llengües. ', # MODIF
	'toutmulti:nom' => 'Blocs multilingües',
	'trad_help' => '{{Le Couteau Suisse est bénévolement traduit en plusieurs langues et sa langue mère est le français.}}

N\'hésitez pas à offrir votre contribution si vous décelez quelques soucis dans les textes du plugin. Toute l\'équipe vous en remercie d\'avance.

Pour vous inscrire à l\'espace de traduction : @url@

Pour accéder directement aux traductions des modules du Couteau Suisse, cliquez ci-dessous sur la langue cible de votre choix. Une fois identifié, repérez ensuite le petit crayon qui apparait en survolant le texte traduit puis cliquez dessus.

Vos modifications seront prises en compte quelques jours plus tard sous forme d\'une mise à jour disponible pour le Couteau Suisse. Si votre langue n\'est pas dans la liste, alors le site de traduction vous permettra facilement de la créer.

{{Traductions actuellement disponibles}} :@trad@

{{Merci aux traducteurs actuels}} : @contrib@.', # NEW
	'trad_mod' => 'Module « @mod@ » : ', # NEW
	'travaux_masquer_avert' => 'Amagar el requadre indicant al lloc públic que s\'està fent un manteniment.',
	'travaux_nocache' => 'Désactiver également le cache de SPIP', # NEW
	'travaux_nom_site' => '@_CS_NOM_SITE@',
	'travaux_prochainement' => 'Aquest lloc es restablirà ben aviat.
_ Gràcies per la vostra comprensió.',
	'travaux_titre' => '@_CS_TRAVAUX_TITRE@',
	'tri_articles:description' => 'Podeu personalitzar la navegació a la part privada i quan SPIP ho permet, escolliu aquí la tria que es farà servir per mostrar certs tipus d\'objectes.

Les propostes que hi han més avall estan basades en la funcionalitat SQL \'ORDER BY\': només utilitzeu la opció personalitzada si sabeu què feu (camps disponibles, per exemple, pels articles: {id_article, id_rubrique, titre, soustitre, surtitre, statut, date_redac, date_modif, lang, etc.})

@puce@ {{Ordre dels articles a l\'interior de les seccions}} [[%tri_articles%]][[->%tri_perso%]]

@puce@ {{Ordre dels grups en el formulari per afegir paraules clau}} [[%tri_groupes%]][[->%tri_perso_groupes%]]',
	'tri_articles:nom' => 'Les classificacions d\'SPIP',
	'tri_groupe' => 'Classificació sobre l\'id del grup (ORDER BY id_groupe)',
	'tri_modif' => 'Tria sobre la data de modificació (ORDER BY date_modif DESC)',
	'tri_perso' => 'Tria SQL personalitzada, ORDER BY seguit de:',
	'tri_publi' => 'Tria sobre la data de publicació (ORDER BY date DESC)',
	'tri_titre' => 'Tria sobre el títol (ORDER BY 0+titre,titre)',
	'trousse_balises:description' => 'Eina en curs de desenvolupament. Us ofereix algunes etiquetes molt simples però alhora molt pràctiques per millorar la llegibilitat dels vostres esquelets.

@puce@ {{#BOLO}}: genera un text fals d\'uns 3000 caràcters ("bolo" o "[?lorem ipsum]") a l\'esquelet mentre el posem a punt. L\'argument opcional d\'aquesta funció especifica la llargada que volem del text. Exemple: <code>#BOLO{300}</code>. Aquesta etiqueta accepta tots els filtres d\'SPIP. Exemple : <code>[(#BOLO|majuscules)]</code>.
_ També teniu disponible un model pels vostres continguts: situeu <code><bolo300></code> a qualsevol zona del text (capçalera, descripció, text, etc.) per obtenir 300 caràcters de text fals.

@puce@ {{#MAINTENANT}} (o {{#NOW}}): ens torna simplement la data del moment, com: <code>#EVAL{date(\'Y-m-d H:i:s\')}</code>. L\'argument opcional d\'aquesta funció especifica el format. Exemple : <code>#MAINTENANT{Y-m-d}</code>. Tal i com amb #DATE, personalitzeu la publicació gràcies als filtres d\'SPIP. Exemple: <code>[(#MAINTENANT|affdate)]</code>.

@puce@ {{#CHR<html>{XX}</html>}}: etiqueta equivalent a <code>#EVAL{"chr(XX)"}</code> i pràctica per codificar caràcters especials (el salt de línia, per exemple) o dels caràcters reservats pel compilador d\'SPIP (els claudàtors o les claus).

@puce@ {{#LESMOTS}}: ',
	'trousse_balises:nom' => 'Joc d\'etiquetes',
	'type_urls:description' => '@puce@ SPIP ofereix la possibilitat d\'escollir entre diversos jocs d\'URLs per fabricar els enllaços d\'accés a les pàgines del vostre lloc:

Més informacions a: [->http://www.spip.net/ca_article2237.html]. L\'eina « [.->boites_privees]» us permet veure a la pàgina de cada objecte SPIP el URL pròpia associada.
[[%radio_type_urls3%]]
<q3>@_CS_ASTER@per utilitzar els formats {html}, {propre}, {propre2}, {libres} o {arborescentes}, torneu a copiar el fitxer "htaccess.txt" del directori de base del lloc SPIP amb el nom ".htaccess" (alerta a no esborrar altres ajustos que poguéssiu haver posat a dins d\'aquest fitxer) ; si el vostre lloc està en un "subdirectori", haureu també d\'editar la línia "RewriteBase" a aquest fitxer. Els URLs definit seran dirigits llavors cap els fitxer d\'SPIP.</q3>

<radio_type_urls3 valeur="page">@puce@ {{URLs «page»}} : aquests són els enllaços per defecte que utilitza SPIP a partir de la seva versió 1.9x.
_ Exemple : <code>/spip.php?article123</code>[[%terminaison_urls_page%]][[%separateur_urls_page%]]</radio_type_urls3>

<radio_type_urls3 valeur="html">@puce@ {{URLs «html»}} : els enllaços tenen la forma de les pàgines html clàssiques.
_ Exemple : <code>/article123.html</code></radio_type_urls3>

<radio_type_urls3 valeur="propres">@puce@ {{URLs «propres»}} : els enllaços es calculen gràcies al títol dels objectes demanats. Marcadors (_, -, +, @, etc.) emmarquen els títols en funció del tipus d\'objecte.
_ Exemples : <code>/Mon-titre-d-article</code> ou <code>/-Ma-rubrique-</code> ou <code>/@Mon-site@</code>[[%terminaison_urls_propres%]][[%debut_urls_propres%]][[%marqueurs_urls_propres%]][[%url_max_propres%]]</radio_type_urls3>

<radio_type_urls3 valeur="propres2">@puce@ {{URLs «propres2»}} : l\'extensió \'.html\' s\'afegeix als enllaços {«propis»}.
_ Exemple : <code>/Mon-titre-d-article.html</code> ou <code>/-Ma-rubrique-.html</code>
[[%debut_urls_propres2%]][[%marqueurs_urls_propres2%]][[%url_max_propres2%]]</radio_type_urls3>

<radio_type_urls3 valeur="libres">@puce@ {{URLs «libres»}}: els enllaços són {«propis»}, però sense marcadors que dissociïn els objectes (_, -, +, @, etc.).
_ Exemple : <code>/Mon-titre-d-article</code> ou <code>/Ma-rubrique</code>
[[%terminaison_urls_libres%]][[%debut_urls_libres%]][[%url_max_libres%]]</radio_type_urls3>

<radio_type_urls3 valeur="arbo">@puce@ {{URLs «arborescentes»}} : els enllaços són {«propis»}, però de tipus arborescent.
_ Exemple : <code>/secteur/rubrique1/rubrique2/Mon-titre-d-article</code>
[[%url_arbo_minuscules%]][[%urls_arbo_sans_type%]][[%url_arbo_sep_id%]][[%terminaison_urls_arbo%]][[%url_max_arbo%]]</radio_type_urls3>

<radio_type_urls3 valeur="propres-qs">@puce@ {{URLs «propres-qs»}} : aquest sistema funciona en "Query-String", és a dir sense utilitzar d\'.htaccess; els enllaços són {«propis»}.
_ Exemple : <code>/?Mon-titre-d-article</code>
[[%terminaison_urls_propres_qs%]][[%url_max_propres_qs%]]</radio_type_urls3>

<radio_type_urls3 valeur="propres_qs">@puce@ {{URLs «propres_qs»}} : aquest sistema funciona en "Query-String", és a dir sense la utilització d\'.htaccess ; els enllaços són {«propis»}.
_ Exemple : <code>/?Mon-titre-d-article</code>
[[%terminaison_urls_propres_qs%]][[%marqueurs_urls_propres_qs%]][[%url_max_propres_qs%]]</radio_type_urls3>

<radio_type_urls3 valeur="standard">@puce@ {{URLs «standard»}} : aquests enllaços, a partir d\'ara obsolets, eren utilitzats per SPIP fins a la seva versió 1.8.
_ Exemple : <code>article.php3?id_article=123</code>
</radio_type_urls3>

@puce@ Si utilitzeu el format {page} que hi ha més amunt o si l\'objecte demanat no és reconegut, és possible llavors escollir {{l\'script de crida}} a SPIP. Per defecte, SPIP escull {spip.php}, però {index.php} (exemple de format: <code>/index.php?article123</code>) o un valor buit (format: <code>/?article123</code>) també funcionen. Per qualsevol altre valor, heu de crear forçosament el fitxer corresponent a l\'arrel d\'SPIP, semblant al que ja existeix: {index.php}.
[[%spip_script%]]',
	'type_urls:description1' => '@puce@ Si voleu fer servir un format a base d\'URLs «pròpies» ({propres}, {propres2}, {libres}, {arborescentes} o {propres_qs}), el Ganivet Suís pot:
<q1>• Assegurar-se que l\'URL produïda estigui totalment {{en minúscules}}.</q1>[[%urls_minuscules%]]
<q1>• Provocar l\'afegit sistemàtic de {{l\'id de l\'objecte}} al seu URL (en sufix, en prefix, etc.).
_ (exemples: <code>/El-meu-títol-d-article,457</code> o <code>/457-El-meu-títol-d-article</code>)</q1>',
	'type_urls:description2' => '{Note} : un changement dans ce paragraphe peut nécessiter de vider la table des URLs afin de permettre à SPIP de tenir compte des nouveaux paramètres.', # NEW
	'type_urls:nom' => 'Format dels URLs',
	'typo_exposants:description' => '((Textos francesos)): millora el retorn tipogràfic de les abreviacions corrents, exposant els elements necessaris (així, {<acronym>Mme</acronym>} esdevé {M<sup>me</sup>}) i corregint-ne els errors normals ({<acronym>2ème</acronym>} o  {<acronym>2me</acronym>}, per exemple, esdevenen {2<sup>e</sup>}, única abreviació correcta).

Les abreviacions obtingudes s\'ajusten a les de la Impremta nacional tal com s\'indiquen al {Lèxic de les regles tipogràfiques en ús a la Impremta nacional} (article « Abréviations », presses de l\'Imprimerie nationale, Paris, 2002).

També es tracten les següents expressions: : <html>Dr, Pr, Mgr, m2, m3, Mn, Md, Sté, Éts, Vve, Cie, 1o, 2o, etc.</html> 

Podeu escollir aquí de posar en exponent algunes dreceres suplementàries, malgrat la opinió desfavorable de la Impremta nacional:[[%expo_bofbof%]]

{{Textos anglesos}}: posar en exponent els números ordinals: <html>1st, 2nd</html>, etc.',
	'typo_exposants:nom' => 'Superíndexs',

	// U
	'url_arbo' => 'arborescents@_CS_ASTER@',
	'url_html' => 'html@_CS_ASTER@',
	'url_libres' => 'libres@_CS_ASTER@',
	'url_page' => 'pàgina',
	'url_propres' => 'propres@_CS_ASTER@',
	'url_propres-qs' => 'propres-qs',
	'url_propres2' => 'propres2@_CS_ASTER@',
	'url_propres_qs' => 'propres_qs',
	'url_standard' => 'estàndard',
	'url_verouillee' => 'URL tancat',
	'urls_3_chiffres' => 'Imposar un mínim de 3 xifres',
	'urls_avec_id' => 'Posar-la en sufix ',
	'urls_avec_id2' => 'Posar-la en prefix',
	'urls_base_total' => 'Actualment hi ha @nb@ URL(s) a la base',
	'urls_base_vide' => 'La base dels URLs està buida',
	'urls_choix_objet' => 'Edició en la base del URL d\'un objecte específic:',
	'urls_edit_erreur' => 'El format actual dels URLs (« @type@ ») no permet l\'edició.',
	'urls_enregistrer' => 'Enregistrar aquest URL a la base',
	'urls_id_sauf_rubriques' => 'Excloure els següents objectes (separats per « : »):',
	'urls_minuscules' => 'Lletres minúscules',
	'urls_nouvelle' => 'Editar el URL «propis» principal:',
	'urls_num_objet' => 'Número:',
	'urls_purger' => 'Buidar-ho tot',
	'urls_purger_tables' => 'Buidar les taules seleccionades',
	'urls_purger_tout' => 'Iniciar altre cop els URLs emmagatzemats a la base:',
	'urls_rechercher' => 'Cercar aquest objecte a la base',
	'urls_titre_objet' => 'Títol enregistrat:',
	'urls_type_objet' => 'Objecte:',
	'urls_url_calculee' => 'URL pública « @type@ » :',
	'urls_url_objet' => 'URL(s) «propis» enregistrat(s):',
	'urls_valeur_vide' => '(Un valor buit provoca la supressió d\'URL(s) «propis» enregistrat(s) i després un nou càlcul del URL principal sense tancament).',
	'urls_verrouiller' => '{{Tancar}} per tal que SPIP no modifiqui aquest URL, sobretot després d\'un clic a « @voir@ » o d\'un canvi del títol de l\'objecte.',

	// V
	'validez_page' => 'Per accedir a les modificacions:',
	'variable_vide' => '(Buit)',
	'vars_modifiees' => 'Les dades s\'han modificat correctament',
	'version_a_jour' => 'La vostra versió està al dia.',
	'version_distante' => 'Versió distant...',
	'version_distante_off' => 'Verificació distant desactivada',
	'version_nouvelle' => 'Nova versió: @version@',
	'version_revision' => 'Révisió: @revision@',
	'version_update' => 'Actualització automàtica',
	'version_update_chargeur' => 'Descàrrega automàtica',
	'version_update_chargeur_title' => 'Descarrega la darrera versió del plugin gràcies al plugin «Descarregador»',
	'version_update_title' => 'Descarrega l\'última versió del plugin i començar la seva actualització automàtica',
	'verstexte:description' => '2 filtres pels vostres esquelets, permetent produir pàgines més lleugeres.
_ version_texte: extreu el contingut text d\'una pàgina html excepte algunes etiquetes elementals.
_ version_plein_texte : extreu el contingut text d\'una pàgina html per retornar text brut. ',
	'verstexte:nom' => 'Versió text',
	'visiteurs_connectes:description' => 'Ofereix una petita eina pel vostre esquelet que mostra el número de visitants que hi ha connectats al vostre lloc públic.

Afegiu simplement <code><INCLURE{fond=fonds/visiteurs_connectes}></code> a les vostres pàgines després d\'haver activat les estadístiques del vostre lloc web.',
	'visiteurs_connectes:inactif' => 'Atenció: les estadístiques del lloc no estan activades.',
	'visiteurs_connectes:nom' => 'Visitants connectats',
	'voir' => 'Veure: @voir@',
	'votre_choix' => 'La vostre elecció:',

	// W
	'webmestres:description' => 'Un {{webmestre}} en el sentit d\'SPIP és un {{administrador}} que té accés a l\'espai FTP. Per defecte i a partir d\'SPIP 2.0, és l\'administrador <code>id_auteur=1</code> del lloc. Els webmestres definitis aquí tenen el privilegi de no estar obligats a passar pel FTP per validar les operacions sensibles del lloc, com l\'actualització de la base de dades o la restauració d\'un dump.

Webmestre(s) actual(s): {@_CS_LISTE_WEBMESTRES@}.
_ Administrador(s) elegible(s): {@_CS_LISTE_ADMINS@}.

Vosaltres mateixos, com a webmestres, teniu els drets de modificar aquesta llista d\'ids -- separats pels dos punts « : » si són diversos. Exemple: «1:5:6».[[%webmestres%]]', # MODIF
	'webmestres:nom' => 'Llista de webmestres',

	// X
	'xml:description' => 'Activa el validador xml per l\'espai públic tal i com està descrit a la [documentació->http://www.spip.net/ca_article3577.html]. Un botó anomenat « Anàlisi XML » s\'afegeix als altres botons d\'administració.', # MODIF
	'xml:nom' => 'Validador XML'
);

?>
