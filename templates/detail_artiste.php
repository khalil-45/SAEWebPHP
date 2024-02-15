<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Raspberry Music</title>
    <link rel="stylesheet" href="/static/css/asidemenu.css">
    <link rel="stylesheet" href="/static/css/main.css">
    <link rel="stylesheet" href="/static/css/popupForm.css">
    <link rel="stylesheet" href="/static/css/cardalbum.css">
    <link rel="stylesheet" href="/static/css/detail_artiste.css">
</head>

<body>
<?php
include 'aside_menu.php';

$artiste = $artisteBD->getArtisteById($_GET['id_artiste']);
$artiste_id = $artiste->getArtisteId();

$filtered_albums = array_filter($album, function ($album) use ($artiste_id) {
    return $album->getArtisteId() == $artiste_id;
});

$photo = $imageBD->getImageArtisteById($artiste_id);
$photo = $photo->getNomImage();


?>
<main>
    <div class="titre">
        <h2><?php echo htmlspecialchars($artiste->getNom()) ?></h2>
    </div>
    <div class="detail">
        <img src="/static/images/img_artistes/<?php
        echo htmlspecialchars($photo ?? 'default.jpg');
        ?>" alt="photo de l'artiste">
        <div class="info">
            <h2>Le Nom</h2>
            <p><?php echo htmlspecialchars($artiste->getNom()) ?></p>
            <h2>Biographie</h2>
            <p><?php echo htmlspecialchars($artiste->getBio()) ?></p>
        </div>
    </div>
    <h2>Les albums de cet artiste</h2>
    <div class="grid">
        <?php foreach ($filtered_albums as $a) : ?>
            <a href="?action=album&id_album=<?php echo $a->getAlbumId(); ?>">
                <div class="head">
                    <i class='fab fa-apple' style='font-size:13.5px;'></i>
                    <h5 class="top">Music</h5>
                    <img src="../static/images/img_albums/<?php
                    if ($a->getPochette() != null) {
                        echo urlencode(trim($a->getPochette()));
                    } else {
                        echo "default.jpg";
                    }
                    ?>" alt="pochette de l'album">
                    <div class="line"></div>
                    <div class="bottom"><?php echo $a->getTitre(); ?></div>
                </div>
            </a>
        <?php endforeach; ?>
    </div>
</main>
</body>
<?php include 'insertion_js.php'; ?>
</html>

<?php
if (isset($_GET['error'])) {
    $errorMessages = [
        "1" => "Identifiants incorrects",
        "2" => "Mot de passe incorrect",
        "3" => "Identifiants déjà utilisés",
    ];

    echo "<p>" . ($errorMessages[$_GET['error']] ?? '') . "</p>";
}
?>