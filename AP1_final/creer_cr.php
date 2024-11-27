<?php
session_start();
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil Élève</title>
    <!--<link rel="stylesheet" href="style.css">-->

    <style>

                /* Style global */
        body {
            font-family: Arial, sans-serif;
            background-color: #f3f4f6; /* Arrière-plan doux */
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        /* Conteneur principal */
        .container {
            background-color: #ffffff;
            padding: 20px 30px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            width: 100%;
        }

        /* En-tête */
        .header {
            font-size: 24px;
            font-weight: bold;
            color: #333;
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #f3f4f6;
            padding-bottom: 10px;
        }

        /* Formulaire */
        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        /* Labels */
        label {
            font-size: 14px;
            font-weight: bold;
            color: #555;
            margin-bottom: 5px;
        }

        /* Champs de formulaire */
        input[type="date"],
        textarea {
            width: 100%;
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
            box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        textarea {
            resize: none; /* Désactiver le redimensionnement */
        }

        /* Boutons */
        button,
        input[type="submit"] {
            padding: 10px 15px;
            font-size: 14px;
            font-weight: bold;
            color: #fff;
            background-color: #4CAF50; /* Vert agréable */
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        /* Style au survol des boutons */
        button:hover,
        input[type="submit"]:hover {
            background-color: #347d37; /* Vert un peu plus sombre */
        }

        input[name="send_con"] {
            background-color: #85929e;
        }

        input[name="send_con"]:hover {
            background-color: #6d7882;
        }

        /* Espacement entre les groupes */
        textarea + button,
        input[type="submit"] + input[type="submit"] {
            margin-top: 10px;
        }


    </style>

</head>
<body>
<?php
  //include "_menu_eleve.php";
  ?>

    <div class="container">

        <div class="header">Affichage compte rendu</div>


        <form method="POST" action="creer_CR.php">

            <!--entrer la date-->
            <label for="date">Compte rendu du date :</label>
            <input type="date" id="date" name="date">

            <br/>

            <!--entrer la description-->
            <label for="description">Description :</label>
            <!--balise textarea pour créer un descriptif-->
            <textarea id="description" name="description" rows="4" cols="50" placeholder="Entrez une description ici..."></textarea>
            <button type="submit" name="send_creerCR">Envoyer</button>

            <br/>
            <input type="submit" value="Voir commentaire" name="send_con">
            <input type="submit" value="Modifier" name="send_con">

        </form>


        

    </div>



    <?php
      

        
      
        if (isset($_POST['send_creerCR'])) {
            // Récupérer les données du formulaire
            $date = $_POST['date'];
            $description = $_POST['description'];

            try {
                include "_conf.php";//il y a la connexion dedans  
               // Exemple : récupérer `numEleve` depuis la session ou le définir à 1 pour les tests
                 // Partie serveur : connexion et insertion dans la base de données
                $connexion=mysqli_connect($serveurBDD,$userBDD,$mdpBDD,$nomBDD);
                
               $numEleve = $_SESSION['Sid'];

                $sql = "INSERT INTO cr (date, description, datecreation, datemodification, vu, numEleve) 
                VALUES ('$date', '$description', NOW(), NOW(), 0, $numEleve)";
        
                // Exécuter la requête
                mysqli_query($connexion,$sql);
                
                // Message de confirmation
                echo "<p style='color: green;'>Compte rendu ajouté avec succès !</p>";

            } catch (PDOException $e) {
                // En cas d'erreur
              
                echo "<p style='color: red;'>Erreur : " . $e->getMessage() . "</p>";
            }
        }
?>


</body>
</html>


