<!-- chansons.php -->

<section class="titres">
    <ul>
        <?php foreach ($chansons as $chanson) : ?>
            <li>
                <p>
                    <?php echo $chanson->getChansonId() ?>
                </p>
                <img src="../../static/images/bouton-jouer-petit.png" alt="bouton play">
                <?php echo $chanson->getTitre() ?>
                <button class="add-to-playlist-button" onclick="showPlaylistsPopup(<?php echo $chanson->getChansonId() ?>)">Ajouter à la
                    playlist</button>

                <!-- Add a form to select a playlist -->
                <div id="popup-playlists<?php echo $chanson->getChansonId() ?>" class="popup-playlists" style="display: none;">
                    <div class="popup-content">
                        <span class="close-popup-playlists" onclick="closePlaylistsPopup(<?php echo $chanson->getChansonId() ?>)">&times;</span>
                        <h3>Ajouter à la playlist du titre :
                            <?php echo $chanson->getTitre() ?>
                        </h3>

                        <form action="../../app/Model/ajout_chanson_playlist.php" method="post">
                            <input type="hidden" name="chanson_id" value="<?php echo $chanson->getChansonId() ?>">

                            <label for="playlist">Sélectionner une playlist :</label>
                            <?php foreach ($playlists as $p) : ?>
                                <button type="submit" name="playlist" value="<?php echo $p->getPlaylistId() ?>">
                                    <?php echo $p->getTitre() ?>
                                </button>
                            <?php endforeach; ?>
                        </form>

                    </div>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
</section>
<a class="retourbtn" href="<?php echo $_SERVER['HTTP_REFERER']?>"><p>Retour</p></a>
</main>