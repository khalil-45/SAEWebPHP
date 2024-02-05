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

    public function getUtilisateurById($id)
    {
        $sql = "SELECT * FROM UTILISATEUR WHERE id = ?";
        $stmt = $this->cnx->prepare($sql);
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        $stmt->execute();
        $utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);
        return $utilisateur;
    }

    public function getUtilisateurByUsername($username)
    {
        $sql = "SELECT * FROM UTILISATEUR WHERE username = ?";
        $stmt = $this->cnx->prepare($sql);
        $stmt->bindParam(1, $username, PDO::PARAM_STR);
        $stmt->execute();
        $utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);
        return $utilisateur;
    }

    public function deleteUtilisateur($id)
    {
        $sql = "DELETE FROM UTILISATEUR WHERE id = ?";
        $stmt = $this->cnx->prepare($sql);
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        $stmt->execute();
    }

}

?>
