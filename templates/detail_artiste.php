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
<?php include 'aside_menu.php'; ?>
<main>
    <div class="titre">
        <h2>Découvrir</h2>
    </div>
    <div class="grid">

    </div>
</main>
</body>
<?php include 'insertion_js.php'; ?>
</html>

<?php
if (isset($_GET['error']) && $_GET['error'] === "1") { // Si on a une erreur et que ce sont les identifiants incorrects
    echo "<p>Identifiants incorrects</p>";
} elseif (isset($_GET['error']) && $_GET['error'] === "2")  { // Si on a une erreur et que ce sont les mots de passe incorrects
    echo "<p>Mot de passe incorrect</p>";
} elseif (isset($_GET['error']) && $_GET['error'] === "3")  { // Si on a une erreur et que ce sont les identifiants déjà utilisés
    echo "<p>Identifiants déjà utilisés</p>";
}
?>
`
