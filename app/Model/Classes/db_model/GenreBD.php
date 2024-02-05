<?php

namespace Model\Classes\db_model;

require_once __DIR__ . '/../Connection_BD.php';

use Model\Classes\Genre;
use PDO;

class GenreBD
{
    private $cnx;

    public function __construct(PDO $cnx)
    {
        $this->cnx = $cnx;
    }

    public function insertGenre(Genre $genre)
    {
        $sql = "INSERT INTO GENRE (nom_genre) VALUES (?)";
        $stmt = $this->cnx->prepare($sql);
        $stmt->bindParam(1, $genre->getNomGenre(), PDO::PARAM_STR);
        $stmt->execute();
    }

    public function getGenreById($id)
    {
        $sql = "SELECT * FROM GENRE WHERE id = ?";
        $stmt = $this->cnx->prepare($sql);
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        $stmt->execute();
        $genre = $stmt->fetch(PDO::FETCH_ASSOC);
        return $genre;
    }

    public function getAllGenres()
    {
        $sql = "SELECT * FROM GENRE";
        $stmt = $this->cnx->query($sql);
        $genres = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $genres;
    }

    public function getGenreByNom($nom_genre)
    {
        $sql = "SELECT * FROM GENRE WHERE nom_genre = ?";
        $stmt = $this->cnx->prepare($sql);
        $stmt->bindParam(1, $nom_genre, PDO::PARAM_STR);
        $stmt->execute();
        $genre = $stmt->fetch(PDO::FETCH_ASSOC);
        return $genre;
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

    public function deleteGenre($id)
    {
        $sql = "DELETE FROM GENRE WHERE id = ?";
        $stmt = $this->cnx->prepare($sql);
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        $stmt->execute();
    }

}

?>
