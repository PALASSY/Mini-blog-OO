<?php
/*
*Classe Database avec PDOStatement
*Connexion à la BDD
*Création de requêtes préparées
*Sécutité des données
*Retourner les résultats
*/

class Database{
  private $host = DB_HOST;
  private $dbname = DB_NAME;
  private $user = DB_USER;
  private $password = DB_PASSWORD;
  private $port = DB_PORT;
  private $dbh; //handler
  private $stmt; //statemant = déclaration
  private $error;

  //Ici se trouve tout ce qui est au démarrage
    public function __construct(){
      //On va déclarer les DNS => hote de la base  (Domain Name System)
      $dns = 'mysql:host='.$this -> host.';port='.$this -> port.';
              dbname='.$this -> dbname;

      //
      $options = array(PDO::ATTR_PERSISTENT => true,
                       PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

      //On crée une nouvelle instance PDO avec Try and Catch
      //new PDO() => Représente une connexion entre PHP et un serveur de base de données.
      try{
        $this -> dbh = new PDO($dns, $this -> user, $this -> password, $options);
      }
      catch(PDOException $e){
        $this -> error = $e -> getMessage();
        echo $this -> error;
      }
    }

    //Préparer les requêtes
    public function query($sql){
      $this -> stmt = $this -> dbh -> prepare($sql);
    }

    //Sécuriser les données avec (bindvalue) => relier
    public function bind($param, $value, $type=null){
      if(is_null($type)){
        switch (true){
          //Sécurité supplémentaire
          case is_int($value):
             $type = PDO::PARAM_INT;
             break;
          case is_bool($value):
             $type = PDO::PARAM_BOOL;
             break;
          case is_null($value):
              $type = PDO::PARAM_NULL;
              break;
          default:
              $type = PDO::PARAM_STR;
        }
      }
      //Si tout se passe bien
      $this -> stmt -> bindValue($param,$value,$type);
    }

    /***********************************************************/
    //Executé les requêtes préparées
    public function execute(){
      return $this -> stmt -> execute();
    }
    /***********************************************************/
    //Retourne toutes lignes dans un tableau d'Objet
    public function resultSet(){
      $this -> execute();
      return $this -> stmt -> fetchAll(PDO::FETCH_OBJ);
    }
    /***********************************************************/
    //Retourne une seule ligne de la table
    public function single(){
      $this -> execute();
      return $this -> stmt -> fetch(PDO::FETCH_OBJ);
    }
    /***********************************************************/
    //Retourne un nombre de ligne (pour éviter les doublons)
    //rowCount(); c'est une méthode native PDO
    //PDOStatement::rowCount — Retourne le nombre de lignes affectées par le dernier appel à la fonction PDOStatement::execute()
    //$this -> stmt -> prepare("SELECT COUNT(*) AS ... FROM ... WHERE ...");
    public function rowCount(){
      return $this -> stmt -> rowCount();
    }
}
