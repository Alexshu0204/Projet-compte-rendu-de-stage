<?php
include '_conf.php';

function genererMotDePasse($longueur) {
    // Ensemble des caractères utilisables pour le mot de passe
    $caracteres = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_+-=[]{}|;:,.<>?';
    // Initialisation du mot de passe
    $motDePasse = '';
    // Taille totale du jeu de caractères
    $tailleCaracteres = strlen($caracteres);//Obtenir la longueur de la chaîne
    // Boucle pour générer chaque caractère aléatoire
    for ($i = 0; $i < $longueur; $i++) {
        $indexAleatoire = random_int(0, $tailleCaracteres - 1);
        $motDePasse .= $caracteres[$indexAleatoire];
    }
    return $motDePasse;
}


if (isset($_POST['envoi_perdu'])) 
{
        //On récupère l'email et le login soumis par l'utilisateur
        $email=$_POST["email"];
        $login=$_POST["login"];
        $connexion = mysqli_connect($serveurBDD,$userBDD,$mdpBDD,$nomBDD);
        $requete="SELECT * FROM utilisateur
                WHERE email='$email' AND login='$login'";
          $resultat = mysqli_query($connexion, $requete); // on exécute la requête dans la variable resultat
           $trouve=0; //initialisation d'une variable trouve à 0 qui servira pour voir si on a trouvé une ligne dans la requête
            while($donnees = mysqli_fetch_assoc($resultat)) // pour chaque ligne dans la requête je stock ça dans un tableau $donnees avec comme colonne le nom des champs de la requête SQL
              {
                $trouve=1; //si on rentre dans la boucle c'est qu'on a trouvé 
              }
            //**** fin SQL
            if($trouve==1)
            {
                $newmdp=genererMotDePasse(10);
                $newmdphash=md5($newmdp);
               $requete="UPDATE `utilisateur` SET `motdepasse` = '$newmdphash' 
                     WHERE email='$email' AND login='$login'"; 

              
                if(!mysqli_query($connexion,$requete)) 
                    {
                    echo "Erreur";
                    }
                else //si possibilité de faire la requete :
                    {
                   echo "Mot de passe mise à jour avec succès !";
                    }
                
            }
           
}


/****************************************************
-----------Transition à la partie frontend-----------
*****************************************************/
?>

<!DOCTYPE html>
<html lang="fr">
   <head>
       <title>Authentification</title>
       <meta charset="utf-8" />
       <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <link rel="stylesheet" href="oubli_style.css"/>
       <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'><!--Lien pour télécharger les icônes-->
       <link href='https://fonts.googleapis.com/css?family=Nunito Sans' rel='stylesheet'>
       <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
   </head>

    <body>

        <header class="header">
            <nav class="menu">
                <h1 class="forgotTitle">Suivi des Stages</h1>
            </nav>
        </header>

        <div class="menu-buttons">
            <button class="btn-menu" onclick="window.location.href='index.php'">Retour</button>
        </div>

        <main>
            <section id="formulaire" class="form-container">

                <h2>Mot de passe oublié</h2>

                <form action="oubli.php" method="post">

                    <div class="input-container">
                        <i class='bx bx-envelope'></i>
                        <input type="email" name="email" placeholder="Entrez votre email *" 
                            value="<?php if (isset($email)) echo $email;?>" required>
                    </div>

                    <div class="input-container">
                        <i class='bx bxs-user'></i>
                        <input type="text" name="login" placeholder="Entrez votre login *"  
                            value="<?php if (isset($login)) echo $login;?>" required>
                    </div>

                    <button type="submit" class="btn-submit" name="envoi_perdu" value="1">
                        Envoyer pour recevoir un nouveau mot de passe par email
                    </button>



                    
                    <?php 
                    /*******************************************
                    --------------Envoi de l'email--------------
                    *******************************************/

                    if (isset($trouve)) 
                    {
                        if($trouve==0)
                        {
                            echo "<br>ERREUR email/login non trouvé";
                        }
                        else {

                            $destinataire = "$email"; // Adresse du destinataire
                            $sujet = "Site CR STAGE : nouveau mot de passe"; // Sujet de l'e-mail
                            $message = "Bonjour, voici votre nouveau mot de passe sur le site des CR de stage : $newmdp"; // Corps de l'e-mail
                        
                            // Envoi de l'e-mail
                            if(mail($destinataire, $sujet, $message)) {
                                echo "L'e-mail a été envoyé avec succès.";
                            } else {
                                echo "Échec de l'envoi de l'e-mail.";
                            }
                        }
                    }
                    ?>
                </form>
            </section>
        </main>

    </body>

</html>