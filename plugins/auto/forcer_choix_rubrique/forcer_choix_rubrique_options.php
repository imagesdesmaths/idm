<?php
global $afficher_boite_rubrique;

if(!isset($GLOBALS['id_rubrique']) && !isset($_GET['id_rubrique']) && $_GET['exec'] == 'articles_edit' && !isset($_GET['id_article']))
{
// Decommentez la ligne suivante, en effacant les deux barres qui la debutent
// si vous voulez que les articles non rubriques soient classes par defaut dans une
// rubrique particuliere. Indiquez le numero de la rubrique entre les guillemets.
$_GET['id_rubrique'] = "100";

// Ce qui suit ne devrait pas etre modifie.
$afficher_boite_rubrique = "oui";

}
?>
