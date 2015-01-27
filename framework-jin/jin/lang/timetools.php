<?php
/**
 * Jin Framework
 * Diatem
 */

namespace jin\lang;

/** Boite à outils pour les opérations temporelles
 *
 *  @auteur     Loïc Gerard, Samuel Marchal
 *  @version    0.0.2
 *  @check      23/09/2014
 */
class TimeTools {

    /** Retourne le timestamp courant en milisecondes
     *
     * @return integer  Timestamp courant en MS
     */
    public static function getTimestampInMs() {
       return round(microtime(true) * 1000);
    }

    /** Passe une date au format européen jj/mm/aaaa hh:mm:ss
     *
     * @param  string|DateTime $date Date quelconque
     * @param  boolean $withHour     Retourner les heures ou non
     * @return string                Date au format européen
     */
    public static function toEuropeanFormat($date = null, $withHour = false) {
        if(is_string($date)) {
            $time = strtotime($date);
        } elseif(is_a($date, 'DateTime')) {
            $time = $date->getTimestamp();
        } else {
            return null;
        }
        return date('d/m/Y' . ($withHour ? ' H:i:s' : ''), $time);
    }

    /** Passe une date au format américain aaaa-mm-jj hh:mm:ss
     *
     * @param  string|DateTime $date Date quelconque
     * @param  boolean $withHour     Retourner les heures ou non
     * @return string                Date au format américain
     */
    public static function toAmericanFormat($date = null, $withHour = false) {
        if(is_string($date)) {
            $time = strtotime($date);
        } elseif(is_a($date, 'DateTime')) {
            $time = $date->getTimestamp();
        } else {
            return null;
        }
        return date('Y-m-d' . ($withHour ? ' H:i:s' : ''), $time);
    }

    /** Passe une date au format HTML5 (= américain)
     *
     * @param  string|DateTime $date Date quelconque
     * @param  boolean $withHour     Retourner les heures ou non
     * @return string                Date au format HTML5
     */
    public static function toHTML5Format($date = null, $withHour = false) {
        return self::toAmericanFormat($date, $withHour);
    }
}
