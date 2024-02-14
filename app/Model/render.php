<?php

use Model\Classes\db_model\AlbumBD;

function render_albums_admin($albums)
{
    echo '<h1>Gestion des albums</h1>';
    echo '<a class="ajout" href="?action=admin_albums&admin=admin_ajout_album">Ajouter un album</a>';
    echo '<table>';
    echo '<tr>';
    echo '<th>Titre</th>';
    echo '<th>Artiste</th>';
    echo '<th>Année</th>';
    echo '<th>Genre</th>';
    echo '<th colspan="2">Actions</th>';
    echo '</tr>';
    foreach ($albums as $album) {
        echo '<tr>';
        echo '<td class="titre"> <img src="../static/images/img_albums/' .
    (($album['pochette'] != null) ? urlencode(trim($album['pochette'])) : "default.jpg") .
    '" alt="pochette de l\'album"> ' . $album['titre'] . '</td>';
        echo '<td>' . $album['artiste_id'] . '</td>';
        echo '<td>' . $album['annee'] . '</td>';
        echo '<td>' . $album['genre'] . '</td>';
        echo '<td class="actions">';
        echo '<a href="?action=admin_albums&admin=admin_editer_album&id_album=' . $album['album_id'] . '">Éditer</a>';
        echo '<a href="?action=admin_albums&admin=admin_supprimer_album&id_album=' . $album['album_id'] . '">Supprimer</a>';
        echo '</td>';
        echo '</tr>';
    }
}

function render_ajout_album($albumBD, $artistes,$genreBD)
{

    // Récupérer tous les genres
    $genres = $genreBD->getAllGenres();

    echo '<h1>Ajout d\'un album</h1>';
    echo '<form  method="post">';
    echo '<label for="titre">Titre</label>';
    echo '<input type="text" name="titre" id="titre" required>';
    echo '<label for="pochette">Pochette</label>';
    echo '<input type="file" name="pochette" id="pochette" >';
    echo '<label for="artiste">Artiste</label>';

    // Créer un champ de sélection pour l'artiste
    echo '<select name="artiste" id="artiste" required>';
    foreach ($artistes as $artiste) {
        echo '<option value="' . $artiste['artiste_id'] . '">' . $artiste['nom'] . '</option>';
    }
    echo '</select>';
    echo '<label for="annee">Année</label>';
    echo '<input type="number" name="annee" id="annee" required>';
    echo '<label for="genre">Genre</label>';

    // Créer un champ de sélection pour le genre
    echo '<select name="genre" id="genre">';
    foreach ($genres as $genre) {
        var_dump($genre);
        echo '<option value="' . $genre['id_genre'] . '">' . $genre['nom_genre'] . '</option>';
    }
    echo '</select>';
    echo '<input type="submit" value="Ajouter">';
    echo '</form>';

    if (isset($_POST['titre']) && isset($_POST['artiste']) && isset($_POST['annee']) && isset($_POST['genre'])) {
        $genre = $genreBD->getGenreById($_POST['genre']);
        $albumBD->insertAlbum($_POST['titre'], $_POST['annee'], $genre, $_POST['pochette'], $_POST['artiste']);
        header('Location: ?action=admin_albums');

    }
}

function render_editer_album($album)
{
    echo '<h1>Édition de l\'album ' . $album['titre'] . '</h1>';
    echo '<form action="?action=admin_editer_album&id_album=' . $album['album_id'] . '" method="post">';
    echo '<label for="titre">Titre</label>';
    echo '<input type="text" name="titre" id="titre" value="' . $album['titre'] . '">';
    echo '<label for="pochette">Pochette</label>';
    echo '<input type="file" name="pochette" id="pochette" value="' . $album['pochette'] . '">';
    echo '<label for="artiste">Artiste</label>';
    echo '<input type="text" name="artiste" id="artiste" value="' . $album['artiste_id'] . '">';
    echo '<label for="annee">Année</label>';
    echo '<input type="text" name="annee" id="annee" value="' . $album['annee'] . '">';
    echo '<label for="genre">Genre</label>';
    echo '<input type="text" name="genre" id="genre" value="' . $album['genre'] . '">';
    echo '<input type="submit" value="Modifier">';
    echo '</form>';

}


?>