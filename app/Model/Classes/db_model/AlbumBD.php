<?php

namespace Model\Classes\db_model;
require_once __DIR__ . '/../../Connection_BD.php';

use Classes\Album;
use PDO;

class AlbumBD
{
    private $cnx;

    public function __construct(PDO $cnx)
    {
        $this->cnx = $cnx;
    }

    public function insertAlbum($titre, $annee, $genre, $pochette, $artiste_id)
    {
        $sql = "INSERT INTO ALBUM (titre, annee, genre, pochette, artiste_id) VALUES (:titre, :annee, :genre, :pochette, :artiste_id)";
        $stmt = $this->cnx->prepare($sql);
        $stmt->bindParam(':titre', $titre, PDO::PARAM_STR);
        $stmt->bindParam(':annee', $annee, PDO::PARAM_INT);
        $stmt->bindParam(':genre', $genre, PDO::PARAM_STR);
        $stmt->bindParam(':pochette', $pochette, PDO::PARAM_STR);
        $stmt->bindParam(':artiste_id', $artiste_id, PDO::PARAM_INT);
        return $stmt->execute();
    }


    /**
     * @return array
     */
    public function getAllAlbums()
    {
        $sql = "SELECT * FROM ALBUM";
        $stmt = $this->cnx->query($sql);
        $albums = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $albums;
    }

    /**
     * @param int $id
     * @return array
     */
    public function getAlbumById($id)
    {
        $sql = "SELECT * FROM ALBUM WHERE album_id = :id";
        $stmt = $this->cnx->prepare($sql);
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        $stmt->execute();
        $album = $stmt->fetch(PDO::FETCH_ASSOC);
        return $album;
    }

    /**
     * @param int $id
     * @return array
     */
    public function getAlbumsByArtisteId($id)
    {
        $sql = "SELECT * FROM ALBUM WHERE artiste_id = :id";
        $stmt = $this->cnx->prepare($sql);
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        $stmt->execute();
        $albums = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $albums;
    }

    /**
     * @param string $genre
     * @return array
     */
    public function getAlbumsByGenre($genre)
    {
        $sql = "SELECT * FROM ALBUM WHERE genre = :genre";
        $stmt = $this->cnx->prepare($sql);
        $stmt->bindParam(1, $genre, PDO::PARAM_STR);
        $stmt->execute();
        $albums = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $albums;
    }

    /**
     * @param int $annee
     * @return array
     */
    public function getAlbumsByAnnee($annee)
    {
        $sql = "SELECT * FROM ALBUM WHERE annee = :annee";
        $stmt = $this->cnx->prepare($sql);
        $stmt->bindParam(1, $annee, PDO::PARAM_INT);
        $stmt->execute();
        $albums = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $albums;
    }

    /**
     * @param int $id
     * @param string genre
     * @return array
     */
    public function getAlbumsByArtisteIdAndGenre($id, $genre)
    {
        $sql = "SELECT * FROM ALBUM WHERE artiste_id = :id AND genre = :genre";
        $stmt = $this->cnx->prepare($sql);
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        $stmt->bindParam(2, $genre, PDO::PARAM_STR);
        $stmt->execute();
        $albums = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $albums;
    }

    /**
     * @param int $id
     */
    public function deleteAlbumById($id)
    {
        $sql = "DELETE FROM ALBUM WHERE id = :id";
        $stmt = $this->cnx->prepare($sql);
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    /**
     * @param int $id
     * @param int $annee
     */
    public function getAlbumsByArtisteIdAndAnnee($id, $annee)
    {
        $sql = "SELECT * FROM ALBUM WHERE artiste_id = :id AND annee = :annee";
        $stmt = $this->cnx->prepare($sql);
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        $stmt->bindParam(2, $annee, PDO::PARAM_INT);
        $stmt->execute();
        $albums = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $albums;
    }
}

?>
