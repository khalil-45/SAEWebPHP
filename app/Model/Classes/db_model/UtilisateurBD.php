<?php

namespace Model\Classes\db_model;

require_once __DIR__ . '/../../Connection_BD.php';

use PDO;

class UtilisateurBD
{
    private $cnx;

    public function __construct(PDO $cnx)
    {
        $this->cnx = $cnx;
    }

    /**
     * @param $username
     * @param $password
     * @param $email
     * @return bool
     */
    public function insertUtilisateur($username, $password, $email)
    {
        $sql = "INSERT INTO UTILISATEUR (username, password, email) VALUES (:username, :password, :email)";
        $stmt = $this->cnx->prepare($sql);
        $stmt->bindParam(1, $username, PDO::PARAM_STR);
        $stmt->bindParam(2, $password, PDO::PARAM_STR);
        $stmt->bindParam(3, $email, PDO::PARAM_STR);
        return $stmt->execute();
    }


    public function getUtilisateurById($id)
    {
        $sql = "SELECT * FROM UTILISATEUR WHERE id = :id";
        $stmt = $this->cnx->prepare($sql);
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        $stmt->execute();
        $utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);
        return $utilisateur;
    }

    public function getUtilisateurByUsername($username)
    {
        $sql = "SELECT * FROM UTILISATEUR WHERE username = :username";
        $stmt = $this->cnx->prepare($sql);
        $stmt->bindParam(1, $username, PDO::PARAM_STR);
        $stmt->execute();
        $utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);
        return $utilisateur;
    }

    public function getUtilisateurByEmailandPassword($email, $password)
    {
        $sql = "SELECT * FROM UTILISATEUR WHERE email = :email AND password = :password";
        $stmt = $this->cnx->prepare($sql);
        $stmt->bindParam(1, $email, PDO::PARAM_STR);
        $stmt->bindParam(2, $password, PDO::PARAM_STR);
        $stmt->execute();
        $utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);
        return $utilisateur;
    }

    public function deleteUtilisateur($id)
    {
        $sql = "DELETE FROM UTILISATEUR WHERE id = :id";
        $stmt = $this->cnx->prepare($sql);
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function isEmailTaken($email)
    {
        $sql = "SELECT * FROM UTILISATEUR WHERE email = :email";
        $stmt = $this->cnx->prepare($sql);
        $stmt->bindParam(1, $email, PDO::PARAM_STR);
        $stmt->execute();
        $utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);
        return $utilisateur;
    }

}

?>
