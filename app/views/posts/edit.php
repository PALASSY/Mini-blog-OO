<!--Incure le header-->
<?php require APPROOT. '/views/inc/header.php'; ?>


<div class="row">
  <div class="col-md-6 mx-auto">
    <div class="card card-body bg-light mt-5">
      <a href="<?= URLROOT ?>/posts" class="btn btn-light btn-block"><i class="fas fa-backward"></i> Annuler</a>
      <h1>Modifier l'article</h1>
      <form class="" action="<?= URLROOT ?>/posts/edit/<?= $data['id'] ?>" method="post">
          <div class="form-group">
            <label for="">Le titre à modifier<sup>*</sup></label>
            <input type="text" name="title" class="<?php echo (!empty($data['title_err'])) ? 'is-invalid' : '';?>" value="<?= $data['title'] ?>">
            <span class="invalid-feedback"><?= $data['title_err'] ?></span>
          </div>

          <div class="form-group">
            <label for="">Le contenu à modifier<sup>*</sup></label>
            <textarea name="content" class="<?php echo (!empty($data['content_err'])) ? 'is-invalid' : '';?>"><?= $data['content'] ?></textarea>
            <span class="invalid-feedback"><?= $data['content_err'] ?></span>
          </div>
          <input type="submit"  value="Modifier" class="btn btn-success mb-3">
      </form>

    </div>
  </div>
</div>

<!--Incure le footer-->
<?php require APPROOT. '/views/inc/footer.php'; ?>
