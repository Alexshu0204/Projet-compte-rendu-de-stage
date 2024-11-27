
<?php 
session_start();

function motDePasse($longueur) { // par défaut, on affiche un mot de passe de 5 caractères
 // chaine de caractères qui sera mis dans le désordre:
 $Chaine = "abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ!+()*-/"; // 62 caractères au total
 // on mélange la chaine avec la fonction str_shuffle(), propre PHP
 $Chaine = str_shuffle($Chaine);
 // ensuite on coupe la longueur voulue avec la fonction substr(), propre PHP aussi
 $Chaine = substr($Chaine,0,$longueur);
 // ensuite on retourne notre chaine aléatoire de "longueur" caract�res:
 return $Chaine;
}



 
if (isset($_POST['email']))
{
    include "_conf.php";
     $lemail=$_POST['email'];
     echo "le formulaire a été envoyé avec comme email la valeur :".$lemail;
     if($connexion=mysqli_connect($serveurBDD,$userBDD,$mdpBDD,$nomBDD))
     {
         echo "connexion ok";
         //A faire après la sélection BDD
        $requete="Select * from utilisateur WHERE email='$lemail'";
        echo "<br>".$requete."<br>";
        $resultat = mysqli_query($connexion, $requete);
        $trouve=0;
	    while($donnees = mysqli_fetch_assoc($resultat))
	    {
		    $login =$donnees['login']; //mettre le nom du champ dans la table
		    $mdp =$donnees['motdepasse'];	
            $trouve=1;
            
	    }
        if ($trouve==0)
        {
            echo "email non trouvé";
        }
        else {

            //etape 1 : MDP aléatoire
            $newmdp=motDePasse(12);
            echo "<hr>$newmdp<hr>";

            $mdphache=md5($newmdp);

            // etape 2 : modifier BDD UPDATE avec nv MDP haché
            //A faire après la sélection BDD
            $requete="UPDATE `utilisateur` SET `motdepasse` = '$mdphache' WHERE email='$lemail';";
            if (!mysqli_query($connexion,$requete)) 
            {
                echo "<br>Erreur : ".mysqli_error($connexion)."<br>";
            }  

            // etape 3 : envoie du nv MDP

	        echo "<br>email trouvé  = envoi de l'email'";
            // Le message
        $message = "votre nouveau mot de passe est : '$newmdp ' - votre login : '$login'";


        
        ?>
        <br/>
        <a href='index.php'>Retour vers page de connexion</a>

        <?php


        // Envoi du mail
        mail($lemail, 'Votre login/mot de passe sur le site des stages', $message);
        }


     }
     else {
	    echo "erreur de connexion";
   }

}
else
{
?>

    <form method="POST">
    Email : <input type="email" name="email">
    <input type="submit" value="OK" name="envoi">

    </form>
<?php
}
?>


