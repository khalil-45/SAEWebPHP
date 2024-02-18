 <!-- album_info.php -->
<?php
global $noteBD,$album;

if (isset($_POST['note'])) {
    $noteBD->insertNote($_POST['album_id'], $_POST['user_id'], $_POST['note']);
}

if ($album != null) {
    $note = $noteBD->moyenneNoteByAlbumId($album->getAlbumId());
    $nbNotes = $noteBD->getNombreNotesByAlbumId($album->getAlbumId());
} else {
    $note = 0;
    $nbNotes = 0;
}


?>
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

            <div class="note">
                <p>Note : <?php echo $note  ?>/5</p>

                <p>Nombre de notes : <?php echo $nbNotes ?></p>
            </div>
        </div>
        <div class="Notation">
            <form  method="post">
                <input type="hidden" name="album_id" value="<?php echo $album->getAlbumId() ?>">
                <input type="hidden" name="user_id" value="<?php echo $_SESSION['user']->getUserId() ?>">
                <input type="number" name="note" min="0" max="5" required>
                <button type="submit">Noter</button>
            </form>
        </div>
    </div>
</section>