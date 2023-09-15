<?php

$dsn = 'mysql:dbname=flop;host=127.0.0.1:8889;charset=utf8mb4';
$user = 'root';
$password = 'root';

$dbh = new PDO($dsn, $user, $password);

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
</head>

<body>
    <h1>Let's goooo !</h1>
    <h2>Votre participation est validée</h2>
</body>

</html>