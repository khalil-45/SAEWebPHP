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
$userBD = new UtilisateurBD($cnx);
$utilisateurBD = new UtilisateurBD($cnx);$playlistBD = new PlaylistBD($cnx);
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

        if ($artisteBD->getArtisteById($album->getArtisteId()) != null){
        $artiste = $artisteBD->getArtisteById($album->getArtisteId());
        }else{
            $artiste = null;
        }

        $playlists = $playlistBD->getAllPlaylistsByUserId($_SESSION['user']->getUserId());
        include 'templates/pageAlbum.php';
        break;
    
    case 'playlists':
        if ($_SESSION['user'] != null){
        $playlists = $playlistBD->getAllPlaylistsByUserId($_SESSION['user']->getUserId());
        }
        include 'templates/playlists.php';
        break;

    case 'playlist':
        if ($_SESSION['user'] != null){
            $playlistId = urldecode($_GET['id_playlist']);
            $playlist = $playlistBD->getPlaylistById($playlistId);
            $chansons = $chansonPlaylistBD->getAllChansonsPlaylistByPlaylistId($playlistId);
            $userIdPlaylist = $playlist->getUserId();
            $username = $userBD->getUtilisateurById($userIdPlaylist);
            if ($chansons != null){
                $premiereChanson = $chansonBD->getChansonById($chansons[0]->getChansonId());
                $imageAlbum = $albumBD->getAlbumById($premiereChanson->getAlbumId())->getPochette();
            }
        }
        include 'templates/playlist.php';

    case 'admin':
        include 'templates/admin/accueil_admin.php';
        break;

    case 'admin_albums':
        include 'templates/admin/admin_albums.php';
        break;

    case 'admin_artistes':
        include 'templates/admin/admin_artistes.php';
        break;

    case 'admin_utilisateurs':
        include 'templates/admin/admin_utilisateurs.php';
        break;

    case 'detail_artiste':
        include 'templates/detail_artiste.php';
        break;
    // Ajoutez ici d'autres cas en fonction des actions que votre application doit gérer
    default:
        include 'templates/404.php';
        break;
}