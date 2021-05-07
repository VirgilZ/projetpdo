<?php
require_once __DIR__ . '/inc/database.php';
require 'functions.php';
$pdo = db_connect();
$regexDate = '/\d{4}-\d{2}-\d{2}/';
$users = need_money($pdo);
$user_id = (int) $_GET['user_id'];
$exp_id = (int) $_GET['exp_id'];
$user_infos = user_details($pdo, $user_id);
$modif_exp = exp_details($pdo , $exp_id);
$expense_infos = exp_details($pdo, $exp_id);
$error = [];
if (!empty($_POST)) {
    if (empty($_POST['exp_amount'])) {
        $errors['exp_amount'] = 'Le champ est requis';
    }
    if (empty($_POST['exp_date'])) {
        $errors['exp_date'] = 'Le champ est requis';
    }else if(!preg_match($regexDate, $_POST['exp_date'])){
        $errors['exp_date'] = 'La valeur renseignée est incorrecte !';
    }
    if (empty($errors)) {
        $birth_date = htmlentities($_POST['exp_date']);
        $exp_amount = htmlentities($_POST['exp_amount']);
        if (updateUsermoneyexp($pdo, $exp_id, $birth_date, $exp_amount )) {
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
    <title>Modifier une dépense </title>
</head>

<body class="backgroundmaj">
    <div class="container-fluid">
        <div class="row justify-content-left">
            <?php if (isset($success)) : ?>
            <?php endif ?>
            <div class="col-md-4" id="left">
                <h2 id="update-title" class="text-center">Modifier les dépenses de
                    <?= $user_infos['first_name'] . ' ' . $user_infos['last_name'] ?></h2>
                <form id="form-update" class="text-center" method="post">
                    <div class="mb-3">
                        <label class="mb-3" for="exp_amount">Modifier les dépenses :</label>
                        <input name="exp_amount" class="form-control" id="exp_amount" type="text"
                            value="<?= $modif_exp['exp_amount'] ?>">
                        <p class="mb-0 text-danger"><?= $errors['exp_amount'] ?? '' ?></p>
                    </div>
                    <div class="mb-3">
                        <label class="mb-3" for="exp_date">Date de la dépense</label>
                        <input name="exp_date" class="form-control" id="exp_date" type="date"
                            value="<?= $user_infos['exp_date'] ?>">
                        <p class="mb-0 text-danger"><?= $errors['exp_date'] ?? '' ?></p>
                    </div>
                    <div>
                        <input type="hidden" name="exp_id" value="<?= htmlentities($exp_id) ?>">
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