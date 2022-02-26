<?php
//Demarrer une session
//personnaliser l'affichage et rediriger vers un fichier(au choix)
session_start();


//Chargement config
require_once 'config/config.php';

//Chargement de helper
require_once 'helpers/urlHelper.php';
require_once 'helpers/sessionHelper.php';
require_once 'helpers/setFlashHelper.php';

//Chargement des librairies avec autoload
//spl_autoload_register() => enregistre une fonction dans la pile __autoload() fournie.
// Si la pile n'est pas encore active, elle est activée.
spl_autoload_register(function($className){
  require_once 'librairies/'.$className.'.php';
});
/*
require_once 'librairies/Core.php';
require_once 'librairies/Controller.php';
require_once 'librairies/Database.php';
*/
