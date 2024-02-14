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

    // getters
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

    // setters
    public function setNoteId($note_id) {
        $this->note_id = $note_id;
    }

    public function setAlbumId($album_id) {
        $this->album_id = $album_id;
    }

    public function setUserId($user_id) {
        $this->user_id = $user_id;
    }

    public function setNote($note) {
        $this->note = $note;
    }

    public function toArray() {
        return [
            "note_id" => $this->note_id,
            "album_id" => $this->album_id,
            "user_id" => $this->user_id,
            "note" => $this->note
        ];
    }
}
