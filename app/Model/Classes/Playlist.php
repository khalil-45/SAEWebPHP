<?php

namespace Model\Classes;
require_once __DIR__ . '/user.php';

class Playlist {
    private $playlist_id;
    private $user_id;
    private $titre;

    public function __construct($playlist_id, $user_id, $titre) {
        $this->playlist_id = $playlist_id;
        $this->user_id = $user_id;
        $this->titre = $titre;
    }

    public function getPlaylistId() {
        return $this->playlist_id;
    }

    public function getUserId() {
        return $this->user_id;
    }

    public function getTitre() {
        return $this->titre;
    }

    public function setPlaylistId($playlist_id) {
        $this->playlist_id = $playlist_id;
    }

    public function setUserId($user_id) {
        $this->user_id = $user_id;
    }

    public function setTitre($titre) {
        $this->titre = $titre;
    }

    public function toArray() {
        return [
            "playlist_id" => $this->playlist_id,
            "user_id" => $this->user_id,
            "titre" => $this->titre
        ];
    }
}
