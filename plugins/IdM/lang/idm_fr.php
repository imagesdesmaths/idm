<?php

$GLOBALS[$GLOBALS['idx_lang']] = array(
    'billettistes'       => "Gestion billettistes",

    'categorie'          => "Catégorie “@nom@” :",

    'menu'               => "Gestion IdM",
    'moderation'         => "Modération",

    'equipe'             => "Équipe “@nom@” :",

    'lint'               => "Vérificateur",
    'log'                => "Suivi relecture",

    'non_plan'           => "Articles proposés et non planifiés",
    'non_plan_prepa'     => "Articles en préparation et non planifiés",

    'planning'           => "Planning de publication",

    'articles_edited'        => "Articles édités",
    'articles_writing_mine'  => "Mes articles en cours de rédaction",

    'billets_abandons'       => "Billets abandonnés",

    'idee'         => "Idées d'articles",
    'idee_all'     => "Idées d'articles proposées",
    'idee_mine'    => "Mes idées d'articles proposées",
    'idee_none'    => "Aucune idée d'article proposée",
    'idee_edit'    => "Création/modification d'une idée d'article",

    'relecteurs'         => "Gestion relecteurs",
    'relecture'          => "Articles en relecture",
    'relecture_aucun'    => "Aucun article proposé !",

    'tableau'            => "Tableau de bord",
    'teams'              => "Les équipes",
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

Vous y trouverez l'article dans son état actuel, et un forum de discussion
vous permettant de déposer vos commentaires et de dialoguer avec les
autres relecteurs ainsi qu'avec l'auteur de l'article.

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
,

    'mail_article_cree' => <<<EOT
Un article vient d'être créé dans “Images des Mathématiques”.
Il s'intitule :

  « @titre@ »

Vous avez été désigné pour être l'auteur de cet article. Vous
pouvez dès à présent vous identifier sur le site, et vous rendre à
l'adresse suivante afin de commencer la rédaction de l'article :

  http://images.math.cnrs.fr/ecrire/?exec=article&id_article=@id_article@

Une fois sa rédaction terminée, l'article sera proposé à l'évaluation,
des relecteurs échangeront alors avec vous via un forum de discussion
afin de vérifier, corriger et valider son contenu.

Merci pour votre aide !
EOT
,

    'mail_article_propose' => <<<EOT
Un article vient d'être proposé à l'évaluation dans “Images des
Mathématiques”. Il s'intitule :

  « @titre@ »

Nous vous invitons à vous identifier sur le site, puis à vous rendre
dans l'interface de gestion du processus éditorial afin de choisir
les relecteurs qui seront chargés de réviser et valider cet article.
Vous pouvez accéder à cette interface via le lien suivant :

  http://images.math.cnrs.fr/ecrire/?exec=idm_relecture

Une fois la relecture terminée, l'article sera validé pour la
publication, laquelle se pourra se faire qu'avec l'aval de l'éditeur
et du (de la) secrétaire de rédaction. L'article est directement
accessible via le lien suivant :

    http://images.math.cnrs.fr/spip.php?page=propose&id_article=@id_article@

Merci pour votre aide !
EOT
,

    'mail_article_valide' => <<<EOT
Un article vient d'être validé pour la publication dans “Images des
Mathématiques”. Il s'intitule :

  « @titre@ »

En tant que secrétaire de rédaction, il vous revient de fixer la
date à laquelle cet article sera publié. Vous pouvez dès à présent
vous identifier sur le site et accéder à la page de l'article via
le lien suivant :

  http://images.math.cnrs.fr/ecrire/?exec=article&id_article=@id_article@

Merci pour votre aide !
EOT
);

?>
