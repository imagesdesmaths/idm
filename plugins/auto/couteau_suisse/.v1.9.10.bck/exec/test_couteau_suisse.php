 <?php
#-----------------------------------------------------#
#  Plugin  : Couteau Suisse - Licence : GPL           #
#  Auteur  : Patrice Vanneufville, 2006               #
#  Contact : patrice¡.!vanneufville¡@!laposte¡.!net   #
#  Infos : http://contrib.spip.net/?article2166       #
#---------------------------------------------------------------#
# Cette page teste certaines fonctions presentes dans le plugin #
# Pour rajouter des tests, rdv tout en bas de cette page !      #
#---------------------------------------------------------------#

include_spip('inc/texte');
include_spip('inc/layer');
include_spip("inc/presentation");

function exec_test_couteau_suisse() {
cs_log("DEDUT : exec_test_couteau_suisse()");
	global $connect_statut, $connect_toutes_rubriques;

	cs_minipres();

	// initialisation generale forcee : recuperation de $outils;
	cs_initialisation(true);

	$commencer_page = charger_fonction('commencer_page', 'inc');
	echo $commencer_page(_T('couteauprive:titre_tests'), "configuration", 'couteau_suisse');

	echo '<br /><br /><br />', gros_titre(_T('couteauprive:titre_tests'), '', false), 
		'<div style="width:98%; text-align:left; margin:0 auto">';

	// et hop, on lance les tests !
	cs_les_tests();
	echo '</div>';

	echo fin_page();
cs_log(" FIN : exec_test_couteau_suisse()");
}

// renvoie un tableau contenant le texte original et sa transfrmation par la fonction $fonction
// $textes est un tableau de chaines
function cs_test_fun(&$textes, $fonction) {
	$a = array();
	if (!function_exists($fonction)) return array('erreur' => "$fonction() introuvable : outil non activ&eacute; !");
	foreach ($textes as $i=>$t) {
		$b = $fonction($t);
		$a["$i. test"] = htmlentities($t, ENT_COMPAT, $GLOBALS['meta']['charset']);
//		$a["\$resultat[$i]"] = htmlentities($b);
		$a["$i. r&eacute;sultat"] = str_replace("\n",'\n', $b);
	}
	return $a;
}

// affiche un cadre de titre $titre base sur les donnees de $array
function test_outil($array, $titre) {
	global $icone;
	static $i; $i++;
	echo "<a id=$i></a>",debut_cadre_trait_couleur($icone,true,'',"$i. $titre");
	foreach($array as $s=>$v) {
		// unserialize eventuel des tableaux
		if(is_string($v) && strncmp($v,'a:',2)===0 && ($t=@unserialize($v))!==false) 
			$v = couper('serialized_'.htmlentities(var_export($t,1)),1000);
		if(is_array($v))
			foreach($v as $s2=>$v2) {
				if(is_array($v2)) $v2 = htmlentities(var_export($v2,1));
				echo "\n<b>{$s}[$s2]</b> = ".trim($v2)."<br />";
			}
		else echo "\n<b>$s</b> = ".trim($v)."<br />";
	}
	echo fin_cadre_trait_couleur(true);
}

// affiche un text en rouge
function cs_red($s){ return "<span style='color:red;'>$s</span>"; }

// effectue tous les tests !
function cs_les_tests() {
	global $icone, $metas_vars, $metas_outils;
	$icone = cs_icone(24);

	test_outil($_SERVER, 'Echo de : $_SERVER[]');
	test_outil($_ENV, 'Echo de : $_ENV[]');
	global $HTTP_ENV_VARS;
	test_outil($HTTP_ENV_VARS, 'Echo de : $HTTP_ENV_VARS');
	$a = array('DOCUMENT_ROOT'=>getenv('DOCUMENT_ROOT'),
			'REQUEST_URI'=>getenv('REQUEST_URI'),
			'SCRIPT_NAME'=>getenv('SCRIPT_NAME'),
			'PHP_SELF'=>getenv('PHP_SELF'),
		);
	test_outil($a, 'Echo de : getenv()');

	// lecture des infos sur le plugin
	include_spip('inc/plugin');
	if(isset($GLOBALS['meta']['plugin'])) {
		$t = unserialize($GLOBALS['meta']['plugin']);
		$dir = $t['COUTEAU_SUISSE']['dir'];
		$dir_type = $t['COUTEAU_SUISSE']['dir_type'];
	}
	if(!strlen($dir)) $dir = 'couteau_suisse';
	$get_infos = defined('_SPIP20100')?charger_fonction('get_infos','plugins'):'plugin_get_infos';
	$t = isset($dir_type)?$get_infos($dir, false, constant($dir_type)):$get_infos($dir);
	$t['svn.revision'] = ((lire_fichier(_DIR_PLUGIN_COUTEAU_SUISSE.'svn.revision',$tmp)) && (preg_match(',<revision>(\d+)</revision>,',$tmp, $r)))?$r[1]:"-";
	$t['meta/couteau_suisse_base_version'] = $GLOBALS['meta']['couteau_suisse_base_version'];
	test_outil($t, 'Infos sur votre plugin pr&eacute;f&eacute;r&eacute; :-)');

//	$GLOBALS['meta']
	test_outil($GLOBALS['meta'], 'Toutes les metas de SPIP !');

	// lecture des variables stockees en meta
	test_outil($metas_outils, 'Outils actifs : $metas_outils[]');
	test_outil($metas_vars, 'Contenu des variables : $metas_vars[]');

	// test de url_absolue()
	$relative_path = find_in_path('img/smileys');
	$realpath = str_replace("\\", "/", realpath($relative_path));
	$root = preg_replace(',/$,', '', $_SERVER['DOCUMENT_ROOT']);
	$test_result=substr($realpath, strlen($root));
	$dir = dirname(!empty($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] :
			(!empty($_SERVER['PHP_SELF']) ? $_SERVER['PHP_SELF'] :
			(!empty($_SERVER['SCRIPT_NAME']) ? $_SERVER['SCRIPT_NAME'] : str_replace('\\','/',__FILE__)
		)));
	$a = array('DOCUMENT_ROOT'=>$_SERVER['DOCUMENT_ROOT'],
			'REQUEST_URI'=>$_SERVER['REQUEST_URI'],
			'SCRIPT_NAME'=>$_SERVER['SCRIPT_NAME'],
			'PHP_SELF'=>$_SERVER['PHP_SELF'],
			'__FILE__'=>__FILE__,
			'$root'=>$root,
			"find_in_path('img/smileys')"=>find_in_path('img/smileys'),
			"str_replace('\\', '/', realpath('$relative_path'))"=>$realpath,
			"substr('$realpath', strlen('$root'))"=>cs_red($test_result),
			"return?"=>(strlen($root) && strpos($realpath, $root)===0)?'oui':'non',
			"url_absolue('$relative_path')"=>url_absolue($relative_path),
			'$dir'=>$dir,
			"cs_canonicalize('$dir'.'/'.'$relative_path')"=>cs_red(cs_canonicalize($dir.'/'.$relative_path)),
		);
	test_outil($a, 'Test sur : url_absolue()');

	// test de cs_canonicalize()
	$dir = $dir.'/'.$relative_path;
	$address = str_replace("//", "/", $dir);
	$address1 = $address2 = explode('/', $address);
	$keys = array_keys($address2, '..');
	foreach($keys as $keypos => $key) array_splice($address2, $key - ($keypos * 2 + 1), 2);
	$address3 = preg_replace(',([^.])\./,', '\1', implode('/', $address2));
	$a = array('$dir'=>$dir,
			'$address'=>$address,
			"explode('/', '$address')"=>$address1,
			'array_keys($dessus, "..")'=>$keys,
			'array_spliced()'=>$address2,
			'$resultat'=>cs_red($address3),
		);
	test_outil($a, 'Test sur : cs_canonicalize()');

	// charger mes_fonctions, utile pour les filtres ou certains outils
	include_spip('public/parametrer');

	// test de typo_exposants()
	include_spip('inc/charsets'); // ce fichier est en iso88591...
	$textes = array(
		"Pr Paul, Dr Jules, Prs Pierre &amp; Paul, Drs Pierre &amp; Paul. Surveiller : Pr&eacute;-St-Gervais ou Dr&eacute;",
		"Ste Lucie, St-Lucien, St.Patrick, St Patrick, st-jules (laisser?), Sts Pierre &amp; Paul, STe Lucie (laisser?)",
		"Bse Lucie, Bx-Lucien, Bx.Patrick, Bx Patrick, bx-jules (laisser?), Bses Jeanne &amp; Julie",
		"Ier, Iers, Iier, Iiers, Ire (laisser?), Ires (laisser?), I&#232;re, 1i&#232;re, 1&#232;res, 1i&#232;res",
		unicode2charset("Accents : I&#232;re, 1i&#232;re, 1&#232;res, 1i&#232;res - ro, vo, rro, 1o, 2o, 22o, Mgr J.XXIII"),
		unicode2charset("Ie II&#232;me IIIe IVe Ve VIe VIIe VIIIe IXe Xe XIe XVe XXe"),
		unicode2charset("Erreurs de typo : 2me, 3&#232;me, 4i&#232;me, 5mes, 6&#232;mes, 7i&#232;mes"),
		unicode2charset("Cas probl&#233;matique du L (50) : XLe XL&#232;me XLi&#232;me L&#232;me LIe"),
		"1er 1ers, 1eres, 2e 2es, IIIe IIIes, 2nd 22nd 21nd 2ndes. Vve Martin Cie Tartuffe, 3 Bd Voltaire.",
		"3 ou 4 m², 3 ou 4 m2 et 2 m3. 50 Mds ou 50 Mns ! Sté, St&eacute;s, Stés, Ste, Ets, Éts, Éts, &Eacute;ts, &#201;ts ...",
		"Mlle, Mlles, Mme, Mmes et erreurs Melle, Melles",
		"Me, Me martin, Me Martin, Mes M.&T., MMes M.&T.",
		'avant <a href="www.mon-1er-lien.com" title="Mon 1er titre">Mon 1er lien</a> et <img src="image.jpg" alt="logo 6e" title="Cliquez!">',
		'avant [Mon 1er lien->www.mon-1er-lien.com] apres le "test"!',
		'on est pass&eacute; du 7e au 15e rang, pas du 17e au 5e, des 7es aux 3emes !',
		'on est pass&eacute; du 7eme au 15&#232;me rang, pas du 17ieme au 5&egrave;me',
	);
	test_outil(cs_test_fun($textes, 'typo_exposants'), 'Test sur : typo_exposants() - Charset du site : '.$GLOBALS['meta']['charset']);

	// test de typo_guillemets()
	$textes = array(
		'avant <i class="style">le</i> "test"!',
		'avant <code class="code">toto</code>. apres le "test"!',
		'avant '.echappe_html('<script>toto</script>', 'TEST', true).'apres le "test"!',
		'avant '.echappe_html('<code class="code">toto</code>', 'TEST', true).'apres le "test"!',
		'avant <a href="www.monlien.com" title="Mon titre" target="_blank">Mon lien</a> apres le "test"!',
		'avant [Mon lien->www.monlien.com] apres le "test"!',
	);
	test_outil(cs_test_fun($textes, 'typo_guillemets'), 'Test sur : typo_guillemets()');

	// test des smileys
	$textes = array(
		"Doubles : :-(( :-)) :)) :'-)) :'-))",
		"Simples : :-> :-&gt; :-( :-D :-) |-) :'-) :'-) :'-D :'-D :'-( :'-( :-( :o) B-) ;-) :-p :-P' :-| :-/ :-o :-O",
		"les courts (reconnus s'il y a un espace avant) : :) :( ;) :| |) :/ :(",
	);
	test_outil(cs_test_fun($textes, 'cs_smileys_pre_typo'), 'Test sur : cs_smileys_pre_typo()');

	// test des filets
	$textes = array(
		"__degrade.png__\n__ornement.png__",
		"\n__6__\n__5__\n__4__\n__3__\n__2__\n__1__\n__0__\n",
	);
	if(function_exists('filets_sep'))
		test_outil(cs_test_fun($textes, create_function('$t','return propre(filets_sep($t));')), 'Test sur : filets_sep()');

	// test des liens orphelins
	$GLOBALS["liens_orphelins_etendu"]=true;
	$textes = array(
		"http://google.fr et <html>http://google.fr</html> et <code>http://google.fr</code> et <cite>http://google.fr</cite>",
		"Voici : http://google.fr. Voici :http://www.google.fr. Voici http://www.google.fr",
		"voici : https://mabanque.fr ou encore ftp://mabanque.fr!",
		"www.google.fr ou bien : www.google.fr",
		"http://user:password@www.commentcamarche.net:80/glossair/glossair.php3 et http://serveur:port/repertoire/fichier.html",
		"ftp://serveur/repertoire/fichier.qqchose, ou encore ftp.stockage.fr/tropdelaballe...",
		"file:///disque|/repertoire/fichier.qqchose et : file:///c|/tmp/fichier.txt",
		"mailto:nom@organisation.domaine et : mailto:Fabien.Gandon@sophia.inria.fr",
		"telnet://bbs.monsite.com/ et telnet://Nom:Password@serveur.ici:port",
		"telnet://gandonf:abcde@gopa.insa.fr:23",
		"gopher://serveur.ici:port/repertoire/fichier#marqueur et gopher://gopher.monsite.com/",
		"newsrc://serveur:port/repertoire/nom.de.la.news",
		"wais://host.ici:port/database et wais://wais.monsite.com/",
		"news:fr.comp.lang.c++ et pkoi pas : <div toto='ici.rien'></div>http://google.fr",
		"moi+moi@world.com, mailto:moi-moi@world.com, mailto:nom@provider.com?subject=renseignement",
		"moi+moi@kekpar.tm.fr, mailto:moi-moi@kekpar.tm.fr, mailto:nom@provider.com.tm.fr?subject=renseignement",
		'une image ? <img src="http://mailer.e-flux.com/mail_images/toto.jpg" alt="" />',
		'[<img src="http://mailer.e-flux.com/mail_images/toto.jpg" alt="" />->http://www.americas-society.org/] ',
	);
//	test_outil(cs_test_fun($textes, 'typo'), 'Test sur : echappements');
	test_outil(cs_test_fun($textes, 'liens_orphelins'), 'Test sur : liens_orphelins()');

	$textes = array(
		"mailto:nom@organisation.domaine et : mailto:Fabien.Gandon@sophia.inria.fr (on supprime ces liens)",
		"moi+moi@world.com, mailto:moi-moi@world.com, mailto:nom@provider.com?subject=renseignement",
		"pat@moi.com [->pat@moi.com] [pat->pat@moi.com]",
		"pat@moi.com.tm.fr [->pat@moi.com.tm.fr] [pat->pat@moi.com.tm.fr]",
		"<a href='mailto:moi@toto.com'>Moi</a> et : <a href='mailto:moi@toto.com'>moi@toto.com</a>",
		"<a href='mailto:moi@kekpar.tm.fr'>Moi</a> et : <a href='mailto:moi@kekpar.tm.fr'>moi@kekpar.tm.fr</a>",
		'[Navigation->/@mot.html] <a class="spip_out" href="/@mot.html">Navigation</a>',
	);
	test_outil(cs_test_fun($textes, 'mailcrypt'), 'Test sur : mailcrypt()');

/*
define('_COULEURS_FONDS', 1); define('_COULEURS_SET', 1);
define('_COULEURS_PERSO', "bas =#99CC11, haut= brown, test= bleu");
couleurs_installe_dist();
print_r(couleurs_pre_typo("to[bas]to[/bas]to[haut]to[/haut]toto[test]to[/couleur]to\nto[bg bas]to[/bg]to[bg haut]to[/bg]toto[bg test]to[/bg test]to\n"));
print_r(couleurs_pre_typo("to[red]to[/red]to[bleu]to[/bleu]toto[rouge]to[/couleur]to\nto[bg red]to[/bg]to[bg bleu]to[/bg]toto[bg rouge]to[/bg rouge]to\n"));
*/
}
?>