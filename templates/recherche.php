<?php

require_once '../app/Model/Classes/db_model/AlbumBD.php';
require_once '../app/Model/Connection_BD.php';
// require once pour les artistes
require_once '../app/Model/Classes/db_model/ArtisteBD.php';

use Model\Classes\db_model\AlbumBD;
use Model\Connection_BD;
use Model\Classes\db_model\ArtisteBD;

// Récupérer la connexion PDO en appelant getInstance() sur la classe Connection_BD
$cnx = Connection_BD::getInstance();

// Créer une instance de AlbumBD avec la connexion PDO
$albumBD = new AlbumBD($cnx);

// Créer une instance de ArtisteBD avec la connexion PDO
$artisteBD = new ArtisteBD($cnx);


// Vérifier si des données de recherche ont été soumises
if (isset($_GET['recherche'])) {
    $query = $_GET['recherche'];

    // Rechercher les albums correspondant à la requête
    $albumsRecherche = $albumBD->searchAlbums($query);

    // Rechercher les artistes correspondant à la requête
    $artistesRecherche = $artisteBD->searchArtiste($query);

    // Rechercher les albums par année
    $albumsAnnee = $albumBD->searchAlbumsByAnnee($query);

    // Afficher les résultats de la recherche des albums
    foreach ($albumsRecherche as $album) {
        echo $album->getTitre() . '<br>';
        echo $album->getPochette() . '<br>';
        echo $album->getAnnee() . '<br>';
        echo $album->getGenre() . '<br>';
        echo $album->getArtisteId() . '<br>';
    }

    // Afficher les résultats de la recherche des artistes
    foreach ($artistesRecherche as $artiste) {
        echo $artiste->getNom() . '<br>';
        echo $artiste->getBio() . '<br>';
        echo $artiste->getPhoto() . '<br>';
    }

    // Afficher les résultats de la recherche des albums par année
    foreach ($albumsAnnee as $album) {
        echo $album->getTitre() . '<br>';
        echo $album->getPochette() . '<br>';
        echo $album->getAnnee() . '<br>';
        echo $album->getGenre() . '<br>';
        echo $album->getArtisteId() . '<br>';
    }
}

// Possibilité de revenir à la page précédente
echo '<a href="javascript:history.go(-1)">Revenir à la page d\'accueil</a>';

?>
