<?php

require '../Autoloader.php';
Autoloader::register();

session_start();

use Model\Connection_BD;
use Model\Classes\db_model\UtilisateurBD;

$cnx = Connection_BD::getInstance();
$user = new UtilisateurBD($cnx);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['user']) && isset($_POST['password']) && isset($_POST['email'])) {
        $username = $_POST['user'];
        $password = $_POST['password'];
        $email = $_POST['email'];

        // Vérifiez d'abord si l'utilisateur existe déjà
        $existingUser = $user->getUtilisateurByUsername($username);

        if ($existingUser) {
            // Identifiants déjà utilisés, rediriger avec un message d'erreur
            header("Location: /?error=3");
            echo "Utilisateur déjà existant";
            exit();
        } else {
            // Création d'un nouvel utilisateur
            $user->insertUtilisateur($username, $password, $email, false);
            $newUser = $user->getUtilisateurByUsername($username);
            $_SESSION['user'] = $newUser;
            echo "Utilisateur créé";
            header("Location: /");
            exit();
        }
    } else {
        echo "Veuillez remplir tous les champs du formulaire.";
    }
} else {
    echo "La requête n'est pas de type POST.";
}

