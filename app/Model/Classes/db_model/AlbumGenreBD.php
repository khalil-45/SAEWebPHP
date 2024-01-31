<?php

namespace Model\Classes\db_model;

require_once __DIR__ . '/../Connection_BD.php';

use Model\Classes\AlbumGenre;
use PDO;

class AlbumGenreBD
{
    private $cnx;

    public function __construct(PDO $cnx)
    {
        $this->cnx = $cnx;
    }

    public function insertAlbumGenre(AlbumGenre $albumGenre)
    {
        $sql = "INSERT INTO ALBUM_GENRE (album_id, id_genre) VALUES (?, ?)";
        $stmt = $this->cnx->prepare($sql);
        $stmt->bindParam(1, $albumGenre->getAlbumId(), PDO::PARAM_INT);
        $stmt->bindParam(2, $albumGenre->getIdGenre(), PDO::PARAM_INT);
        $stmt->execute();
    }

    // Ajoutez d'autres méthodes au besoin pour récupérer des relations entre albums et genres, etc.
}

?>
