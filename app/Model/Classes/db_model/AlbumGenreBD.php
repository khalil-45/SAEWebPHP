<?php

namespace Model\Classes\db_model;

require_once __DIR__ . '/../Connection_BD.php';

use Model\Classes\AlbumGenre;
use PDO;

class AlbumGenreBD
{
    private $cnx;

    public function __construct(PDO $cnx)
    {
        $this->cnx = $cnx;
    }

    public function insertAlbumGenre(AlbumGenre $albumGenre)
    {
        $sql = "INSERT INTO ALBUM_GENRE (album_id, id_genre) VALUES (?, ?)";
        $stmt = $this->cnx->prepare($sql);
        $stmt->bindParam(1, $albumGenre->getAlbumId(), PDO::PARAM_INT);
        $stmt->bindParam(2, $albumGenre->getIdGenre(), PDO::PARAM_INT);
        $stmt->execute();
    }

    public function getAllAlbumsGenres()
    {
        $sql = "SELECT * FROM ALBUM_GENRE";
        $stmt = $this->cnx->query($sql);
        $albumsGenres = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $albumsGenres;
    }

    public function getAlbumsByGenre($id_genre)
    {
        $sql = "SELECT * FROM ALBUM_GENRE WHERE id_genre = ?";
        $stmt = $this->cnx->prepare($sql);
        $stmt->bindParam(1, $id_genre, PDO::PARAM_INT);
        $stmt->execute();
        $albums = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $albums;
    }

    public function getGenresByAlbum($album_id)
    {
        $sql = "SELECT * FROM ALBUM_GENRE WHERE album_id = ?";
        $stmt = $this->cnx->prepare($sql);
        $stmt->bindParam(1, $album_id, PDO::PARAM_INT);
        $stmt->execute();
        $genres = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $genres;
    }

    public function deleteAlbumGenre($album_id, $id_genre)
    {
        $sql = "DELETE FROM ALBUM_GENRE WHERE album_id = ? AND id_genre = ?";
        $stmt = $this->cnx->prepare($sql);
        $stmt->bindParam(1, $album_id, PDO::PARAM_INT);
        $stmt->bindParam(2, $id_genre, PDO::PARAM_INT);
        $stmt->execute();
    }

}

?>
