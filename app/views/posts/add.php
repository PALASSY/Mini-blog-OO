<!--Incure le header-->
<?php require APPROOT. '/views/inc/header.php'; ?>

<div class="row">
  <div class="col-md-6 mx-auto">
    <div class="card cart-body bg-light mt-5">
      <a href="<?= URLROOT ?>/posts" class="btn btn-light btn-block"><i class="fas fa-backward"></i> Retour</a>
      <h1>Ajouter un article</h1>
      <form class="" action="<?= URLROOT ?>/posts/add" method="post">
          <div class="form-group">
            <label for="">Le titre<sup>*</sup></label>
            <input type="text" name="title" class="<?php echo (!empty($data['title_err'])) ? 'is-invalid' : '';?>" value="<?= $data['title'] ?>">
            <span class="invalid-feedback"><?= $data['title_err'] ?></span>
          </div>

          <div class="form-group">
            <label for="">Le contenu<sup>*</sup></label>
            <textarea name="content" class="<?php echo (!empty($data['content_err'])) ? 'is-invalid' : '';?>" value="<?= $data['content'] ?>"></textarea>
            <span class="invalid-feedback"><?= $data['content_err'] ?></span>
          </div>
          <input type="submit"  value="Insérer" class="btn btn-success mb-3 insert" name="button_insert">
      </form>

    </div>
  </div>
</div>

<!--Incure le footer-->
<?php require APPROOT. '/views/inc/footer.php'; ?>
