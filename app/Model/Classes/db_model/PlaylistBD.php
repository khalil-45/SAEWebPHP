<?php

namespace Model\Classes\db_model;

require_once __DIR__ . '/../Connection_BD.php';

use Model\Classes\Playlist;
use PDO;

class PlaylistBD
{
    private $cnx;

    public function __construct(PDO $cnx)
    {
        $this->cnx = $cnx;
    }

    public function insertPlaylist(Playlist $playlist)
    {
        $sql = "INSERT INTO PLAYLIST (user_id, titre) VALUES (?, ?)";
        $stmt = $this->cnx->prepare($sql);
        $stmt->bindParam(1, $playlist->getUserId(), PDO::PARAM_INT);
        $stmt->bindParam(2, $playlist->getTitre(), PDO::PARAM_STR);
        $stmt->execute();
    }

    public function getPlaylistById($id)
    {
        $sql = "SELECT * FROM PLAYLIST WHERE id = :id";
        $stmt = $this->cnx->prepare($sql);
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        $stmt->execute();
        $playlist = $stmt->fetch(PDO::FETCH_ASSOC);
        return $playlist;
    }

    public function getPlaylistByUserId($user_id)
    {
        $sql = "SELECT * FROM PLAYLIST WHERE user_id = :user_id";
        $stmt = $this->cnx->prepare($sql);
        $stmt->bindParam(1, $user_id, PDO::PARAM_INT);
        $stmt->execute();
        $playlist = $stmt->fetch(PDO::FETCH_ASSOC);
        return $playlist;
    }

    public function deletePlaylist($id)
    {
        $sql = "DELETE FROM PLAYLIST WHERE id = :id";
        $stmt = $this->cnx->prepare($sql);
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        $stmt->execute();
    }

}

?>
