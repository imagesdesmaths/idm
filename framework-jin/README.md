Framework PHP JIN
============

Qu'est ce que Jin ?
--------

Jin est un framework PHP léger construit comme une boite à outils. L'objectif 
est de répondre à des problématiques de développement spécifiques en offrant des
solutions intégrables dans des environnements CMS Open source diversifiés.
L'idée est de limiter la multi-spécialisation en offrant une solution 
transversale et modulable.


Quelles sont les possibilités offertes ?
--------
* Base de données
    * Connexion BDD (MySql, PostgreSQL et connecteurs spécifiques CMS) (jin/db/*)
    * Requêtage simplifié en bases de données (jin/query/Query)
    * Effectuer des requêtes de requêtes (jin/query/QueryOfQuery)
    * Faciliter le traitement de résultats de requêtes.  (jin/query/QueryResult)
* Communication
    * Déploiement et appel de services REST sécurisés (jin/com/rest/*)
    * Déploiement et appel de Webservices (jin/com/webservice/*)
    * Travail facilité avec Curl (jin/com/Curl)
    * Connexion boite mail IMAP (jin/mail/MailConnector)
    * SSO (Authentification unifiée, via l'usage d'un serveur CAS) (jin/external/jasig/*)
    * Communication facilitée avec ElasticSearch. (Construction de requêtes de recherche complexes) (jin/external/diatem/sherlock/*)
* Optimisation du développement
    * Gestion des logs (jin/log/Log)
    * Système de debug avancé (jin/log/Debug)
    * Analyse des performances (jin/log/PerfAnalyser)
* Etendre PHP
    * Travail facilité avec le système de fichiers (jin/filesystem/*)
    * Classes facilitant le travail avec les listes, les tableaux, les numéraires, les chaînes et les objets temporels (jin/lang/*)
    * Travail facilité avec Json (jin/dataformat/JSon)
* Accélérer et faciliter les développements front-end
    * Composants d'affichage (jin/output/components/*)
    * Gestion de formulaires (jin/output/form/*)
    * Détection du contexte (Navigateur et Device) (jin/context/*)
    * Envoi de mails avancés (jin/mail/MailSender)
    * Gestion des traductions (jin/language/*)
    * Mise en cache de données. (Support du cache fichier et Memcache) (jin/cache/*)


Comment installer et utiliser Jin ?
--------

Installez le répertoire jin/ à la racine du dossier de votre programme. 
Pour utiliser jin, effectuez un include du fichier jin/launcher.php

**Example :**
`include 'jin/launcher.php`


Système de surcharge
--------
Jin intègre un système efficace pour adapter le fonctionnement du framework
aux spécificités requises par votre programme. Il est ainsi possible de surcharger
intégralement la quasi totalité du code source de Jin.
Pour surcharger un fichier il suffit de créer à la racine de votre projet un
dossier nommé 'surcharge'.
Placez dans ce dossier les fichiers que vous souhaitez surcharger, en respectant
scrupuleusement le chemin natif du fichier originel de Jin.
pour example, si vous souhaitez modifier le fonctionnement de la classe 
jin/log/Debug, récupérez au préalable le fichier PHP de la classe, c'est à dire
le fichier jin/log/debug.php et placez-le dans le dossier surcharge/log/.
Vous pouvez à présent appliquer les modifications que vous souhaitez, le fichier
surcharge/log/debug.php sera chargé par Jin à la place du fichier originel.

Il est ainsi possible de surcharger :
* Les fichiers de classe
* Le fichier de configuration config.ini
* Les fichiers de langage du répertoire _languages
* Les fichiers d'assets du répertoire _assets


Système de composants et d'assets
--------

Jin offre un système de composants graphiques qui peuvent être employés afin 
de créer rapidement des interfaces utilisateur. Tous les composants sont basés
sur des assets, ou fichiers de templates, qui définissent leurs modalités
graphiques d'affichage. Il est possible de surcharger ces assets selon le
même principe que les fichiers de classe.

**N.B.:**
Certaines classes faisant appel à des affichages graphiques, comme jin/log/Debug
 utilisent également des assets dans leur fonctionnement. Ces assets sont
également surchargeables.


Comment configurer Jin ?
--------

Jin offre quelques possibilités de configuration définies dans le fichier 
config.ini. Il est possible de surcharger ce fichier pour en modifier la
configuration standard.

**Détail des possibilités de configuration:**
* surcharge _Définit si il est possible de surcharger le framework Jin (0 ou 1)_
* surchargeAbsolutePath _Chemin absolu du dossier contenant les fichiers surchargeant_
* cacheMode _Mode de cache (memcache ou file)_
* cacheFileFolder _Cache de type FILE : dossier de stockage_
* cacheMemCacheHost _si cache Memcache, host du serveur_
* cacheMemCachePort _si cache Memcache, port du serveur_
* RessourceNavigatorCacheTime _Nombre de secondes pendant lequel le navigateur client doit conserver le cache sur les fichiers Js et CSS gérés par JIN_


Documentation
--------

[Accès à la documentation en ligne](http://tools.diatem.net/documentation/projet/7/documentation/ "Accès à la documentation en ligne")

[Télécharger la documentation au format ZIP](http://tools.diatem.net/documentation/projet/7/documentation.zip "Télécharger la documentation au format ZIP")

