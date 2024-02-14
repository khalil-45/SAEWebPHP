<?php

namespace Model\Classes;

class ImageArtiste {
    private $image_id;
    private $nom_image;
    private $artiste_id;


    public function __construct($image_id, $nom_image, $artiste_id) {
        $this->image_id = $image_id;
        $this->nom_image = $nom_image;
        $this->artiste_id = $artiste_id;
    }

    public function getIdImage() {
        return $this->image_id;
    }

    public function getNomImage() {
        return $this->nom_image;
    }

    public function getArtisteId() {
        return $this->artiste_id;
    }

    public function setIdImage($image_id) {
        $this->image_id = $image_id;
    }

    public function setNomImage($nom_image) {
        $this->nom_image = $nom_image;
    }

    public function setArtisteId($artiste_id) {
        $this->artiste_id = $artiste_id;
    }

    public function toArray() {
        return [
            "image_id" => $this->image_id,
            "nom_image" => $this->nom_image,
            "artiste_id" => $this->artiste_id
        ];
    }

}