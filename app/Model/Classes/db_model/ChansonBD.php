<?php

namespace Model\Classes\db_model;

require_once __DIR__ . '/../Connection_BD.php';

use Model\Classes\Chanson;
use PDO;

class ChansonBD
{
    private $cnx;

    public function __construct(PDO $cnx)
    {
        $this->cnx = $cnx;
    }

    public function insertChanson(Chanson $chanson)
    {
        $sql = "INSERT INTO CHANSON (titre, duree, album_id) VALUES (?, ?, ?)";
        $stmt = $this->cnx->prepare($sql);
        $stmt->bindParam(1, $chanson->getTitre(), PDO::PARAM_STR);
        $stmt->bindParam(2, $chanson->getDuree(), PDO::PARAM_INT);
        $stmt->bindParam(3, $chanson->getAlbumId(), PDO::PARAM_INT);
        $stmt->execute();
    }

    public function getAllChansons(){
        $sql = "SELECT * FROM CHANSON";
        $stmt = $this->cnx->query($sql);
        $chansons = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $chansons;
    }

    public function getChansonsByAlbumId($id){
        $sql = "SELECT * FROM CHANSON WHERE album_id = :id";
        $stmt = $this->cnx->prepare($sql);
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        $stmt->execute();
        $chansons = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $chansons;
    }

    public function getChansonByAlbumTitre($titre){
        $sql = "SELECT * FROM CHANSON WHERE album_id = (SELECT id FROM ALBUM WHERE titre = :titre)";
        $stmt = $this->cnx->prepare($sql);
        $stmt->bindParam(1, $titre, PDO::PARAM_STR);
        $stmt->execute();
        $chansons = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $chansons;
    }


    public function getChansonById($id){
        $sql = "SELECT * FROM CHANSON WHERE id = :id";
        $stmt = $this->cnx->prepare($sql);
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        $stmt->execute();
        $chanson = $stmt->fetch(PDO::FETCH_ASSOC);
        return $chanson;
    }

    public function deleteChanson($id){
        $sql = "DELETE FROM CHANSON WHERE id = :id";
        $stmt = $this->cnx->prepare($sql);
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        $stmt->execute();
    }
}

?>
