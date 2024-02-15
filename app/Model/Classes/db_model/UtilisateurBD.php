<?php

namespace Model\Classes\db_model;

require_once __DIR__ . '/../../Connection_BD.php';
require_once __DIR__ . '/../../Classes/Utilisateur.php';

use Model\Classes\Utilisateur;
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
        $sql = "INSERT INTO UTILISATEUR (username, password, email) VALUES (:username, :password, :email)";
        $stmt = $this->cnx->prepare($sql);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        return $stmt->execute();
    }

    /**
     * @param int $id
     * @return Utilisateur|null
     */
    public function getUtilisateurById($id)
    {
        $sql = "SELECT * FROM UTILISATEUR WHERE user_id = :id";
        $stmt = $this->cnx->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return new Utilisateur($row['user_id'], $row['username'], $row['password'], $row['email']);
        }
        return null;
    }

    /**
     * @param string $username
     * @return Utilisateur|null
     */
    public function getUtilisateurByUsername($username)
    {
        $sql = "SELECT * FROM UTILISATEUR WHERE username = :username";
        $stmt = $this->cnx->prepare($sql);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return new Utilisateur($row['id'], $row['username'], $row['password'], $row['email']);
        }
        return null;
    }

    /**
     * @param string $email
     * @param string $password
     * @return Utilisateur|null
     */
    public function getUtilisateurByEmailandPassword($email, $password)
    {
        $sql = "SELECT * FROM UTILISATEUR WHERE email = :email AND password = :password";
        $stmt = $this->cnx->prepare($sql);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return new Utilisateur($row['id'], $row['username'], $row['password'], $row['email']);
        }
        return null;
    }

    
    public function deleteUtilisateurById($id)
    {
        $sql = "DELETE FROM UTILISATEUR WHERE user_id = :id";
        $stmt = $this->cnx->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }


    /**
     * @param int $id
     * @param string $username
     * @param string $password
     * @param string $email
     */
    public function updateUtilisateur($id, $username, $password, $email)
    {
        $sql = "UPDATE UTILISATEUR SET username = :username, password = :password, email = :email WHERE user_id = :id";
        $stmt = $this->cnx->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function getAllUtilisateurs()
    {
        $sql = "SELECT * FROM UTILISATEUR";
        $stmt = $this->cnx->prepare($sql);
        $stmt->execute();
        $utilisateurs = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $utilisateurs;
    }

}

?>
