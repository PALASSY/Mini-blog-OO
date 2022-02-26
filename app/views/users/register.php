<!--Incure le header-->
<?php require APPROOT. '/views/inc/header.php'; ?>

<div class="row">
  <div class="col-md-6 mx-auto">
    <h1>INSCRIPTION</h1>
    <div class="card cart-body bg-light mt-5">
      <h4>Merci de remplir tous les champs pour s'inscrire</h4>
      <!--La validation se passe sur controllers(Users) -->
      <form action="<?= URLROOT ?>/users/register" method="post">
          <div class="form-group">
            <label for="">Votre avatar<sup>*</sup></label>
            <input type="text" name="pseudo" class="<?php echo (!empty($data['pseudo_err'])) ? 'is-invalid' : '';?> " value="<?= $data['pseudo'] ?>">
            <span class="invalid-feedback"><?= $data['pseudo_err']; ?></span>
          </div>

          <div class="form-group">
            <label for="">Votre description<sup>*</sup></label>
            <input type="text" name="description" class="<?php echo (!empty($data['description_err'])) ? 'is-invalid' : '';?>" value="<?= $data['description'] ?>">
            <span class="invalid-feedback"><?= $data['description_err'] ?></span>
          </div>

          <div class="form-group">
            <label for="">Votre nom<sup>*</sup></label>
            <input type="text" name="name" class="<?php echo (!empty($data['name_err'])) ? 'is-invalid' : '';?>" value="<?= $data['name'] ?>">
            <span class="invalid-feedback"><?= $data['name_err']; ?></span>
          </div>

          <div class="form-group">
            <label for="">Votre email<sup>*</sup></label>
            <input type="email" name="email" class="<?php echo (!empty($data['email_err'])) ? 'is-invalid' : '';?>" value="<?= $data['email'] ?>">
            <span class="invalid-feedback"><?= $data['email_err'] ?></span>
          </div>

          <div class="form-group">
            <label for="">Votre mot de passe<sup>*</sup></label>
            <input type="password" name="password"  class="<?php echo (!empty($data['password_err'])) ? 'is-invalid' : '';?>" value="<?= $data['password'] ?>">
            <span class="invalid-feedback"><?= $data['password_err'] ?></span>
          </div>

          <div class="form-group">
            <label for="">Confirmez-votre mot de passe<sup>*</sup></label>
            <input type="password" name="confirm_password"  class="<?php echo (!empty($data['confirm_password_err'])) ? 'is-invalid' : '';?>" value="<?= $data['confirm_password'] ?>">
            <span class="invalid-feedback"><?= $data['confirm_password_err'] ?></span>
          </div>

          <div class="row">
            <div class="col">
              <input type="submit" value="S'inscrire" class="btn btn-success btn-block">            </div>
            <div class="col">
              <a href="<?= URLROOT ?>/users/login" class="btn btn-light btn-block">Déjà inscrit? -> Ici</a>
            </div>
          </div>
      </form>
    </div>
  </div>
</div>
<!--Incure le header-->
<?php require APPROOT. '/views/inc/footer.php'; ?>
