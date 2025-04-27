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
        <link rel="stylesheet" href="liste_eleves_style.css"/>
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
        if (isset($_SESSION["login"]))
        {
            /*************
            *****On va récupérer les information de tous les élèves
            *************/

            if ($_SESSION["type"] ==1) //si connexion en prof
            {
                include '_menuProf.php'; //Menu du prof

                //Les noms des élèves sont affichés dans l'ordre croissant
                $requete = "SELECT 
                        utilisateur.num,
                        utilisateur.nom AS nomEleve, 
                        utilisateur.prenom AS prenomEleve, 
                        stage.nom AS nomStage,
                        stage.tel AS telStage,
                        stage.email AS emailStage,
                        COUNT(cr.num) AS nbCR,
                        tuteur.nom AS nomTuteur, 
                        tuteur.prenom AS prenomTuteur,
                        tuteur.tel AS telTuteur
                        FROM utilisateur
                        LEFT JOIN stage ON utilisateur.num_stage = stage.num
                        LEFT JOIN tuteur ON stage.num_tuteur = tuteur.num
                        LEFT JOIN cr ON utilisateur.num = cr.num_utilisateur
                        WHERE utilisateur.type = 0
                        GROUP BY utilisateur.num
                        ORDER BY utilisateur.nom ASC"; 
                    
                if($connexion = mysqli_connect($serveurBDD,$userBDD,$mdpBDD,$nomBDD))    
                {

                                        /********************
                    ***********Pour récuperer les infos des élèves et de leur stages on doit se connecter et on va créer la variable $resultat
                    ********************/
                    $resultat = mysqli_query($connexion, $requete);

                    // Exécution de la requête + affichage des résultats
                    while($donnees = mysqli_fetch_assoc($resultat))
                    {
                        echo "<div class='eleve-card'>";
                        echo "<h2 class='eleve-nom'>".$donnees['prenomEleve']." ".$donnees['nomEleve']."</h2>";
                        echo "<div class='eleve-infos'>";
                        echo "<p><strong>Stage :</strong> ".$donnees['nomStage']."</p>";
                        echo "<p><strong>Téléphone entreprise :</strong> ".$donnees['telStage']."</p>";
                        echo "<p><strong>Email entreprise :</strong> ".$donnees['emailStage']."</p>";
                        echo "<p><strong>Tuteur :</strong> ".$donnees['prenomTuteur']." ".$donnees['nomTuteur']."</p>";
                        echo "<p><strong>Téléphone tuteur :</strong> ".$donnees['telTuteur']."</p>";
                        echo "<p><strong>Nombre de comptes rendus :</strong> ".$donnees['nbCR']."</p>";
                        echo "</div>"; // eleve-infos
                        echo "</div>"; // eleve-card
                    }
                    

                }

            }

        
        }
        ?>
        
        <!----------Fonctionnalité du menus---------->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <script src="menu_script.js"></script>
    </body>
</html>
