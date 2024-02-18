<?php
require 'app/Model/render.php';
require_once __DIR__ . '/../renders/fonctions.php';
bloqueAdmin();

$artistes = $artisteBD->getAllArtistes();
$genres = $genreBD->getAllGenres();
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
    if ($action == 'admin_ajout_artiste')
    {
        render_ajout_artiste($artisteBD, $imageBD);
    }
    else if ($action == 'admin_editer_artiste')
    {
        $artiste = $artisteBD->getArtisteById($_GET['id_artiste']);
        render_editer_artiste($artiste, $artisteBD, $imageBD);
    }
    else if ($action == 'admin_supprimer_artiste')
    {
        $artisteBD->deleteArtisteById($_GET['id_artiste']);
        header('Location: ?action=admin_artistes');
    }
    else
    {
        render_artistes_admin($artistes, $imageBD);
    }
    ?>
</div>
</body>
</html>
