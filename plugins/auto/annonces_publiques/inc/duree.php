<?php
/*
 *   +----------------------------------+
 *    Nom du Filtre : duree   
 *   +----------------------------------+
 *    date : 2008.01.10
 *    auteur :  erational - http://www.erational.org
 *    version: 0.25
 *    licence: GPL
 *   +-------------------------------------+
 *
 *    retourne la duree entre 2 dates
 *    
 *    parametres type_affichage
 *    - court   : 5 jours (par defaut)
 *    - etendu  : 4 semaines 3 jours 23 heures 2 minutes
 *    - horaire : 4h39
 *    - minute  : 124 (minutes cumulees)
 *    - iso8601 : P18Y9W4DT11H9M8S   ref. http://fr.wikipedia.org/wiki/ISO_8601#Dur.C3.A9e
 *    - ical    : P18Y9W4DT11H9M8S   ref. http://tools.ietf.org/html/rfc2445#page-37 (mm chose que iso)
 *         
 *    pour sortir une valeur uniquement (i18n)    
 *    - Y       : (an)
 *    - W       : (semaine)
 *    - D       : (jour) 
 *    - H       : (heure)
 *    - M       : (minute)
 *    - S       : (s) 
 *                                  
*/

function duree($date_debut,$date_fin,$type_affichage='court') {
  $d_debut = mktime(
              substr($date_debut,11,2),
              substr($date_debut,14,2),
              substr($date_debut,17,2),
              substr($date_debut,5,2),
              substr($date_debut,8,2),
              substr($date_debut,0,4));
  
  $d_fin = mktime(
              substr($date_fin,11,2),
              substr($date_fin,14,2),
              substr($date_fin,17,2),
              substr($date_fin,5,2),
              substr($date_fin,8,2),
              substr($date_fin,0,4));
     
  $diff_seconds  = $d_fin - $d_debut; 
  if ($diff_seconds<0) return "";
  $diff_years    = floor($diff_seconds/31536000);
  $diff_seconds -= $diff_years   * 31536000;  
  $diff_weeks    = floor($diff_seconds/604800);
  $diff_seconds -= $diff_weeks   * 604800;
  $diff_days     = floor($diff_seconds/86400);
  $diff_seconds -= $diff_days    * 86400;
  $diff_hours    = floor($diff_seconds/3600);
  $diff_seconds -= $diff_hours   * 3600;
  $diff_minutes  = floor($diff_seconds/60);
  $diff_seconds -= $diff_minutes * 60;  
  $str = "";
  switch ($type_affichage) {
      case "court" :    if ($diff_years>1) $str = "$diff_years ans";
                        else if ($diff_years>0) $str = "$diff_years an";
                        else if ($diff_weeks>1) $str = "$diff_weeks semaines";
                        else if ($diff_weeks>0) $str = "$diff_weeks semaine";
                        else if ($diff_days>1) $str = "$diff_days jours";
                        else if ($diff_days>0) $str = "$diff_days jour";
                        else if ($diff_hours>1) $str = "$diff_hours heures";
                        else if ($diff_hours>0) $str = "$diff_hours heure";
                        else if ($diff_minutes>1) $str = "$diff_minutes minutes";
                        else if ($diff_minutes>0) $str = "$diff_hours minute";                  
                        break;
                  
      case "etendu" :   if ($diff_years>1) $str .= "$diff_years ans ";
                        else if ($diff_years>0) $str .= "$diff_years an ";
                        if ($diff_weeks>1) $str .= "$diff_weeks semaines ";
                        else if ($diff_weeks>0) $str .= "$diff_weeks semaine ";
                        if ($diff_days>1) $str .= "$diff_days jours ";
                        else if ($diff_days>0) $str .= "$diff_days jour ";
                        if ($diff_hours>1) $str .= "$diff_hours heures ";
                        else if ($diff_hours>0) $str .= "$diff_hours heure ";
                        if ($diff_minutes>1) $str .= "$diff_minutes minutes ";
                        else if ($diff_minutes>0) $str .= "$diff_hours minute ";
                        if ($diff_seconds>1) $str .= "$diff_seconds secondes";
                        else if ($diff_seconds>0) $str .= "$diff_seconds secondes";                   
                        break;

      case "horaire":   $str = ($diff_hours+($diff_days*24)+($diff_weeks*24*7)+($diff_year*24*7*365))."h";
                        if ($diff_minutes<10) $str .= "0";
                        $str .= $diff_minutes;                                                       
                        break;
                                    
      case "minute":    $str = $diff_minutes+($diff_hours*60)+($diff_days*60*24)+($diff_weeks*60*24*52)+($diff_year*60*24*365);                                    
                        break;
                        
      case "iso8601":   $str = "P${diff_years}Y${diff_weeks}W${diff_days}DT${diff_hours}H${diff_minutes}M${diff_seconds}S";                                    
                        break;
                        
      case "ical":      $str = "P${diff_years}Y${diff_weeks}W${diff_days}DT${diff_hours}H${diff_minutes}M${diff_seconds}S";  // mm chose que iso                                    
                        break;
      
      case "Y":         $str = $diff_years;                                    
                        break;                       
      case "W":         $str = $diff_weeks;                                    
                        break;
      case "D":         $str = $diff_days;                                    
                        break;                  
      case "H":         $str = $diff_hours;                                    
                        break;                       
      case "M":         $str = $diff_minutes;                                    
                        break;
      case "Y":         $str = $diff_years;                                    
                        break;                       
      case "S":         $str = $diff_secondes;                                    
                        break;                     
         
      default:          break;
      
  }   

	return $str;
}
?>