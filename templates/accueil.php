<?php
$artiste = $artisteBD->getAllArtistes();
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
    <?php include 'aside_menu.php';
    ?>
    <main>
        <div class="titre">
            <h2>Découvrir</h2>
        </div>
        <div class="grid">

        <?php foreach ($album as $a) : ?>
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
        <div class="titre">
            <h2>Artistes</h2>
        </div>
        <div class="grid">
        <?php foreach ($artiste as $art) : ?>

            <?php
                $photo = $imageBD->getImageArtisteById($art->getArtisteId())->getNomImage();
                if ($photo != null) {
                    $photo = urlencode(trim($photo));
                } else {
                    $photo = "default.jpg";
                }
            ?>
            <a href="?action=detail_artiste&id_artiste=<?php echo $art->getArtisteId(); ?>">
                <div class="head">
                    <i class='fab fa-apple' style='font-size:13.5px;'></i>
                    <h5 class="top">Music
                    </h5>
                    <img src="../static/images/img_artistes/<?php echo $photo; ?>" alt="photo de l'artiste">
                    <div class="line"></div>
                    <div class="bottom"><?php
                        echo $art->getNom();
                        ?>
                    </div>
                </div>
            </a>
        <?php endforeach; ?>
        </div>

    </main>
</body>
<?php include 'insertion_js.php'; ?>

</html>