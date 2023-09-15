<?php
if (empty($_GET["res"])) {
  header("Location: /");
  die;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Flop</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  <link rel="stylesheet" href="assets/css/form.css">
</head>

<body>
  <div class="container vw-100 vh-100">
    <form class="row g-3 needs-validation m-auto w-50 bg-light p-5 rounded-5 position-absolute top-50 start-50 translate-middle" action="form-POST.php?res=<?= $_GET['res'] ?>" method="POST" novalidate>
      <h2 class="text-center">Score: <?= $_GET["res"] ?></h2>
      <div class="col-md-6">
        <label for="validationCustom01" class="form-label">Nom</label>
        <input type="text" class="form-control" id="validationCustom01" name="firstname" required>
        <div class="valid-feedback">
          Looks good!
        </div>
      </div>
      <div class="col-md-6">
        <label for="validationCustom02" class="form-label">Prénom</label>
        <input type="text" class="form-control" id="validationCustom02" name="lastname" required>
        <div class="valid-feedback">
          Looks good!
        </div>
      </div>
      <div class="col">
        <label for="validationCustom02" class="form-label">Email</label>
        <input type="email" class="form-control" id="validationCustom02" name="email" required>
        <div class="valid-feedback">
          Looks good!
        </div>
      </div>
      <div class="col-12">
        <div class="form-check">
          <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
          <label class="form-check-label" for="invalidCheck">
            Je confirme avoir pris connaissance des regles du jeu
          </label>
          <div class="invalid-feedback">
            You must agree before submitting.
          </div>
        </div>
      </div>
      <div class="col-12">
        <div class="form-check">
          <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
          <label class="form-check-label" for="invalidCheck">
            J’accepte l’usage de mes coordonnées pour l’envoi de courriers électroniques promotionnels
          </label>
          <div class="invalid-feedback">
            You must agree before submitting.
          </div>
        </div>
      </div>
      <div class="col-12 text-center">
        <button class="btn btn-primary" type="submit" name="submit" value="Envoyer">S'inscrire</button>
      </div>
    </form>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>

</html>