<?php
require_once __DIR__ . '/inc/database.php';
require 'functions.php';
$pdo = db_connect();
$regexDate = '/\d{4}-\d{2}-\d{2}/';
$users = need_money($pdo);
$user_id = (int) $_GET['user_id'];
$user_infos = user_details($pdo, $user_id);
$error = [];
if (!empty($_POST)) {
    
    if (empty($_POST['user_id'])) {
        $errors['user_id'] = 'Le champ est requis';
    }else if(!filter_var($_POST['user_id'], FILTER_VALIDATE_INT)){
        $errors['user_id'] = 'La valeur renseignée est incorrecte !';
    }
    if (empty($_POST['first_name'])) {
        $errors['first_name'] = 'Le champ est requis';
    }
    if (empty($_POST['last_name'])) {
        $errors['last_name'] = 'Le champ est requis';
    }

    if (empty($_POST['birth_date'])) {
        $errors['birth_date'] = 'Le champ est requis';
    }else if(!preg_match($regexDate, $_POST['birth_date'])){
        $errors['birth_date'] = 'La valeur renseignée est incorrecte !';
    }

    if (empty($errors)) {
        $user_id = (int) htmlentities($_POST['user_id']);
        $first_name = htmlentities($_POST['first_name']);
        $last_name = htmlentities($_POST['last_name']);
        $birth_date = htmlentities($_POST['birth_date']);
        if (updateUser($pdo, $user_id, $first_name, $last_name, $birth_date)) {
            $success = true;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="assets/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un utilisateur</title>
</head>

<body class="backgroundmaj">
    <div class="container-fluid">
        <div class="row justify-content-left">
            <?php if (isset($success)) : ?>
            <?php endif ?>
            <div class="col-md-4" id="left">
                <h2 id="update-title" class="text-center">Modifier
                    <?= $user_infos['first_name'] . ' ' . $user_infos['last_name'] ?></h2>
                <form id="form-update" class="text-center" method="post">
                    <div class="mb-3">
                        <label class="mb-3" for="first_name">Prénom</label>
                        <input name="first_name" class="form-control" id="first_name" type="text"
                            value="<?= $user_infos['first_name'] ?>">
                        <p class="mb-0 text-danger"><?= $errors['first_name'] ?? '' ?></p>
                    </div>
                    <div class="mb-3">
                        <label class="mb-3" for="last_name">Nom</label>
                        <input name="last_name" class="form-control" id="last_name" type="text"
                            value="<?= $user_infos['last_name'] ?>">
                        <p class="mb-0 text-danger"><?= $errors['last_name'] ?? '' ?></p>
                    </div>
                    <div class="mb-3">
                        <label class="mb-3" for="birth_date">Date de naissance</label>
                        <input name="birth_date" class="form-control" id="birth_date" type="date"
                            value="<?= $user_infos['birth_date'] ?>">
                        <p class="mb-0 text-danger"><?= $errors['birth_date'] ?? '' ?></p>
                    </div>
                    <div>
                        <input type="hidden" name="user_id" value="<?= htmlentities($user_id) ?>">
                        <input class="btn btn-primary " type="submit" value="Enregister">
                        <button type="button" class="btn btn-secondary"><a href="utilisateurs.php">Retour</a></button>
                </form>
            </div>
        </div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
</script>
</body>

</html>