<?php

namespace Model\Classes\db_model;

require_once __DIR__ . '/../Connection_BD.php';

use Model\Classes\Artiste;
use PDO;

class ArtisteBD
{
    private $cnx;

    public function __construct(PDO $cnx)
    {
        $this->cnx = $cnx;
    }

    public function insertArtiste(Artiste $artiste)
    {
        $sql = "INSERT INTO ARTISTE (nom, bio, photo) VALUES (?, ?, ?)";
        $stmt = $this->cnx->prepare($sql);
        $stmt->bindParam(1, $artiste->getNom(), PDO::PARAM_STR);
        $stmt->bindParam(2, $artiste->getBio(), PDO::PARAM_STR);
        $stmt->bindParam(3, $artiste->getPhoto(), PDO::PARAM_STR);
        $stmt->execute();
    }

    // Ajoutez d'autres méthodes au besoin pour récupérer des artistes, etc.
}

?>
