<?php

namespace Model\Classes\db_model;

require_once __DIR__ . '/../../Connection_BD.php';

use Model\Classes\Genre;
use PDO;

class GenreBD
{
    private $cnx;

    public function __construct(PDO $cnx)
    {
        $this->cnx = $cnx;
    }

    /**
     * @param string $nom_genre
     * @return bool
     */
    public function insertGenre($nom_genre)
    {
        $sql = "INSERT INTO GENRE (nom_genre) VALUES (:nom_genre)";
        $stmt = $this->cnx->prepare($sql);
        $stmt->bindParam(':nom_genre', $nom_genre, PDO::PARAM_STR);
        return $stmt->execute();
    }

    /**
     * @param int $id
     * @return Genre|null
     */
    public function getGenreById($id)
    {
        $sql = "SELECT * FROM GENRE WHERE id_genre = :id";
        $stmt = $this->cnx->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return new Genre($row['id_genre'], $row['nom_genre']);
        }
        return null;
    }

    /**
     * @return array
     */
    public function getAllGenres()
    {
        $sql = "SELECT * FROM GENRE";
        $stmt = $this->cnx->query($sql);
        $genres = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $genre = new Genre($row['id_genre'], $row['nom_genre']);
            $genres[] = $genre;
        }
        return $genres;
    }

    /**
     * @param string $nom_genre
     * @return Genre|null
     */
    public function getGenreByNom($nom_genre)
    {
        $sql = "SELECT * FROM GENRE WHERE nom_genre = :nom_genre";
        $stmt = $this->cnx->prepare($sql);
        $stmt->bindParam(':nom_genre', $nom_genre, PDO::PARAM_STR);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return new Genre($row['id_genre'], $row['nom_genre']);
        }
        return null;
    }

    /**
     * @param int $album_id
     * @return array
     */
    public function getGenresByAlbum($album_id)
    {
        $sql = "SELECT * FROM ALBUM_GENRE WHERE album_id = :album_id";
        $stmt = $this->cnx->prepare($sql);
        $stmt->bindParam(':album_id', $album_id, PDO::PARAM_INT);
        $stmt->execute();
        $genres = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $genre = new Genre($row['id_genre'], $row['nom_genre']);
            $genres[] = $genre;
        }
        return $genres;
    }

    /**
     * @param int $id
     */
    public function deleteGenre($id)
    {
        $sql = "DELETE FROM GENRE WHERE id_genre = :id";
        $stmt = $this->cnx->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    /**
     * @param int $id
     */
    public function updateGenre($id, $nom_genre)
    {
        $sql = "UPDATE GENRE SET nom_genre = :nom_genre WHERE id_genre = :id";
        $stmt = $this->cnx->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':nom_genre', $nom_genre, PDO::PARAM_STR);
        $stmt->execute();
    }
}

?>
