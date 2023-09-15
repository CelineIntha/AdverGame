<?php

$dsn = 'mysql:dbname=flop;host=127.0.0.1:8889;charset=utf8mb4';
$user = 'root';
$password = 'root';

$dbh = new PDO($dsn, $user, $password);

if (empty($_GET["res"])) {
    header("Location: /");
    die;
}

if (!empty($_POST['submit'])) {

    $errors = [];

    if (empty($_POST['firstname'])) {
        $errors["firstname"] = "Saisissez votre nom";
    }

    if (empty($_POST['lastname'])) {
        $errors["lastname"] = "Saisissez votre prénom";
    }

    if (empty($_POST['email'])) {
        $errors["email"] = "Saisissez votre email";
    }


    if (count($errors) > 0) {
        $_SESSION['errors'] = $errors;
        $_SESSION['values'] = $_POST;
        header("Location: /form.php?res=" . $_GET['res']);
        die;
    }



    $sql = "INSERT INTO utilisateur (nom_utilisateur, prenom_utilisateur, email_utilisateur, score_utilisateur) 
    VALUES (:firstname, :lastname, :email, :score)";
    $stmt = $dbh->prepare($sql);
    $stmt->execute([
        "firstname" => $_POST["firstname"],
        "lastname" => $_POST["lastname"],
        "email" => $_POST["email"],
        "score" => $_GET["res"]
    ]);
} else {
    header("Location: /form.php?res=" . $_GET['res']);
    die;
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flop - Merci !</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/form.css">
</head>

<body>
    <div class="container vw-100 vh-100">
        <div class="row g-3 needs-validation m-auto w-50 bg-light p-5 rounded-5 position-absolute top-50 start-50 translate-middle" action="form-POST.php?res=<?= $_GET['res'] ?>" method="POST" novalidate>
            <h1>Let's goooo !</h1>
            <h2>Votre participation est validée !</h2>
            <div class="m-auto d-flex justify-content-center align-items-center">
                <img class="w-25" src="assets/images/1200px-Logo_RWC2023_FR.svg.png" alt="">
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>

</html>