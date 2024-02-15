<?php

namespace Model\Classes\db_model;

require_once __DIR__ . '/../../Connection_BD.php';

use Model\Classes\Chanson;
use PDO;

class ChansonBD
{
    private $cnx;

    public function __construct(PDO $cnx)
    {
        $this->cnx = $cnx;
    }

    /**
     * @param string $titre
     * @param int $duree
     * @param int $album_id
     * @return bool
     */
    public function insertChanson($titre, $duree, $album_id)
    {
        $sql = "INSERT INTO CHANSON (titre, duree, album_id) VALUES (:titre, :duree, :album_id)";
        $stmt = $this->cnx->prepare($sql);
        $stmt->bindParam(':titre', $titre, PDO::PARAM_STR);
        $stmt->bindParam(':duree', $duree, PDO::PARAM_INT);
        $stmt->bindParam(':album_id', $album_id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    /**
     * @return array
     */
    public function getAllChansons()
    {
        $sql = "SELECT * FROM CHANSON";
        $stmt = $this->cnx->query($sql);
        $chansons = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $chanson = new Chanson($row['id'], $row['titre'], $row['duree'], $row['album_id']);
            $chansons[] = $chanson;
        }
        return $chansons;
    }

    /**
     * @param int $id
     * @return array
     */
    public function getChansonsByAlbumId($id)
    {
        $sql = "SELECT * FROM CHANSON WHERE album_id = :id";
        $stmt = $this->cnx->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $chansons = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $chanson = new Chanson($row['chanson_id'], $row['titre'], $row['duree'], $row['album_id']);
            $chansons[] = $chanson;
        }
        return $chansons;
    }

    /**
     * @param string $titre
     * @return array
     */
    public function getChansonByAlbumTitre($titre)
    {
        $sql = "SELECT * FROM CHANSON WHERE album_id = (SELECT id FROM ALBUM WHERE titre = :titre)";
        $stmt = $this->cnx->prepare($sql);
        $stmt->bindParam(':titre', $titre, PDO::PARAM_STR);
        $stmt->execute();
        $chansons = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $chanson = new Chanson($row['album_id'], $row['titre'], $row['duree'], $row['album_id']);
            $chansons[] = $chanson;
        }
        return $chansons;
    }

    /**
     * @param int $id
     * @return Chanson|null
     */
    public function getChansonById($id)
    {
        $sql = "SELECT * FROM CHANSON WHERE chanson_id = :id";
        $stmt = $this->cnx->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return new Chanson($row['chanson_id'], $row['titre'], $row['duree'], $row['album_id']);
        }
        return null;
    }

    /**
     * @param string $titre
     * @return Chanson|null
     */

    public function getChansonByTitre($titre)
    {
        $sql = "SELECT * FROM CHANSON WHERE titre = :titre";
        $stmt = $this->cnx->prepare($sql);
        $stmt->bindParam(':titre', $titre, PDO::PARAM_STR);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return new Chanson($row['id'], $row['titre'], $row['duree'], $row['album_id']);
        }
        return null;
    }

    /**
     * @param int $id
     */
    public function deleteChanson($id)
    {
        $sql = "DELETE FROM CHANSON WHERE id = :id";
        $stmt = $this->cnx->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }
}

?>
