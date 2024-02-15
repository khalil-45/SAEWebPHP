<?php

namespace Model\Classes\db_model;

require_once __DIR__ . '/../../Connection_BD.php';

use Classes\Artiste;
use PDO;

class ArtisteBD
{
    private $cnx;

    public function __construct(PDO $cnx)
    {
        $this->cnx = $cnx;
    }

    /**
     * @param string $nom
     * @param string $bio
     * @param string $photo
     * @return bool
     */
    public function insertArtiste($nom, $bio, $photo)
    {
        $sql = "INSERT INTO ARTISTE (nom, bio, photo) VALUES (:nom, :bio, :photo)";
        $stmt = $this->cnx->prepare($sql);
        $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
        $stmt->bindParam(':bio', $bio, PDO::PARAM_STR);
        $stmt->bindParam(':photo', $photo, PDO::PARAM_STR);
        return $stmt->execute();
    }

    /**
     * @param int $id
     * @return array
     */
    public function getArtisteById($id)
    {
        $sql = "SELECT * FROM ARTISTE WHERE artiste_id = :id";
        $stmt = $this->cnx->prepare($sql);
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        $stmt->execute();
        $artiste = $stmt->fetch(PDO::FETCH_ASSOC);
        return $artiste;
    }

    /**
     * @return array
     */
    public function getAllArtistes()
    {
        $sql = "SELECT * FROM ARTISTE";
        $stmt = $this->cnx->query($sql);
        $artistes = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $artistes;
    }

    /**
     * @param string $nom
     * @return array
     */
    public function getArtisteByNom($nom)
    {
        $sql = "SELECT * FROM ARTISTE WHERE nom = :nom";
        $stmt = $this->cnx->prepare($sql);
        $stmt->bindParam(1, $nom, PDO::PARAM_STR);
        $stmt->execute();
        $artiste = $stmt->fetch(PDO::FETCH_ASSOC);
        return $artiste;
    }

    public function deleteArtisteById($id)
    {
        $sql = "DELETE FROM ARTISTE WHERE artiste_id = :id";
        $stmt = $this->cnx->prepare($sql);
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function updateArtiste($id, $nom, $bio, $photo)
    {
        $sql = "UPDATE ARTISTE SET nom = :nom, bio = :bio, photo = :photo WHERE artiste_id = :id";
        $stmt = $this->cnx->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
        $stmt->bindParam(':bio', $bio, PDO::PARAM_STR);
        $stmt->bindParam(':photo', $photo, PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function getMaximumId()
    {
        $sql = "SELECT MAX(artiste_id) FROM ARTISTE";
        $stmt = $this->cnx->query($sql);
        $maxID = $stmt->fetchColumn();
        return $maxID;
    }

}

?>
