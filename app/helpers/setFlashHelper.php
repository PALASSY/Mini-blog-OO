<?php

function setFlash($message,$color="white"){
  $_SESSION['flash'] = [
            'message' => $message,
            'color' => $color
          ];
          
}
