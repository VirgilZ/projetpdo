<?php
require_once __DIR__ . '/inc/database.php';
require 'functions.php';
$pdo = db_connect();
$regexDate = '/\d{4}-\d{2}-\d{2}/';
$users = need_money($pdo);
$user_id = (int) $_GET['user_id'];
$inc_id = (int) $_GET['inc_id'];
$user_infos = user_details($pdo, $user_id);
$modif_inc = inc_details($pdo, $inc_id);
$income_infos = inc_details($pdo, $inc_id);
$errors = [];
if (!empty($_POST)) {
    if (empty($_POST['inc_amount'])) {
        $errors['inc_amount'] = 'Le champ est requis';
    }
    if (empty($_POST['inc_receipt_date'])) {
        $errors['inc_receipt_date'] = 'Le champ est requis';
    }else if(!preg_match($regexDate, $_POST['inc_receipt_date'])){
        $errors['inc_receipt_date'] = 'La valeur renseignée est incorrecte !';
    }
    if (empty($errors)) {
        $birth_date = htmlentities($_POST['inc_receipt_date']);
        $inc_amount = htmlentities($_POST['inc_amount']);
        if (updateUsermoney($pdo, $inc_id, $birth_date, $inc_amount )) {
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
    <title>Modifier un revenu </title>
</head>

<body class="backgroundmaj">
    <div class="container-fluid">
        <div class="row justify-content-left">
            <?php if (isset($success)) : ?>
            <?php endif ?>
            <div class="col-md-4" id="left">
                <h2 id="update-title" class="text-center">Modifier les revenus de
                    <?= $user_infos['first_name'] . ' ' . $user_infos['last_name'] ?></h2>
                <form id="form-update" class="text-center" method="post">
                    <div class="mb-3">
                        <label class="mb-3" for="inc_amount">Modifier les revenu :</label>
                        <input name="inc_amount" class="form-control" id="inc_amount" type="text"
                            value="<?= $modif_inc['inc_amount'] ?>">
                        <p class="mb-0 text-danger"><?= $errors['inc_amount'] ?? '' ?></p>
                    </div>
                    <div class="mb-3">
                        <label class="mb-3" for="birth_date">Date du revenu</label>
                        <input name="inc_receipt_date" class="form-control" id="inc_receipt_date" type="date"
                            value="<?= $modif_inc['inc_receipt_date'] ?>">
                        <p class="mb-0 text-danger"><?= $errors['inc_receipt_date'] ?? '' ?></p>
                    </div>
                    <div>
                        <input type="hidden" name="inc_id" value="<?= htmlentities($inc_id) ?>">
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