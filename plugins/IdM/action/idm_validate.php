<?php
  function action_idm_validate_dist() {
    idm_validate_billet($GLOBALS['auteur_session']['id_auteur'],_request('id_article'));
    redirige_par_entete(generer_url_ecrire ('article', "id_article="._request('id_article'), true));
  }
?>
