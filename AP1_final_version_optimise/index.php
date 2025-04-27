<?php

/*****test pour s'assurer que la connexion avec la bdd soit effectuée*****/

/*
include '_conf.php';

if ($bdd = mysqli_connect($serverBDD, $userBDD, $mdpBDD, $nomBDD))
{
    //si connecxion a réussit 
    echo"connexion BDD réussit !";
}
else //si elle rate
{
    echo "erreur";
}
*/

//Démarrge de la session
session_start();

/***********************Détecte la déconnexion**********************/
if (isset($_GET['deco']))
{
    session_destroy();
    //Détruit la session après avoir cliqué sur le bouton déconnexion
    //echo "Vous êtes déconnecté(e)";
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
       <link rel="stylesheet" href="login_mainStyle.css"/>
       <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'><!--Lien pour télécharger les icônes-->
       <link href='https://fonts.googleapis.com/css?family=Nunito Sans' rel='stylesheet'>
       <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
   </head>

    <body>

        <header class="header">
                <h1 class="loginTitle">Suivi des Stages</h1>
        </header>


        <main class="auth_container">

            <!----------------------------------------------Formulaire de connexion---------------------------------------------->
            <section id="loginForm">

                <div class="container">

                    <div class="adminIcone">
                        <div class="adminTitle">CONNEXION</div>
                    </div>

                    <form action="accueil.php" method="post">

                    <br/>

                    <!--Ici les champs-->
                    <div class="input-container">
                        <i class='bx bxs-user'></i>
                        <input name="login" id="username" type="text" placeholder="Login *" required>
                    </div>
                    
                    <div class="input-container">
                        <i class='bx bxs-lock-alt'></i>
                        <input name="mdp" id="password" type="password" placeholder="Mot de passe *" required>
                    </div>

                    <!--Ici le reste-->
                    <div class="Forgot">
                        <a href="oubli.php">Mot de passe oublié ?</a>
                    </div>

                    <button type="submit" id="loginButton" name="envoi" value="1">
                        Se connecter 
                        <div class="loader"></div>
                    </button>

                    </form>
                </div>

            </section>

        </main>

    </body>

</html>