<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../static/css/asidemenu.css">
    <link rel="stylesheet" href="../static/css/main.css">
    <link rel="stylesheet" href="../static/css/popupForm.css">
    <link rel="stylesheet" href="../static/css/cardalbum.css">
    <link rel="stylesheet" href="../static/css/pageAlbum.css">
    <title>page Album</title>
</head>

<body>
    <?php include 'aside_menu.php'; ?>
    <main>
        <section class="info-album">
            <div class="album-cover">
                <img src="../static/images/img_albums/<?php
                if ($album['pochette'] != null) {
                    echo urlencode(trim($album['pochette']));
                } else {
                    echo "default.jpg";
                }
                ?>" alt="pochette de l'album">
            </div>
            <div class="album-info">
                <h2><?php echo $album['titre']?></h2>
                <p><?php 
                if ($artiste['nom'] != null){
                    echo $artiste['nom'];
                } else {
                    echo "Artiste inconnu";
                }
                ?></p>
                <div class="date-genre">
                    <p><?php 
                    if ($album['genre'] != null){
                    echo $album['genre'];
                    } else {
                        echo "Genres inconnu";
                    }
                    ?></p>
                    <p><?php echo $album['annee']?></p>
                </div>
                <div class="buttons">
                    <button class="play-button">
                        <img src="../static/images/bouton-jouer.png" alt="play button">
                        <p>Lecture</p>
                    </button>
                    <button class="add-button">
                        <img src="../static/images/ajouter.png" alt="add button">
                        <p>Ajouter à la playlist</p>
                    </button>
                </div>
            </div>
        </section>

        <section class="titres">
            <ul>
                <?php foreach ($chansons as $chanson) : ?>
                    <button>
                        <li><p><?php echo $chanson['chanson_id'] ?></p><img src="../static/images/bouton-jouer-petit.png" alt="bouton play"><?php echo $chanson['titre'] ?></li>
                    </button>
                <?php endforeach; ?>
            </ul>
        </section>
    </main>
</body>
<?php include 'insertion_js.php'; ?>

</html>
