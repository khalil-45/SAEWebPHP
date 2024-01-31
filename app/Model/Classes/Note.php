<?php

namespace Model\Classes;
require_once __DIR__ . '/album.php';
require_once __DIR__ . '/utilisateur.php';

class Note {
    private $note_id;
    private $album_id;
    private $user_id;
    private $note;

    public function __construct($note_id, $album_id, $user_id, $note) {
        $this->note_id = $note_id;
        $this->album_id = $album_id;
        $this->user_id = $user_id;
        $this->note = $note;
    }

    public function getNoteId() {
        return $this->note_id;
    }

    public function getAlbumId() {
        return $this->album_id;
    }

    public function getUserId() {
        return $this->user_id;
    }

    public function getNote() {
        return $this->note;
    }
}
