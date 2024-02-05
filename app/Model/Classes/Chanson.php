<?php

namespace Model\Classes;
require_once __DIR__ . '/album.php';

class Chanson {
    private $chanson_id;
    private $titre;
    private $duree;
    private $album_id;

    public function __construct($chanson_id, $titre, $duree, $album_id) {
        $this->chanson_id = $chanson_id;
        $this->titre = $titre;
        $this->duree = $duree;
        $this->album_id = $album_id;
    }

    public function getChansonId() {
        return $this->chanson_id;
    }

    public function getTitre() {
        return $this->titre;
    }

    public function getDuree() {
        return $this->duree;
    }

    public function getAlbumId() {
        return $this->album_id;
    }

    public function setChansonId($chanson_id) {
        $this->chanson_id = $chanson_id;
    }

    public function setTitre($titre) {
        $this->titre = $titre;
    }

    public function setDuree($duree) {
        $this->duree = $duree;
    }

    public function setAlbumId($album_id) {
        $this->album_id = $album_id;
    }

    public function toArray() {
        return [
            "chanson_id" => $this->chanson_id,
            "titre" => $this->titre,
            "duree" => $this->duree,
            "album_id" => $this->album_id
        ];
    }
}
