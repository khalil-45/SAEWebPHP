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
    <link rel="stylesheet" href="../static/css/playlist.css">
    <title><?php echo $playlist->getTitre() ?></title>
</head>

<body>
    <?php
    renderPagePlaylist($playlist, $chansons, $username, $imageAlbum);
    ?>
</body>

</html>