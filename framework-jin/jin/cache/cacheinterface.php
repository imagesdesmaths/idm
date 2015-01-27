<?php

/**
 * Jin Framework
 * Diatem
 */

namespace jin\cache;

/** Interface pour les classes de gestion de cache
 *	@auteur		Loïc Gerard
 */
interface CacheInterface {

    public function __construct();

    public function isInCache($key);

    public function getFromCache($key);

    public function deleteFromCache($key);

    public function saveInCache($key, $value);

    public function clearCache();
}
