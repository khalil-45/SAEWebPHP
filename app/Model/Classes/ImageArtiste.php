<?php

namespace Model\Classes;

class ImageArtiste {
    private $id_image;
    private $nom_image;
    private $artiste_id;


    public function __construct($id_image, $nom_image, $artiste_id) {
        $this->id_image = $id_image;
        $this->nom_image = $nom_image;
        $this->artiste_id = $artiste_id;
    }

    public function getIdImage() {
        return $this->id_image;
    }

    public function getNomImage() {
        return $this->nom_image;
    }

    public function getArtisteId() {
        return $this->artiste_id;
    }

    public function setIdImage($id_image) {
        $this->id_image = $id_image;
    }

    public function setNomImage($nom_image) {
        $this->nom_image = $nom_image;
    }

    public function setArtisteId($artiste_id) {
        $this->artiste_id = $artiste_id;
    }

    public function toArray() {
        return [
            "id_image" => $this->id_image,
            "nom_image" => $this->nom_image,
            "artiste_id" => $this->artiste_id
        ];
    }

}