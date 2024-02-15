function searchAlbums() {
    // Récupérer la valeur saisie dans le champ de recherche
    var searchQuery = document.getElementById('recherche').value;

    // Envoyer une requête AJAX au serveur pour effectuer la recherche
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                // Traitement des résultats de la recherche
                var albums = JSON.parse(xhr.responseText);
                displaySearchResults(albums);
            } else {
                console.error('Une erreur s\'est produite lors de la recherche.');
            }
        }
    };

    // Définir la méthode HTTP et l'URL pour la recherche
    xhr.open('GET', '../templates/aside_menu.php?query=' + searchQuery, true);
    xhr.send();
}


function displaySearchResults(albums) {
    var grid = document.querySelector('.grid');
    grid.innerHTML = '';

    if (albums.length === 0) {
        var noResultsMessage = document.createElement('p');
        noResultsMessage.textContent = "Aucun résultat trouvé.";
        grid.appendChild(noResultsMessage);
    } else {
        albums.forEach(function(album) {
            var albumDiv = document.createElement('div');
            albumDiv.classList.add('head');

            var albumTitle = document.createElement('div');
            albumTitle.classList.add('bottom');
            albumTitle.textContent = album.titre;
            albumDiv.appendChild(albumTitle);

            var albumImage = document.createElement('img');
            albumImage.src = "../static/images/img_albums/" + (album.pochette ? encodeURIComponent(album.pochette) : "default.jpg");

            // Ajouter un lien vers la page de l'album
            var albumLink = document.createElement('a');
            albumLink.href = "/album?id=" + album.id; // Remplacez l'URL par celle de votre page d'album
            albumLink.appendChild(albumImage);
            albumDiv.appendChild(albumLink);

            grid.appendChild(albumDiv);
        });
    }
}

