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

    // Ajoutez d'autres méthodes au besoin pour récupérer des playlists, etc.
}

?>
