<?php
/**
 * Jin Framework
 * Diatem
 */

namespace jin\external\diatem\sherlock;

/** Interface pour les filtres de conditions et de critère Sherlock
 * 
 */
Interface SearchItemInterface{
    public function __construct($fields, $values);
    public function getParamArray();
}