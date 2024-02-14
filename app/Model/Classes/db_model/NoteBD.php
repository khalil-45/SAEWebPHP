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

    /**
     * @param int $album_id
     * @param int $user_id
     * @param int $note
     * @return bool
     */
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
     * @return array
     */
    public function getNoteByAlbumId($album_id)
    {
        $sql = "SELECT * FROM NOTE WHERE album_id = :album_id";
        $stmt = $this->cnx->prepare($sql);
        $stmt->bindParam(1, $album_id, PDO::PARAM_INT);
        $stmt->execute();
        $note = $stmt->fetch(PDO::FETCH_ASSOC);
        return $note;
    }

    /**
     * @param int $user_id
     * @return array
     */
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
