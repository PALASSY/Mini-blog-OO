<?php
class User{
  private $db;

  public function __construct(){
    //Initialiser un nouvel Objet de classe dans Database

    $this -> db = new Database;
  }

  //Insertion des utilisateurs dans la BDD
  //param toutes le données récupérer dans la formulaire []
  public function register($data){
    //On prépare la requête (Database => methode query($sql); )
    $this -> db -> query("INSERT INTO users(name,pseudo,description,email,password)
                          VALUES(:name,:pseudo,:description,:email,:password)");
    //On relie les paramètres de la requête avec les valeurs passées (Database => methode bind(); )
    // :email correspond à $email
    $this -> db -> bind(':name', $data['name']);
    $this -> db -> bind(':pseudo', $data['pseudo']);
    $this -> db -> bind(':description', $data['description']);
    $this -> db -> bind(':email', $data['email']);
    $this -> db -> bind(':password', $data['password']);
    //execution
    if($this -> db -> execute()){
      return true;
    }else{
      return false;
    }
  }


  //Vérifiation email, password et pseudo
  //1er param c'est l'email de l'utilisateur
  //2er param c'est le mot de passe de l'utilisateur
  //3er param c'est le pseudo de l'utilisateur
  public function login($email, $password, $pseudo){
    $this -> db -> query("SELECT * FROM users WHERE email = :email ");
    $this -> db -> bind(':email', $email);
    // On execute la requête (Database => methode execute(); dont: resultSet()/single())
    //On stocke la ligne retournée dans une variable $row
    //Récupère une seule ligne
    $row = $this -> db -> single();
    //Vérification de mot de passe crypté
    //Mot de passe qui a été récupérer dans BDD
    $hashed_password = $row -> password;
    //password_verify => Vérifie que le hachage fourni correspond bien au mot de passe fourni.
    //1er param => Le mot de passe utilisateur(dans formulaire)
    //2em param => Le mot de passe crypté dans BDD
    if(password_verify($password, $hashed_password)){
      //retourner la ligne qui a été récupérée dans BDD
      return $row;
    }else{
      return false;
    }
    //Pseudo qui a été récupérer dans BDD
    $pseudo = $row -> pseudo;
  }

    //Trouver l'utilisateur par le biais de son pseudo
    public function findUserByPseudo($pseudo){
    //On prépare la requête (Database => methode query($sql); )
    $this -> db -> query("SELECT * FROM users WHERE pseudo = :pseudo ");

    //On relie les paramètres de la requête avec les valeurs passées (Database => methode bind(); )
    // :pseudo correspond à $pseudo
    $this -> db -> bind(':pseudo', $pseudo);

    // On execute la requête (Database => methode execute(); soit: resultSet()/single())
    //On stocke la ligne retournée dans une variable $row
    $row = $this -> db -> single();
    

    //On compte le nombre de fois de lignes pour l'pseudo de l'utilisateur (Database => rowCount(); )
    if($this -> db -> rowCount() > 0){
      return true;
    }else{
      return false;
    }
  }


  //Trouver l'utilisateur par le biais de son email (de préférence)
  //Param c'est l'email de l'utilisateur
  public function findUserByEmail($email){
    $this -> db -> query("SELECT * FROM users WHERE email = :email ");
    $this -> db -> bind(':email', $email);
    // On execute la requête (Database => methode execute(); dont: resultSet()/single())
    //On stocke la ligne retournée dans une variable $row
    //retourner une seule ligne
    $row = $this -> db -> single();
    //est ce qu'il est superieur à 0 càd il existe
    if($this -> db -> rowCount() > 0){
      return true;
    }else{
      return false;
    }
  }

  //On va chercher le name dans users (BDD)
  //Pour utiliser dans posts/show =>
  public function getUserById($id){
    $this -> db -> query("SELECT * FROM users WHERE id = :id ");
    $this -> db -> bind(':id', $id);
    // On execute la requête (Database => methode execute(); dont: resultSet()/single())
    //On stocke la ligne retournée dans une variable $row
    $row = $this -> db -> single();
    //On retourne ce qui est stocké dans la varible $row
    return $row;

  }


}
