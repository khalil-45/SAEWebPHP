<?php
require 'app/Autoloader.php';
Autoloader::register();

use Model\Connection_BD;
use Model\Classes\db_model\AlbumBD;

$cnx = Connection_BD::getInstance();
$albumBD = new AlbumBD($cnx);

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
        include 'public/pageAlbum.php';
        break;
    // Ajoutez ici d'autres cas en fonction des actions que votre application doit gérer
    default:
        http_response_code(404);
        echo "Page not found";
}