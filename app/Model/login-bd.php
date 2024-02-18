<?php
require '../Autoloader.php';
Autoloader::register();

session_start();

use Model\Connection_BD;
use Model\Classes\db_model\UtilisateurBD;

$cnx = Connection_BD::getInstance();
$user = new UtilisateurBD($cnx);


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['email']) && isset($_POST['password'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Récupérer l'utilisateur par email et mot de passe
        $user = $user->getUtilisateurByEmailandPassword($email, $password);

        if ($user) {
            $_SESSION['user'] = $user;
            echo "Utilisateur connecté";
            header("Location: /");
            exit();
        } else {
            // Identifiants incorrects, rediriger avec un message d'erreur
            header("Location: /?error=2");
            exit();
        }
    }
    else{
        header("Location: /?error=1");
        exit();
    }
}
?>

