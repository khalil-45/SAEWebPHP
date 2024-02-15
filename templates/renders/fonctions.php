<?php

function getImage($image, $default) {
    return $image != null ? urlencode(trim($image)) : $default;
}

function getAlbumImage($album) {
    return getImage($album->getPochette(), "default.jpg");
}

function getArtisteImage($artiste) {
    global $imageBD;
    $photo = $imageBD->getImageArtisteById($artiste->getArtisteId())->getNomImage();
    return getImage($photo, "default.jpg");
}
function renderAlbum($album) {
    $image = getAlbumImage($album);
    $id = $album->getAlbumId();
    $titre = $album->getTitre();
    return <<<HTML
        <a href="?action=album&id_album=$id">
            <div class="head">
                <i class='fab fa-apple' style='font-size:13.5px;'></i>
                <h5 class="top">Music</h5>
                <img src="../../static/images/img_albums/$image" alt="pochette de l'album">
                <div class="line"></div>
                <div class="bottom">$titre</div>
            </div>
        </a>
    HTML;
}

function renderArtiste($artiste) {
    $image = getArtisteImage($artiste);
    $id = $artiste->getArtisteId();
    $nom = $artiste->getNom();
    return <<<HTML
        <a href="?action=detail_artiste&id_artiste=$id">
            <div class="head">
                <i class='fab fa-apple' style='font-size:13.5px;'></i>
                <h5 class="top">Music</h5>
                <img src="../../static/images/img_artistes/$image" alt="photo de l'artiste">
                <div class="line"></div>
                <div class="bottom">$nom</div>
            </div>
        </a>
    HTML;
}

function renderAsideMenu() {
    include 'aside_menu.php';
}

function renderAlbumInfo($album, $artiste) {
    include 'album_info.php';
}

function renderChansons($chansons, $playlists) {
    include 'chansons.php';
}

function renderInsertionJs() {
    include 'insertion_js.php';
}

function renderPageAlbum($album, $artiste, $chansons, $playlists) {
    renderAsideMenu();
    renderAlbumInfo($album, $artiste);
    renderChansons($chansons, $playlists);
    renderInsertionJs();
}