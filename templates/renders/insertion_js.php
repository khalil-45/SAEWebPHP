
<script src="../static/js/popup_connexion.js">
</script>
<script>
    var menuButton = document.querySelector('.menu-button');
    var aside = document.querySelector('aside');

    menuButton.addEventListener('click', function() {
        aside.classList.toggle('open');
        menuButton.classList.toggle('rotate');
    });
</script>

<script>
    (document).ready(function() {
    // Fonction pour effectuer la recherche
    window.searchAlbums = function() {
        // Récupérer le terme de recherche saisi par l'utilisateur
        var searchTerm = $('#recherche').val().toLowerCase();

        // Envoyer une requête AJAX pour récupérer les données des albums
        $.ajax({
            url: 'recherche.php',
            type: 'GET',
            dataType: 'json',
            success: function(albums) {
                // Filtrer les albums en fonction du terme de recherche
                var filteredAlbums = albums.filter(function(album) {
                    return album.titre.toLowerCase().includes(searchTerm) || album.genre.toLowerCase().includes(searchTerm) || album.annee.toString().includes(searchTerm);
                });

                // Afficher les résultats filtrés sur la page
                displayResults(filteredAlbums);
            },
            error: function(xhr, status, error) {
                console.error('Une erreur s\'est produite lors de la récupération des données des albums : ' + error);
            }
        });
    };

    // Fonction pour afficher les résultats sur la page
    function displayResults(results) {
        // Supprimer les résultats précédents
        $('.recherche').empty();

        // Construire le HTML pour les résultats
        var html = '<ul>';
        results.forEach(function(album) {
            html += '<li>' + album.titre + ' - ' + album.annee + '</li>';
        });
        html += '</ul>';

        // Afficher les résultats sur la page
        $('.recherche').html(html);
    }
});
</script>

