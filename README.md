Procédure de migration
===

Branche créée à partir de la branche :idm.

Modification des fichiers de configuration
---
Editez le fichier `sherlock/indexer.php` (:51) afin de renseigner les identifiants de connexion à la base de données. 
Vérifiez la concordance entre les identifiants `RUBRIQUE_`, `ARTICLE_` et `MOT_` spécifiés dans le fichier `config/mes_options.php`, et ceux déjà en place dans la base de données.

Mise à jour de la base de données
---
Lancez le script de migration `migrate.sql`.  
Ce script :

- crée des tables relative à l'envoi de mail en masse
- crée un nouveau groupe de mots, utilisé pour la mise en avant d'articles dans le bandeau rouge sur la page d'accueil
- ajoute deux mots (pour l'exemple) dans ce nouveau groupe de mots
- crée une table relative à l'affichage quotidien d'articles aléatoires (Image du jour, Figure sans paroles)
- crée une nouvelle équipe "Secrétaire de rédaction", et y ajoute 4 auteurs (V.Beffara, C.Gaboriau, M.Sauvageot, L.Gérard)

Mise à jour du plugins IdM
---
Afin de s'assurer que tous est bien pris en compte :
- Accédez à la page `/ecrire/?exec=admin_plugin&var_mode=vider_paquets_locaux` pour nettoyer la liste des plugins
- Désactivez le plugin IdM
- Accédez à la page `/ecrire/?exec=admin_plugin&var_mode=recalcul` pour forcer la page à se rafraîchir
- Réactivez le plugin IdM

Mise en place des services annexes
---
Prévoir la mise en place d'un cron quotidien pour exécuter le fichier `sherlock/indexer.php`

Préconisations
---
Les images devrait progressivement être remplacées pour respecter un format type 16:9, avec une taille minimale recommandée de 640px par 360px. C'est le format qui conviendra le mieux au nouveau thème.

