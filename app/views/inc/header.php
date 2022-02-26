<!DOCTYPE html>
<html lang="fr" dir="ltr" class="h-100" >
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="theme-color" content="#7952b3">

    <title><?= SITENAME ?></title>

    <!--  IMAGES -->
    <link rel="icon" href="<?= URLROOT ?>/images/icons/favicon.ico">
    <!--  ICONS -->
    <script src="https://kit.fontawesome.com/bb0dbb8b96.js" crossorigin="anonymous"></script>
    <!-- BOOTSTRAP-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <!--MATERIALIZE-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--CSS-->
    <link rel="stylesheet"  type="text/css"  href="<?= URLROOT ?>/css/bootstyle.css">
    <link rel="stylesheet"  type="text/css"  href="<?= URLROOT ?>/css/style.css">
  </head>
  <body class="d-flex h-100 text-center text-white bg-dark">
    <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
      <header class="mb-auto">
        <div>
          <h3 class="float-md-start mb-3">PALACE</h3>
          <!--Affichage des notifications-->
          <div class="notifications"></div>
          <nav class="nav nav-masthead justify-content-center float-md-end">
            <a class="nav-link active" aria-current="page" href="<?= URLROOT ?>/pages/contact ">Accueil</a>

            <?php if(isset($_SESSION['user_id'])) :  ?>
            <a class="nav-link" href="<?= URLROOT ?>/users/logout">Deconnexion</a>

            <a href="<?= URLROOT ?>/posts/user/<?= $_SESSION['user_id'] ?>" class="nav-link"><span>Bienvenue <span style="color:red"><em><?= $_SESSION['user_name'] ?></em>
            </span>, venez par ici!</span></a>

            <?php else : ?>
            <a class="nav-link" href="<?= URLROOT ?>/users/register">Inscription</a>
            <a class="nav-link" href="<?= URLROOT ?>/users/login">Connexion</a>

            <?php endif; ?>

          </nav>
        </div>
      </header>

      <main class="px-3">
