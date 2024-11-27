<?php 
session_start();

?>

<!--Mise en forme-->


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil Élève</title>
    <link rel="stylesheet" href="style.css"> <!-- Lien vers le fichier CSS -->
</head>
<body>
  <?php
  include "_menu_eleve.php";
  ?>
</body>
</html>


<?php

if (isset($_POST['send_con']))
{   
    $login=$_POST['login'];
    $mdp=$_POST['mdp'];
    $mdp=md5($mdp);
    include "_conf.php";
    if($connexion=mysqli_connect($serveurBDD,$userBDD,$mdpBDD,$nomBDD))
     {
        $requete="Select * from utilisateur WHERE login='$login' and motdepasse='$mdp'";
        $resultat = mysqli_query($connexion, $requete);
        $trouve=0;
	    while($donnees = mysqli_fetch_assoc($resultat)){
            $trouve=1;
            $_SESSION['Sid']=$donnees['num'];
            $_SESSION['Slogin']=$donnees['login'];
            $_SESSION['Stype']=$donnees['numType'];
        }

        if($trouve==1){
            //echo "Connexion réussie   ";
        }
        else {
            echo "login/mdp pas trouvé";
        }
     }
}

if (isset($_SESSION['Sid']))
{
    //echo "Vous êtes connecté(e) en tant que  ".$_SESSION['Slogin'];
    echo "<br> <a href='perso.php'>lien vers mes informations personnelles <a/>";
?>

    <!--
    <form method="post" action="index.php">
    <input type="submit" value="déconnexion" name="send_deco">
    </form>
    -->
    <?php
    // partie prof
    if(($_SESSION['Stype'])==1)
    {
        echo "<hr>PARTIE PROF";
    }
    else
    {
        echo "<hr>PARTIE ELEVE"; 
    }



}
else
{
	echo "  La connexion est perdue, veuillez revenir à la <a href='index.php'>page d'index</a> pour vous reconnecter."; 
}

?> 