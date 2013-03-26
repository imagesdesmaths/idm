<?php
// This is a SPIP language file  --  Ceci est un fichier langue de SPIP
// extrait automatiquement de http://trad.spip.net/tradlang_module/couteauprive?lang_cible=sk
// ** ne pas modifier le fichier **

if (!defined('_ECRIRE_INC_VERSION')) return;

$GLOBALS[$GLOBALS['idx_lang']] = array(

	// 2
	'2pts_non' => ' : nie',
	'2pts_oui' => ' : áno',

	// S
	'SPIP_liens:description' => '@puce@ Podľa prvotných nastavení sa všetky stránky odkazy otvárajú v aktuálnom okne. Ale môže byť užitočné otvárať externé odkazy v novom okne, tzv. pridať {target="_blank"} ku všetkým tagom odkazov z tried SPIPU {spip_out}, {spip_url} alebo {spip_glossaire}. Niekedy je potrebné pridať niektorú z týchto tried do šablón stránky (html súborov), aby bola táto funkcia efektívna v plnom rozsahu.[[%radio_target_blank3%]]

@puce@ SPIP poskytuje skratku <code>[?word]</code> na prepájanie slova a jeho definície. Podľa prvotných nastavení (alebo ak pole nevyplníte), ako externý slovník sa použije wikipedia.org. Môžete si vybrať inú adresu. <br />Testovací odkaz: [?SPIP][[%url_glossaire_externe2%]]', # MODIF
	'SPIP_liens:description1' => '@puce@ SPIP obsahuje štýl CSS pre odkazy na e-mailové odkazy - malá obálka sa zobrazuje pred každým odkazom "mailto". Nie všetky prehliadače ju však vedia zobraziť(konkrétne IE6, IE7 a SAF3). Je na vás, aby ste sa rozhodli, či využijete toto rozšírenie.
_ Testovací odkaz:[->test@test.com] (Na otestovanie znova načítajte stránku.)[[%enveloppe_mails%]]',
	'SPIP_liens:nom' => 'SPIP a externé odkazy',
	'SPIP_tailles:description' => '@puce@ Na zmenšenie operačnej pamäte na serveri vám SPIP umožňuje obmedziť rozmery (výšku a šírku) a veľkosť súborov a obrázkov, log alebo dokumentov, ktoré sú pripojené k rôznym prvkom stránky. Ak daný súbor presahuje určenú veľkosť, formulár vráti tieto údaje, ale budú zničené a SPIP ich nebude uchovávať na ďalšie použitie ani v priečinku IMG/ ani v databáze. Správa s upozornením sa potom odošle používateľovi.

Nulová alebo prázdna hodnota určuje neobmedzenú hodnotu.
[[Výška: %img_Hmax% pixelov]][[->Šírka: %img_Wmax% pixelov]][[->Veľkosť súboru: %img_Smax% kB]]
[[Výška: %logo_Hmax% pixelov]][[->Šírka: %logo_Wmax% pixelov]][[->Veľkosť súboru: %logo_Smax% kB]]
[[Veľkosť súboru: %doc_Smax% kB]]

@puce@ Sem zadajte maximálny priestor vyhradený pre vzdialené súbory, ktoré bude môcť SPIP stiahnuť (zo serveru na server) a uložiť na vašej stránke. Predvolená hodnota je tu 16 MB. [[%copie_Smax% MB]]

@puce@ Aby sa predišlo preťaženiu PHP pamäte pri spracúvaní veľkých obrázkov knižnicou GD2, SPIP otestuje možnosti servera a potom môžu odmietnuť spracovať obrázky, ktoré sú príliš veľké. Tento test sa dá deaktivovať tak, že manuálne definujete maximálny počet pixelov podporovaný pre proces spracovania.

Hodnota 1~000~000 pixelov sa zdá byť rozumná na nastavenie, ak máte málo dostupnej pamäte. Nulová alebo prázdna hodnota bude znamenať, že na serveri sa uskutoční test.
[[%img_GDmax% pixels au maximum]]
@puce@ Knižnica GD2 sa používa na upravenie kvality kompresie každého obrázka JPG. Vyššie percento znamená lepšiu kvalitu.
[[%img_GDqual% %]]',
	'SPIP_tailles:nom' => 'Obmedzenia pamäte',

	// A
	'acces_admin' => 'Prístup administrátorov:',
	'action_rapide' => 'Rýchla akcia, iba ak viete, čo robíte!',
	'action_rapide_non' => 'Rapid action, available when this tool is activated:',
	'admins_seuls' => 'Len administrátori',
	'aff_tout:description' => 'Niekedy je užitočné zobraziť všetky rubriky alebo všetkých autorov stránky bez ohľadu na ich stav, resp. funkciu (napr. pri vývoji). Podľa predvolených nastavení SPIP nepublikuje informáciu o tom, že autori a rubriky majú aspoň jeden publikovaný redakčný objekt.

Dá sa to zmeniť pomocou kritéria [<html>{tout}</html>->http://www.spip.net/fr_article4250.html], ale tento nástroj zautomatizuje tento proces, a tak nemusíte pridávať toto kritérium do všetkých cyklov svojich šablón pre RUBRIKY a/lebo ČLÁNKY.',
	'aff_tout:nom' => 'Zobraziť všetky',
	'alerte_urgence:description' => 'V hornej časti všetkých verejne prístupných stránok zobrazí pútač s upozornením o rozširovaní nebezpečenstva tak, ako je definovaný nižšie.
_ Na viacjazyčnej stránke sa odporúča používať tagy <code><multi/></code>.[[%alerte_message%]]',
	'alerte_urgence:nom' => 'Upozornenie',
	'attente' => 'Čaká sa...',
	'auteur_forum:description' => 'Požiadajte všetkých autorov verejných stráv, aby vyplnili (aspoň jedným písmenom!) meno a/alebo email, aby sa predišlo úplne anonymným správam. Majte na pamäti, že tento nástroj vykonáva overenie cez Javascript v prehliadači používateľa. [[%auteur_forum_nom%]][[->%auteur_forum_email%]][[->%auteur_forum_deux%]]
{Upozornenie: Tretia možnosť ruší ostatné. Je dôležité overiť si, že formuláre vašej šablóny sú kompatibilné s týmto nástrojom.}',
	'auteur_forum:nom' => 'Žiadne anonymné diskusné fóra',
	'auteur_forum_deux' => 'alebo aspoň jedno z dvoch predchádzajúcich polí',
	'auteur_forum_email' => 'Pole „@_CS_FORUM_EMAIL@“',
	'auteur_forum_nom' => 'Pole „@_CS_FORUM_NOM@“',
	'auteurs:description' => 'Tento nástroj nastavuje vzhľad [stránky autorov->./?exec=auteurs] v súkromnej zóne

@puce@ Tu určte maximálny počet autorov, ktorý sa zobrazí v strednom ráme stránky autorov. Za týmto číslom bude nasledovať číslovanie strán. [[%max_auteurs_page%]]

@puce@ Aký typ autorov by sa mal objaviť na stránke autorov?
[[%auteurs_tout_voir%[[->%auteurs_0%]][[->%auteurs_1%]][[->%auteurs_5%]][[->%auteurs_6%]][[->%auteurs_n%]]]]',
	'auteurs:nom' => 'Stránka autorov',
	'autobr:description' => 'Používa sa na spracovanie určitého textu v SPIPe filtrom {|post_autobr}, ktorý všetky nové prázdne riadky nahradí jediným zlomom riadka v HTML &lt;br />.',
	'autobr:description1' => 'V rozpore s historickou tradíciou SPIP 3 berie v predvolených nastaveniach do úvahy nové riadky (jednoduché zlomy riadkov) v texte. Tu môžete toto správanie deaktivovať a vrátiť sa k starému spôsobu, pri ktorom jednoduchý zlom riadka (Enterom) program nerozoznáva – ako jazyk HTML.',
	'autobr:description2' => 'Objekty s týmto tagom (nie celý zoznam):
- Články: @ARTICLES@.
- Rubriky: @RUBRIQUES@.
- Diskusné fóra: @FORUMS@.',
	'autobr:nom' => 'Automatické zlomy riadkov',
	'autobr_non' => 'Vnútorné tagy &lt;alinea>&lt;/alinea>',
	'autobr_oui' => 'Články a verejné správy (tagy @BALISES@)',
	'autobr_racc' => 'Zlomov riadkov: <b>&lt;alinea>&lt;/alinea></b>',

	// B
	'balise_set:description' => 'Na zjednodušenie prvkov kódu, ako <code>#SET{x,#GET{x}|a_filter}</code>, tento nástroj ponúka tieto skratky: <code>#SET_UN_FILTRE{x}.</code> Filter, ktorý sa použil na premennú sa preto prenáša v názve tagu.

Príklady: <code>#SET{x,1}#SET_PLUS{x,2}</code> alebo <code>#SET{x,avions}#SET_REPLACE{x,ons,ez}.</code>',
	'balise_set:nom' => 'Tag #SET rozšírený',
	'barres_typo_edition' => 'Úprava obsahu',
	'barres_typo_forum' => 'Príspevky v diskusnom fóre',
	'barres_typo_intro' => 'The «Porte-Plume» plugin is installed. Please choose here the typographical bars on which to insert various buttons.',
	'basique' => 'Základný',
	'blocs:aide' => 'Folding blocks: <b><bloc></bloc></b> (alias: <b><invisible></invisible></b>) and <b><visible></visible></b>',
	'blocs:description' => 'Umožňuje vám vytvárať bloky, ktoré sa zobrazujú/schovávajú, keď kliknete na názov.

@puce@ {{V textoch SPIPU:}} autori môžu používať tagy <bloc> (alebo <invisible>) a <visible> rovnakým spôsobom: 

<quote><code>
<bloc>
 Klikateľný názov
 
 Text, ktorý sa zobrazí/skryje po dvoch nových riadkoch.
 </bloc>
</code></quote>

@puce@ {{V šablónach:}} môžete používať tagy #BLOC_TITRE, #BLOC_DEBUT a #BLOC_FIN takto: 
<quote><code> #BLOC_TITRE
 Môj názov
 #BLOC_RESUME    (voliteľné)
 zhrnutie nasledujúceho bloku
 #BLOC_DEBUT
 Môj skladací blok (ktorý, ak treba, vie spustiť internetová adresa typu AJAX URL)
 #BLOC_FIN</code></quote>

@puce@ Ak nižšie zaškrtnete "Áno", pri otvorení jedného bloku sa všetky ostatné bloky na stránke zatvoria. Tzn., že naraz je otvorený len jeden blok.[[%bloc_unique%]]

@puce@ Ak nižšie zaškrtnete "Áno", stav očíslovaných blokov sa uloží do cookie, aby sa zachoval vzhľad stránky tak dlho, kým so stránkou budete pracovať.[[%blocs_cookie%]]

@puce@ Podľa prvotných nastavení Vreckový nožík používa pre názvy skladacích blokov HTML tag <h4>. Iný tag môžete určiť tu <hN>:[[%bloc_h4%]]',
	'blocs:nom' => 'Folding Blocks',
	'boites_privees:description' => 'Všetky polia opísané nižšie sú tu alebo v súkromnej zóne.[[%cs_rss%]][[->%format_spip%]][[->%stat_auteurs%]][[->%qui_webmasters%]][[->%bp_urls_propres%]][[->%bp_tri_auteurs%]]
- {{Aktualizácie nástroja Vreckový nožík:}} rámec tejto aktuálnej nastavovacej stránky, ktoré zobrazujú najnovšie úpravy kódu zásuvného modulu ([Source->@_CS_RSS_SOURCE@]).
- {{Články vo formáte SPIP:}} skladací rám na články, ktorý vám umožňuje vidieť zdrojový kód, ktorý použili ich autori.
- {{Aktualizácie autorov:}} skladací rám na [authors page->./?exec=auteurs], ktorý zobrazuje 10 najneskôr pripojených autorov a nepotvrdený obsah, ktorý vytvorili. Tieto údaje môžu vidieť iba administrátori.
- {{Webmasteri SPIPU:}} skladací rám na [author\'s page->./?exec=auteurs], ktorá obsahuje zoznam administrátorov, ktorým bola pridelená funkcie webmastera. Tieto údaje môtu vidieť len administrátori. Ak ste sám jedným z webmasterov, tiež môžete vidieť nástroj " [.->webmestres] ".
- {{Čisté www adresy:}} skladací rám na každý prvok obsahu (článok, rubriku, autora,...) s čistou adresou, ako aj možnými aliasmi, ktoré existujú. Nástroj " [.->type_urls] " vám ponúka podrobné nastavenie adriesť webu.
- {{Zotriedení autori:}} skladací rám na články, ktoré majú viac ako jedného autora, a ktorý poskytuje jednoduchý mechanizmus na prispôsobenie triedenia ich poradia.',
	'boites_privees:nom' => 'Private boxes',
	'bp_tri_auteurs' => 'Poradie autorov',
	'bp_urls_propres' => 'Vyčistené URL',
	'brouteur:description' => 'Ak je viac ako %rubrique_brouteur% rubrík, použiť označovač rubriky AJAX.',
	'brouteur:nom' => 'Nastavenie prepínačov',

	// C
	'cache_controle' => 'Cache control',
	'cache_nornal' => 'Bežné použitie',
	'cache_permanent' => 'Trvalá cache',
	'cache_sans' => 'Žiadna cache',
	'categ:admin' => '1. Administrácia',
	'categ:devel' => '55. Vývoj',
	'categ:divers' => '60. Rôzne',
	'categ:interface' => '10. Private interface',
	'categ:public' => '40. Verejná stránka',
	'categ:securite' => '5. Bezpečnosť',
	'categ:spip' => '50. Tags, filters, criteria',
	'categ:typo-corr' => '20. Text improvements',
	'categ:typo-racc' => '30. Klávesové skratky',
	'certaines_couleurs' => 'Len tagy definované nižšie @_CS_ASTER@:',
	'chatons:aide' => 'Smajlíky: @liste@',
	'chatons:description' => 'Vloží obrázky (alebo emotikony  známe z {četu}) code> do všetkých textov, kde je reťazec, ako napr. {{<code>":nom".</code>}}
_ Tento nástroj nahradí skratky obrázkami s rovnakým názvom, ktoré sa nájdu v priečinku <code>mon_squelette_toto/img/chatons/,</code> alebo podľa predvolených nastavení priečinka <code>@_DIR_CS_ROOT@img/chatons/</code>.',
	'chatons:nom' => 'Smajlíky',
	'citations_bb:description' => 'Na dodržanie HTML v spipovskom obsahu vašej stránky (články, rubriky, atď.) tento nástroj nahradí označenie <quote> označením <q> tam, kde je prázdny riadok. ',
	'citations_bb:nom' => 'Dobre označené citácie',
	'class_spip:description1' => 'Tu môžete definovať niektoré skratky SPIPu. Prázdna hodnota znamená používanie predvolenej.[[%racc_hr%]]',
	'class_spip:description2' => '@puce@ {{skratky SPIPU}}.

Tu môžete definovať skratky SPIPU. Prázdna hodnota je ekvivalentom k použitiu predvolenej. [[%racc_hr%]][[%puce%]]',
	'class_spip:description3' => '

{Pozn. Ak je nástroj "[.->pucesli]" aktívny, potom sa nahradenie pomlčky "-" už viac nebude robiť; namiesto toho sa použije sa zoznam <ul><li>.}

SPIP na podnadpisy štandardne používa tag <h3>. Tu môžete vybrať iný tag: [[%racc_h1%]][[->%racc_h2%]]',
	'class_spip:description4' => '

Na označenie tučného písma SPIP obyčajne používa tag <strong>. Ale tag <b> môžete použiť tiež. Môžete si vybrať: [[%racc_g1%]][[->%racc_g2%]]

Na označenie kurzívy SPIP obyčajne používa tag <i>. Ale tag <em> môžete použiť tiež. Môžete si vybrať: [[%racc_i1%]][[->%racc_i2%]]

 Môžete definovať aj kód, ktorý sa bude používať na otváranie a uzatváranie volania poznámok pod čiarou.(Pozn. Tieto zmeny uvidíte len na verejne prístupnej stránke.): [[%ouvre_ref%]][[->%ferme_ref%]]
 
  Môžete definovať aj kód, ktorý sa bude používať na otváranie a uzatváranie poznámok pod čiarou: [[%ouvre_note%]][[->%ferme_note%]]

@puce@ {{Štýly SPIPu}}. Do verzie 1.92, klávesové skratky vytvárali HTML tagy, ktoré boli označené ako trieda "spip". Napríklad <code><p class="spip"></code>. Tu môžete definovať štýl týchto tagov, aby sa prepojili s vaším štýlopisom. Prázdne pole znamená, že sa nepoužije žiaden štýl.

{Pozn. Ak sa niektorá zo skratiek uvedených vyššie zmení (vodorovná čiara, podnázov, kurzíva, tučné písmo), potom sa štýly uvedené nižšie nepoužijú.}

<q1>
_ {{1.}} Tagy <p>, <i>, <strong>: [[%style_p%]]
_ {{2.}} Tagy <tables>, <hr>, <h3>, <blockquote> a zoznamy (<ol>, <ul>, atď.):[[%style_h%]]

Pozn.: zmenou  druhého parametra stratíte štandardné štýly priradené k týmto tagom.</q1>',
	'class_spip:nom' => 'SPIP and its shortcuts...',
	'code_css' => 'CSS',
	'code_fonctions' => 'Funkcie',
	'code_jq' => 'jQuery',
	'code_js' => 'JavaScript',
	'code_options' => 'Možnosti',
	'code_spip_options' => 'Možnosti SPIPU',
	'compacte_css' => 'Kompaktné CSS',
	'compacte_js' => 'Kompaktný Javascript',
	'compacte_prive' => 'Nekomprimovať nič v súkromnej zóne',
	'compacte_tout' => 'Vôbec žiadna kompresia (vynuluje predchádzajúce možnosti)',
	'contrib' => 'Viac informácií: @url@',
	'copie_vers' => 'Kópia do: @dir@',
	'corbeille:description' => 'SPIP automatically deletes objets which have been put in the dustbin after one day. This is done by a "Cron" job, usually at 4 am. Here, you can block this process taking place in order to regulate the dustbin emptying yourself. [[%arret_optimisation%]]',
	'corbeille:nom' => 'Kôš',
	'corbeille_objets' => '@nb@ objekt(ov) v koši.',
	'corbeille_objets_lies' => '@nb_lies@ connection(s) detected.',
	'corbeille_objets_vide' => 'Žiadne objekty v koši.',
	'corbeille_objets_vider' => 'Delete the selected objects',
	'corbeille_vider' => 'Empty the wastebin:',
	'couleurs:aide' => 'Farba textu: <b>[coul]text[/coul]</b>@fond@ with <b>coul</b> = @liste@',
	'couleurs:description' => 'Umožňuje vám ľahko použiť farbu na celý text na stránke (články, novinky, nadpisy, diskusné fórum, a i.) pomocou tagov na typografické skratky v zátvorkách: <code>[couleur]text.[/couleur]</code>

Dva rovnaké príklady na zmenu farby textu:@_CS_EXEMPLE_COULEURS2@

Rovnako na zmenu písma, ak je povolená táto možnosť:@_CS_EXEMPLE_COULEURS3@

[[%couleurs_fonds%]]
[[%set_couleurs%]][[-><set_couleurs valeur="1">%couleurs_perso%</set_couleurs>]]
@_CS_ASTER@Formát týchto používateľských tagov by mal obsahovať existujúce farby alebo definovať dvojice "tag=farba", oddelené čiarkami. Príklady: "sivá, červená", "slabá=žltá, silná=červená", "dole=#99CC11, hore=brown" alebo ešte "sivá=#DDDDCC, červená=#EE3300". Pre prvý a posledný príklad sú povolené tagy: <code>[gris]</code> a <code>[rouge]</code> (<code>[fond gris]</code> a <code>[fond rouge],</code> ak sú písma povolené).',
	'couleurs:nom' => 'Zafarbený text',
	'couleurs_fonds' => ', <b>[fond coul]text[/coul]</b>, <b>[bg coul]text[/coul]</b>',
	'cs_comportement:description' => '@puce@ {{Logs.}} Record a lot of information about the working of the Penknife in the {spip.log} files which can be found in this directory: {<html>@_CS_DIR_LOG@</html>}.
_ Configurez les options de journalisation grâce à l\'outil «[.->spip_log]».[[%log_couteau_suisse%]]

@puce@ {{SPIP options.}} SPIP places plugins in order. To be sure that the Penknife is at the head and is thus able to control certain SPIP options, check the following option. If the permissions on your server allow it, the file {<html>@_CS_FILE_OPTIONS@</html>} will be modified to include {<html>@_CS_DIR_TMP@couteau-suisse/mes_spip_options.php</html>}.

[[%spip_options_on%]]@_CS_FILE_OPTIONS_ERR@

@puce@ {{External requests.}} The Penknife checks regularly for new versions of the plugin and shows available updates on its configuration page. If the external requests involved do not work from your server, check this box to turn this off.[[%distant_off%]][[->%distant_outils_off%]]', # MODIF
	'cs_comportement:nom' => 'Správanie sa modulu Vreckový nožík',
	'cs_comportement_ko' => '{{Note :}} ce paramètre requiert un filtre de gravité réglé à plus de @gr2@ au lieu de @gr1@ actuellement.', # NEW
	'cs_distant_off' => 'Checks of remote versions',
	'cs_distant_outils_off' => 'Nástroje modulu Vreckový nožík so vzdialenými súbormiVypočuť',
	'cs_log_couteau_suisse' => 'Detailed logs of the Penknife',
	'cs_reset' => 'Are you sure you wish to completely reset the Penknife?',
	'cs_reset2' => 'All activated tools will be deactivated and their options reset.',
	'cs_spip_options_erreur' => 'Varovanie: Nepodarilo sa zmeniť súbor "<html>@_CS_FILE_OPTIONS@</html>"!',
	'cs_spip_options_on' => 'Možnosti SPIPU v súbore „@_CS_FILE_OPTIONS@“',

	// D
	'decoration:aide' => 'Décoration: <b>&lt;tag&gt;test&lt;/tag&gt;</b>, with<b>tag</b> = @liste@',
	'decoration:description' => 'Nové, konfigurovateľné štýly v texte pomocou uhlových zátvoriek a tagov. Príklady: 
<mytag>text</mytag> alebo: <mytag/>.<br />Nižšie definujte CSS štýly, ktoré potrebujete. Každý tag zadajte na samostatný riadok pomocou tejto syntaxe:
- {type.mytag = môj štýl CSS}
- {type.mytag.class = moja trieda CSS}
- {type.mytag.lang = môj jazyk (napr.: sk)}
- {unalias = mytag}

Parameter {typ}, ktorý je uvedený vyššie, môže mať tri hodnoty:
- {span:} inline tag 
- {div:} tag prvku bloku
- {auto:} tag zvolený automaticky zásuvným modulom

[[%decoration_styles%]]',
	'decoration:nom' => 'Decoration',
	'decoupe:aide' => 'Blok kariet: <b><onglets></onglets></b><br/>Oddeľovač stránok alebo kariet: @sep@',
	'decoupe:aide2' => 'Alias: @sep@',
	'decoupe:description' => '@puce@ Rozdelí článok na strany, ktoré budú automaticky očíslované. 
Tam, kde chcete, aby bol zlom strany, jednoducho zadajte štyri znaky + za sebou (<code>++++</code>).

Podľa predvolených nastavení modul Vreckový nožík umiestni odkazy na stránkovanie na vrchnú a spodnú časť strany. Vy však môžete dať v šablóne odkazy aj inde pomocou tagu #CS_DECOUPE, ktorý aktivujete tu:
[[%balise_decoupe%]]

@puce@ Ak použijete tento oddeľovač medzi  tagmi <onglets> a </onglets>, potom namiesto toho vytvoríte stránku s kartami.

V šablónach môžete používať tagy
#ONGLETS_DEBUT, #ONGLETS_TITRE a #ONGLETS_FIN.

Tento nástroj môžete spojiť s nástrojom "[zhrnutie.->sommaire]".',
	'decoupe:nom' => 'Division in pages and tabs',
	'desactiver_flash:description' => 'Deletes the flash objects from your site and replaces them by the associated alternative content.',
	'desactiver_flash:nom' => 'Deactivate flash objects',
	'detail_balise_etoilee' => '{{N.B.}} : Check the use made in your templates of starred tags. This tool will not apply its treatment to the following tag(s): @bal@.',
	'detail_disabled' => 'Parametre, ktoré sa nedajú zmeniť:',
	'detail_fichiers' => 'Súbory:',
	'detail_fichiers_distant' => 'Vzdialené súbory:',
	'detail_inline' => 'Inline kód:',
	'detail_jquery2' => 'Tento nástroj využíva knižnicu {jQuery}.',
	'detail_jquery3' => '{{N.B.}}: this tool requires the plugin [jQuery pour SPIP 1.92->http://files.spip.org/spip-zone/jquery_192.zip] in order to function correctly with this version of SPIP.',
	'detail_pipelines' => 'Potrubie:',
	'detail_raccourcis' => 'Tento nástroj upravil nasledovné klávesové skratky.',
	'detail_spip_options' => '{{Poznámka:}} Ak tento nástroj nefunguje, určte prioritu nastaveniam SPIPU pomocou utility "@lien@".',
	'detail_spip_options2' => 'Tu sa určiť prioritu možností SPIPU pomocou nástroja "[.->cs_comportement]".',
	'detail_spip_options_ok' => '{{Poznámka:}} Tento nástroj momentálne určuje prioritu nastavení SPIPU pomocou utility "@lien@".',
	'detail_surcharge' => 'Preťažený nástroj:',
	'detail_traitements' => 'Riešenie:',
	'devdebug:description' => '{{Tento nástroj vám umožňuje vidieť všetky chyby PHP na obrazovke.}}<br />Môžete si zvoliť úroveň vykonávacích chýb PHP, ktorá sa zobrazí, keď budú ladič ako aj miesto, na ktoré sa tieto nastavenia použijú, aktívne.',
	'devdebug:item_e_all' => 'Všetky správy o chybách (všetky)',
	'devdebug:item_e_error' => 'Vážne alebo fatálne chyby',
	'devdebug:item_e_notice' => 'Oznámenia o vykonaní',
	'devdebug:item_e_strict' => 'Všetky správy a varovania PHP',
	'devdebug:item_e_warning' => 'Varovania',
	'devdebug:item_espace_prive' => 'Súkromná zóna',
	'devdebug:item_espace_public' => 'Verejná zóna',
	'devdebug:item_tout' => 'Celý SPIP',
	'devdebug:nom' => 'Vývojový ladič',
	'distant_aide' => 'Tento nástroj si vyžaduje vzdialené súbory, ktoré musia byť správne nainštalované do knižnice. Pred aktivovaním tohto nástroja alebo aktualizovaním tohto rámu sa uistite, že sa požadované súbory naozaj nachádzajú na vzdialenom serveri.',
	'distant_charge' => 'Súbor sa správne stiahol a nainštaloval do knižnice.',
	'distant_charger' => 'Začať sťahovanie',
	'distant_echoue' => 'Chyba pri nahrávaní, tento nástroj možno nefunguje!',
	'distant_inactif' => 'Súbor sa nenašiel (nástroj neaktívny).',
	'distant_present' => 'Súbor existuje v knižnici od @date@.',
	'docgen' => 'Všeobecná dokumentácia',
	'docwiki' => 'Zápisník nápadov',
	'dossier_squelettes:description' => 'Changes which template directory to use. For example: "squelettes/mytemplate". You can register several directories by separating them with a colon <html>":"</html>. If you leave the following box empty (or type "dist" in it), then the default "dist" template, supplied with SPIP, will be used.[[%dossier_squelettes%]]',
	'dossier_squelettes:nom' => 'Priečinok šablón',

	// E
	'ecran_activer' => 'Povoliť bezpečnostnú obrazovku',
	'ecran_conflit' => 'Varovanie: súbor "@file@" spôsobuje konflikt a mal by byť odstránený!',
	'ecran_conflit2' => 'Poznámka: statický súbor s názvom "@file@" sa našiel a bol aktivovaný. Modul Couteau Suisse  ho nevedel aktualizovať alebo nastaviť.',
	'ecran_ko' => 'Neaktívna obrazovka!',
	'ecran_maj_ko' => 'K dispozícii je verzia {{@n@}} bezpečnostnej obrazovky. Prosím, aktualizujte vzdialený súbor tejto utility.',
	'ecran_maj_ko2' => 'K dispozícii je verzia @n@ bezpečnostnej obrazovky. Môžete aktualizovať vzdialený súbor " [.->ecran_securite] ".',
	'ecran_maj_ok' => '(zdá sa, že je aktuálny).',
	'ecran_securite:description' => 'Bezpečnostná obrazovka je súbor PHP priamo stiahnutý z oficiálnej stránky SPIPu, ktorý chráni vaše stránky tým, že blokuje niektoré útoky zamerané na určité chyby v zabezpečení. Tento systém vám umožňuje veľmi rýchlo zareagovať vždy, ak sa objaví problém ochranou systému pri týchto chybách bez toho, aby ste museli okamžite aktualizovať svoju stránku alebo použiť zložité záplaty.

Dôležitá poznámka: obrazovka zamkne niektoré premenné. Napríklad všetky premenné s názvom <code>id_xxx</code> sú nastavené ako celé nezáporné čísla, aby sa zabránilo injekciám do SQL kódu cez túto veľmi bežnú premennú internetovej adresy. Niektorým zásuvným modulom nevyhovujú všetky pravidlá, ktoré zaviedla táto obrazovka vrátane tých, ktoré musia na vytvorenie nového objektu {x} používať syntax, ako napríklad  <code>&id_x=new.</code>

Okrem zabezpečenia môže mať táto obrazovka nastavenú možnosť zakázať prístup indexovacím robotom do skriptov PHP, ak je server zaťažený, a to tak, že im povie, aby sa prišli neskôr.[[ %ecran_actif%]][[->
@puce@ Upravte ochranu proti robotom vždy, keď nahrávanie na serveri prekročí hodnotu: %ecran_load%
_ {Predvolená hodnota je 4. Ak chcete tento proces deaktivovať, nastavte hodnotu na 0.}@_ECRAN_CONFLIT@]]

Pri oficiálnej aktualizácii aktualizujte prepojený vzdialený súbor (kliknite hore na [aktualizovať]) a využívajte najnovšie ochranné prvky.

- Verzia lokálneho súboru: ',
	'ecran_securite:nom' => 'Bezpečnostná obrazovka',
	'effaces' => 'Deleted',
	'en_travaux:description' => 'Počas údržby umožňuje zobraziť vlastnú správu na každej verejne prístupnej stránke, prípadne v súkromnej zóne.',
	'en_travaux:nom' => 'Stránka v režime údržby',
	'erreur:bt' => '<span style=\\"color:red;\\">Pozor:</span> zdá sa, že verzia typografického panela je stará(@version@).<br />Modul Vreckový nožík je kompatibilný iba s verziou @mini@ alebo s novšou.',
	'erreur:description' => 'missing id in the tool\'s definition!',
	'erreur:distant' => 'Vzdialený server',
	'erreur:jquery' => '{{N.B.}} : {jQuery} does not appear to be active for this page. Please consult the paragraph about the plugin\'s required libraries [in this article->http://www.spip-contrib.net/?article2166] or reload this page.',
	'erreur:js' => 'A Javascript error appears to have occurred on this page, hindering its action. Please activate Javascript in your browser, or try deactivating some SPIP plugins which may be causing interference.',
	'erreur:nojs' => 'Javascript has been deactivated on this page.',
	'erreur:nom' => 'Chyba!',
	'erreur:probleme' => 'Problem with: @pb@',
	'erreur:traitements' => 'The Penknife - Compilation error: forbidden mixing of \'typo\' and \'propre\'!',
	'erreur:version' => 'Tento nástroj je v tejto verzii SPIPU nedostupný.',
	'erreur_groupe' => 'Varovanie: skupina "@groupe@" nebola definovaná!',
	'erreur_mot' => 'Varovanie: Kľúčové slovo "@mot@" nebolo definované!',
	'etendu' => 'Expanded',

	// F
	'f_jQuery:description' => 'Bráni inštalácii {jQuery} na verejne prístupnú stránku, aby sa hospodárne využili "možnosti stroja". Knižnica jQuery ([->http://jquery.com/]) je užitočná pri programovaní pomocou Javascriptu a veľa zásuvných modulov ju aj využíva. SPIP ju využíva v rozhraní úprav. 

Pozor: Niektoré nástroje modulu Vreckový nožík si vyžadujú, aby bol {jQuery} nainštalovaný.',
	'f_jQuery:nom' => 'Deactivate jQuery',
	'filets_sep:aide' => 'Oddeľovacie čiary: <b>__i__</b> alebo <b>i</b> je číslo.<br />Iné dostupné čiary: @liste@',
	'filets_sep:description' => 'Vloží oddeľujúce čiary do hocijakého textu v SPIPe, čo sa dá prispôsobiť v súbore so štýlom.
_ Syntax je: "__code__", ke "code" je buď identifikačné číslo (od 0 do 7) čiary, ktorú chcete vložiť a ktorá je prepojená s príslušným štýlom, alebo názov obrázka v priečinku plugins/couteau_suisse/img/filets.', # MODIF
	'filets_sep:nom' => 'Dividing lines',
	'filtrer_javascript:description' => 'Na ovládanie JavaScriptu, ktorý sa vkladá priamo do textu článkov sú k dispozícii tri možnosti:
- <i>nikdy:</i> JavaScript je všade zakázaný, 
- <i>predvolené:</i> v rozhraní na úpravy je Javascript zvýraznený červenou farbou,
- <i>vždy:</i> JavaScript je vždy akceptovaný.

Pozor: v diskusných fórach, petíciách, kanáloch RSS atď. je JavaScript  <b>vždy</b> zabezpečený tak, aby sa predišlo škodám.[[%radio_filtrer_javascript3%]]',
	'filtrer_javascript:nom' => 'Riadenie JavaScriptu',
	'flock:description' => 'Deactivates the file-locking system which uses the PHP {flock()} function. Some web-hoting environments are unable to work with this function. Do not activate this tool if your site is functioning normally.',
	'flock:nom' => 'Súbory nie sú zamknuté',
	'fonds' => 'Pozadia:',
	'forcer_langue:description' => 'Vynúti si kontext jazyka pre viacjazyčné šablóny, ktoré majú viacjazyčné menu s možnosťou riadiť jazykovú cookie.

Technicky tento nástroj môže robiť toto:
- deaktivuje výber šablóny podľa jazyku objektu,
- deaktivuje automatické kritérium <code>{lang_select}</code> pre bežné objekty (články, novinky, rubriky, atď.).

Takto sa multibloky vždy zobrazia v jazyku podľa požiadavky návštevníka.',
	'forcer_langue:nom' => 'Nanútiť jazyk',
	'format_spip' => 'Články vo formáte SPIPU',
	'forum_lgrmaxi:description' => 'By default forum messages are not limited in size. If this tool is activated, an error message is shown each time someone tries to post a message larger than the size given, and the message is refused. An empty value (or 0) means that no limit will be imposed.[[%forum_lgrmaxi%]]',
	'forum_lgrmaxi:nom' => 'Veľkosť diskusných fór',

	// G
	'glossaire:aide' => 'Text bez slovníka: <b>@_CS_SANS_GLOSSAIRE@</b>',
	'glossaire:description' => '@puce@ Use one or several groups of keywords to manage an internal glossary. Enter the names of the groups here, separating them by  colons (:). If you leave the box empty (or enter "Glossaire"), it is the "Glossaire" group which will be used.[[%glossaire_groupes%]]

@puce@ You can indicate the maximum number of links to create in a text for each word. A null or negative value will mean that all instances of the words will be treated. [[%glossaire_limite% par mot-clé]]

@puce@ There is a choice of two options for generating the small window which appears on the mouseover. [[%glossaire_js%]][[->%glossaire_abbr%]]', # MODIF
	'glossaire:nom' => 'Interný slovník',
	'glossaire_abbr' => 'Ignorovať tagy <code><abbr></code> a <code><acronym></code>',
	'glossaire_css' => 'Riešenie CSS',
	'glossaire_erreur' => 'Kvôli kľúčovému slovu "@mot1@" sa kľúčové slovo "@mot2@" nedá zistiť',
	'glossaire_inverser' => 'Navrhnutá oprava: prehoďte poradie kľúčových slov v databáze.',
	'glossaire_js' => 'Riešenie JavaScriptom',
	'glossaire_ok' => '@nb@ skontrolovaných slov. Zdá sa, že všetky sú v poriadku.',
	'guillemets:description' => 'Automaticky nahrádza rovné úvodzovky (") okrúhlymi, pričom používa správne úvodzovky pre aktuálny jazyk. Nahradenie nemení text uložený v databáze, ale iba jeho zobrazenie na obrazovke.',
	'guillemets:nom' => 'Okrúhle opačné bodky',

	// H
	'help' => '{{This page is only accessible to main site administrators.}} It gives access to the configuration of some additional functions of the {{Penknife}}.',
	'help2' => 'Lokálna verzia: @version@',
	'help3' => '<p>Odkazy na dokumentáciu:<br/>• [{{Vreckový nožík}}->http://www.spip-contrib.net/?article2166]@contribs@</p><p>Obnovenie:
_ • [Skryté nastavenia|Návrat na pôvodný vzhľad tejto stránky->@hide@]
_ • [Celý zásuvný modul|Nastaviť na pôvodné nastavenia zásuvného modulu->@reset@]@install@
</p>',
	'horloge:description' => 'Nástroj vo vývoji. Ponúka javascriptové hodiny. Tag: <code>#HORLOGE{format,utc,id}</code>. Model: <code><horloge></code>',
	'horloge:nom' => 'Hodiny',

	// I
	'icone_visiter:description' => 'Nahradí štandardné tlačidlo  "Navštíviť" (vpravo hore na tejto stránke) logom stránky, ak existuje.

Ak chcete toto logo nastaviť, choďte na "Konfiguráciu stránky" kliknutím na tlačidlo "Konfigurácia".', # MODIF
	'icone_visiter:nom' => 'Tlačidlo "Navštíviť"',
	'insert_head:description' => 'Activate the tag [#INSERT_HEAD->http://www.spip.net/en_article2421.html] in all templates, whether or not this tag is present between <head> et </head>. This option can be used to allow plugins to insert javascript code (.js) or stylesheets (.css).',
	'insert_head:nom' => 'Tag #INSERT_HEAD',
	'insertions:description' => 'N.B.: tool in development!! [[%insertions%]]',
	'insertions:nom' => 'Automatické opravy',
	'introduction:description' => 'This tag can be used in templates to generate short summaries of articles, new items, etc.

{{Beware}} : If you have another plugin defining the fonction {balise_INTRODUCTION()} or you have defined it in your templates, you will get a compilation error.

@puce@ You can specify (as a percentage of the default value) the length of the text generated by the tag #INTRODUCTION. A null value, or a value equal to 100 will not modify anything and return the defaults: 500 characters for the articles, 300 for the news items and 600 for forums and sections.
[[%lgr_introduction% %]]

@puce@ By default, if the text is too long, #INTRODUCTION will end with 3 dots: <html>« (…)»</html>. You can change this to a customized string which shows that there is more text available.[[%suite_introduction%]]

@puce@ If the #INTRODUCTION tag is used to give a summary of an article, the Penknife can generate a link to the article on the 3 dots or string marking that there is more text available. For example : «Read the rest of the article…»[[%lien_introduction%]]
', # MODIF
	'introduction:nom' => 'Tag #INTRODUCTION',

	// J
	'jcorner:description' => '"Zaoblené rohy" je nástroj, ktorý uľahčuje zmenu vzhľadu rohov {{farebných textových polí}} na verejne prístupných stránkach vášho webu. Možné je takmer čokoľvek!
_ Príklady nájdete na tejto stránke: [->http://www.malsup.com/jquery/corner/].

Vytvorte zoznam objektov v svojich šablónach, ktoré majú byť zaoblené. Použite syntax CSS  (.class, #id, atď.). Na použitie  príkazu jQuery použite znak " = "  a na komentáre dve lomky (" // "). Ak nezadáte žiaden znak rovná sa, použije sa ekvivalent k zaobleným rohom  <code>.ma_classe = .corner().</code> [[%jcorner_classes%]]

Pozor! Na to, aby fungoval, tento nástroj potrebuje  zásuvný modul {Zaoblené rohy} typu jQuery. Ak zaškrtnete toto pole, modul Vreckový nožík ho môže nainštalovať automaticky.[[%jcorner_plugin%]]', # MODIF
	'jcorner:nom' => 'Pekné rohy',
	'jcorner_plugin' => '" Round Corners plugin "',
	'jq_localScroll' => 'jQuery.LocalScroll ([demo->http://demos.flesler.com/jquery/localScroll/])',
	'jq_scrollTo' => 'jQuery.ScrollTo ([demo->http://demos.flesler.com/jquery/scrollTo/])',
	'js_defaut' => 'Default',
	'js_jamais' => 'Nikdy',
	'js_toujours' => 'Vždy',
	'jslide_aucun' => 'Žiadna animácia',
	'jslide_fast' => 'Rýchla prezentácia',
	'jslide_lent' => 'Pomalá prezentácia',
	'jslide_millisec' => 'Rýchlosť snímku:',
	'jslide_normal' => 'Normálna prezentácia',

	// L
	'label:admin_travaux' => 'Zatvoriť verejnú stránku pre:',
	'label:alinea' => 'Oblasť použitia:',
	'label:alinea2' => 'Okrem:',
	'label:alinea3' => 'Deaktivovať vkladanie odsekov:',
	'label:arret_optimisation' => 'Stop SPIP from emptying the wastebin automatically:',
	'label:auteur_forum_nom' => 'The visitor must specify:',
	'label:auto_sommaire' => 'Systematic creation of a summary:',
	'label:balise_decoupe' => 'Aktivovať tag #CS_DECOUPE:',
	'label:balise_sommaire' => 'Aktivovať tag #CS_SOMMAIRE:',
	'label:bloc_h4' => 'Tag for the titles:',
	'label:bloc_unique' => 'Len jeden otvorený blok na stránke:',
	'label:blocs_cookie' => 'Použitie cookie:',
	'label:blocs_slide' => 'Typ animácie:',
	'label:compacte_css' => 'Kompresia hlavičky:',
	'label:copie_Smax' => 'Maximálny priestor na miestne kópie:',
	'label:couleurs_fonds' => 'Povoliť pozadia:',
	'label:cs_rss' => 'Aktivovať:',
	'label:debut_urls_propres' => 'Beginning of the URLs:',
	'label:decoration_styles' => 'Your personalised style tags:',
	'label:derniere_modif_invalide' => 'Refresh immediately after a modification:',
	'label:devdebug_espace' => 'Filtrovanie priestoru:',
	'label:devdebug_mode' => 'Aktivovať ladenie',
	'label:devdebug_niveau' => 'Filtrovanie závažnosti nahlásených chýb:',
	'label:distant_off' => 'Deactivate:',
	'label:doc_Smax' => 'Maximálna veľkosť dokumentov:',
	'label:dossier_squelettes' => 'Directory(ies) to use:',
	'label:duree_cache' => 'Duration of local cache:',
	'label:duree_cache_mutu' => 'Duration of mutualised cache:',
	'label:enveloppe_mails' => 'Malá obálka pred e-mailovou adresou:',
	'label:expo_bofbof' => 'Na horný index meniť: <html>St(e)(s), Bx, Bd(s) et Fb(s)</html>',
	'label:filtre_gravite' => 'Gravité maximale acceptée :', # NEW
	'label:forum_lgrmaxi' => 'Value (in characters):',
	'label:glossaire_groupes' => 'Group(s) used:',
	'label:glossaire_js' => 'Technique used:',
	'label:glossaire_limite' => 'Maximum number of links created:',
	'label:i_align' => 'Zarovnanie textu:',
	'label:i_couleur' => 'Farba písma:',
	'label:i_hauteur' => 'Výška riadka:',
	'label:i_largeur' => 'Maximálna šírka riadka:',
	'label:i_padding' => 'Obtekanie textu:',
	'label:i_police' => 'Súbor písma priečinky ({polices/}):',
	'label:i_taille' => 'Veľkosť písma:',
	'label:img_GDmax' => 'Výpočty obrázkov s GD:',
	'label:img_Hmax' => 'Maximálna výška obrázka:',
	'label:insertions' => 'Automatické opravy:',
	'label:jcorner_classes' => 'Improve the corners of the following CSS selectors:',
	'label:jcorner_plugin' => 'Nainštalovať tento zásuvný modul {jQuery:}',
	'label:jolies_ancres' => 'Vypočítať pekné rohy:',
	'label:lgr_introduction' => 'Length of summary:',
	'label:lgr_sommaire' => 'Length of summary (9 to 99):',
	'label:lien_introduction' => 'Body na mape:',
	'label:liens_interrogation' => 'Protect URLs:',
	'label:liens_orphelins' => 'Klikateľné odkazy:',
	'label:log_couteau_suisse' => 'Aktivovať:',
	'label:logo_Hmax' => 'Maximálna výška loga:',
	'label:long_url' => 'Dĺžka klikateľného popisu:',
	'label:marqueurs_urls_propres' => 'Pridať znaky na odlíšenie objektov (SPIP>=2.0):<br />(napr. "-" pre nadpis -Moja-rubrika-, « @ » pour @Mon-site@)',
	'label:max_auteurs_page' => 'Autorov na stránku:',
	'label:message_travaux' => 'Vaša správa týkajúca sa údržby:',
	'label:moderation_admin' => 'Automaticky schvaľovať príspevky od:',
	'label:mot_masquer' => 'Kľúčové slovo skrývajúce obsah:',
	'label:nombre_de_logs' => 'Rotation des fichiers :', # NEW
	'label:ouvre_note' => 'Otváracie a uzatváracie označenia koncových poznámok',
	'label:ouvre_ref' => 'Otváracie a uzatváracie označenia odkazov na koncové poznámky',
	'label:paragrapher' => 'Vždy vkladať odseky:',
	'label:prive_travaux' => 'Access to the editing area for:',
	'label:prof_sommaire' => 'Udržiavaná hĺbka (od 1 do 4):',
	'label:puce' => 'Public bullet «<html>-</html>»:',
	'label:quota_cache' => 'Hodnota kvóty:',
	'label:racc_g1' => 'Beginning and end of "<html>{{bolded text}}</html>":',
	'label:racc_h1' => 'Beginning and end of a «<html>{{{subtitle}}}</html>»:',
	'label:racc_hr' => 'Horizontal line (<html>----</html>) :',
	'label:racc_i1' => 'Beginning and end of «<html>{italics}</html>»:',
	'label:radio_desactive_cache3' => 'Využitie cache:',
	'label:radio_desactive_cache4' => 'Využitie cache',
	'label:radio_target_blank3' => 'New window for external links:',
	'label:radio_type_urls3' => 'Formát www adries:',
	'label:scrollTo' => 'Nainštalovať tieto zásuvné moduly {jQuery:}',
	'label:separateur_urls_page' => 'Oddeľovač \'type-id\'<br/>(napr.: ?article-123):',
	'label:set_couleurs' => 'Set to be used ',
	'label:spam_ips' => 'IP adresy, ktoré treba zablokovať:',
	'label:spam_mots' => 'Prohibited sequences:',
	'label:spip_options_on' => 'Zaradiť:',
	'label:spip_script' => 'Volanie skriptu:',
	'label:style_h' => 'Váš štýl:',
	'label:style_p' => 'Váš štýl:',
	'label:suite_introduction' => 'Body na mape:',
	'label:terminaison_urls_page' => 'URL endings (e.g.: .html):',
	'label:titre_travaux' => 'Názov príspevku:',
	'label:titres_etendus' => 'Activate the extended use of the tags #TITRE_XXX:',
	'label:tout_rub' => 'Verejne zobraziť všetky tieto objekty:',
	'label:url_arbo_minuscules' => 'Nechať veľkosť písma podľa názvu vo www adrese:',
	'label:url_arbo_sep_id' => 'Oddeľovač \'title-id\', ktorý sa použije v prípade duplicity:<br/>(nepoužívajte /)',
	'label:url_glossaire_externe2' => 'Odkaz na externý slovník:',
	'label:url_max_propres' => 'Maximálna dĺžka URL (v znakoch):',
	'label:urls_arbo_sans_type' => 'Vo www adresách zobraziť typ objektu SPIPU:',
	'label:urls_avec_id' => 'A systematic id, but ...',
	'label:webmestres' => 'Zoznam webmasterov:',
	'liens_en_clair:description' => 'Makes the filter: \'liens_en_clair\' available to you. Your text probably contains hyperlinks which are not visible when the page is printed. This filter adds the link code between square brackets for every clickabel link (external links and email addresses). N.B: in printing mode (when using the parameter \'cs=print\' or \'page=print\' in the URL), this treatment is automatically applied.',
	'liens_en_clair:nom' => 'Viditeľné odkazy',
	'liens_orphelins:description' => 'Tento nástroj má dve funkcie:

@puce@ {{Správne odkazy.}}

Vo francúzskych textoch SPIP dodržiava pravidlá francúzskej typografie a vloží medzeru pred otázniky a výkričníky. Tento nástroj zabráni, aby sa to stávalo v internetových adresách.[[%liens_interrogation%]]

@puce@ {{Osamotené odkazy.}}

Systematicky nahradí všetky internetové adresy, ktoré autori vložili do textov (obzvlášť často v diskusných fórach) a na ktoré sa nedá kliknúť odkazmi vo formáte SPIPu. Napríklad {<html>www.spip.net</html>} bude nahradený odkazom: [->www.spip.net].

Môžete si vybrať spôsob nahradenia:
_ • {základný:} odkazy, ako {<html>http://spip.net</html>} (akýkoľvek protokol) a {<html>www.spip.net</html>} budú nahradené.
_ • {rozšírený:} okrem toho takéto odkazy budú nahradené tiež: {<html>me@spip.net</html>,} {<html>mailto:myaddress</html>} alebo {<html>news:mynews</html>}.
_ • {predvolený:} automatické nahrádzanie (od verzie 2.0).
[[%liens_orphelins%]]',
	'liens_orphelins:description1' => '[[Ak má internetová adresa viac ako %long_url% znakov, SPIP ju zmenší na %coupe_url% znakov]].',
	'liens_orphelins:nom' => 'Pekné www adresy',
	'local_ko' => 'La mise à jour automatique du fichier local «@file@» a échoué. Si l\'outil dysfonctionne, tentez une mise à jour manuelle.', # NEW
	'log_brut' => 'Údaje zapísané ako neformátovaný text (nie ako HTML)',
	'log_fileline' => 'Doplňujúce údaje o ladení',

	// M
	'mailcrypt:description' => 'Hides all the email links in your textes and replaces them with a Javascript link which activates the visitor\'s email programme when the link is clicked. This antispam tool attempts to prevent web robots from collecting email addresses which have been placed in forums or in the text displayed by the tags in your templates.',
	'mailcrypt:nom' => 'Šifrovanie pošty',
	'mailcrypt_balise_email' => 'Traiter également la balise #EMAIL de vos squelettes', # NEW
	'mailcrypt_fonds' => 'Ne pas protéger les fonds suivants :<br /><q4>{Séparez-les par les deux points «~:~» et vérifiez bien que ces fonds restent totalement inaccessibles aux robots du Net.}</q4>', # NEW
	'maj_actualise_ok' => 'Le plugin « @plugin@ » n\'a pas officiellement changé de version, mais ses fichiers ont quand même été actualisés afin de bénéficier de la dernière révision de code.', # NEW
	'maj_auto:description' => 'Tento nástroj vám umožňuje ľahko riadiť aktualizáciu rôznych zásuvných modulov, vrátane zistenia čísla revízie v súbore <code>svn.revision</code> a jeho porovnanie s tým, ktoré sa nachádza na stránke <code>zone.spip.org</code>.

Zoznam, ktorý sa nachádza vyššie, vám ponúka možnosť spustiť automatickú aktualizáciu   každého zásuvného modulu SPIPu, ktorý bol predtým nainštalovaný v priečinku <code>plugins/auto/</code>. Ostatné zásuvné moduly z priečinku <code>plugins/</code> alebo <code>extensions/</code> sú uvedené len pre vašu informáciu. Ak sa nenájde vzdialená revízia, skúste zásuvný modul nainštalovať manuálne.

Poznámka: balíky <code>.zip</code> sa nevytvoria nanovo ihneď; môže sa stať, že predtým, ako budete môcť začať s úplnou aktualizáciou zásuvného modulu, ktorý bol nedávno zmenený, budete musieť nejaký čas počkať.',
	'maj_auto:nom' => 'Automatické aktualizácie',
	'maj_fichier_ko' => 'Le fichier « @file@ » est introuvable !', # NEW
	'maj_librairies_ko' => 'Librairies introuvables !', # NEW
	'masquer:description' => 'Tento nástroj vám umožňuje schovať na verejnej stránke bez akejkoľvek zmeny svojich šablón obsah (rubriky alebo články), ktorého kľúčové slová sú zadané nižšie. Ak schováte rubriku, bude schovaná aj celá jej vetva.[[%mot_masquer%]]

Ak chcete zobraziť skrytý obsah, stačí, keď do cyklov svojej šablóny pridáte kritérium <code>{tout_voir}</code>.

Publikované objekty, ale skryté pred verejnosťou:
-* Rubriky: @_RUB@.
-* Články: @_ART@.',
	'masquer:nom' => 'Šifrovanie odkazu',
	'meme_rubrique:description' => 'Určte počet objektov vypísaných na paneli s názvom "<:info_meme_rubrique:>", ktorý sa nachádza na niektorých stránkach súkromnej zóny.[[%meme_rubrique%]]',
	'message_perso' => 'Veľká vďaka prekladateľom, ktorí sa dostali až sem. Pat ;-)',
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
	'no_IP:nom' => 'Bez zaznamenávania IP adries',
	'nouveaux' => 'Nový',

	// O
	'orientation:description' => '3 new criteria for your templates: <code>{portrait}</code>, <code>{carre}</code> et <code>{paysage}</code>. Ideal for sorting photos according to their format (carre = square; paysage = landscape).',
	'orientation:nom' => 'Orientácia obrázka',
	'outil_actif' => 'Aktivovaný nástroj',
	'outil_actif_court' => 'aktívny',
	'outil_activer' => 'Aktivovať',
	'outil_activer_le' => 'Aktivovať nástroj',
	'outil_actualiser' => 'Actualiser l\'outil', # NEW
	'outil_cacher' => 'Už viac nezobrazovať',
	'outil_desactiver' => 'Deactivate',
	'outil_desactiver_le' => 'Deactivate this tool',
	'outil_inactif' => 'Neaktívny nástroj',
	'outil_intro' => 'This page lists the functionalities which the plugin makes available to you.<br /><br />By clicking on the names of the tools below, you choose the ones which you can then switch on/off using the central button: active tools will be disabled and <i>vice versa</i>. When you click, the tools description is shown above the list. The tool categories are collapsible to hide the tools they contain. A double-click allows you to directly switch a tool on/off.<br /><br />For first use, it is recommended to activate tools one by one, thus reavealing any incompatibilites with your templates, with SPIP or with other plugins.<br /><br />N.B.: simply loading this page recompiles all the Penknife tools.',
	'outil_intro_old' => 'This is the old interface.<br /><br />If you have difficulties in using <a href=\\\'./?exec=admin_couteau_suisse\\\'>the new interface</a>, please let us know in the forum of <a href=\\\'http://www.spip-contrib.net/?article2166\\\'>Spip-Contrib</a>.',
	'outil_nb' => '@pipe@: @nb@ nástroj',
	'outil_nbs' => '@pipe@: @nb@ nástrojov',
	'outil_permuter' => 'Switch the tool: « @text@ » ?',
	'outils_actifs' => 'Aktivované nástroje:',
	'outils_caches' => 'Hidden tools:',
	'outils_cliquez' => 'Ak chcete zobraziť popis, kliknite na názov príslušného nástroja.',
	'outils_concernes' => 'Ovplyvnený: ',
	'outils_desactives' => 'Deaktivované: ',
	'outils_inactifs' => 'Neaktívne nástroje:',
	'outils_liste' => 'Zoznam nástrojov modulu Vreckový nožík',
	'outils_non_parametrables' => 'Cannot be configured:',
	'outils_permuter_gras1' => 'Zapnúť nástroje zobrazené tučným písmom',
	'outils_permuter_gras2' => 'Zapnúť @nb@ nástrojov zobrazených tučným písmom?',
	'outils_resetselection' => 'Reset the selection',
	'outils_selectionactifs' => 'Select all the active tools',
	'outils_selectiontous' => 'VŠETKO',

	// P
	'pack_actuel' => 'Balík @date@',
	'pack_actuel_avert' => 'Varovanie: prepísané hodnoty globálnych hodnôt a funkcie "define()" sa tu nenachádzajú',
	'pack_actuel_titre' => 'AKTUÁLNY BALÍK S NASTAVENIAMI MODULU VRECKOVÝ NOŽÍK',
	'pack_alt' => 'See the current configuration parameters',
	'pack_delete' => 'Vymazanie balíka s nastaveniami',
	'pack_descrip' => 'Váš "Balík s aktuálnymi nastaveniami" spája všetky parametre aktivované pre zásuvný modul Vreckový nožík. Pamätá si, či bol nástroj aktivovaný, alebo nie a ak bol, aké možnosti ste si vybrali.

Tento kód PHP môžete uložiť do súboru /config/mes_options.php. Na stránku "balíka {@pack@}" umiestni odkaz na obnovenie. Samozrejme, jeho názov môžete zmeniť nižšie.

Ak zásuvný modul obnovíte kliknutím na balík, modul Vreckový nožík sa sám nastaví podľa hodnôt definovaných v tomto balíku.',
	'pack_du' => 'Z balíka @pack@',
	'pack_installe' => 'Inštalácia balíka s nastaveniami',
	'pack_installer' => 'Are you sure you want to re-initialise the Penknife and install the « @pack@ » pack?',
	'pack_nb_plrs' => 'V tejto chvíli je k dispozícii @nb@ "balíkov s nastaveniami".',
	'pack_nb_un' => '"Balík s nastaveniami" je teraz k dispozícii.',
	'pack_nb_zero' => 'No "configuration pack" is currently available.',
	'pack_outils_defaut' => 'Installation of the default tools',
	'pack_sauver' => 'Uložiť aktuálne nastavenia',
	'pack_sauver_descrip' => 'The button below allows you to insert into your <b>@file@</b> file the parameters needed for an additional "configuration pack" in the the lefthand menu. This makes it possible to reconfigure the Penknife with a single click to the current state.',
	'pack_supprimer' => 'Naozaj chcete odstrániť balík " @pack@ "?',
	'pack_titre' => 'Aktuálne nastavenia',
	'pack_variables_defaut' => 'Installation of the default variables',
	'par_defaut' => 'By default',
	'paragrapher2:description' => 'The SPIP function <code>paragrapher()</code> inserts the tags <p> and </p> around all texts which do not have paragraphs. In order to have a finer control over your styles and layout, you can give a uniform look to your texts throughout the site.[[%paragrapher%]]',
	'paragrapher2:nom' => 'Odseky',
	'pipelines' => 'Entry points used:',
	'previsualisation:description' => 'Podľa predvolených nastavení SPIP umožňuje zobraziť ukážku článku, ako bude vyzerať po publikovaní a použití štýlov, ale iba v prípade, že článok bol "odoslaný na schválnenie". Okrem toho si autori môžu zobraziť aj ukážky článkov, ktoré sa upravujú. Každý si môže zobraziť túto ukážku a upravovať text tak, ako chce.

@puce@ Pozor! Táto funkcia nezasahuje do práv na zobrazenie ukážky textu. Ak chcete, aby mali vaši redaktori naozaj právo na zobrazenie ukážok článkov, ktoré sa upravujú, musíte to povoliť (v menu {[Konfigurácia&gt;Pokročilé funkcie->./?exec=config_fonctions]} v súkromnej zóne).', # MODIF
	'previsualisation:nom' => 'Zobrazujú sa články',
	'puceSPIP' => 'Povoliť klávesové skratky "*"',
	'puceSPIP_aide' => 'Odrážka SPIPU: <b>*</b>',
	'pucesli:description' => 'Z odrážok "-" (spojovník) v článkoch vytvorí číslované zoznamy "-*" (zmenia sa na  &lt;ul>&lt;li>…&lt;/li>&lt;/ul> v HTML), ktorých štýl  môžete upraviť pomocou CSS.

Na to, aby ostal zachovaný prístup k pôvodnému obrázku odrážky SPIPu (malý trojuholník), redaktorom sa môže začiatku riadka "*" ponúknuť nová skratka: [[%puceSPIP%]]',
	'pucesli:nom' => 'Pekné odrážky',

	// Q
	'qui_webmestres' => 'Webmasteri SPIPU',

	// R
	'raccourcis' => 'Active Penknife typographical shortcuts:',
	'raccourcis_barre' => 'Klávesové skratky modulu Vreckový nožík',
	'rafraichir' => 'Na to, aby sa dokončilo nastavovanie zásuvného modulu, aktualizujte túto stránku.',
	'reserve_admin' => 'Access restricted to administrators',
	'rss_actualiser' => 'Aktualizovať',
	'rss_attente' => 'Čaká sa na RSS...',
	'rss_desactiver' => 'Deactivate «Penknife updates»',
	'rss_edition' => 'RSS feed updated:',
	'rss_source' => 'Zdroj RSS',
	'rss_titre' => 'Development of the «The Penknife»:',
	'rss_var' => 'Penknife updates',

	// S
	'sauf_admin' => 'Všetci okrem administrátorov',
	'sauf_admin_redac' => 'Každý okrem administrátorov a redaktorov',
	'sauf_identifies' => 'Každý okrem vymenovaných autorov',
	'sessions_anonymes:description' => 'Tento nástroj každý týždeň kontroluje anonymné sessiony a maže súbory, ktoré sú príliš staré  (viac ako @_NB_SESSIONS3@ dní), aby sa zabránilo preťaženiu servera, najmä v prípade SPAMU na diskusných fórach.

Priečinok, kde sa ukladajú sessiony: @_DIR_SESSIONS@

Na vašej stránke je teraz @_NB_SESSIONS1@ súbor(ov)  session, @_NB_SESSIONS2@ sa týkajú anonymných sessionov.',
	'sessions_anonymes:nom' => 'Anonymné sessiony',
	'set_options:description' => 'Preselects the type of interface (simplified or advanced) for all editors, both existing and future ones. At the same time the button offering the choice between the two interfaces is also removed.[[%radio_set_options4%]]', # MODIF
	'set_options:nom' => 'Type of private interface',
	'sf_amont' => 'Upstream',
	'sf_tous' => 'Všetko',
	'simpl_interface:description' => 'Deactivates the pop-up menu for changing article status which shows onmouseover on the coloured status bullets. This can be useful if you wish to have an editing interface which is as simple as possible for the users.',
	'simpl_interface:nom' => 'Simplification of the editing interface',
	'smileys:aide' => 'Smajlíky: @liste@',
	'smileys:description' => 'Vloží smajlíkov do textu, v ktorom sú skratky v podobe <acronym>:-)</acronym>. Ideálne pre diskusné fóra.
_ Tag je k dispozícii na zobrazenie tabuľky smajlíkov v šablónach: #SMILEYS.
_ Obrázky: [Sylvain Michel->http://www.guaph.net/]',
	'smileys:nom' => 'Smajlíky',
	'soft_scroller:description' => 'Ponúka efekt pomalého posúvania, keď návštevní klikne na odkaz s odkazom na kotvu. V dlhom texte to pomáha návštevníkom zorientovať sa, kde sa nachádzajú.

Pozor, na to aby tento nástroj fungoval, musí byť použitý na stránkach «DOCTYPE XHTML» (nie HTML!). Vyžaduje si aj dva zásuvné moduly {jQuery}: {ScrollTo} a {LocalScroll}. Modul Vreckový nožík ich môže nainštalovať, ak zaškrtnete tieto dve políčka. [[%scrollTo%]][[->%LocalScroll%]]
@_CS_PLUGIN_JQUERY192@',
	'soft_scroller:nom' => 'Ľahké kotvy',
	'sommaire:description' => 'Builds a summary of your articles in order to access the main headings quickly (HTML tags &lt;h3>A Subtitle&lt;/h3> or SPIP subtitle shortcuts in the form: <code>{{{My subtitle}}}</code>).

Pour information, l\'outil « [.->class_spip] » permet de choisir la balise &lt;hN> utilisée pour les intertitres de SPIP.

@puce@ Définissez ici la profondeur retenue sur les intertitres pour construire le sommaire (1 = &lt;@h3@>, 2 = &lt;@h3@> et &lt;@h4@>, etc.) :[[%prof_sommaire%]]

@puce@ You can define the maximum number of characters of the subtitles used to make the summary:[[%lgr_sommaire% characters]]

@puce@ You can also determine the way in which the plugin constructs the summary: 
_ • Systematically, for each article (a tag <code>@_CS_SANS_SOMMAIRE@</code> placed anywhere within the text of the article will make an exception to the rule).
_ • Only for articles containing the <code>@_CS_AVEC_SOMMAIRE@</code> tag.

[[%auto_sommaire%]]

@puce@ By default, the Penknife inserts the summary at the top of the article. But you can place it elsewhere, if you wish, by using the #CS_SOMMAIRE tag, which you can activate here:
[[%balise_sommaire%]]

The summary can be used in conjunction with : « [.->decoupe] » and « [.->titres_typo] ».', # MODIF
	'sommaire:nom' => 'Automatické zhrnutie',
	'sommaire_ancres' => 'Vybrané kotvy: <b><html>{{{Môj nadpis&lt;moja_kotva>}}}</html></b>',
	'sommaire_avec' => 'An article with summary: <b>@_CS_AVEC_SOMMAIRE@</b>',
	'sommaire_sans' => 'An article without summary: <b>@_CS_SANS_SOMMAIRE@</b>',
	'sommaire_titres' => 'Štruktúrované podnadpisy: <b><html>{{{*Nadpis}}}</html></b>, <b><html>{{{**Podnadpis}}}</html></b>, atď.',
	'spam:description' => 'Attempts to fight against the sending of abusive and automatic messages through forms on the public site. Some words and the tags  &lt;a>&lt;/a> are prohibited. Train your authors to use SPIP shortcuts for links.

@puce@ List here the sequences you wish to prohibit separating them with spaces. [[%spam_mots%]]
<q1>• Expressions containing spaces should be placed within inverted commas.
_ • To specify a whole word, place it in brackets. For example: {(asses)}.
_ • To use a regular expression, first check the syntax, then place it between slashes and inverted commas.
_ Example:~{<html>\\"/@test.(com|en)/\\"</html>}.
_ • Pour une expression régulière devant agir sur des caractères HTML, placez le test entre «&#» et «;».
_ Example:~{<html>\\"/&#(?:1[4-9][0-9]{3}|[23][0-9]{4});/\\"</html>}.</q1>

@puce@ Certaines adresses IP peuvent également être bloquées à la source. Sachez toutefois que derrière ces adresses (souvent variables), il peut y avoir plusieurs utilisateurs, voire un réseau entier.[[%spam_ips%]]
<q1>• Utilisez le caractère «*» pour plusieurs chiffres, «?» pour un seul et les crochets pour des classes de chiffres.</q1>', # MODIF
	'spam:nom' => 'Boj proti SPAMU',
	'spam_ip' => 'Zablokovanie IP adresy @ip@:',
	'spam_test_ko' => 'This message would be blocked by the anti-SPAM filter!',
	'spam_test_ok' => 'This message would be accepted by the anti-SPAM filter!',
	'spam_tester_bd' => 'Tiež otestuje vašu databázu a vypíše správy, ktoré zablokovali aktuálne nastavenia tohto nástroja.',
	'spam_tester_label' => 'Tu otestujte svoj zoznam zakázaných slov:',
	'spip_cache:description' => '@puce@ The cache occupies disk space and SPIP can limit the amount of space taken up. Leaving empty or putting 0 means that no limit will be applied.[[%quota_cache% Mo]]

@puce@ When the site\'s contents are changed, SPIP immediately invalidates the cache without waiting for the next periodic recalculation. If your site experiences performance problems because of the load of repeated recalculations, you can choose "no" for this option.[[%derniere_modif_invalide%]]

@puce@ If the #CACHE tag is not found in a template then by default SPIP caches a page for 24 hours before recalculating it. You can modify this default here.[[%duree_cache% heures]]

@puce@ If you are running several mutualised sites, you can specify here the default value for all the local sites (SPIP 2.0 mini).[[%duree_cache_mutu% heures]]', # MODIF
	'spip_cache:description1' => '@puce@ Podľa predvolených nastavení SPIP registruje všetky verejne prístupné stránky a ukladá ich do cache, aby sa potom rýchlejšie načítali. Dočasné deaktivovanie cache môže pomôcť pri vývoji stránky. [[%radio_desactive_cache3%]]',
	'spip_cache:description2' => '@puce@ Na nastavenie fungovania cache SPIPu máte štyri možnosti: <q1>
_ • {Bežné používanie:} SPIP uloží všetky obnovené stránky verejne prístupnej stránky do cache, aby sa zrýchlilo ich načítavanie. Po istom čase sa cache obnoví a stránky sa uložia nanovo.
_ • {Trvalá cache:} časové limity na vyprázdnenie cache sa budú ignorovať.
_ • {Žiadna cache:} dočasné deaktivovanie cache môže napomôcť pri vytváraní stránky.  Pri tejto možnosti sa nebude nič ukladať na disk.
_ • {Kontrola cache:} rovnaké ako predchádzajúca možnosť. Všetky výsledky sa však zapisujú na disk, aby sa dali skontrolovať.</q1>[[%radio_desactive_cache4%]]',
	'spip_cache:description3' => '@puce@ Rozšírenie "Compresser" dostupné v SPIPe umožňuje skomprimovať rôzne prvky CSS a JavaScript z vašich stránok a uložiť ich do statickej cache. Tak sa zrýchli zobrazenie stránky a obmedzí sa počet požiadaviek na server, ako aj výsledná veľkosť súborov.',
	'spip_cache:nom' => 'SPIP and the cache',
	'spip_ecran:description' => 'Nastaví šírku obrazovky pre každého v súkromnej zóne. Úzka obrazovka zobrazí dva stĺpce a široká obrazovka zobrazí tri. Predvolené nastavenia nechávajú používateľa, aby sa rozhodol sám, čo sa uloží v cookie prehliadača.[[%spip_ecran%]]',
	'spip_ecran:nom' => 'Šírka obrazovky',
	'spip_log:description' => '@puce@ Gérez ici les différents paramètres pris en compte par SPIP pour mettre en logs les évènements particuliers du site. Fonction PHP à utiliser : <code>spip_log()</code>.@SPIP_OPTIONS@
[[Ne conserver que %nombre_de_logs% fichier(s), chacun ayant pour taille maximale %taille_des_logs% Ko.<br /><q3>{Mettre à zéro l\'une de ces deux cases désactive la mise en log.}</q3>]][[@puce@ Dossier où sont stockés les logs (laissez vide par défaut) :<q1>%dir_log%{Actuellement :} @DIR_LOG@</q1>]][[->@puce@ Fichier par défaut : %file_log%]][[->@puce@ Extension : %file_log_suffix%]][[->@puce@ Pour chaque hit : %max_log% accès par fichier maximum]]', # NEW
	'spip_log:description2' => '@puce@ Le filtre de gravité de SPIP permet de sélectionner le niveau d\'importance maximal à prendre en compte avant la mise en log d\'une donnée. Un niveau 8 permet par exemple de stocker tous les messages émis par SPIP.[[%filtre_gravite%]][[radio->%filtre_gravite_trace%]]', # NEW
	'spip_log:description3' => '@puce@Špeciálne protokoly pre modul Vreckový nožík aktivujte tu: «[.->cs_comportement]».', # MODIF
	'spip_log:nom' => 'SPIP a jeho protokoly',
	'stat_auteurs' => 'Autori v štatistikách',
	'statuts_spip' => 'Iba tento status SPIPU:',
	'statuts_tous' => 'Všetky stavy',
	'suivi_forums:description' => 'The author of an article is always informed when a message is posted in the article\'s public forum. It is also possible to inform others: either all the forum\'s participants, or  just all the authors of messages higher in the thread.[[%radio_suivi_forums3%]]',
	'suivi_forums:nom' => 'Zoznam verejných diskusných fór',
	'supprimer_cadre' => 'Odstrániť tento rám',
	'supprimer_numero:description' => 'Applies the supprimer_numero() SPIP function to all {{titles}}, {{names}} and {{types}} (of keywords) of the public site, without needing the filter to be present in the templates.<br />For a multilingual site, follow this syntax: <code>1. <multi>My Title[fr]Mon Titre[de]Mein Titel</multi></code>',
	'supprimer_numero:nom' => 'Delete the number',

	// T
	'test_i18n:description' => 'Toutes les chaînes de langue qui ne sont pas internationalisées (donc présentes dans les fichiers lang/*_XX.php) vont apparaitre en rouge.
_ Utile pour n\'en oublier aucune !

@puce@ Un test : ', # NEW
	'test_i18n:nom' => 'Chýbajúce preklady',
	'timezone:description' => 'Depuis PHP 5.1.0, chaque appel à une fonction date/heure génère une alerte de niveau E_NOTICE si le décalage horaire n\'est pas valide et/ou une alerte de niveau E_WARNING si vous utilisez des configurations système, ou la variable d\'environnement TZ.
_ Depuis PHP 5.4.0, la variable d\'environnement TZ et les informations disponibles via le système d\'exploitation ne sont plus utilisées pour deviner le décalage horaire.

Réglage actuellement détecté : @_CS_TZ@.

@puce@ {{Définissez ci-dessous le décalage horaire à utiliser sur ce site.}}
[[%timezone%<q3>Liste complète des fuseaux horaires : [->http://www.php.net/manual/fr/timezones.php].</q3>]].', # NEW
	'timezone:nom' => 'Décalage horaire', # NEW
	'titre' => 'Vreckový nožík',
	'titre_parent:description' => 'Within a loop it is common to want to show the title of the parent of the current object. You normally need to use a second loop to do this, but a new tag #TITRE_PARENT makes the syntax easier. In the case of a MOTS loop, the tag gives the title of the keyword group. For other objetcs (articles, sections, news items, etc.) it gives the title of the parent section (if it exists).

Note: For keywords, #TITRE_GROUPE is an alias of #TITRE_PARENT. SPIP treats the contents of these new tags as it does other #TITRE tags.

@puce@ If you are using SPIP 2.0, then you can use an array of tags of this form: #TITRE_XXX, which give you the title of the object \'xxx\', provided that the field \'id_xxx\' is present in the current table (i.e. #ID_XXX is available in the current loop).

For example, in an (ARTICLES) loop, #TITRE_SECTEUR will give the title of the sector of the current article, since the identifier #ID_SECTEUR (or the field  \'id_secteur\') is available in the loop.[[%titres_etendus%]]', # MODIF
	'titre_parent:nom' => 'Tagy #TITRE_PARENT/OBJECT',
	'titre_tests' => 'The Penknife - Test page',
	'titres_typo:description' => 'Zmení všetky nadpisy <html> "{{{Môj nadpis}}}"</html> na nastaviteľný typografický obrazec.[[%i_taille% pt]][[%i_couleur%]][[%i_police%

Dostupné písma: @_CS_FONTS@]][[%i_largeur% px]][[%i_hauteur% pt]][[%i_padding% px]][[%i_align%]]

Tento nástroj je kompatibilný s nástrojom: "[.->sommaire]".',
	'titres_typo:nom' => 'Medzititulok v obrázku',
	'titres_typographies:description' => 'Par défaut, les raccourcis typographiques de SPIP <html>({, {{, etc.)</html> ne s\'appliquent pas aux titres d\'objets dans vos squelettes.
_ Cet outil active donc l\'application automatique des raccourcis typographiques de SPIP sur toutes les balises #TITRE et apparentées (#NOM pour un auteur, etc.).

Exemple d\'utilisation : le titre d\'un livre cité dans le titre d\'un article, à mettre en italique.', # NEW
	'titres_typographies:nom' => 'Typografické nadpisy',
	'tous' => 'Všetko',
	'toutes_couleurs' => '36 farieb v štýloch CSS: @_CS_EXEMPLE_COULEURS@',
	'toutmulti:aide' => 'Multilingual blocks: <b><:trad:></b>', # MODIF
	'toutmulti:description' => 'Makes it possible to use the shortcut <code><:a_text:></code> in order to place multilingual blocks from language files, whether SPIP\'s own or your customised ones, anywhere in the text, titles, etc. of an article.

More information on this can be found in [this article->http://www.spip.net/en_article2444.html].

User variables can also be added to the shortcuts. This was introduced with SPIP 2.0. For example, <code><:a_text{name=John, tel=2563}:></code> makes it possible to pass the values to the SPIP language file: <code>\'a_text\'=>\'Please contact @name@, the administrator, on @tel@.</code>.

The SPIP function used is: <code>_T(\'a_text\')</code> (with no parmameters), and <code>_T(\'a_text\', array(\'arg1\'=>\'some words\', \'arg2\'=>\'other words\'))</code> (with parameters).

Do not forget to check that the variable used <code>\'a_text\'</code> is defined in the language files.', # MODIF
	'toutmulti:nom' => 'Viacjazyčné bloky',
	'trad_help' => '{{Modul Vreckový nožík dobrovoľníci prekladajú do mnohých jazykov a jeho rodným jazykom je francúzština.}}

Ak nájdete nejaké chyby v textoch zásuvného modulu, pokojne môžete ponúknuť vlastnú verziu. Celý tím vám vopred ďakuje.

Registrácia do prekladateľskej zóny: @url@

Na to, aby mali priamy prístup k prekladom modulu Vreckový nožík, kliknite na cieľový jazyk podľa vlastného výberu. Po prihlásení nájdite malú ceruzku, ktorá sa (pri prejdení myšou) nachádza pri preloženom texte a kliknite na ňu.

Vaše zmeny sa prejavia o niekoľko dni neskôr ako aktualizácia modulu Vreckový nožík. Ak váš jazyk nie je v zozname, stránka prekladu vám umožní ľahko ho  doplniť.

{{Momentálne dostupné preklady:}} @trad@

{{Ďakujeme súčasným prekladateľom:}} @contrib@.',
	'trad_mod' => 'Modul "@mod@": ',
	'travaux_masquer_avert' => 'Schovať rám, ktorý uvádza na verejnej stránke, že sa vykonáva údržba',
	'travaux_nocache' => 'Deaktivovať aj cache SPIPu',
	'travaux_nom_site' => '@_CS_NOM_SITE@',
	'travaux_prochainement' => 'This site will be back online soon.
_ Thank you for your understanding.',
	'travaux_titre' => '@_CS_TRAVAUX_TITRE@',
	'tri_articles:description' => 'Choose the sort order to be used for displaying articles in the editing interface ([->./?exec=auteurs]), within the sections.

The options below use the SQL function \'ORDER BY\'. Only use the customised option if you know what you are doing (the available fields are: {id_article, id_rubrique, titre, soustitre, surtitre, statut, date_redac, date_modif, lang, etc.})
[[%tri_articles%]][[->%tri_perso%]]', # MODIF
	'tri_articles:nom' => 'Triedenie SPIPU',
	'tri_groupe' => 'Zotriediť podľa čísla skupiny (ZORADIŤ PODĽA id_groupe)',
	'tri_modif' => 'Zotriediť podľa dátumu poslednej zmeny (ZORADIŤ PODĽA date_modif)',
	'tri_perso' => 'Sort by customised SQL, ORDER BY:',
	'tri_publi' => 'Zotriediť podľa dátumu publikovania (ZORADIŤ PODĽA DÁTUMU PUBLIKOVANIA)',
	'tri_titre' => 'Zotriediť podľa názvu (ZORADIŤ PODĽA 0+názov, názov)',
	'trousse_balises:description' => 'Tool in development. It offers a few simple tags for templates.

@puce@ {{#BOLO}}: generates a dummy text of about 3000 characters ("bolo" ou "lorem ipsum") for use with templates in development. An optional argument specifies the length of the text, e.g. <code>#BOLO{300}</code>. The tag accepts all SPIP\'s filters. For example, <code>[(#BOLO|majuscules)]</code>.
_ It can also be used as a model in content. Place <code><bolo300></code> in any text zone in order to obtain 300 characters of dummy text.

@puce@ {{#MAINTENANT}} (or {{#NOW}}): renders the current date, just like: <code>#EVAL{date(\'Y-m-d H:i:s\')}</code>. An optional argument specifies the format. For example, <code>#MAINTENANT{Y-m-d}</code>. As with <code>#DATE</code> the display can be customised using filters: <code>[(#MAINTENANT|affdate)]</code>.

- {{#CHR<html>{XX}</html>}}: a tag equivalent to <code>#EVAL{"chr(XX)"}</code> which is useful for inserting special characters (such as a line feed) or characters which are reserved for special use by the SPIP compiler (e.g. square and curly brackets).

@puce@ {{#LESMOTS}}: ', # MODIF
	'trousse_balises:nom' => 'Box of tags',
	'type_urls:description' => '@puce@ SPIP offers a choice between several types of URLs for your site:

More information: [->http://www.spip.net/en_article3588.html] The "[.->boites_privees]" tool allows you to see on the page of each SPIP object the clean URL which is associated with it.
[[%radio_type_urls3%]]
<q3>@_CS_ASTER@to use the types {html}, {propres}, {propres2}, {libres} or {arborescentes}, copy the file "htaccess.txt" from the root directory of the SPIP site to a file (also at the root) named ".htaccess" (be careful not to overwrite any existing configuration if there already is a file of this name). If your site is in a subdirectory, you may need to edit the line "RewriteBase" in the file in order for the defined URLs to direct requests to the SPIP files.</q3>

<radio_type_urls3 valeur="page">@puce@ {{URLs «page»}}: the default type for SPIP since version 1.9x.
_ Example: <code>/spip.php?article123</code>.
[[%terminaison_urls_page%]][[%separateur_urls_page%]]</radio_type_urls3>

<radio_type_urls3 valeur="html">@puce@ {{URLs «html»}}: URLs take the form of classic html pages.
_ Example : <code>/article123.html</code></radio_type_urls3>

<radio_type_urls3 valeur="propres">@puce@ {{URLs «propres»}}: URLs are constructed using the title of the object. Markers (_, -, +, @, etc.) surround the titles, depending on the type of object.
_ Examples : <code>/My-article-title</code> or <code>/-My-section-</code> or <code>/@My-site@</code>[[%terminaison_urls_propres%]][[%debut_urls_propres%]][[%marqueurs_urls_propres%]]</radio_type_urls3>

<radio_type_urls3 valeur="propres2">@puce@ {{URLs «propres2»}}: the extension \'.html\' is added to the URLs generated.
_ Example : <code>/My-article-title.html</code> or <code>/-My-section-.html</code>
[[%debut_urls_propres2%]][[%marqueurs_urls_propres2%]]</radio_type_urls3>

<radio_type_urls3 valeur="libres">@puce@ {{URLs «libres»}} : the URLs are like {«propres»}, but without markers  (_, -, +, @, etc.) to differentiate the objects.
_ Example : <code>/My-article-title</code> or <code>/My-section</code>
[[%terminaison_urls_libres%]][[%debut_urls_libres%]]</radio_type_urls3>

<radio_type_urls3 valeur="arbo">@puce@ {{URLs «arborescentes»}}: URLs are built in a tree structure.
_ Example : <code>/sector/section1/section2/My-article-title</code>
[[%url_arbo_minuscules%]][[%urls_arbo_sans_type%]][[%url_arbo_sep_id%]][[%terminaison_urls_arbo%]]</radio_type_urls3>

<radio_type_urls3 valeur="propres-qs">@puce@ {{URLs «propres-qs»}}:  this system functions using a "Query-String", in other words, without using the .htaccess file. The URLs are of the form. URLs are similar in form to {«propres»}.
_ Example : <code>/?My-article-title</code>
[[%terminaison_urls_propres_qs%]]</radio_type_urls3>

<radio_type_urls3 valeur="standard">@puce@ {{URLs «standard»}}: these now discarded URLs were used by SPIP up to version 1.8.
_ Example : <code>article.php3?id_article=123</code>
</radio_type_urls3>

@puce@ If you are using the type  {page} described above or if the object requested is not recognised, you can choose the calling script for SPIP. By default, SPIP uses {spip.php}, but {index.php} (format: <code>/index.php?article123</code>) or an empty value (format: <code>/?article123</code>) are also possible. To use any other value, you need to create the corresponding file at the root of your site with the same contents as in the file {index.php}.
[[%spip_script%]]', # MODIF
	'type_urls:description1' => '@puce@ Ak používate internetové adresy (URL) založené na určitom formáte, napríklad  "pekné" ({propres}, {propres2}, {voľné}, {stromovité} alebo {propres_qs}), modul Vreckový nožík môže:
<q1>• skontrolovať, či je celá internetová adresa zapísaná {{malými písmenami.}}</q1>[[%urls_minuscules%]]
<q1>• systematicky pridávať {{ID objektu}} k internetovej adrese (ako príponu, predponu, atď.).
_ (Príklady: <code>/Nadpis-mojho-clanku,457</code> alebo <code>/457-Nadpis-mojho-clanku</code>)</q1>',
	'type_urls:description2' => '{Poznámka:} zmena v tomto odseku si môže vyžadovať vyprázdnenie tabuľky internetových adries (URL), aby SPIP mohol zohľadniť nové nastavenia.',
	'type_urls:nom' => 'Formát www adries',
	'typo_exposants:description' => '{{Text vo francúzštine:}} vylepšuje typografické spracovanie bežných skratiek pridaním horného indexu tam, kde je to potrebné (takto sa z {<acronym>Mme</acronym>} stane {M<sup>me</sup>}). Opravuje bežné chyby:  (z {<acronym>2ème</acronym>} a  {<acronym>2me</acronym>,} sa napríklad stane {2<sup>e</sup>,} jediná správna skratka).

Spracúvané skratky sa zhodujú s Imprimerie nationale uvedenými v {Lexique des règles typographiques en usage à l\'Imprimerie nationale} (článok "Skratky", Presses de l\'Imprimerie nationale, Paríž, 2002).

Spracúvajú sa aj tieto výrazy: <html>Dr, Pr, Mgr, St, Bx, m2, m3, Mn, Md, Sté, Éts, Vve, bd, Cie, 1o, 2o, etc.</html>

Tu sa môžete rozhodnúť, že pri písaní niektorých ďalších skratiek budete používať horný index napriek tomu, že Imprimerie nationale má k tomu zamietavé stanovisko:[[%expo_bofbof%]]

{{Anglický text:}} prípony radových čísloviek budú automaticky zapísané horným indexom: <html>1st, 2nd,</html> atď.',
	'typo_exposants:nom' => 'Horný index',

	// U
	'url_arbo' => 'stromovité @_CS_ASTER@',
	'url_html' => 'html@_CS_ASTER@',
	'url_libres' => 'libres@_CS_ASTER@',
	'url_page' => 'stránka',
	'url_propres' => 'propres@_CS_ASTER@',
	'url_propres-qs' => 'propres-qs',
	'url_propres2' => 'propres2@_CS_ASTER@',
	'url_propres_qs' => 'propres_qs',
	'url_standard' => 'štandardná',
	'url_verouillee' => 'Adresa uzavretá',
	'urls_3_chiffres' => 'Vyžadovať aspoň 3 číslice',
	'urls_avec_id' => 'Zapísať ako dolný index',
	'urls_avec_id2' => 'Place as a prefix',
	'urls_base_total' => 'Momentálne je v databáze @nb@ adresa (-ies)',
	'urls_base_vide' => 'Databáza www adries je prázdna',
	'urls_choix_objet' => 'Edit the URL of a specific object in the database:',
	'urls_edit_erreur' => 'The current URL format ("@type@") does not permit editing.',
	'urls_enregistrer' => 'Zapísať túto adresu do databázy',
	'urls_id_sauf_rubriques' => 'Vylúčiť tieto objekty (oddelené znakom ":"):',
	'urls_minuscules' => 'Malé písmená',
	'urls_nouvelle' => 'Upraviť "čistú" www adresu:',
	'urls_num_objet' => 'Number:',
	'urls_purger' => 'Vymazať všetko',
	'urls_purger_tables' => 'empty tables selected',
	'urls_purger_tout' => 'Reset the URLs stored in the database:',
	'urls_rechercher' => 'Nájsť tento objekt v databáze',
	'urls_titre_objet' => 'Saved title:',
	'urls_type_objet' => '<MODF>Order:',
	'urls_url_calculee' => 'URL PUBLIC  « @type@ »:',
	'urls_url_objet' => 'Uložená "čistá" adresa:',
	'urls_valeur_vide' => '(Prázdna hodnota prepína na obnovenie adresy stránky)',
	'urls_verrouiller' => '{{Zamknite}} túto internetovú adresu, aby ju SPIP nemohol zmeniť, napr. keď niekto klikne na " @voir@ " alebo keď sa zmení nadpis.',

	// V
	'validez_page' => 'To access modifications:',
	'variable_vide' => '(Prázdne)',
	'vars_modifiees' => 'The data has been modified',
	'version_a_jour' => 'Vaša verzia je aktuálna.',
	'version_distante' => 'Vzdialená verzia...',
	'version_distante_off' => 'REmote checking deactivated',
	'version_nouvelle' => 'Nová verzia: @version@',
	'version_revision' => 'Oprava: @revision@',
	'version_update' => 'Automatic update',
	'version_update_chargeur' => 'Automatic download',
	'version_update_chargeur_title' => 'Download the latest version of the plugin using the plugin «Downloader»',
	'version_update_title' => 'Downloads the latest version of the plugin and updates it automatically.',
	'verstexte:description' => '2 filtre pre vaše šablóny, ktoré vám umožňujú vytvárať stránky, ktoré zaberajú menej miesta.
_ version_texte: extrahuje text HTML stránky, okrem niektorých základných tagov.
_ version_plein_texte: extrahuje celý text html stránky.',
	'verstexte:nom' => 'Textová verzia',
	'visiteurs_connectes:description' => 'Vytvorí fragment HTML pre vaše šablóny, ktorý zobrazí počet návštevníkov, ktorí sú práve pripojení na verejnej stránke.

Jednoducho do šablóny pridajte <code><INCLURE{fond=fonds/visiteurs_connectes}>.</code>',
	'visiteurs_connectes:inactif' => 'Pozor: štatistiky stránky nie sú aktivované.',
	'visiteurs_connectes:nom' => 'Prihlásení návštevníci',
	'voir' => 'Pozri: @voir@',
	'votre_choix' => 'Váš výber:',

	// W
	'webmestres:description' => 'V SPIPe je {{webmaster}}  {{administrator,}} ktorý má k stránke prístup cez FTP. Podľa predvolených nastavení počnúc SPIPom 2.0 sa predpokladá, že je to  administrátor, ktorého <code>id_auteur=1</code>. Webmasteri, ktorí sú definovaní tu, majú privilégium, že už viac nemusia používať FTP na potvrdzovanie dôležitých úkonov na stránke, ako sú aktualizovanie formátu databázy alebo obnova zo zálohy. 

Aktuálni webmasteri: {@_CS_LISTE_WEBMESTRES@}.
_ Spôsobilí administrátori: {@_CS_LISTE_ADMINS@}.

Ako webmaster môžete meniť tento zoznam ID. Ak ich je viac, ako oddeľovač použite dvojbodku, napr.  "1:5:6".[[%webmestres%]]', # MODIF
	'webmestres:nom' => 'Zoznam webmasterov',

	// X
	'xml:description' => 'Activates the XML validator for the public site, as described in the [documentation->http://www.spip.net/en_article3582.html]. An « Analyse XML » button is added to the other admin buttons.', # MODIF
	'xml:nom' => 'Validátor XML'
);

?>
