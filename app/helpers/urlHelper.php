<?php
//Redirection des pages


//Redirection simple
//param c'est la page 
function redirect($page){
  header('Location:'.URLROOT.'/'.$page);
}
