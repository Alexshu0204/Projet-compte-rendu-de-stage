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
        <link rel="stylesheet" href="cr_style.css"/>
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

        if (isset($_POST['insertion'])) //Récupère les donnés de ccr.php (les CR qu'a créé l'élève sont affichés sur cette page)
        {
            $date=$_POST['date'];
            $contenu= addslashes($_POST['contenu']); // "addslashes" est utilisé pour échapper les caractères spéciaux (genre les ' ou ") dans le texte, pour éviter des erreurs SQL.
            $id=$_SESSION["id"];
            $connexion = mysqli_connect($serveurBDD,$userBDD,$mdpBDD,$nomBDD);
            $requete="INSERT INTO cr (date,datetime,description,num_utilisateur) VALUES ('$date',NOW(),'$contenu','$id');"; //crée nouveau compte rendu avec infos recuperees
            //echo "<br>$requete<hr>";
            if(!mysqli_query($connexion,$requete)) 
                {
                echo "erreur";
                }
            else //si possibilité de faire la requete :
                {
               echo "nouveau compte-rendu crée";
                }
        }

 
        //**************************** Si l'élève souhaite modifier ses CR ********************************
        if (isset($_POST['update'])) //recupere données de ccr.php
        {
            $date=$_POST["date"];
            $description=htmlspecialchars($_POST["contenu"]);
            $idCR=$_POST["idCR"];
            $connexion = mysqli_connect($serveurBDD,$userBDD,$mdpBDD,$nomBDD);
            $requete="UPDATE `cr` SET 
                            `date` = '$date', 
                                    `description` = '$description'
                                    WHERE `cr`.`num` = $idCR;"; //met à jour compte rendu avec infos recuperees

            echo "$requete";
            if(!mysqli_query($connexion,$requete)) 
                {
                echo "erreur";
                }
            else //si possibilité de faire la requete :
                {
            echo "CR modifié";
                }
        }

        /*****************************************************
        ----------------Connexion à la session----------------
        *****************************************************/

        if ($_SESSION["type"] ==1) //si connexion en prof
        {
            include '_menuProf.php';

            //Les CR des élèves sont affichés dans l'ordre décroissant
            $requete="SELECT *,DATE_FORMAT(date, '%d/%m/%Y') AS date_fr FROM cr,utilisateur WHERE utilisateur.num = cr.num_utilisateur  ORDER BY date DESC";
                if($connexion = mysqli_connect($serveurBDD,$userBDD,$mdpBDD,$nomBDD))
                {
            
                    /********************
                    ***********Pour récuperer les données des CR on doit se connecter et on va créer la variable $resultat
                    ********************/
                    $resultat = mysqli_query($connexion, $requete);

                    // Exécution de la requête + affichage des résultats
                    while($donnees = mysqli_fetch_assoc($resultat))
                    {
                        $num=$donnees['num'];
                        $contenu=$donnees['description'];
                        $prenom= $donnees['prenom'];
                        $nom=$donnees['nom'];
                        $date=$donnees['date_fr'];
                    
                        //Affichage du numéro, nom/prénom et date du CR fait par l'élève
                        echo "<div class='table-container'><table border=2><thead> <tr> <th colspan=2> <u>n°$num ($prenom $nom) - le $date</u> </th> </tr> </thead>
                        <tbody> <tr> <td>  $contenu</td> </tr>  </tbody> </table> </div>";  //affiche tous les compte rendus du plus recent au plus ancien 
                    }
                }
        }
        else //si connexion en eleve
        { 
            include '_menuEleve.php';
                $id=$_SESSION["id"];     
                $requete="SELECT cr.*,DATE_FORMAT(date, '%d/%m/%Y') AS date_fr
                    FROM cr,utilisateur WHERE utilisateur.num = cr.num_utilisateur AND utilisateur.num=$_SESSION[id] ORDER BY date DESC"; //recupere tous les comptes rendus par date decroissante
                $connexion = mysqli_connect($serveurBDD,$userBDD,$mdpBDD,$nomBDD);
                
            
                    $resultat = mysqli_query($connexion, $requete);
                    while($donnees = mysqli_fetch_assoc($resultat))
                    {
                        $num=$donnees['num'];
                        $contenu=$donnees['description'];
                        $date=$donnees['date_fr'];
                    
                        echo "<div class='table-container'>
                                <table> 
                                        <tr> <th> <u>n°$num ($date)</u> </th> </tr> 
                                <tbody> 
                                        <tr> <td>  $contenu</td> </tr> 

                                        <tr> <td>  <a href='ccr.php?id=$num' class='btn-modification'>Modifier</a> </td> </tr> 
                                </tbody> 
                                </table>
                            </div>";  //affiche tous les compte rendus du plus recent au plus ancien + lien pour modifier
                    }
                
        }  
        ?>
        
        <!----------Fonctionnalité du menus---------->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <script src="menu_script.js"></script>
    </body>
</html>
