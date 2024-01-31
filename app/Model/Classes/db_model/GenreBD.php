<?php

namespace Model\Classes\db_model;

require_once __DIR__ . '/../Connection_BD.php';

use Model\Classes\Genre;
use PDO;

class GenreBD
{
    private $cnx;

    public function __construct(PDO $cnx)
    {
        $this->cnx = $cnx;
    }

    public function insertGenre(Genre $genre)
    {
        $sql = "INSERT INTO GENRE (nom_genre) VALUES (?)";
        $stmt = $this->cnx->prepare($sql);
        $stmt->bindParam(1, $genre->getNomGenre(), PDO::PARAM_STR);
        $stmt->execute();
    }

    // Ajoutez d'autres méthodes au besoin pour récupérer des genres, etc.
}

?>
