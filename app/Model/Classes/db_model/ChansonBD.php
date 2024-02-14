<?php

namespace Model\Classes\db_model;

require_once __DIR__ . '/../../Connection_BD.php';

use Classes\Chanson;
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
    public function getAllChansons(){
        $sql = "SELECT * FROM CHANSON";
        $stmt = $this->cnx->query($sql);
        $chansons = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $chansons;
    }

    /**
     * @param int $id
     * @return array
     */
    public function getChansonsByAlbumId($id){
        $sql = "SELECT * FROM CHANSON WHERE album_id = :id";
        $stmt = $this->cnx->prepare($sql);
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        $stmt->execute();
        $chansons = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $chansons;
    }

    /**
     * @param string $titre
     * @return array
     */
    public function getChansonByAlbumTitre($titre){
        $sql = "SELECT * FROM CHANSON WHERE album_id = (SELECT id FROM ALBUM WHERE titre = :titre)";
        $stmt = $this->cnx->prepare($sql);
        $stmt->bindParam(1, $titre, PDO::PARAM_STR);
        $stmt->execute();
        $chansons = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $chansons;
    }

    /**
     * @param int $id
     * @return array
     */
    public function getChansonById($id){
        $sql = "SELECT * FROM CHANSON WHERE id = :id";
        $stmt = $this->cnx->prepare($sql);
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        $stmt->execute();
        $chanson = $stmt->fetch(PDO::FETCH_ASSOC);
        return $chanson;
    }

    /**
     * @param int $id
     */
    public function deleteChanson($id){
        $sql = "DELETE FROM CHANSON WHERE id = :id";
        $stmt = $this->cnx->prepare($sql);
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        $stmt->execute();
    }
}

?>
