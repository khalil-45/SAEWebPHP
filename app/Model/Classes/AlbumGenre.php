<?php

namespace Model\Classes;
require_once __DIR__ . '/album.php';
require_once __DIR__ . '/genre.php';

class AlbumGenre {
    private $album_id;
    private $id_genre;

    public function __construct($album_id, $id_genre) {
        $this->album_id = $album_id;
        $this->id_genre = $id_genre;
    }

    public function getAlbumId() {
        return $this->album_id;
    }

    public function getIdGenre() {
        return $this->id_genre;
    }
}
