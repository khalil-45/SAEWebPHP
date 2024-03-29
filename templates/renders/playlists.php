<main>
    <div class="titre-mes-playlists">
        <h2>Mes playlists</h2>
    </div>
    <?php if (!isset($_SESSION['user'])){
        echo "<p style='text-align: center;'>Vous devez être connecté pour accéder à cette page</p>";
    } else {
        ?>
        <section class="playlists">
            <?php foreach ($playlists as $p): ?>
                <div class="playlist">
                    <?php 
                    global $chansonPlaylistBD;
                    global $chansonBD;
                    global $albumBD;
                    $chansons = $chansonPlaylistBD->getAllChansonsPlaylistByPlaylistId($p->getPlaylistId());
                    if ($chansons != null){
                        $premiereChanson = $chansonBD->getChansonById($chansons[0]->getChansonId());
                        $imageAlbum = $albumBD->getAlbumById($premiereChanson->getAlbumId())->getPochette();
                    } else {
                        $imageAlbum = "default.jpg";
                    }
                    ?>
                    <a href="/?action=playlist&id_playlist=<?php echo urlencode($p->getPlaylistId()); ?>">
                        <img src="../../static/images/img_albums/<?php echo $imageAlbum; ?>" alt="image de la playlist">
                        <p>
                            <?php echo $p->getTitre() ?>
                        </p>
                    </a>
                    <form action="../../app/Model/supprimer_playlist.php" method="post">
                        <input type="hidden" name="id_playlist" value="<?php echo $p->getPlaylistId(); ?>">
                        <button class="delete-playlist-btn" type="submit"><img src="../../static/images/poubelle.png" alt="logo de poubelle">Supprimer Playlist</button>
                    </form>
                </div>
            <?php endforeach; ?>
        </section>
        <!-- Formulaire pour ajouter une nouvelle playlist -->
        <div class="ajouter-playlist-form">
            <form action="../../app/Model/ajouter_playlist.php" method="post">
                <label for="titre">Titre de la nouvelle playlist :</label>
                <input type="text" id="titre" name="titre" required>
                <button type="submit">Ajouter Playlist</button>
            </form>
        </div>
    <?php }
    ?>
</main>