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

    public function getNoteByAlbumId($album_id)
    {
        $sql = "SELECT * FROM NOTE WHERE album_id = :album_id";
        $stmt = $this->cnx->prepare($sql);
        $stmt->bindParam(1, $album_id, PDO::PARAM_INT);
        $stmt->execute();
        $note = $stmt->fetch(PDO::FETCH_ASSOC);
        return $note;
    }

    public function getNoteByUserId($user_id)
    {
        $sql = "SELECT * FROM NOTE WHERE user_id = :user_id";
        $stmt = $this->cnx->prepare($sql);
        $stmt->bindParam(1, $user_id, PDO::PARAM_INT);
        $stmt->execute();
        $note = $stmt->fetch(PDO::FETCH_ASSOC);
        return $note;
    }

    public function deleteNoteByAlbumId($album_id)
    {
        $sql = "DELETE FROM NOTE WHERE album_id = :album_id";
        $stmt = $this->cnx->prepare($sql);
        $stmt->bindParam(1, $album_id, PDO::PARAM_INT);
        $stmt->execute();
    }

}

?>
