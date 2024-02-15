<!-- album_info.php -->

<main>
<section class="info-album">
    <div class="album-cover">
        <img src="../../static/images/img_albums/<?php
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
                <img src="../../static/images/bouton-jouer.png" alt="play button">
                <p>Lecture</p>
            </button>
            <button class="add-button">
                <img src="../../static/images/ajouter.png" alt="add button">
                <p>Ajouter à la playlist</p>
            </button>
        </div>
    </div>
</section>