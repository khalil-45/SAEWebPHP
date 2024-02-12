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

    /**
     * @param int $album_id
     * @param int $id_genre
     * @return bool
     */
    public function insertAlbumGenre($album_id, $id_genre)
    {
        $sql = "INSERT INTO ALBUM_GENRE (album_id, id_genre) VALUES (:album_id, :id_genre)";
        $stmt = $this->cnx->prepare($sql);
        $stmt->bindParam(':album_id', $album_id, PDO::PARAM_INT);
        $stmt->bindParam(':id_genre', $id_genre, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->execute();
    }

    /**
     * @return array
     */
    public function getAllAlbumsGenres()
    {
        $sql = "SELECT * FROM ALBUM_GENRE";
        $stmt = $this->cnx->query($sql);
        $albumsGenres = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $albumsGenres;
    }

    /**
     * @param int $id_genre
     * @return array
     */
    public function getAlbumsByGenre($id_genre)
    {
        $sql = "SELECT * FROM ALBUM_GENRE WHERE id_genre = :id_genre";
        $stmt = $this->cnx->prepare($sql);
        $stmt->bindParam(1, $id_genre, PDO::PARAM_INT);
        $stmt->execute();
        $albums = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $albums;
    }

    /**
     * @param int $album_id
     * @return array
     */
    public function getGenresByAlbum($album_id)
    {
        $sql = "SELECT * FROM ALBUM_GENRE WHERE album_id = :album_id";
        $stmt = $this->cnx->prepare($sql);
        $stmt->bindParam(1, $album_id, PDO::PARAM_INT);
        $stmt->execute();
        $genres = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $genres;
    }

    /**
     * @param int $album_id
     * @param int $id_genre
     */
    public function deleteAlbumGenre($album_id, $id_genre)
    {
        $sql = "DELETE FROM ALBUM_GENRE WHERE album_id = :album_id AND id_genre = :id_genre";
        $stmt = $this->cnx->prepare($sql);
        $stmt->bindParam(1, $album_id, PDO::PARAM_INT);
        $stmt->bindParam(2, $id_genre, PDO::PARAM_INT);
        $stmt->execute();
    }

}

?>
