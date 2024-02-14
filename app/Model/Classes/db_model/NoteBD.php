<?php

namespace Model\Classes\db_model;

require_once __DIR__ . '/../Connection_BD.php';
require_once __DIR__ . '/../../Classes/Note.php';

use Model\Classes\Note;
use PDO;

class NoteBD
{
    private $cnx;

    public function __construct(PDO $cnx)
    {
        $this->cnx = $cnx;
    }

    public function insertNote($album_id, $user_id, $note)
    {
        $sql = "INSERT INTO NOTE (album_id, user_id, note) VALUES (:album_id, :user_id, :note)";
        $stmt = $this->cnx->prepare($sql);
        $stmt->bindParam(':album_id', $album_id, PDO::PARAM_INT);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindParam(':note', $note, PDO::PARAM_INT);
        return $stmt->execute();
    }

    /**
     * @param int $album_id
     * @return Note|null
     */
    public function getNoteByAlbumId($album_id)
    {
        $sql = "SELECT * FROM NOTE WHERE album_id = :album_id";
        $stmt = $this->cnx->prepare($sql);
        $stmt->bindParam(':album_id', $album_id, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return new Note($row['id'], $row['album_id'], $row['user_id'], $row['note']);
        }
        return null;
    }

    /**
     * @param int $user_id
     * @return Note|null
     */
    public function getNoteByUserId($user_id)
    {
        $sql = "SELECT * FROM NOTE WHERE user_id = :user_id";
        $stmt = $this->cnx->prepare($sql);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return new Note($row['id'], $row['album_id'], $row['user_id'], $row['note']);
        }
        return null;
    }

    public function deleteNoteByAlbumId($album_id)
    {
        $sql = "DELETE FROM NOTE WHERE album_id = :album_id";
        $stmt = $this->cnx->prepare($sql);
        $stmt->bindParam(':album_id', $album_id, PDO::PARAM_INT);
        $stmt->execute();
    }
}

?>
