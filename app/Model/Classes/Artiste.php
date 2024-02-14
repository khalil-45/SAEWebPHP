<?php

namespace Model\Classes;

class Artiste {
    private $artiste_id;
    private $nom;
    private $bio;
    private $photo;
    private $images;

    public function __construct($artiste_id, $nom, $bio, $photo) {
        $this->artiste_id = $artiste_id;
        $this->nom = $nom;
        $this->bio = $bio;
        $this->photo = $photo;
    }

    // getters
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


    // setters
    public function setArtisteId($artiste_id) {
        $this->artiste_id = $artiste_id;
    }

    public function setNom($nom) {
        $this->nom = $nom;
    }

    public function setBio($bio) {
        $this->bio = $bio;
    }

    public function setPhoto($photo) {
        $this->photo = $photo;
    }


    public function toArray() {
        return array(
            "artiste_id" => $this->artiste_id,
            "nom" => $this->nom,
            "bio" => $this->bio,
            "photo" => $this->photo,
        );
    }
}
