<?php
include 'renders/fonctions.php';
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Raspberry Music</title>
    <link rel="stylesheet" href="../static/css/asidemenu.css">
    <link rel="stylesheet" href="../static/css/main.css">
    <link rel="stylesheet" href="../static/css/popupForm.css">
    <link rel="stylesheet" href="../static/css/cardalbum.css">
</head>

<body>
    <?php include 'renders/aside_menu.php';
    ?>
    <main>
        <div class="titre">
            <h2>Découvrir</h2>
        </div>
        <div class="grid">
    <?= implode('', array_map('renderAlbum', $albums)) ?>
</div>

<div class="titre">
    <h2>Artistes</h2>
</div>

<div class="grid">
    <?= implode('', array_map('renderArtiste', $artiste)) ?>
</div>

    </main>
</body>
<?php include 'renders/insertion_js.php'; ?>

</html>