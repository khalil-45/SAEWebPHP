<?php

namespace Model\Classes\db_model;

require_once __DIR__ . '/../../Connection_BD.php';

use Model\Classes\Genre;
use PDO;

class ImageArtisteBD
{
    private $cnx;

    public function __construct(PDO $cnx)
    {
        $this->cnx = $cnx;
    }

    public function insertImageArtiste($id_artiste, $image)
    {
        $maxID = $this->cnx->query("SELECT MAX(image_id) FROM IMAGE_ARTISTE")->fetchColumn();
        $maxID++;

        $sql = "INSERT INTO IMAGE_ARTISTE (image_id, artiste_id, nom_image) VALUES (:id, :artiste_id, :image)";
        $stmt = $this->cnx->prepare($sql);
        $stmt->bindParam(':id', $maxID, PDO::PARAM_INT);
        $stmt->bindParam(':artiste_id', $id_artiste, PDO::PARAM_INT);
        $stmt->bindParam(':image', $image, PDO::PARAM_STR);
        return $stmt->execute();

    }

    public function getImageArtisteById($id)
    {
        $sql = "SELECT * FROM IMAGE_ARTISTE WHERE artiste_id = ?";
        $stmt = $this->cnx->prepare($sql);
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        $stmt->execute();
        $imageArtiste = $stmt->fetch(PDO::FETCH_ASSOC);
        return $imageArtiste;
    }

    public function getAllImagesArtiste()
    {
        $sql = "SELECT * FROM IMAGE_ARTISTE";
        $stmt = $this->cnx->query($sql);
        $imagesArtiste = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $imagesArtiste;
    }

    public function getImagesArtisteByIdArtiste($id_artiste)
    {
        $sql = "SELECT * FROM IMAGE_ARTISTE WHERE id_artiste = ?";
        $stmt = $this->cnx->prepare($sql);
        $stmt->bindParam(1, $id_artiste, PDO::PARAM_INT);
        $stmt->execute();
        $imagesArtiste = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $imagesArtiste;
    }

    public function deleteImageArtiste($id)
    {
        $sql = "DELETE FROM IMAGE_ARTISTE WHERE id = ?";
        $stmt = $this->cnx->prepare($sql);
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        $stmt->execute();
    }
}