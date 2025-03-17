<?php
session_start();
include_once '../includes/functions.php';

// Vérification de la soumission du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $mot_de_passe = $_POST['mot_de_passe'];

    // Connexion à l'utilisateur
    $user = Utilisateur::connexion($email, $mot_de_passe);
    if ($user) {
        $_SESSION['user_id'] = $user->id; // Crée une session pour l'utilisateur
        header('Location: index.php'); // Redirection vers la page d'accueil
        exit;
    } else {
        $error = 'Email ou mot de passe incorrect.';
    }
}

include_once '../templates/header.php'; // Inclusion du header
?>

<div class="container">
    <h2>Connexion</h2>
    <?php if (isset($error)) { echo "<p style='color:red;'>$error</p>"; } ?>
    <form method="POST">
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="mot_de_passe">Mot de passe</label>
            <input type="password" name="mot_de_passe" id="mot_de_passe" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Se connecter</button>
    </form>
</div>

<?php include_once '../templates/footer.php'; ?>
