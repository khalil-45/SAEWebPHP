<?php

namespace Model\Classes\db_model;


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

    public function getAllChansonPlaylist()
    {
        $sql = "SELECT * FROM CHANSON_PLAYLIST";
        $stmt = $this->cnx->query($sql);
        $chansonPlaylists = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $chansonPlaylist = new ChansonPlaylist($row['chanson_id'], $row['playlist_id']);
            $chansonPlaylists[] = $chansonPlaylist;
        }
        return $chansonPlaylists;
    }

    public function getAllChansonsPlaylistByUserId($user_id)
    {
        $sql = "SELECT * FROM CHANSON_PLAYLIST WHERE user_id = :user_id";
        $stmt = $this->cnx->prepare($sql);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        $chansonsPlaylist = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $chansonPlaylist = new ChansonPlaylist($row['chanson_id'], $row['playlist_id']);
            $chansonsPlaylist[] = $chansonPlaylist;
        }
        return $chansonsPlaylist;
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

    public function getAllChansonsPlaylistByPlaylistId($playlist_id)
    {
        $sql = "SELECT * FROM CHANSON_PLAYLIST WHERE playlist_id = :playlist_id";
        $stmt = $this->cnx->prepare($sql);
        $stmt->bindParam(':playlist_id', $playlist_id, PDO::PARAM_INT);
        $stmt->execute();
        $chansonsPlaylist = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $chansonPlaylist = new ChansonPlaylist($row['chanson_id'], $row['playlist_id']);
            $chansonsPlaylist[] = $chansonPlaylist;
        }
        return $chansonsPlaylist;
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

    public function isChansonInPlaylist($chanson_id, $playlist_id)
{
    $sql = "SELECT * FROM CHANSON_PLAYLIST WHERE chanson_id = :chanson_id AND playlist_id = :playlist_id";
    $stmt = $this->cnx->prepare($sql);
    $stmt->bindParam(':chanson_id', $chanson_id, PDO::PARAM_INT);
    $stmt->bindParam(':playlist_id', $playlist_id, PDO::PARAM_INT);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row ? true : false;
}

}
?>
