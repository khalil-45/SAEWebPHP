<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../static/css/asidemenu.css">
    <link rel="stylesheet" href="../static/css/main.css">
    <link rel="stylesheet" href="../static/css/popupForm.css">
    <link rel="stylesheet" href="../static/css/cardalbum.css">
    <link rel="stylesheet" href="../static/css/playlists.css">
    <title>Mes Playlists</title>
</head>

<body>
    <?php include 'aside_menu.php'; ?>
    <main>
        <div class="titre-mes-playlists">
            <h2>Mes playlists</h2>
        </div>
        <?php if ($_SESSION['username'] == null) {
        echo "<p style='text-align: center;'>Vous devez être connecté pour accéder à cette page</p>";
    } else {
     ?>
        <section class="playlists">
            <a href="/?action=playlist?id_playlist=#">
                <div class="playlist">
                    <img src="../static/images/img_albums/220px-DarkChords.jpg" alt="image de la playlist">
                    <p>Playlist 1</p>
                </div>
            </a>
        </section>
        <?php } ?>
    </main>
</body>

<?php include 'insertion_js.php'; ?>

</html>