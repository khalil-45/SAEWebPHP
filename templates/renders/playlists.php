<main>
    <div class="titre-mes-playlists">
        <h2>Mes playlists</h2>
    </div>
    <?php if ($_SESSION['user'] == null) {
        echo "<p style='text-align: center;'>Vous devez être connecté pour accéder à cette page</p>";
    } else {
        ?>
        <section class="playlists">
            <?php foreach ($playlists as $p): ?>
                <a href="/?action=playlist&id_playlist=<?php echo urlencode($p->getPlaylistId()); ?>">
                    <div class="playlist">
                        <img src="../../static/images/img_albums/220px-DarkChords.jpg" alt="image de la playlist">
                        <p>
                            <?php echo $p->getTitre() ?>
                        </p>
                    </div>
                </a>
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