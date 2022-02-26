<?php
/*
*Classe  => noyau de l'APP
*Créer les Url et charge le controleur de base
*Gérer le format des Url => controllers/method/params
*/
class Core{
  //Il faut créer des classes et méthodes par défaut pour qu'il n'y a pas d'erreur
  //Les params on peut laisser vide mais dans un tableau
  protected $currentController = 'Pages';
  protected $currentMethod = 'index';
  protected $params = [];

  //Ici on appelle la méthode càd initialiser ou faire la requête
  // __construct() s'initialise au lencement
  public function __construct(){
    //$this -> getUrl();
    //print_r => permet d'afficher le contenu d'un tableau / echo ne le permet pas
    //print_r($this -> getUrl(), true);

    //initialiser par défaut la methode getUrl()
    $url = $this -> getUrl();
    //echo '<pre>'. print_r($url, true) .'</pre>';


    //On recherche si le controller correspondant au prémier paramètre existe[0]=>class
    //Ici pour accéder au fichier Pages.php/Users.php/... il faut se dire que le système sort du fichier index.php(public) pour diriger ici
    if(!is_null($url) && file_exists('../app/controllers/'. ucwords($url[0]). '.php')){
      //Si le fichier existe on le met à jour (initialiser)
      $this -> currentController = ucwords($url[0]);
      //Supprimer pour qu'il passe à la test suivant
      unset($url[0]);
    }//Fin du if
    //Aller récupérer le fichier obligatoirement
    //On ne met pas le paramètre dans l'url mais ce qui a été initialisé => $this -> currentController
    require_once '../app/controllers/'.$this -> currentController. '.php';
    //On instancie le nouvel Objet à la nouvelle valeur
    $this -> currentController = new $this -> currentController;

    //On recherche si le controller correspondant au deuxième paramètre existe[1]=>method
    if(isset($url[1])){
      //On vérifie si le méthode existe(Objet, method_name)
      if(method_exists($this -> currentController, $url[1])){
        //Si on trouve la méthode (dans Url)
        //on met à jour l'attribut $currentMethod
        $this -> currentMethod = $url[1];
        unset($url[1]);
      }
    }
    //echo $this -> currentMethod;

    //On vérifie si il y a autre(s) paramètre(s) dans Url à part class/méthode
    // Ici l'attribut $params est un tableau
    // array_values => stocke les parmètres dans un tableau
    $this -> params = $url ? array_values($url) : [];
    //Retourne le tableau
    //call_user_func_array — Appelle une fonction de rappel avec les paramètres rassemblés en tableau
    call_user_func_array([$this -> currentController, $this -> currentMethod], $this -> params);

  }

  //Ici on a définit la méthode puis il faut l'appeler
  //Prendre les paramètres dans Url
  public function getUrl(){
    //Ici le $_GET['url'] est un tableau
    if(isset($_GET['url'])){
      //rtrim = enleve les /
      $url = rtrim($_GET['url'], '/');
      //Nettoyer l'url
      $url = filter_var($url, FILTER_SANITIZE_URL);
      // séparer les éléments délimité par /
      $url = explode('/', $url);
      return $url;
    }
  }
}
