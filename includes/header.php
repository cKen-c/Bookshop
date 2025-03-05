<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bibliothèque</title>
    <link rel="stylesheet" href="/css/styles.css"> <!-- Lien vers le CSS -->
</head>
<body>
    <header>
        <h1><a href="/index.php">📚 Bibliothèque</a></h1>
        <nav>
            <?php if (isset($_SESSION['user_id'])): ?>
                <a href="/logout.php">Se déconnecter</a>
            <?php else: ?>
                <a href="/login.php">Se connecter</a>
            <?php endif; ?>
        </nav>
    </header>
