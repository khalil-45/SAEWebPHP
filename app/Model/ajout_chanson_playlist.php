<?php 
require '../Autoloader.php';
Autoloader::register();

session_start();

use Model\Connection_BD;
use Model\Classes\db_model\UtilisateurBD;
use Model\Classes\db_model\ChansonPlaylistBD;

$cnx = Connection_BD::getInstance();
$user = new UtilisateurBD($cnx);
$chansonPlaylistBD = new ChansonPlaylistBD($cnx);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['user'])) {

    $chansonId = $_POST['chanson_id'];
    $playlistId = $_POST['playlist'];

    $chansonPlaylistBD->insertChansonPlaylist($chansonId, $playlistId);

    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
} else {
    echo "Unauthorized access or user not logged in.";
}