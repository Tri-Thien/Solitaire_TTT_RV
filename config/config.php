<?php

// les chemins vers les différents répertoires liés au modèle MVC

// chemin complet sur le serveur de la racine du site
define("HOME_SITE",__DIR__."/..");

// définition des chemins vers les divers répertoires liés au modèle MVC
define("PATH_VUE",HOME_SITE."/vue");
define("PATH_CONTROLEUR",HOME_SITE."/controleur");
define("PATH_MODELE",HOME_SITE."/modele");


// données pour la connexion au sgbd

define("HOST","localhost");
define("BD","E164708F");
define("LOGIN","E164708F");
define("PASSWORD","E164708F");
?>
