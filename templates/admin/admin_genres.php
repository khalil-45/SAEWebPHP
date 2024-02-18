<?php

require 'app/Model/render.php';
require_once __DIR__ . '/../renders/fonctions.php';
bloqueAdmin();

if (isset($_GET['admin'])) {
    $action = $_GET['admin'];
} else {
    $action = NAN;
}
$genres = $genreBD->getAllGenres();
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
    <link rel="stylesheet" href="../../static/css/tableau.css">
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
<div class="content">
    <?php
    if ($action == 'admin_ajout_genre') {
        render_ajout_genre($genreBD);
    } else if ($action == 'admin_editer_genre') {
        $genre = $genreBD->getGenreById($_GET['id_genre']);
        render_editer_genre($genre, $genreBD);
    } else if ($action == 'admin_supprimer_genre') {
        $genreBD->deleteGenre($_GET['id_genre']);
        header('Location: ?action=admin_genres');
    }
    else {
        render_genres_admin($genres);
    }
    ?>
</div>
</body>
</html>
