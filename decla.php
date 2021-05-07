<?php
require_once __DIR__ . '/inc/database.php';
require 'functions.php';
$pdo = db_connect();

$users = need_money($pdo);

$inc_cats = categorie($pdo);

$errors = [];
if (!empty($_POST)) {
    if (empty($_POST['inc_amount'])) {
        $errors['inc_amount'] = 'Le champ est requis';
    }
    if (empty($_POST['user_id'])) {
        $errors['user_id'] = 'Le champ est requis';
    } else if (!filter_var($_POST['user_id'], FILTER_VALIDATE_INT)) {
        $errors['user_id'] = 'La valeur renseignée est incorrecte !';
    }
    if (empty($_POST['inc_amount'])) {
        $errors['inc_amount'] = 'Le champ est requis';
    } 
    
    if (empty($errors)) {
        
        $inc_amount =  htmlentities($_POST['inc_amount']);
        $inc_receipt_date = htmlentities($_POST['inc_receipt_date']);
        $inc_cat_id = htmlentities($_POST['inc_cat_id']);
        $user_id = htmlentities($_POST['user_id']);
        if (add_money($pdo, $inc_amount, $inc_receipt_date, $inc_cat_id, $user_id)) {
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
    <title>Déclaration de revenu</title>
</head>

<body id="backgrounddecla">
    <header>
        <nav class="navbar navbar-dark bg-dark navbar-expand-md">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav_item"> <a class="nav-link" href="index.php">Accueil</a></li>
                    <li class="nav_item"> <a class="nav-link" href="ajout.php">Ajout d'un utilisateur</a></li>
                    <li class="nav_item"><a class="nav-link" href="decla.php">Déclaration de revenu</a></li>
                    <li class="nav_item"><a class="nav-link" href="depense.php">Déclaration de dépense</a></li>
                    <li class="nav_item"><a class="nav-link" href="utilisateurs.php">Liste des différents
                            utilisateurs</a></li>
                </ul>
            </div>
        </nav>
    </header>
    <main>
        <div class="container-fluid">
            <div class="row justify-content-end">
                <div class="col-md-6">
                    <form method="POST">
                        <H2 id="decla">Déclaration de revenu </H2>
                        <?php if (isset($success)) : ?>
                        <?php endif ?>
                        <div class="form-row">
                            <div class="mb-3 mx-auto" style="width: 200px;">
                                <label for="form-select">Selectionner un utilisateur</label>
                                <select class="form-select" name="user_id" id="user">
                                    <?php foreach ($users as $user) : ?>
                                    <option value="<?= $user['user_id'] ?>">
                                        <?= ucfirst($user['last_name'])   . ' ' . ucfirst($user['first_name']) ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="mb-2 mx-auto" style="width: 200px;">
                                <label for="start">Date de réception</label>
                                <input type="date" name="inc_receipt_date" class="form-control">
                                <p class="mb-0 text-danger"><?= $errors['inc_receipt_date'] ?? '' ?></p>
                            </div>
                            <div class=" mb-2 mx-auto" style="width: 200px;">
                                <label for="inputCat">Catégories</label>
                                <select name="inc_cat_id" class="form-select" id="inc">
                                    <?php foreach ($inc_cats as $inc_cat) : ?>
                                    <option value="<?= $inc_cat['inc_cat_id'] ?>"><?= $inc_cat['inc_cat_name'] ?>
                                    </option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="mb-2 mx-auto" style="width: 200px;">
                                <label for="montant">Montant</label>
                                <input type="number" name="inc_amount" class="form-control" id="montant">
                                <p class="mb-0 text-danger"><?= $errors['inc_amount'] ?? '' ?></p>
                            </div>
                        </div>
                        <div id="submit">
                            <input class="btn btn-primary" type="submit" value="Déclarer">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
    </script>
</body>

</html>