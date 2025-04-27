<?php
session_start();
include '_conf.php';
?>
<!DOCTYPE html>
    <html lang="fr">
    <head>
    <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!--stylisation pricipale-->
        <link rel="stylesheet" href="crr_style.css"/>
        <!--importation des polices-->
        <link href='https://fonts.googleapis.com/css?family=Nunito Sans' rel='stylesheet'>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
        <!--lien Bootstrap pour le menu-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <!--lien pour le menu personnalisé-->
        <link rel="stylesheet" href="menu_style.css"/>
        <!--Lien pour télécharger les icônes-->
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <link rel="icon" href="favicon.ico" type="image/x-icon">
        <title>Suivi des Stages</title>
    </head>

    <body>

        <?php
        // Si l'utilisateur est connecté
        if (isset($_SESSION["login"])) {

            if ($_SESSION["type"] == 0) { // Élève connecté
                include '_menuEleve.php';

                if (isset($_GET["id"])) { // ON vérifie que ce CR lui appartient avant de le modifier
                    $idCR = $_GET["id"]; // Récupère l'identifiant du compte-rendu (CR) passé dans l'URL en paramètre "id" (Quel compte-rendu ?)
                    $iduser = $_SESSION["id"]; // Récupère l'identifiant de l'utilisateur connecté depuis la session active (Quel utilisateur connecté ?)
                    $connexion = mysqli_connect($serveurBDD, $userBDD, $mdpBDD, $nomBDD);

                    // Sélection du compte-rendu correspondant à l'utilisateur
                    $requete = "SELECT * FROM cr WHERE num = '$idCR' AND num_utilisateur = $iduser";
                    $resultat = mysqli_query($connexion, $requete);
                    $trouve = 0;

                    while ($donnees = mysqli_fetch_assoc($resultat)) {
                        $trouve = 1;
                        $date = $donnees['date'];
                        $description = $donnees['description'];
                    }

                    if ($trouve == 1) { ?>
                        <section id="formulaire" class="form-container">
                            <h2>Modifier un CR</h2>
                            <form action="cr.php" method="post">
                                <div class="form-group">
                                    <label>Date du CR :</label>
                                    <input type="date" name="date" value="<?php echo $date; ?>">
                                </div>
                                <div class="form-group">
                                    <label>Contenu :</label>
                                    <textarea name="contenu" rows="10" required><?php echo $description; ?></textarea>
                                </div>
                                <input type="hidden" name="idCR" value="<?php echo $idCR; ?>">
                                <button type="submit" class="btn-submit" name="update">Modifier</button>
                            </form>
                        </section>
                    <?php
                    } else {
                        echo "Erreur : Compte-rendu introuvable.";
                    }
                } else { // Pas d'ID => création d'un nouveau compte-rendu
                    ?>
                    <section id="formulaire" class="form-container">
                        <h2>Créer un CR</h2>
                        <form action="cr.php" method="post">
                            <div class="form-group">
                                <label>Date du CR :</label>
                                <input type="date" name="date" required>
                            </div>
                            <div class="form-group">
                                <label>Contenu :</label>
                                <textarea name="contenu" rows="10" required placeholder="Entrez votre CR ici"></textarea>
                            </div>
                            <button type="submit" class="btn-submit" name="insertion">Confirmer</button>
                        </form>
                    </section>
                    <?php
                }
            } else { // Professeur connecté
                include '_menuProf.php';
            }
        }
        ?>

        <!----------Fonctionnalité du menus---------->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <script src="menu_script.js"></script>

    </body>
</html>
