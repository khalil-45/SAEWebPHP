<?php

namespace Model\Classes;

class Genre {
    private $id_genre;
    private $nom_genre;

    public function __construct($id_genre, $nom_genre) {
        $this->id_genre = $id_genre;
        $this->nom_genre = $nom_genre;
    }

    // getters
    public function getIdGenre() {
        return $this->id_genre;
    }

    public function getNomGenre() {
        return $this->nom_genre;
    }

    // setters
    public function setIdGenre($id_genre) {
        $this->id_genre = $id_genre;
    }

    public function setNomGenre($nom_genre) {
        $this->nom_genre = $nom_genre;
    }

    public function toArray() {
        return [
            "id_genre" => $this->id_genre,
            "nom_genre" => $this->nom_genre
        ];
    }
}
