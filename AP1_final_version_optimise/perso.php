<?php
session_start();
include '_conf.php';

// Connexion à la base de données
$connexion = mysqli_connect($serveurBDD, $userBDD, $mdpBDD, $nomBDD);

// Vérification de la soumission du formulaire
if (isset($_POST['envoi_info'])) {
    $nom = mysqli_real_escape_string($connexion, $_POST['nom']);
    $prenom = mysqli_real_escape_string($connexion, $_POST['prenom']);
    $tel = mysqli_real_escape_string($connexion, $_POST['tel']);
    $login = mysqli_real_escape_string($connexion, $_POST['login']);
    $email = mysqli_real_escape_string($connexion, $_POST['email']);
    $id = $_SESSION['id'];

    // Correction de la requête SQL
    $requete = "UPDATE utilisateur SET
                    nom = '$nom',
                    prenom = '$prenom',
                    tel = '$tel',
                    login = '$login',
                    email = '$email'
                WHERE num = $id";

    if (!mysqli_query($connexion, $requete)) {
        echo "Erreur lors de la mise à jour.";
    } else {
        echo "Mise à jour effectuée.";
    }
}

/********************************************************
----------- Transition vers la partie Frontend ----------
********************************************************/
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!--stylisation pricipale-->
        <link rel="stylesheet" href="perso_style.css"/>
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
        //*************************
        //****** si il y a une valeur de session Login cela signifie que la connexion est présente
        //*************************
        if (isset($_SESSION["login"]))
            {
                $id = $_SESSION["id"];
                if($_SESSION["type"]==0) //Si c'est un élève
                {
                    include '_menuEleve.php';
                }
                else
                {
                    include '_menuProf.php';
                }

                //on prépare la connexion avec les variables mis dans le fichier conf
                $connexion = mysqli_connect($serveurBDD, $userBDD, $mdpBDD, $nomBDD);

            //*************************
            //****** selection de tous les champs de la table UTILISATEUR en faisant une restriction sur le login 
            //*************************
            $requete="Select * from utilisateur WHERE num = '$id'"; //on initialise la requête
            $resultat = mysqli_query($connexion, $requete); // on exécute la requête dans la variable resultat
        
            while($donnees = mysqli_fetch_assoc($resultat)) // pour chaque ligne dans la requête je stock ça dans un tableau $donnees avec comme colonne le nom des champs de la requête SQL
            {
        
                $nom = $donnees['nom'];
            
                $prenom = $donnees['prenom'];
                $tel = $donnees['tel'];
                $login = $donnees['login'];
                $email = $donnees['email'];
            }
    
            ?>
            <!-- FORMULAIRE avec les données de l'utilisateur' -->
        
            <section id="formulaire" class="form-container">
                <h2>Information Personnelle</h2>
                <form action="perso.php" method="post">
                    <div class="form-group">
                        <label>Nom :</label>
                        <input type="text" name="nom" value="<?php echo $nom ?>">
                    </div>
                    <div class="form-group">
                        <label>Prénom :</label>
                        <input type="text" name="prenom" value="<?php echo $prenom ?>">
                    </div>
                    <div class="form-group">
                        <label>Tel :</label>
                        <input type="text" name="tel" value="<?php echo $tel ?>">
                    </div>
                    <div class="form-group">
                        <label>Login :</label>
                        <input type="text" name="login" value="<?php echo $login ?>">
                    </div>
                    <div class="form-group">
                        <label>Email :</label>
                        <input type="text" name="email" value="<?php echo $email ?>">
                    </div>
                
                    <button type="submit" class="btn-submit" name="envoi_info" value="1">Mettre à jour</button>
                </form>
            </section>


            <?php
        }


        ?>
        
        <!----------Fonctionnalité du menus---------->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <script src="menu_script.js"></script>
    </body>
</html>
