<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/asidemenu.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/popupForm.css">
    <link rel="stylesheet" href="css/cardalbum.css">
    <link rel="stylesheet" href="css/pageAlbum.css">
    <title>page Album</title>
</head>

<body>
    <div class="overlay"></div>
    <button class="menu-button">
        <div class="toggle">
            <div class="bars" id="bar1"></div>
            <div class="bars" id="bar2"></div>
            <div class="bars" id="bar3"></div>
        </div>
    </button>
    <aside>
        <div class="titre-logo">
            <img src="images/logoRaspberry.jpeg" alt="logo">
            <h1>Raspberry Music</h1>
        </div>
        <div class="recherche">
            <form action="" method="post">
                <input type="text" name="recherche" id="recherche" placeholder="Rechercher">
                <button type="submit">
                    <img src="images/loupe.png" alt="bouton recherche">
                </button>
            </form>
        </div>
        <nav>
            <ul>
                <a href="#">
                    <li><img src="images/play.png" alt="icone jouer">Écouter</li>
                </a>
                <a href="#">
                    <li><img src="images/decouvrir.png" alt="icone decouvrir">Découvrir</li>
                </a>
                <a href="#">
                    <li><img src="images/bibliotheque.png" alt="icone bibliothèque">Ma Bibliothèque</li>
                </a>
                <a href="#">
                    <li><img src="images/playlist.png" alt="icone playlists">Mes Playlists</li>
                </a>
                <a href="#">
                    <li><img src="images/parametres.png" alt="icone paramètres">Paramètres</li>
                </a>
            </ul>
        </nav>
        <div class="profil">
            <button class="connexion-inscription" onclick="openFormLogIn()"><img src="images/pdpBase.png" alt="profil"></button>
            <button class="connexion-inscription" onclick="openFormLogIn()">
                <p>Se connecter</p>
            </button>
        </div>
    </aside>
    <div class="connection-popup">
        <div class="form-container" id="loginform">
            <p class="title">De retour</p>
            <form class="form">
                <input type="email" class="input" placeholder="Email">
                <input type="password" class="input" placeholder="Mot de passe">
                <p class="page-link">
                    <a class="page-link-label" onclick="closeFormLogIn(); openFormMDP()">Mot de passe oublié ?</a>
                </p>
                <button class="form-btn">Se connecter</button>
            </form>
            <p class="sign-up-label">
                <a class="sign-up-link" onclick="closeFormLogIn(); openFormSignUp();">S'inscrire</a>
            </p>
            <div class="buttons-container">
                <div class="google-login-button">
                    <span>Se connecter avec Google</span>
                </div>
            </div>
            <button class="close" onclick="closeFormLogIn()">X</button>
        </div>
    </div>
    <div class="connection-popup">
        <div class="form-container" id="signupform">
            <p class="title">Inscription</p>
            <form class="form">
                <input type="text" class="input" placeholder="Username">
                <input type="email" class="input" placeholder="Email">
                <input type="password" class="input" placeholder="Mot de passe">
                <input type="password" class="input" placeholder="Confirmer le mot de passe">
                <button class="form-btn">S'inscrire</button>
            </form>
            <p class="sign-up-label">
                Déjà un compte ? <a class="sign-up-link" onclick="closeFormSignUp(); openFormLogIn();">Connectez-vous</a>
            </p>
            <div class="buttons-container">
                <div class="google-login-button">
                    <span>S'inscrire avec Google</span>
                </div>
            </div>
            <button class="close" onclick="closeFormSignUp()">X</button>
        </div>
    </div>
    <div class="connection-popup">
        <div class="form-container" id="mdpoublie">
            <p class="title">Mot de passe oublié ? Entrez votre adresse mail</p>
            <form class="form">
                <input type="text" class="input" placeholder="Entrez votre adresse mail">
                <button class="form-btn">Envoyer</button>
            </form>
            <p class="sign-up-label">
                Votre mot de passe vous revient ? <a class="sign-up-link" onclick="closeFormMDP(); openFormLogIn();">Connectez-vous</a>
            </p>
            <button class="close" onclick="closeFormMDP()">X</button>
        </div>
    </div>
    <main>
        <section class="info-album">
            <div class="album-cover">
                <img src="images/img_albums/220px-Folklore_hp.jpg" alt="album cover">
            </div>
            <div class="album-info">
                <h2>Titre de l'album</h2>
                <p>Artiste</p>
                <div class="date-genre">
                    <p>Genre</p>
                    <p>Année de sortie</p>
                </div>
                <div class="buttons">
                    <button class="play-button">
                        <img src="images/bouton-jouer.png" alt="play button">
                        <p>Lecture</p>
                    </button>
                    <button class="add-button">
                        <img src="images/ajouter.png" alt="add button">
                        <p>Ajouter à la playlist</p>
                    </button>
                </div>
            </div>
        </section>

        <section class="titres">
            <ul>
                <button>
                    <li><img src="images/bouton-jouer-petit.png" alt="bouton play">Titre 1</li>
                </button>
                <button>
                    <li><img src="images/bouton-jouer-petit.png" alt="bouton play">Titre 2</li>
                </button>
            </ul>
        </section>
    </main>
</body>

<script src="js/popup_connexion.js"></script>
<script>
    var menuButton = document.querySelector('.menu-button');
    var aside = document.querySelector('aside');

    menuButton.addEventListener('click', function() {
        aside.classList.toggle('open');
        menuButton.classList.toggle('rotate');
    });
</script>
</html>