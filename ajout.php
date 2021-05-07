<?php
require_once __DIR__. '/inc/database.php';
require 'functions.php';
$pdo = db_connect();

$error = false;
if (!empty($_POST))  {
    if (empty($_POST['first_name'])) {
        $error = true;
    }

    if (!$error) {
        $first_name = htmlentities($_POST['first_name']);
        $last_name = htmlentities($_POST['last_name']);
        $birth_date = htmlentities($_POST['birth_date']);
        if (addUser($pdo, $first_name, $last_name, $birth_date)) {
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
    <title>Ajout d'un utilisateur</title>
</head>

<body id="backgroundajout">
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
            <div class="row justify-content-start">
                <div class="col-md-9">
                    <form method="POST">
                        <H2 id="ajout"> Ajout d'un utilisateur </H2>
                        <div class="form-row">
                            <div class=" mb-2 mx-auto" style="width: 200px;">
                                <label for="">Prénom</label>
                                <input type="text" class="form-control" placeholder="Ex: Louis " name="first_name">
                            </div>
                            <div class=" mb-2 mx-auto" style="width: 200px;">
                                <label for="">Nom</label>
                                <input type="text" class="form-control" placeholder="Ex: Royez " name="last_name">
                            </div>
                            <div class="mb-2 mx-auto" style="width: 200px;">
                                <label for="start">Date de naissance</label>
                                <input type="date" id="start" min="1900-01-01" max="2021-12-31" name="birth_date">
                            </div>
                        </div>
                        <div id="submit">
                            <input class="btn btn-primary" type="submit" value="Ajouter">
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