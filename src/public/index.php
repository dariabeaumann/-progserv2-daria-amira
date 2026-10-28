<?php

$config = require __DIR__ . '/config.php';

$dsn = "mysql:host={$config['db_host']};dbname={$config['db_name']};charset=utf8mb4";

$pdo = new PDO($dsn, $config['db_user'], $config['db_pass'], [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
]);

$stmt = $pdo->prepare("SELECT id_trait, nom_fr, nom_en FROM trait ORDER BY id_trait");
$stmt->execute();
$traits = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>What's Your Kitty ?</title>
</head>

<body>
    <h1>What's Your Kitty ? 🎀</h1>

    <p>Projet réalisé dans le cadre du cours ProgServ2 à la HEIG-VD.</p>

    <h2>Traits de personnalité</h2>

    <table border="1" cellpadding="6">
        <thead>
            <tr>
                <th>ID</th>
                <th>Français</th>
                <th>English</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($traits as $trait) { ?>
                <tr>
                    <td><?= htmlspecialchars((string) $trait['id_trait']) ?></td>
                    <td><?= htmlspecialchars($trait['nom_fr']) ?></td>
                    <td><?= htmlspecialchars($trait['nom_en']) ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>

</html>
