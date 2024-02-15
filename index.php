<?php
require 'app/Autoloader.php';
Autoloader::register();

session_start();


use Model\Connection_BD;
use Model\Classes\db_model\AlbumBD;
use Model\Classes\db_model\ChansonBD;
use Model\Classes\db_model\ArtisteBD;
use Model\Classes\db_model\UtilisateurBD;
use Model\Classes\db_model\GenreBD;
use Model\Classes\db_model\ImageArtisteBD;


$cnx = Connection_BD::getInstance();
$albumBD = new AlbumBD($cnx);
$chansonBD = new ChansonBD($cnx);
$artisteBD = new ArtisteBD($cnx);
$genreBD = new GenreBD($cnx);
$imageBD = new ImageArtisteBD($cnx);
$user = new UtilisateurBD($cnx);



$album = $albumBD->getAllAlbums();

// Analyser la requête pour déterminer l'action à effectuer
$action = $_GET['action'] ?? 'index'; // Si aucune action n'est spécifiée, l'action par défaut est 'index'
ob_start();
// Exécuter l'action
switch ($action) {
    case 'index':
        include 'templates/accueil.php';
        break;
    
    case 'album':
        $chansons = $chansonBD->getChansonsByAlbumId($_GET['id_album']);

        $album = $albumBD->getAlbumById($_GET['id_album']);

        $artiste = $artisteBD->getArtisteById($album['artiste_id']);
        include 'templates/pageAlbum.php';
        break;

    case 'admin':
        include 'templates/admin/accueil_admin.php';
        break;

    case 'admin_albums':
        include 'templates/admin/admin_albums.php';
        break;

    case 'admin_artistes':
        include 'templates/admin/admin_artistes.php';
        break;
    // Ajoutez ici d'autres cas en fonction des actions que votre application doit gérer
    default:
        http_response_code(404);
        echo "Page not found";
}