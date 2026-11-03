<?php

require_once __DIR__ . '/../autoload.php';

// Validation : seules 'fr' et 'en' sont acceptées, tout le reste devient 'fr'
const LANGUES_AUTORISEES = ['fr', 'en'];
$langue = $_GET['lang'] ?? Kitty::LANGUE_PAR_DEFAUT;
if (!in_array($langue, LANGUES_AUTORISEES, true)) {
    $langue = Kitty::LANGUE_PAR_DEFAUT;
}

$repository = new KittyRepository();
$kitties = $repository->findAll();
?>
<!DOCTYPE html>
<html lang="<?= htmlspecialchars($langue) ?>">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>What's Your Kitty ?</title>
</head>

<body>
    <h1><?= $langue === 'en' ? 'All Kitties' : 'Toutes les Kitty' ?></h1>

    <p>
        <a href="?lang=fr">Français</a> |
        <a href="?lang=en">English</a>
    </p>

    <?php if (empty($kitties)): ?>
        <p><?= $langue === 'en' ? 'No Kitty found.' : 'Aucune Kitty trouvée.' ?></p>
    <?php else: ?>
        <?php foreach ($kitties as $kitty): ?>
            <section>
                <h2><?= htmlspecialchars($kitty->getNom($langue)) ?></h2>
                <p><?= htmlspecialchars($kitty->getDescription($langue) ?? '') ?></p>
            </section>
        <?php endforeach; ?>
    <?php endif; ?>
</body>

</html>
