<?php
/*
*Contolleur de base qui va charger le model et la view
*/

class Controller {

  //Chargement du modèle (données)
  public function model($model){
    //Donner le chemin vers le fichier et retourne le modèl
    require_once '../app/models/'.$model.'.php';
    //Instancier la class
    //Instancier un Objet
    return new $model;
  }

  //Chargement de la vue ()
  public function view($view, $data=[]){
    if(file_exists('../app/views/'.$view.'.php')){
      require_once '../app/views/'.$view.'.php';
    }
    else{
      die('La vue n\'existe pas');
    }
  }
}
