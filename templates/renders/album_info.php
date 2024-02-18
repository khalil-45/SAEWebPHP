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
        <?php if ($artiste != null) {?>
        <p><a class="lien-artiste" href="?action=detail_artiste&id_artiste=<?php echo $artiste->getArtisteId()?>"><?php 
            echo $artiste->getNom();
        } else {
            echo "Artiste inconnu";
        }
        ?></a></p>
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
    </div>
</section>