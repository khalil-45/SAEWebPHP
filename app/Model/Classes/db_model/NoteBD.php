<?php

namespace Model\Classes\db_model;

require_once __DIR__ . '/../Connection_BD.php';

use Model\Classes\Note;
use PDO;

class NoteBD
{
    private $cnx;

    public function __construct(PDO $cnx)
    {
        $this->cnx = $cnx;
    }

    public function insertNote(Note $note)
    {
        $sql = "INSERT INTO NOTE (album_id, user_id, note) VALUES (?, ?, ?)";
        $stmt = $this->cnx->prepare($sql);
        $stmt->bindParam(1, $note->getAlbumId(), PDO::PARAM_INT);
        $stmt->bindParam(2, $note->getUserId(), PDO::PARAM_INT);
        $stmt->bindParam(3, $note->getNote(), PDO::PARAM_INT);
        $stmt->execute();
    }

    // Ajoutez d'autres méthodes au besoin pour récupérer des notes, etc.
}

?>
