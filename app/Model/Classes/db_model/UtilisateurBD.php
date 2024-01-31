<?php

namespace Model\Classes\db_model;

require_once __DIR__ . '/../Connection_BD.php';

use Model\Classes\Utilisateur;
use PDO;

class UtilisateurBD
{
    private $cnx;

    public function __construct(PDO $cnx)
    {
        $this->cnx = $cnx;
    }

    public function insertUtilisateur(Utilisateur $utilisateur)
    {
        $sql = "INSERT INTO UTILISATEUR (username, password, email) VALUES (?, ?, ?)";
        $stmt = $this->cnx->prepare($sql);
        $stmt->bindParam(1, $utilisateur->getUsername(), PDO::PARAM_STR);
        $stmt->bindParam(2, $utilisateur->getPassword(), PDO::PARAM_STR);
        $stmt->bindParam(3, $utilisateur->getEmail(), PDO::PARAM_STR);
        $stmt->execute();
    }

    // Ajoutez d'autres méthodes au besoin pour récupérer des utilisateurs, etc.
}

?>
