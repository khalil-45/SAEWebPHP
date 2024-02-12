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

    /**
     * @param int $user_id
     * @param string $titre
     * @return bool
     */
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
     * @return array
     */
    public function getPlaylistById($id)
    {
        $sql = "SELECT * FROM PLAYLIST WHERE id = :id";
        $stmt = $this->cnx->prepare($sql);
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        $stmt->execute();
        $playlist = $stmt->fetch(PDO::FETCH_ASSOC);
        return $playlist;
    }

    /**
     * @param int $user_id
     * @return array
     */
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
