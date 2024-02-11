<?php
// Démarrez la session
session_start();

// Détruisez toutes les variables de session
$_SESSION = array();

// Si vous utilisez des cookies de session, détruisez également le cookie
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Enfin, détruisez la session
session_destroy();

// Redirigez vers la page de connexion ou une autre page après la déconnexion
header("Location: ./accueil.php");
exit();
?>