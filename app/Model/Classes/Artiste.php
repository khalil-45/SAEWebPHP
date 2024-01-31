<?php

namespace Model\Classes;

class Artiste {
    private $artiste_id;
    private $nom;
    private $bio;
    private $photo;
    private $images;

    public function __construct($artiste_id, $nom, $bio, $photo, $images) {
        $this->artiste_id = $artiste_id;
        $this->nom = $nom;
        $this->bio = $bio;
        $this->photo = $photo;
        $this->images = $images;
    }

    public function getArtisteId() {
        return $this->artiste_id;
    }

    public function getNom() {
        return $this->nom;
    }

    public function getBio() {
        return $this->bio;
    }

    public function getPhoto() {
        return $this->photo;
    }

    public function getImages() {
        return $this->images;
    }
}
