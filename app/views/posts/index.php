<!--Inclure le header-->
<?php require APPROOT. '/views/inc/header.php'; ?>
<!--<?php
    echo '<pre>'. print_r($_SESSION, true) .'</pre>';
 ?>-->
<div class="row">
  <div class="col-md-6">
    <h1>Articles</h1>
  </div>
  <div class="col-md-6">
    <a href="<?= URLROOT ?>/posts/add" class="btn btn-info pull-right">
      <i class="fas fa-pencil-alt"></i>
      Ajouter un article
    </a>
  </div>
</div>


<!--<?php
    echo '<pre>'. print_r($data['messageAjout'], true) .'</pre>';
 ?>-->

<section class="row">
  <?php foreach ($data['posts'] as $post):?>
  <article class="card card-body">
    <!--<= $post->title ?> tu recupères toutes les données et en particulier le (title)-->
    <h4 class="card-title"><?= $post->title ?></h4>
    <p class="card-text"><?= $post->content ?></p>
    <span>Auteur: <?= $post->name ?><br> écrit le, <?= $post->postCreated ?></span>
    <span class="color:red;">La data de création de users <?= $post->userCreated ?></span>
    <br>
    <!--param c'est id de posts(BDD)-->
    <a href="<?= URLROOT ?>/posts/show/<?= $post->postId ?>" class="btn btn-dark mt-3 btnArticle">Lire la suite...</a>
  </article>
  <?php endforeach; ?>
</section>


<!--Inclure le footer-->
<?php require APPROOT. '/views/inc/footer.php'; ?>
