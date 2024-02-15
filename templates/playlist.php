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
    <title><?php echo $playlist->getTitre() ?></title>
</head>

<body>
    <?php include 'renders/aside_menu.php'; ?>
    <main>
        <section class="info-playlist">
            <div class="playlist-cover">
                <img src="../static/images/img_albums/220px-Folklore_hp.jpg" alt="image de la playlist">
            </div>
            <div class="playlist-info">
                <h2><?php echo $playlist->getTitre() ?></h2>
                <?php
                    // Fetch the username from the appropriate source
                    $username = $username->getUsername();
                ?>
                <p><?php echo $username?></p>
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
                <?php
                if ($chansons != null) {
                foreach ($chansons as $chanson) :
                    // Make sure $chansonBD is defined and assigned
                    $chanson = $chansonBD->getChansonById($chanson->getChansonId());
                    ?>
                    <button><li><img src="../static/images/bouton-jouer-petit.png" alt="bouton play"><?php echo $chanson->getTitre() ?></li></button>
                <?php endforeach;
                } else {
                    echo "<p style='text-align: center;'>Aucune chanson dans cette playlist</p>";
                }
                ?>
            </ul>
        </section>
        <a class="retourbtn" href="<?php echo $_SERVER['HTTP_REFERER']?>"><p>Retour</p></a>
    </main>
</body>

<?php include 'renders/insertion_js.php'; ?>

</html>