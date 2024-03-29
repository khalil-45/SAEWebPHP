<?php

namespace Model\Classes\db_model;
require_once __DIR__ . '/../../Connection_BD.php';

use Model\Classes\Album;
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
     * 
     */
    public function getAllAlbums(){
        $sql = "SELECT * FROM ALBUM";
        $stmt = $this->cnx->query($sql);
        $albums = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $album = new Album($row['album_id'], $row['titre'], $row['annee'], $row['genre'], $row['pochette'], $row['artiste_id']);
            $albums[] = $album;
        }
        return $albums;
    } 

    public function getAlbums($items_per_page, $offset) {
        $sql = "SELECT * FROM ALBUM LIMIT :items_per_page OFFSET :offset";
        $stmt = $this->cnx->prepare($sql);
        $stmt->bindParam(':items_per_page', $items_per_page, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $album = new Album($row['album_id'], $row['titre'], $row['annee'], $row['genre'], $row['pochette'], $row['artiste_id']);
            $albums[] = $album;
        }
        return $albums;
    }

    public function getTotalAlbums(){
        $sql = "SELECT COUNT(*) FROM ALBUM";
        $stmt = $this->cnx->query($sql);
        return $stmt->fetchColumn();
    }

/**
     * @param int $id
     * @return Album | null
     */
    public function getAlbumById($id){
        $sql = "SELECT * FROM ALBUM WHERE album_id = :id";
        $stmt = $this->cnx->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return new Album($row['album_id'], $row['titre'], $row['annee'], $row['genre'], $row['pochette'], $row['artiste_id']);
        }
        return null;
    }

        /**
     * @param int $id
     * @return array
     */
    public function getAlbumsByArtisteId($id)
    {
        $sql = "SELECT * FROM ALBUM WHERE artiste_id = :id";
        $stmt = $this->cnx->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $albums = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $album = new Album($row['album_id'], $row['titre'], $row['annee'], $row['genre'], $row['pochette'], $row['artiste_id']);
            $albums[] = $album;
        }
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
        $stmt->bindParam(':genre', $genre, PDO::PARAM_STR);
        $stmt->execute();
        $albums = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $album = new Album($row['album_id'], $row['titre'], $row['annee'], $row['genre'], $row['pochette'], $row['artiste_id']);
            $albums[] = $album;
        }
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
        $stmt->bindParam(':annee', $annee, PDO::PARAM_INT);
        $stmt->execute();
        $albums = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $album = new Album($row['album_id'], $row['titre'], $row['annee'], $row['genre'], $row['pochette'], $row['artiste_id']);
            $albums[] = $album;
        }
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
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':genre', $genre, PDO::PARAM_STR);
        $stmt->execute();
        $albums = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $album = new Album($row['album_id'], $row['titre'], $row['annee'], $row['genre'], $row['pochette'], $row['artiste_id']);
            $albums[] = $album;
        }
        return $albums;
    }

    /**
     * @param int $id
     */
    public function deleteAlbumById($id)
    {
        $sql = "DELETE FROM ALBUM WHERE album_id = :id";
        $stmt = $this->cnx->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
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
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':annee', $annee, PDO::PARAM_INT);
        $stmt->execute();
        $albums = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $album = new Album($row['album_id'], $row['titre'], $row['annee'], $row['genre'], $row['pochette'], $row['artiste_id']);
            $albums[] = $album;
        }
        return $albums;
    }

    public function updateAlbum($id, $titre, $annee, $genre, $pochette, $artiste_id)
    {
        $sql = "UPDATE ALBUM SET titre = :titre, annee = :annee, genre = :genre, pochette = :pochette, artiste_id = :artiste_id WHERE album_id = :id";
        $stmt = $this->cnx->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':titre', $titre, PDO::PARAM_STR);
        $stmt->bindParam(':annee', $annee, PDO::PARAM_INT);
        $stmt->bindParam(':genre', $genre, PDO::PARAM_STR);
        $stmt->bindParam(':pochette', $pochette, PDO::PARAM_STR);
        $stmt->bindParam(':artiste_id', $artiste_id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function searchAlbums($query) {
    $sql = "SELECT * FROM ALBUM WHERE titre LIKE :query OR genre LIKE :query OR annee = :annee";
    $stmt = $this->cnx->prepare($sql);
    $query = "%$query%";
    $stmt->bindParam(':query', $query, PDO::PARAM_STR);
    $stmt->bindParam(':annee', $annee, PDO::PARAM_INT);
    $stmt->execute();
    $albums = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $album = new Album($row['album_id'], $row['titre'], $row['annee'], $row['genre'], $row['pochette'], $row['artiste_id']);
        $albums[] = $album;
    }
    return $albums;
}

public function searchAlbumsByAnnee($annee) {
    $sql = "SELECT * FROM ALBUM WHERE annee = :annee";
    $stmt = $this->cnx->prepare($sql);
    $stmt->bindParam(':annee', $annee, PDO::PARAM_INT);
    $stmt->execute();
    $albums = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $album = new Album($row['album_id'], $row['titre'], $row['annee'], $row['genre'], $row['pochette'], $row['artiste_id']);
        $albums[] = $album;
    }
    return $albums;
    
}
}



?>
