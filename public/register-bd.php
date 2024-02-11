<?php

require '../app/Autoloader.php';
Autoloader::register();

session_start();

use Model\Connection_BD;
use Model\Classes\db_model\UtilisateurBD;

$cnx = Connection_BD::getInstance();
$user = new UtilisateurBD($cnx);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['email'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];

        echo "Nom d'utilisateur: $username, Mot de passe: $password, Email: $email";

        // Vérifiez d'abord si l'utilisateur existe déjà
        $existingUser = $user->getUtilisateurByUsername($username);

        echo "Résultat de la recherche d'utilisateur existant: ";
        var_dump($existingUser);

        if ($existingUser) {
            // Identifiants déjà utilisés, rediriger avec un message d'erreur
            header("Location: accueil.php?error=3");
            echo "Utilisateur déjà existant";
            exit();
        } else {
            // Création d'un nouvel utilisateur
            $user->insertUtilisateur($username, $password, $email);
            $newUser = $user->getUtilisateurByUsername($username);
            $_SESSION['username'] = $newUser['username'];
            echo "Utilisateur créé";
            header('Location: ./accueil.php');
            exit();
        }
    } else {
        echo "Veuillez remplir tous les champs du formulaire.";
    }
} else {
    echo "La requête n'est pas de type POST.";
}

