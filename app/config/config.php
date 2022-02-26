<?php
//Définir les constantes
//Racine de l'appli


//Accès au chemin absolu
//echo __FILE__.'<br>';
//Le répertoir sans le nom du fichier
//echo dirname(__FILE__).'<br>';
//Le répertoir sans le nom du dossier
//echo dirname(dirname(__FILE__)).'<br>';

define('APPROOT', dirname(dirname(__FILE__)));

//Racine des Url , sans le / à la fin
define('URLROOT', 'http://localhost:81/BlogOO');

//Titre du site
define('SITENAME', 'Mini Blog en POO');

//Base de donnée
define('DB_HOST', 'localhost');
define('DB_NAME', 'blogoo');
define('DB_USER', 'root');
define('DB_PASSWORD', 'root');
define('DB_PORT', 3308);
