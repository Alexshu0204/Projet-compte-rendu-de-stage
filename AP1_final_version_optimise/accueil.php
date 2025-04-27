<?php
session_start(); 
include '_conf.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Stylisation principale -->
    <link rel="stylesheet" href="accueil_style.css"/>
    <!-- Importation des polices -->
    <link href='https://fonts.googleapis.com/css?family=Nunito Sans' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <!-- Lien Bootstrap pour le menu -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Lien pour le menu personnalisé -->
    <link rel="stylesheet" href="menu_style.css"/>
    <!-- Lien pour télécharger les icônes -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <title>Accueil</title>
</head>
<body>

<?php
// Affiche le menu si l'utilisateur est connecté
if (isset($_SESSION["login"])) {
    if ($_SESSION["type"] == 0) {
        include '_menuEleve.php';
    } else {
        include '_menuProf.php';
    }
}

// Si le formulaire de connexion est soumis
if (isset($_POST['envoi'])) {
    session_unset(); 
    session_destroy(); 
    session_start(); 

    $login = $_POST['login'];
    $mdp = md5($_POST['mdp']); 

    $connexion = mysqli_connect($serveurBDD, $userBDD, $mdpBDD, $nomBDD);
    $requete = "SELECT * FROM utilisateur WHERE login = '$login' AND motdepasse = '$mdp'";
    $resultat = mysqli_query($connexion, $requete);
    $trouve = 0;

    while ($donnees = mysqli_fetch_assoc($resultat)) {
        $trouve = 1;
        $_SESSION["id"] = $donnees['num'];
        $_SESSION["login"] = $donnees['login'];
        $_SESSION["type"] = $donnees['type'];
    }

    if ($trouve == 0) {
        include 'erreur_login.php';
    } else {
        header("Location: accueil.php");
        exit();
    }
}

// Message de bienvenue
if (isset($_SESSION["login"])) {
    echo '<section class="welcome-section text-center">';
    if ($_SESSION["type"] == 0) {
        echo '<h2 class="text-primary mt-5">Bienvenue sur votre espace Élève</h2>';
    } else {
        echo '<h2 class="text-success mt-5">Bienvenue sur votre espace Professeur</h2>';
    }
    echo '<h4 class="mt-3">Connecté(e) en tant que : <strong>' . htmlspecialchars($_SESSION["login"]) . '</strong></h4>';
    echo '</section>';
}
?>

<!-- Scripts Bootstrap et menu -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="menu_script.js"></script>

</body>
</html>
