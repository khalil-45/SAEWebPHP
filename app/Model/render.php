<?php

use Model\Classes\db_model\AlbumBD;

function render_albums_admin($albums,$artistes)
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
        $artiste_id = $album['artiste_id'];
        if (!isset($artistes[$artiste_id])) {
            $artiste = "Artiste inconnu";
        } else {
            $artiste = $artistes[$artiste_id];
            $artiste = $artiste['nom'];
        }

        $genre = $album['genre'];

        if ($genre == null) {
            $genre = "Genres inconnu";
        }

        echo '<tr>';
        echo '<td class="titre"> <img src="../static/images/img_albums/' .
    (($album['pochette'] != null) ? urlencode(trim($album['pochette'])) : "default.jpg") .
    '" alt="pochette de l\'album"> ' . $album['titre'] . '</td>';
        echo '<td>' . $artiste . '</td>';
        echo '<td>' . $album['annee'] . '</td>';
        echo '<td>' . $genre . '</td>';
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
    echo '<select name="artiste" id="artiste" >';
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
        $genre = $genre['nom_genre'];
        $albumBD->insertAlbum($_POST['titre'], $_POST['annee'], $genre, $_POST['pochette'], $_POST['artiste']);
        header('Location: ?action=admin_albums');

    }
}

function render_editer_album($album,$artistes,$genreBD,$albumBD)
{
    // Récupérer tous les genres
    $genres = $genreBD->getAllGenres();

    echo '<h1>Édition d\'un album</h1>';
    echo '<form  method="post">';
    echo '<label for="titre">Titre</label>';
    echo '<input type="text" name="titre" id="titre" value="' . $album['titre'] . '" required>';
    echo '<label for="pochette">Pochette</label>';
    echo '<input type="file" name="pochette" id="pochette" >';
    echo '<label for="artiste">Artiste</label>';

    foreach ($artistes as $artiste) {
        var_dump($artiste['artiste_id']);
        var_dump($album['artiste_id']);
        $selected = ((int)$artiste['artiste_id'] === (int)$album['artiste_id']+1) ? 'selected' : '' ;
        var_dump($selected);
    }
    // Créer un champ de sélection pour l'artiste
    echo '<select name="artiste" id="artiste" >';
    foreach ($artistes as $artiste) {
        $selected = ((int)$artiste['artiste_id'] === (int)$album['artiste_id']+1) ? 'selected' : '' ;
        echo '<option value="' . $artiste['artiste_id'] . '" ' . $selected . '>' . $artiste['nom'] . '</option>';
    }
    echo '</select>';
    echo '<label for="annee">Année</label>';
    echo '<input type="number" name="annee" id="annee" value="' . $album['annee'] . '" required>';
    echo '<label for="genre">Genre</label>';

    // Créer un champ de sélection pour le genre
    echo '<select name="genre" id="genre">';
    foreach ($genres as $genre) {
        $selected = ((int)$genre['id_genre'] === (int)$album['genre_id']) ? 'selected' : '';
        echo '<option value="' . $genre['id_genre'] . '" ' . $selected . '>' . $genre['nom_genre'] . '</option>';
    }
    echo '</select>';
    echo '<input type="submit" value="Modifier">';
    echo '</form>';

    if (isset($_POST['titre']) && isset($_POST['artiste']) && isset($_POST['annee']) && isset($_POST['genre'])) {
        $genre = $genreBD->getGenreById($_POST['genre']);
        $genre = $genre['nom_genre'];
        $albumBD->updateAlbum($album['album_id'],$_POST['titre'], $_POST['annee'], $genre, $_POST['pochette'], $_POST['artiste']-1);
        header('Location: ?action=admin_albums');

    }
}


?>