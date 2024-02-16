<?php
include 'renders/fonctions.php';
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../static/css/asidemenu.css">
    <link rel="stylesheet" href="../static/css/main.css">
    <link rel="stylesheet" href="../static/css/popupForm.css">
    <link rel="stylesheet" href="../static/css/cardalbum.css">
    <link rel="stylesheet" href="../static/css/page_album.css">
    <title>Infos
        <?php echo $album->getTitre() ?>
    </title>
</head>

<body>
    <?php
    renderPageAlbum($album, $artiste, $chansons, $playlists);
    ?>
</body>
<script>
    function showPlaylistsPopup(chansonId) {
        var playlistsPopup = document.getElementById('popup-playlists' + chansonId);
        playlistsPopup.style.display = 'flex'; // Affiche le popup
    }

    function closePlaylistsPopup(chansonId) {
        var playlistsPopup = document.getElementById('popup-playlists' + chansonId);
        playlistsPopup.style.display = 'none'; // Cache le popup
    }
</script>

</html>