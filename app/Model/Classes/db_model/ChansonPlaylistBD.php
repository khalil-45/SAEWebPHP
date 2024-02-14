<?php

namespace Model\Classes\db_model;

require_once __DIR__ . '/../Connection_BD.php';
require_once __DIR__ . '/../ChansonPlaylist.php';

use Model\Classes\ChansonPlaylist;
use PDO;

class ChansonPlaylistBD
{
    private $cnx;

    public function __construct(PDO $cnx)
    {
        $this->cnx = $cnx;
    }

    public function insertChansonPlaylist($chanson_id, $playlist_id)
    {
        $sql = "INSERT INTO CHANSON_PLAYLIST (chanson_id, playlist_id) VALUES (:chanson_id, :playlist_id)";
        $stmt = $this->cnx->prepare($sql);
        $stmt->bindParam(':chanson_id', $chanson_id, PDO::PARAM_INT);
        $stmt->bindParam(':playlist_id', $playlist_id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function getChansonPlaylistByPlaylistId($playlist_id)
    {
        $sql = "SELECT * FROM CHANSON_PLAYLIST WHERE playlist_id = :playlist_id";
        $stmt = $this->cnx->prepare($sql);
        $stmt->bindParam(':playlist_id', $playlist_id, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return new ChansonPlaylist($row['chanson_id'], $row['playlist_id']);
        }
        return null;
    }

    public function getChansonPlaylistByChansonId($chanson_id)
    {
        $sql = "SELECT * FROM CHANSON_PLAYLIST WHERE chanson_id = :chanson_id";
        $stmt = $this->cnx->prepare($sql);
        $stmt->bindParam(':chanson_id', $chanson_id, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return new ChansonPlaylist($row['chanson_id'], $row['playlist_id']);
        }
        return null;
    }


}
?>
