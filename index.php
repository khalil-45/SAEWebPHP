<?php
require 'app/Autoloader.php';
Autoloader::register();

session_start();


use Model\Connection_BD;
use Model\Classes\db_model\AlbumBD;
use Model\Classes\db_model\ChansonBD;
use Model\Classes\db_model\ArtisteBD;
use Model\Classes\db_model\UtilisateurBD;
use Model\Classes\db_model\PlaylistBD;
use Model\Classes\ChansonPlaylist;
use Model\Classes\db_model\ChansonPlaylistBD;


$cnx = Connection_BD::getInstance();
$albumBD = new AlbumBD($cnx);
$chansonBD = new ChansonBD($cnx);
$artisteBD = new ArtisteBD($cnx);
$userBD = new UtilisateurBD($cnx);
$playlistBD = new PlaylistBD($cnx);
$chansonPlaylistBD = new ChansonPlaylistBD($cnx);

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

        $artiste = $artisteBD->getArtisteById($album->getArtisteId());
        include 'templates/pageAlbum.php';
        break;
    
    case 'playlists':
        if ($_SESSION['user'] != null){
        $playlists = $playlistBD->getPlaylistByUserId($_SESSION['user']->getId());
        }
        include 'templates/playlists.php';
        break;

    case 'playlist':
        if ($_SESSION['user'] != null){
        $playlist = $playlistBD->getPlaylistById($_GET['id_playlist']);
        $chansons = $chansonPlaylistBD->getChansonPlaylistByPlaylistId($_GET['id_playlist']);
        $userIdPlaylist = $playlist->getUserId();
        $username = $userBD->getUtilisateurById($userIdPlaylist);
        }
        include 'templates/playlist.php';
        break;
    // Ajoutez ici d'autres cas en fonction des actions que votre application doit gérer
    default:
        include 'templates/404.php';
        break;
}