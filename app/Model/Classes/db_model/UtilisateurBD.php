<?php

namespace Model\Classes\db_model;

require_once __DIR__ . '/../Connection_BD.php';

use PDO;

class UtilisateurBD
{
    private $cnx;

    public function __construct(PDO $cnx)
    {
        $this->cnx = $cnx;
    }

    public function insertUtilisateur($username, $password, $email)
    {
        $sql = "INSERT INTO UTILISATEUR (username, password, email) VALUES (?, ?, ?)";
        $stmt = $this->cnx->prepare($sql);
        $stmt->bindParam(1, $username, PDO::PARAM_STR);
        $stmt->bindParam(2, $password, PDO::PARAM_STR);
        $stmt->bindParam(3, $email, PDO::PARAM_STR);
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

    public function getUtilisateurByEmailandPassword($email, $password)
    {
        $sql = "SELECT * FROM UTILISATEUR WHERE email = ? AND password = ?";
        $stmt = $this->cnx->prepare($sql);
        $stmt->bindParam(1, $email, PDO::PARAM_STR);
        $stmt->bindParam(2, $password, PDO::PARAM_STR);
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

    public function isEmailTaken($email)
    {
        $sql = "SELECT * FROM UTILISATEUR WHERE email = ?";
        $stmt = $this->cnx->prepare($sql);
        $stmt->bindParam(1, $email, PDO::PARAM_STR);
        $stmt->execute();
        $utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);
        return $utilisateur;
    }

}

?>
