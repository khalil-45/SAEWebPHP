<main>
    <section class="info-playlist">
        <div class="playlist-cover">
            <img src="../../static/images/img_albums/220px-Folklore_hp.jpg" alt="image de la playlist">
        </div>
        <div class="playlist-info">
            <h2><?php echo $playlist->getTitre() ?></h2>
            <?php
            // Fetch the username from the appropriate source
            $username = $username->getUsername();
            ?>
            <p><?php echo $username ?></p>
            <div class="buttons">
                <button class="play-button">
                    <img src="../../static/images/bouton-jouer.png" alt="play button">
                    <p>Lecture</p>
                </button>
            </div>
        </div>
    </section>

    <section class="titres">
        <table>
            <thead>
                <tr>
                    <th>Titre</th>
                    <th>Artiste</th>
                    <th>Durée</th>
                </tr>
            </thead>
            <tbody>
                <?php
                global $chansonBD;
                global $albumBD;
                global $artisteBD;
                if ($chansons != null) {
                    foreach ($chansons as $chanson) :
                        $chanson = $chansonBD->getChansonById($chanson->getChansonId());
                        $album = $albumBD->getAlbumById($chanson->getAlbumId());
                        $artiste = $artisteBD->getArtisteById($album->getArtisteId());
                ?>
                        <tr>
                            <td><?php echo $chanson->getTitre() ?></td>
                            <td><?php echo $artiste->getNom() ?></td>
                            <td><?php echo $chanson->getDuree() ?></td>
                        </tr>
                <?php endforeach;
                } else {
                    echo "<tr><td colspan='3' style='text-align: center;'>Aucune chanson dans cette playlist</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </section>
    <a class="retourbtn" href="<?php echo $_SERVER['HTTP_REFERER'] ?>">
        <p>Retour</p>
    </a>
</main>