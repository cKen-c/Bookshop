<!-- templates/header.php -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bibliothèque</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<header>
    <nav>
        <a href="index.php">Accueil</a>
        <a href="library.php">Ma Bibliothèque</a>
        <?php if (isset($_SESSION['user_id'])): ?>
            <a href="profile.php">Profil</a>
            <a href="logout.php">Déconnexion</a>
        <?php else: ?>
            <a href="login.php">Connexion</a>
            <a href="register.php">Inscription</a>
        <?php endif; ?>
    </nav>
</header>
