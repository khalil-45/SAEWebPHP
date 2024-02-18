<?php
include 'renders/fonctions.php';
require '../app/Autoloader.php';
Autoloader::register();

use Model\Connection_BD;
use Model\Classes\db_model\AlbumBD;
use Model\Classes\db_model\ArtisteBD;
use Model\Classes\db_model\ImageArtisteBD;

$cnx = Connection_BD::getInstance();
$albumBD = new AlbumBD($cnx);
$artisteBD = new ArtisteBD($cnx);
$imageBD = new ImageArtisteBD($cnx);

$albumsRecherche = [];
$artistesRecherche = [];

if (isset($_GET['recherche'])) {
    $query = $_GET['recherche'];
    $albumsRecherche = $albumBD->searchAlbums($query);
    $artistesRecherche = $artisteBD->searchArtiste($query);
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Raspberry Music</title>
    <link rel="stylesheet" href="../static/css/asidemenu.css">
    <link rel="stylesheet" href="../static/css/main.css">
    <link rel="stylesheet" href="../static/css/popupForm.css">
    <link rel="stylesheet" href="../static/css/cardalbum.css">
</head>

<body>
    <?php include 'renders/aside_menu.php'; ?>
    <main>
        <div class="titre">
            <h2>Résultats de la recherche</h2>
        </div>
        <div class="grid">
            <?= implode('', array_map('renderAlbum', $albumsRecherche)) ?>
        </div>

        <div class="titre">
            <h2>Artistes</h2>
        </div>

        <div class="grid">
            <?= implode('', array_map('renderArtiste', $artistesRecherche)) ?>
        </div>

    </main>
</body>
<?php include 'renders/insertion_js.php'; ?>

</html>