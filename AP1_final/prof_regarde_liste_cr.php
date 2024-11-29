<?php
session_start();

// Connexion à la base de données
$objetPdo = new PDO('mysql:host=localhost;dbname=apcr', 'root', 'root');

// Récupérer les données
$pdoStat = $objetPdo->prepare("SELECT * FROM cr");
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
            background-color: #f8f9fa;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        table {
            width: 90%;
            margin: 20px auto;
            border-collapse: collapse;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }

        table th, table td {
            padding: 15px;
            text-align: center;
            border: 1px solid #ddd;
        }

        table th {
            background-color: #007BFF;
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
            display: inline-block;
        }

        .action-btn {
            padding: 8px 12px;
            background-color: #28a745;
            color: white;
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
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($cr as $Cr): ?>
                <tr>
                    <td><?= htmlspecialchars($Cr['numEleve']) ?></td>
                    <td><?= htmlspecialchars($Cr['datecreation']) ?></td>
                    <td><?= htmlspecialchars($Cr['description']) ?></td>
                    <td><?= htmlspecialchars($Cr['datemodification']) ?></td>
                    <td>
                        <form action="commenter.php" method="POST" class="action-form">
                            <input type="hidden" name="id_cr" value="<?= $Cr['id'] ?>">
                            <button type="submit" class="action-btn">Commenter</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>
</html>
