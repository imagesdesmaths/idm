
<?php

function relecteurs_boite_infos (&$flux) {
  if ($flux['args']['type'] == 'article'
    AND $id_article = intval($flux['args']['id'])
    AND $statut = $flux['args']['row']['statut']
    AND $statut == 'prop') {

      $message = 'G&eacute;rer la relecture';
      $url     = generer_url_public ("propose", array("id_article" => $id_article));
      $previsu = icone_horizontale ($message, $url, find_in_path("relecteurs.gif"), "rien.gif", false);

      if ($p = strpos ($flux['data'], '</ul>')) {
        while ($q = strpos ($flux['data'],'</ul>',$p+5))
          $p=$q;
        $flux['data'] = substr($flux['data'],0,$p+5) . $previsu . substr($flux['data'],$p+5);
      }
      else $flux['data'] .= $previsu;
    }

  return $flux;
}

?>
