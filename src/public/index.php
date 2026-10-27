<?php

$config = require __DIR__ . '/config.php';

$dsn = "mysql:host={$config['db_host']};dbname={$config['db_name']};charset=utf8mb4";

$pdo = new PDO($dsn, $config['db_user'], $config['db_pass'], [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
]);

$sql = "SELECT * FROM kitty";

$stmt = $pdo->prepare($sql);

$stmt->execute();

$results = $stmt->fetchAll();
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

    <h2>Kitty disponibles :</h2>

    <?php if (empty($results)) { ?>
        <p>Aucune Kitty trouvée dans la base de données.</p>
    <?php } else { ?>
        <ul>
            <?php foreach ($results as $row) { ?>
                <li>
                    <ul>
                        <?php foreach ($row as $column => $value) { ?>
                            <li><?= htmlspecialchars($column) ?> : <?= htmlspecialchars((string) $value) ?></li>
                        <?php } ?>
                    </ul>
                </li>
            <?php } ?>
        </ul>
    <?php } ?>
</body>

</html>
