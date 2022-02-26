<?php
class Pages extends Controller {

  public function  __construct(){
    //echo 'Pages trouvée';
  }

  public function index(){
    //Si le $_SESSION['user_id'] est true
    //càd si on est loggé
      if(isLoggedIn()){
        //=> rediriger l'utilisateur vers page posts/index.php
        redirect('posts');
      }
    $data = ['title'=>'Bienvenue sur mon mini Blog'];
    $this -> view('pages/index',$data);
  }


  public function contact(){
    $data = ['title'=>'Contactez-nous'];
    $this -> view('pages/contact',$data);
  }
}
