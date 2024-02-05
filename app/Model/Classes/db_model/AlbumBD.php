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


    public function getAllAlbums()
    {
        $sql = "SELECT * FROM ALBUM";
        $stmt = $this->cnx->query($sql);
        $albums = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $albums;
    }

    public function getAlbumById($id)
    {
        $sql = "SELECT * FROM ALBUM WHERE id = ?";
        $stmt = $this->cnx->prepare($sql);
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        $stmt->execute();
        $album = $stmt->fetch(PDO::FETCH_ASSOC);
        return $album;
    }

    public function getAlbumsByArtisteId($id)
    {
        $sql = "SELECT * FROM ALBUM WHERE artiste_id = ?";
        $stmt = $this->cnx->prepare($sql);
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        $stmt->execute();
        $albums = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $albums;
    }

    public function getAlbumsByGenre($genre)
    {
        $sql = "SELECT * FROM ALBUM WHERE genre = ?";
        $stmt = $this->cnx->prepare($sql);
        $stmt->bindParam(1, $genre, PDO::PARAM_STR);
        $stmt->execute();
        $albums = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $albums;
    }

    public function getAlbumsByAnnee($annee)
    {
        $sql = "SELECT * FROM ALBUM WHERE annee = ?";
        $stmt = $this->cnx->prepare($sql);
        $stmt->bindParam(1, $annee, PDO::PARAM_INT);
        $stmt->execute();
        $albums = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $albums;
    }

    public function getAlbumsByArtisteIdAndGenre($id, $genre)
    {
        $sql = "SELECT * FROM ALBUM WHERE artiste_id = ? AND genre = ?";
        $stmt = $this->cnx->prepare($sql);
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        $stmt->bindParam(2, $genre, PDO::PARAM_STR);
        $stmt->execute();
        $albums = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $albums;
    }

    public function deleteAlbumById($id)
    {
        $sql = "DELETE FROM ALBUM WHERE id = ?";
        $stmt = $this->cnx->prepare($sql);
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    
    public function getAlbumsByArtisteIdAndAnnee($id, $annee)
    {
        $sql = "SELECT * FROM ALBUM WHERE artiste_id = ? AND annee = ?";
        $stmt = $this->cnx->prepare($sql);
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        $stmt->bindParam(2, $annee, PDO::PARAM_INT);
        $stmt->execute();
        $albums = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $albums;
    }
}

?>
