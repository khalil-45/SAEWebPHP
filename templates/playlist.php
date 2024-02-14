<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../static/css/asidemenu.css">
    <link rel="stylesheet" href="../static/css/main.css">
    <link rel="stylesheet" href="../static/css/popupForm.css">
    <link rel="stylesheet" href="../static/css/cardalbum.css">
    <link rel="stylesheet" href="../static/css/playlist.css">
    <title><?php //$playlist.getTitre() ?></title>
</head>

<body>
    <?php include 'aside_menu.php'; ?>
    <main>
        <section class="info-playlist">
            <div class="playlist-cover">
                <img src="../static/images/img_albums/220px-Folklore_hp.jpg" alt="image de la playlist">
            </div>
            <div class="playlist-info">
                <h2><?php //$playlist.getTitre() ?>titre playlist</h2>
                <p><?php //$playlist.getUtilisateur() ?> Utilisateur</p>
                <div class="buttons">
                    <button class="play-button">
                        <img src="../static/images/bouton-jouer.png" alt="play button">
                        <p>Lecture</p>
                    </button>
                </div>
            </div>
        </section>

        <section class="titres">
            <ul>
                <button><li><img src="../static/images/bouton-jouer-petit.png" alt="bouton play"><?php echo $chanson['titre'] ?>Titre 1</li></button>
            </ul>
        </section>
    </main>

</body>

<?php include 'insertion_js.php'; ?>

</html>