<!--Incure le header-->
<?php require APPROOT. '/views/inc/header.php'; ?>


<div class="row">
  <div class="col-md-6 mx-auto">
    <h1>CONNEXION</h1>
    <div class="card cart-body bg-light mt-5">
      <h4>Merci de vous connecter</h4>
      <form class="" action="<?= URLROOT ?>/users/login" method="post">
          <div class="form-group">
            <label for="">Votre avatar<sup>*</sup></label>
            <input type="text" name="pseudo" class="<?php echo (!empty($data['pseudo_err'])) ? 'is-invalid' : '';?>" value="<?= $data['pseudo'] ?>">
            <span class="invalid-feedback"><?= $data['pseudo_err'] ?></span>
          </div>

          <div class="form-group">
            <label for="">Votre email<sup>*</sup></label>
            <input type="email" name="email" class="<?php echo (!empty($data['email_err'])) ? 'is-invalid' : '';?>" value="<?= $data['email'] ?>">
            <span class="invalid-feedback"><?= $data['email_err'] ?></span>
          </div>

          <div class="form-group">
            <label for="">Votre mot de passe<sup>*</sup></label>
            <input type="password" name="password" class="<?php echo (!empty($data['password_err'])) ? 'is-invalid' : '';?>" value="<?= $data['password'] ?>">
            <span class="invalid-feedback"><?= $data['password_err'] ?></span>
          </div>
          <div class="row">
            <div class="col">
              <input type="submit"  value="Se connecter" class="btn btn-success btn-block">
            </div>
            <div class="col">
              <a href="<?= URLROOT ?>/users/register" class="btn btn-light btn-block">Pas encore inscrit? -> Ici</a>
            </div>
          </div>
      </form>

    </div>
  </div>
</div>

<!--Incure le header-->
<?php require APPROOT. '/views/inc/footer.php'; ?>
