<?php

namespace Model\Classes\db_model;

require_once __DIR__ . '/../../Connection_BD.php';
require_once __DIR__ . '/../../Classes/Artiste.php'; // Ajout de l'inclusion de la classe Artiste

use Model\Classes\Artiste; // Ajout de l'inclusion de la classe Artiste
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
     * @return Artiste|null
     */
    public function getArtisteById($id)
    {
        $sql = "SELECT * FROM ARTISTE WHERE artiste_id = :id";
        $stmt = $this->cnx->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return new Artiste($row['artiste_id'], $row['nom'], $row['bio'], $row['photo']);
        }
        return null;
    }

    /**
     * @return array
     */
    public function getAllArtistes()
    {
        $sql = "SELECT * FROM ARTISTE";
        $stmt = $this->cnx->query($sql);
        $artistes = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $artiste = new Artiste($row['artiste_id'], $row['nom'], $row['bio'], $row['photo']);
            $artistes[] = $artiste;
        }
        return $artistes;
    }

    /**
     * @param string $nom
     * @return Artiste|null
     */
    public function getArtisteByNom($nom)
    {
        $sql = "SELECT * FROM ARTISTE WHERE nom = :nom";
        $stmt = $this->cnx->prepare($sql);
        $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return new Artiste($row['artiste_id'], $row['nom'], $row['bio'], $row['photo']);
        }
        return null;
    }

    public function deleteArtisteById($id)
    {
        $sql = "DELETE FROM ARTISTE WHERE artiste_id = :id";
        $stmt = $this->cnx->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function updateArtiste($id, $nom, $bio, $photo)
    {
        $sql = "UPDATE IMAGE_ARTISTE SET nom_image = :photo WHERE artiste_id = :id";
        $stmt = $this->cnx->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':photo', $photo, PDO::PARAM_STR);
        $stmt->execute();
        
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

    public function searchArtiste($nom)
    {
        $sql = "SELECT * FROM ARTISTE WHERE nom LIKE :nom";
        $stmt = $this->cnx->prepare($sql);
        $stmt->bindValue(':nom', '%' . $nom . '%', PDO::PARAM_STR);
        $stmt->execute();
        $artistes = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $artiste = new Artiste($row['artiste_id'], $row['nom'], $row['bio'], $row['photo']);
            $artistes[] = $artiste;
        }
        return $artistes;
    }

}

?>
