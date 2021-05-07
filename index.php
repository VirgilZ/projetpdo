<?php
require_once __DIR__ . '/inc/database.php';
require 'functions.php';
$pdo = db_connect();

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
  <title>Accueil</title>
</head>

<body id="backgroundaccueil">
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
          <li class="nav_item"><a class="nav-link" href="utilisateurs.php">Liste des différents utilisateurs</a></li>
        </ul>
      </div>
    </nav>
  </header>
  <main>
    <div id="btnaccueil">
      <a href="total.php">
        <input class="btn btn-primary" type="submit" value="Accéder au récapitulatif">
      </a>
    </div>
    <div class="container-fluid">
      <h1 class="text-center padding-top=50px " id="firsttitle"> Gères ton budget !</h1>
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