<?php

$GLOBALS[$GLOBALS['idx_lang']] = array(
    'billettistes'       => "Gestion des billettistes",

    'categorie'          => "Catégorie “@nom@” :",

    'menu'               => "Gestion IdM",
    'moderation'         => "Interface de modération",

    'equipe'             => "Équipe “@nom@” :",

    'non_plan'           => "Articles proposés et non planifiés",

    'planning'           => "Planning de publication",

    'relecteurs'         => "Gestion des relecteurs",
    'relecture'          => "Articles en cours de relecture",
    'relecture_aucun'    => "Aucun article proposé !",

    'tableau'            => "Tableau de bord",
    'teams'              => "Les équipes de rédaction",
    'titre_relecteurs'   => "Relecteurs",

    'mail_billet_valide' => <<<EOT
Un nouveau billet vient d'être validé pour Images des Maths.

  Auteur : @auteur@

  Titre : « @titre@ »

Sans action de la part du comité éditorial, il sera publié à
la date suivante :

  @date@

En attendant, il est accessible aux administrateurs ici :

  http://images.math.cnrs.fr/ecrire/?exec=articles&action=redirect&type=article&id=@id_article@&var_mode=preview
EOT
,
    'mail_rel_article' => <<<EOT
Un article vient d'être proposé pour publication dans “Images des
Mathématiques”. Il s'intitule :

  « @titre@ »

Comme vous avez manifesté votre intérêt à participer à notre
processus éditorial, nous vous invitons à en être un des relecteurs,
et à nous faire part de vos commentaires. Pour ce faire, après vous
être identifié(e) sur le site, il vous suffit de vous rendre à
l'adresse suivante :

  http://images.math.cnrs.fr/spip.php?page=propose&id_article=@id_article@

Vous y trouverez l'article dans son état actuel, un forum de discussion
vous permettant de déposer vos commentaires et de dialoguer avec les
autres relecteurs ainsi qu'avec l'auteur de l'article, et enfin un
formulaire de vote pour donner votre avis sur sa publication.

Nous souhaiterions pouvoir publier cet article dans les 15 jours qui
viennent. Si vous n'avez pas le temps de le relire d'ici là, ça n'est
pas grave - mais nous le publierons peut-être sans vous attendre ..

Merci pour votre aide !
EOT
,
    'mail_rel_forum_soumis' => <<<EOT
Un nouveau commentaire a été posté dans un forum de relecture du site
"Images des Mathématiques". Il faut maintenant le valider ici :

  http://images.math.cnrs.fr/ecrire/?exec=idm_moderation
EOT
);

?>
