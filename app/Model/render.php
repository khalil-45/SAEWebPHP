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
        $artiste_id = $album->getArtisteId()-1;
        if (!isset($artistes[$artiste_id])) {
            $artiste = "Artiste inconnu";
        } else {
            $artiste = $artistes[$artiste_id]->getNom();
        }


        $genre = $album->getGenre();

        if ($genre == null) {
            $genre = "Genres inconnu";
        }

        echo '<tr>';
        echo '<td class="titre"> <img src="../static/images/img_albums/' .
    (($album->getPochette() != null) ? urlencode(trim($album->getPochette())) : "default.jpg") .
    '" alt="pochette de l\'album"> ' . $album->getTitre(). '</td>';
        echo '<td>' . $artiste . '</td>';
        echo '<td>' . $album->getAnnee() . '</td>';
        echo '<td>' . $genre . '</td>';
        echo '<td class="actions">';
        echo '<a href="?action=admin_albums&admin=admin_editer_album&id_album=' . $album->getAlbumId() . '">Éditer</a>';
        echo '<a href="?action=admin_albums&admin=admin_supprimer_album&id_album=' . $album->getAlbumId()  . '">Supprimer</a>';
        echo '</td>';
        echo '</tr>';
    }
}

function render_ajout_album($albumBD, $artistes,$genreBD)
{

    // Récupérer tous les genres
    $genres = $genreBD->getAllGenres();

    $photo = "default.jpg";

    echo '<h1>Ajout d\'un album</h1>';
    echo '<form  method="post">';
    echo '<label for="titre">Titre</label>';
    echo '<input type="text" name="titre" id="titre" required>';
    echo '<label class="file" for="file-upload">Sélectionnez une pochette</label>';
    echo '<img id="cover-preview" src="../static/images/img_albums/' . $photo . '" alt="pochette de l\'album">';
    echo '<input id="file-upload" type="file" name="file-upload" onchange="previewCover(event)">';
    echo '<label for="artiste">Artiste</label>';

    // Créer un champ de sélection pour l'artiste
    echo '<select name="artiste" id="artiste" >';
    foreach ($artistes as $artiste) {
        echo '<option value="' . $artiste->getArtisteId() . '" >' . $artiste->getNom() . '</option>';
    }
    echo '</select>';
    echo '<label for="annee">Année</label>';
    echo '<input type="number" name="annee" id="annee" required>';
    echo '<label for="genre">Genre</label>';

    // Créer un champ de sélection pour le genre
    echo '<select name="genre" id="genre">';
    foreach ($genres as $genre) {
        echo '<option value="' . $genre->getIdGenre() . '">' . $genre->getNomGenre() . '</option>';
    }
    echo '</select>';
    echo '<input type="submit" value="Ajouter">';
    echo '</form>';

    if (isset($_POST['titre']) && isset($_POST['artiste']) && isset($_POST['annee']) && isset($_POST['genre'])) {
        $genre = $genreBD->getGenreById($_POST['genre']);
        $genre = $genre->getNomGenre();
        var_dump($_POST);
        $pochette = $_POST['file-upload'];
        $albumBD->insertAlbum($_POST['titre'],$_POST['annee'],$genre,$pochette,$_POST['artiste']);
        header('Location: ?action=admin_albums');
    }

    addScript();
}

function render_editer_album($album,$artistes,$genreBD,$albumBD)
{
    // Récupérer tous les genres
    $genres = $genreBD->getAllGenres();
    $photo = $album->getPochette();
    if ($photo == null) {
        $photo = "default.jpg";
    }
    echo '<h1>Édition d\'un album</h1>';
    echo '<form  method="post" enctype="multipart/form-data">';
    echo '<label for="titre">Titre</label>';
    echo '<input type="text" name="titre" id="titre" value="' . $album->getTitre() . '" required>';
    echo '<label class="file" for="file-upload">Sélectionnez une pochette</label>';
    echo '<img id="cover-preview" src="../static/images/img_albums/' . $photo . '" alt="pochette de l\'album">';
    echo '<input id="file-upload" type="file" name="file-upload" onchange="previewCover(event)">';
    echo '<label for="artiste">Artiste</label>';

    // Créer un champ de sélection pour l'artiste
    echo '<select name="artiste" id="artiste" >';
    foreach ($artistes as $artiste) {
        $selected = ((int)$artiste->getArtisteId() === (int)$album->getArtisteId()) ? 'selected' : '' ;
        echo '<option value="' . $artiste->getArtisteId() . '" ' . $selected . '>' . $artiste->getNom() . '</option>';
    }
    echo '</select>';
    echo '<label for="annee">Année</label>';
    echo '<input type="number" name="annee" id="annee" value="' . $album->getAnnee() . '" required>';
    echo '<label for="genre">Genre</label>';



    // Créer un champ de sélection pour le genre
    echo '<select name="genre" id="genre">';


    foreach ($genres as $genre) {
        $selected = ($genre->getNomGenre() === $album->getGenre()) ? 'selected' : '';
        echo '<option value="' . $genre->getIdGenre() . '" ' . $selected . '>' . $genre->getNomGenre() . '</option>';
    }
    echo '</select>';
    echo '<input type="submit" value="Modifier">';
    echo '</form>';

    addScript();

    if (isset($_POST['titre']) && isset($_POST['artiste']) && isset($_POST['annee']) && isset($_POST['genre'])) {
        $genre = $genreBD->getGenreById($_POST['genre']);
        $genre = $genre->getNomGenre();
        $pochette = $_FILES['file-upload']['name'];
        if ($pochette == null) {
            $pochette = $photo;
        }
        $albumBD->updateAlbum($album->getAlbumId(),$_POST['titre'],$_POST['annee'],$genre,$pochette,$_POST['artiste']);
        header('Location: ?action=admin_albums');
    }
}


function render_artistes_admin($artistes,$imageBD)
{
    echo '<h1>Gestion des artistes</h1>';
    echo '<a class="ajout" href="?action=admin_artistes&admin=admin_ajout_artiste">Ajouter un artiste</a>';
    echo '<table>';
    echo '<tr>';
    echo '<th>Nom</th>';
    echo '<th>Bio</th>';
    echo '<th colspan="2">Actions</th>';
    echo '</tr>';
    foreach ($artistes as $artiste) {
        $photo = $imageBD->getImageArtisteById($artiste->getArtisteId());
        $photo = $photo->getNomImage();
        if ($photo == null) {
            $photo = "default.png";
        }
        echo '<tr>';
        echo '<td class="titre"> <img src="../static/images/img_artistes/' . $photo .'" alt="pochette de l\'album"> ' . $artiste->getNom() . '</td>';
        echo '<td>' . $artiste->getBio() . '</td>';
        echo '<td class="actions">';
        echo '<a href="?action=admin_artistes&admin=admin_editer_artiste&id_artiste=' . $artiste->getArtisteId() . '">Éditer</a>';
        echo '<a href="?action=admin_artistes&admin=admin_supprimer_artiste&id_artiste=' . $artiste->getArtisteId() . '">Supprimer</a>';
        echo '</td>';
        echo '</tr>';
    }
}

function render_ajout_artiste($artisteBD,$imageBD)
{
    $photo = "default.png";
    echo '<h1>Ajout d\'un artiste</h1>';
    echo '<form  method="post" enctype="multipart/form-data">'; // Ajoutez l'attribut enctype
    echo '<label for="nom">Nom</label>';
    echo '<input type="text" name="nom" id="nom" required>';
    echo '<label class="file" for="file-upload">Sélectionnez une photo</label>';
    echo '<img id="cover-preview" src="../static/images/img_artistes/' . $photo . '" alt="pochette de l\'album">';
    echo '<input id="file-upload" type="file" name="file-upload" onchange="previewCover(event)">';
    echo '<label for="bio">Bio</label>';
    echo '<textarea name="bio" id="bio"></textarea>';
    echo '<input type="submit" value="Ajouter">';
    echo '</form>';

    if (isset($_POST['nom']) && isset($_FILES['file-upload'])) { // Vérifiez si le fichier a été téléchargé
        $photo = $_FILES['file-upload']['name']; // Récupérez le nom du fichier
        $artisteBD->insertArtiste($_POST['nom'],$_POST['bio'],$photo);
        $imageBD->insertImageArtiste($artisteBD->getMaximumId(),$photo);
        header('Location: ?action=admin_artistes');
    }
    addScript();
}

function render_editer_artiste($artiste,$artisteBD,$imageBD)
{
    $photo = $imageBD->getImageArtisteById($artiste->getArtisteId());
    $photo = $photo->getNomImage();
    if ($photo == null) {
        $photo = "default.png";
    }
    echo '<h1>Édition d\'un artiste</h1>';
    echo '<form  method="post" enctype="multipart/form-data">'; // Ajoutez l'attribut enctype
    echo '<label for="nom">Nom</label>';
    echo '<input type="text" name="nom" id="nom" value="' . $artiste->getNom() . '" required>';
    echo '<label class="file" for="file-upload">Sélectionnez une photo</label>';
    echo '<img id="cover-preview" src="../static/images/img_artistes/' . $photo . '" alt="pochette de l\'album">';
    echo '<input id="file-upload" type="file" name="file-upload" onchange="previewCover(event)">';
    echo '<label for="bio">Bio</label>';
    echo '<textarea name="bio" id="bio">' . $artiste->getBio() . '</textarea>';
    echo '<input type="submit" value="Modifier">';
    echo '</form>';

    addScript();

    if (isset($_POST['nom'])) { // Vérifiez si le fichier a été téléchargé
        $photo_recup = $_FILES['file-upload']['name']; // Récupérez le nom du fichier
        if ($photo_recup == null) {
            $photo_recup = $photo;
        }
        $artisteBD->updateArtiste($artiste->getArtisteId(),$_POST['nom'],$_POST['bio'],$photo_recup);
        header('Location: ?action=admin_artistes');
    }

}


function render_utilisateurs_admin($utilisateurs)
{
    echo '<h1>Gestion des utilisateurs</h1>';
    echo '<a class="ajout" href="?action=admin_utilisateurs&admin=admin_ajout_utilisateur">Ajouter un utilisateur</a>';
    echo '<table>';
    echo '<tr>';
    echo '<th>Nom</th>';
    echo '<th>Prénom</th>';
    echo '<th>Email</th>';
    echo '<th>Admin?</th>';
    echo '<th colspan="2">Actions</th>';
    echo '</tr>';
    foreach ($utilisateurs as $utilisateur) {
        if($utilisateur['isAdmin'] == 1){
            $utilisateur['isAdmin'] = "Oui";
        } else {
            $utilisateur['isAdmin'] = "Non";
        }
        echo '<tr>';
        echo '<td>' . $utilisateur['username'] . '</td>';
        echo '<td>' . $utilisateur['password'] . '</td>';
        echo '<td>' . $utilisateur['email'] . '</td>';
        echo '<td>' . $utilisateur['isAdmin'] . '</td>';
        echo '<td class="actions">';
        echo '<a href="?action=admin_utilisateurs&admin=admin_editer_utilisateur&id_utilisateur=' . $utilisateur['user_id'] . '">Éditer</a>';
        echo '<a href="?action=admin_utilisateurs&admin=admin_supprimer_utilisateur&id_utilisateur=' . $utilisateur['user_id'] . '">Supprimer</a>';
        echo '</td>';
        echo '</tr>';
    }
}


function render_ajout_utilisateur($user)
{
    echo '<h1>Ajout d\'un utilisateur</h1>';
    echo '<form  method="post">';
    echo '<label for="username">Nom</label>';
    echo '<input type="text" name="username" id="username" required>';
    echo '<label for="password">Mot de passe</label>';
    echo '<input type="text" name="password" id="password" required>';
    echo '<label for="email">Email</label>';
    echo '<input type="email" name="email" id="email" required>';
    echo '<label for="role">Admin?</label>';
    echo '<input type="checkbox" name="role" id="role" value="admin">';
    echo '<input type="submit" value="Ajouter">';
    echo '</form>';

    if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['email'])) {
        if (isset($_POST['role'])) {
            $role = 1;
        } else {
            $role = 0;
        }
        $user->insertUtilisateur($_POST['username'],$_POST['password'],$_POST['email'],$role);
        header('Location: ?action=admin_utilisateurs');
    }
}

function render_editer_utilisateur($utilisateur,$utilisateurBD)
{
    echo '<h1>Édition d\'un utilisateur</h1>';
    echo '<form  method="post">';
    echo '<label for="username">Nom</label>';
    echo '<input type="text" name="username" id="username" value="' . $utilisateur->getUsername() . '" required>';
    echo '<label for="password">Mot de passe</label>';
    echo '<input type="text" name="password" id="password" value="' . $utilisateur->getPassword() . '" required>';
    echo '<label for="email">Email</label>';
    echo '<input type="email" name="email" id="email" value="' . $utilisateur->getEmail() . '" required>';
    echo '<input type="submit" value="Modifier">';
    echo '</form>';

    if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['email'])) {
        $utilisateurBD->updateUtilisateur($utilisateur->getUserId(),$_POST['username'],$_POST['password'],$_POST['email'],$utilisateur->isAdmin());
        header('Location: ?action=admin_utilisateurs');
    }
}


function addScript(): void
{
    echo '<script>
    function previewCover(event) {
        var reader = new FileReader();
        reader.onload = function() {
            var output = document.getElementById("cover-preview");
            output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    }
    </script>';

}


function render_genres_admin($genres)
{
    echo '<h1>Gestion des genres</h1>';
    echo '<a class="ajout" href="?action=admin_genres&admin=admin_ajout_genre">Ajouter un genre</a>';
    echo '<table>';
    echo '<tr>';
    echo '<th>Nom</th>';
    echo '<th colspan="2">Actions</th>';
    echo '</tr>';
    foreach ($genres as $genre) {
        echo '<tr>';
        echo '<td>' . $genre->getNomGenre() . '</td>';
        echo '<td class="actions">';
        echo '<a href="?action=admin_genres&admin=admin_editer_genre&id_genre=' . $genre->getIdGenre() . '">Éditer</a>';
        echo '<a href="?action=admin_genres&admin=admin_supprimer_genre&id_genre=' . $genre->getIdGenre() . '">Supprimer</a>';
        echo '</td>';
        echo '</tr>';
    }
}

function render_ajout_genre($genreBD)
{
    echo '<h1>Ajout d\'un genre</h1>';
    echo '<form  method="post">';
    echo '<label for="nom">Nom</label>';
    echo '<input type="text" name="nom" id="nom" required>';
    echo '<input type="submit" value="Ajouter">';
    echo '</form>';

    if (isset($_POST['nom'])) {
        $genreBD->insertGenre($_POST['nom']);
        header('Location: ?action=admin_genres');
    }
}


function render_editer_genre($genre,$genreBD)
{
    echo '<h1>Édition d\'un genre</h1>';
    echo '<form  method="post">';
    echo '<label for="nom">Nom</label>';
    echo '<input type="text" name="nom" id="nom" value="' . $genre->getNomGenre() . '" required>';
    echo '<input type="submit" value="Modifier">';
    echo '</form>';

    if (isset($_POST['nom'])) {
        $genreBD->updateGenre($genre->getIdGenre(),$_POST['nom']);
        header('Location: ?action=admin_genres');
    }
}


?>