<?php

namespace Model\Classes\db_model;

require_once __DIR__ . '/../../Connection_BD.php';
require_once __DIR__ . '/../../Classes/ImageArtiste.php';

use Model\Classes\ImageArtiste;
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

    /**
     * @param int $id
     * @return ImageArtiste|null
     */
    public function getImageArtisteById($id)
    {
        $sql = "SELECT * FROM IMAGE_ARTISTE WHERE artiste_id = ?";
        $stmt = $this->cnx->prepare($sql);
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return new ImageArtiste($row['id'], $row['id_artiste'], $row['id_image']);
        }
        return null;
    }

    /**
     * @return array
     */
    public function getAllImagesArtiste()
    {
        $sql = "SELECT * FROM IMAGE_ARTISTE";
        $stmt = $this->cnx->query($sql);
        $imagesArtiste = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $imageArtiste = new ImageArtiste($row['id'], $row['id_artiste'], $row['id_image']);
            $imagesArtiste[] = $imageArtiste;
        }
        return $imagesArtiste;
    }

    /**
     * @param int $id_artiste
     * @return array
     */
    public function getImagesArtisteByIdArtiste($id_artiste)
    {
        $sql = "SELECT * FROM IMAGE_ARTISTE WHERE id_artiste = ?";
        $stmt = $this->cnx->prepare($sql);
        $stmt->bindParam(1, $id_artiste, PDO::PARAM_INT);
        $stmt->execute();
        $imagesArtiste = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $imageArtiste = new ImageArtiste($row['id'], $row['id_artiste'], $row['id_image']);
            $imagesArtiste[] = $imageArtiste;
        }
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

?>
