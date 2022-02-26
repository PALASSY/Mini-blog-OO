<!--Inclure le header-->
<?php require APPROOT. '/views/inc/header.php'; ?>



<div class="row">
    <div class="col s12 m6">
      <div class="card blue-grey darken-1">
        <div class="card-content white-text">
          <span class="card-title"><h2><?= $data['post']-> title ?></h2></span>
          <h6>Auteur: <?= $data['user'] -> name ?>, ecrit le <?= $data['post'] -> created_date ?></h6>
          <p class="mt-4"><?= $data['post'] -> content ?></p>
        </div>
        <div class="card-action">
          <a href="<?= URLROOT ?>/posts" class="btn btn-black"><i class="fas fa-backward"></i> Retour</a>
        </div>
        <!--Editer / Supprimer-->
        <!--Si l'utilisateur est l'auteur de l'article alors il peut modifier et/ou supprimer l'article-->
        <!--On va pouvoir modifier-->
        <div class="row justify-content-center">
          <?php
            if($data['post'] -> user_id == $_SESSION['user_id']) : ?>
            <hr>
            <!--Ce views gèrera la modification-->
            <a href="<?= URLROOT ?>/posts/edit/<?= $data['post'] -> id ?>" class="btn btn-danger">Editer</a>

            <!--On va pouvoir supprimer-->
            <form class="ml-1" action="<?= URLROOT ?>/posts/delete/<?= $data['post'] -> id ?>" method="post">
              <input type="submit" name="" value="Supprimer" class="btn btn-danger delete">
            </form>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>





<!--Inclure le footer-->
<?php require APPROOT. '/views/inc/footer.php'; ?>
