<?php

?>
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
    <title>Infos
        <?php echo $album->getTitre() ?>
    </title>
</head>

<body>
    <?php include 'aside_menu.php'; ?>
    <main>
        <section class="info-album">
            <div class="album-cover">
                <img src="../static/images/img_albums/<?php
                if ($album->getPochette() != null) {
                    echo urlencode(trim($album->getPochette()));
                } else {
                    echo "default.jpg";
                }
                ?>" alt="pochette de l'album">
            </div>
            <div class="album-info">
                <h2><?php
                    echo $album->getTitre()?></h2>
                <p><?php 
                if ($artiste->getNom() != null){
                    echo $artiste->getNom();
                } else {
                    echo "Artiste inconnu";
                }
                ?></p>
                <div class="date-genre">
                    <p><?php 
                    if ($album->getGenre() != null){
                    echo $album->getGenre();
                    } else {
                        echo "Artiste inconnu";
                    }
                    ?>
                </p>
                <div class="date-genre">
                    <p>
                        <?php
                        if ($album->getGenre() != null) {
                            echo $album->getGenre();
                        } else {
                            echo "Genres inconnu";
                        }
                        ?>
                    </p>
                    <p>
                        <?php echo $album->getAnnee() ?>
                    </p>
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
                <?php foreach ($chansons as $chanson): ?>
                    <li>
                        <p>
                            <?php echo $chanson->getChansonId() ?>
                        </p>
                        <img src="../static/images/bouton-jouer-petit.png" alt="bouton play">
                        <?php echo $chanson->getTitre() ?>
                        <button class="add-to-playlist-button"
                            onclick="showPlaylistsPopup(<?php echo $chanson->getChansonId() ?>)">Ajouter à la
                            playlist</button>

                        <!-- Add a form to select a playlist -->
                        <div id="popup-playlists<?php echo $chanson->getChansonId() ?>" class="popup-playlists"
                            style="display: none;">
                            <div class="popup-content">
                                <span class="close-popup-playlists"
                                    onclick="closePlaylistsPopup(<?php echo $chanson->getChansonId() ?>)">&times;</span>
                                <h3>Ajouter à la playlist du titre :
                                    <?php echo $chanson->getTitre() ?>
                                </h3>

                                <form action="../app/Model/ajout_chanson_playlist.php" method="post">
                                    <input type="hidden" name="chanson_id" value="<?php echo $chanson->getChansonId() ?>">

                                    <label for="playlist">Sélectionner une playlist :</label>
                                    <select name="playlist" id="playlist">
                                        <?php foreach ($playlists as $p): ?>
                                            <option value="<?php echo $p->getPlaylistId() ?>">
                                                <?php echo $p->getTitre() ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>

                                    <button type="submit">Ajouter</button>
                                </form>

                            </div>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        </section>
        <p class="retourbtn"><a href="<?php echo $_SERVER['HTTP_REFERER']?>">Retour</a></p>
    </main>
</body>
<?php include 'insertion_js.php'; ?>
<script>
    function showPlaylistsPopup(chansonId) {
        var playlistsPopup = document.getElementById('popup-playlists' + chansonId);
        playlistsPopup.style.display = 'block';
    }

    function closePlaylistsPopup(chansonId) {
        var playlistsPopup = document.getElementById('popup-playlists' + chansonId);
        playlistsPopup.style.display = 'none';
    }
</script>

</html>