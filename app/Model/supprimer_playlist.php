<?php 
require '../Autoloader.php';
Autoloader::register();

session_start();

use Model\Connection_BD;
use Model\Classes\db_model\UtilisateurBD;
use Model\Classes\db_model\PlaylistBD;

$cnx = Connection_BD::getInstance();
$user = new UtilisateurBD($cnx);
$playlistBD = new PlaylistBD($cnx);

if ($_SERVER["REQUEST_METHOD"] == "POST" && $_SESSION['user'] != null) {
    $user_id = $_SESSION['user']->getUserId();
    $playlist_id = $_POST['id_playlist'];

    $playlistBD->deletePlaylist($playlist_id);

    // Redirect the user to the My Playlists page after deleting the playlist
    header("Location: /?action=playlists");
    exit();
}
else {
    // Redirect the user to the home page if they are not logged in
    header("Location: /?action=index");
    exit();
}