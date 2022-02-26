<?php
class Post {
  private $db;

    //Méthode piublic function
    //Pour lancer automatiquement la nouvelle Objet de Database
    public function __construct(){
      //Initialiser un nouvel Objet de classe dans Database
      $this -> db = new Database;
    }


    //Pour aller chercher les articles
    public function getPosts(){
      //Prépare les requêtes dans (posts et users)
      //ON veut dire trie
      //On paufine la requêtes en faisant une jointure à la table(users), ON => WHERE,  par ordre décroissant par date
      //ici on donne des alias pour la publication dans view(post/index)
      $this -> db -> query("SELECT *,
                            posts.id as postId,
                            users.id as userId,
                            users.name as userName,
                            posts.created_date as postCreated,
                            users.created_date as userCreated
                            FROM posts /*dans*/
                            INNER JOIN users /*et*/
                            ON posts.user_id = users.id   /*quand le user_id de posts = id de users*/
                            ORDER BY posts.created_date DESC /*trier par date*/
                            ");
      //Sur l'objet concernant l'attribut db on applique le resultSet() => retourne toutes lignes dans un tableau d'Objet
      //et on stocke dans une variable($results) et retourne le resultat
      $results = $this -> db -> resultSet();
      //On retourne ce qui est stocké dans la variable $results
      //Pour les charger dans une boucle
      return $results;
    }


    //Insertion des articles(input) dans la BDD
    //param c'est toutes les données récupérées dans input
     public function addPost($data){
      $this -> db -> query("INSERT INTO posts(user_id,title,content) VALUES(:user_id,:title,:content)");
      $this -> db -> bind(':user_id', $data['user_id']);
      $this -> db -> bind(':title', $data['title']);
      $this -> db -> bind(':content', $data['content']);
      //Si tout se passe bien
      if($this -> db -> execute()){
        return true;
      }else{
        return false;
      }
    }

    //Se connecter à la BDD et récupérer les informations pour la partie(show)
    public function getPostById($id){
      $this -> db -> query("SELECT * FROM posts WHERE id = :id ");
      $this -> db -> bind(':id', $id);
      // On execute la requête (Database => methode execute(); dont: resultSet()/single())
      //On stocke la ligne retournée dans une variable $row
      $row = $this -> db -> single();
      //On retourne ce qui est stocké dans la varible $row
      return $row;
    }

    //Pour modifier de l'article dans posts/edit
    //Less donnée dans POST
    public function updatePost($data){
      //faire un MAJ modification l'article qui correspondra à l'ID
      $this -> db -> query('UPDATE posts SET title=:title, content=:content WHERE id=:id');
      $this -> db -> bind(':id', $data['id']);
      $this -> db -> bind(':title', $data['title']);
      $this -> db -> bind(':content', $data['content']);
      //vérification de l'execution, si ça retourne correctement donc c'est TRUE
      if($this -> db -> execute()){
        return true;
      }else{
        return false;
      }
    }

    //Pour supprimer de l'article
    public function deletePost($id){
      //Suppression pas besoin de mettre * pour la suppression
      $this -> db -> query("DELETE FROM posts WHERE id = :id ");
      $this -> db -> bind(':id', $id);
      //Vérifie si l'execution s'est bien déroulé
      if($this -> db -> execute()){
        return true;
      }else{
        return false;
      }
    }

}
