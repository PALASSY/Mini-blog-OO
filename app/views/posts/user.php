<!--Incure le header-->
<?php require APPROOT. '/views/inc/header.php'; ?>

<ul class="collapsible ulcol mt-4">
  <li>
    <div class="collapsible-header colhead">
      <i class="material-icons">account_circle</i>
       <?= $_SESSION['user_pseudo'] ?>
       <span class="badge"><i class="material-icons">fingerprint</i></span>
     </div>
  </li>
  <li>
    <div class="collapsible-header colhead">
      <i class="material-icons">assignment</i>
      <?= $_SESSION['user_description'] ?>
      <span class="badge"><i class="material-icons">check</i></span>
    </div>
  </li>
  <li>
    <div class="collapsible-header colhead">
      <i class="material-icons">email</i>
      <?= $_SESSION['user_email'] ?>
      <span class="badge"><i class="material-icons">grain</i></span>
    </div>
  </li>
  <li>
    <div class="collapsible-header colhead">
      <i class="material-icons">cake</i>
      <?= $_SESSION['user_date'] ?>
      <span class="badge"><i class="material-icons">child_care</i></span>
    </div>
  </li>
</ul>

<section class="row mt-2">
  <?php foreach ($data['posts'] as $post):?>
    <?php if($post -> userId == $_SESSION['user_id']) : ?>
      <div class="row">
          <div class="col s12 m6">
            <div class="card blue-grey darken-1">
              <div class="card-content white-text">
                <!--<= $post->title ?> tu recupères toutes les données et en particulier le (title)-->
                <span class="card-title"><h2><?= $post -> title ?></h2></span>
                <p class="mt-4"><?= $post -> content ?></p>
                <p class="mt-4">Article ecrit le : <?= $post -> postCreated ?></p>
                <p class="mt-4">Ecrit par : <?= $post -> userName ?></p>
              </div>
              <hr>
              <div class="row justify-content-end mr-5">
                <!--Modifier l'article-->
                <a href="<?= URLROOT ?>/posts/edit/<?= $post -> postId ?>" class="btn btn-danger">Modifier</a>
                <!--Supprimer l'article-->
                <form class="ml-3" action="<?= URLROOT ?>/posts/delete/<?= $post -> postId ?>" method="post">
                  <input type="submit" name="" value="Supprimer" class="btn btn-danger">
                </form>
                <!--Ajouter un article-->
                <a href="<?= URLROOT ?>/posts/add" class="btn btn-info pull-right ml-3">Ajouter un article</a>
              </div>
            </div>
          </div>
        </div>
    </article>
    <?php endif; ?>
  <?php endforeach; ?>
</section>
<div class="card-action">
  <a href="<?= URLROOT ?>/posts" class="btn btn-black"><i class="fas fa-backward"></i> Retour à l'accueil</a>
</div>



<!--Incure le footer-->
<?php require APPROOT. '/views/inc/footer.php'; ?>
