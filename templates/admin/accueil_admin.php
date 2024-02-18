<?php
require_once __DIR__ . '/../renders/fonctions.php';
bloqueAdmin();

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Raspberry Music</title>
    <link rel="stylesheet" href="../../static/css/main.css">
    <link rel="stylesheet" href="../../static/css/cardalbum.css">
    <link rel="stylesheet" href="../../static/css/admin.css">
</head>
<header>
    <div class="logo">
        <a href="?action=index">
            <img src="../../static/images/logoRaspberry.jpeg" alt="logo">
            <h1>Raspberry Music</h1>
        </a>
    </div>
</header>
<body>
<h1>Bienvenue dans le module admin</h1>
<div class="selection">
    <div class="card">
        <a href="?action=admin_albums">
            <img src="../../static/images/cd.png" alt="icone album">
            Gérer les albums
        </a>
    </div>
    <div class="card">
        <a href="?action=admin_artistes">
            <img src="../../static/images/microphone.png" alt="icone artiste">
            Gérer les artistes
        </a>
    </div>
    <div class="card">
        <a href="?action=admin_utilisateurs">
            <img src="../../static/images/profil-de-lutilisateur.png" alt="icone utilisateur">
            Gérer les utilisateurs
        </a>
    </div>
    <div class="card">
        <a href="?action=admin_genres">
            <img src="../../static/images/musique.png" alt="icone genre">
            Gérer les genres
        </a>
    </div>
</div>


</body>