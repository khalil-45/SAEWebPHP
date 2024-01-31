<?php

namespace Model\Classes\db_model;

require_once __DIR__ . '/../Connection_BD.php';

use Model\Classes\Album;
use PDO;

class AlbumBD
{
    private $cnx;

    public function __construct(PDO $cnx)
    {
        $this->cnx = $cnx;
    }

    public function insertAlbum(Album $album)
    {
        $sql = "INSERT INTO ALBUM (titre, annee, genre, pochette, artiste_id) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->cnx->prepare($sql);
        $stmt->bindParam(1, $album->getTitre(), PDO::PARAM_STR);
        $stmt->bindParam(2, $album->getAnnee(), PDO::PARAM_INT);
        $stmt->bindParam(3, $album->getGenre(), PDO::PARAM_STR);
        $stmt->bindParam(4, $album->getPochette(), PDO::PARAM_STR);
        $stmt->bindParam(5, $album->getArtisteId(), PDO::PARAM_INT);
        $stmt->execute();
    }

    // Ajoutez d'autres méthodes au besoin pour récupérer des albums, etc.
}

?>
