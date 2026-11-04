<?php

require_once __DIR__ . '/../autoload.php';

$repository = new TraitRepository();
$traits = $repository->findAll();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>What's Your Kitty ?</title>
</head>

<body>
    <h1>What's Your Kitty ?</h1>

    <h2>Les traits de personnalité</h2>

    <?php if (empty($traits)): ?>
        <p>Aucun trait trouvé.</p>
    <?php else: ?>
        <table border="1" cellpadding="6">
            <tr>
                <th>ID</th>
                <th>Français</th>
                <th>English</th>
            </tr>
            <?php foreach ($traits as $trait): ?>
                <tr>
                    <td><?= htmlspecialchars((string) $trait->getId()) ?></td>
                    <td><?= htmlspecialchars($trait->getNom('fr')) ?></td>
                    <td><?= htmlspecialchars($trait->getNom('en')) ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>

    <p><a href="kitties.php">Voir toutes les Kitty</a></p>
</body>

</html>
