<?php
//On peut avoir et/ou modifier le posts
//Pour déclencher des instructions supplémentaires
 function isLoggedIn(){
  if(isset($_SESSION['user_id'])){
    return true;
  }else{
    return false;
  }
}
