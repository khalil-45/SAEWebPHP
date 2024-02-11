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

    public function getArtisteById($id)
    {
        $sql = "SELECT * FROM ARTISTE WHERE id = :id";
        $stmt = $this->cnx->prepare($sql);
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        $stmt->execute();
        $artiste = $stmt->fetch(PDO::FETCH_ASSOC);
        return $artiste;
    }

    public function getAllArtistes()
    {
        $sql = "SELECT * FROM ARTISTE";
        $stmt = $this->cnx->query($sql);
        $artistes = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $artistes;
    }

    public function getArtisteByNom($nom)
    {
        $sql = "SELECT * FROM ARTISTE WHERE nom = :nom";
        $stmt = $this->cnx->prepare($sql);
        $stmt->bindParam(1, $nom, PDO::PARAM_STR);
        $stmt->execute();
        $artiste = $stmt->fetch(PDO::FETCH_ASSOC);
        return $artiste;
    }

    public function deleteArtiste($id)
    {
        $sql = "DELETE FROM ARTISTE WHERE id = :id";
        $stmt = $this->cnx->prepare($sql);
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        $stmt->execute();
    }

}

?>
