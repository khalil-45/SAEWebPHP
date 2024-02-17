<?php
include 'renders/fonctions.php';

// 1. Définir le nombre d'éléments à afficher par page
$items_per_page = 10;

// 2. Calculer le nombre total de pages
$total_items_albums = $albumBD->getTotalAlbums();
$total_pages_albums = ceil($total_items_albums / $items_per_page);

$total_items_artistes = $artisteBD->getTotalArtistes();
$total_pages_artistes = ceil($total_items_artistes / $items_per_page);

// 3. Obtenir le numéro de la page actuelle à partir de la requête GET
$current_page_albums = isset($_GET['page_albums']) ? (int)$_GET['page_albums'] : 1;
$current_page_albums = max($current_page_albums, 1);
$current_page_albums = min($current_page_albums, $total_pages_albums);

$current_page_artistes = isset($_GET['page_artistes']) ? (int)$_GET['page_artistes'] : 1;
$current_page_artistes = max($current_page_artistes, 1);
$current_page_artistes = min($current_page_artistes, $total_pages_artistes);

// 4. Calculer l'offset pour la requête SQL
$offset_albums = ($current_page_albums - 1) * $items_per_page;
$offset_artistes = ($current_page_artistes - 1) * $items_per_page;

// 5. Modifier la requête SQL pour utiliser LIMIT et OFFSET
$albums = $albumBD->getAlbums($items_per_page, $offset_albums);
$artistes = $artisteBD->getArtistes($items_per_page, $offset_artistes);

// Pour les albums
$pagination_albums = '';
if ($current_page_albums > 1) {
    $pagination_albums .= "<a href=\"?page_albums=" . ($current_page_albums - 1) . "&page_artistes=" . $current_page_artistes . "\">Précédent</a>";
}
for ($i = 1; $i <= $total_pages_albums; $i++) {
    if ($i == $current_page_albums) {
        $pagination_albums .= "<span>$i</span>";
    } else {
        $pagination_albums .= "<a href=\"?page_albums=$i&page_artistes=" . $current_page_artistes . "\">$i</a>";
    }
}
if ($current_page_albums < $total_pages_albums) {
    $pagination_albums .= "<a href=\"?page_albums=" . ($current_page_albums + 1) . "&page_artistes=" . $current_page_artistes . "\">Suivant</a>";
}

// Pour les artistes
$pagination_artistes = '';
if ($current_page_artistes > 1) {
    $pagination_artistes .= "<a href=\"?page_artistes=" . ($current_page_artistes - 1) . "&page_albums=" . $current_page_albums . "\">Précédent</a>";
}
for ($i = 1; $i <= $total_pages_artistes; $i++) {
    if ($i == $current_page_artistes) {
        $pagination_artistes .= "<span>$i</span>";
    } else {
        $pagination_artistes .= "<a href=\"?page_artistes=$i&page_albums=" . $current_page_albums . "\">$i</a>";
    }
}
if ($current_page_artistes < $total_pages_artistes) {
    $pagination_artistes .= "<a href=\"?page_artistes=" . ($current_page_artistes + 1) . "&page_albums=" . $current_page_albums . "\">Suivant</a>";
}
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
    <?php include 'renders/aside_menu.php'; ?>
    <main>
        <div class="titre">
            <h2>Découvrir</h2>
        </div>
        <div class="grid">
            <?= implode('', array_map('renderAlbum', $albums)) ?>
        </div>
        <div class="pagination">
            <?= $pagination_albums ?>
        </div>
        <div class="titre">
            <h2>Artistes</h2>
        </div>
        <div class="grid">
            <?= implode('', array_map('renderArtiste', $artistes)) ?>
        </div>
        <div class="pagination">
            <?= $pagination_artistes ?>
        </div>
    </main>
    <?php include 'renders/insertion_js.php'; ?>
</body>

</html>