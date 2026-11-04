<?php

require_once __DIR__ . '/../autoload.php';

session_start();

// Constantes : règles de validation
const PSEUDO_MIN = 2;
const PSEUDO_MAX = 50;
const EMAIL_MAX = 100;
const MOT_DE_PASSE_MIN = 8;
const MOT_DE_PASSE_MAX = 72; // limite de l'algorithme de hash

// Jeton CSRF : prouve que le formulaire vient bien de notre site
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

$erreurs = [];
$pseudo = '';
$email = '';
$succes = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // On ne fait jamais confiance aux saisies : on les récupère, puis on les valide
    $jeton = (string) ($_POST['csrf_token'] ?? '');
    $pseudo = trim((string) ($_POST['pseudo'] ?? ''));
    $email = trim((string) ($_POST['email'] ?? ''));
    $motDePasse = (string) ($_POST['mot_de_passe'] ?? '');
    $confirmation = (string) ($_POST['confirmation'] ?? '');

    if (!hash_equals($_SESSION['csrf_token'], $jeton)) {
        $erreurs[] = "Formulaire invalide. Recharge la page et réessaie.";
    }

    if (mb_strlen($pseudo) < PSEUDO_MIN || mb_strlen($pseudo) > PSEUDO_MAX) {
        $erreurs[] = "Le pseudo doit faire entre " . PSEUDO_MIN . " et " . PSEUDO_MAX . " caractères.";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL) || mb_strlen($email) > EMAIL_MAX) {
        $erreurs[] = "L'adresse e-mail n'est pas valide.";
    }

    if (strlen($motDePasse) < MOT_DE_PASSE_MIN || strlen($motDePasse) > MOT_DE_PASSE_MAX) {
        $erreurs[] = "Le mot de passe doit faire entre " . MOT_DE_PASSE_MIN . " et " . MOT_DE_PASSE_MAX . " caractères.";
    }

    if ($motDePasse !== $confirmation) {
        $erreurs[] = "Les deux mots de passe ne sont pas identiques.";
    }

    // Si tout est valide, on enregistre
    if (empty($erreurs)) {
        $repository = new UtilisateurRepository();

        if ($repository->emailExiste($email)) {
            $erreurs[] = "Cette adresse e-mail est déjà utilisée.";
        } else {
            try {
                $repository->creer($pseudo, $email, $motDePasse);
                $succes = true;
                $pseudo = '';
                $email = '';
                // Nouveau jeton après chaque envoi réussi
                $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
            } catch (PDOException $e) {
                $erreurs[] = "Impossible de créer le compte pour le moment.";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - What's Your Kitty ?</title>
</head>

<body>
    <h1>Créer un compte</h1>

    <?php if ($succes): ?>
        <p>Ton compte a bien été créé !</p>
    <?php endif; ?>

    <?php if (!empty($erreurs)): ?>
        <ul>
            <?php foreach ($erreurs as $erreur): ?>
                <li><?= htmlspecialchars($erreur) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <form action="inscription.php" method="POST">
        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>">

        <label for="pseudo">Pseudo :</label><br>
        <input type="text" id="pseudo" name="pseudo" value="<?= htmlspecialchars($pseudo) ?>" required><br><br>

        <label for="email">E-mail :</label><br>
        <input type="email" id="email" name="email" value="<?= htmlspecialchars($email) ?>" required><br><br>

        <label for="mot_de_passe">Mot de passe :</label><br>
        <input type="password" id="mot_de_passe" name="mot_de_passe" required><br><br>

        <label for="confirmation">Confirmer le mot de passe :</label><br>
        <input type="password" id="confirmation" name="confirmation" required><br><br>

        <button type="submit">S'inscrire</button>
    </form>

    <p><a href="index.php">Retour à l'accueil</a></p>
</body>

</html>
