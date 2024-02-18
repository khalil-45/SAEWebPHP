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
            <img src="../static/images/logoRaspberry.jpeg" alt="logo">
            <h1>Raspberry Music</h1>
        </div>
        <div class="recherche">
        <form class="recherche" method="GET" action="/templates/recherche.php">
            <input type="text" name="recherche" placeholder="Rechercher">
            <button type="submit">Rechercher</button>
        </form>

    
        </div>
        <nav>
            <ul>
                <a href="/">
                    <li><img src="../static/images/decouvrir.png" alt="icone decouvrir">Découvrir</li>
                </a>
                <a href="/?action=playlists">
                    <li><img src="../static/images/playlist.png" alt="icone playlists">Mes Playlists</li>
                </a>
                <a href="?action=admin">
                    <li><img src="../static/images/parametres.png" alt="admin">Admin</li>
                </a>
            </ul>
        </nav>
        <div class="profil">
    <?php
    // Vérifiez si l'utilisateur est connecté
    if(isset($_SESSION['user'])) {
        // L'utilisateur est connecté, affichez un message de bienvenue
        $user = $_SESSION['user'];
        $nom = $user->getUsername();
        echo "<p class='username'>$nom </p>";

        // Ajoutez un lien de déconnexion
        echo '<a href="../app/Model/logout.php" class="logout-link">Déconnexion</a>';
    } else {
        // L'utilisateur n'est pas connecté, affichez les boutons de connexion
        ?>
        
            <button class="connexion-inscription" onclick="openFormLogIn()">
                <img src="../static/images/pdpBase.png" alt="profil">
            </button>
            <button class="connexion-inscription" onclick="openFormLogIn()">
                <p>Se connecter</p>
            </button>
        
        <?php
    }
    ?>
</div>
    </aside>
    <div class="connection-popup">
            <div class="form-container" id="loginform">
                <p class="title">Se connecter</p>
                <form class="form" action="../app/Model/login-bd.php" method="POST">
                    <input type="email" class="input" placeholder="Email" id="email" name="email">
                    <input type="password" class="input" placeholder="Mot de passe" id="password" name="password">
                    <p class="page-link">
                        <a class="page-link-label" onclick="closeFormLogIn(); openFormMDP()">Mot de passe oublié ?</a>
                    </p>
                    <button class="form-btn-log">Se connecter</button>
                </form>
                <p class="sign-up-label">
                    <a class="sign-up-link" onclick="closeFormLogIn(); openFormSignUp();">S'inscrire</a>
                </p>  
                <button class="close" onclick="closeFormLogIn()">X</button>
            </div>
        </div>
        <div class="connection-popup">
            <div class="form-container" id="signupform">
                <p class="title">Inscription</p>
                <form class="form" action="../app/Model/register-bd.php" method="POST">
                    <input type="text" class="input" placeholder="Username" id="user" name ="user">
                    <input type="email" class="input" placeholder="Email" id="email" name = "email">
                    <input type="password" class="input" placeholder="Mot de passe" id="password" name="password">
                    <input type="password" class="input" placeholder="Confirmer le mot de passe">
                    <button class="form-btn-sig" type="submit">S'inscrire</button>
                </form>
                <p class="sign-up-label">
                    Déjà un compte ? <a class="sign-up-link" onclick="closeFormSignUp(); openFormLogIn();">Connectez-vous</a>
                </p>
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