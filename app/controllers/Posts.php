<?php
class Posts extends Controller{

//Si le $_SESSION['user_id'] est false
//Si on n'est pas loggé
public function __construct(){
  if(!isLoggedIn()){
    //=> rediriger l'utilisateur vers page users/loging.php
    redirect('users/login');
  }
  //On charge le model('')
  $this -> postModel = $this -> model('Post');
  $this -> userModel = $this -> model('User');
}


  public function index(){
    //On demande de récupérer les infos dans la BDD pour remplir notre tableau($data)
    $posts = $this -> postModel -> getPosts();
    $data = [
              'posts' => $posts
            ];
    //Lien pour aller vers views/posts/index.php
    $this -> view('posts/index',$data);
  }


  public function add(){
    //Vérification si un recours à la méthode POST
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
      //Nettoyer les données(input)
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      //Initialiser les données
      //Redefinir(input) et mettre dans un tableau
      $data = [
            'title' => trim($_POST['title']),
            'content' => trim($_POST['content']),
            'user_id' => $_SESSION['user_id'],
            'title_err' => '',
            'content_err' => ''
          ];
      //Validation du titre
      if(empty($data['title'])){
          $data['title_err'] = 'Merci de mettre le titre';
      }
      //Validation du contenu
      if(empty($data['content'])){
        $data['content_err'] = 'Merci de mettre le contenu';
      }
      //Si tous les champs sont bien remplis -- (autrement dit) -- si tous les champs errors sont vides
      if(empty($data['title_err']) && empty($data['content_err'])){
        //redirect('posts');
        //Validation des données récupérées
          if($this -> postModel -> addPost($data)){
            //Message flash(l'article a été ajouté)

            //die('Rédiriger vers URLROOT/posts') => déjà former dans une function (urlHelper.php)
              redirect('posts');
          }else{
            //On charge la views avec les erreurs
            die('Une erreur est survenu');
          }

      }else{
        //Charger la views avec les erreurs
        $this -> view('posts/add',$data);
      }
    }//fin if($_SERVER...)
      else{
      $data = [
            'title' => '',
            'content' => '',
            'title_err' => '',
            'content_err' => ''
          ];
      //Lien pour aller vers views/posts/add.php si le tableau est vide
      $this -> view('posts/add',$data);
    }

  }//fin methode add();


  //Le param c'est l'id de posts(BDD)
  //On récupére aussi l'user_id de posts(BDD) => id de l'users(BDD)
  public function show($id){
    //On retourne la méthode getPostById($id) => post.php
    $post = $this -> postModel -> getPostById($id);
    //Ici pour accéder à userModel il va falloir charger le => model('User')
    //Pour récupérer le name dans la table(users) de la BDD on va créer une variable $user
    //param c'est l'user_id de posts(BDD) => id de l'users(BDD)
    $user = $this -> userModel -> getUserById($post -> user_id);

    //On récupère tous les éléments nécessaires de notre article dont: id/titre/body/date
    // et aussi les éléments concernant l'utilisateur dont : nom/id/date...
    $data = [
              'post' => $post,
              'user' => $user
            ];

    //On charge view(Controller)          ];
    $this -> view('posts/show',$data);
  }



  //Modification d'un article avec un $id spécifique
  public function edit($id){
      //Vérification si un recours à la méthode POST
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
      //Nettoyer les données
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      $data = [
                'id' => $id,
                'title' => trim($_POST['title']),
                'content' => trim($_POST['content']),
                'user_id' => $_SESSION['user_id'],
                'title_err' => '',
                'content_err' => ''
              ];
      //Valider les données
      if(empty($data['title'])){
        $data['title_err'] = 'Merci de saisir un titre';
      }

      if(empty($data['content'])){
        $data['content_err'] = 'Merci de saisir un text';
      }

      //Vérifier qu'il n'y a pas d'erreur
      if(empty($data['title_err']) && empty($data['content_err'])){
        //Validation et changement de contenu ou titre faite à partir de l'id de la table(posts)
        if($this -> postModel -> updatePost($data)){
        //Chargement de la vue si la modification est accomplie
          redirect('posts');
        }else{
          die('Une erreur est survenue');
        }
      }else{
        //Sinon
        //On charge la vue avec les erreurs
        $this -> view('posts/edit', $data);
      }


    //end of if($_SERVER)
    //Si methode post n'existe pas
    }else{
      //Aller chercher l'article actuel par rapport à son identifiant
      $post = $this -> postModel -> getPostById($id);

      //Vérifier s'il s'agit de l'auteur
      if($post -> user_id != $_SESSION['user_id']){
        redirect('posts');
      }
      $data = [
                'id' => $id,
                'title' => $post -> title,
                'content' => $post -> content
              ];
      //Quoi qu'il en soit on fait comme si il y a erreur et on reste sur cette page
      $this -> view('posts/edit',$data);
      }
  }/*end methode edit()*/


  //Suppression d'un article avec un $id spécifique
  public function delete($id){
    //Vérification si un recours à la méthode POST
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
      //Identifier l'élément à supprimer par son id
      $post = $this -> postModel -> getPostById($id);
      //Vérifier s'il s'agit de l'auteur
      if($post -> user_id != $_SESSION['user_id']){
        redirect('posts');
      }
      //Si la  suppression s'est exécuté correctement
      if($this -> postModel -> deletePost($id)){
        //Message flash (l'article a été supprimé)

        //Redirection
        redirect('posts');
      }else{
        die('Une erreur est survenue');
      }
      /*Fin de if($_SERVER)*/
    }else{
      //Redirection vers('post')
      redirect('posts');
    }
  }/*end methode delete()*/


  //Récupérer le 3e param càd l'user_id(posts) => id(users)
  public function user(){
    //On demande de récupérer les infos dans la BDD pour remplir notre tableau($data)
    $posts = $this -> postModel -> getPosts();
    $data = [
              'posts' => $posts
            ];

    //On charge view(Controller)          ];
    $this -> view('posts/user',$data);
  }







}/*end of class Posts{}*/
