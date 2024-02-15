<?php

require_once __DIR__ . '/../app/Model/Classes/db_model/AlbumBD.php';
require_once __DIR__ . '/../app/Model/Connection_BD.php';

use Model\Classes\db_model\AlbumBD;

// Créer une instance de AlbumBD
$albumBD = new AlbumBD($cnx);

// Récupérer les données des albums
$albums = $albumBD->getAllAlbums();

// Envoyer les données au format JSON
header('Content-Type: application/json');
echo json_encode($albums);

?>