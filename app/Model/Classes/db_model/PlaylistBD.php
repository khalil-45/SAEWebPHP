<?php

namespace Model\Classes\db_model;


use Model\Classes\Playlist;
use PDO;

class PlaylistBD
{
    private $cnx;

    public function __construct(PDO $cnx)
    {
        $this->cnx = $cnx;
    }

    public function insertPlaylist($user_id, $titre)
    {
        $sql = "INSERT INTO PLAYLIST (user_id, titre) VALUES (:user_id, :titre)";
        $stmt = $this->cnx->prepare($sql);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindParam(':titre', $titre, PDO::PARAM_STR);
        return $stmt->execute();
    }


    /**
     * @param int $id
     * @return Playlist|null
     */
    public function getPlaylistById($id)
    {
        $sql = "SELECT * FROM PLAYLIST WHERE playlist_id = :id";
        $stmt = $this->cnx->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return new Playlist($row['playlist_id'], $row['user_id'], $row['titre']);
        }
        return null;
    }

    public function getAllPlaylistsByUserId($user_id)
    {
        $sql = "SELECT * FROM PLAYLIST WHERE user_id = :user_id";
        $stmt = $this->cnx->prepare($sql);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        $playlists = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $playlist = new Playlist($row['playlist_id'], $row['user_id'], $row['titre']);
            $playlists[] = $playlist;
        }
        return $playlists;
    }

    /**
     * @param int $user_id
     * @return Playlist|null
     */
    public function getPlaylistByUserId($user_id)
    {
        $sql = "SELECT * FROM PLAYLIST WHERE user_id = :user_id";
        $stmt = $this->cnx->prepare($sql);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return new Playlist($row['playlist_id'], $row['user_id'], $row['titre']);
        }
        return null;
    }

    public function deletePlaylist($id)
    {
        $sql = "DELETE FROM PLAYLIST WHERE playlist_id = :id";
        $stmt = $this->cnx->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function updatePlaylist($id, $titre)
    {
        $sql = "UPDATE PLAYLIST SET titre = :titre WHERE playlist_id = :id";
        $stmt = $this->cnx->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':titre', $titre, PDO::PARAM_STR);
        $stmt->execute();
    }

    public function getUserId($id)
    {
        $sql = "SELECT user_id FROM PLAYLIST WHERE playlist_id = :id";
        $stmt = $this->cnx->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['user_id'];
    }
}

?>