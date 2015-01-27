<?php
/**
 * Jin Framework
 * Diatem
 */
namespace jin\external\twitter;

use jin\JinCore;

/** Facilite l'utilisation de l'API Twitter. Utilise la librairie twitteroauth d'Abraham Williams - https://github.com/abraham/twitteroauth
 *
 * 	@auteur		Loïc Gerard
 */
class Twitter{
    /**
     *
     * @var string  Twitter CONSUMER_KEY
     */
    private $consumer_key;
    
    /**
     *
     * @var string  Twitter CONSUMER_SECRET
     */
    private $consumer_secret;
    
    /**
     *
     * @var string  Twitter ACCESS TOKEN
     */
    private $access_token;
    
    /**
     *
     * @var string  Twitter ACCESS TOKEN SECRET
     */
    private $access_token_secret;
    
    /**
     *
     * @var TwitterOAuth Instance de la classe TwitterOAuth
     */
    private $toa;
    
    
    /**
     * Constructeur
     * @param string $consumer_key  Paramétrage Twitter (Consumer Key)
     * @param string $consumer_secret	Paramétrage Twitter (Consumer secret)
     * @param string $access_token  Paramétrage Twitter (Access Token)
     * @param string $access_token_secret   Paramétrage Twitter (Access Token Secret)
     */
    public function __construct($consumer_key, $consumer_secret, $access_token, $access_token_secret) {
	$this->consumer_key = $consumer_key;
	$this->consumer_secret = $consumer_secret;
	$this->access_token = $access_token;
	$this->access_token_secret = $access_token_secret;
	
	$libPath = JinCore::getJinRootPath().JinCore::getRelativeExtLibs().'twitterauth/';
	require_once $libPath.'twitteroauth/twitteroauth.php';
	
	$this->toa = new \TwitterOAuth($this->consumer_key, $this->consumer_secret, $this->access_token, $this->access_token_secret);
    }
    
    
    /**
     * Retourne la liste des derniers Tweets comportant un HashTag préci, dans un délais maximal de 21 jours et dans une limite de 100 résultats
     * @param string $hashtag	Hashtag à rechercher
     * @param int $maxResults	[optionel] Nombre max de résultats (100 par défaut)
     * @return Array
     * @throws \Exception
     */
    public function getLastTweetsContainingHashtag($hashtag, $maxResults = 100){
	if($maxResults > 100){
	    throw new \Exception('100 résultats maximum supportés ('.$maxResults.' souhaités)');
	}
	
	$query = array(
	    "q" => $hashtag,
	    "count" => $maxResults
	);

	$results = $this->toa->get('search/tweets', $query);
	return $results;
    }
    
   
    /**
     * Retourne les userId des followers
     * @return array
     */
    public function getFollowersUserIds(){

	$query = array(
	);

	$results = $this->toa->get('followers/ids', $query);
	return $results;
    }
}