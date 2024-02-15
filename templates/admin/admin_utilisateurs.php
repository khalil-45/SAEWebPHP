<?php
require 'app/Model/render.php';
/*

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user'])) {
    header('Location: index.php?action=index');
    exit();
}
*/

if (isset($_GET['admin'])) {
    $action = $_GET['admin'];
} else {
    $action = NAN;
}

$artistes = $artisteBD->getAllArtistes();
$genres = $genreBD->getAllGenres();
$utilisateurs = $user->getAllUtilisateurs();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Raspberry Music</title>
    <link rel="stylesheet" href="../../static/css/main.css">
    <link rel="stylesheet" href="../../static/css/cardalbum.css">
    <link rel="stylesheet" href="../../static/css/admin.css">
    <link rel="stylesheet" href="../../static/css/tableau.css">
</head>
<header>
    <div class="logo">
        <a href="?action=index">
            <img src="../../static/images/logoRaspberry.jpeg" alt="logo">
            <h1>Raspberry Music</h1>
        </a>
    </div>
</header>
<body>
<div class="content">
    <?php
    if ($action == 'admin_ajout_utilisateur') {
        render_ajout_utilisateur($user);
    } else if ($action == 'admin_editer_utilisateur') {
        $utilisateur = $utilisateurBD->getUtilisateurById($_GET['id_utilisateur']);

        render_editer_utilisateur($utilisateur, $utilisateurBD);
    } else if ($action == 'admin_supprimer_utilisateur') {
        $utilisateurBD->deleteUtilisateurById($_GET['id_utilisateur']);
        header('Location: ?action=admin_utilisateurs');
    } else {
        render_utilisateurs_admin($utilisateurs);
    }
    ?>
</div>
</body>
</html>
