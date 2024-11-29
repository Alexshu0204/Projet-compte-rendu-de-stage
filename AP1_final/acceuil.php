<?php 
session_start();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <link rel="stylesheet" href="style.css"> <!-- Lien vers le fichier CSS -->
</head>
<body>
</body>
</html>

<?php
if (isset($_POST['send_con'])) {   
    $login = $_POST['login'];
    $mdp = $_POST['mdp'];
    $mdp = md5($mdp);
    include "_conf.php";

    // Connexion à la base de données
    if ($connexion = mysqli_connect($serveurBDD, $userBDD, $mdpBDD, $nomBDD)) {
        $requete = "SELECT * FROM utilisateur WHERE login='$login' AND motdepasse='$mdp'";
        $resultat = mysqli_query($connexion, $requete);
        $trouve = 0;

        while ($donnees = mysqli_fetch_assoc($resultat)) {
            $trouve = 1;
            $_SESSION['Sid'] = $donnees['num'];
            $_SESSION['Slogin'] = $donnees['login'];
            $_SESSION['Stype'] = $donnees['numType'];
        }

        // Redirection en cas d'échec
        if ($trouve != 1) {
            header("Location: erreur.php"); // Redirection vers erreur.php
            exit(); // Stoppe le script ici pour éviter tout comportement inattendu
        }
    } else {
        // Affichage d'un message d'erreur en cas de problème de connexion à la base
        echo "<p style='color: red;'>Erreur : Impossible de se connecter à la base de données.</p>";
    }
}

if (isset($_SESSION['Sid'])) {
    // Si une session est active
    if ($_SESSION['Stype'] == 1) {
        include "_menu_prof.php"; // Menu pour les professeurs
    } else {
        include "_menu_eleve.php"; // Menu pour les élèves
    }
}
?>
