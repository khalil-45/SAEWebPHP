<?php
require 'app/Autoloader.php';
Autoloader::register();

use Model\Connection_BD;
use Model\Classes\db_model\AlbumBD;
use Model\Classes\db_model\ChansonBD;
use Model\Classes\db_model\ArtisteBD;

$cnx = Connection_BD::getInstance();
$albumBD = new AlbumBD($cnx);
$chansonBD = new ChansonBD($cnx);
$artisteBD = new ArtisteBD($cnx);


$album = $albumBD->getAllAlbums();

// Analyser la requête pour déterminer l'action à effectuer
$action = $_GET['action'] ?? 'index'; // Si aucune action n'est spécifiée, l'action par défaut est 'index'
ob_start();
// Exécuter l'action
switch ($action) {
    case 'index':
        include 'public/accueil.php';
        break;
    
    case 'album':
        $chansons = $chansonBD->getChansonsByAlbumId($_GET['id_album']);

        $album = $albumBD->getAlbumById($_GET['id_album']);

        $artiste = $artisteBD->getArtisteById($album['artiste_id']);
        include 'public/pageAlbum.php';
        break;
    // Ajoutez ici d'autres cas en fonction des actions que votre application doit gérer
    default:
        http_response_code(404);
        echo "Page not found";
}