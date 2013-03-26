<?php
// This is a SPIP language file  --  Ceci est un fichier langue de SPIP
// extrait automatiquement de http://trad.spip.net/tradlang_module/couteauprive?lang_cible=nl
// ** ne pas modifier le fichier **

if (!defined('_ECRIRE_INC_VERSION')) return;

$GLOBALS[$GLOBALS['idx_lang']] = array(

	// 2
	'2pts_non' => ' : niet',
	'2pts_oui' => ' : ja',

	// S
	'SPIP_liens:description' => '@puce@ begint Alle band van de plaats bij verstek in het lopende venster van scheepvaart. Maar het kan nuttig zijn om de externe band te openen aan de plaats in een nieuw buitenlands venster  dat komt terug om {target toe te voegen =\\"_blank\\"} aan alle bakens &lt;a&gt; voorzien door SPIP van klasse {spip_out}, {spip_url} of {spip_glossaire}. Het is soms noodzakelijk om één van deze klassen toe te voegen aan de band van het skelet van de plaats (bestanden HTML) teneinde deze functionaliteit zoveel mogelijk uit te breiden. [[%radio_target_blank3%]]
@puce@ SPIP maakt het mogelijk om woorden te verbinden met hun definitie dank zij de typografische kortere weg <code> [? woord] </code>. Per gebrek (of als u leegte het hokje hieronder laat), stuurt het externe glossarium naar de vrije encyclopedie wikipedia.org terug. Om het te gebruiken adres te kiezen. <br/>Band van test: [? SPIP] [[%url_glossaire_externe2%]]', # MODIF
	'SPIP_liens:description1' => '<REVIEW>@puce@ SPIP voorziet een CSS stijl voor de «~mailto:~» linken : een briefje komtzich plaatsen voor ieder maillink; aangezien een aantal browsers kunnen die stijl niet aanpassen (o.a. IE6, IE7 et SAF3), besluit hier dit stijl te houden of niet.
_ Testlink : [->test@test.com] (herlaad het hele pagina).[[%enveloppe_mails%]]', # MODIF
	'SPIP_liens:nom' => 'SPIP en de externe band…',
	'SPIP_tailles:description' => '@puce@ Teneinde het geheugen van uw server te verlichten, laat SPIP u toe om de afmetingen (grootte en breedte) en de omvang van het bestand van de beelden, logo\'s of documenten te beperken die met de verschillende inhoud van uw plaats worden samengevoegd. Als een bestand de aangegeven omvang overschrijdt, zal het formulier vele gegevens verzenden maar zij zullen vernietigd worden en SPIP zal er geen rekening mee, noch in de lijst IMG/, noch in database houden. Een waarschuwingsbericht zal dan verzonden worden naar de gebruiker.

Een nul of niet op de hoogte gebrachte waarde stemt met een onbegrensde waarde overeen.
[[Grootte : %img_Hmax% pixels]][[->Breedte : %img_Wmax% pixels]][[->Gewicht van het bestand : %img_Smax% Ko]]
[[Grootte : %logo_Hmax% pixels]][[->Breedte : %logo_Wmax% pixels]][[->Gewicht van het bestand : %logo_Smax% Ko]]
[[Gewicht van het bestand : %doc_Smax% Ko]]

@puce@ Bepaalt hier de maximumruimte die voor de verwijderde bestanden is gereserveerd, die SPIP zou kunnen downloaden en (van server aan server) op uw plaats opslaan. De waarde per gebrek is hier van 16 Mo.[[%copie_Smax% Mo]]

@puce@ Teneinde een overschrijding van geheugen PHP in de behandeling van de grote beelden door de boekhandel GD2 te vermijden, test SPIP de capaciteiten van de server en kan dus weigeren om de te grote beelden te behandelen. Het is mogelijk om désactiver deze test door manueel het maximumaantal van pixels te bepalen die voor de berekeningen worden gedragen.

De waarde van 1~000~000 pixels lijkt juist voor een configuratie met weinig geheugen. Een nul of niet op de hoogte gebrachte waarde zal de test van de server tot gevolg hebben.
[[%img_GDmax% pixels maximum]]', # MODIF
	'SPIP_tailles:nom' => 'Grenzen geheugen',

	// A
	'acces_admin' => 'Toegang beheerders :',
	'action_rapide' => 'Snelle actie, alleen als u weet wat u doet !',
	'action_rapide_non' => 'Vlugge actie, ter beschikking eens dat het instrument is geactiveerd',
	'admins_seuls' => 'Alleen beheerders',
	'aff_tout:description' => 'Il parfois utile d\'afficher toutes les rubriques ou tous les auteurs de votre site sans tenir compte de leur statut (pendant la période de développement par exemple). Par défaut, SPIP n\'affiche en public que les auteurs et les rubriques ayant au moins un élément publié.

Bien qu\'il soit possible de contourner ce comportement à l\'aide du critère [<html>{tout}</html>->http://www.spip.net/fr_article4250.html], cet outil automatise le processus et vous évite d\'ajouter ce critère à toutes les boucles RUBRIQUES et/ou AUTEURS de vos squelettes.', # NEW
	'aff_tout:nom' => 'Affiche tout', # NEW
	'alerte_urgence:description' => 'Affiche en tête de toutes les pages publiques un bandeau d\'alerte pour diffuser le message d\'urgence défini ci-dessous.
_ Les balises <code><multi/></code> sont recommandées en cas de site multilingue.[[%alerte_message%]]', # NEW
	'alerte_urgence:nom' => 'Message d\'alerte', # NEW
	'attente' => 'Wachten...',
	'auteur_forum:description' => 'Zet alle auteurs van openbare berichten ertoe aan om een naam of mailaddress te melden (van minstens een letter!) teneinde de volkomen anonieme bijdragen te vermijden. Dit werktuig bestaat uit een javascript verificatie op het bezoekercomputer.[[%auteur_forum_nom%]][[->%auteur_forum_email%]][[->%auteur_forum_deux%]]
{Let op : de derde keuze maakt de twee eerste ongedaan. Het is belangrijk te controleren of de formuliers van je skeletons  compatibel zijn met dit werktuig.}', # MODIF
	'auteur_forum:nom' => 'Geen onbekende forums',
	'auteur_forum_deux' => 'Of ten minsten een van de twee vorige velden',
	'auteur_forum_email' => 'Het veld «@_CS_FORUM_EMAIL@»',
	'auteur_forum_nom' => 'Het veld «@_CS_FORUM_NOM@»',
	'auteurs:description' => 'Dit werktuig configureert de schijn van [de bladzijde van de auteurs ->./?exec=auteurs], gedeeltelijk particulier.

@puce@ Bepaal hier het maximum aantal auteurs die op het centrale kader van de bladzijde van de auteurs moeten aangegeven worden. Verder is een paginering opgesteld.[[%max_auteurs_page%]]

@puce@ Welke statuten van auteurs kunnen op deze bladzijde op een lijst gezet worden ?
[[%auteurs_tout_voir%[[->%auteurs_0%]][[->%auteurs_1%]][[->%auteurs_5%]][[->%auteurs_6%]][[->%auteurs_n%]]]]', # MODIF
	'auteurs:nom' => 'Bladzijde van de auteurs',
	'autobr:description' => 'Toegepast op bepaalde content SPIP filter {|post_autobr} vervangt alle nieuwe regels met een enkele HTML lijn te breken <br />.[[%alinea%]][[->%alinea2%]]', # MODIF
	'autobr:description1' => 'Rompant avec une tradition historique, SPIP 3 tient désormais compte par défaut des alinéas (retours de ligne simples) dans ses contenus. Vous pouvez ici désactiver ce comportement et revenir à l\'ancien système où le retour de ligne simple n\'est pas reconnu -- à l\'instar du langage HTML.', # NEW
	'autobr:description2' => 'Objets contenant cette balise (non exhaustif) :
- Articles : @ARTICLES@.
- Rubriques : @RUBRIQUES@.
- Forums : @FORUMS@.', # NEW
	'autobr:nom' => 'Automatische regeleinden',
	'autobr_non' => 'Binnen labels &lt;alinea>&lt;/alinea>',
	'autobr_oui' => 'Artikelen en openbare berichten (labels @BALISES@)',
	'autobr_racc' => 'Terug van de line : <b><alinea></alinea></b>', # MODIF

	// B
	'balise_set:description' => 'Afin d\'alléger les écritures du type <code>#SET{x,#GET{x}|un_filtre}</code>, cet outil vous offre le raccourci suivant : <code>#SET_UN_FILTRE{x}</code>. Le filtre appliqué à une variable passe donc dans le nom de la balise.

Exemples : <code>#SET{x,1}#SET_PLUS{x,2}</code> ou <code>#SET{x,avions}#SET_REPLACE{x,ons,ez}</code>.', # NEW
	'balise_set:nom' => 'Balise #SET étendue', # NEW
	'barres_typo_edition' => 'Edition des contenus', # NEW
	'barres_typo_forum' => 'Messages de Forum', # NEW
	'barres_typo_intro' => 'Le plugin «Porte-Plume» a été détecté. Veuillez choisir ici les barres typographiques où certains boutons seront insérés.', # NEW
	'basique' => 'Fundamenteel',
	'blocs:aide' => 'Openvouwen blokken : <b><bloc></bloc></b> (alias : <b><invisible></invisible></b>) et <b><visible></visible></b>',
	'blocs:description' => 'Laat u toe om blokken te creëren waarvan de klikeerbare titel  ze zichtbaar of onzichtbaar kan maken.

@puce@ {{In de SPIP teksten}} : de redacteuren hebben ter beschikking de nieuwe bakens &lt;bloc&gt; (om &lt;invisible&gt;) en &lt;visible&gt; om bij hun teksten zoals dit te gebruiken : 

<quote><code>
<bloc>
 Een titel die klikeerbaar zal worden
 
 Tekst de te verbergen/tonen, na twee sprongen lijn ...
 </bloc>
</code></quote>

@puce@ {{In de sjabloon}} : u hebt tot uw beschikking de nieuwe bakens #BLOC_TITRE, #BLOC_DEBUT et #BLOC_FIN om als dit te gebruiken : 
<quote><code> #BLOC_TITRE om #BLOC_TITRE{mon_URL}
 Mijn titel
 #BLOC_RESUME    (facultatief)
 een samengevatte versie van het blok
 #BLOC_DEBUT
 Mijn openvouwen blok (wie URL gemarkeerd indien noodzakelijk zal bevatten)
 #BLOC_FIN</code></quote>

@puce@ Door «ja» aan te strepen hieronder, zal de opening van een blok de sluiting van alle andere blokken van de bladzijde, veroorzaken teneinde maar één blok tegelijkertijd geopend blijft.[[%bloc_unique%]]

@puce@ Door «ja» aan te strepen hieronder, de stand van de genummeerde bokken zal tidens de sessie in een cookie opgeslaan worden om de aanblik van het pagina gelijk te houden in geval van terug.[[%blocs_cookie%]]

@puce@ De Zwitse Mes (Couteau Suisse) gebruikt standaard het HTML baken &lt;h4&gt; voor de openvouwen blok title. Kies hier voor een andere baak &lt;hN&gt; :[[%bloc_h4%]]

@puce@ Om een zachtere effect te krijgen op het klil, uw openvouwen blokken kunnen op een \\"glijdende manier\\" bewegen.[[%blocs_slide%]][[->%blocs_millisec% millisecondes]]', # MODIF
	'blocs:nom' => 'Openvouwen Blokken',
	'boites_privees:description' => 'Alle beschreven dozen hieronder komen in het particuliere deel voor.[[%cs_rss%]][[->%format_spip%]][[->%stat_auteurs%]][[->%qui_webmasters%]][[->%bp_urls_propres%]][[->%bp_tri_auteurs%]]

- {{De revisies van het Zwitserse Mes}} : een kader op deze bladzijde van configuratie, laatste wijzigingen aangebracht aan de code van plugin  ([Source->@_CS_RSS_SOURCE@]).
- {{De artikelen aan het SPIP formaat}} : een aanvullend opvouwbaar kader voor uw artikelen ten einde de code bron te kennen die door hun auteurs wordt gebruikt.
- {{De auteurs in stat}} : een kader aanvullend op [de bladzijde van de auteurs->./?exec=auteurs] wijst op de  10 laatst aangeslotenen en de niet bevestigde inschrijvingen. Enkel de beheerders zien deze informatie.
- {{De SPIP webmasters}} : een opvouwbare kader op het [auteur\'s pagina->./?exec=auteurs] duit de beheerders aan die ook SPIP webmasters zijn. Allen door beheerders zichtbaar. Was u zelfs webmaster, zie ook het werktuig  « [.->webmestres] ».
- {{"Proper" URLs }}: een opvouwbare kader voor elk onderwerp van inhoud (artikel, rubriek, auteur,…) aangevend URL eigen verenigd alsmede van hen alias eventueel. Het werktuig   [. - >type_urls]   laat u een fijne configuratie van URLs van uw plaats toe.- {{Sorteren van auteurs}} : een opvouwbare kader voor de artikels met meer dan een auteur en die eenvoudig de mogelijkheid geeft ze van verschillende maniers te sorteren.', # MODIF
	'boites_privees:nom' => 'Particuliere dozen',
	'bp_tri_auteurs' => 'Sorteren van auteurs',
	'bp_urls_propres' => 'Eigen URLs ',
	'brouteur:description' => 'Sélecteur van rubriek in AJAX gebruiken vanaf %rubrique_brouteur% rubriek(en)', # MODIF
	'brouteur:nom' => 'Regelen van de rubriek selector ', # MODIF

	// C
	'cache_controle' => 'Controle van het dekblad',
	'cache_nornal' => 'Normaal gebruik',
	'cache_permanent' => 'Permanent dekblad',
	'cache_sans' => 'Geen dekblad',
	'categ:admin' => '1. Administratie',
	'categ:devel' => '55. Développement', # NEW
	'categ:divers' => '60. Diversen',
	'categ:interface' => '10. Interface privée',
	'categ:public' => '40. Openbare display',
	'categ:securite' => '5. Sécurité', # NEW
	'categ:spip' => '50. Bakens, filters, criteria',
	'categ:typo-corr' => '20. Teksten verbeteringen',
	'categ:typo-racc' => '30. Typografische kortere wegen',
	'certaines_couleurs' => 'Enkel de hieronder bepaalde bakens@_CS_ASTER@ :',
	'chatons:aide' => 'Katjes : @liste@',
	'chatons:description' => 'Neemt beelden (of katjes voor {tchats}) op in alle teksten waar een keten van het soort blijkt {{<code>:nom</code>}}.
_ Dit werktuig vervangt deze link door de beelden van dezelfde naam die hij in uw dossier <code>mon_squelette_toto/img/chatons/</code>, ou par défaut, le dossier <code>couteau_suisse/img/chatons/</code> vindt.', # MODIF
	'chatons:nom' => 'Katjes',
	'citations_bb:description' => 'Afin de respecter les usages en HTML dans les contenus SPIP de votre site (articles, rubriques, etc.), cet outil remplace les balises &lt;quote&gt; par des balises &lt;q&gt; quand il n\'y a pas de retour à la ligne. En effet, les citations courtes doivent ?tre entourées par &lt;q&gt; et les citations contenant des paragraphes par &lt;blockquote&gt;.', # MODIF
	'citations_bb:nom' => 'Goed bebakende aanhalingen',
	'class_spip:description1' => 'U kunt hier bepaalde kortere wegen van SPIP bepalen. Een lege waarde staat gelijk om de waarde per gebrek te gebruiken.[[%racc_hr%]]',
	'class_spip:description2' => '@puce@ {{De kortere wegen van SPIP}}.

U kunt hier bepaalde kortere wegen van SPIP bepalen. Een lege waarde staat gelijk om de waarde per gebrek te gebruiken.[[%racc_hr%]][[%puce%]]', # MODIF
	'class_spip:description3' => '

{Let op: of het « [.->pucesli] » werktuig aktief is, het vervangen van de « - » wordt niet meer gedaan; een &lt;ul>&lt;li> lijst wordt dan gebruikt.}

SPIP gebruikt gewoonlijk het baken &lt;h3&gt; voor intertitres. Kies hier een andere vervanging :[[%racc_h1%]][[->%racc_h2%]]', # MODIF
	'class_spip:description4' => '

SPIP heeft verkozen om het baken &lt;strong> te gebruiken om vette letters te schrijven. Maar &lt;b> had eveneens kunnen passen. Aan u om te beslissen :[[%racc_g1%]][[->%racc_g2%]]

SPIP heeft gekozen om &lt;i> te gebruiken om italiques te schrijven. Maar &lt;em> zou ook gekunt hebben, met of zonder stijl.Aan u om te beslissen[[%racc_i1%]][[->%racc_i2%]]

Vous pouvez aussi définir le code ouvrant et fermant pour les appels de notes de bas de pages (Attention ! Les modifications ne seront visibles que sur l\'espace public.) : [[%ouvre_ref%]][[->%ferme_ref%]]
 
 Vous pouvez définir le code ouvrant et fermant pour les notes de bas de pages : [[%ouvre_note%]][[->%ferme_note%]]

@puce@ {{De stijlen van SPIP}}. Tot de versie 1.92 van SPIP, produceerden de typografische kortere wegen bakens systematisch van de stijl \\"spip\\". Bijvoorbeeld : <code><p class=\\"spip\\"></code>. U kunt hier de stijl van deze bakens bepalen in functie van uw bladen van stijl. Een leeg hokje betekent dat geen enkele bijzondere stijl zal toegepast zijn.
{Attention : si certains raccourcis (ligne horizontale, intertitre, italique, gras) ont été modifiés ci-dessus, alors les styles ci-dessous ne seront pas appliqués.}

<q1>
_ {{1.}} Bakens &lt;p&gt;, &lt;i&gt;, &lt;strong&gt;:[[%style_p%]]
_ {{2.}} Bakens &lt;tables&gt;, &lt;hr&gt;, &lt;h3&gt; et &lt;blockquote&gt; en de lijsten (&lt;ol&gt;, &lt;ul&gt;, etc.) :[[%style_h%]]

Opgelet: door deze tweede parameter te wijzigen, verliest u dan de standaardstijlen die met deze bakens worden verenigd.</blockquote>', # MODIF
	'class_spip:nom' => 'SPIP en zijn kortere wegen…',
	'code_css' => 'CSS',
	'code_fonctions' => 'Functies',
	'code_jq' => 'jQuery',
	'code_js' => 'Javascript',
	'code_options' => 'Opties',
	'code_spip_options' => 'Opties SPIP',
	'compacte_css' => 'Compact CSS',
	'compacte_js' => 'Javacript compact',
	'compacte_prive' => 'Niet compact gedeeltelijk prive',
	'compacte_tout' => 'Niet comprimeren op alle (annuleert de vorige opties)',
	'contrib' => 'Meer info : @url@',
	'copie_vers' => 'Copie vers : @dir@', # NEW
	'corbeille:description' => 'SPIP verwijdert automatisch de objecten mis au rebuts na 24 uren, en dit meestal rond 4u \'s morgens, dit dankzij «CRON» (een periodieke en/of een automatische lancering van het voorgeprogrammeerde proces). Hier kunt u het proces verhinderen zodanig dat u beter vat hebt op het beheer van prullenmand.[[%arret_optimisation%]]', # MODIF
	'corbeille:nom' => 'Het mandje',
	'corbeille_objets' => '@nb@ onderwerp(en) in het mandje.',
	'corbeille_objets_lies' => '@nb_lies@ ontdekte(n) verbinding.',
	'corbeille_objets_vide' => 'Geen enkel onderwerp in het mandje', # MODIF
	'corbeille_objets_vider' => 'De geselecteerde onderwerpen afschaffen',
	'corbeille_vider' => 'Het mandje legen :',
	'couleurs:aide' => 'Inzet in kleuren: <b>[coul]tekst[/coul] </b>@fond@ met <b>coul</b> = @liste@',
	'couleurs:description' => 'Maakt het mogelijk om kleuren gemakkelijk toe te passen op alle teksten van de site (artikelen, kort, titels, forum,…) door bakens in kortere wegen te gebruiken.

Twee identieke voorbeelden om de kleur van de tekst te veranderen:@_CS_EXEMPLE_COULEURS2@

Idem om de bodem te veranderen, als de keuze hieronder het toelaat:@_CS_EXEMPLE_COULEURS3@

[[%couleurs_fonds%]]
[[%set_couleurs%]][[-><set_couleurs valeur="1">%couleurs_perso%</set_couleurs>]]
@_CS_ASTER@Het formaat van deze verpersoonlijkte bakens moet bestaande kleuren op een lijst zetten of paren «balise=couleur», bepalen, alles die door komma\'s wordt gescheiden. Voorbeelden. Exemples : «grijs, rood», «zwak=geel, sterk=rood», «beneden=#99CC11, boven=brown» of nog «grijs=#DDDDCC, rood=#EE3300». Voor de eerste en het laatste voorbeeld, zijn de toegelaten bakens : <code>[grijs]</code> en <code>[rood]</code> (<code>[fond grijs]</code> en <code>[fond rood]</code> als de middelen toegestaan zijn).', # MODIF
	'couleurs:nom' => 'Erg in kleuren',
	'couleurs_fonds' => ', <b>[fond coul]text[/coul]</b>, <b>[bg coul]text[/coul]</b>',
	'cs_comportement:description' => '@puce@ {{Logs.}}Vele inlichtingen zijn te verkrijgen over de plugin \'Couteau Suisse (Zwitsers mesje)\' in de folders {spip.log} deze kunt U vinden in het repertoire: {@_CS_DIR_TMP@}[[%log_couteau_suisse%]]

@puce@{{Options SPIP.}} SPIP zet de  plugins in een specifieke orde. Om zeker te zijn dat \'le Couteau Suisse\' in het begin staat en zo enkele SPIP opties automatisch beïnvloedt, moet u de volgende optie aanvinken. Indien de rechten van u server het toestaan, zal de folder{@_CS_FILE_OPTIONS@} automatisch gemodifieerd worden en de volgende folder insluiten {@_CS_DIR_TMP@couteau-suisse/mes_spip_options.php}.
[[%spip_options_on%]]

@puce@ {{Requêtes externes.}} \'Le Couteau Suisse\' verifieert regelmatig het bestaan van een recentere versie en geeft de informatie door waar deze  ter beschikking is. Indien dit een probleem vertoont bij u server probeer dan de volgende link.[[%distant_off%]]', # MODIF
	'cs_comportement:nom' => 'Gedrag van het Zwitserland Mes',
	'cs_comportement_ko' => '{{Note :}} ce paramètre requiert un filtre de gravité réglé à plus de @gr2@ au lieu de @gr1@ actuellement.', # NEW
	'cs_distant_off' => 'De verificaties van verwijderde versies',
	'cs_distant_outils_off' => 'De werktuigen van het Zwitserland Mes die verwijderde bestanden hebben',
	'cs_log_couteau_suisse' => 'Uitvoerige logs van het Zwitserland Mes',
	'cs_reset' => 'Bent u zeker réinitialiser volkomen het Zwitserland Mes te willen?',
	'cs_reset2' => 'Alle actieve werktuigen zullen onwerkzaam gemaakt worden en hun parameters afgezegd.',
	'cs_spip_options_erreur' => 'Attention : la modification du ficher «<html>@_CS_FILE_OPTIONS@</html>» a échoué !', # NEW
	'cs_spip_options_on' => 'De SPIP opties in «@_CS_FILE_OPTIONS@»',

	// D
	'decoration:aide' => 'Versiering : <b>&lt;balise&gt;test&lt;/balise&gt;</b>, met <b>balise</b> = @liste@',
	'decoration:description' => 'Nieuwe lettertype zijn te parametreren in u teksten en toegankelijk dankzij des balises à chevrons. Voorbeeld : 
&lt;mabalise&gt;texte&lt;/mabalise&gt; ou : &lt;mabalise/&gt;.<br />Definier hieronder de CSS die u nodig heeft, une balise per lijn, zoals de hierna volgende syntaxes  :
- {type.mabalise = mon style CSS}
- {type.mabalise.class = ma classe CSS}
- {type.mabalise.lang = ma langue (ex : fr)}
- {unalias = mabalise}

De parameter {type} hieronder kan drie verschillende waarden:
- {span} : balise binnenin een paragraaf(type Inline)
- {div} : balise die een nieuwe paragraaf creërt (type Block)
- {auto} : balise automatisch gedetermineerd door de plugin 

[[%decoration_styles%]]', # MODIF
	'decoration:nom' => 'Versiering',
	'decoupe:aide' => 'Blok tabben : <b>&lt;onglets>&lt;/onglets></b><br/>Séparateur van bladzijdes of tabben : @sep@', # MODIF
	'decoupe:aide2' => 'Alias : @sep@',
	'decoupe:description' => '@puce@ Découpe l\'affichage public d\'un article en plusieurs pages grâce à une pagination automatique. Placez simplement dans votre article quatre signes plus consécutifs (<code>++++</code>) à l\'endroit qui doit recevoir la coupure.

Par défaut, le Couteau Suisse insère la pagination en tête et en pied d\'article automatiquement. Mais vous avez la possibilité de placer cette pagination ailleurs dans votre squelette grâce à une balise #CS_DECOUPE que vous pouvez activer ici :
[[%balise_decoupe%]]

@puce@ Si vous utilisez ce séparateur à l\'intérieur des balises &lt;onglets&gt; et &lt;/onglets&gt; alors vous obtiendrez un jeu d\'onglets.

Dans les squelettes : vous avez à votre disposition les nouvelles balises #ONGLETS_DEBUT, #ONGLETS_TITRE et #ONGLETS_FIN.

Cet outil peut être couplé avec « [.->sommaire] ».', # MODIF
	'decoupe:nom' => 'In bladzijdes en tabben snijden',
	'desactiver_flash:description' => 'Schaft de onderwerpen flash van de bladzijdes van uw plaats af en vervangt ze door de verenigde alternatieve inhoud.',
	'desactiver_flash:nom' => 'De activering terugtrekken van de onderwerpen flash',
	'detail_balise_etoilee' => '{{Aandacht}}: Controleert goed het gebruik dat door uw skeletten van de met sterren bezaaide bakens wordt gemaakt. De behandelingen van dit werktuig zullen niet op van toepassing zijn : @bal@.',
	'detail_disabled' => 'Niet veranderbare parameters :',
	'detail_fichiers' => 'Bestanden :',
	'detail_fichiers_distant' => 'Verwijderde bestanden :',
	'detail_inline' => 'Code inline :',
	'detail_jquery2' => 'Dit werktuig gebruikt de )bibliotheek {jQuery}.',
	'detail_jquery3' => '{{Opgelet}} : deze tool heeft een andere plugin nodig[jQuery pour SPIP 1.92->http://files.spip.org/spip-zone/jquery_192.zip]om efficient te functioneren met deze spip versie.',
	'detail_pipelines' => 'Pijpleidingen :',
	'detail_raccourcis' => 'Voici la liste des raccourcis typographiques reconnus par cet outil.', # NEW
	'detail_spip_options' => '{{Note}} : En cas de dysfonctionnement de cet outil, placez les options SPIP en amont grâce à l\'outil «@lien@».', # NEW
	'detail_spip_options2' => 'Il est recommandé de placer les options SPIP en amont grâce à l\'outil «[.->cs_comportement]».', # NEW
	'detail_spip_options_ok' => '{{Note}} : Cet outil place actuellement des options SPIP en amont grâce à l\'outil «@lien@».', # NEW
	'detail_surcharge' => 'Outil surchargé :', # NEW
	'detail_traitements' => 'Behandelingen :',
	'devdebug:description' => '{{Cet outil vous permet de voir les erreurs PHP à l\'écran.}}<br />Vous pouvez choisir le niveau d\'erreurs d\'exécution PHP qui sera affiché si le débogueur est actif, ainsi que l\'espace SPIP sur lequel ces réglages s\'appliqueront.', # NEW
	'devdebug:item_e_all' => 'Tous les messages d\'erreur (all)', # NEW
	'devdebug:item_e_error' => 'Erreurs graves ou fatales (error)', # NEW
	'devdebug:item_e_notice' => 'Notes d\'exécution (notice)', # NEW
	'devdebug:item_e_strict' => 'Tous les messages + les conseils PHP (strict)', # NEW
	'devdebug:item_e_warning' => 'Avertissements (warning)', # NEW
	'devdebug:item_espace_prive' => 'Espace privé', # NEW
	'devdebug:item_espace_public' => 'Espace public', # NEW
	'devdebug:item_tout' => 'Tout SPIP', # NEW
	'devdebug:nom' => 'Débogueur de développement', # NEW
	'distant_aide' => 'Dit werktuig vereist verwijderde bestanden die allemaal juist in boekhandel geplaatst moeten worden. Alvorens dit werktuig of om dit kader, bij te werken te activeren waarborgt u dat de vereiste bestanden zeer aanwezig zijn op de verwijderde server.',
	'distant_charge' => 'Bestand juist downloaden en geplaatst in boekhandel.',
	'distant_charger' => 'De download lanceren',
	'distant_echoue' => 'De fout op de verwijderde lading, dit werktuig dreigt om niet te werken !',
	'distant_inactif' => 'Onvindbaar bestand (inactief werktuig).',
	'distant_present' => 'Aanwezig bestand in boekhandel sinds @date@.',
	'docgen' => 'Documentation générale', # NEW
	'docwiki' => 'Carnet d\'idées', # NEW
	'dossier_squelettes:description' => 'Wijzigt het dossier van het gebruikte skelet. Bijvoorbeeld: skeletten/mijnskelet. U kunt verschillende dossiers inschrijven door ze te scheiden door beide punten <html> « : »</html>. Door leegte te laten het hokje dat (of door "dist" te typen) volgt, is het originele skelet dat "dist" door SPIP wordt geleverd, dat zal gebruikt worden. [[%dossier_squelettes%]]',
	'dossier_squelettes:nom' => 'Dossier van het skelet',

	// E
	'ecran_activer' => 'Activer l\'écran de sécurité', # NEW
	'ecran_conflit' => 'Attention : le fichier statique «@file@» peut entrer en conflit. Choisissez votre méthode de protection !', # NEW
	'ecran_conflit2' => 'Note : un fichier statique «@file@» a été détecté et activé. Le Couteau Suisse ne pourra le mettre à jour ou le configurer.', # MODIF
	'ecran_ko' => 'Ecran inactif !', # NEW
	'ecran_maj_ko' => 'La version {{@n@}} de l\'écran de sécurité est disponible. Veuillez actualiser le fichier distant de cet outil.', # NEW
	'ecran_maj_ko2' => 'La version @n@ de l\'écran de sécurité est disponible. Vous pouvez actualiser le fichier distant de l\'outil « [.->ecran_securite] ».', # NEW
	'ecran_maj_ok' => '(semble à jour).', # NEW
	'ecran_securite:description' => 'L\'écran de sécurité est un fichier PHP directement téléchargé du site officiel de SPIP, qui protège vos sites en bloquant certaines attaques liées à des trous de sécurité. Ce système permet de réagir très rapidement lorsqu\'un problème est découvert, en colmatant le trou sans pour autant devoir mettre à niveau tout son site ni appliquer un « patch » complexe.

A savoir : l\'écran verrouille certaines variables. Ainsi, par exemple, les  variables nommées <code>id_xxx</code> sont toutes  contrôlées comme étant obligatoirement des valeurs numériques entières, afin d\'éviter toute injection de code SQL via ce genre de variable très courante. Certains plugins ne sont pas compatibles avec toutes les règles de l\'écran, utilisant par exemple <code>&id_x=new</code> pour créer un objet {x}.

Outre la sécurité, cet écran a la capacité réglable de moduler les accès des robots  d\'indexation aux scripts PHP, de manière à leur dire de « revenir plus tard »  lorsque le serveur est saturé.[[ %ecran_actif%]][[->
@puce@ Régler la protection anti-robots quand la charge du serveur (load)  excède la valeur : %ecran_load%
_ {La valeur par défaut est 4. Mettre 0 pour désactiver ce processus.}@_ECRAN_CONFLIT@]]

En cas de mise à jour officielle, actualisez le fichier distant associé (cliquez ci-dessus sur [actualiser]) afin de bénéficier de la protection la plus récente.

- Version du fichier local : ', # NEW
	'ecran_securite:nom' => 'Ecran de sécurité', # NEW
	'effaces' => 'Uitgewist',
	'en_travaux:description' => 'Maakt het mogelijk om een aanpasbaar bericht te geven gedurende een onderhoudfase op de hele openbare site, eventueel ook op het private deel.
[[%message_travaux%]][[%titre_travaux%]][[%admin_travaux%]][[-><admin_travaux valeur="1">%avertir_travaux%</admin_travaux>]][[%prive_travaux%]]', # MODIF
	'en_travaux:nom' => 'Site in werkzaamheden',
	'erreur:bt' => '<span style=\\"color:red;\\">Attention :</span> la barre typographique (version @version@) schijnt oud.<br />Het Zwitsers mes  (Couteau Suisse)stemt overeen met een hogere versie of gelijk aan @mini@.', # MODIF
	'erreur:description' => 'id gebrek hebbend aan in de definitie van het werktuig !',
	'erreur:distant' => 'de verwijderde server',
	'erreur:jquery' => '{{Note}} : de bibliotheek {jQuery} schijnt inactief op deze pagina. Consulteer:[ici->http://www.spip-contrib.net/?article2166] de paragraaf op de \'dépendances\' van de plugin of  herlaad deze pagina.', # MODIF
	'erreur:js' => 'Een fout JavaScript schijnt op deze bladzijde voorgekomen zijn en verhindert zijn goede werking. Gelieve JavaScript op uw navigator activeren om af-activeren sommige plugins SPIP van uw site.',
	'erreur:nojs' => 'JavaScript wordt op deze bladzijde af-activeerd.',
	'erreur:nom' => 'Fout !',
	'erreur:probleme' => 'Zurig probleem : @pb@',
	'erreur:traitements' => 'Het Mes Zwitserland - De compilatie fout van de behandelingen: verboden \'typo\' en \'eigen\' mengeling !',
	'erreur:version' => 'Dit werktuig is niet beschikbaar in deze versie van SPIP.',
	'erreur_groupe' => 'Attention : le groupe «@groupe@» n\'est pas défini !', # NEW
	'erreur_mot' => 'Attention : le mot-clé «@mot@» n\'est pas défini !', # NEW
	'etendu' => 'Uitgestrekt',

	// F
	'f_jQuery:description' => 'Verhindert de installatie van {jQuery} in het openbare deel teneinde economischer te werk te gaan en tijd te besparen. Deze bibliotheek ([- > http://jquery.com/]) brengt talrijke mogelijkheden in de programmering van Javascript en kan door bepaalde plugins gebruikt worden. SPIP gebruikt het in het privé gedeelte.

Opgelet: bepaalde werktuigen van het Zwitserse Mes (couteau suisse) vereisen de functies van {jQuery}.', # MODIF
	'f_jQuery:nom' => 'Inactieve jQuery.',
	'filets_sep:aide' => 'Scheidingsnetten : <b>__i__</b> waar <b>i</b> is een aantal.<br />Andere beschikbare netten : @liste@', # MODIF
	'filets_sep:description' => 'Neemt scheidingsnetten op, aan de persoonlijke behoeften aanpasbaar door bladen van stijl, in alle teksten van SPIP.
_ De syntaxis is : "__code__", waar de code vertegenwoordigt ofwel het identificatienummer (van 0 tot 7) van het net dat in rechtstreeks verband met de overeenkomstige stijlen, ofwel de naam van een beeld moet opgenomen worden dat in het dossier wordt geplaatst plugins/couteau_suisse/img/filets.', # MODIF
	'filets_sep:nom' => 'Scheidingsnetten',
	'filtrer_javascript:description' => 'Om javascript in de artikelen te beheren, zijn drie manieren beschikbaar :
- <i>nooit</i>: javascript wordt overal geweigerd
- <i>het gebrek</i>: javascript is in rood in de privé ruimte aangeduid
- <i>nog steeds</i>: javascript wordt overal aanvaard.

Opgelet: in de forums, petities, georganiseerde stromen, enz., het beleid van javascript wordt <b>altijd</b> veilig gesteld.[[%radio_filtrer_javascript3%]]', # MODIF
	'filtrer_javascript:nom' => 'Beleid van JavaScript',
	'flock:description' => 'Désactiveren het systeem van grendeling van bestanden door de functie PHP {flock()} te neutraliseren. Bepaalde onderdak geeft immers ernstige problemen ten gevolge van een onaangepast systeem van bestanden of een gebrek aan synchronisatie. Activeert niet dit werktuig als uw plaats normaal werkt.',
	'flock:nom' => 'Geen grendeling van bestanden',
	'fonds' => 'Bodem :',
	'forcer_langue:description' => 'Kracht de context van taal voor de spelen van meertalige skeletten die over een formulier of over een menu van talen beschikken die cookie van talen kunnen beheren.', # MODIF
	'forcer_langue:nom' => 'Kracht de taal',
	'format_spip' => 'De artikelen aan het SPIP formaat',
	'forum_lgrmaxi:description' => 'Per gebrek worden de berichten van forum niet in omvang beperkt. Als dit werktuig wordt geactiveerd, zal een bericht van fout zich aangeven wanneer het iemand een bericht van een hogere omvang zal willen opstellen dan de gespecificeerde waarde, en het bericht zal geweigerd worden. Een lege of gelijke waarde aan 0 betekent niettemin dat geen enkele grens van toepassing is.[[%forum_lgrmaxi%]]', # MODIF
	'forum_lgrmaxi:nom' => 'Omvang van de forums',

	// G
	'glossaire:aide' => 'Een tekst zonder verklarende woordenlijst (glossarium) : <b>@_CS_SANS_GLOSSAIRE@</b>',
	'glossaire:description' => '@puce@ Beleid van een intern glossarium in verband met één of meer groepen sleutelwoorden. Schrijft hier de naam van de groepen in door ze te scheiden door beide punten « : ». Door leegte te laten het hokje dat (of door "Glossarium" te typen) volgt, is het de groep "Glossarium" die zal gebruikt worden.[[%glossaire_groupes%]]@puce@ Voor elk woord, hebt u de mogelijkheid om het maximumaantal band te kiezen die in uw teksten wordt gecreëerd. Elke nul of negatieve waarde impliceert dat alle erkende woorden zullen behandeld worden. [[%glossaire_limite% per sleutelwoord]]@puce@ worden Twee oplossingen u aangeboden om het kleine automatische venster te creëren dat bij het overzicht van de muis blijkt.[[%glossaire_js%]]', # MODIF
	'glossaire:nom' => 'Intern glossarium',
	'glossaire_abbr' => 'Ignorer les balises <code><abbr></code> et <code><acronym></code>', # NEW
	'glossaire_css' => 'Oplossing CSS',
	'glossaire_erreur' => 'Le mot «@mot1@» rend indétectable le mot «@mot2@»', # NEW
	'glossaire_inverser' => 'Correction proposée : inverser l\'ordre des mots en base.', # NEW
	'glossaire_js' => 'Oplossing Javascript',
	'glossaire_ok' => 'La liste des @nb@ mot(s) étudié(s) en base semble correcte.', # NEW
	'guillemets:description' => 'Vervangt automatisch de rechte aanhalingstekens (") door de typografische aanhalingstekens van de samenstellingstaal. De vervanging, transparant voor de gebruiker, wijzigt de originele tekst niet maar alleen maar de definitieve display.',
	'guillemets:nom' => 'Typografische aanhalingstekens',

	// H
	'help' => '{{Deze bladzijde is alleen toegankelijk voor de site verantwoordelijken.}} Zij geeft toegang tot de verschillende aanvullende functies die door plugin worden gebracht«{{Le Couteau Suisse}}».', # MODIF
	'help2' => 'Plaatselijke versie : @version@',
	'help3' => '<p>Band van documentatie :<br/>• [Le Couteau Suisse->http://www.spip-contrib.net/?article2166]@contribs@</p><p>Réinitialisatie :
_ • [Verborgen werktuigen|Aan de eerste schijn van deze bladzijde terugkomen->@hide@]
_ • [Van hele plugin|Aan de eerste stand van plugin terugkomen->@reset@]@install@
</p>', # MODIF
	'horloge:description' => 'Outil en cours de développement. Vous offre une horloge JavaScript . Balise : <code>#HORLOGE{format,utc,id}</code>. Modèle : <code><horloge></code>', # MODIF
	'horloge:nom' => 'Klok',

	// I
	'icone_visiter:description' => 'Remplace l\'image du bouton standard « Visiter » (en haut à droite sur cette page)  par le logo du site, s\'il existe.

Pour définir ce logo, rendez-vous sur la page « Configuration du site » en cliquant sur le bouton « Configuration ».', # MODIF
	'icone_visiter:nom' => 'Knoop « Bezoeken »', # MODIF
	'insert_head:description' => 'Actief automatisch het baken [#INSERT_HEAD-> http://www.spip.net/fr_article1902.html] op alle skeletten, dat zij of niet dit baken tussen <head> en </head>. Dank zij deze keuze, zullen plugins van javascript (.js) of de bladen van stijl (.css) kunnen opnemen.', # MODIF
	'insert_head:nom' => 'Baken #INSERT_HEAD',
	'insertions:description' => 'OPGELET: werktuig in ontwikkeling!! [[%insertions%]]',
	'insertions:nom' => 'Automatische correcties',
	'introduction:description' => 'Dit baken dat in de skeletten moet geplaatst worden, dient in het algemeen tot een of in de rubrieken teneinde een samenvatting van de artikelen, van kort te produceren, enz..</p>
<p>{{Opgelet}} : Alvorens deze functionaliteit te activeren, controleert goed dat geen enkele functie {balise_INTRODUCTION ()} bestaat niet reeds in uw plugins skelet , overbelasting zouden dan een fout van compilatie produceren.</p>
@puce@ U kunt (in percent ten opzichte van de waarde die per gebrek wordt gebruikt) de lengte van de tekst aangeven die per baken #INTRODUCTION wordt teruggestuurd. Een nul of gelijke waarde aan 100 wijzigt het aspect van de inleiding niet en gebruikt dus de waarden per gebrek volgend: 500 karakters voor de artikelen, 300 voor kort en 600 voor de forums of de rubrieken.
[[%lgr_introduction%&nbsp;%]]
@puce@ Per gebrek, zijn de punten van vervolg die aan het resultaat van het baken #INTRODUCTION worden toegevoegd, als de tekst te lang is : <html>&laquo;&amp;nbsp;(…)&raquo;</html>. U kunt hier uw eigen keten van carat&egrave;re aangeven die de lezer mededeelt, dat de verminkte tekst goed een vervolg heeft.
[[%suite_introduction%]]
@puce@ Als het baken #INTRODUCTION wordt gebruikt om een artikel kort samen te vatten, dan kan het Mes Zwitserland een band hypertexte op de hierboven bepaalde punten van vervolg vervaardigen teneinde de lezer naar de originele tekst te leiden. Bijvoorbeeld: &laquo;Het vervolg van het artikel lezen…&raquo;
[[%lien_introduction%]]
', # MODIF
	'introduction:nom' => 'Baken #INTRODUCTION',

	// J
	'jcorner:description' => '« Jolis Coins » est un outil permettant de modifier facilement l\'aspect des coins de vos {{cadres colorés}} en partie publique de votre site. Tout est possible, ou presque !
_ Voyez le résultat sur cette page : [->http://www.malsup.com/jquery/corner/].

Listez ci-dessous les objets de votre squelette à arrondir en utilisant la syntaxe CSS (.class, #id, etc. ). Utilisez le le signe « = » pour spécifier la commande jQuery à utiliser et un double slash (« // ») pour les commentaires. En absence du signe égal, des coins ronds seront appliqués (équivalent à : <code>.ma_classe = .corner()</code>).[[%jcorner_classes%]]

Attention, cet outil a besoin pour fonctionner du plugin {jQuery} : {Round Corners}. Le Couteau Suisse peut l\'installer directement si vous cochez la case suivante. [[%jcorner_plugin%]]', # MODIF
	'jcorner:nom' => 'Mooie Hoeken',
	'jcorner_plugin' => '« Round Corners plugin »',
	'jq_localScroll' => 'jQuery.LocalScroll ([demo->http://demos.flesler.com/jquery/localScroll/])',
	'jq_scrollTo' => 'jQuery.ScrollTo ([demo->http://demos.flesler.com/jquery/scrollTo/])',
	'js_defaut' => 'Gebrek',
	'js_jamais' => 'Nooit',
	'js_toujours' => 'Nog steeds',
	'jslide_aucun' => 'Geen animatie',
	'jslide_fast' => 'Snelle verschuiving',
	'jslide_lent' => 'Langzame verschuiving',
	'jslide_millisec' => 'Glijden tijdens :',
	'jslide_normal' => 'Gewone glijden',

	// L
	'label:admin_travaux' => 'De openbare site sluiten voor :',
	'label:alinea' => 'Champ d\'application :', # NEW
	'label:alinea2' => 'Sauf :', # NEW
	'label:alinea3' => 'Désactiver la prise en compte des alinéas :', # NEW
	'label:arret_optimisation' => 'SPIP\'s automatische leegmaken van het vuilnisbak vermijden :',
	'label:auteur_forum_nom' => 'Bezoeker moet aanduiden :',
	'label:auto_sommaire' => 'Systematische oprichting van het overzicht :',
	'label:balise_decoupe' => 'Baken #CS_DECOUPE activeren :',
	'label:balise_sommaire' => 'Het baken #CS_SOMMAIRE activeren :',
	'label:bloc_h4' => 'Baken voor de titels :',
	'label:bloc_unique' => 'Alleen een blok geopend op het pagina :',
	'label:blocs_cookie' => 'Gebruik van de cookies :',
	'label:blocs_slide' => 'Soort animatie :',
	'label:compacte_css' => 'Compression du HEAD :', # NEW
	'label:copie_Smax' => 'Maximumruimte die voor de plaatselijke kopieën is gereserveerd :',
	'label:couleurs_fonds' => 'De middelen toelaten :',
	'label:cs_rss' => 'Activeren :',
	'label:debut_urls_propres' => 'Begin van de URLs :',
	'label:decoration_styles' => 'Uw bakens van verpersoonlijkte stijl :',
	'label:derniere_modif_invalide' => 'Net na een wijziging narekenen :',
	'label:devdebug_espace' => 'Filtrage de l\'espace concerné :', # NEW
	'label:devdebug_mode' => 'Activer le débogage', # NEW
	'label:devdebug_niveau' => 'Filtrage du niveau d\'erreur renvoyé :', # NEW
	'label:distant_off' => 'Désactiver :', # NEW
	'label:doc_Smax' => 'Taille maximale des documents :', # NEW
	'label:dossier_squelettes' => 'Te gebruiken dossier(s) :',
	'label:duree_cache' => 'Duur van het plaatselijke dekblad :',
	'label:duree_cache_mutu' => 'Duur van het dekblad in mutualisatie :',
	'label:enveloppe_mails' => 'Klein briefje voor de mails :',
	'label:expo_bofbof' => 'Mise en exposants pour : <html>St(e)(s), Bx, Bd(s) et Fb(s)</html>', # NEW
	'label:filtre_gravite' => 'Gravité maximale acceptée :', # NEW
	'label:forum_lgrmaxi' => 'Waarde (in karakters) :',
	'label:glossaire_groupes' => 'Gebruikte(n) groep(en) :',
	'label:glossaire_js' => 'Gebruikte techniek :',
	'label:glossaire_limite' => 'Maximumaantal gecreëerde band :',
	'label:i_align' => 'Alignement du texte :', # NEW
	'label:i_couleur' => 'Couleur de la police :', # NEW
	'label:i_hauteur' => 'Hauteur de la ligne de texte (éq. à {line-height}) :', # NEW
	'label:i_largeur' => 'Largeur maximale de la ligne de texte :', # NEW
	'label:i_padding' => 'Espacement autour du texte (éq. à {padding}) :', # NEW
	'label:i_police' => 'Nom du fichier de la police (dossiers {polices/}) :', # NEW
	'label:i_taille' => 'Taille de la police :', # NEW
	'label:img_GDmax' => 'Calculs d\'images avec GD :', # NEW
	'label:img_Hmax' => 'Taille maximale des images :', # NEW
	'label:insertions' => 'Automatische correcties :',
	'label:jcorner_classes' => 'Améliorer les coins des sélecteurs suivantes :', # MODIF
	'label:jcorner_plugin' => 'Aangeduide {jQuery} plugin installeren :',
	'label:jolies_ancres' => 'Calculer de jolies ancres :', # NEW
	'label:lgr_introduction' => 'Lengte van de samenvatting :',
	'label:lgr_sommaire' => 'Breedte van het overzicht (9 à 99) :',
	'label:lien_introduction' => 'Punten van vervolg cliquables :',
	'label:liens_interrogation' => 'URLs beschermen :',
	'label:liens_orphelins' => 'Band cliquables :',
	'label:log_couteau_suisse' => 'Activeren :',
	'label:logo_Hmax' => 'Taille maximale des logos :', # NEW
	'label:long_url' => 'Longueur du libellé cliquable :', # NEW
	'label:marqueurs_urls_propres' => 'Ajouter les marqueurs dissociant les objets (SPIP>=2.0) :<br/>(ex. : « - » pour -Ma-rubrique-, « @ » pour @Mon-site@) ', # MODIF
	'label:max_auteurs_page' => 'Auteurs per bladzijde :',
	'label:message_travaux' => 'Uw bericht van onderhoud :',
	'label:moderation_admin' => 'Valider automatiquement les messages des : ', # NEW
	'label:mot_masquer' => 'Mot-clé masquant les contenus :', # NEW
	'label:nombre_de_logs' => 'Rotation des fichiers :', # NEW
	'label:ouvre_note' => 'Ouverture et fermeture des notes de bas de page', # NEW
	'label:ouvre_ref' => 'Ouverture et fermeture des appels de notes de bas de page', # NEW
	'label:paragrapher' => 'Nog steeds paragraaf :',
	'label:prive_travaux' => 'Bereikbaarheid van hat private deel voor :',
	'label:prof_sommaire' => 'Profondeur retenue (1 à 4) :', # NEW
	'label:puce' => 'Openbare chip «<html>-</html>» :',
	'label:quota_cache' => 'Waarde van de quota :',
	'label:racc_g1' => 'Entrée et sortie de la mise en «<html>{{gras}}</html>» :', # NEW
	'label:racc_h1' => 'Toegang en output van een «<html>{{{intertitel}}}</html>» :',
	'label:racc_hr' => 'Horizontale lijn «<html>----</html>» :',
	'label:racc_i1' => 'Toegang en output van een «<html>{italique}</html>» :', # MODIF
	'label:radio_desactive_cache3' => 'het dekblad deactiveren :', # MODIF
	'label:radio_desactive_cache4' => 'Utilisation du cache :', # NEW
	'label:radio_target_blank3' => 'Nieuw venster voor de externe band :',
	'label:radio_type_urls3' => 'Formaat van URLs :',
	'label:scrollTo' => 'Plaatsen volgend {jQuery} plugins :',
	'label:separateur_urls_page' => 'Caractère de séparation \'type-id\'<br/>(ex. : ?article-123) :', # MODIF
	'label:set_couleurs' => 'Te gebruiken set :',
	'label:spam_ips' => 'Adresses IP à bloquer :', # NEW
	'label:spam_mots' => 'Verboden sequenties :',
	'label:spip_options_on' => 'Inclure :', # NEW
	'label:spip_script' => 'Verzoek script :',
	'label:style_h' => 'Uw stijl :',
	'label:style_p' => 'Uw stijl :',
	'label:suite_introduction' => 'Punten van vervolg :',
	'label:terminaison_urls_page' => 'De uitgang van URls (ex : .html) :', # MODIF
	'label:titre_travaux' => 'Titel van het bericht :',
	'label:titres_etendus' => 'Activer l\'utilisation étendue des balises #TITRE_XXX :', # NEW
	'label:tout_rub' => 'Afficher en public tous les objets suivants :', # NEW
	'label:url_arbo_minuscules' => 'Het breken van de titels in URLs behouden :',
	'label:url_arbo_sep_id' => 'Het scheidingskarakter \'titel-idem\' in geval van doublon: <br/>(niet gebruiken \'/\')', # MODIF
	'label:url_glossaire_externe2' => 'Band naar het externe glossarium :',
	'label:url_max_propres' => 'Longueur maximale des URLs (caractères) :', # NEW
	'label:urls_arbo_sans_type' => 'Het soort onderwerp SPIP in URLs te kennen geven :',
	'label:urls_avec_id' => 'Un id systématique, mais...', # NEW
	'label:webmestres' => 'Lijst van de site\'s webmasters :',
	'liens_en_clair:description' => 'Ter beschikking uw stelt de filter: \'liens_en_clair\'. Uw tekst bevat waarschijnlijk een band hypertexte die niet zichtbaar bij een indruk is. Deze filter voegt tussen haken de bestemming van elke band cliquable (externe band of mails) toe. Opgelet: in manier indruk (parameter \'cs=print\' of \'page=print\' in url van de bladzijde), is deze functionaliteit automatisch toegepast.',
	'liens_en_clair:nom' => 'Band in klaarheid',
	'liens_orphelins:description' => 'Cet outil a deux fonctions :

@puce@ {{Liens corrects}}.

SPIP a pour habitude d\'insérer un espace avant les points d\'interrogation ou d\'exclamation, typo française oblige. Voici un outil qui protège le point d\'interrogation dans les URLs de vos textes.[[%liens_interrogation%]]

@puce@ {{Liens orphelins}}.

Remplace systématiquement toutes les URLs laissées en texte par les utilisateurs (notamment dans les forums) et qui ne sont donc pas cliquables, par des liens hypertextes au format SPIP. Par exemple : {<html>www.spip.net</html>} est remplacé par [->www.spip.net].

Vous pouvez choisir le type de remplacement :
_ • {Basique} : sont remplacés les liens du type {<html>http://spip.net</html>} (tout protocole) ou {<html>www.spip.net</html>}.
_ • {Étendu} : sont remplacés en plus les liens du type {<html>moi@spip.net</html>}, {<html>mailto:monmail</html>} ou {<html>news:mesnews</html>}.
[[%liens_orphelins%]]', # MODIF
	'liens_orphelins:description1' => '[[Si l\'URL rencontrée dépasse les %long_url% caractères, alors SPIP la réduit à %coupe_url% caractères]].', # NEW
	'liens_orphelins:nom' => 'Mooi URLs',
	'local_ko' => 'La mise à jour automatique du fichier local «@file@» a échoué. Si l\'outil dysfonctionne, tentez une mise à jour manuelle.', # NEW
	'log_brut' => 'Données écrites en format brut (non HTML)', # NEW
	'log_fileline' => 'Informations supplémentaires de débogage', # NEW

	// M
	'mailcrypt:description' => 'Masque tous les liens de courriels présents dans vos textes en les remplaçant par un lien Javascript permettant quand même d\'activer la messagerie du lecteur. Cet outil antispam tente d\'empêcher les robots de collecter les adresses électroniques laissées en clair dans les forums ou dans les balises de vos squelettes.', # MODIF
	'mailcrypt:nom' => 'MailCrypt',
	'mailcrypt_balise_email' => 'Traiter également la balise #EMAIL de vos squelettes', # NEW
	'mailcrypt_fonds' => 'Ne pas protéger les fonds suivants :<br /><q4>{Séparez-les par les deux points «~:~» et vérifiez bien que ces fonds restent totalement inaccessibles aux robots du Net.}</q4>', # NEW
	'maj_actualise_ok' => 'Le plugin « @plugin@ » n\'a pas officiellement changé de version, mais ses fichiers ont quand même été actualisés afin de bénéficier de la dernière révision de code.', # NEW
	'maj_auto:description' => 'Cet outil vous permet de gérer facilement la mise à jour de vos différents plugins, récupérant notamment le numéro de révision contenu dans le fichier <code>svn.revision</code> et le comparant avec celui trouvé sur <code>zone.spip.org</code>.

La liste ci-dessus offre la possibilité de lancer le processus de mise à jour automatique de SPIP sur chacun des plugins préalablement installés dans le dossier <code>plugins/auto/</code>. Les autres plugins se trouvant dans le dossier <code>plugins/</code> sont simplement listés à titre d\'information. Si la révision distante n\'a pas pu être trouvée, alors tentez de procéder manuellement à la mise à jour du plugin.

Note : les paquets <code>.zip</code> n\'étant pas reconstruits instantanément, il se peut que vous soyez obligé d\'attendre un certain délai avant de pouvoir effectuer la totale mise à jour d\'un plugin tout récemment modifié.', # MODIF
	'maj_auto:nom' => 'Mises à jour automatiques', # NEW
	'maj_fichier_ko' => 'Le fichier « @file@ » est introuvable !', # NEW
	'maj_librairies_ko' => 'Librairies introuvables !', # NEW
	'masquer:description' => 'Cet outil permet de masquer sur le site public et sans modification particulière de vos squelettes, les contenus (rubriques ou articles) qui ont le mot-clé défini ci-dessous. Si une rubrique est masquée, toute sa branche l\'est aussi.[[%mot_masquer%]]

Pour forcer l\'affichage des contenus masqués, il suffit d\'ajouter le critère <code>{tout_voir}</code> aux boucles de votre squelette.', # NEW
	'masquer:nom' => 'Masquer du contenu', # NEW
	'meme_rubrique:description' => 'Définissez ici le nombre d\'objets listés dans le cadre nommé «<:info_meme_rubrique:>» et présent sur certaines pages de l\'espace privé.[[%meme_rubrique%]]', # NEW
	'message_perso' => 'Groot dank aan de vertalers die hierdoor komen lopen. Pat ;-)',
	'moderation_admins' => 'administrateurs authentifiés', # NEW
	'moderation_message' => 'Ce forum est modéré à priori : votre contribution n\'apparaîtra qu\'après avoir été validée par un administrateur du site, sauf si vous êtes identifié et autorisé à poster directement.', # NEW
	'moderation_moderee:description' => 'Permet de modérer la modération des forums pour les utilisateurs inscrits. [[%moderation_admin%]][[-->%moderation_redac%]][[-->%moderation_visit%]]', # MODIF
	'moderation_moderee:nom' => 'Modération modérée', # NEW
	'moderation_redacs' => 'rédacteurs authentifiés', # NEW
	'moderation_visits' => 'visiteurs authentifiés', # NEW
	'modifier_vars' => 'Dit @nb@ parameters wijzigen',
	'modifier_vars_0' => 'Modifier ces paramètres', # NEW

	// N
	'no_IP:description' => 'Deactiveer het bezoekers IP adressen automatische registratie van uw site uit zorg voor vertrouwelijkheid: SPIP zal dan geen enkel nummer meer IP, noch tijdelijk bij de bezoeken (behouden om de statistieken te beheren of spip.log te voeden), noch in de forums (verantwoordelijkheid).',
	'no_IP:nom' => 'Geen IP opslag',
	'nouveaux' => 'Nieuw',

	// O
	'orientation:description' => '3 nieuwe criteria voor uw skeletten: <code>{portret}</code>, <code>{vierkant}</code> en <code>{landschap}</code>. Ideaal voor de foto\'s indeling in functie van hun vorm.',
	'orientation:nom' => 'De beelden oriëntatie',
	'outil_actif' => 'Actief werktuig',
	'outil_actif_court' => 'actif', # NEW
	'outil_activer' => 'Activeren',
	'outil_activer_le' => 'Het werktuig activeren',
	'outil_actualiser' => 'Actualiser l\'outil', # NEW
	'outil_cacher' => 'Niet meer aangeven',
	'outil_desactiver' => 'Buiten dienst zetten.',
	'outil_desactiver_le' => 'het werktuig buiten dienst zetten.',
	'outil_inactif' => 'Inactief werktuig',
	'outil_intro' => 'Deze bladzijde zet de functies van plugin op een lijst die uw ter beschikking worden gesteld.<br /><br />Door op de naam van de werktuigen te klikken hieronder, selecteert u degenen waarvan zult kunnen verwisselen u de stand met behulp van de centrale knoop: de geactiveerde werktuigen désactivés en <i>vice versa</i>. Aan elke klik, blijkt de beschrijving onder de lijsten. De categorieën zijn opvouwbaar en de werktuigen kunnen verborgen worden. Het dubbele-Voor een eerste gebruik, wordt hij aanbevolen om de werktuigen één voor één te activeren, ingeval zeker de onverenigbaarheden met uw skelet, SPIP of anderen plugins zouden blijkenklik maakt het mogelijk om een werktuig snel te verwisselen.<br /><br />.<br /><br />Nota : de eenvoudige lading van deze bladzijde compileert het geheel van de werktuigen van het Zwitserland Mes opnieuw.', # MODIF
	'outil_intro_old' => 'Deze interface is oud.<br /><br />Als u problemen in het gebruik van <a href=\' ./? exec=admin_couteau_suisse\'> nieuwe interface ondervindt</a>, aarzelt niet aandeel ervan doen over het forum van <a href=\'http://www.spip-contrib.net/?article2166\'>Spip-Contrib</a>.',
	'outil_nb' => '@pipe@ : @nb@ werktuig', # MODIF
	'outil_nbs' => '@pipe@ : @nb@ werktuigen', # MODIF
	'outil_permuter' => 'Het werktuig verwisselen : « @text@ » ?',
	'outils_actifs' => 'Actieve werktuigen :',
	'outils_caches' => 'Verborgen werktuigen :',
	'outils_cliquez' => 'Klikt op de naam van de werktuigen hierboven om hun beschrijving hier te kennen te geven.',
	'outils_concernes' => 'Sont concernés : ', # NEW
	'outils_desactives' => 'Sont désactivés : ', # NEW
	'outils_inactifs' => 'Inactief werktuig :',
	'outils_liste' => 'Lijst van de werktuigen van het Mes Zwitserland',
	'outils_non_parametrables' => 'Non paramétrables :', # NEW
	'outils_permuter_gras1' => 'De werktuigen in vet verwisselen',
	'outils_permuter_gras2' => '@nb@ werktuigen in vet verwisselen ?',
	'outils_resetselection' => 'De selectie erinitiëren',
	'outils_selectionactifs' => 'Alle actieve werktuigen selecteren',
	'outils_selectiontous' => 'IEDEREEN',

	// P
	'pack_actuel' => 'Pack @date@',
	'pack_actuel_avert' => 'Attention, les surcharges sur les define() ou les globales ne sont pas spécifiées ici', # MODIF
	'pack_actuel_titre' => 'HUIDIGE CONFIGURATIE PACK VAN HET ZWITSE MES',
	'pack_alt' => 'Zie de lopende parameters van configuratie',
	'pack_delete' => 'Supression d\'un pack de configuration', # NEW
	'pack_descrip' => 'Uw huidige configuratie Pakijs verzamelt het geheel van de lopende configuratie parameters betreffende van het Mes Zwitserland: de activering van de werktuigen en de waarde van hun eventuele variabele.

Deze PHP code kan plaats in het bestand /config/mes_options.php nemen en zal een band van réinitialisatie op deze bladzijde van het pakijs {Pakijs Huidige} toevoegen. Natuurlijk is het u mogelijk om zijn naam hieronder te veranderen.

Als u plugin réinitialiserd door op een pakijs te klikken, reconfiguratie van het Zwitserland mes  automatisch in functie van het pakijs voor bepaald parameters.', # MODIF
	'pack_du' => '• van het pakijs @pack@', # MODIF
	'pack_installe' => 'Het invoeren van een configuratie pakijs',
	'pack_installer' => 'Êtes-vous sûr de vouloir réinitialiser le Couteau Suisse et installer le pack « @pack@ » ?', # NEW
	'pack_nb_plrs' => 'Il y a actuellement @nb@ « packs de configuration » disponibles.', # MODIF
	'pack_nb_un' => 'Er is een « configuration pack » momenteel beschikbaar', # MODIF
	'pack_nb_zero' => 'Er is geen « configuration pack » momenteel beschikbaar.',
	'pack_outils_defaut' => 'Installation des outils par défaut', # NEW
	'pack_sauver' => 'Huidige configuratie opslaan',
	'pack_sauver_descrip' => 'Le bouton ci-dessous vous permet d\'insérer directement dans votre fichier <b>@file@</b> les paramètres nécessaires pour ajouter un « pack de configuration » dans le menu de gauche. Ceci vous permettra ultérieurement de reconfigurer en un clic votre Couteau Suisse dans l\'état où il est actuellement.', # NEW
	'pack_supprimer' => 'Êtes-vous sûr de vouloir supprimer le pack « @pack@ » ?', # NEW
	'pack_titre' => 'Huidige configuratie',
	'pack_variables_defaut' => 'Installation des variables par défaut', # NEW
	'par_defaut' => 'Per gebrek',
	'paragrapher2:description' => 'De <code>paragrapher()</code> SPIP functie neemt bakens <p> en </p> in alle teksten die zonder paragrafen zijn. Teneinde fijner uw stijlen en uw opmaak te beheren, hebt u de mogelijkheid om het aspect van de teksten van uw site uniform te maken.',
	'paragrapher2:nom' => 'Paragraaf',
	'pipelines' => 'Gebruikte pijpleidingen :',
	'previsualisation:description' => 'Par défaut, SPIP permet de prévisualiser un article dans sa version publique et stylée, mais uniquement lorsque celui-ci a été « proposé à l’évaluation ». Hors cet outil permet aux auteurs de prévisualiser également les articles pendant leur rédaction. Chacun peut alors prévisualiser et modifier son texte à sa guise.



@puce@ Attention : cette fonctionnalité ne modifie pas les droits de prévisualisation. Pour que vos rédacteurs aient effectivement le droit de prévisualiser leurs articles « en cours de rédaction », vous devez l’autoriser (dans le menu {[Configuration&gt;Fonctions avancées->./?exec=config_fonctions]} de l’espace privé).', # MODIF
	'previsualisation:nom' => 'Prévisualisation des articles', # NEW
	'puceSPIP' => 'Autoriser le raccourci «*»', # NEW
	'puceSPIP_aide' => 'Une puce SPIP : <b>*</b>', # NEW
	'pucesli:description' => 'Vervangt de chips «-» (eenvoudig koppelteken) van de artikelen door genoteerde lijsten «-*» (in HTML door worden vertaald: &lt;ul>&lt;li>…&lt;/li>&lt;/ul>) en waarvan de stijl per css verpersoonlijkt kan worden.', # MODIF
	'pucesli:nom' => 'Mooie chips',

	// Q
	'qui_webmestres' => 'De SPIP Webmasters',

	// R
	'raccourcis' => 'Actieve typografische kortere wegen van het Mes Zwitserland :',
	'raccourcis_barre' => 'De typografische kortere wegen van het Mes Zwitserland',
	'rafraichir' => 'Afin de terminer la configuration du plugin, merci d\'actualiser la page courante.', # NEW
	'reserve_admin' => 'Toegang die voor de beheerders is gereserveerd.',
	'rss_actualiser' => 'Actualiseren',
	'rss_attente' => 'Wachten RSS...',
	'rss_desactiver' => '« de Revisies van het Mes Zwitserland » deactiveren ',
	'rss_edition' => 'Flux RSS worden bijgewerkt die :',
	'rss_source' => 'Source RSS', # NEW
	'rss_titre' => '« Het Zwitserland Mes » in ontwikkeling :',
	'rss_var' => 'De revisies van het Zwitserland Mes',

	// S
	'sauf_admin' => 'Iedereen, behalve de beheerders',
	'sauf_admin_redac' => 'Allemaal behalve beheerders en redacteurs',
	'sauf_identifies' => 'Tous, sauf les auteurs identifiés', # NEW
	'sessions_anonymes:description' => 'Chaque semaine, cet outil vérifie les sessions anonymes et supprime les fichiers qui sont trop anciens (plus de @_NB_SESSIONS3@ jours) afin de ne pas surcharger le serveur, notamment en cas de SPAM sur le forum.

Dossier stockant les sessions : @_DIR_SESSIONS@

Votre site stocke actuellement @_NB_SESSIONS1@ fichier(s) de session, @_NB_SESSIONS2@ correspondant à des sessions anonymes.', # NEW
	'sessions_anonymes:nom' => 'Sessions anonymes', # NEW
	'set_options:description' => 'Selecteert automatisch het soort particuliere interface (vereenvoudigd of geavanceerd) voor alle redacteuren reeds bestaand of om te komen en schaft de kleine ikonen hoofdband overeenkomstige af.[[%radio_set_options4%]]', # MODIF
	'set_options:nom' => 'Soort particuliere interface',
	'sf_amont' => 'Voorafgaand',
	'sf_tous' => 'Iedereen',
	'simpl_interface:description' => 'Deactiveer het menu van snelle statuut verandering van een artikel aan het overzicht van zijn kleurrijke chip. Dat is nuttig als u probeert om het meest ontdaan mogelijke van particuliere een interface te verkrijgen ten einde de prestaties klant te optimaliseren.',
	'simpl_interface:nom' => 'Vermindering van de particuliere interface',
	'smileys:aide' => 'Smileys : @liste@',
	'smileys:description' => 'Insère des smileys dans tous les textes où apparaît un raccourci du genre <acronym>:-)</acronym>. Idéal pour les  forums.
_ Une balise est disponible pour aficher un tableau de smileys dans vos squelettes : #SMILEYS.
_ Dessins : [Sylvain Michel->http://www.guaph.net/]', # MODIF
	'smileys:nom' => 'Smileys',
	'soft_scroller:description' => 'Offre à votre site public un défilement  adouci de la page lorsque le visiteur clique sur un lien pointant vers une ancre : très utile pour éviter de se perdre dans une page complexe ou un texte très long...

Attention, cet outil a besoin pour fonctionner de pages au «DOCTYPE XHTML» (non HTML !) et de deux plugins {jQuery} : {ScrollTo} et {LocalScroll}. Le Couteau Suisse peut les installer directement si vous cochez les cases suivantes. [[%scrollTo%]][[-->%LocalScroll%]]
@_CS_PLUGIN_JQUERY192@', # MODIF
	'soft_scroller:nom' => 'Zachte ankers',
	'sommaire:description' => 'Construit un sommaire pour le texte de vos articles et de vos rubriques afin d’accéder rapidement aux gros titres (balises HTML &lt;h3>Un intertitre&lt;/h3> ou raccourcis SPIP : intertitres de la forme :<code>{{{Un gros titre}}}</code>).

@puce@ Vous pouvez définir ici le nombre maximal de caractères retenus des intertitres pour construire le sommaire :[[%lgr_sommaire% caractères]]

@puce@ Vous pouvez aussi fixer le comportement du plugin concernant la création du sommaire: 
_ • Systématique pour chaque article (une balise <code>@_CS_SANS_SOMMAIRE@</code> placée n’importe où à l’intérieur du texte de l’article créera une exception).
_ • Uniquement pour les articles contenant la balise <code>@_CS_AVEC_SOMMAIRE@</code>.

[[%auto_sommaire%]]

@puce@ Par défaut, le Couteau Suisse insère le sommaire en tête d\'article automatiquement. Mais vous avez la possibilité de placer ce sommaire ailleurs dans votre squelette grâce à une balise #CS_SOMMAIRE que vous pouvez activer ici :
[[%balise_sommaire%]]

Ce sommaire peut être couplé avec : « [.->decoupe] ».', # MODIF
	'sommaire:nom' => 'Een overzicht voor uw artikelen', # MODIF
	'sommaire_ancres' => 'Ancres choisies : <b><html>{{{Mon Titre<mon_ancre>}}}</html></b>', # NEW
	'sommaire_avec' => 'Een artikel met overzicht : <b>@_CS_AVEC_SOMMAIRE@</b>',
	'sommaire_sans' => 'Een artikel zonder overzicht : <b>@_CS_SANS_SOMMAIRE@</b>',
	'sommaire_titres' => 'Intertitres hiérarchisés : <b><html>{{{*Titre}}}</html></b>, <b><html>{{{**Sous-titre}}}</html></b>, etc.', # NEW
	'spam:description' => 'Tente de lutter contre les envois de messages automatiques et malveillants en partie publique. Certains mots et les balises &lt;a>&lt;/a> sont interdits.



Listez ici les séquences interdites@_CS_ASTER@ en les séparant par des espaces. [[%spam_mots%]]

@_CS_ASTER@Pour spécifier un mot entier, mettez-le entre paranthèses. Pour une expression avec des espaces, placez-la entre guillemets.', # MODIF
	'spam:nom' => 'SPAM Bestrijding',
	'spam_ip' => 'Blocage IP de @ip@ :', # NEW
	'spam_test_ko' => 'Dit boodschap zou door het anti-SPAM filter gezeeft worden !',
	'spam_test_ok' => 'Dit boodschap zou door het anti-SPAM filter goedgekeurd worden.',
	'spam_tester_bd' => 'Testez également votre votre base de données et listez les messages qui auraient été bloqués par la configuration actuelle de l\'outil.', # NEW
	'spam_tester_label' => 'Proef hier uw lijst van verboden teksten :', # MODIF
	'spip_cache:description' => '@puce@ Par défaut, SPIP calcule toutes les pages publiques et les place dans le cache afin d\'en accélérer la consultation. Désactiver temporairement le cache peut aider au développement du site.[[%radio_desactive_cache3%]]@puce@ Le cache occupe un certain espace disque et SPIP peut en limiter l\'importance. Une valeur vide ou égale à 0 signifie qu\'aucun quota ne s\'applique.[[%quota_cache% Mo]]@puce@ Si la balise #CACHE n\'est pas trouvée dans vos squelettes locaux, SPIP considère par défaut que le cache d\'une page a une durée de vie de 24 heures avant de la recalculer. Afin de mieux gérer la charge de votre serveur, vous pouvez ici modifier cette valeur.[[%duree_cache% heures]]@puce@ Si vous avez plusieurs sites en mutualisation, vous pouvez spécifier ici la valeur par défaut prise en compte par tous les sites locaux (SPIP 1.93).[[%duree_cache_mutu% heures]]', # MODIF
	'spip_cache:description1' => '@puce@ Par défaut, SPIP calcule toutes les pages publiques et les place dans le cache afin d\'en accélérer la consultation. Désactiver temporairement le cache peut aider au développement du site. @_CS_CACHE_EXTENSION@[[%radio_desactive_cache3%]]', # MODIF
	'spip_cache:description2' => '@puce@ Quatre options pour orienter le fonctionnement du cache de SPIP : <q1>
_ • {Usage normal} : SPIP calcule toutes les pages publiques et les place dans le cache afin d\'en accélérer la consultation. Après un certain délai, le cache est recalculé et stocké.
_ • {Cache permanent} : les délais d\'invalidation du cache sont ignorés.
_ • {Pas de cache} : désactiver temporairement le cache peut aider au développement du site. Ici, rien n\'est stocké sur le disque.
_ • {Contrôle du cache} : option identique à la précédente, avec une écriture sur le disque de tous les résultats afin de pouvoir éventuellement les contrôler.</q1>[[%radio_desactive_cache4%]]', # MODIF
	'spip_cache:description3' => '@puce@ L\'extension « Compresseur » présente dans SPIP permet de compacter les différents éléments CSS et Javascript de vos pages et de les placer dans un cache statique. Cela accélère l\'affichage du site, et limite le nombre d\'appels sur le serveur et la taille des fichiers à obtenir.', # NEW
	'spip_cache:nom' => 'SPIP en het dekblad…',
	'spip_ecran:description' => 'Détermine la largeur d\'écran imposée à tous en partie privée. Un écran étroit présentera deux colonnes et un écran large en présentera trois. Le réglage par défaut laisse l\'utilisateur choisir, son choix étant stocké dans un cookie.[[%spip_ecran%]]', # NEW
	'spip_ecran:nom' => 'Largeur d\'écran', # NEW
	'spip_log:description' => '@puce@ Gérez ici les différents paramètres pris en compte par SPIP pour mettre en logs les évènements particuliers du site. Fonction PHP à utiliser : <code>spip_log()</code>.@SPIP_OPTIONS@
[[Ne conserver que %nombre_de_logs% fichier(s), chacun ayant pour taille maximale %taille_des_logs% Ko.<br /><q3>{Mettre à zéro l\'une de ces deux cases désactive la mise en log.}</q3>]][[@puce@ Dossier où sont stockés les logs (laissez vide par défaut) :<q1>%dir_log%{Actuellement :} @DIR_LOG@</q1>]][[->@puce@ Fichier par défaut : %file_log%]][[->@puce@ Extension : %file_log_suffix%]][[->@puce@ Pour chaque hit : %max_log% accès par fichier maximum]]', # NEW
	'spip_log:description2' => '@puce@ Le filtre de gravité de SPIP permet de sélectionner le niveau d\'importance maximal à prendre en compte avant la mise en log d\'une donnée. Un niveau 8 permet par exemple de stocker tous les messages émis par SPIP.[[%filtre_gravite%]][[radio->%filtre_gravite_trace%]]', # NEW
	'spip_log:description3' => '@puce@ Les logs spécifiques au Couteau Suisse s\'activent ici : «[.->cs_comportement]».', # NEW
	'spip_log:nom' => 'SPIP et les logs', # NEW
	'stat_auteurs' => 'De auteurs in stat',
	'statuts_spip' => 'Alleen de volgende SPIP statuten :',
	'statuts_tous' => 'Alle statuten',
	'suivi_forums:description' => 'Un auteur d\'article est toujours informé lorsqu\'un message est publié dans le forum public associé. Mais il est aussi possible d\'avertir en plus : tous les participants au forum ou seulement les auteurs de messages en amont.[[%radio_suivi_forums3%]]', # NEW
	'suivi_forums:nom' => 'Opvolging van de openbare forums',
	'supprimer_cadre' => 'Dit kader afschaffen',
	'supprimer_numero:description' => 'Applique la fonction SPIP supprimer_numero() à l\'ensemble des {{titres}} et des {{noms}} du site public, sans que le filtre supprimer_numero soit présent dans les squelettes.<br />Voici la syntaxe à utiliser dans le cadre d\'un site multilingue : <code>1. <multi>My Title[fr]Mon Titre[de]Mein Titel</multi></code>', # MODIF
	'supprimer_numero:nom' => 'Schaft het nummer af',

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
	'titre' => 'Het Zwitserland Mes',
	'titre_parent:description' => 'Au sein d\'une boucle, il est courant de vouloir afficher le titre du parent de l\'objet en cours. Traditionnellement, il suffirait d\'utiliser une seconde boucle, mais cette nouvelle balise #TITRE_PARENT allégera l\'écriture de vos squelettes. Le résultat renvoyé est : le titre du groupe d\'un mot-clé ou celui de la rubrique parente (si elle existe) de tout autre objet (article, rubrique, brève, etc.).

Notez : Pour les mots-clés, un alias de #TITRE_PARENT est #TITRE_GROUPE. Le traitement SPIP de ces nouvelles balises est similaire à celui de #TITRE.

@puce@ Si vous êtes sous SPIP 2.0, alors vous avez ici à votre disposition tout un ensemble de balises #TITRE_XXX qui pourront vous donner le titre de l\'objet \'xxx\', à condition que le champ \'id_xxx\' soit présent dans la table en cours (#ID_XXX utilisable dans la boucle en cours).

Par exemple, dans une boucle sur (ARTICLES), #TITRE_SECTEUR donnera le titre du secteur dans lequel est placé l\'article en cours, puisque l\'identifiant #ID_SECTEUR (ou le champ \'id_secteur\') est disponible dans ce cas.[[%titres_etendus%]]', # MODIF
	'titre_parent:nom' => 'Balise #TITRE_PARENT', # MODIF
	'titre_tests' => 'Het Zwitserland Mes - Tests Bladzijde…',
	'titres_typo:description' => 'Transforme tous les intertitres <html>« {{{Mon intertitre}}} »</html> en image typographique paramétrable.[[%i_taille% pt]][[%i_couleur%]][[%i_police%

Polices disponibles : @_CS_FONTS@]][[%i_largeur% px]][[%i_hauteur% pt]][[%i_padding% px]][[%i_align%]]

Cet outil est compatible avec : « [.->sommaire] ».', # NEW
	'titres_typo:nom' => 'Intertitres en image', # NEW
	'titres_typographies:description' => 'Par défaut, les raccourcis typographiques de SPIP <html>({, {{, etc.)</html> ne s\'appliquent pas aux titres d\'objets dans vos squelettes.
_ Cet outil active donc l\'application automatique des raccourcis typographiques de SPIP sur toutes les balises #TITRE et apparentées (#NOM pour un auteur, etc.).

Exemple d\'utilisation : le titre d\'un livre cité dans le titre d\'un article, à mettre en italique.', # NEW
	'titres_typographies:nom' => 'Titres typographiés', # NEW
	'tous' => 'Iedereen',
	'toutes_couleurs' => 'De 36 kleuren van de css stijlen :@_CS_EXEMPLE_COULEURS@',
	'toutmulti:aide' => 'Meertalige blokken : <b><:trad:></b>', # MODIF
	'toutmulti:description' => 'À l\'instar de ce vous pouvez déjà faire dans vos squelettes, cet outil vous permet d\'utiliser librement les chaînes de langues (de SPIP ou de vos squelettes) dans tous les contenus de votre site (articles, titres, messages, etc.) à l\'aide du raccourci <code><:chaine:></code>.
 
Consultez [ici ->http://www.spip.net/fr_article2128.html] la documentation de SPIP à ce sujet.

Cet outil accepte également les arguments introduits par SPIP 2.0. Par exemple, le raccourci <code><:ma_chaine{nom=Charles Martin, age=37}:></code> permet de passer deux paramètres à la chaîne suivante : <code>\'ma_chaine\'=>"Bonjour, je suis @nom@ et j\'ai @age@ ans\\"</code>.

La fonction SPIP utilisée en PHP est <code>_T(\'chaine\')</code> sans argument, et  <code>_T(\'chaine\', array(\'arg1\'=>\'un texte\', \'arg2\'=>\'un autre texte\'))</code> avec arguments.

 N\'oubliez donc pas de vérifier que la clef <code>\'chaine\'</code> est bien définie dans les fichiers de langues.', # MODIF
	'toutmulti:nom' => 'Meertalige blokken',
	'trad_help' => '{{Le Couteau Suisse est bénévolement traduit en plusieurs langues et sa langue mère est le français.}}

N\'hésitez pas à offrir votre contribution si vous décelez quelques soucis dans les textes du plugin. Toute l\'équipe vous en remercie d\'avance.

Pour vous inscrire à l\'espace de traduction : @url@

Pour accéder directement aux traductions des modules du Couteau Suisse, cliquez ci-dessous sur la langue cible de votre choix. Une fois identifié, repérez ensuite le petit crayon qui apparait en survolant le texte traduit puis cliquez dessus.

Vos modifications seront prises en compte quelques jours plus tard sous forme d\'une mise à jour disponible pour le Couteau Suisse. Si votre langue n\'est pas dans la liste, alors le site de traduction vous permettra facilement de la créer.

{{Traductions actuellement disponibles}} :@trad@

{{Merci aux traducteurs actuels}} : @contrib@.', # NEW
	'trad_mod' => 'Module « @mod@ » : ', # NEW
	'travaux_masquer_avert' => 'Masquer le cadre indiquant sur le site public qu\'une maintenance est en cours', # NEW
	'travaux_nocache' => 'Désactiver également le cache de SPIP', # NEW
	'travaux_nom_site' => '@_CS_NOM_SITE@',
	'travaux_prochainement' => 'Deze site zal zeer binnenkort hersteld worden.
_ Bedankt voor uw begrip.', # MODIF
	'travaux_titre' => '@_CS_TRAVAUX_TITRE@',
	'tri_articles:description' => 'En naviguant sur le site en partie privée ([->./?exec=auteurs]), choisissez ici le tri à utiliser pour afficher vos articles à l\'intérieur de vos rubriques.

Les propositions ci-dessous sont basées sur la fonctionnalité SQL \'ORDER BY\' : n\'utilisez le tri personnalisé que si vous savez ce que vous faites (champs disponibles : {id_article, id_rubrique, titre, soustitre, surtitre, statut, date_redac, date_modif, lang, etc.})
[[%tri_articles%]][[->%tri_perso%]]', # MODIF
	'tri_articles:nom' => 'Sorteren van de artikelen', # MODIF
	'tri_groupe' => 'Tri sur l\'id du groupe (ORDER BY id_groupe)', # NEW
	'tri_modif' => 'Sorteren op de wijzigingsdatum (ORDER BY date_modif DESC)',
	'tri_perso' => 'Verpersoonlijkt sorteren SQL, ORDER BY gevolgd door :',
	'tri_publi' => 'Sorteren op het jaartal (ORDER BY date DESC)',
	'tri_titre' => 'Sorteren op de titel (ORDER BY 0+titre,titre)',
	'trousse_balises:description' => 'Outil en cours de développement. Vous offre quelques balises très simples et bien pratiques pour améliorer la lisibilité de vos squelettes.

@puce@ {{#BOLO}} : génère un faux texte d\'environ 3000 caractères ("bolo" ou "[?lorem ipsum]") dans les squelettes pendant leur mise au point. L\'argument optionnel de cette fonction spécifie la longueur du texte voulu. Exemple : <code>#BOLO{300}</code>. Cette balise accepte tous les filtres de SPIP. Exemple : <code>[(#BOLO|majuscules)]</code>.
_ Un modèle est également disponible pour vos contenus : placez <code><bolo300></code> dans n\'importe quelle zone de texte (chapo, descriptif, texte, etc.) pour obtenir 300 caractères de faux texte.

@puce@ {{#MAINTENANT}} (ou {{#NOW}}) : renvoie simplement la date du moment, tout comme : <code>#EVAL{date(\'Y-m-d H:i:s\')}</code>. L\'argument optionnel de cette fonction spécifie le format. Exemple : <code>#MAINTENANT{Y-m-d}</code>. Tout comme avec #DATE, personnalisez l\'affichage grâce aux filtres de SPIP. Exemple : <code>[(#MAINTENANT|affdate)]</code>.

- {{#CHR<html>{XX}</html>}} : balise équivalente à <code>#EVAL{"chr(XX)"}</code> et pratique pour coder des caractères spéciaux (le retour à la ligne par exemple) ou des caractères réservés par le compilateur de SPIP (les crochets ou les accolades).

@puce@ {{#LESMOTS}} : ', # MODIF
	'trousse_balises:nom' => 'Trousse à balises', # NEW
	'type_urls:description' => '@puce@ SPIP offre un choix sur plusieurs jeux d\'URLs pour fabriquer les liens d\'accès aux pages de votre site.

Plus d\'infos : [->http://www.spip.net/fr_article765.html]. L\'outil « [.->boites_privees] » vous permet de voir sur la page de chaque objet SPIP l\'URL propre associée.
[[%radio_type_urls3%]]
<q3>@_CS_ASTER@pour utiliser les formats {html}, {propres}, {propres2}, {libres} ou {arborescentes}, recopiez le fichier "htaccess.txt" du répertoire de base du site SPIP sous le sous le nom ".htaccess" (attention à ne pas écraser d\'autres réglages que vous pourriez avoir mis dans ce fichier) ; si votre site est en "sous-répertoire", vous devrez aussi éditer la ligne "RewriteBase" ce fichier. Les URLs définies seront alors redirigées vers les fichiers de SPIP.</q3>

<radio_type_urls3 valeur="page">@puce@ {{URLs «page»}} : ce sont les liens par défaut, utilisés par SPIP depuis sa version 1.9x.
_ Exemple : <code>/spip.php?article123</code>[[%terminaison_urls_page%]][[%separateur_urls_page%]]</radio_type_urls3>

<radio_type_urls3 valeur="html">@puce@ {{URLs «html»}} : les liens ont la forme des pages html classiques.
_ Exemple : <code>/article123.html</code></radio_type_urls3>

<radio_type_urls3 valeur="propres">@puce@ {{URLs «propres»}} : les liens sont calculés grâce au titre des objets demandés. Des marqueurs (_, -, +, @, etc.) encadrent les titres en fonction du type d\'objet.
_ Exemples : <code>/Mon-titre-d-article</code> ou <code>/-Ma-rubrique-</code> ou <code>/@Mon-site@</code>[[%terminaison_urls_propres%]][[%debut_urls_propres%]][[%marqueurs_urls_propres%]]</radio_type_urls3>

<radio_type_urls3 valeur="propres2">@puce@ {{URLs «propres2»}} : l\'extension \'.html\' est ajoutée aux liens {«propres»}.
_ Exemple : <code>/Mon-titre-d-article.html</code> ou <code>/-Ma-rubrique-.html</code>
[[%debut_urls_propres2%]][[%marqueurs_urls_propres2%]]</radio_type_urls3>

<radio_type_urls3 valeur="libres">@puce@ {{URLs «libres»}} : les liens sont {«propres»}, mais sans marqueurs dissociant les objets (_, -, +, @, etc.).
_ Exemple : <code>/Mon-titre-d-article</code> ou <code>/Ma-rubrique</code>
[[%terminaison_urls_libres%]][[%debut_urls_libres%]]</radio_type_urls3>

<radio_type_urls3 valeur="arbo">@puce@ {{URLs «arborescentes»}} : les liens sont {«propres»}, mais de type arborescent.
_ Exemple : <code>/secteur/rubrique1/rubrique2/Mon-titre-d-article</code>
[[%url_arbo_minuscules%]][[%urls_arbo_sans_type%]][[%url_arbo_sep_id%]][[%terminaison_urls_arbo%]]</radio_type_urls3>

<radio_type_urls3 valeur="propres-qs">@puce@ {{URLs «propres-qs»}} : ce système fonctionne en "Query-String", c\'est-à-dire sans utilisation de .htaccess ; les liens sont {«propres»}.
_ Exemple : <code>/?Mon-titre-d-article</code>
[[%terminaison_urls_propres_qs%]]</radio_type_urls3>

<radio_type_urls3 valeur="propres_qs">@puce@ {{URLs «propres_qs»}} : ce système fonctionne en "Query-String", c\'est-à-dire sans utilisation de .htaccess ; les liens sont {«propres»}.
_ Exemple : <code>/?Mon-titre-d-article</code>
[[%terminaison_urls_propres_qs%]][[%marqueurs_urls_propres_qs%]]</radio_type_urls3>

<radio_type_urls3 valeur="standard">@puce@ {{URLs «standard»}} : ces liens désormais obsolètes étaient utilisés par SPIP jusqu\'à sa version 1.8.
_ Exemple : <code>article.php3?id_article=123</code>
</radio_type_urls3>

@puce@ Si vous utilisez le format {page} ci-dessus ou si l\'objet demandé n\'est pas reconnu, alors il vous est possible de choisir {{le script d\'appel}} à SPIP. Par défaut, SPIP choisit {spip.php}, mais {index.php} (exemple de format : <code>/index.php?article123</code>) ou une valeur vide (format : <code>/?article123</code>) fonctionnent aussi. Pour tout autre valeur, il vous faut absolument créer le fichier correspondant dans la racine de SPIP, à l\'image de celui qui existe déjà : {index.php}.
[[%spip_script%]]', # MODIF
	'type_urls:description1' => '@puce@ Si vous utilisez un format à base d\'URLs «propres»  ({propres}, {propres2}, {libres}, {arborescentes} ou {propres_qs}), le Couteau Suisse peut :
<q1>• S\'assurer que l\'URL produite soit totalement {{en minuscules}}.</q1>[[%urls_minuscules%]]
<q1>• Provoquer l\'ajout systématique de {{l\'id de l\'objet}} à son URL (en suffixe, en préfixe, etc.).
_ (exemples : <code>/Mon-titre-d-article,457</code> ou <code>/457-Mon-titre-d-article</code>)</q1>', # MODIF
	'type_urls:description2' => '{Note} : un changement dans ce paragraphe peut nécessiter de vider la table des URLs afin de permettre à SPIP de tenir compte des nouveaux paramètres.', # NEW
	'type_urls:nom' => 'Formaat van URLs',
	'typo_exposants:description' => '{{Textes français}} : améliore le rendu typographique des abréviations courantes, en mettant en exposant les éléments nécessaires (ainsi, {<acronym>Mme</acronym>} devient {M<sup>me</sup>}) et en corrigeant les erreurs courantes ({<acronym>2ème</acronym>} ou  {<acronym>2me</acronym>}, par exemple, deviennent {2<sup>e</sup>}, seule abréviation correcte).

Les abréviations obtenues sont conformes à celles de l\'Imprimerie nationale telles qu\'indiquées dans le {Lexique des règles typographiques en usage à l\'Imprimerie nationale} (article « Abréviations », presses de l\'Imprimerie nationale, Paris, 2002).

Sont aussi traitées les expressions suivantes : <html>Dr, Pr, Mgr, m2, m3, Mn, Md, Sté, Éts, Vve, Cie, 1o, 2o, etc.</html> 

Choisissez ici de mettre en exposant certains raccourcis supplémentaires, malgré un avis défavorable de l\'Imprimerie nationale :[[%expo_bofbof%]]

{{Textes anglais}} : mise en exposant des nombres ordinaux : <html>1st, 2nd</html>, etc.', # MODIF
	'typo_exposants:nom' => 'Typografische inzenders',

	// U
	'url_arbo' => 'boomvormig@_CS_ASTER@',
	'url_html' => 'html@_CS_ASTER@',
	'url_libres' => 'libres@_CS_ASTER@',
	'url_page' => 'bladzijde',
	'url_propres' => 'proper@_CS_ASTER@',
	'url_propres-qs' => 'propers-qs',
	'url_propres2' => 'proper2@_CS_ASTER@',
	'url_propres_qs' => 'propres_qs',
	'url_standard' => 'standaard',
	'url_verouillee' => 'URL verrouillée', # NEW
	'urls_3_chiffres' => '3 cijfers minimum eisen',
	'urls_avec_id' => 'Le placer en suffixe', # NEW
	'urls_avec_id2' => 'Le placer en préfixe', # NEW
	'urls_base_total' => 'Er zijn momenteel @nb@ URL(s) in de database',
	'urls_base_vide' => 'De database van de URLs is leeg',
	'urls_choix_objet' => 'Edition en base de l\'URL d\'un objet spécifique :', # MODIF
	'urls_edit_erreur' => 'Le format actuel des URLs (« @type@ ») ne permet pas d\'édition.', # NEW
	'urls_enregistrer' => 'Dit URL in de database opslaan',
	'urls_id_sauf_rubriques' => 'Exclure les rubriques', # MODIF
	'urls_minuscules' => 'Lettres minuscules', # NEW
	'urls_nouvelle' => 'Éditer l\'URL « propres » :', # MODIF
	'urls_num_objet' => 'Nummer :',
	'urls_purger' => 'Alles legen',
	'urls_purger_tables' => 'De geselecteerde tafels legen',
	'urls_purger_tout' => 'Réinitialiser les URLs stockées dans la base :', # NEW
	'urls_rechercher' => 'Rechercher cet objet en base', # NEW
	'urls_titre_objet' => 'Titre enregistré  :', # NEW
	'urls_type_objet' => 'Objet :', # NEW
	'urls_url_calculee' => 'Publiek URL « @type@ » :',
	'urls_url_objet' => 'URL « propres » enregistrée :', # MODIF
	'urls_valeur_vide' => '(Une valeur vide entraine la suppression de l\'URL)', # MODIF
	'urls_verrouiller' => '{{Verrouiller}} cette URL afin que SPIP ne la modifie plus, notamment lors d\'un clic sur « @voir@ » ou d\'un changement du titre de l\'objet.', # NEW

	// V
	'validez_page' => 'Om de wijzigingen te bereiken :',
	'variable_vide' => '(Leegte)',
	'vars_modifiees' => 'De gegevens werden wel degelijk gewijzigd',
	'version_a_jour' => 'Uw versie is aan dag.',
	'version_distante' => 'Verwijderde versie...',
	'version_distante_off' => 'Désactivée verwijderde verificatie',
	'version_nouvelle' => 'Nieuwe versie : @version@',
	'version_revision' => 'Revisie : @revision@',
	'version_update' => 'Automatische update',
	'version_update_chargeur' => 'Automatische download',
	'version_update_chargeur_title' => 'Downloadt de laatste versie van plugin dank zij plugin «Downloade»',
	'version_update_title' => 'Downloadt de laatste versie van plugin en lanceert zijn automatische update',
	'verstexte:description' => '2 filters voor uw skeletten, die het mogelijk maken om lichtere bladzijdes te produceren.
_ de tekst_versie : uitgetrokken de inhoud tekst van een HTML bladzijde met uitsluiting van enkele elementaire bakens.
_ volle_tekst_versie : uitgetrokken de inhoud tekst van een HTML bladzijde om van de volle tekst terug te geven.', # MODIF
	'verstexte:nom' => 'Tekst versie',
	'visiteurs_connectes:description' => 'Aanbod een hazelnoot voor uw skelet dat het aantal bezoekers te kennen geeft die op de openbare plaats worden aangesloten.

Ajoutez simplement <code><INCLURE{fond=fonds/visiteurs_connectes}></code> dans vos pages.', # MODIF
	'visiteurs_connectes:inactif' => 'Attention : les statistiques du site ne sont pas activées.', # NEW
	'visiteurs_connectes:nom' => 'Aangesloten bezoekers',
	'voir' => 'Zie : @voir@',
	'votre_choix' => 'Uw keus :',

	// W
	'webmestres:description' => 'Een SPIP {{webmestre}} is een {{beheerder}} hebben toegang aan ruimte FTP. Bij verstek en vanaf SPIP 2.0, is hij de beheerder <code>id_auteur=1</code> van de site. Hier bepaalde webmestres hebben het voorrecht om niet meer om door FTP verplicht te worden voorbij te gaan om de belangrijke verrichtingen van de plaats te valideren, zoals de update van de database of de restauratie van een dump.

Huidige Webmestre : {@_CS_LISTE_WEBMESTRES@}.
_ In aanmerking komende beheerder : {@_CS_LISTE_ADMINS@}.

Als webmestre zelf, hebt u hier de rechten om deze lijst van ids te wijzigen  gescheiden door beide punten « : » als zij verschillende zijn. Exemple : «1:5:6».[[%webmestres%]]', # MODIF
	'webmestres:nom' => 'Webmestres lijst',

	// X
	'xml:description' => 'Actief validateur xml voor de openbare ruimte zoals hij in  [documentatie->http://www.spip.net/en_article3582.html]  wordt beschreven. Een knoop getiteld « Analyse XML » wordt aan de andere knopen van bestuur toegevoegd.', # MODIF
	'xml:nom' => 'XML Validatie'
);

?>
