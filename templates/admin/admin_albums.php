<?php
require 'app/Model/render.php';

/*

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user'])) {
    header('Location: index.php?action=index');
    exit();
}
*/

if (isset($_GET['admin'])) {
    $action = $_GET['admin'];
} else {
    $action = NAN;
}

$artistes = $artisteBD->getAllArtistes();
$genres = $genreBD->getAllGenres();
$album = $albumBD->getAllAlbums();
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
            if ($action == 'admin_ajout_album') {
                render_ajout_album($albumBD, $artistes, $genreBD);
            } else if ($action == 'admin_editer_album') {
                $album = $albumBD->getAlbumById($_GET['id_album']);
                render_editer_album($album, $artistes, $genreBD, $albumBD);
            } else if ($action == 'admin_supprimer_album') {
                $albumBD->deleteAlbumById($_GET['id_album']);
                header('Location: ?action=admin_albums');
            }
            else {
                render_albums_admin($album, $artistes);
            }
            ?>
        </div>
    </body>
</html>
