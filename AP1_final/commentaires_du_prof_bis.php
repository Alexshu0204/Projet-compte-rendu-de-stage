<?php
session_start();

// Connexion à la base de données
$objetPdo = new PDO('mysql:host=localhost;dbname=apcr', 'root', 'root');

// Requête avec jointure pour récupérer les utilisateurs
$pdoStat = $objetPdo->prepare("
    SELECT cr.*, utilisateurs.nom AS utilisateur_nom 
    FROM cr 
    LEFT JOIN utilisateurs ON cr.numEleve = utilisateurs.id
");
$executeIsOk = $pdoStat->execute();
$cr = $pdoStat->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des comptes rendus</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        table th, table td {
            padding: 12px;
            text-align: center;
            border: 1px solid #ddd;
        }

        table th {
            background-color: #007bff;
            color: #fff;
            font-weight: bold;
        }

        table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        table tr:hover {
            background-color: #e9ecef;
        }

        .action-form {
            margin: 0;
        }

        .action-btn {
            padding: 6px 12px;
            background-color: #28a745;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
        }

        .action-btn:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>

    <h1>Liste des comptes rendus</h1>

    <table>
        <thead>
            <tr>
                <th>Utilisateur</th>
                <th>Date de création</th>
                <th>Description</th>
                <th>Date de modification</th>
                <th>Commentaires</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($cr as $Cr): ?>
                <tr>
                    <td><?= htmlspecialchars($Cr['utilisateur_nom']) ?></td>
                    <td><?= htmlspecialchars($Cr['datecreation']) ?></td>
                    <td><?= htmlspecialchars($Cr['description']) ?></td>
                    <td><?= htmlspecialchars($Cr['datemodification']) ?></td>
                    <td><?= htmlspecialchars($Cr['commentaire'] ?? 'Aucun commentaire') ?></td>
                    <td>
                        <form action="creer_cr.php" method="POST" class="action-form">
                            <input type="hidden" name="id_cr" value="<?= htmlspecialchars($Cr['id']) ?>">
                            <button type="submit" class="action-btn">Commenter</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>
</html>
