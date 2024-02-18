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
use Model\Classes\db_model\ChansonPlaylistBD;
use Model\Classes\db_model\GenreBD;
use Model\Classes\db_model\ImageArtisteBD;
use Model\Classes\db_model\NoteBD;



$cnx = Connection_BD::getInstance();
$albumBD = new AlbumBD($cnx);
$chansonBD = new ChansonBD($cnx);
$artisteBD = new ArtisteBD($cnx);
$userBD = new UtilisateurBD($cnx);
$playlistBD = new PlaylistBD($cnx);
$chansonPlaylistBD = new ChansonPlaylistBD($cnx);
$genreBD = new GenreBD($cnx);
$imageBD = new ImageArtisteBD($cnx);
$user = new UtilisateurBD($cnx);
$utilisateurBD = new UtilisateurBD($cnx);
$noteBD = new NoteBD($cnx);

// Analyser la requête pour déterminer l'action à effectuer
$action = $_GET['action'] ?? 'index'; // Si aucune action n'est spécifiée, l'action par défaut est 'index'
ob_start();
// Exécuter l'action
switch ($action) {
    case 'index':
        $artiste = $artisteBD->getAllArtistes();
        $albums = $albumBD->getAllAlbums();
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

        if (isset($_SESSION['user']) && $_SESSION['user'] != null){
            $playlists = $playlistBD->getAllPlaylistsByUserId($_SESSION['user']->getUserId());
        } else {
            $playlists = null;
        }

        include 'templates/pageAlbum.php';
        break;
    
    case 'playlists':
        if (isset($_SESSION['user']) && $_SESSION['user'] != null){
            $playlists = $playlistBD->getAllPlaylistsByUserId($_SESSION['user']->getUserId());
        }
        else {
            $playlists = null;
        }
        include 'templates/page_playlists.php';
        break;

    case 'playlist':
        if ($_SESSION['user'] != null){
            $playlistId = urldecode($_GET['id_playlist']);
            $playlist = $playlistBD->getPlaylistById($playlistId);
            $chansons = $chansonPlaylistBD->getAllChansonsPlaylistByPlaylistId($playlistId);
            $userIdPlaylist = $playlist->getUserId();
            $username = $userBD->getUtilisateurById($userIdPlaylist);
            $imageAlbum = "default.jpg";
            if ($chansons != null){
                $premiereChanson = $chansonBD->getChansonById($chansons[0]->getChansonId());
                $imageAlbum = $albumBD->getAlbumById($premiereChanson->getAlbumId())->getPochette();
            }
        }
        include 'templates/page_playlist.php';
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

    case 'admin_utilisateurs':
        include 'templates/admin/admin_utilisateurs.php';
        break;

    case 'admin_genres':
        include 'templates/admin/admin_genres.php';
        break;

    case 'detail_artiste':
        $album = $albumBD->getAllAlbums();
        include 'templates/detail_artiste.php';
        break;

    default:
        include 'templates/404.php';
        break;
}