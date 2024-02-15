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
    $titre = $_POST['titre'];

    $playlistBD->insertPlaylist($user_id, $titre);

    // Redirigez l'utilisateur vers la page Mes Playlists après l'ajout de la playlist
    header("Location: /?action=playlists");
    exit();
}
else {
    // Redirigez l'utilisateur vers la page d'accueil s'il n'est pas connecté
    header("Location: /?action=index");
    exit();
}