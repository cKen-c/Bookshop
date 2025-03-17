<?php
include_once '../includes/functions.php';

// Vérification de la soumission du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $mot_de_passe = $_POST['mot_de_passe'];

    // Inscription de l'utilisateur
    $inscription_reussie = Utilisateur::inscription($nom, $email, $mot_de_passe);
    if ($inscription_reussie) {
        header('Location: login.php'); // Redirection vers la page de connexion après l'inscription
        exit;
    } else {
        $error = 'Une erreur est survenue lors de l\'inscription.';
    }
}

include_once '../templates/header.php'; // Inclusion du header
?>

<div class="container">
    <h2>Inscription</h2>
    <?php if (isset($error)) { echo "<p style='color:red;'>$error</p>"; } ?>
    <form method="POST">
        <div class="form-group">
            <label for="nom">Nom</label>
            <input type="text" name="nom" id="nom" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="mot_de_passe">Mot de passe</label>
            <input type="password" name="mot_de_passe" id="mot_de_passe" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">S'inscrire</button>
    </form>
</div>

<?php include_once '../templates/footer.php'; ?>
