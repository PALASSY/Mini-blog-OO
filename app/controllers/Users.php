<?php
class Users extends Controller
{

  public function __construct()
  {
    $this->userModel = $this->model('User');
  }

  public function register()
  {
    //Vérification si un recours à la méthode POST à la requête au serveur
    //$_SERVER =>  est un tableau contenant des informations comme les en-têtes, dossiers et chemins du script
    //'REQUEST_METHOD' => Méthode de requête utilisée pour accéder à la page ; par exemple 'GET', 'HEAD', 'POST', 'PUT'.
    //Manière de faire comme en js càd avoir cliquer sur le bouton
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      //Si oui Validé le formulaire

      //Nettoyer les données récupérées via $_POST
      //filter_input_array => Récupère plusieurs valeurs externes et les filtre
      //SANITIZE veut dire nettoyer
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

      //Initialiser les données
      //trim => Supprime les espaces (ou d'autres caractères) en début et fin de chaîne
      //Récupération des éléments dans les champs
      $data = [
        'name' => trim($_POST['name']),
        'pseudo' => trim($_POST['pseudo']),
        'description' => trim($_POST['description']),
        'email' => trim($_POST['email']),
        'password' => trim($_POST['password']),
        'confirm_password' => trim($_POST['confirm_password']),
        'name_err' => '',
        'pseudo_err' => '',
        'description_err' => '',
        'email_err' => '',
        'password_err' => '',
        'confirm_password_err' => ''
      ];
      //Validation du nom
      if (empty($data['name'])) {
        $data['name_err'] = 'Merci de mettre votre nom';
      }

      //Validation pseudo
      if (empty($data['pseudo'])) {
        $data['pseudo_err'] = 'Merci de mettre votre pseudo';
      } else {
        if ($this->userModel->findUserByPseudo($data['pseudo'])) {
          $data['pseudo_err'] = 'Ce pseudo est déjà utilisé';
        }
      }

      //Validation de description
      if (empty($data['description'])) {
        $data['description_err'] = 'Merci de mettre votre description';
      } elseif (strlen($data['description']) > 200) {
        $data['description_err'] = 'Votre description ne doit pas dépasser les 200 caractères';
      }

      //Validation de l'email
      if (empty($data['email'])) {
        $data['email_err'] = 'Merci de mettre un email';
      } else {
        //param c'est l'email de l'utilisateur
        if ($this->userModel->findUserByEmail($data['email'])) {
          //die('adresse email existe dans BDD');
          $data['email_err'] = 'Email déjà enregistrer dans notre BDD';
        }
      }

      //Validation du mot de passe
      if (empty($data['password'])) {
        $data['password_err'] = 'Merci de mettre un mot de passe';
      } elseif (strlen($data['password']) < 8) {
        $data['password_err'] = 'Le mot de passe doit être supérieur à 8 caractères';
      }

      //Validation de confiramtion de mot de passe
      if (empty($data['confirm_password'])) {
        $data['confirm_password_err'] = 'Merci de confirmer votre mot de passe';
      } else {
        if ($data['password'] != $data['confirm_password']) {
          $data['confirm_password_err'] = 'Les mots de passe ne sont pas identiques';
        }
      }

      //Si tous les champs sont bien remplis -- (autrement dit) -- si tous les champs errors sont vides
      //qu'il n'y a pas de message d'erreur
      if (
        empty($data['name_err']) && empty($data['email_err'])
        && empty($data['password_err']) && empty($data['confirm_password_err']) && empty($data['pseudo_err']) && empty($data['description_err'])
      ) {
        //Crypter le mot de passe
        //La fonction password_hash() crée un nouveau hachage en utilisant un algorithme de hachage fort et irréversible
        //PASSWORD_DEFAULT c'est une constante
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

        ////////////////insertion dans BDD//////////////////
        //si l'enregistrement se passe sans encombre alors on redirige l'utilisateur(login)
        //param toutes le données récupérer dans la formulaire
        if ($this->userModel->register($data)) {
          //die('Rédiriger vers URLROOT/users/login') => déjà former dans une function (urlHelper.php)
          redirect('users/login');
        } else {
          die('Error');
        }
      } else {
        //Si il a d'erreur
        //Afficher la vue avec erreurs
        $this->view('users/register', $data);
      }
    }
    //Ici il y a les données avec erreurs et les données à insérer dans la BDD
    //Stocker les erreurs en fonction de l'endroit où l'erreur est constatée
    else {
      //Sinon on va initialiser les données càd rendre les champs vide
      $data = [
        'name' => '',
        'pseudo' => '',
        'description' => '',
        'email' => '',
        'password' => '',
        'confirm_password' => '',
        'name_err' => '',
        'pseudo_err' => '',
        'description' => '',
        'email_err' => '',
        'password_err' => '',
        'confirm_password_err' => ''
      ];
      //Quoi qu'il arrive , On chargera la vue
      $this->view('users/register', $data);
    }
  }




  public function login()
  {
    //Vérification si un recours à la méthode POST
    //$_SERVER =>  est un tableau contenant des informations comme les en-têtes, dossiers et chemins du script
    //'REQUEST_METHOD' => Méthode de requête utilisée pour accéder à la page ; par exemple 'GET', 'HEAD', 'POST', 'PUT'.
    //Vérifier si il y a une methode POST passer au Serveur càd le bouton a été cliqué
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      //Si oui Validé le formulaire

      //Nettoyer les données récupérées via $_POST
      //filter_input_array => Récupère plusieurs valeurs externes et les filtre
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

      //Initialiser les données
      //trim => Supprime les espaces (ou d'autres caractères) en début et fin de chaîne
      $data = [
        'pseudo' => trim($_POST['pseudo']),
        'email' => trim($_POST['email']),
        'password' => trim($_POST['password']),
        'pseudo_err' => '',
        'email_err' => '',
        'password_err' => ''
      ];

      //Validation de pseudo
      if (empty($data['pseudo'])) {
        $data['pseudo_err'] = 'Merci de mettre de pseudo';
      }

      //Validation d'email
      if (empty($data['email'])) {
        $data['email_err'] = 'Merci de mettre un email';
      }

      //Validation du mot de passe
      if (empty($data['password'])) {
        $data['password_err'] = 'Merci de mettre un mot de passe';
      }

      //Vérification de pseudo
      if ($this->userModel->findUserByPseudo($data['pseudo'])) {
        //Pseudo trouvé
      } else {
        //Pseudo non trouvé
        $data['pseudo_err'] = 'Ce pseudo n\'existe pas dans notre BDD';
      }

      //Vérification de l'email
      //param c'est l'email de l'utilisateur
      if ($this->userModel->findUserByEmail($data['email'])) {
        //Email trouvé
      } else {
        //Email pas trouvé
        $data['email_err'] = 'Cette dresse email n\'existe pas dans la BDD';
      }

      if (empty($data['email_err']) && empty($data['password_err']) && empty($data['pseudo_err'])) {
        //Si pas d'erreur on vérifie dans BDD
        //Si le mot de passe haché correspond à celui de l'utilisateur
        //Alors on ouvre la session
        //1er param c'est l'email de l'utilisateur
        //2er param c'est le mot de passe de l'utilisateur
        //3er param c'est le pseudo de l'utilisateur
        $loggedInUser = $this->userModel->login($data['email'], $data['password'], $data['pseudo']);
        if ($loggedInUser) {
          //Création d'une session => session_start => init.php
          //param c'est sont les  données de l'utilisateur qui sont récupérer dans BDD càd[]
          $this->createUserSession($loggedInUser);
        } else {
          $data['password_err'] = 'Mot de passe incorrect';
          //Afficher les erreurs
          $this->view('users/login', $data);
        }
      } else {
        //Sinon on affiche les erreurs
        $this->view('users/login', $data);
      }
    }
    //Ici il y a les données avec erreurs et les données à insérer dans la BDD
    //Stocker les erreurs en fonction de l'endroit où l'erreur est constatée
    else {
      //Sinon on va initialiser les données
      $data = [
        'pseudo' => '',
        'email' => '',
        'password' => '',
        'pseudo_err' => '',
        'email_err' => '',
        'password_err' => ''
      ];
      //On affiche de toutes les façon la view
      $this->view('users/login', $data);
    }
  }

  //Méthode pour les sessions(correspond toutes les données dans BDD)
  //Le param ce sont toutes les données de l'utilisateur qui sont récupérer dans BDD cad[]
  public function createUserSession($user)
  {
    $_SESSION['user_id'] = $user->id;
    $_SESSION['user_pseudo'] = $user->pseudo;
    $_SESSION['user_email'] = $user->email;
    $_SESSION['user_name'] = $user->name;
    $_SESSION['user_description'] = $user->description;
    $_SESSION['user_date'] = $user->created_date;

    //Rediriger l'utilisateur vers => posts/index.php
    //s'i il est connecté
    redirect('posts');
  }


  public function logout()
  {
    //Supprimer les varibles de session
    //unset c'est pour supprimer les variables sessions
    unset($_SESSION['user_id']);
    unset($_SESSION['user_pseudo']);
    unset($_SESSION['user_email']);
    unset($_SESSION['user_name']);
    unset($_SESSION['user_description']);
    unset($_SESSION['user_date']);
    //Supprimer la session dans sa globalité
    session_destroy();

    redirect('users/login');
  }
}
