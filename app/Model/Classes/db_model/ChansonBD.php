<?php

namespace Model\Classes\db_model;

require_once __DIR__ . '/../Connection_BD.php';

use Model\Classes\Chanson;
use PDO;

class ChansonBD
{
    private $cnx;

    public function __construct(PDO $cnx)
    {
        $this->cnx = $cnx;
    }

    public function insertChanson(Chanson $chanson)
    {
        $sql = "INSERT INTO CHANSON (titre, duree, album_id) VALUES (?, ?, ?)";
        $stmt = $this->cnx->prepare($sql);
        $stmt->bindParam(1, $chanson->getTitre(), PDO::PARAM_STR);
        $stmt->bindParam(2, $chanson->getDuree(), PDO::PARAM_INT);
        $stmt->bindParam(3, $chanson->getAlbumId(), PDO::PARAM_INT);
        $stmt->execute();
    }

    // Ajoutez d'autres méthodes au besoin pour récupérer des chansons, etc.
}

?>
