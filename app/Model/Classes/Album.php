<?php

namespace Model\Classes;

class Album {
    private $album_id;
    private $titre;
    private $annee;
    private $genre;
    private $pochette;
    private $artiste_id;
    
    
    public function __construct($album_id, $titre, $annee, $genre, $pochette, $artiste_id) {
        $this->album_id = $album_id;
        $this->titre = $titre;
        $this->annee = $annee;
        $this->genre = $genre;
        $this->pochette = $pochette;
        $this->artiste_id = $artiste_id;
        
    }

    // getters
    public function getAlbumId() {
        return $this->album_id;
    }

    public function getTitre() {
        return $this->titre;
    }

    public function getAnnee() {
        return $this->annee;
    }

    public function getGenre() {
        return $this->genre;
    }

    public function getPochette() {
        return $this->pochette;
    }

    public function getArtisteId() {
        return $this->artiste_id;
    }


    // setters
    public function setAlbumId($album_id) {
        $this->album_id = $album_id;
    }

    public function setTitre($titre) {
        $this->titre = $titre;
    }

    public function setAnnee($annee) {
        $this->annee = $annee;
    }

    public function setGenre($genre) {
        $this->genre = $genre;
    }

    public function setPochette($pochette) {
        $this->pochette = $pochette;
    }


    public function toArray() {
        return array(
            "album_id" => $this->album_id,
            "titre" => $this->titre,
            "annee" => $this->annee,
            "genre" => $this->genre,
            "pochette" => $this->pochette,
            "artiste_id" => $this->artiste_id
        );
    }

    public function render() {
        return $this->toArray();
    }
}
