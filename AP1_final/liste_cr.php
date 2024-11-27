<?php
session_start();


//include "_conf.php";
        
$objetPdo=new PDO('mysql:host=localhost;dbname=apcr','root','root');
        
$numEleve = $_SESSION['Sid'];

//echo "Compte rendu ajouté avec succès !"; 

$pdoStat = $objetPdo ->prepare("SELECT * FROM cr");   
        
//execution de la requete

$executeIsOk = $pdoStat->execute();

$cr = $pdoStat->fetchAll();

//var_dump($cr);
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste compte rendu</title>

    <style>
    </style>

</head>
<body>

    <h1>Liste des comptes rendus</h1>

    <ul>
        <?php foreach ($cr as $Cr): ?>

            <li>
                <?= $Cr['date']?> <?= $Cr['description']?> - 
                <? $Cr['datecreation']?> - <? $Cr['datemodification']?>
            </li>
             
        <?php endforeach; ?>
    </ul>

</body>
</html>


